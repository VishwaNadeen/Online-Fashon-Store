<?php
include(__DIR__ . '/../../config/config.php');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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
        header("Location: /Online-Fashon-Store/admin/users/profileRead.php?message=Car deleted successfully");
    } else {
        // Redirect back with an error message
        header("Location: /Online-Fashon-Store/admin/users/profileRead.php?message=Error deleting car");
    }

    $stmt->close();
}

// Close the database connection
mysqli_close($conn);
?>