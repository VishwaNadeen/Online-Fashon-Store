<?php
// Include the database configuration file
include('config.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted and the ID is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Get the user ID from the form
    $id = $_POST['id'];

    // Get the form data
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_gender = $_POST['user_gender'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];

    // Prepare the UPDATE SQL statement
    $sql = "UPDATE user_table SET user_name=?, user_email=?, user_gender=?, user_address=?, user_mobile=? WHERE id=?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("sssssi", $user_name, $user_email, $user_gender, $user_address, $user_mobile, $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
} else {
    // Fetch the user details for the given ID if the form is not submitted yet
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // SQL query to fetch user details
        $sql = "SELECT * FROM user_table WHERE id=?";
        
        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters
            $stmt->bind_param("i", $id);

            // Execute the query
            $stmt->execute();
            
            // Get the result
            $result = $stmt->get_result();

            // Fetch the user data
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $user_name = $row['user_name'];
                $user_email = $row['user_email'];
                $user_gender = $row['user_gender'];
                $user_address = $row['user_address'];
                $user_mobile = $row['user_mobile'];
            } else {
                echo "No user found with the given ID.";
                exit;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing the query: " . $conn->error;
        }
    } else {
        echo "Invalid request.";
        exit;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h2>Edit User Profile</h2>
        <form method="POST" action="profileUpdate.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="user_name">Name:</label>
            <input type="text" id="user_name" name="user_name" value="<?php echo $user_name; ?>" required>

            <label for="user_email">Email:</label>
            <input type="email" id="user_email" name="user_email" value="<?php echo $user_email; ?>" required>

            <label for="user_gender">Gender:</label>
            <input type="text" id="user_gender" name="user_gender" value="<?php echo $user_gender; ?>" required>

            <label for="user_address">Address:</label>
            <input type="text" id="user_address" name="user_address" value="<?php echo $user_address; ?>" required>

            <label for="user_mobile">Mobile:</label>
            <input type="text" id="user_mobile" name="user_mobile" value="<?php echo $user_mobile; ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
