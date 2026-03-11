<?php
// Include your database connection file
include('config.php');

// Check if the form is submitted
if (isset($_POST['add_product'])) {
    // Get form data and sanitize
    $car_name = trim($_POST['fqs'] ?? '');

    // Validate input
    if (empty($car_name)) {
        die("Error: Input cannot be empty.");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO faqq (fqs) VALUES (?)");
    
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->bind_param("s", $car_name);

    // Execute the statement
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: Fread.php");
        exit();
    } else {
        die("Execution Error: " . $stmt->error);
    }
}

// Close the database connection
$conn->close();
?>
