<!DOCTYPE html>
<html lang="en">
<head>

  
  <title>Add to Cart</title>
  <link rel="stylesheet" href="/Online-Fashon-Store/features/cart/cart.css">
  <link rel="stylesheet" href="/Online-Fashon-Store/assets/css/footer.css">
  <link rel="stylesheet" href="/Online-Fashon-Store/assets/css/header.css">
</head>

<body>

<header>
        <div class="logo">
            <h1><a href="/Online-Fashon-Store/pages/home/index.html">AUROSE FASHION</a></h1>
        </div>
    
        <nav>
        <a href="/Online-Fashon-Store/pages/home/index.html">HOME</a>
        <a href="/Online-Fashon-Store/pages/catalog/Men.html">MEN</a>
        <a href="/Online-Fashon-Store/pages/catalog/Women.html">WOMEN</a>
        <a href="/Online-Fashon-Store/pages/catalog/Kids.html">KIDS</a>
        <a href="/Online-Fashon-Store/pages/catalog/New-Arrivals.html">NEW ARRIVALS</a>
        </nav>
        
        <div class="search-bar">
            <input type="text" placeholder="Search for products, categories and more">
        </div>
        
        <a href="/Online-Fashon-Store/features/cart/index.php">
            <div class="cart">
                <img src="/Online-Fashon-Store/assets/images/cart.png" class="cart-icon">
            </div>
        </a>
    
        <div class="h-icons">
            <a href="/Online-Fashon-Store/pages/auth/user_login.php">Login/Register</a>
        </div>
    
    </header>
  
  <div class="container">
    <div id="root"></div>
    <div class="slidbar">
      <div class="categories">
        <h3>My Cart</h3>
        <ul id="category-list">
        </ul>
      </div>
      <div class="cartitems" id="cart-items">Your cart is empty</div>
      <div class="foot">
        <h3>Total</h3>
        <h2 id="total">Rs 0.00</h2>
        <button class="delete" id="deleteButton">Clear Cart</button>
        
        <a href="/Online-Fashon-Store/features/delivery/index_delivery.php" class="button1">Delivery Details</a>
        <a href="/Online-Fashon-Store/features/payment/index_payment.php" class="button2">Add Payment Details</a>

        <div id="confirmModal" class="modal">
          <div class="modal-content">
            <p>Are you sure you want to clear your cart?</p>
            <button id="confirmClear" class="confirm-btn">Yes</button>
            <button id="closeModal" class="close-btn">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="/Online-Fashon-Store/features/cart/cart.js"></script>

  <footer>
        <a href="/Online-Fashon-Store/pages/info/AboutUs.html">About Us</a> |
        <a href="/Online-Fashon-Store/pages/contact/index.php">Contact Us</a> |
        <a href="/Online-Fashon-Store/pages/info/Terms&Conditions.html">Terms & Conditions</a> |
        <a href="/Online-Fashon-Store/pages/info/FAQ.html">FAQs</a>

        <div class="social-links">
            <a href="https://www.facebook.com/yourprofile" target="_blank">
                <img src="/Online-Fashon-Store/assets/images/Facebook.jpg" alt="Facebook">
            </a>
            <a href="https://www.twitter.com/yourprofile" target="_blank">
                <img src="/Online-Fashon-Store/assets/images/X.jpg" alt="Twitter">
            </a>
            <a href="https://www.instagram.com/yourprofile" target="_blank">
                <img src="/Online-Fashon-Store/assets/images/Instagram.jpg" alt="Instagram">
            </a>
            <a href="https://www.linkedin.com/yourprofile" target="_blank">
                <img src="/Online-Fashon-Store/assets/images/Linkedin.png" alt="LinkedIn">
            </a>

    </footer>

</body>
</html>