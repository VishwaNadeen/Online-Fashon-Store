<?php
    session_start(); // Start the session to track the user's login status
    include('config.php'); // Include your database connection file

    if(isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Query to check if the user exists with the entered email
        $query = "SELECT * FROM user_table WHERE user_email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['user_password'];

            // Check if the input password matches the stored password
            if($password === $db_password) {
                // Password matches, set session variables for login
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['user_id']; // Store user ID for future actions
                header('Location: Home.html'); // Redirect to the user's dashboard
                exit();
            } else {
                echo "<script>alert('Incorrect password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('No account found with that email address.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="login.css">

</head>
<body>

    <div class="login-container">
        <form action="" method="post" class="login-form">
            <h1>Login</h1>

            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter your email" name="email" required>

            <!-- Password -->
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter your password" name="password" required>

            <!-- Submit Button -->
            <button type="submit" name="login" class="login-button">Login</button>

            <div class="signup-link">
                <p>Don't have an account? <a href="user_registration.php">Sign Up</a></p>
                <a href="admin.html">Admin LogIn</a>
            </div>
        </form>
    </div>

</body>
</html>
