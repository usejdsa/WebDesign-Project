<!DOCTYPE php>
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
                <button class="btn btn-white" onclick="window.location.href='Sign-in.php'">Sign In</button>
                <button class="btn btn-red" onclick="window.location.href='Sign-up.php'">Book Now</button>
            </div>
        </div>
    </header>


    <div class="container">
        <div class="signin-box">
            <h2>Sign up</h2>

            <form id="signup-form">
                <label>Username</label>
                <input type="text" id="username" placeholder="Enter your username">

                <label>Email Address</label>
                <input type="email" id="email" placeholder="Enter your email" required>

                <label>Password</label>
                <input type="password" id="password" placeholder="Enter your password" required>

                <label>Confirm Password</label>
                <input type="password" id="confirm-password" placeholder="Confirm your password" required>

                <button type="submit" class="signin-btn signup-btn">Sign up</button>

                <p class="signup-text">
                    Already have an account? <a href="#" onclick="window.location.href='Sign-in.php'">Sign in</a>
                </p>
            </form>
        </div>
    </div>

    <script src="./js/script.js"></script>
    <script src="./js/loginValidation.js"></script>


</body>

</html>