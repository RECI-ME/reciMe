<?php
// Include database connection and session management
require_once 'db.php';
require_once 'utility.php';
require_once 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];

    // Check if the user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Set session for user
        startSession($user['id'], $username);
        exit(json_encode(['success' => 'Login successful']));
    } else {
        exit(json_encode(['error' => 'Invalid username or password']));
    }
}
?>
