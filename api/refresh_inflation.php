<?php
header('Content-Type: application/json');
require_once '../config.php';

$country_code = $_GET['country'] ?? '';

if (empty($country_code)) {
    http_response_code(400);
    echo json_encode(['error' => 'Country code required']);
    exit;
}

$year = date('Y');
$month = date('m');

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

$conn = getDBConnection();

if ($api_response !== false) {
    $api_data = json_decode($api_response, true);
    
    if (isset($api_data['inflationRate']) && is_numeric($api_data['inflationRate'])) {
        $rate = (float)$api_data['inflationRate'];
    } elseif (isset($api_data['rate']) && is_numeric($api_data['rate'])) {
        $rate = (float)$api_data['rate'];
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Invalid API response']);
        $conn->close();
        exit;
    }
    
    $stmt = $conn->prepare("DELETE FROM inflation_data WHERE country_code = ? AND year = ? AND month = ?");
    $stmt->bind_param("sii", $country_code, $year, $month);
    $stmt->execute();
    
    $stmt = $conn->prepare("INSERT INTO inflation_data (country_code, year, month, inflation_rate, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("siid", $country_code, $year, $month, $rate);
    $stmt->execute();
    
    echo json_encode([
        'success' => true,
        'country' => $country_code,
        'rate' => $rate,
        'message' => 'Inflation rate refreshed successfully'
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch from API']);
}

$conn->close();
?>

