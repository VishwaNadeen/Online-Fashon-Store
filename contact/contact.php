
<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $u_first_name = $_POST['u_first_name'];
   $u_last_name = $_POST['u_last_name'];
   $u_phone_num = $_POST['u_phonenumber'];
   $u_email = $_POST['u_email'];
   $u_message = $_POST['u_message'];

   $sql = "INSERT INTO `cupage`(`u_email`, `u_first_name`, `u_last_name`,`u_message`,`u_phonenumber`)
   VALUES ('$u_email','$u_first_name','$u_last_name','$u_message','$u_phone_num')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      echo "
    <script>alert('Form successfully submitted');
    document.location.href ='index.php';
    </script>
    ";
    header("Location: contact.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>AUROSE FASHION - Contact Us</title>
    <link rel="stylesheet" href="ContactUs.css">
    <link rel="icon" href="../images/icon.png"/>
</head>

<body>
    <header>
        <div class="logo">
            <h1><a href="../Home.html">AUROSE FASHION</a></h1>
        </div>
    
        <nav>
        <a href="../Home.html">HOME</a>
        <a href="../Men.html">MEN</a>
        <a href="../Women.html">WOMEN</a>
        <a href="../Kids.html">KIDS</a>
        <a href="H&M.html">HOME & LIVING</a>
        <a href="../New-Arrivals.html">NEW ARRIVALS</a>
        </nav>
        
        <div class="search-bar">
            <input type="text" placeholder="Search for products, categories and more" />
        </div>
        
        <a href="../cart/index.php">
            <div class="cart">
                <img src="../Images/cart.png" class="cart-icon">
            </div>
        </a>
    
        <div class="h-icons">
            <a href="../user_login.php">Login/Register</a>
        </div>
    
    </header>



    <div class="container">
        <h1>Contact</h1>
        <p class="intro">We love to hear from you on our customer service, merchandise, website, or any topics you want to share with us. Your comments and suggestions will be appreciated.</p>
        
        <div class="contact-section">
            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Send us an email</h2>
                <p>Ask us anything! We're here to help.</p>
                <form action="#" method="post">
                <div class="">
            <div class="col">
               <label>Email:</label>
               <input type="email" name="u_email" placeholder="name@example.com" required>
            </div>
            <div class="col">
               <label>First Name:</label>
               <input type="text" name="u_first_name" placeholder="YOUR FIRST NAME" required>
            </div>
            <div class="col">
               <label>Last Name:</label>
               <input type="text" name="u_last_name" placeholder="YOUR LAST NAME" required>
            </div>

            <div class="col">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="u_phonenumber" placeholder="Your Phone Number">
            </div>
         </div>

         <div class="col1">
            <label>Message:</label>
            <input type="text" name="u_message" placeholder="YOUR MESSAGE" required>
         </div>

         <div class="button-group">
            <button type="submit" class="btn btn-success" name="submit" required >Save</button>
            <button type="button" onclick="window.location.href='index.php';">Check</button>
         </div>
</div>

<div class="contact-details">
                <h2>Live Help</h2>
                <p>If you have an issue or question that requires immediate assistance, you can click the button below to chat live with a Customer Service representative. If we aren’t available, drop us an email to the left and we will get back to you within 20-36 hours!</p>
                
                <p><strong>Call Us:</strong><a href="tel:+0715688517"> 0715688517</a></p>
                <p><strong>Email:</strong> <a href="mailto:groupworksliit5@gmail.com">groupworksliit5@gmail.com</a></p>
                <p><strong>Address:</strong> No. 76/1, Kandy Road, Kiribathgoda</p>
                <p><strong>Opening Hours:</strong> Everyday : 9:00AM - 10:00PM</p>
            </div>

                </form>
            </div>



            


        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63341.22435624671!2d79.92215764990814!3d6.956320160502736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae257437a99347d%3A0x678690d25d152517!2sThilakawardhana%20Textiles%20(Pvt)%20Ltd!5e0!3m2!1sen!2slk!4v1696201517012!5m2!1sen!2slk"
                width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>

    <footer>
        <a href="../AboutUs.html">About Us</a> |
        <a href="../add_new.php">Contact Us</a> |
        <a href="../Terms&Conditions.html">Terms & Conditions</a> |
        <a href="../FAQ.html">FAQs</a>
    </footer>
</body>
</html>


