<?php
// Include database connection
require_once 'db.php';
require_once 'utility.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = sanitizeInput($_POST['token']);
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Check if passwords match
    if ($new_password !== $confirm_new_password) {
        exit(json_encode(['error' => 'Passwords do not match']));
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Get email from password_resets table using the token
    $stmt = $pdo->prepare("SELECT email FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $reset = $stmt->fetch();

    if (!$reset) {
        exit(json_encode(['error' => 'Invalid token']));
    }

    // Update the user's password in the users table
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$hashed_password, $reset['email']]);

    // Delete the token after use
    $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);

    exit(json_encode(['success' => 'Password updated successfully']));
}
?>
