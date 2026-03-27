# 📖 Complete Setup Guide - Online Examination System

## Prerequisites

Before starting, ensure you have:
- **XAMPP** installed (or Apache + PHP + MySQL)
- **PHP 7.4** or higher
- **MySQL 5.7** or higher
- A modern web browser
- Basic understanding of web technologies

---

## 🔧 Installation Steps

### Part 1: Download & Place Project

1. **Find XAMPP Installation**
   - Typically in: `C:\xampp` or `D:\xampp`

2. **Locate htdocs Folder**
   - Path: `C:\xampp\htdocs\` (on Windows)
   - macOS: `/Applications/XAMPP/htdocs/`
   - Linux: `/opt/lampp/htdocs/`

3. **Place Project Files**
   - Extract or copy the entire `mini/` folder
   - Full path should be: `C:\xampp\htdocs\mini\`
   - Files inside mini folder:
     ```
     mini/
     ├── index.php
     ├── config.php
     ├── db/
     ├── student/
     ├── faculty/
     ├── css/
     ├── js/
     └── ... (other files)
     ```

---

### Part 2: Start XAMPP Services

#### Windows

1. **Open XAMPP Control Panel**
   - Click Start Menu → Search "XAMPP Control Panel"
   - Or navigate to: `C:\xampp\xampp-control.exe`

2. **Start Services**
   ```
   Apache → Click "Start" button
   MySQL  → Click "Start" button
   ```
   - Wait for green checkmarks
   - If red X appears, try "Stop" then "Start" again

#### macOS

```bash
sudo /Applications/XAMPP/xamppfiles/mampp start
# Or use XAMPP Manager from Applications folder
```

#### Linux

```bash
sudo /opt/lampp/lampp start
```

---

### Part 3: Create Database

#### Method 1: Using phpMyAdmin (Easiest)

1. **Open phpMyAdmin**
   - Open browser and go to: `http://localhost/phpmyadmin`
   - Or: `http://localhost:8080/phpmyadmin` (if using port 8080)

2. **Create Database**
   - On left panel, click "New"
   - Database name: `online_exam_system`
   - Collation: `utf8mb4_unicode_ci`
   - Click "Create"

3. **Import Database Schema**
   - Select the database `online_exam_system`
   - Click the "Import" tab
   - Click "Browse File"
   - Navigate to: `mini/db/schema.sql`
   - Click "Import"
   - Wait for success message

4. **Verify Tables**
   - Click on `online_exam_system` database
   - You should see these tables:
     ```
     - faculty
     - students
     - exams
     - questions
     - exam_attempts
     - student_answers
     ```

#### Method 2: Using MySQL Command Line

1. **Open MySQL Command Prompt**
   - Windows: Start Menu → Search "MySQL Command Line"
   - Or use Command Prompt in XAMPP\mysql\bin

2. **Execute Commands**
   ```sql
   mysql -u root -p
   # Press Enter (password is empty)
   CREATE DATABASE online_exam_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   USE online_exam_system;
   SOURCE C:/xampp/htdocs/mini/db/schema.sql;
   # Or on macOS/Linux:
   SOURCE /Applications/XAMPP/htdocs/mini/db/schema.sql;
   ```

3. **Verify**
   ```sql
   SHOW TABLES;
   SELECT COUNT(*) FROM students;
   SELECT COUNT(*) FROM faculty;
   ```

---

### Part 4: Configure Database (If Needed)

Edit `mini/config.php`:

```php
<?php
// Default configuration (usually correct for XAMPP)
define('DB_HOST', 'localhost');      // Keep as is
define('DB_USER', 'root');           // Keep as is  
define('DB_PASS', '');                // Keep empty (XAMPP default)
define('DB_NAME', 'online_exam_system'); // Must match database name
```

⚠️ **Troubleshooting DB Connection:**
- If using different MySQL user: update `DB_USER` and `DB_PASS`
- If MySQL on different port (not 3306): add `:port` to DB_HOST
- Port number: `define('DB_HOST', 'localhost:3307');`

---

### Part 5: Access Application

1. **Open Browser**
   - Chrome, Firefox, Safari, or Edge

