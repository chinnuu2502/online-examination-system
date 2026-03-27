<?php
require_once 'config.php';
require_once 'includes/functions.php';
$pageTitle = 'Home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Advanced Online Examination Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Online Examination System</h1>
        <p class="lead">A modern, secure, and user-friendly platform for conducting online exams</p>
        <div class="mt-4">
            <?php if (!isLoggedIn()): ?>
                <a href="student/login.php" class="btn btn-light btn-lg me-3">Student Login</a>
                <a href="faculty/login.php" class="btn btn-outline-light btn-lg">Faculty Login</a>
            <?php else: ?>
                <a href="<?php echo isStudent() ? 'student/dashboard.php' : 'faculty/dashboard.php'; ?>" class="btn btn-light btn-lg me-3">Go to Dashboard</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Our Features</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-clipboard-check" style="font-size: 3rem; color: #0d6efd;"></i>
                        <h5 class="card-title mt-3">Easy Exam Creation</h5>
                        <p class="card-text">Faculty can easily create exams with multiple questions and flexible settings.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-hourglass-split" style="font-size: 3rem; color: #0d6efd;"></i>
                        <h5 class="card-title mt-3">Real-time Timer</h5>
                        <p class="card-text">Automatic countdown timer ensures exams are completed within the specified duration.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-graph-up" style="font-size: 3rem; color: #0d6efd;"></i>
                        <h5 class="card-title mt-3">Instant Results</h5>
                        <p class="card-text">Students get immediate feedback with detailed result analysis and performance metrics.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-lock" style="font-size: 3rem; color: #0d6efd;"></i>
                        <h5 class="card-title mt-3">Secure Authentication</h5>
                        <p class="card-text">Password hashing and session management ensure data security and privacy.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-phone" style="font-size: 3rem; color: #0d6efd;"></i>
                        <h5 class="card-title mt-3">Responsive Design</h5>
                        <p class="card-text">Works seamlessly on desktop, tablet, and mobile devices.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text" style="font-size: 3rem; color: #0d6efd;"></i>
                        <h5 class="card-title mt-3">Detailed Analytics</h5>
                        <p class="card-text">View comprehensive reports and performance analytics for all exams and students.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-primary text-white py-5">
    <div class="container text-center">
        <h2 class="mb-3">Get Started Today</h2>
        <p class="lead mb-4">Join our platform and experience seamless online examination</p>
        <?php if (!isLoggedIn()): ?>
            <a href="student/login.php" class="btn btn-light btn-lg">Student Login</a>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
