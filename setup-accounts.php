<?php
require_once 'config.php';

echo "<h1>Faculty Account Setup</h1>";

// First, delete old faculty account
$conn->query("DELETE FROM faculty WHERE email = 'faculty@exam.com'");
echo "<p>✓ Cleared old accounts</p>";

// Create brand new faculty account with a verified hash
$hash = password_hash('password', PASSWORD_BCRYPT, ['cost' => 10]);

$insert = $conn->prepare("INSERT INTO faculty (name, email, password, phone, department) VALUES (?, ?, ?, ?, ?)");
$name = "Dr. John Smith";
$email = "faculty@exam.com";
$phone = "9876543210";
$department = "Computer Science";

$insert->bind_param("sssss", $name, $email, $hash, $phone, $department);

if ($insert->execute()) {
    echo "<p style='color: green; font-weight: bold;'>✅ Faculty account created with FRESH hash!</p>";
    
    // Verify the hash works
    $select = $conn->query("SELECT password FROM faculty WHERE email = 'faculty@exam.com'");
    $row = $select->fetch_assoc();
    $stored_hash = $row['password'];
    
    if (password_verify('password', $stored_hash)) {
        echo "<p style='color: green; font-weight: bold;'>✅ Hash verification PASSED!</p>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>❌ Hash verification FAILED!</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
}

echo "<hr>";
echo "<h2>Login Now:</h2>";
echo "<p><strong>Email:</strong> faculty@exam.com</p>";
echo "<p><strong>Password:</strong> password</p>";
echo "<p><a href='faculty/login.php' style='padding: 10px 20px; background: green; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;'>Go to Faculty Login →</a></p>";

// Also setup students
echo "<hr>";
echo "<h2>Setting up Student Accounts...</h2>";

$conn->query("DELETE FROM students");

$students = [
    ['Raj Kumar', 'student1@exam.com', 'CS2001', '9123456789'],
    ['Priya Singh', 'student2@exam.com', 'CS2002', '9123456788'],
    ['Amit Patel', 'student3@exam.com', 'CS2003', '9123456787']
];

foreach ($students as $student) {
    $student_hash = password_hash('password', PASSWORD_BCRYPT, ['cost' => 10]);
    $stmt = $conn->prepare("INSERT INTO students (name, email, password, registration_no, phone, semester, branch) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $name = $student[0];
    $email = $student[1];
    $reg_no = $student[2];
    $phone = $student[3];
    $semester = 4;
    $branch = "CSE";
    
    $stmt->bind_param("sssssss", $name, $email, $student_hash, $reg_no, $phone, $semester, $branch);
    $stmt->execute();
    echo "<p>✓ Created: " . $student[0] . " (" . $student[1] . ")</p>";
}

echo "<hr>";
echo "<h2>All Demo Accounts Ready:</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Role</th><th>Email</th><th>Password</th><th>Login</th></tr>";
echo "<tr><td><strong>Faculty</strong></td><td>faculty@exam.com</td><td>password</td><td><a href='faculty/login.php'>Login</a></td></tr>";
echo "<tr><td>Student 1</td><td>student1@exam.com</td><td>password</td><td><a href='student/login.php'>Login</a></td></tr>";
echo "<tr><td>Student 2</td><td>student2@exam.com</td><td>password</td><td><a href='student/login.php'>Login</a></td></tr>";
echo "<tr><td>Student 3</td><td>student3@exam.com</td><td>password</td><td><a href='student/login.php'>Login</a></td></tr>";
echo "</table>";
?>
