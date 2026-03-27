<?php
require_once 'config.php';

// Generate a fresh bcrypt hash for password "password"
$correct_hash = password_hash('password', PASSWORD_BCRYPT, ['cost' => 10]);

// Update faculty password
$update = $conn->prepare("UPDATE faculty SET password = ? WHERE email = ?");
$email = 'faculty@exam.com';
$update->bind_param("ss", $correct_hash, $email);

if ($update->execute()) {
    echo "<h2 style='color:green;'>✅ Faculty password updated successfully!</h2>";
    echo "<p>Try logging in now:</p>";
    echo "<p><strong>Email:</strong> faculty@exam.com</p>";
    echo "<p><strong>Password:</strong> password</p>";
    echo "<p><a href='faculty/login.php' style='font-size:16px; padding:10px 20px; background:green; color:white; text-decoration:none; border-radius:5px;'>Go to Faculty Login</a></p>";
} else {
    echo "<h2 style='color:red;'>❌ Error updating password</h2>";
    echo "<p>" . $conn->error . "</p>";
}

// Also update student passwords
$students = [
    'student1@exam.com',
    'student2@exam.com',
    'student3@exam.com'
];

echo "<hr>";
echo "<h3>Updating Student Passwords...</h3>";

foreach ($students as $student_email) {
    $update = $conn->prepare("UPDATE students SET password = ? WHERE email = ?");
    $update->bind_param("ss", $correct_hash, $student_email);
    $update->execute();
    echo "<p>✓ Updated: " . $student_email . "</p>";
}

echo "<hr>";
echo "<h3>All passwords updated! Try logging in:</h3>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Role</th><th>Email</th><th>Password</th><th>Login Link</th></tr>";
echo "<tr><td>Faculty</td><td>faculty@exam.com</td><td>password</td><td><a href='faculty/login.php'>Login</a></td></tr>";
echo "<tr><td>Student</td><td>student1@exam.com</td><td>password</td><td><a href='student/login.php'>Login</a></td></tr>";
echo "</table>";
?>
