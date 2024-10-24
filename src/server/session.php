<?php
session_start();

function base64UrlDecode($data) {
    return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
}

function verifyJWT($jwt, $secret) {
    $tokenParts = explode('.', $jwt);
    $header = base64UrlDecode($tokenParts[0]);
    $payload = base64UrlDecode($tokenParts[1]);
    $signatureProvided = $tokenParts[2];

    $base64UrlHeader = base64UrlEncode(json_encode($header));
    $base64UrlPayload = base64UrlEncode(json_encode($payload));
    $signature = hash_hmac('SHA256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
    $base64UrlSignature = base64UrlEncode($signature);

    return ($base64UrlSignature === $signatureProvided) ? json_decode($payload, true) : false;
}

function startSession($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
}

function checkSession() {
    if (!isset($_COOKIE['auth_token'])) {
        header('Location: login.php');
        exit();
    }

    $jwt = $_COOKIE['auth_token'];
    $secret = "your_secret_key";
    $decoded = verifyJWT($jwt, $secret);

    if ($decoded && $decoded['exp'] > time()) {
        $_SESSION['user_id'] = $decoded['user_id'];
        $_SESSION['username'] = $decoded['username'];
    } else {
        header('Location: login.php');
        exit();
    }
}

function endSession() {
    session_unset();
    session_destroy();
    setcookie("auth_token", "", time() - 3600, "/");
}
?>
