<?php
require_once 'db.php';
require_once 'utility.php';
require_once 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        exit(json_encode(['error' => 'Invalid CSRF token']));
    }

    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        startSession($user['id'], $username);
        exit(json_encode(['success' => 'Login successful']));
    } else {
        exit(json_encode(['error' => 'Invalid username or password']));
    }
}
?>
