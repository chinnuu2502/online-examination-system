<?php
require_once 'config.php';
require_once 'includes/functions.php';

// Logout user
if (isLoggedIn()) {
    session_destroy();
}

header("Location: " . SITE_URL . "index.php");
exit();
?>
