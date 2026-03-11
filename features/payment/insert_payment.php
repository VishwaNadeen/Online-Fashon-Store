<?php
require 'config.php';

if(isset($_POST["submit"])){
    $cardNo = $_POST["cardNumber"];
    $exDate = $_POST["expiryDate"];
    $cvv = $_POST["cvv"];
    $cardName = $_POST["cardName"];
    $holderName = $_POST["cardHolderName"];

    // Insert the payment details into the database
    $sql = "INSERT INTO payment (cNumber, exDate, cvv, cName, holderName) VALUES ('$cardNo','$exDate', '$cvv', '$cardName', '$holderName')";

    if($conn->query($sql)) {
        echo "Insert Successful";
        // Redirect to the read_payment.php page
        header("Location: read_payment.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
