<!-- Add the button to redirect to the index.php page -->
<br>
<a href="index_delivary.php">
    <button>Add New</button>
</a> <br><br>


<?php

require 'config.php';

// Display success message if present
if (isset($_GET['message'])) {
    echo "<p style='color: green;'>" . htmlspecialchars($_GET['message']) . "</p>";
}

// SQL query to select all records from the placeorder table
$sql = "SELECT id, country, address, city, pcode, phone FROM placeorder"; // Assume 'id' is the primary key in 'placeorder' table

$result = $con->query($sql);

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Output the data in a table
    echo "<table border='1'>
            <tr>
                <th>Country</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>";

    // Loop through and display each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["country"] . "</td>
                <td>" . $row["address"] . "</td>
                <td>" . $row["city"] . "</td>
                <td>" . $row["pcode"] . "</td>
                <td>" . $row["phone"] . "</td>
                <td>
                    <a href='delete_delivary.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                    |
                    <a href='update_delivary.php?id=" . $row["id"] . "'>Update</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

// Close the database connection
$con->close();


?>



