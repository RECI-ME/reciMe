<?php
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
