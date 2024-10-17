<?php
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

?>
