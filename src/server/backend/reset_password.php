<?php
// Include database connection
require_once 'db.php';
require_once 'utility.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);

    // Check if email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        exit(json_encode(['error' => 'Email not found']));
    }

    // Generate token and expiration
    $token = bin2hex(random_bytes(50));
    $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Store token in password_resets table
    $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$email, $token, $expires_at]);

    // Send email with reset link (fake function here)
    sendPasswordResetEmail($email, $token);

    exit(json_encode(['success' => 'Password reset link has been sent to your email']));
}

function sendPasswordResetEmail($email, $token) {
    // For the purpose of this exercise, we'll pretend to send the email
    $resetLink = "http://yourwebsite.com/reset_password_form.php?token=" . $token;
    // Normally, you'd use a mail function here
    echo "Password reset link: " . $resetLink;
}
?>
