

<link rel="stylesheet" type="text/css" href="readpayment.css">

<?php

require 'config.php';

// Display success message if present
if (isset($_GET['message'])) {
    echo "<p style='color: green;'>" . htmlspecialchars($_GET['message']) . "</p>";
}

// SQL query to select all records from the placeorder table
$sql = "SELECT id, cNumber, exDate, cvv, cName, holderName FROM payment"; //

$result = $conn->query($sql);

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Output the data in a table
    
    
    
    echo "<table border='1'>
            <tr>
                <th>Card Number</th>
                <th>Expiry Date</th>
                <th>CVV Number</th>
                <th>Name</th>
                <th>Card Holder Name</th>
                <th>Action</th>
            </tr>";

    // Loop through and display each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["cNumber"] . "</td>
                <td>" . $row["exDate"] . "</td>
                <td>" . $row["cvv"] . "</td>
                <td>" . $row["cName"] . "</td>
                <td>" . $row["holderName"] . "</td>
                <td>
                    <a href='delete_payment.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                    |
                    <a href='update_payment.php?id=" . $row["id"] . "'>Edit</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

// Close the database connection
$conn->close();



?>

<!-- Add the button to redirect to the index.php page -->
<br>
<a href="http://localhost/src/Home.html">
    <button>BACK TO HOME</button>
</a> <br>



