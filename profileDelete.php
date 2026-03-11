<?php
include('config.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure that the ID is an integer

    // SQL query to delete the car
    $sql = "DELETE FROM user_table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Bind the ID parameter

    if ($stmt->execute()) {
        // Redirect back to the car list with a success message
        header("Location: profileRead.php?message=Car deleted successfully");
    } else {
        // Redirect back with an error message
        header("Location: profileRead.php?message=Error deleting car");
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>