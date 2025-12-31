<?php
header('Content-Type: application/json');
require_once '../config.php';

$base_currency = $_GET['base'] ?? 'USD';
$target_currency = $_GET['target'] ?? 'USD';
$date = $_GET['date'] ?? date('Y-m-d');

$conn = getDBConnection();
$stmt = $conn->prepare("SELECT rate FROM exchange_rates WHERE base_currency = ? AND target_currency = ? AND date = ?");
$stmt->bind_param("sss", $base_currency, $target_currency, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['rate' => (float)$row['rate'], 'cached' => true]);
    $conn->close();
    exit;
}

$url = EXCHANGE_RATE_API_URL . $base_currency;
$response = @file_get_contents($url);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch exchange rate']);
    exit;
}

$data = json_decode($response, true);
if (isset($data['rates'][$target_currency])) {
    $rate = $data['rates'][$target_currency];
    
    $stmt = $conn->prepare("INSERT INTO exchange_rates (base_currency, target_currency, rate, date) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE rate = VALUES(rate)");
    $stmt->bind_param("ssds", $base_currency, $target_currency, $rate, $date);
    $stmt->execute();
    
    echo json_encode(['rate' => (float)$rate, 'cached' => false]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Currency not found']);
}

$conn->close();
?>

