<?php

$env = parse_ini_file("../../../env.ini");

if ($env == FALSE) {
    echo "server could not parse env file";
}

$host = $env["DB_SERVER"];
$db_name = $env["DB"];
$username = $env["DB_USERNAME"];
$password = $env["DB_PASSWORD"];


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed. Please try again later.");
}

?>
