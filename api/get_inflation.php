<?php
header('Content-Type: application/json');
require_once '../config.php';

$country_code = $_GET['country'] ?? 'US';
$year = $_GET['year'] ?? date('Y');
$month = $_GET['month'] ?? date('m');

$conn = getDBConnection();

$stmt = $conn->prepare("SELECT inflation_rate, created_at FROM inflation_data WHERE country_code = ? AND year = ? AND month = ?");
$stmt->bind_param("sii", $country_code, $year, $month);
$stmt->execute();
$result = $stmt->get_result();

$use_cache = false;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cache_date = strtotime($row['created_at']);
    $days_old = (time() - $cache_date) / (60 * 60 * 24);
    
    if ($days_old < CACHE_EXPIRY_DAYS) {
        echo json_encode(['rate' => (float)$row['inflation_rate'], 'cached' => true, 'source' => 'cache']);
        $conn->close();
        exit;
    }
}

$country_map = [
    'US' => 'united-states', 'GB' => 'united-kingdom', 'EU' => 'european-union',
    'JP' => 'japan', 'CA' => 'canada', 'AU' => 'australia', 'CH' => 'switzerland',
    'CN' => 'china', 'IN' => 'india', 'BR' => 'brazil', 'MX' => 'mexico',
    'KR' => 'south-korea', 'SG' => 'singapore', 'NZ' => 'new-zealand',
    'ZA' => 'south-africa', 'SE' => 'sweden', 'NO' => 'norway', 'DK' => 'denmark',
    'PL' => 'poland', 'TR' => 'turkey', 'PH' => 'philippines'
];

$api_country = $country_map[$country_code] ?? strtolower($country_code);

$rate = null;
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
        $rate = (float)$api_data['inflationRate'];
    } elseif (isset($api_data['rate']) && is_numeric($api_data['rate'])) {
        $rate = (float)$api_data['rate'];
    }
}

if ($rate === null) {
    $default_rates = [
        'US' => 3.2, 'GB' => 4.0, 'EU' => 2.9, 'JP' => 2.5,
        'CA' => 3.1, 'AU' => 4.1, 'CH' => 1.3, 'CN' => 0.3,
        'IN' => 5.0, 'BR' => 4.6, 'MX' => 4.7, 'KR' => 2.6,
        'SG' => 3.1, 'NZ' => 4.7, 'ZA' => 5.2, 'SE' => 2.3,
        'NO' => 3.5, 'DK' => 2.1, 'PL' => 5.1, 'TR' => 64.3,
        'PH' => 3.9
    ];
    $rate = $default_rates[$country_code] ?? 3.0;
}

$stmt = $conn->prepare("INSERT INTO inflation_data (country_code, year, month, inflation_rate, created_at) VALUES (?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE inflation_rate = VALUES(inflation_rate), created_at = NOW()");
$stmt->bind_param("siid", $country_code, $year, $month, $rate);
$stmt->execute();

echo json_encode([
    'rate' => (float)$rate, 
    'cached' => false, 
    'source' => ($rate !== null && $api_response !== false) ? 'api' : 'default'
]);

$conn->close();
?>

