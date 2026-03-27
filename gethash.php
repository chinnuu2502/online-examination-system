<?php
// Ultra simple - just show the correct hash

$password = 'password';
$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

header('Content-Type: text/plain');

echo "CORRECT PASSWORD HASH FOR 'password':\n\n";
echo $hash;
echo "\n\n";
echo "INSTRUCTIONS:\n";
echo "1. Go to: http://localhost/phpmyadmin\n";
echo "2. Click: online_exam_system (database)\n";
echo "3. Click: faculty (table)\n";
echo "4. Find row with: faculty@exam.com\n";
echo "5. Click the 'Edit' button (pencil icon)\n";
echo "6. In the 'password' field, delete everything\n";
echo "7. Copy-paste this ENTIRE hash:\n\n";
echo $hash;
echo "\n\n";
echo "8. Click 'Go' button to save\n";
echo "9. Visit: http://localhost/mini/faculty/login.php\n";
echo "10. Use: faculty@exam.com / password\n";
?>
