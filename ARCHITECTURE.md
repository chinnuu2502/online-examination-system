# 🎯 System Architecture & Workflow Guide

## System Overview

The Online Examination System is built on a 3-tier architecture:

```
┌─────────────────────────────────────────────────────────────┐
│                    PRESENTATION LAYER                       │
│  (HTML, CSS, JavaScript, Bootstrap UI Components)           │
├─────────────────────────────────────────────────────────────┤
│                    APPLICATION LAYER                        │
│  (PHP Business Logic, Session Management, Validation)       │
├─────────────────────────────────────────────────────────────┤
│                     DATA LAYER                              │
│  (MySQL Database, Tables, Relationships, Constraints)       │
└─────────────────────────────────────────────────────────────┘
```

---

## 🔄 Complete User Journey

### STUDENT WORKFLOW

#### 1. Registration Phase
```
Student Home
    ↓
Click "Register" → register.php
    ↓
Fill Registration Form
[name, email, password, semester, branch]
    ↓
Server Validation
- Check email not already registered
- Check registration number unique
- Validate password strength
    ↓
Hash Password (bcrypt)
    ↓
Insert into students table
    ↓
Success → Redirect to login
```

#### 2. Login Phase
```
Student Login Page
    ↓
Enter email + password
    ↓
Query students table by email
    ↓
Verify password_hash
    ↓
Create Session Variables:
- $_SESSION['user_id']
- $_SESSION['user_name']
- $_SESSION['user_email']
- $_SESSION['user_type'] = 'student'
    ↓
Redirect to dashboard.php
```

#### 3. Dashboard
```
student/dashboard.php
    ↓
Display Statistics:
- Total exams taken (COUNT from exam_attempts)
- Exams passed (COUNT where percentage >= 40)
- Average score (AVG of percentages)
    ↓
Show Recent Attempts:
- JOIN exam_attempts with exams
- ORDER BY start_time DESC LIMIT 5
```

#### 4. Browse Exams
```
student/exams.php
    ↓
Query exams SQL:
SELECT * FROM exams WHERE status IN ('Active', 'Upcoming')
    ↓
For each exam, display:
- Title, Subject, Marks, Duration
- Start/End time
- Status badge (Active/Upcoming/Completed)
- Action button:
  * If Active & Not Attempted → "Start Exam" button
  * If Already Attempted → "View Result" button
  * If Upcoming/Completed → Disabled button
```

#### 5. Start Exam
```
Click "Start Exam" → exam.php?id=1
    ↓
Check: Is exam time slot active?
- NOW() BETWEEN start_date_time AND end_date_time
    ↓
Check: Has student already attempted?
- SELECT * FROM exam_attempts (unique constraint)
    ↓
Create exam_attempts record:
- INSERT (exam_id, student_id, status='In Progress')
    ↓
Fetch all questions:
- SELECT * FROM questions WHERE exam_id = ?
    ↓
Render Exam Interface:
- Display countdown timer (JavaScript)
- Display questions one at a time or paginated
- Show options A, B, C, D as radio buttons
- Show instructions and rules
```

#### 6. Taking Exam
```
Student sees question board
    ↓
Select an option
    ↓
Event listener captures selection
    ↓
Store in JavaScript object (or localStorage)
    ↓
Move to next question (repeat)
    ↓
Timer Countdown
- If time reaches 0:
  → Auto-submit form
  → JavaScript triggers submit()
```

#### 7. Submit Exam
```
Form submission via POST
    ↓
Server Side:
- Get all questions for exam
- Get student's answers from POST
    ↓
Calculate Score:
FOR each question:
  - If answer == correct_answer: marks += question.marks
  - Store in student_answers table
    ↓
Calculate Percentage:
percentage = (total_marks_obtained / total_exam_marks) * 100
    ↓
Update exam_attempts table:
- score = X
- total_marks = Y
- percentage = Z
- status = 'Submitted'
- end_time = NOW()
    ↓
Display Result Page
```

#### 8. View Results
```
result.php?exam_id=1
    ↓
Retrieve from exam_attempts:
- Score, total marks, percentage
- Pass/Fail status (based on 40% threshold)
    ↓
Fetch from student_answers:
- Each answer with correct answer
- Mark correct answers
    ↓
Display:
- Score display (animated)
- Statistics cards
- Answer review table
  * Your answer vs Correct answer
  * Marks obtained
```

---

## 👨‍🏫 FACULTY WORKFLOW

#### 1. Faculty Login
```
faculty/login.php
    ↓
Enter email + password
    ↓
Query faculty table
    ↓
Verify password_hash
    ↓
Set session:
- $_SESSION['user_type'] = 'faculty'
- $_SESSION['user_id'] = faculty_id
    ↓
Redirect to dashboard.php
```

#### 2. Dashboard Overview
```
faculty/dashboard.php
    ↓
Display Metrics:
- Total Exams Created (COUNT from exams WHERE created_by)
- Active Exams (WHERE status = 'Active')
- Total Student Attempts (COUNT from exam_attempts)
    ↓
Show Recent Exams:
- List last 5 exams created
- For each: title, subject, status, marks
- Action buttons: Edit, Questions, Delete
```

