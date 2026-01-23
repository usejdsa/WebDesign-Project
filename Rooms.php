<!DOCTYPE php>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/rooms.css">
    <title>Starline-Hotel</title>
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

    <main>

        <section class="featured-rooms" id="featured-rooms">
            <div class="section-container">
                <div class="section-header">
                    <h2>Featured Rooms</h2>
                    <p>Choose from our collection of elegantly designed accommodations</p>
                </div>

                <div class="rooms-grid" id="roomsGrid"></div>

                <div class="button-container">
                    <button onclick="prevRoom()" class="btn btn-red">Back</button>
                    <button onclick="nextRoom()" class="btn btn-red">Next</button>
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
                    <button type="submit" class=" btn btn-red">Subscribe</button>
                </form>
            </div>
        </section>

        <!-- ROOM BOOKING POPUP -->
        <div id="bookModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3 id="modalRoomName">Book Your Room</h3>
                <form onsubmit="submitBooking(event)">

                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>

                    <label for="nights">Number of Nights:</label>
                    <input type="number" id="nights" name="nights" placeholder="Enter number of nights" min="1"
                        required>


                    <label for="guests">Number of Guests:</label>
                    <select name="guests" id="guests" required>
                        <option value="1">1 Guest</option>
                        <option value="2">2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4 Guests</option>
                        <option value="5">5 Guests</option>
                        <option value="6">6 Guests</option>
                        <option value="7">7 Guests</option>
                    </select>

                    <label for="guests">Check-in date:</label>

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

    <script src="./js/script.js"></script>
</body>

</html>