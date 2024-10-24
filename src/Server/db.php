<?php
// db.php: Database connection script
//change $host, $dbname, $username, $password
$host = 'localhost';
//$port = '3308'; // Ensure this is the correct MySQL port by default it's 3306
$dbname = 'lorem_ipsum'; 
$username = ''; 
$password = ''; // 

try {
    // Create a new PDO instance with the correct port included
    $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    // Set error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
