<?php
// Include database connection
require_once 'db.php';
require_once 'utility.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        exit(json_encode(['error' => 'Passwords do not match']));
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email or username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);
    $existing_user = $stmt->fetch();

    if ($existing_user) {
        exit(json_encode(['error' => 'Email or Username already exists']));
    }

    // Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute([$name, $email, $username, $hashed_password]);

    if ($result) {
        exit(json_encode(['success' => 'Account created successfully']));
    } else {
        exit(json_encode(['error' => 'Registration failed']));
    }
}
?>
