<?php
require_once 'config.php';
require_once 'includes/functions.php';
$pageTitle = 'Contact';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - <?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-5 fw-bold text-center">Contact Us</h1>
            
            <div class="row mb-5">
                <div class="col-md-6 mb-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="bi bi-envelope" style="font-size: 2rem; color: #0d6efd;"></i>
                            <h5 class="card-title mt-3">Email</h5>
                            <p class="card-text">support@onlineexam.edu</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="bi bi-telephone" style="font-size: 2rem; color: #0d6efd;"></i>
                            <h5 class="card-title mt-3">Phone</h5>
                            <p class="card-text">+1 (800) 123-4567</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Send us a Message</h5>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control" placeholder="What is your inquiry about?" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="5" placeholder="Enter your message..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
                    </form>
                </div>
            </div>

            <div class="alert alert-info mt-4" role="alert">
                <i class="bi bi-info-circle"></i> 
                <strong>Note:</strong> This is a demo contact form. In a production environment, this would send an email to the admin.
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
