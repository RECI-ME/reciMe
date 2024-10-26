<?php

require_once 'db.php';
require_once 'utility.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = sanitizeInput($_POST['token']);
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

   
    if ($new_password !== $confirm_new_password) {
        exit(json_encode(['error' => 'Passwords do not match']));
    }

 
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

   
    $stmt = $pdo->prepare("SELECT email FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $reset = $stmt->fetch();

    if (!$reset) {
        exit(json_encode(['error' => 'Invalid token']));
    }

   
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$hashed_password, $reset['email']]);

    
    $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);

    exit(json_encode(['success' => 'Password updated successfully']));
}
?>
