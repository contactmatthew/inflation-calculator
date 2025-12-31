<?php
header('Content-Type: application/json');
require_once '../config.php';

$conn = getDBConnection();
$result = $conn->query("SELECT code, name, currency_code, currency_symbol FROM countries ORDER BY name");

$countries = [];
while ($row = $result->fetch_assoc()) {
    $countries[] = $row;
}

echo json_encode($countries);
$conn->close();
?>

