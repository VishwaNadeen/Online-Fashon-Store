
<link rel="stylesheet" href="footer.css">

<?php
require 'config.php';

// Check if 'id' is present in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure 'id' is an integer
    
    // Fetch the current record from the database
    $sql = "SELECT cNumber, exDate, cvv, cName, holderName FROM payment WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found.";
        exit();
    }
    
    $stmt->close();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use the correct form field names
    $cardNo = $_POST["cardNumber"];
    $exDate = $_POST["expiryDate"];
    $cvv = $_POST["cvv"];
    $cardName = $_POST["cardName"];
    $holderName = $_POST["cardHolderName"];

    // Prepare an SQL query to update the record
    $sql = "UPDATE payment SET cNumber = ?, exDate = ?, cvv = ?, cName = ?, holderName = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $cardNo, $exDate, $cvv, $cardName, $holderName, $id);

    // Execute the query and check for success
    if ($stmt->execute()) {
        // Redirect back to read_payment.php with success message
        header("Location: read_payment.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!-- Display the update form with pre-filled values -->
<!DOCTYPE html>
<head>
    <title>Update Record</title>
    
   <!--Internal CSS Part --> 
    <style>


* {
    font-family: "Montserrat", sans-serif;
}
        
/* General body styling */
body {
    background-color: #333; /*body color kassanay*/
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

/* Form container */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

label {
    display: block;
    font-size: 14px;
    margin-bottom: 8px;
    color: #333;
}

input[type="text"], input[type="date"], select, #expiryDate {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
    color: #333;
}



/* Submit button */
input[type="submit"] {
    width: 100%;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 12px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: orange;
}

/* Centering the buttons container */
#buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
}

/* Styling for the Update button */
#update {
    width: 150px;
    background-color: orange;
    color: #fff;
    border: none;
    padding: 8px;
    font-size: 13px;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
}

#update:hover {
    background-color: #ff9800;
}

/* Styling for the Go Back button */
#goBack {
    width: 150px;
    padding: 8px;
    background-color: #6c757d;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 13px;
    cursor: pointer;
    text-align: center;
}

#goBack:hover {
    background-color: #5a6268;
}
    </style>


</head>

<body>

<form method="post" action="">
    <h2>Update Card Details</h2>

    <label for="cardNumber">Card Number:</label>
<input type="text" id="cardNumber" name="cardNumber" value="<?php echo htmlspecialchars($row['cNumber']); ?>" required maxlength="19" oninput="formatCardNumber(this)"> <br>

    <label for="expiryDate">Expiry Date:</label>
    <input type="month" id="expiryDate" name="expiryDate" value="<?php echo htmlspecialchars($row['exDate']); ?>" required><br>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" value="<?php echo htmlspecialchars($row['cvv']); ?>" required maxlength="3" ><br>

    <label for="cardName">Name:</label>
    <input type="text" id="cardName" name="cardName" value="<?php echo htmlspecialchars($row['cName']); ?>" required oninput = "capitalization(this)"><br>

    <label for="cardHolderName">Card holder name:</label>
    <input type="text" id="cardHolderName" name="cardHolderName" value="<?php echo htmlspecialchars($row['holderName']); ?>" required oninput = "capitalization(this)"><br>

    <div id="buttons">
        <input id="update" type="submit" value="Update">

        <button id="goBack">Go Back</button>
    </div>

</form>

<footer>
        <a href="/Online-Fashon-Store/pages/info/AboutUs.html">About Us</a> |
        <a href="ContactUs.html">Contact Us</a> |
        <a href="/Online-Fashon-Store/pages/info/Terms&Conditions.html">Terms & Conditions</a> |
        <a href="#">FAQs</a>
    </footer>

<script src="updatejava.js"></script>

</body>
</html>

