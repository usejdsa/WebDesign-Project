<?php
require 'users_temp.php';

$error = '';

if (!isset($_SESSION['logged_in_user']) && isset($_COOKIE['remember_me_user'])) {
    $_SESSION['logged_in_user'] = json_decode($_COOKIE['remember_me_user'], true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $loggedInUser = null;

    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $loggedInUser = $user;
            break;
        }
    }

    if ($loggedInUser) {
        $_SESSION['logged_in_user'] = [
            'email' => $loggedInUser['email'],
            'username' => $loggedInUser['username'],
            'role' => $loggedInUser['role']
        ];

        if (isset($_POST['remember_me'])) {
        setcookie(
            'remember_me_user',
            json_encode($_SESSION['logged_in_user']),
            time() + (7 * 24 * 60 * 60),
            '/'
        );
        }

        if ($loggedInUser['role'] === 'admin') {
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
    <title>Sign in</title>
</head>

<body>
    <header>

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

            <form id="signin-form" method="POST" action="">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>

                <div class="remember-checkbox">
                    <input type="checkbox" name="remember_me" id="remember_me">
                    <label for="remember_me">Remember Me</label>
                </div>
                
                <button type="submit" class="btn signin-btn">Sign In</button>

                <p class="signup-text">
                    Don't have an account? <a href="#" onclick="window.location.href='Sign-up.php'">Create one</a>
                </p>
            </form>
            <?php
                if ($error) {
                    echo "<p style='color:red;'>$error</p>";
                }
            ?>

        </div>
    </div>

    <script src="./js/script.js"></script>
    <script src="./js/loginValidation.js"></script>

</body>

</html>