<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './config.php';

echo "<h2>Password Debug & Reset</h2>";

// Generate fresh correct hash
$plain_password = 'password';
$correct_hash = password_hash($plain_password, PASSWORD_BCRYPT, ['cost' => 10]);

echo "<p><strong>Testing password verification:</strong></p>";
echo "<p>Plain password: <code>password</code></p>";
echo "<p>Generated hash: <code>" . $correct_hash . "</code></p>";

// Test verification
if (password_verify($plain_password, $correct_hash)) {
    echo "<p style='color:green; font-weight:bold;'>✅ Hash verification works!</p>";
} else {
    echo "<p style='color:red; font-weight:bold;'>❌ Hash verification failed!</p>";
}

echo "<hr>";
echo "<h3>Fixing Faculty Account...</h3>";

// Update faculty with new hash
$update_query = "UPDATE faculty SET password = ? WHERE email = 'faculty@exam.com'";
$stmt = $conn->prepare($update_query);

if (!$stmt) {
    echo "<p style='color:red;'>❌ Prepare failed: " . $conn->error . "</p>";
} else {
    $stmt->bind_param("s", $correct_hash);
    
    if ($stmt->execute()) {
        echo "<p style='color:green; font-weight:bold;'>✅ Faculty password updated!</p>";
        
        // Verify it was updated
        $check_stmt = $conn->prepare("SELECT password FROM faculty WHERE email = 'faculty@exam.com'");
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        $row = $result->fetch_assoc();
        
        echo "<p><strong>Password in database:</strong> <code>" . substr($row['password'], 0, 20) . "...</code></p>";
        
        // Test if new password works
        if (password_verify('password', $row['password'])) {
            echo "<p style='color:green; font-weight:bold;'>✅ Password verification PASSED! Login should work now.</p>";
        } else {
            echo "<p style='color:red; font-weight:bold;'>❌ Password verification FAILED!</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ Update failed: " . $stmt->error . "</p>";
    }
}

echo "<hr>";
echo "<h3>Now Try Login:</h3>";
echo "<p><strong>Email:</strong> faculty@exam.com</p>";
echo "<p><strong>Password:</strong> password</p>";
echo "<p><a href='faculty/login.php' style='font-size:16px; padding:10px 20px; background:green; color:white; text-decoration:none; border-radius:5px; display:inline-block;'>Go to Faculty Login →</a></p>";
?>

