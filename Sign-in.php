<?php
session_start();
$error = '';

include_once 'database/Database.php';
include_once 'database/User.php';

if (!isset($_SESSION['logged_in_user']) && isset($_COOKIE['remember_me_user'])) {
    $_SESSION['logged_in_user'] = json_decode($_COOKIE['remember_me_user'], true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember_me']);

    if ($email && $password) {

        $db = new Database();
        $conn = $db->getConnection();
        $userClass = new User($conn);

        $loginResult = $userClass->login($email, $password);

        if ($loginResult) {
            $stmt = $conn->prepare("SELECT id, username, email, role FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['logged_in_user'] = [
                'id' => $userData['id'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'role' => $userData['role']
            ];

            if ($remember) {
                setcookie(
                    'remember_me_user',
                    json_encode($_SESSION['logged_in_user']),
                    time() + 604800,
                    '/'
                );
            }

            if ($userData['role'] === 'admin') {
                header("Location: AdminDashboard.php");
            } else {
                header("Location: Home.php");
            }
            exit;

        } else {
            $error = "Invalid email or password!";
        }

    } else {
        $error = "Please enter both email and password!";
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
    <header class="auth-header">

        <div class="navbar-container">
            <a href="#" class="navbar-logo" onclick="window.location.href='Home.php'">
                <figure>
                    <img src="./assets/icons/hotel_logo.svg" alt="hotel logo" width="40px;">
                </figure>
                <h3 class="logo-text">Starline Hotel</h3>
            </a>
            <nav class="navbar">
                <div class="navbar-menu" id="navbarMenu">
                    <a href="Rooms.php" class="nav-link">Rooms & Suites</a>
                    <a href="About.php" class="nav-link">About</a>
                    <a href="Contact.php" class="nav-link">Contact</a>
                </div>

                <div class="hamburger" id="hamburger">
                    <img src="./assets/icons/menu-hamburger.svg" alt="menu icon">
                </div>
            </nav>

            <div class="account-buttons">
                <?php if (isset($_SESSION['logged_in_user'])): ?>
                    <span style="margin-right:10px;">Signed in as <strong><?php echo $_SESSION['logged_in_user']['username']; ?></strong></span>
                    <button class="btn btn-white" onclick="window.location.href='Logout.php'">Logout</button>
                <?php else: ?>
                    <button class="btn btn-white" onclick="window.location.href='Sign-in.php'">Sign In</button>
                    <button class="btn btn-red" onclick="window.location.href='Sign-up.php'">Book Now</button>
                <?php endif; ?>
            </div>
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