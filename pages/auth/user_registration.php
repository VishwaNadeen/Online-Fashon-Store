<?php
    include(__DIR__ . '/../../config/config.php');

    if(isset($_POST['submit']))
    {
        $u_username = mysqli_real_escape_string($conn, $_POST['username']);
        $u_useremail = mysqli_real_escape_string($conn, $_POST['email']);
        $u_userpassword = mysqli_real_escape_string($conn, $_POST['password']);
        $conf_u_userpassword = mysqli_real_escape_string($conn, $_POST['con-password']);
        $u_fullname = mysqli_real_escape_string($conn, $_POST['fname']);
        $u_gender = mysqli_real_escape_string($conn, $_POST['gender-type']);
        $u_phonenumber = mysqli_real_escape_string($conn, $_POST['phone']);
        $u_address = mysqli_real_escape_string($conn, $_POST['address']);

        // Check if passwords match
        if($u_userpassword !== $conf_u_userpassword) {
            echo "<script>alert('Passwords do not match');</script>";
        } else {
            // Insert query with prepared statements
            $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_name, user_gender, user_address, user_mobile) 
                             VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($stmt, "sssssss", $u_username, $u_useremail, $u_userpassword, $u_fullname, $u_gender, $u_address, $u_phonenumber);

            $sql_execute = mysqli_stmt_execute($stmt);

            if($sql_execute)
            {
                header('Location: /Online-Fashon-Store/pages/auth/user_login.php');
                exit();  // Ensure no further code is executed after redirection
            }
            else
            {
                die(mysqli_error($conn));
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="/Online-Fashon-Store/assets/css/user_registration.css">
    <link rel="stylesheet" href="/Online-Fashon-Store/assets/css/header.css">
    <link rel="stylesheet" href="/Online-Fashon-Store/assets/css/footer.css">
</head>

<body>

    <div class="signup-container">
       

        <form action="" method="post" class="signup-form" onsubmit="return validateDetails(event)">
            
            <h1>Registration Form</h1>

            <!-- Username -->
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Enter username" name="username" required>
            
            <!-- Email -->
            <!-- Username -->
            <label for="email">email</label>
            <input type="text" id="email" placeholder="Enter email" name="email" required>

            <!-- Password -->
            <label for="password">Password</label>
            <input type="password" id="pass" placeholder="Enter Password" name="password" required>

            <!-- Confirm Password -->
            <label for="con-password">Confirm Password</label>
            <input type="password" id="conpass" placeholder="Re-Enter password" name="con-password" required>
            
            <!-- Full Name -->
            <label for="fname">Full Name</label>
            <input type="text" id="fn" placeholder="Full Name" name="fname" required>

            <!-- Gender -->
            <label for="gender">Gender</label>
            <select name="gender-type" id="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <!-- Phone Number -->
            <label for="phone">Phone Number</label>
            <input type="text" id="num" placeholder="Enter Phone Number" name="phone" required>

            <!-- Address -->
            <label for="address">Address</label>
            <input type="text" id="add" placeholder="Address" name="address" required>

            <!-- Privacy Agreement -->
            <div class="terms">
                <input type="checkbox" name="terms" required>
                <label for="terms" id="con">I agree to the <a href="#">Terms and Conditions</a></label>
            </div>

            <!-- Submit Button -->
            <button type="submit" name='submit' class="signup-button">Sign Up</button>
           
            <div class="login-link">
                <p>Already have an account? <a href="/Online-Fashon-Store/pages/auth/user_login.php" class="login">Log In</a></p>
            </div>
        </form>
    </div>
    <script>
        // Function to validate form inputs
        function validateDetails(event) {
            const password = document.getElementById("pass").value;
            const confirmPassword = document.getElementById("conpass").value;
            const phone = document.getElementById("num").value;

            // Password match check
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                event.preventDefault();  // Stop form submission
                return false;
            }

            // Phone number length check (Assuming 10 digits)
            if (phone.length !== 10) {
                alert("Please enter a valid 10-digit phone number.");
                event.preventDefault();  // Stop form submission
                return false;
            }

            // If everything is fine, allow form submission
            return true;
        }
    </script>

</body>
</html>