#### 3. Create Exam - MOST IMPORTANT FEATURE
```
Click "Create New Exam" → create-exam.php
    ↓
Form Fields:
- Exam Title (text)
- Subject Name (text)
- Description (textarea)
- Total Marks (number)
- Duration Minutes (number)
- Start Date/Time (datetime-local)
- End Date/Time (datetime-local)
    ↓
Server Validation:
- Check required fields
- Check marks > 0
- Check duration > 0
- Check end_time > start_time
    ↓
Auto Calculate Status:
IF NOW() < start then: 'Upcoming'
IF start ≤ NOW() ≤ end then: 'Active'
IF NOW() > end then: 'Completed'
    ↓
Insert into exams table:
INSERT (title, subject_name, description, total_marks,
        duration_minutes, start_date_time, end_date_time,
        status, created_by)
    ↓
Success → Redirect to manage-questions.php
alert: "Exam created! Now add questions."
```

#### 4. Manage Exams - List & Edit
```
manage-exams.php
    ↓
Query exams WHERE created_by = current_faculty_id
    ↓
Display table:
| Title | Subject | Status | Marks | Duration | Questions | Actions |
    ↓
Action buttons for each exam:
1. EDIT EXAM
   → create-exam.php?id=X
   → Form pre-filled with exam data
   → UPDATE instead of INSERT
   
2. MANAGE QUESTIONS
   → manage-questions.php?exam_id=X
   → Add/Edit/Delete questions
   
3. DELETE EXAM
   → delete-exam.php?id=X
   → ON DELETE CASCADE removes:
     * All questions for exam
     * All exam_attempts
     * All student_answers
```

#### 5. Add Questions - CORE FUNCTIONALITY
```
manage-questions.php?exam_id=1&add=1
    ↓
Display Form:
- Question Text (textarea)
- Option A (text input)
- Option B (text input)
- Option C (text input)
- Option D (text input)
- Correct Answer (select dropdown)
- Marks per question (number)
    ↓
Validate:
- All text fields filled
- Correct answer is A/B/C/D
- Marks > 0
    ↓
Insert into questions table:
INSERT (exam_id, question_text, option_a, option_b,
        option_c, option_d, correct_answer, marks)
    ↓
Redirect back to manage-questions page
    ↓
Display all questions in list:
Q1: [Preview...] Correct: B | Marks: 1 | [Edit] [Delete]
Q2: [Preview...] Correct: A | Marks: 2 | [Edit] [Delete]
...
```

#### 6. Edit Questions
```
manage-questions.php?exam_id=1&question_id=5
    ↓
SELECT * FROM questions WHERE id = 5
    ↓
Pre-fill form with current values
    ↓
On submit:
UPDATE questions
SET question_text = ?, option_a = ?, ..., marks = ?
WHERE id = 5
    ↓
Redirect with success message
```

#### 7. Delete Questions
```
Click Delete Button
→ Confirmation modal
→ User clicks "Yes"
    ↓
delete-question.php?id=5
    ↓
SELECT question WHERE id = 5
Check exam.created_by = current_faculty_id (security)
    ↓
DELETE FROM questions WHERE id = 5
    ↓
Cascade deletes:
- All student_answers for this question
    ↓
Redirect with success message
```

#### 8. View Student Results - IMPORTANT FOR FEEDBACK
```
view-results.php
    ↓
Query all attempts for faculty's exams:
SELECT student.name, exams.title, exam_attempts.*
FROM exam_attempts
JOIN exams ON exam_attempts.exam_id = exams.id
JOIN students ON exam_attempts.student_id = students.id
WHERE exams.created_by = current_faculty_id
    ↓
Display table with columns:
| Student Name | Exam Title | Score | Percentage | Status | Date |
    ↓
Display Statistics:
- Total Attempts (COUNT)
- Average Score (AVG of percentages)
- Pass Rate (COUNT(>40%) / COUNT(*) * 100)
    ↓
Faculty can analyze:
- Which exams are most difficult
- Which students performed best/worst
- Adjust difficulty of future exams
```

---

## 🔐 Security Implementation

### 1. Authentication Layer
```
Session-based authentication:

┌──────────────────┐
│ User logs in     │
│ Email + Password │
└────────┬─────────┘
         ↓
┌──────────────────────────────┐
│ Query user table by email    │
│ Verify password_hash         │
│ (password_verify function)   │
└────────┬─────────────────────┘
         ↓
┌──────────────────────────────┐
│ Set session variables        │
│ $_SESSION['user_id']         │
│ $_SESSION['user_type']       │
└────────┬─────────────────────┘
         ↓
┌──────────────────────────────┐
│ Session stored on server     │
│ Cookie sent to client        │
│ (PHPSESSID)                  │
└──────────────────────────────┘

On subsequent requests:
├─ Check isset($_SESSION['user_id'])
├─ If not set → redirect to login
├─ If type != required → redirect
└─ Allow page access
```

