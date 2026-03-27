# ⚡ QUICK START GUIDE

Get the system running in **5 minutes**!

---

## 🚀 TL;DR (Too Long; Didn't Read)

### In 5 Steps:

**1. Place Project Folder**
```
Copy "mini" folder to: C:\xampp\htdocs\
```

**2. Start Services**
```
XAMPP Control Panel:
- Start Apache ✓
- Start MySQL ✓
```

**3. Create Database**
```
Go to: http://localhost/phpmyadmin
- Create DB: "online_exam_system"
- Import: mini/db/schema.sql
```

**4. Open Application**
```
Browser: http://localhost/mini/
```

**5. Login & Test**
```
Student: student1@exam.com / password
Faculty: faculty@exam.com / password
```

**Done! ✅**

---

## 📍 Step-by-Step Quick Setup

### Step 1: Folder Placement
```
Windows:
C:\xampp\htdocs\mini\

Mac:
/Applications/XAMPP/htdocs/mini/

Linux:
/opt/lampp/htdocs/mini/
```

### Step 2: Start XAMPP
```
Windows & Mac:
→ Open XAMPP Control Panel
→ Click "Start" next to Apache
→ Click "Start" next to MySQL
→ Wait for green checkmarks

Linux Terminal:
sudo /opt/lampp/lampp start
```

### Step 3: Create Database
**Easiest Method:**

1. Open: `http://localhost/phpmyadmin`
2. Click "New" (left sidebar)
3. Name: `online_exam_system`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"
6. Now select the database
7. Click "Import" tab
8. Browse and select: `C:/xampp/htdocs/mini/db/schema.sql`
9. Click "Import"
10. See success message ✅

### Step 4: Open Application
```
Desktop Browser → http://localhost/mini/

Should show: Blue hero section with navigation
```

### Step 5: Test Login
```
Student Login:
URL: http://localhost/mini/student/login.php
Email: student1@exam.com
Password: password
Button: Login

Faculty Login:
URL: http://localhost/mini/faculty/login.php
Email: faculty@exam.com
Password: password
Button: Login
```

---

## ✅ Quick Verification

After each step, verify:

**After Step 2 (Services):**
```
XAMPP Control Panel should show:
✓ Apache (green)
✓ MySQL (green)
```

**After Step 3 (Database):**
```
http://localhost/phpmyadmin
→ Left panel should show: "online_exam_system"
→ Click it
→ Should see 6 tables if import worked
```

**After Step 4 (Open App):**
```
http://localhost/mini/
→ Should see colorful hero section
→ Navigation bar visible
→ No errors on page
```

**After Step 5 (Login):**
```
Click "Student Login" or "Faculty Login"
→ Should show login form
→ Use demo credentials above
→ Should redirect to dashboard
```

---

## 🧪 Quick Test Workflow

### Test as Student (5 minutes)

1. **Login**
   - Go to http://localhost/mini/student/login.php
   - Email: `student1@exam.com`
   - Password: `password`
   - Click: "Login"

2. **See Dashboard**
   - Should show stats cards
   - Click: "Available Exams"

3. **Browse Exams**
   - Should see exam list
   - Look for exam with "Active" badge
   - If none active, create one as faculty first

4. **Take Exam** (if active exam exists)
   - Click: "Start Exam"
   - Answer questions
   - Click: "Submit Exam"
   - View score immediately

### Test as Faculty (5 minutes)

1. **Login**
   - Go to http://localhost/mini/faculty/login.php
   - Email: `faculty@exam.com`
   - Password: `password`
   - Click: "Login"

2. **Create Exam**
   - Click: "Create New Exam"
   - Title: "Quick Test"
   - Subject: "General"
   - Marks: "100"
   - Duration: "30"
   - Start: (Set to now or future)
   - End: (Set 1 hour from start)
   - Click: "Create Exam"

3. **Add Questions**
   - Click "Add Question" link
   - Question: "What is 2+2?"
   - Options: A) 3, B) 4, C) 5, D) 6
   - Correct: B
   - Marks: 5
   - Click: "Add Question"
   - Repeat 3-4 times

4. **View Results**
   - Click: "View Results"
   - Should show any student attempts

---

## 🆘 If Something Goes Wrong

### Problem: "Connection failed"
**Solution:**
1. Check MySQL is running (green in XAMPP)
2. Check database exists: http://localhost/phpmyadmin
3. Restart MySQL in XAMPP

### Problem: "Invalid email" at login
**Solution:**
1. Make sure database imported successfully
2. Try demo email exactly: `student1@exam.com`
3. Check password: `password`

### Problem: Blue background missing / Ugly design
**Solution:**
1. Hard refresh: Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac)
2. Check: http://localhost/mini/css/style.css loads
3. Clear browser cache

### Problem: Exam timer not showing
**Solution:**
1. Open browser console: F12
2. Look for JavaScript errors
3. Check: http://localhost/mini/js/script.js loads
4. Try different browser

