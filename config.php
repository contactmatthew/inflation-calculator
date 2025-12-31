<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'inflation_calculator');

define('EXCHANGE_RATE_API_KEY', 'free');
define('EXCHANGE_RATE_API_URL', 'https://api.exchangerate-api.com/v4/latest/');

define('INFLATION_API_URL', 'https://www.statbureau.org/calculate-inflation-rate-json');
define('CACHE_EXPIRY_DAYS', 7);

function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>

