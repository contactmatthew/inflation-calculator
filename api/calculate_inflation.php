<?php
header('Content-Type: application/json');
require_once '../config.php';

$amount = floatval($_GET['amount'] ?? 0);
$country_code = $_GET['country'] ?? 'US';
$from_date = $_GET['from_date'] ?? date('Y-m-d');
$to_date = $_GET['to_date'] ?? date('Y-m-d');
$currency = $_GET['currency'] ?? 'USD';

if ($amount <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid amount']);
    exit;
}

$conn = getDBConnection();
$stmt = $conn->prepare("SELECT currency_code FROM countries WHERE code = ?");
$stmt->bind_param("s", $country_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Country not found']);
    exit;
}

$country_currency = $result->fetch_assoc()['currency_code'];

function getExchangeRate($base, $target, $date) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT rate FROM exchange_rates WHERE base_currency = ? AND target_currency = ? AND date = ?");
    $stmt->bind_param("sss", $base, $target, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $conn->close();
        return (float)$row['rate'];
    }
    
    $url = EXCHANGE_RATE_API_URL . $base;
    $response = @file_get_contents($url);
    
    if ($response === false) {
        $conn->close();
        return null;
    }
    
    $data = json_decode($response, true);
    if (isset($data['rates'][$target])) {
        $rate = $data['rates'][$target];
        
        $stmt = $conn->prepare("INSERT INTO exchange_rates (base_currency, target_currency, rate, date) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE rate = VALUES(rate)");
        $stmt->bind_param("ssds", $base, $target, $rate, $date);
        $stmt->execute();
        
        $conn->close();
        return (float)$rate;
    }
    
    $conn->close();
    return null;
}

$from_rate = getExchangeRate($currency, $country_currency, $from_date);
$to_rate = getExchangeRate($currency, $country_currency, $to_date);

if ($from_rate === null || $to_rate === null) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch exchange rates']);
    exit;
}

$amount_in_country_currency = $amount * $from_rate;

$from_year = date('Y', strtotime($from_date));
$from_month = date('m', strtotime($from_date));
$to_year = date('Y', strtotime($to_date));
$to_month = date('m', strtotime($to_date));

$stmt = $conn->prepare("SELECT inflation_rate, created_at FROM inflation_data WHERE country_code = ? AND year = ? AND month = ?");
$stmt->bind_param("sii", $country_code, $to_year, $to_month);
$stmt->execute();
$result = $stmt->get_result();

$inflation_rate = null;
$use_cache = false;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cache_date = strtotime($row['created_at']);
    $days_old = (time() - $cache_date) / (60 * 60 * 24);
    
    if ($days_old < CACHE_EXPIRY_DAYS) {
        $inflation_rate = (float)$row['inflation_rate'];
        $use_cache = true;
    }
}

if ($inflation_rate === null) {
    $country_map = [
        'US' => 'united-states', 'GB' => 'united-kingdom', 'EU' => 'european-union',
        'JP' => 'japan', 'CA' => 'canada', 'AU' => 'australia', 'CH' => 'switzerland',
        'CN' => 'china', 'IN' => 'india', 'BR' => 'brazil', 'MX' => 'mexico',
        'KR' => 'south-korea', 'SG' => 'singapore', 'NZ' => 'new-zealand',
        'ZA' => 'south-africa', 'SE' => 'sweden', 'NO' => 'norway', 'DK' => 'denmark',
        'PL' => 'poland', 'TR' => 'turkey', 'PH' => 'philippines'
    ];
    
    $api_country = $country_map[$country_code] ?? strtolower($country_code);
    $api_url = INFLATION_API_URL . '?country=' . urlencode($api_country) . '&start=' . date('Y-m-d', strtotime('-12 months')) . '&end=' . date('Y-m-d');
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 10,
            'user_agent' => 'Inflation Calculator/1.0'
        ]
    ]);
    
    $api_response = @file_get_contents($api_url, false, $context);
    
    if ($api_response !== false) {
        $api_data = json_decode($api_response, true);
        if (isset($api_data['inflationRate']) && is_numeric($api_data['inflationRate'])) {
            $inflation_rate = (float)$api_data['inflationRate'];
        } elseif (isset($api_data['rate']) && is_numeric($api_data['rate'])) {
            $inflation_rate = (float)$api_data['rate'];
        }
    }
    
    if ($inflation_rate === null) {
        $default_rates = [
            'US' => 3.2, 'GB' => 4.0, 'EU' => 2.9, 'JP' => 2.5,
            'CA' => 3.1, 'AU' => 4.1, 'CH' => 1.3, 'CN' => 0.3,
            'IN' => 5.0, 'BR' => 4.6, 'MX' => 4.7, 'KR' => 2.6,
            'SG' => 3.1, 'NZ' => 4.7, 'ZA' => 5.2, 'SE' => 2.3,
            'NO' => 3.5, 'DK' => 2.1, 'PL' => 5.1, 'TR' => 64.3,
            'PH' => 3.9
        ];
        $inflation_rate = $default_rates[$country_code] ?? 3.0;
    }
    
    $stmt = $conn->prepare("INSERT INTO inflation_data (country_code, year, month, inflation_rate, created_at) VALUES (?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE inflation_rate = VALUES(inflation_rate), created_at = NOW()");
    $stmt->bind_param("siid", $country_code, $to_year, $to_month, $inflation_rate);
    $stmt->execute();
}

$from_timestamp = strtotime($from_date);
$to_timestamp = strtotime($to_date);
$months_diff = (date('Y', $to_timestamp) - date('Y', $from_timestamp)) * 12 + (date('m', $to_timestamp) - date('m', $from_timestamp));

$annual_inflation = $inflation_rate / 100;
$monthly_inflation = pow(1 + $annual_inflation, 1/12) - 1;
$adjusted_value = $amount_in_country_currency * pow(1 + $monthly_inflation, $months_diff);

$final_amount = $adjusted_value / $to_rate;

echo json_encode([
    'original_amount' => $amount,
    'original_currency' => $currency,
    'from_date' => $from_date,
    'to_date' => $to_date,
    'inflation_rate' => $inflation_rate,
    'months_diff' => $months_diff,
    'adjusted_amount' => round($final_amount, 2),
    'adjusted_currency' => $currency,
    'country' => $country_code
]);

$conn->close();
?>

