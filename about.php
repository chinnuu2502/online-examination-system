<?php
require_once 'config.php';
require_once 'includes/functions.php';
$pageTitle = 'About';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - <?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4 fw-bold">About Our System</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">What We Are</h5>
                    <p class="card-text">
                        The Online Examination System is a comprehensive digital solution designed for educational 
                        institutions to conduct fair, secure, and efficient online examinations. Our platform eliminates 
                        the need for physical exam halls while maintaining the integrity and credibility of the assessment process.
                    </p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Our Mission</h5>
                    <p class="card-text">
                        To revolutionize the way educational institutions conduct examinations by providing a modern, 
                        user-friendly, and secure platform that benefits both faculty and students while maintaining 
                        the highest standards of academic integrity.
                    </p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Key Features</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Easy exam creation and management</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Real-time exam timer with auto-submission</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Secure student authentication</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Instant result calculation and display</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Comprehensive analytics and reporting</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Responsive mobile-friendly design</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Password-protected secure access</li>
                    </ul>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Technology Stack</h5>
                    <p class="card-text">
                        Built with modern web technologies including PHP for backend, MySQL for database management, 
                        Bootstrap for responsive UI, and JavaScript for interactive features. The system is fully XAMPP 
                        compatible and can be deployed locally or on a server.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Support & Feedback</h5>
                    <p class="card-text">
                        We are committed to continuous improvement. Please contact us with any suggestions, 
                        feedback, or issues you encounter while using the system.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
