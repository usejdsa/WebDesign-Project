<?php
session_start();

if(!isset($_SESSION['logged_in_user'])){
    header('Location: Sign-in.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/about.css">
    <title>About</title>
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

                    <?php if (isset($_SESSION['logged_in_user']) && $_SESSION['logged_in_user']['role'] === 'admin'): ?>
                        <a href="admin/AdminDashboard.php" class="nav-link">Dashboard</a>
                    <?php endif; ?>
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

    <div class="about-hero">
        <h1>About Starline Hotel</h1>
    </div>

    <main>
        <div class="about-content">
            <div class="section-container">
                <div class="about-section">
                    <h2>Our Story</h2>
                    <p>Founded in 1985, Starline Hotel has been a beacon of luxury and hospitality in the heart of the
                        city for nearly four decades. What began as a vision to create an exceptional hotel experience
                        has evolved into one of the most respected hospitality brands in the region.</p>
                    <p>Today, we continue our legacy of excellence, welcoming guests from around the world and creating
                        unforgettable memories with our world-class service, stunning accommodations, and attention to
                        detail.</p>
                </div>

                <div class="about-section">
                    <h2>Our Journey</h2>
                    <div class="timeline">
                        <div class="timeline-item">
                            <h3>1985 - The Beginning</h3>
                            <p>Starline Hotel opens its doors with 200 rooms and a vision to redefine luxury
                                hospitality.</p>
                        </div>
                        <div class="timeline-item">
                            <h3>1995 - Expansion</h3>
                            <p>A major renovation and expansion adds 150 new rooms and introduces our signature spa.</p>
                        </div>
                        <div class="timeline-item">
                            <h3>2005 - Awards & Recognition</h3>
                            <p>Receives the prestigious International Hotel Excellence Award for outstanding service.
                            </p>
                        </div>
                        <div class="timeline-item">
                            <h3>2015 - Modern Upgrades</h3>
                            <p>Complete modernization of facilities with smart technology and sustainable practices.</p>
                        </div>
                        <div class="timeline-item">
                            <h3>2024 - Present</h3>
                            <p>Continues to innovate while maintaining the timeless elegance that guests love.</p>
                        </div>
                    </div>
                </div>

                <div class="about-section">
                    <h2>Our Values</h2>
                    <div class="values-grid">
                        <div class="value-card">
                            <img src="./assets/icons/excellence-award.svg" alt="excellence icon" width="54px" class="value-icon" />
                            <h3>Excellence</h3>
                            <p>We strive for perfection in every aspect of our service and facilities.</p>
                        </div>
                        <div class="value-card">
                            <img src="./assets/icons/hospitality-heart.svg" alt="hospitality icon" width="54px" class="value-icon" />
                            <h3>Hospitality</h3>
                            <p>Genuine care and attention to every guest's needs and preferences.</p>
                        </div>
                        <div class="value-card">
                            <img src="./assets/icons/sustainability-leaf.svg" alt="sustainability icon" width="54px" class="value-icon" />
                            <h3>Sustainability</h3>
                            <p>Committed to environmental responsibility and sustainable practices.</p>
                        </div>
                        <div class="value-card">
                            <img src="./assets/icons/community-group.svg" alt="community icon" width="54px" class="value-icon" />
                            <h3>Community</h3>
                            <p>Dedicated to supporting and enriching the local community.</p>
                        </div>
                    </div>
                </div>

                <div class="about-section">
                    <h2>Why Choose Starline Hotel?</h2>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 24px;">
                        <div style="padding: 16px; background: var(--bg-light); border-radius: 8px;">
                            <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Prime Location</h3>
                            <p style="font-size: 14px; color: var(--text-light);">Centrally located in the heart of the
                                city, close to major attractions and business districts.</p>
                        </div>
                        <div style="padding: 16px; background: var(--bg-light); border-radius: 8px;">
                            <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">5-Star Service</h3>
                            <p style="font-size: 14px; color: var(--text-light);">Our dedicated staff is trained to
                                exceed your expectations at every turn.</p>
                        </div>
                        <div style="padding: 16px; background: var(--bg-light); border-radius: 8px;">
                            <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Modern Facilities</h3>
                            <p style="font-size: 14px; color: var(--text-light);">State-of-the-art amenities including
                                spa, fitness center, and fine dining restaurants.</p>
                        </div>
                        <div style="padding: 16px; background: var(--bg-light); border-radius: 8px;">
                            <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Competitive Rates</h3>
                            <p style="font-size: 14px; color: var(--text-light);">Exceptional value without compromising
                                on quality and service.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-section">
                    <div class="footer-logo">
                        <figure>
                            <img src="./assets/icons/hotel_logo.svg" alt="hotel logo">
                        </figure>
                        <span>Starline Hotel</span>
                    </div>
                    <p>Experience luxury and comfort in the heart of the city.</p>
                </div>

                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="rooms.php">Rooms & Suites</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <p>
                        +1 (555) 123-4567<br>
                        info@starlinehotel.com
                    </p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 Starline Hotel. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="../js/shared.js"></script>
</body>

</html>