2. **Navigate to Application**
   - Home Page: `http://localhost/mini/`
   - Student Login: `http://localhost/mini/student/login.php`
   - Faculty Login: `http://localhost/mini/faculty/login.php`

3. **Expected Result**
   - ✅ Page loads without errors
   - ✅ Navigation bar visible
   - ✅ All links functional

---

## ✅ Verification Checklist

After setup, verify everything works:

- [ ] XAMPP Apache is running (green checkmark)
- [ ] XAMPP MySQL is running (green checkmark)
- [ ] Database `online_exam_system` exists in phpMyAdmin
- [ ] All 6 tables visible in database
- [ ] Homepage loads at `http://localhost/mini/`
- [ ] Student login page accessible
- [ ] Faculty login page accessible
- [ ] Can login with demo credentials (see below)

---

## 👥 Test Login Credentials

### Student Accounts
Use any of these credentials (password is same for all):

| Email | Password | Name |
|-------|----------|------|
| student1@exam.com | password | Raj Kumar |
| student2@exam.com | password | Priya Singh |
| student3@exam.com | password | Amit Patel |

### Faculty Account

| Email | Password | Name |
|-------|----------|------|
| faculty@exam.com | password | Dr. John Smith |

---

## 🧪 Testing the System

### Test Flow 1: Student Journey

1. **Login as Student**
   - Go to: `http://localhost/mini/student/login.php`
   - Email: `student1@exam.com`
   - Password: `password`
   - Expected: Redirects to dashboard

2. **View Dashboard**
   - See statistics and quick info
   - Click "Available Exams"

3. **Browse Exams**
   - See active and upcoming exams
   - Click "Start Exam" for active exams

4. **Take Exam**
   - Timer starts automatically
   - Answer questions by clicking options
   - Submit when done
   - View score immediately

### Test Flow 2: Faculty Journey

1. **Login as Faculty**
   - Go to: `http://localhost/mini/faculty/login.php`
   - Email: `faculty@exam.com`
   - Password: `password`
   - Expected: Redirects to dashboard

2. **Create Exam**
   - Click "Create New Exam"
   - Fill exam details (title, subject, marks, duration)
   - Set start and end date/time (use future dates)
   - Click "Create Exam"

3. **Add Questions**
   - Click "Questions" button
   - Add 3-5 questions
   - Set correct answers and marks
   - Save questions

4. **View Results**
   - Go to "View Results"
   - See all student attempts (if any)
   - View statistics

---

## 🐛 Common Issues & Solutions

### Issue 1: "Connection failed"

**Error Message:**
```
Connection failed: Unknown database 'online_exam_system'
```

**Solutions:**
1. Verify MySQL is running in XAMPP
2. Check database exists in phpMyAdmin
3. Verify database name in config.php
4. Try importing schema.sql again

**Test:**
```
http://localhost/phpmyadmin
→ Left sidebar should show "online_exam_system"
```

---

### Issue 2: "Access Denied for User 'root'"

**Error Message:**
```
Access denied for user 'root'@'localhost'
```

**Cause:** Wrong database credentials

**Solution:**
```php
// In config.php, verify:
define('DB_USER', 'root');      // This should be 'root' for XAMPP
define('DB_PASS', '');          // This should be empty for XAMPP
```

---

### Issue 3: "XAMPP Apache Won't Start"

**Cause:** Port 80 is already in use

**Solutions:**
1. **Change Apache Port**
   - XAMPP Control Panel → Config (Apache)
   - Change port from 80 to 8080
   - Update URL to: `http://localhost:8080/mini/`

2. **Close Other Applications**
   - Check if Skype, IIS, or other services use port 80
   - Close them and restart Apache

3. **Check Error Log**
   - Click "Apache" → "Logs" → "error.log"

---

### Issue 4: Login "Invalid Email" Error

**Cause:** User doesn't exist OR database empty

**Solution:**
1. Verify database has data:
   ```sql
   SELECT * FROM students LIMIT 1;
   SELECT * FROM faculty LIMIT 1;
   ```

2. If empty, re-import schema.sql with sample data

