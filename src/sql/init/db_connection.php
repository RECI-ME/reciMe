<?php
session_start();

// Load the .env file
$config = parse_ini_file('../env.ini');

// Create a database connection
$conn = new mysqli($config['DB_HOST'], $config['DB_USER'], $config['DB_PASSWORD'], $config['DB_NAME']);

// Check the connection
if ($conn->connect_error) {
    $_SESSION['error'] = "Database connection failed: " . $conn->connect_error;
    header("Location: ../error.php");
    exit();
}
?>