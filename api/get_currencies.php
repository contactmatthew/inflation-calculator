<?php
header('Content-Type: application/json');
require_once '../config.php';

$conn = getDBConnection();
$result = $conn->query("SELECT DISTINCT currency_code, currency_symbol FROM countries ORDER BY currency_code");

$currencies = [];
while ($row = $result->fetch_assoc()) {
    $currencies[] = $row;
}

echo json_encode($currencies);
$conn->close();
?>