3. Use exact demo credentials (case-sensitive email)

---

### Issue 5: Exam Timer Not Showing

**Cause:** JavaScript error or file not found

**Solution:**
1. Check browser console (F12)
2. Verify `js/script.js` exists
3. Check browser console for 404 errors
4. Try different browser

---

### Issue 6: CSS Not Loading (White Page)

**Cause:** CSS file path incorrect OR browser cache

**Solution:**
1. Clear browser cache (Ctrl+Shift+Del)
2. Hard refresh page (Ctrl+Shift+R or Cmd+Shift+R)
3. Verify `css/style.css` exists
4. Check browser console (F12) for 404 errors

---

## 🔐 Security Notes

### For Production Use

⚠️ **These are IMPORTANT:**

1. **Change Demo Passwords**
   - After testing, change all passwords
   - Use strong passwords (8+ chars, mixed case, numbers)

2. **Update Database Credentials**
   - Don't use default 'root' user
   - Create new MySQL user with limited privileges
   - Update config.php accordingly

3. **Enable HTTPS**
   - Use SSL certificates
   - Redirect HTTP to HTTPS
   - Update SITE_URL in config.php to https://

4. **Move config.php Out of Web Root**
   - Security best practice
   - Prevents accidental access to credentials

5. **Set Proper File Permissions**
   ```bash
   chmod 755 d:/mini
   chmod 644 d:/mini/config.php
   chmod 777 d:/mini/storage/  # If you add file uploads
   ```

---

## 📱 Responsive Testing

### Test on Different Devices

1. **Desktop (1920x1080)**
   - Full sidebar + content layout
   - All features accessible

2. **Tablet (768x1024)**
   - Sidebar collapses
   - Responsive layout
   - Touch-friendly buttons

3. **Mobile (375x667)**
   - Hamburger menu
   - Single column layout
   - Large buttons

**Test using:**
- Browser DevTools (F12)
- Physical devices
- Responsive design simulators

---

## 🎯 Next Steps After Installation

1. **Explore the System**
   - Login as both student and faculty
   - Create a test exam
   - Take the exam as a student
   - View results as faculty

2. **Customize for Your College**
   - Update site name in config.php
   - Add more faculty accounts
   - Modify sample data
   - Adjust pass percentage if needed

3. **Add More Users**
   - Ask students to register
   - Create faculty accounts in database
   - Setup actual exam schedule

4. **Deploy to Server** (For Production)
   - Get web hosting with PHP + MySQL
   - Upload files via FTP
   - Setup database on server
   - Update config.php with server credentials
   - Change admin password
   - Enable HTTPS certificate

---

## 📞 Support & Troubleshooting

### Quick Diagnosis Script

Create file `test.php` in minicot folder:

```php
<?php
echo "<h3>System Diagnostics</h3>";

// PHP Version
echo "PHP Version: " . phpversion() . "<br>";

// MySQL Connection Test
$conn = new mysqli('localhost', 'root', '', 'online_exam_system');
if ($conn->connect_error) {
    echo "❌ Database Error: " . $conn->connect_error . "<br>";
} else {
    echo "✅ Database Connected<br>";
    
    $result = $conn->query("SELECT COUNT(*) as count FROM students");
    $row = $result->fetch_assoc();
    echo "✅ Students in DB: " . $row['count'] . "<br>";
}

// File Permissions
echo "✅ Files accessible<br>";

// Session Support
if (function_exists('session_start')) {
    echo "✅ Sessions enabled<br>";
}
?>
```

Access it: `http://localhost/mini/test.php`

---

## 🎓 Learning Resources

### Documentation Links
- [PHP Manual](https://www.php.net/manual/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.0/)
- [JavaScript MDN](https://developer.mozilla.org/en-US/docs/Web/JavaScript/)

### Recommended Tutorials
- PHP Security: https://owasp.org/www-project-php-security/
- MySQL Optimization: https://dev.mysql.com/doc/refman/5.7/en/optimization.html

---

**Installation Complete! 🎉**

Your Online Examination System is ready to use!

For any questions, refer to the README.md or troubleshooting section above.
