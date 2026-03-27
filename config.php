<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'online_exam_system');

// Site Configuration
define('SITE_URL', 'http://localhost/mini/');
define('SITE_NAME', 'Online Examination System');
define('SESSION_TIMEOUT', 1800); // 30 minutes in seconds

// Create database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection - provide detailed error
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error . 
        "<br><br>Please ensure:<br>1. MySQL is running<br>2. Database 'online_exam_system' exists<br>3. User 'root' has access");
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Session timeout check
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
        session_destroy();
        header("Location: " . SITE_URL);
        exit();
    }
    $_SESSION['last_activity'] = time();
}
?>
