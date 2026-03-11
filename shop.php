<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = ['supplement_id', 'supplement_name', 'supplement_price', 'user_name', 'user_email', 'user_address', 'user_phone', 'card_number', 'card_expiry'];
    $error_messages = [];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $error_messages[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
        }
    }

    if (empty($error_messages)) {
        $supplement_id = $_POST['supplement_id'];
        $supplement_name = $_POST['supplement_name'];
        $supplement_price = $_POST['supplement_price'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_phone = $_POST['user_phone'];
        $card_number = $_POST['card_number'];
        $card_expiry = $_POST['card_expiry'];

        $sql = "INSERT INTO supplement_orders (supplement_id, supplement_name, supplement_price, user_name, user_email, user_address, user_phone, card_number, card_expiry) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdssssss", $supplement_id, $supplement_name, $supplement_price, $user_name, $user_email, $user_address, $user_phone, $card_number, $card_expiry);

        if ($stmt->execute()) {
            $_SESSION['order_success'] = true;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['order_error'] = "Error placing order. Please try again.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => implode(" ", $error_messages)]);
    }

    $conn->close();
}
if (isset($_SESSION['order_success'])) {
    echo "<script>alert('Order placed successfully!');</script>";
    unset($_SESSION['order_success']);
}
if (isset($_SESSION['order_error'])) {
    echo "<script>alert('" . $_SESSION['order_error'] . "');</script>";
    unset($_SESSION['order_error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexFit Online - Your Personal Fitness Journey</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/20f08145b4.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav id="main-nav">
            <div class="logo">FlexFit Online</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a class='active' href="shop.php">Shop</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="programs.php">Programs</a></li>
                <li><a href="pricing.php">Pricing</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="Read.php">Details </a></li>
                <?php
                if (isset($_SESSION['user_name'])) {
                    echo '<li class="dropdown">';
                    echo '<a href="#" class="dropbtn">' . $_SESSION['user_name'] . '</a>';
                    echo '<div class="dropdown-content">';
                    echo '<a href="userProfile.php">Profile</a>';
                    echo '<a href="logout.php">Logout</a>';
                    echo '</div>';
                    echo '</li>';
                } else {
                    echo '<li><a href="login.php" class="login-btn">Login</a></li>';
                    echo '<li><a href="register.php" class="register-btn">Register</a></li>';
                }
                ?>
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
    </header>

    <section class="supplements">
        <div class="sidebar">
            <h3>Filter by Price</h3>
            <div class="price-filter">
                <input type="range" id="price-range" min="0" max="100000" value="100000">
                <p>Max Price: LKR<span id="max-price">100,000</span></p>
            </div>
        </div>
        <div class="supplement-grid">
            <div class="supplement-card" data-id="1" data-name="Whey Protein Powder" data-price="65999.99" data-image="images/whey.jpg">
                <img src="images/whey.jpg" alt="Protein Powder">
                <h3>Whey Protein Powder</h3>
                <p>High-quality protein for muscle recovery and growth.</p>
                <span class="price">LKR 65999.99</span>
                <button class="buy-now">Buy Now</button>
            </div>
            <div class="supplement-card"  data-id="2" data-name="BCAA Amino Acids" data-price="39999.99" data-image="images/bcaa.jpg">
                <img src="images/bcaa.jpg" alt="BCAA">
                <h3>BCAA Amino Acids</h3>
                <p>Essential amino acids for muscle support and endurance.</p>
                <span class="price">LKR 39999.99</span>
                <button class="buy-now">Buy Now</button>
            </div>
            <div class="supplement-card" data-id="3" data-name="Creatine Monohydrate" data-price="57999.99" data-image="images/creatine.jpg">
                <img src="images/creatine.jpg" alt="Creatine">
                <h3>Creatine Monohydrate</h3>
                <p>Increases strength and power output during workouts.</p>
                <span class="price">LKR 57999.99</span>
                <button class="buy-now">Buy Now</button>
            </div>
            <div class="supplement-card" data-id="4" data-name="Advanced Pre-Workout" data-price="11599.99" data-image="images/pre.jpg">
                <img src="images/pre.jpg" alt="Pre-Workout">
                <h3>Advanced Pre-Workout</h3>
                <p>Boost energy, focus, and performance during workouts.</p>
                <span class="price">LKR 11599.99</span>
                <button class="buy-now">Buy Now</button>
            </div>

            <div class="supplement-card" data-id="5" data-name="Complete Multivitamin" data-price="85599.99" data-image="images/multi.jpg">
                <img src="images/multi.jpg" alt="Multivitamin">
                <h3>Complete Multivitamin</h3>
                <p>Essential vitamins and minerals for overall health and wellness.</p>
                <span class="price">LKR 85599.99</span>
                <button class="buy-now">Buy Now</button>
            </div>

            <div class="supplement-card" data-id="6" data-name="Omega-3 Fish Oil" data-price="73500.00" data-image="images/omega.jpg">
                <img src="images/omega.jpg" alt="Fish Oil">
                <h3>Omega-3 Fish Oil</h3>
                <p>Support heart, brain, and joint health with high-quality fish oil.</p>
                <span class="price">LKR 73500.00</span>
                <button class="buy-now">Buy Now</button>
            </div>
        </div>
        <div id="supplement-popup" class="popup">
            <div class="popup-content">
                <span class="close-popup">&times;</span>
                <div class="popup-left">
                    <img id="popup-image" src="" alt="Supplement Image">
                    <h3 id="popup-name"></h3>
                    <p id="popup-price"></p>
                </div>
                <div class="popup-right">
                    <form id="order-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" id="supplement-id" name="supplement_id">
                        <input type="hidden" id="supplement-name" name="supplement_name">
                        <input type="hidden" id="supplement-price" name="supplement_price">
                        <div class="form-group">
                            <label for="user-name">Name:</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-user"></i>
                                <input type="text" id="user-name" name="user_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user-email">Email:</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="user-email" name="user_email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user-address">Address:</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-home"></i>
                                <textarea id="user-address" name="user_address" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user-phone">Contact Number:</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-phone"></i>
                                <input type="tel" id="user-phone" name="user_phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="card-number">Card Number:</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-credit-card"></i>
                                <input type="text" id="card-number" name="card_number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="card-expiry">Expiry Date:</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/YY" required>
                            </div>
                        </div>
                        <button type="submit" class="order-btn">Place Order</button>
                        
                    </form>
                </div>

            </div>
        </div>
    </section>
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>FlexFit Online</h3>
                <p>Your personal fitness journey starts here.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="programs.php">Programs</a></li>
                    <li><a href="shop.php">Shop</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Know About Us</h3>
                <ul>
                    <li><a href="faq.php">FAQ</a></li>
                    <li><a href="privacy.php">Privacy & Policies</a></li>
                    <li><a href="terms.php">Terms & Conditions</a></li>
                    <li><a href="about.php">About Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 FlexFit Online. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/index.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceRange = document.getElementById('price-range');
            const maxPrice = document.getElementById('max-price');
            const supplementCards = document.querySelectorAll('.supplement-card');

            priceRange.addEventListener('input', function() {
                const maxPriceValue = this.value;
                maxPrice.textContent = maxPriceValue;

                supplementCards.forEach(card => {
                    const price = parseFloat(card.querySelector('.price').textContent.replace('LKR', ''));
                    if (price <= maxPriceValue) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const buyButtons = document.querySelectorAll('.buy-now');
            const popup = document.getElementById('supplement-popup');
            const closePopup = document.querySelector('.close-popup');

            buyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.supplement-card');
                    const id = card.dataset.id;
                    const name = card.dataset.name;
                    const price = card.dataset.price;
                    const image = card.dataset.image;

                    document.getElementById('popup-image').src = image;
                    document.getElementById('popup-name').textContent = name;
                    document.getElementById('popup-price').textContent = `$${price}`;
                    document.getElementById('supplement-id').value = id;
                    document.getElementById('supplement-name').value = name;
                    document.getElementById('supplement-price').value = price;

                    popup.style.display = 'block';
                });
            });

            closePopup.addEventListener('click', function() {
                popup.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target == popup) {
                    popup.style.display = 'none';
                }
            });
        });


    </script>
</body>
</html>
