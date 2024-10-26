<?php
$host = 'localhost'; // Your database host
$dbName = 'your_database_name'; // Your database name
$user = 'your_username'; // Your database username
$password = 'your_password'; // Your database password

// Create a connection
$conn = new mysqli($host, $user, $password, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
