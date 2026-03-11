<?php
// Database connection details
$servername = "localhost"; // Your database server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "mystore"; // Your database name
$port = "3306";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['add_product'])) {
    // Get form data
    $car_name = $_POST['Car_name'];
    $reg_no = $_POST['RegNo1'];
    $car_model = $_POST['CM'];
    $seats = $_POST['Seats'];
    $capacity = $_POST['capacity'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO pro (pName, pPrice, Qty , size, Edate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $car_name, $reg_no, $car_model, $seats, $capacity);

    // Execute the statement
    if ($stmt->execute()) {
        //echo "New car details added successfully!";
        header("Location: pread.php");
        exit(); // Ensure script stops after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
