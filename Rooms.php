<?php
session_start();

if (!isset($_SESSION['logged_in_user'])) {
    header('Location: Sign-in.php');
    exit;
}

require_once './database/Database.php';

$db = new Database();
$conn = $db->getConnection();

$searchDate = $_GET['date'] ?? null;

$sql = "
    SELECT r.*
    FROM rooms r
    WHERE r.is_featured = 1
";

$params = [];

if ($searchDate) {
    $sql .= " AND r.id NOT IN (
        SELECT room_id FROM bookings
        WHERE checkin_date <= :date
        AND DATE_ADD(checkin_date, INTERVAL nights DAY) > :date
    )";
    $params[':date'] = $searchDate;
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
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

                <?php if (isset($_SESSION['logged_in_user']) && $_SESSION['logged_in_user']['role'] === 'admin'): ?>
                        <a href="admin/AdminDashboard.php" class="nav-link">Dashboard</a>
                <?php endif; ?>
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
<section class="featured-rooms" id="featured-rooms">
    <div class="section-container">
        <div class="section-header">
            <h2>Featured Rooms</h2>
            <p>Choose from our collection of elegantly designed accommodations</p>
        </div>

        <div class="rooms-slider">
            <button class="prev-btn" onclick="prevRoom()">&#8592;</button>

            <div class="rooms-grid" id="roomsGrid">
                <?php if (count($rooms) === 0): ?>
                    <p>No featured rooms available at the moment.</p>
                <?php endif; ?>

                <?php foreach ($rooms as $room): ?>
                    <div class="room-card">
                        <div class="room-image">
                            <img src="./assets/images/<?= htmlspecialchars($room['image']) ?>" 
                                 alt="<?= htmlspecialchars($room['name']) ?>">
                            <div class="room-rating">
                                <span class="star">★</span>
                            </div>
                        </div>

                        <div class="room-content">
                            <h3><?= htmlspecialchars($room['name']) ?></h3>
                            <p><?= htmlspecialchars($room['description']) ?></p>
                            <hr>
                            <div class="room-footer">
                                <div class="room-price">
                                    <span class="price">€<?= htmlspecialchars($room['price_per_night']) ?></span>
                                    <span class="period">/night</span>
                                </div>

                                <?php if ($room['status'] === 'available'): ?>
                                    <button class="btn btn-red" 
                                            onclick="openModal('<?= htmlspecialchars($room['name'], ENT_QUOTES) ?>', <?= $room['id'] ?>)">
                                        Book Now
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-grey" disabled>Unavailable</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="next-btn" onclick="nextRoom()">&#8594;</button>
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

        <form method="POST" action="bookRoom.php">
            <input type="hidden" name="room_id" id="room_id">
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

<!-- FOOTER -->
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
    const rooms = <?= json_encode($rooms); ?>;
    let currentIndex = 0;
    const visibleCards = 3;
</script>
<script src="./js/script.js"></script>
</body>
</html>
