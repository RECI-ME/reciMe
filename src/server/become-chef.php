<?php
require 'db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('UPDATE users SET is_chef = 1 WHERE id = :user_id');
    $stmt->execute(['user_id' => $user_id]);

    echo "Congratulations! You've become a Chef!";
    header('Location: ../dashboard.php');
} else {
    echo "You need to log in first!";
}
?>
