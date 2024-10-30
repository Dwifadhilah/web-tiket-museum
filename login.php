<?php
session_start();

// Mock credentials (for demonstration)
$valid_email = "user@example.com";
$valid_password = "password123";

// Handle login form submission
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate credentials
    if ($email == $valid_email && $password == $valid_password) {
        $_SESSION['user'] = $email;
        header("Location: login.php?welcome"); // Redirect to welcome section
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}

// Logout handling
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Check if user is logged in for the welcome page
$is_logged_in = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <?php if ($is_logged_in): ?>
                    <!-- Welcome Page -->
                    <h2 class="text-center">Welcome</h2>
                    <p class="text-center">Hello, <?php echo htmlspecialchars($_SESSION['user']); ?>!</p>
                    <div class="text-center">
                        <a href="login.php?logout" class="btn btn-danger btn-block">Logout</a>
                    </div>
                <?php else: ?>
                    <!-- Login Form -->
                    <h2 class="text-center">Login</h2>
                    <?php if ($error): ?>
                        <p class="text-danger text-center"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#">Forgot password?</a>
                    </div>
                    <div class="text-center mt-2">
                        <a href="signin.html">Don't have an account? Sign up</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
