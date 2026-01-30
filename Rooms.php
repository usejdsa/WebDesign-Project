<?php
session_start();

if (!isset($_SESSION['logged_in_user'])) {
    header('Location: Sign-in.php');
    exit;
}

require_once './database/Database.php';

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("
    SELECT id, name, description, price_per_night, image
    FROM rooms
    WHERE is_featured = 1
    AND status = 'available'
");
$stmt->execute();

$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/rooms.css">
    <title>Starline Hotel</title>
</head>

<body>

<header>
    <div class="navbar-container">
        <a href="Home.php" class="navbar-logo">
            <figure>
                <img src="./assets/icons/hotel_logo.svg" alt="hotel logo" width="40px">
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
            <span style="margin-right:10px;">
                Signed in as <strong><?= htmlspecialchars($_SESSION['logged_in_user']['username']) ?></strong>
            </span>
            <button class="btn btn-white" onclick="window.location.href='Logout.php'">Logout</button>
        </div>
    </div>
</header>

<main>

    <!-- FEATURED ROOMS -->
    <section class="featured-rooms" id="featured-rooms">
        <div class="section-container">

            <div class="section-header">
                <h2>Featured Rooms</h2>
                <p>Choose from our collection of elegantly designed accommodations</p>
            </div>

            <div class="rooms-grid">

                <?php if (count($rooms) === 0): ?>
                    <p>No featured rooms available at the moment.</p>
                <?php endif; ?>

                <?php foreach ($rooms as $room): ?>
                    <div class="room-card">
                        <img 
                            src="./images/rooms/<?= htmlspecialchars($room['image']) ?>" 
                            alt="<?= htmlspecialchars($room['name']) ?>">

                        <h3><?= htmlspecialchars($room['name']) ?></h3>

                        <p><?= htmlspecialchars($room['description']) ?></p>

                        <span class="room-price">
                            €<?= htmlspecialchars($room['price_per_night']) ?>/night
                        </span>

                        <button 
                            class="btn btn-red"
                            onclick="openBookingModal('<?= htmlspecialchars($room['name'], ENT_QUOTES) ?>')">
                            Book Now
                        </button>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </section>

    <!-- NEWSLETTER -->
    <section class="newsletter">
        <div class="section-container">
            <h2>Stay Updated</h2>
            <p>Subscribe to our newsletter for exclusive offers and travel inspiration</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address" required>
                <button type="submit" class="btn btn-red">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- BOOKING MODAL -->
    <div id="bookModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 id="modalRoomName">Book Your Room</h3>

            <form onsubmit="submitBooking(event)">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>

                <label>Number of Nights:</label>
                <input type="number" name="nights" min="1" required>

                <label>Number of Guests:</label>
                <select name="guests" required>
                    <option value="1">1 Guest</option>
                    <option value="2">2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                    <option value="5">5 Guests</option>
                    <option value="6">6 Guests</option>
                    <option value="7">7 Guests</option>
                </select>

                <label>Check-in Date:</label>
                <input type="date" name="date" required>

                <button type="submit" class="btn btn-red">Book</button>
            </form>
        </div>
    </div>

</main>

<footer>
    <div class="footer-container">
        <div class="footer-bottom">
            <p>&copy; 2024 Starline Hotel. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="./js/script.js"></script>
</body>
</html>