### 2. SQL Injection Prevention
```
❌ VULNERABLE:
$query = "SELECT * FROM students WHERE email = '" . $_GET['email'] . "'";

✅ SECURE (Prepared Statements):
$query = "SELECT * FROM students WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);  // "s" = string type
$stmt->execute();
$result = $stmt->get_result();
```

### 3. Password Security
```
Storing Passwords:
$password = "MyPassword123"

hash = password_hash($password, PASSWORD_BCRYPT);
// hash: $2y$10$KIX7bJ8K...abc123...

Database stores: $2y$10$KIX7bJ8K...abc123...
(NOT plain password)

Verification:
password_verify($password, $hash) → true/false
```

### 4. Input Sanitization
```
Prevent XSS (Cross-Site Scripting):

Function sanitize($input):
- stripslashes() → Remove escape characters
- trim() → Remove whitespace
- htmlspecialchars() → Convert special chars

Example:
$name = "<script>alert('hack')</script>";
→ sanitize($name)
→ "&lt;script&gt;alert('hack')&lt;/script&gt;"
→ Displays as text, not executed
```

### 5. Authorization Checks
```
Before showing faculty dashboard:
requireLogin('faculty');

Function requireLogin($type):
├─ if not isLoggedIn() → redirect to login
├─ if user_type != $type → redirect to home
└─ else allow access

Prevents:
- Students accessing faculty pages
- Non-logged-in users accessing protected pages
- Faculty accessing student-specific data
```

### 6. Data Integrity
```
Prevent duplicate exam attempts:
CREATE UNIQUE INDEX unique_attempt 
ON exam_attempts(exam_id, student_id);

Prevents:
- Same student attempting same exam twice
- Data consistency
- Fair grading

Foreign Key Constraints:
- exam_attempts.exam_id → exams.id (ON DELETE CASCADE)
- questions.exam_id → exams.id (ON DELETE CASCADE)

Benefits:
- Automatic cleanup when exam deleted
- Prevent orphaned records
- Maintain referential integrity
```

---

## 📊 Database Query Examples

### Getting Active Exams
```sql
SELECT * FROM exams 
WHERE NOW() BETWEEN start_date_time AND end_date_time
AND status = 'Active'
ORDER BY start_date_time ASC;
```

### Getting Student Scores
```sql
SELECT 
  st.name,
  e.title,
  ea.score,
  ea.total_marks,
  ea.percentage,
  CASE WHEN ea.percentage >= 40 THEN 'PASS' ELSE 'FAIL' END as status
FROM exam_attempts ea
JOIN students st ON ea.student_id = st.id
JOIN exams e ON ea.exam_id = e.id
WHERE ea.student_id = ?
ORDER BY ea.start_time DESC;
```

### Getting Exam Statistics
```sql
SELECT 
  COUNT(*) as total_attempts,
  AVG(percentage) as average_score,
  COUNT(IF(percentage >= 40, 1, NULL)) as pass_count,
  ROUND(COUNT(IF(percentage >= 40, 1, NULL)) / COUNT(*) * 100, 2) as pass_rate
FROM exam_attempts ea
JOIN exams e ON ea.exam_id = e.id
WHERE e.created_by = ?;
```

---

## 🎯 Key Decision Points

### When Exam Status is Set
```
STATUS DETERMINATION LOGIC:
- Happens at exam creation OR edit
- Automatic, based on date/time
- Can change over time as dates pass

Pseudocode:
if (NOW() < start_date_time)
  status = 'Upcoming'
else if (NOW() >= start_date_time AND NOW() <= end_date_time)
  status = 'Active'
else
  status = 'Completed'
```

### When Duplicate Submission is Prevented
```
At exam attempt:
1. Check BEFORE creating new exam_attempt record
2. Query: SELECT COUNT(*) FROM exam_attempts 
          WHERE exam_id = ? AND student_id = ?
3. If > 0: Show alert and redirect
4. If 0: Create new record and proceed
```

### When Score is Calculated
```
After exam submission:
1. Get all questions for exam
2. Get all student answers from POST data
3. For each question:
   - if(student_answer == correct_answer)
       score += marks
4. percentage = (score / total_marks) * 100
5. Update exam_attempts with final score
6. Automatically determine pass/fail based on percentage
```

---

## 🚀 Performance Considerations

### Indexing Strategy
```
Indexes created on:
- exams(status) → Faster status queries
- exams(created_by) → Faster faculty-specific queries
- questions(exam_id) → Faster question retrieval
- exam_attempts(student_id) → Faster student history
- exam_attempts(exam_id) → Faster results per exam
```

### Query Optimization Tips
```
1. Use JOINs instead of multiple queries
2. Limit results with LIMIT clause
3. Add WHERE conditions early
4. Use indexes on frequently searched columns
5. Avoid SELECT * - specify needed columns
6. Use COUNT() for large datasets
```

---

This architecture ensures:
✅ **Security** - Data protection and access control
✅ **Scalability** - Can handle more users/exams
✅ **Maintainability** - Clear separation of concerns
✅ **Reliability** - Data integrity with constraints
✅ **Performance** - Optimized queries with indexes
