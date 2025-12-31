<?php
require_once 'config.php';

echo "<h2>Inflation Calculator - Database Setup</h2>";

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === TRUE) {
    echo "<p>✓ Database created or already exists</p>";
} else {
    echo "<p>✗ Error creating database: " . $conn->error . "</p>";
}

$conn->close();

$conn = getDBConnection();

$sql_file = file_get_contents('database.sql');
$sql_statements = explode(';', $sql_file);

foreach ($sql_statements as $statement) {
    $statement = trim($statement);
    if (!empty($statement) && !preg_match('/^--/', $statement)) {
        if ($conn->query($statement) === TRUE) {
        } else {
            if (strpos($conn->error, 'already exists') === false && 
                strpos($conn->error, 'Duplicate entry') === false) {
                echo "<p>⚠ Warning: " . $conn->error . "</p>";
            }
        }
    }
}

echo "<p>✓ Database tables created</p>";
echo "<p>✓ Countries and currencies inserted</p>";

$conn->close();

echo "<h3>Setup Complete!</h3>";
echo "<p><a href='index.php'>Go to Inflation Calculator</a></p>";
?>

