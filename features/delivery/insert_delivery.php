<?php

require 'config.php';

$name = $_POST["name"];
$address = $_POST["address"];
$city = $_POST["city"];
$province = $_POST["province"];
$pcode = $_POST["postalCode"];
$phone = $_POST["phone"];

$sql = "INSERT INTO delivery ( name, address, city, province, pcode, phone) VALUES ('$name', '$address', '$city', '$province', '$pcode', '$phone')";

if($conn->query($sql)){
        // Redirect to read.php after successful insertion
        header("Location: ../delivery/read_delivery.php");
        exit(); // Ensure no further script execution after redirection

}


else {
    echo "Error: " . $sql . "<br>" . $conn->error; // Optional: Output error for debugging
}

$conn->close();

?>
