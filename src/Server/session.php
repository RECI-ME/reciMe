<?php
session_start();

function startSession($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
}

function checkSession() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

function endSession() {
    session_unset();
    session_destroy();
}
?>