### Problem: "Access denied" error
**Solution:**
1. Check MySQL password in config.php
2. For XAMPP default: user is "root", password is ""
3. Verify database user has access to database

---

## 📱 Test on Phone/Tablet

1. **Find Your Computer IP**
   ```
   Windows Command Prompt:
   ipconfig
   Look for: IPv4 Address (e.g., 192.168.1.100)
   
   Mac Terminal:
   ifconfig | grep inet
   ```

2. **Open on Mobile**
   ```
   Phone browser: http://192.168.1.100/mini/
   (Replace IP with your computer's IP)
   ```

3. **Test Responsiveness**
   ```
   ✓ Navigation should collapse
   ✓ Sidebar should be hamburger menu
   ✓ Buttons should be touch-friendly
   ✓ Tables should scroll horizontally
   ```

---

## 🎯 Key URLs Reference

| Page | URL |
|------|-----|
| Home | http://localhost/mini/ |
| About | http://localhost/mini/about.php |
| Contact | http://localhost/mini/contact.php |
| Student Login | http://localhost/mini/student/login.php |
| Student Register | http://localhost/mini/student/register.php |
| Student Dashboard | http://localhost/mini/student/dashboard.php |
| Available Exams | http://localhost/mini/student/exams.php |
| Take Exam | http://localhost/mini/student/exam.php?id=1 |
| View Results | http://localhost/mini/student/result.php?exam_id=1 |
| Exam History | http://localhost/mini/student/history.php |
| Faculty Login | http://localhost/mini/faculty/login.php |
| Faculty Dashboard | http://localhost/mini/faculty/dashboard.php |
| Create Exam | http://localhost/mini/faculty/create-exam.php |
| Manage Exams | http://localhost/mini/faculty/manage-exams.php |
| Manage Questions | http://localhost/mini/faculty/manage-questions.php?exam_id=1 |
| View Results | http://localhost/mini/faculty/view-results.php |
| phpMyAdmin | http://localhost/phpmyadmin |

---

## 📚 Documentation Quick Links

| Document | Purpose |
|----------|---------|
| README.md | Full feature overview |
| SETUP.md | Detailed installation |
| ARCHITECTURE.md | System design |
| FILES_OVERVIEW.md | File structure |
| QUICK_START.md | This file! ⚡ |

---

## 💡 Tips & Tricks

### Make Exam Active Now
```php
// In faculty/create-exam.php
// Set Start Date/Time to: NOW or past time
// Set End Date/Time to: future time

Why? Exam status is auto-based on current time:
- If NOW() < start: "Upcoming"
- If start ≤ NOW() ≤ end: "Active"  ← This one allows taking exam
- If NOW() > end: "Completed"
```

### Create Multiple Test Accounts
```sql
Students can register themselves:
http://localhost/mini/student/register.php

Or add directly in database:
INSERT INTO students (name, email, password, registration_no, semester, branch)
VALUES
('Test Student', 'test@exam.com', '$2y$10$...hashed_password...', 'TS001', 4, 'CSE');
```

### Reset All Data
```sql
// Delete all attempts and answers
DELETE FROM student_answers;
DELETE FROM exam_attempts;
DELETE FROM questions;
DELETE FROM exams;
DELETE FROM students;

// Re-import schema.sql to restore sample data
```

---

## 🎓 Next Steps After Setup

1. **Read Full Documentation**
   - README.md - Overview & features
   - SETUP.md - Detailed setup
   - ARCHITECTURE.md - How system works

2. **Explore the Code**
   - Look at student/exam.php (see how exam works)
   - Look at faculty/create-exam.php (see admin features)
   - Look at includes/functions.php (utility functions)

3. **Customize for Your College**
   - Update home page with college name
   - Add college logo
   - Modify database with real student data
   - Adjust pass percentage in functions.php

4. **Deploy to Server**
   - Get web hosting (with PHP + MySQL)
   - Upload files via FTP
   - Change database credentials for server
   - Enable HTTPS

---

## 🚨 Important Reminders

✅ **DO THIS FIRST:**
- [ ] Place mini folder in htdocs
- [ ] Start Apache & MySQL
- [ ] Import database schema
- [ ] Test login with demo accounts

❌ **DON'T DO THIS:**
- Don't make config.php public (has db credentials)
- Don't delete schema.sql before importing
- Don't change database name without updating config.php
- Don't use default password in production

---

## ✨ You're All Set!

Everything should be working now. Enjoy the system! 🎉

For detailed help, see: **README.md**
For deployment help, see: **SETUP.md**
For architecture details, see: **ARCHITECTURE.md**

---

**Questions? Check the error logs:**
```
XAMPP → Apache → Logs → error.log
Or
http://localhost/phpmyadmin → Database errors at bottom
Or
Browser Console: F12 → Check for JavaScript errors
```

**Happy Teaching! 🎓**
