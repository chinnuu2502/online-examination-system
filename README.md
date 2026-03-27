# Online Examination System - Mini Project

A complete, production-ready Online Examination System built with PHP, MySQL, Bootstrap, and JavaScript.

## 📋 Table of Contents

- [Features](#features)
- [Project Structure](#project-structure)
- [Tech Stack](#tech-stack)
- [Database Schema](#database-schema)
- [Installation & Setup](#installation--setup)
- [How to Use](#how-to-use)
- [Demo Credentials](#demo-credentials)
- [Key Features Explained](#key-features-explained)

---

## ✨ Features

### Student Features
✅ User registration and authentication
✅ Secure login/logout
✅ View available exams (active/upcoming)
✅ Attempt MCQ exams with timer
✅ Real-time countdown timer
✅ Auto-submit when time ends
✅ Manual submission option
✅ Immediate result display
✅ View detailed answer review
✅ Check exam history
✅ View performance statistics

### Faculty/Admin Features
✅ Faculty login and authentication
✅ Create new exams
✅ Edit exam details
✅ Delete exams with cascade delete
✅ Add multiple questions per exam
✅ Edit question details
✅ Delete questions
✅ Set marks per question
✅ View all student attempts
✅ View detailed student results
✅ Analytics dashboard
✅ Pass/Fail analysis

### Technical Features
✅ Secure password hashing (bcrypt)
✅ Session-based authentication
✅ SQL injection prevention (prepared statements)
✅ Responsive design (mobile, tablet, desktop)
✅ Form validation (client & server-side)
✅ Automatic score calculation
✅ Duplicate submission prevention
✅ XAMPP compatible
✅ Clean, modern UI with Bootstrap 5
✅ Real-time exam timer with sound warning

---

## 📁 Project Structure

```
mini/
├── index.php                 # Home page
├── about.php                 # About page
├── contact.php               # Contact page
├── logout.php                # Logout handler
├── config.php                # Database configuration
│
├── css/
│   └── style.css             # Custom styles
│
├── js/
│   └── script.js             # JavaScript utilities & timer
│
├── db/
│   └── schema.sql            # Database schema & sample data
│
├── includes/
│   ├── header.php            # Navigation header
│   ├── footer.php            # Footer
│   └── functions.php         # Helper functions
│
├── student/
│   ├── login.php             # Student login
│   ├── register.php          # Student registration
│   ├── dashboard.php         # Student dashboard
│   ├── exams.php             # Available exams list
│   ├── exam.php              # Exam interface with timer
│   ├── result.php            # Exam result & answer review
│   └── history.php           # Exam history
│
└── faculty/
    ├── login.php             # Faculty login
    ├── dashboard.php         # Faculty dashboard
    ├── create-exam.php       # Create/edit exam
    ├── manage-exams.php      # List all exams
    ├── manage-questions.php  # Add/edit questions
    ├── view-results.php      # View student results
    ├── delete-exam.php       # Delete exam handler
    └── delete-question.php   # Delete question handler
```

---

## 🛠 Tech Stack

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Custom styles with Bootstrap 5
- **Bootstrap 5** - Responsive UI components
- **JavaScript** - DOM manipulation and timer functionality

### Backend
- **PHP 7.4+** - Server-side scripting
- **MySQL/MariaDB** - Database management

### Security
- **Password Hashing** - bcrypt (PHP password_hash)
- **Prepared Statements** - SQL injection prevention
- **Session Management** - Secure user sessions
- **Input Sanitization** - XSS prevention

---

## 🗄 Database Schema

### Tables Overview

#### 1. **faculty** (Admin/Faculty Users)
```sql
- id (PK)
- name
- email (UNIQUE)
- password (hashed)
- phone
- department
- created_at
```

#### 2. **students** (Student Users)
```sql
- id (PK)
- name
- email (UNIQUE)
- password (hashed)
- registration_no (UNIQUE)
- phone
- semester
- branch
- created_at
```

#### 3. **exams** (Exam Details)
```sql
- id (PK)
- title
- subject_name
- description
- total_marks
- duration_minutes
- start_date_time
- end_date_time
- status (Active/Upcoming/Completed)
- created_by (FK → faculty.id)
- created_at
- updated_at
```

#### 4. **questions** (Exam Questions)
```sql
- id (PK)
- exam_id (FK → exams.id)
- question_text
- option_a
- option_b
- option_c
- option_d
- correct_answer (A/B/C/D)
- marks
- created_at
```

#### 5. **exam_attempts** (Student Exam Attempts)
```sql
- id (PK)
- exam_id (FK → exams.id)
- student_id (FK → students.id)
- start_time
- end_time
- total_time_spent_seconds
- score
- total_marks
- percentage
- status (In Progress/Submitted/Completed)
- created_at
- UNIQUE(exam_id, student_id) - Prevents duplicate attempts
```

#### 6. **student_answers** (Student's Answers)
```sql
- id (PK)
- attempt_id (FK → exam_attempts.id)
- question_id (FK → questions.id)
- student_answer (A/B/C/D/N)
- is_correct (bool)
- marks_obtained
- created_at
```

---

## 🚀 Installation & Setup

### Prerequisites
- XAMPP (or similar local server with PHP & MySQL)
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Step 1: Download/Clone Project
Place the `mini` folder in your XAMPP `htdocs` directory:
```
C:\xampp\htdocs\mini\
```

### Step 2: Start XAMPP
1. Open XAMPP Control Panel
2. Start **Apache** server
3. Start **MySQL** server

### Step 3: Create Database
1. Open **phpMyAdmin** (http://localhost/phpmyadmin)
2. Create a new database named `online_exam_system`
3. Go to the **Import** tab
4. Upload the `db/schema.sql` file
5. Click **Import**

### Step 4: Configure Database
Edit `config.php` if needed (usually no changes required):
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');      // Default XAMPP user
define('DB_PASS', '');          // Default XAMPP password (empty)
define('DB_NAME', 'online_exam_system');
```

### Step 5: Access the Application
Open your browser and navigate to:
```
http://localhost/mini/
```

---

## 👥 Demo Credentials

### Student Login
- **Email:** student1@exam.com
- **Password:** password

Alternative students:
- **Email:** student2@exam.com (Priya Singh)
- **Email:** student3@exam.com (Amit Patel)

### Faculty Login
- **Email:** faculty@exam.com
- **Password:** password

---

## 📖 How to Use

### For Students

1. **Register/Login**
   - Click "Student Login" on home page
   - Enter credentials or register new account
   - Fill registration details including semester and branch

2. **View Available Exams**
   - Go to "Available Exams" from student dashboard
   - See all active and upcoming exams
   - Only active exams can be attempted

3. **Attend Exam**
   - Click "Start Exam" on any active exam
   - Read each question and select an answer
   - Timer counts down automatically
   - Exam auto-submits when time ends

4. **Review Results**
   - Immediate result display after submission
   - See score, percentage, and pass/fail status
   - Review all answers with correct answers highlighted
   - Check exam history anytime

### For Faculty/Admin

1. **Login**
   - Click "Faculty Login" on home page
   - Enter faculty credentials

2. **Create Exam**
   - Go to "Manage Exams" → "Create New Exam"
   - Enter exam title, subject, marks, duration
   - Set start and end date/time
   - System automatically sets status (Upcoming/Active/Completed)

3. **Add Questions**
   - After creating exam, click "Questions"
   - Click "Add Question"
   - Enter question text and all 4 options
   - Select correct answer
   - Set marks for the question
   - Repeat for all questions

4. **Edit/Delete Exams or Questions**
   - Go to "Manage Exams"
   - Click "Edit" or "Questions" for any exam
   - Edit exam details or individual questions
   - Delete using danger button (with confirmation)

5. **View Results**
   - Go to "View Results"
   - See all student attempts for your exams
   - Check statistics: total attempts, average score, pass rate
   - View individual student performance

---

## 🔑 Key Features Explained

### 1. **Real-Time Exam Timer**
- Countdown timer starts when student enters exam
- Display in format MM:SS
- Changes color (red) when less than 5 minutes remain
- Auto-saves answers periodically (can be implemented)
- Auto-submits exam when time ends

### 2. **Score Calculation**
- Automatic score calculation after submission
- Correct answer = full marks
- Incorrect/unanswered = 0 marks
- Percentage calculated from total marks
- Pass if ≥ 40% (configurable)

### 3. **Duplicate Submission Prevention**
- One attempt per student per exam using UNIQUE constraint
- Students cannot take exam twice
- Prevents inflated results

### 4. **Security Features**
- Passwords hashed with bcrypt
- SQL injection prevention via prepared statements
- Session timeout (30 minutes default)
- Input sanitization to prevent XSS
- Login required pages use requireLogin()
- Faculty can only see/manage own exams

### 5. **Responsive Design**
- Mobile-first Bootstrap framework
- Works on all screen sizes
- Touch-friendly buttons and forms
- Collapsible sidebar on mobile
- Tables scroll horizontally on small screens

### 6. **User-Friendly Interface**
- Clean, modern design
- Intuitive navigation
- Clear visual feedback
- Error messages displayed
- Success notifications
- Progress indicators

---

## ⚙️ Database Connection Test

To verify the connection is working:
1. Open any page and check if you can login
2. If you see "Connection failed" error, check:
   - XAMPP MySQL is running
   - Database `online_exam_system` exists
   - config.php has correct credentials
   - PHP error logs in XAMPP

---

## 📝 Important Functions in functions.php

| Function | Purpose |
|----------|---------|
| `isLoggedIn()` | Check if user is logged in |
| `isStudent()` / `isFaculty()` | Check user type |
| `requireLogin($type)` | Redirect if not logged in |
| `hashPassword()` | Hash password securely |
| `verifyPassword()` | Verify password against hash |
| `sanitize()` | Prevent XSS attacks |
| `getExamStatus()` | Get exam status (Active/Upcoming/Completed) |
| `calculatePercentage()` | Calculate exam percentage |
| `getPassFailStatus()` | Determine pass/fail |
| `getExamQuestions()` | Get all questions for exam |

---

## 🐛 Troubleshooting

### Issue: "Connection failed"
**Solution:** 
- Start MySQL in XAMPP Control Panel
- Verify database exists
- Check config.php credentials

### Issue: "Invalid password" on login
**Solution:**
- Use demo credentials (student1@exam.com / password)
- All demo accounts have password: "password"

### Issue: Exam timer not showing
**Solution:**
- Check browser console for JavaScript errors
- Verify js/script.js is loading
- Try different browser

### Issue: Can't submit exam answers
**Solution:**
- Ensure exam is active (between start and end time)
- Clear browser cache
- Check PHP error logs

---

## 📊 Project Statistics

- **Total Files:** 28
- **Total Lines of Code:** ~3500+
- **Database Tables:** 6
- **Student Pages:** 6
- **Faculty Pages:** 7
- **Core Pages:** 4
- **Helper Files:** 3

---

## 🎓 Learning Outcomes

This project demonstrates:
- ✅ Full-stack web development (PHP + MySQL + JS)
- ✅ Secure authentication and authorization
- ✅ Database design and relationships
- ✅ RESTful page design
- ✅ Bootstrap responsive framework
- ✅ JavaScript DOM manipulation
- ✅ Security best practices
- ✅ Code organization and structure

---

## 📄 License

This is a college mini project. Feel free to use and modify for educational purposes.

---

## 👨‍💻 Author

Created as a mini project for college education.

**For Support:** Contact through the Contact page in the application.

---

## Version History

**v1.0** (March 2026)
- Initial release
- All core features implemented
- Responsive design
- Security features included

---

**Happy Coding! 🚀**
