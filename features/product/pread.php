<?php
// Database connection details
$servername = "localhost"; // Your database server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "mystore"; // Your database name
$port = "3306";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all car details
$sql = "SELECT * FROM pro";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product Details</title>
    <link rel="stylesheet" href="styleAA.css">
    
</head>
<body>

    <div class="container">
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Expire Date </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['pName'] . "</td>";
                        echo "<td>" . $row['pPrice'] . "</td>";
                        echo "<td>" . $row['Qty'] . "</td>";
                        echo "<td>" . $row['size'] . "</td>";
                        echo "<td>" . $row['Edate'] . "</td>";
                        echo "<td>";
                        echo '<a href="pupdate.php?id=' . $row['id'] . '"><button class="edit-btn">Edit</button></a>';
                        echo '<a href="pdelete.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this products?\');"><button class="delete-btn">Delete</button></a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No Product Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
