<?php
session_start();

if(!isset($_SESSION['logged_in_user'])){
    header('Location: Sign-in.php');
    exit;
}

require_once './database/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$first_name || !$last_name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$subject || !$message) {
        echo "Please fill all required fields correctly.";
        exit;
    }

    $db = new Database();
    $conn = $db->getConnection();

    try {
        $stmt = $conn->prepare("
            INSERT INTO submissions (type, first_name, last_name, email, phone, subject, message)
            VALUES ('contact', :first_name, :last_name, :email, :phone, :subject, :message)
        ");
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message
        ]);
        echo "Message sent successfully!";
    } catch (PDOException $e) {
        echo "Error sending message.";
    }
    exit;
}
?>
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/contact.css">
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
                    <span style="margin-right:10px;">Signed in as <strong><?php echo htmlspecialchars($_SESSION['logged_in_user']['username']); ?></strong></span>
                    <button class="btn btn-white" onclick="window.location.href='Logout.php'">Logout</button>
                <?php else: ?>
                    <button class="btn btn-white" onclick="window.location.href='Sign-in.php'">Sign In</button>
                    <button class="btn btn-red" onclick="window.location.href='Sign-up.php'">Book Now</button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <div class="contact-container">
            <div class="section-container">
                <div class="section-header">
                    <h2>Contact Us</h2>
                    <p>We'd love to hear from you. Get in touch with our team.</p>
                </div>

                <div class="contact-wrapper">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>

                        <div class="contact-info-item">
                            <h4>Phone</h4>
                            <p>+1 (555) 123-4567<br>Available 24/7</p>
                        </div>

                        <div class="contact-info-item">
                            <h4>Email</h4>
                            <p>info@starlinehotel.com<br>reservations@starlinehotel.com</p>
                        </div>

                        <div class="contact-info-item">
                            <h4>Address</h4>
                            <p>123 Luxury Boulevard<br>Downtown District<br>City, 12345<br>Country</p>
                        </div>

                        <div class="contact-info-item">
                            <h4>Office Hours</h4>
                            <p>Monday - Friday: 8:00 AM - 8:00 PM<br>Saturday - Sunday: 9:00 AM - 6:00 PM</p>
                        </div>

                        <div class="contact-info-item">
                            <h4>Connect With Us</h4>
                            <div class="footer-links" style="gap: 8px;">
                                <a href="www.facebook.com">Facebook</a>
                                <a href="www.twitter.com">Twitter</a>
                                <a href="www.instagram.com">Instagram</a>
                                <a href="www.linkedIn.com">LinkedIn</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-form">
                        <form id="contactForm" method="POST">
                            <input type="hidden" name="type" value="contact">
                            
                            <div class="form-row">
                                <div class="form-field">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" placeholder="John" required>
                                </div>
                                <div class="form-field">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" placeholder="Doe" required>
                                </div>
                            </div>

                            <div class="form-row full">
                                <div class="form-field">
                                    <label>Email Address</label>
                                    <input type="email" name="email" placeholder="john@example.com" required>
                                </div>
                            </div>

                            <div class="form-row full">
                                <div class="form-field">
                                    <label>Phone Number</label>
                                    <input type="tel" name="phone" placeholder="+1 (555) 000-0000">
                                </div>
                            </div>

                            <div class="form-row full">
                                <div class="form-field">
                                    <label>Subject</label>
                                    <input type="text" name="subject" placeholder="How can we help?" required>
                                </div>
                            </div>

                            <div class="form-row full">
                                <div class="form-field">
                                    <label>Message</label>
                                    <textarea name="message" placeholder="Please share your message here..." required></textarea>
                                </div>
                            </div>

                            <div class="form-row full">
                                <div class="form-field">
                                    <button type="submit" class="btn btn-red"
                                        style="background-color: #5F141A; color: white; padding: 12px 32px; border: none; cursor: pointer; border-radius: 4px; font-weight: 600; width: 100%;">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>

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
                            <img src="assets/icons/hotel_logo.svg" alt="hotel logo">
                        </figure>
                        <span>Starline Hotel</span>
                    </div>
                    <p>Experience luxury and comfort in the heart of the city. Your perfect stay awaits.</p>
                </div>

                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="https://www.facebook.com/">Facebook</a></li>
                        <li><a href="https://www.instagram.com/">Instagram</a></li>
                        <li><a href="https://www.linkedin.com/">Linkedin</a></li>
                        <li><a href="#">Contact form</a></li>

                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <p>
                        <b>Starline Hotel</b><br>
                        123 Luxury Boulevard<br>
                        Downtown District<br>
                        City, 12345<br><br>
                        <b>Phone:</b> +1 (555) 255-7344<br>
                        <b>Email:</b> info@starlinehotel.com
                    </p>
                </div>

            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 Starline Hotel. All rights reserved.</p>
                <div class="footer-links">
                    <a href="#">Privacy Policy</a>
                </div>
            </div>

        </div>
    </footer>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('submitForm.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(msg => {
                alert(msg);
                this.reset();
            })
            .catch(() => alert('Something went wrong'));
        });
    </script>

    <script src="./js/script.js"></script>
</body>

</html>