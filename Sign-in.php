<?php
require __DIR__ . '/db.php';
session_start();
$error = '';

if (!isset($_SESSION['logged_in_user']) && isset($_COOKIE['remember_me_user'])) {
    $_SESSION['logged_in_user'] = json_decode($_COOKIE['remember_me_user'], true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_in_user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        if (isset($_POST['remember_me'])) {
            setcookie('remember_me_user', json_encode($_SESSION['logged_in_user']), time() + 604800, '/');
        }

        if ($user['role'] === 'admin') {
            header("Location: AdminDashboard.php");
        } else {
            header("Location: Home.php");
        }
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Sign In</title>
</head>
<body>
<header>
    <div class="navbar-container">
        <a href="Home.php" class="navbar-logo">
            <figure>
                <img src="./assets/icons/hotel_logo.svg" alt="hotel logo" width="40px;">
            </figure>
            <h3 class="logo-text">Starline Hotel</h3>
        </a>
        <nav class="navbar">
            <div class="navbar-menu">
                <a href="Rooms.php" class="nav-link">Rooms & Suites</a>
                <a href="About.php" class="nav-link">About</a>
                <a href="Contact.php" class="nav-link">Contact</a>
            </div>
        </nav>
    </div>
</header>

<div class="container">
    <div class="signin-box">
        <h2>Sign In</h2>
        <form method="POST" action="">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            <div class="remember-checkbox">
                <input type="checkbox" name="remember_me" id="remember_me">
                <label for="remember_me">Remember Me</label>
            </div>
            <button type="submit" class="btn signin-btn">Sign In</button>
            <p class="signup-text">
                Don't have an account? <a href="Sign-up.php">Create one</a>
            </p>
        </form>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</div>

<script src="./js/script.js"></script>
</body>
</html>