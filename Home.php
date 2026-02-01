<?php
session_start();

if (!isset($_SESSION['logged_in_user'])) {
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
    <link rel="stylesheet" href="./css/home.css">
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
        <!-- HERO -->
        <section class="hero" id="home">
            <img src="./assets/images/hero-background.webp" alt="hero-background" class="hero-image">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>Experience Luxury Redefined</h1>
                <p>Discover exceptional hospitality in the heart of the city</p>
                <div class="hero-buttons">
                    <button class="btn btn-red p-btn" onclick="window.location.href='Rooms.php'">Explore Rooms</button>
                    <button class="btn btn-white p-btn" onclick="location.href='#featured-rooms'">Special Offers</button>
                </div>
            </div>
        </section>

        <!-- SEARCH BAR -->
        <section class="search-bar-section">
            <div class="search-container">
                    <div class="search-form">
                        <div class="form-group">
                            <label>Destination</label>
                            <div class="input-wrapper">
                                <img class="input-icon" src="./assets/icons/location.svg" alt="location-icon">
                                <input type="text" placeholder="Where to?">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Check-in</label>
                            <div class="input-wrapper">
                                <img class="input-icon" src="./assets/icons/calendar.svg" alt="calendar-icon">
                                <input type="date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Check-out</label>
                            <div class="input-wrapper">
                                <img class="input-icon" src="./assets/icons/calendar.svg" alt="calendar-icon">
                                <input type="date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Guests</label>
                            <div class="input-wrapper">
                                <img class="input-icon" src="./assets/icons/group-of-people.svg" alt="people-icon">
                                <select>
                                    <option>1 Guest</option>
                                    <option>2 Guests</option>
                                    <option>3 Guests</option>
                                    <option>4+ Guests</option>
                                </select>
                            </div>
                        </div>

                        <button onclick="location.href='Rooms.php'" class="btn btn-red btn-search ">
                            <img src="./assets/icons/search.svg" alt="search-icon">
                            <span>Search Available Rooms</span>
                        </button>
                    </div>
            </div>
        </section>

        <!-- AMENITIES -->

        <section class="amenities">
            <div class="section-container">
                <div class="section-header">
                    <h2>World-Class Amenities</h2>
                    <p>Everything you need for an unforgettable experience</p>
                </div>
                <div class="amenities-grid">

                    <div class="amenity-card">
                        <div class="amenity-icon">
                            <img src="assets/icons/wifi.svg" alt="wifi">
                        </div>
                        <h3>High-Speed Wi-Fi</h3>
                        <p>Stay connected with complimentary high-speed internet throughout the property</p>
                    </div>

                    <div class="amenity-card">
                        <div class="amenity-icon">
                            <img src="assets/icons/dining.svg" alt="dining">
                        </div>
                        <h3>Fine Dining</h3>
                        <p>Award-winning restaurants offering international and local cuisine</p>
                    </div>

                    <div class="amenity-card">
                        <div class="amenity-icon">
                            <img src="assets/icons/fitness.svg" alt="gym">
                        </div>
                        <h3>Fitness Center</h3>
                        <p>24/7 state-of-the-art gym and wellness facilities</p>
                    </div>

                    <div class="amenity-card">
                        <div class="amenity-icon">
                            <img src="assets/icons/rooftop_pool.svg" alt="pool">
                        </div>
                        <h3>Rooftop Pool</h3>
                        <p>Stunning views with a heated infinity pool and lounge area</p>
                    </div>

                    <div class="amenity-card">
                        <div class="amenity-icon">
                            <img src="assets/icons/spa.svg" alt="spa">
                        </div>
                        <h3>Spa & Wellness</h3>
                        <p>Rejuvenate with our full-service spa and wellness center</p>
                    </div>

                    <div class="amenity-card">
                        <div class="amenity-icon">
                            <img src="assets/icons/parking_valet.svg" alt="parking">
                        </div>
                        <h3>Valet Parking</h3>
                        <p>Complimentary valet parking for all our guests</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- FEATURED ROOMS -->
        <section class="featured-rooms" id="featured-rooms">
            <div class="section-container">
                <div class="section-header">
                    <h2>Our Featured Rooms</h2>
                    <p>Choose from our collection of elegantly designed accommodations</p>
                </div>

                <div class="rooms-grid">

                    <div class="room-card">
                        <div class="room-image">
                            <img src="./assets/images/room-deluxe.jpeg" alt="Deluxe Room">
                            <div class="room-rating">
                                <span class="star">★</span>
                                <span>4.8</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3>Deluxe Room</h3>
                            <p>Elegantly appointed room with city views and modern amenities</p>
                            <div class="room-specs">
                                <span>2 Guests</span>
                                <span>350 sq ft</span>
                            </div>
                            <div class="room-footer">
                                <div class="room-price">
                                    <span class="price">$199</span>
                                    <span class="period">/night</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="room-card">
                        <div class="room-image">
                            <img src="./assets/images/suite-executive.jpeg" alt="Executive Suite">
                            <div class="room-rating">
                                <span class="star">★</span>
                                <span>4.9</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3>Executive Suite</h3>
                            <p>Spacious suite with separate living area and premium features</p>
                            <div class="room-specs">
                                <span>3 Guests</span>
                                <span>600 sq ft</span>
                            </div>
                            <div class="room-footer">
                                <div class="room-price">
                                    <span class="price">$349</span>
                                    <span class="period">/night</span>
                                </div>
                               
                            </div>
                        </div>
                    </div>

                    <div class="room-card">
                        <div class="room-image">
                            <img src="./assets/images/suite-presidential.jpeg" alt="Presidential Suite">
                            <div class="room-rating">
                                <span class="star">★</span>
                                <span>5.0</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3>Presidential Suite</h3>
                            <p>Luxurious suite with panoramic views and butler service</p>
                            <div class="room-specs">
                                <span>4+ Guests</span>
                                <span>1200 sq ft</span>
                            </div>
                            <div class="room-footer">
                                <div class="room-price">
                                    <span class="price">$599</span>
                                    <span class="period">/night</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- TESTIMONIALS -->
        <section class="testimonials">
            <div class="section-container">
                <div class="section-header">
                    <h2>Guest Testimonials</h2>
                    <p>Hear from our satisfied guests</p>
                </div>

                <div class="testimonials-grid">

                    <div class="testimonial-card">
                        <div class="stars">★★★★★</div>
                        <p class="testimonial-text">"The service was exceptional and the accommodations were pristine.
                            Every staff member went above and beyond to ensure our stay was perfect."</p>
                        <p class="testimonial-author">Sarah Johnson</p>
                        <p class="testimonial-role">Corporate Executive</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="stars">★★★★</div>
                        <p class="testimonial-text">"Beautiful property with stunning views. The rooftop pool is
                            absolutely amazing, and the dining experience was world-class. Highly recommend!"</p>
                        <p class="testimonial-author">Michael Chen</p>
                        <p class="testimonial-role">Travel Blogger</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="stars">★★★★★</div>
                        <p class="testimonial-text">"We celebrated our anniversary here and it was magical. The spa
                            treatments were relaxing, and the champagne dinner was unforgettable. Thank you!"</p>
                        <p class="testimonial-author">Emma & David Wilson</p>
                        <p class="testimonial-role">Honeymooners</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- NEWSLETTER -->
        <section class="newsletter">
            <div class="section-container">
                <h2>Stay Updated</h2>
                <p>Subscribe to our newsletter for exclusive offers and travel inspiration</p>
                <form id="newsletterForm" class="newsletter-form" method="POST" action="submitForm.php">
                    <input type="hidden" name="type" value="newsletter">
                    <input type="email" name="email" placeholder="Enter your email address" required>
                    <button type="submit" class="btn btn-red">Subscribe</button>
                </form>

            </div>
        </section>

        <!-- ROOM BOOKING POPUP -->
        <div id="bookModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3 id="modalRoomName">Book Your Room</h3>
                <form onsubmit="submitBooking(event)">

                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
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

    <script>
        document.getElementById('newsletterForm').addEventListener('submit', function (e) {
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