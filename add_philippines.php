<?php
require_once 'config.php';

echo "<h2>Adding Philippines to Database</h2>";

$conn = getDBConnection();

$stmt = $conn->prepare("INSERT INTO countries (code, name, currency_code, currency_symbol) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE name=VALUES(name), currency_code=VALUES(currency_code), currency_symbol=VALUES(currency_symbol)");
$stmt->bind_param("ssss", $code, $name, $currency_code, $currency_symbol);

$code = 'PH';
$name = 'Philippines';
$currency_code = 'PHP';
$currency_symbol = '₱';

if ($stmt->execute()) {
    echo "<p style='color: green;'>✓ Philippines added successfully!</p>";
    echo "<p>Country Code: PH</p>";
    echo "<p>Currency: PHP (₱)</p>";
} else {
    echo "<p style='color: red;'>✗ Error: " . $stmt->error . "</p>";
}

$stmt->close();

$result = $conn->query("SELECT * FROM countries WHERE code = 'PH'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<hr>";
    echo "<h3>Verification:</h3>";
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

$conn->close();

echo "<hr>";
echo "<p><a href='index.php'>Go to Inflation Calculator</a></p>";
?>

