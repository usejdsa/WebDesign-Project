<?php
session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['username' => 'Usejd', 'email' => 'usejd@test.com', 'password' => 'userusejd1', 'role' => 'user'],
        ['username' => 'Shpat', 'email' => 'shpat@test.com', 'password' => 'usershpat1', 'role' => 'user'],
        ['username' => 'admin', 'email' => 'admin@test.com', 'password' => 'admin123', 'role' => 'admin']
    ];
}

$users = &$_SESSION['users'];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? 'user';

    if ($username && $email && $password) {

        $duplicate = false;
        foreach ($users as $u) {
            if ($u['email'] === $email || $u['username'] === $username) {
                $duplicate = true;
                break;
            }
        }

        if ($duplicate) {
            $error = "This email or username is already registered!";
        } else {
            $users[] = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ];

            header("Location: Sign-in.php");
            exit;
        }

    } else {
        $error = "Please fill in all fields.";
    }}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Sign up</title>
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
            <h2>Sign up</h2>

            <form id="signup-form" method="POST" action="">
                <label>Account Type</label>

                <div class="role-btn-container">
                    <button type="button" class="btn btn-white role-btn" data-role="user">User</button>
                    <button type="button" class="btn btn-white role-btn" data-role="admin">Admin</button>
                </div>
                <input type="hidden" name="role" id="selected-role" value="user">

                <label>Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username">

                <label>Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>

                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>

                <label>Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm-password" placeholder="Confirm your password" required>

                <button type="submit" class="signin-btn signup-btn">Sign up</button>

                <p class="signup-text">
                    Already have an account? <a href="#" onclick="window.location.href='Sign-in.php'">Sign in</a>
                </p>
            </form>
            <?php if ($error): ?>
                <p style="color:red;"><?php echo $error; ?></p>
            <?php endif; ?>

        </div>
    </div>

    <script src="./js/script.js"></script>
    <script src="./js/loginValidation.js"></script>


</body>

</html>