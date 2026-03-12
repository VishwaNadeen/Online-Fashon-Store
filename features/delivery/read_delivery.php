
<h2>Shipping Details</h2>

<link rel="stylesheet" type="text/css" href="read.css">

<?php

require '../../config/config.php';

// Display success message if present
if (isset($_GET['message'])) {
    echo "<p style='color: green;'>" . htmlspecialchars($_GET['message']) . "</p>";
}

// SQL query to select all records from the delivery table
$sql = "SELECT id, name, address, city, province, pcode, phone FROM delivery"; // Assume 'id' is the primary key in 'delivery' table

$result = $conn->query($sql);

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Output the data in a table
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>";

    // Loop through and display each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                
                <td>" . $row["name"] . "</td>
                <td>" . $row["address"] . "</td>
                <td>" . $row["city"] . "</td>
                <td>" . $row["province"] . "</td>
                <td>" . $row["pcode"] . "</td>
                <td>" . $row["phone"] . "</td>
                <td>
                    <a href='delete_delivery.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                    |
                    <a href='update_delivery.php?id=" . $row["id"] . "'>Edit</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "
        <table border='1'>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            
            <tr>
                <td colspan='7' style='text-align: center';>No Records Found</td>
            </tr>
            </table>";
}


// Close the database connection
$conn->close();



?>

<!-- Add the button to redirect to the index.php page -->
<br>
<a href="index_delivery.php">
    <button>ADD NEW</button>
</a> 
<br>

<a href="/Online-Fashon-Store/pages/home/index.html">
    <button>BACK TO HOME</button>
</a>

<br>



