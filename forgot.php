<?php
include('config.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the username parameter is set
if (!isset($_GET['username'])) {
    die("Username parameter is missing.");
}

// Retrieve the username from the query parameter
$username = $_GET['username'];

// Fetch the user details for the given username
$sql = "SELECT * FROM user_table WHERE username = ?"; // Ensure this matches your database table
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing the SQL statement: " . $conn->error);
}

$stmt->bind_param("s", $username); // Use "s" since username is a string
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user details were found
if (!$user) {
    die("User not found");
}

// Variable to store success or error message
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password']; // Get the new password

    // Update user password
    $updateSql = "UPDATE user_table SET user_password = ? WHERE username = ?"; // Ensure this matches your database table
    $updateStmt = $conn->prepare($updateSql);

    if ($updateStmt === false) {
        $message = "Error preparing the SQL update statement: " . $conn->error;
    } else {
        $updateStmt->bind_param("ss", $newPassword, $username); // Corrected parameter binding

        if ($updateStmt->execute()) {
            $updateStmt->close();
            $conn->close();
            // Redirect to user login after successful update
            header("Location: user_login.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            $message = "Update unsuccessful: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forgot.css">
    <title>Update Password</title>
</head>
<body>
    <div class="login-container">
        <h1>Update Password</h1>
        <form action="" method="POST" class="login-form" id="login-form">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required readonly>

            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="login-button">Update</button>

            <div class="signup-link">
                <p>Don't have an account? <a href="#" class="sign-up">Sign Up</a></p>
            </div>

            <?php if ($message): ?>
                <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
