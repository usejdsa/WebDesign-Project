<?php

$users = [
    ['username' => 'Usejd', 'email' => 'usejd@test.com', 'password' => 'userusejd1', 'role' => 'user'],
    ['username' => 'Shpat', 'email' => 'shpat@test.com', 'password' => 'usershpat1', 'role' => 'user'],
    ['username' => 'admin', 'email' => 'admin@test.com', 'password' => 'admin123', 'role' => 'admin']
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $found = false;

    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $found = true;
            break;
        }
    }

    if ($found) {
        header("Location: Home.php");
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
                <button class="btn btn-white" onclick="window.location.href='Sign-in.php'">Sign In</button>
                <button class="btn btn-red" onclick="window.location.href='Sign-up.php'">Book Now</button>
            </div>
        </div>
    </header>


    <div class="container">
        <div class="signin-box">
            <h2>Sign In</h2>

            <form id="signin-form" metod="POST" action="">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>

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