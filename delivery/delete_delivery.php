<?php

require 'config.php';

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Make sure it's an integer to prevent SQL injection

    // Prepare SQL statement to delete the record
    $sql = "DELETE FROM delivery WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the read_delivery.php page after successful deletion
        header("Location: read_delivery.php?");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();

?>

