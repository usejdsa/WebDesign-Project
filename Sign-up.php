<?php
require 'db.php';
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? 'user';

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } elseif ($username && $email && $password) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Email already registered!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $insert->execute([$username, $email, $hashed, $role]);
            header("Location: Sign-in.php");
            exit;
        }
    } else {
        $error = "Please fill all fields!";
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
    <title>Sign Up</title>
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
        <h2>Sign Up</h2>
        <form method="POST" action="">
            <label>Account Type</label>
            <div class="role-btn-container">
                <button type="button" class="btn btn-white role-btn" data-role="user">User</button>
                <button type="button" class="btn btn-white role-btn" data-role="admin">Admin</button>
            </div>
            <input type="hidden" name="role" id="selected-role" value="user">

            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your username" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm your password" required>

            <button type="submit" class="signin-btn signup-btn">Sign Up</button>

            <p class="signup-text">
                Already have an account? <a href="Sign-in.php">Sign in</a>
            </p>
        </form>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</div>

<script src="./js/script.js"></script>
<script>
const buttons = document.querySelectorAll('.role-btn');
const hiddenInput = document.getElementById('selected-role');
buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        hiddenInput.value = btn.getAttribute('data-role');
        buttons.forEach(b => b.classList.remove('btn-red'));
        btn.classList.add('btn-red');
    });
});
</script>
</body>
</html>