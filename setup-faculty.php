<?php
require_once 'config.php';

echo "<h2>Setting up Faculty Account...</h2>";

// Check if faculty exists
$check = $conn->query("SELECT COUNT(*) as count FROM faculty");
$result = $check->fetch_assoc();

if ($result['count'] > 0) {
    echo "<p style='color:orange;'>⚠️ Faculty account already exists. Updating password...</p>";
    $conn->query("DELETE FROM faculty");
} else {
    echo "<p>✓ No existing faculty accounts found.</p>";
}

// Create correct bcrypt hash
$password_hash = password_hash('password', PASSWORD_BCRYPT, ['cost' => 10]);

// Insert faculty
$query = "INSERT INTO faculty (name, email, password, phone, department) VALUES (
    'Dr. John Smith',
    'faculty@exam.com',
    '" . $conn->real_escape_string($password_hash) . "',
    '9876543210',
    'Computer Science'
)";

if ($conn->query($query)) {
    echo "<p style='color:green;'>✅ Faculty account created successfully!</p>";
    echo "<p><strong>Email:</strong> faculty@exam.com</p>";
    echo "<p><strong>Password:</strong> password</p>";
    echo "<p><a href='faculty/login.php'>← Go to Faculty Login</a></p>";
} else {
    echo "<p style='color:red;'>❌ Error: " . $conn->error . "</p>";
}

// Also setup students
echo "<hr>";
echo "<h3>Setting up Student Accounts...</h3>";

$conn->query("DELETE FROM students");

$students = [
    ['Raj Kumar', 'student1@exam.com', 'CS2001', '9123456789'],
    ['Priya Singh', 'student2@exam.com', 'CS2002', '9123456788'],
    ['Amit Patel', 'student3@exam.com', 'CS2003', '9123456787']
];

foreach ($students as $student) {
    $student_hash = password_hash('password', PASSWORD_BCRYPT, ['cost' => 10]);
    $query = "INSERT INTO students (name, email, password, registration_no, phone, semester, branch) VALUES (
        '" . $conn->real_escape_string($student[0]) . "',
        '" . $conn->real_escape_string($student[1]) . "',
        '" . $conn->real_escape_string($student_hash) . "',
        '" . $conn->real_escape_string($student[2]) . "',
        '" . $conn->real_escape_string($student[3]) . "',
        4,
        'CSE'
    )";
    
    if ($conn->query($query)) {
        echo "<p>✓ Created: " . $student[0] . " (" . $student[1] . ")</p>";
    } else {
        echo "<p style='color:red;'>❌ Error for " . $student[0] . ": " . $conn->error . "</p>";
    }
}

echo "<hr>";
echo "<h3>Login Credentials:</h3>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Role</th><th>Email</th><th>Password</th><th>Link</th></tr>";
echo "<tr>
    <td><strong>Faculty</strong></td>
    <td>faculty@exam.com</td>
    <td>password</td>
    <td><a href='faculty/login.php'>Login →</a></td>
</tr>";
echo "<tr>
    <td><strong>Student 1</strong></td>
    <td>student1@exam.com</td>
    <td>password</td>
    <td><a href='student/login.php'>Login →</a></td>
</tr>";
echo "<tr>
    <td><strong>Student 2</strong></td>
    <td>student2@exam.com</td>
    <td>password</td>
    <td><a href='student/login.php'>Login →</a></td>
</tr>";
echo "<tr>
    <td><strong>Student 3</strong></td>
    <td>student3@exam.com</td>
    <td>password</td>
    <td><a href='student/login.php'>Login →</a></td>
</tr>";
echo "</table>";

echo "<br><br>";
echo "<p><strong>⚠️ NOTE:</strong> After testing, delete this file for security:</p>";
echo "<p>Delete: C:\\xampp\\htdocs\\mini\\setup-faculty.php</p>";
?>
