<link rel="stylesheet" type="text/css" href="update_delivery.css">

<?php

require 'config.php';

// Check if 'id' is present in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure 'id' is an integer
    
    // Fetch the current record from the database
    $sql = "SELECT name, address, city, province, pcode, phone FROM delivery WHERE id = ?";
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
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $pcode = $_POST['pcode'];
    $phone = $_POST['phone'];

    // Prepare an SQL query to update the record
    $sql = "UPDATE delivery SET  name = ?, address = ?, city = ?, province = ?, pcode = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $address, $city,  $province, $pcode, $phone, $id);

    // Execute the query and check for success
    if ($stmt->execute()) {
        // Redirect back to read_delivery.php with success message
        header("Location: read_delivery.php?");
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
</head>
<body>


<form method="post" action="">

<h2>Update Card Details</h2>

        

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required oninput="capitalization(this)"><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($row['city']); ?>" required><br>


    <label for="province">Province:</label>
    <select name="province" id="province">
                    <option value="Western Province">Western Province</option>
                    <option value="Central Province">Central Province</option>
                    <option value="North Central Province">North Central Province</option>
                    <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                    <option value="Eastern Province">Eastern Province</option>
                    <option value="Uva Province">Uva Province</option> 
                    <option value="Southern Province">Southern Province</option> 
                    <option value="Northern Province">Northern Province</option>  
                    <option value="North Western">North Western</option> 
                </select> <br><br>

    <label for="pcode">Postal Code:</label>
    <input type="text" id="pcode" name="pcode" value="<?php echo htmlspecialchars($row['pcode']); ?>" required oninput="checkPostalCode(this)" >
    <span id="errorMessage1" style="color: red; font-size: 11px; margin-top: 1px "></span> <br>


    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required oninput="checkPhoneNo(this)">
    <span id="errorMessage2" style="color: red; font-size: 11px; margin-top: 1px "></span> <br>

    <div id = "buttons">
        <input id = "update" type="submit" value="Update" >

        <button id= "goBack" >Go Back</button>
    </div>

</form>

<script src="updatejava.js"></script>

</body>
</html>

