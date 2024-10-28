<?php
require_once 'db.php';
require_once 'utility.php';
require_once 'session.php';
require_once 'config.php'; 

function base64UrlEncode($data) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
}

function createJWT($header, $payload, $secret) {
    $headerEncoded = base64UrlEncode(json_encode($header));
    $payloadEncoded = base64UrlEncode(json_encode($payload));
    $signature = hash_hmac('SHA256', "$headerEncoded.$payloadEncoded", $secret, true);
    $signatureEncoded = base64UrlEncode($signature);
    return "$headerEncoded.$payloadEncoded.$signatureEncoded";
}

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
        $header = ['alg' => 'HS256', 'typ' => 'JWT'];
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;
        $payload = [
            'user_id' => $user['id'],
            'username' => $user['username'],
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];

        $jwt = createJWT($header, $payload, JWT_SECRET_KEY); 
        setcookie("auth_token", $jwt, $expirationTime, "/", "", false, true);
        setcookie("username", $user['username'], $expirationTime, "/", "", false, true);
        
        startSession($user['id'], $username);
        exit(json_encode(['success' => 'Login successful']));
    } else {
        exit(json_encode(['error' => 'Invalid username or password']));
    }
}
?>
