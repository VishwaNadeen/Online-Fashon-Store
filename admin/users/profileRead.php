<?php
include(__DIR__ . '/../../config/config.php');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to fetch all car details
$sql = "SELECT * FROM user_table";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
    <link rel="stylesheet" href="/Online-Fashon-Store/assets/css/style1.css">
    
</head>
<body>

    <div class="nav">
        <h3>Profile Management</h3>
        <div>
            <a href="/Online-Fashon-Store/pages/home/index.html">Home</a>
            <a href="/Online-Fashon-Store/pages/auth/user_registration.php">Add New</a>
        </div>
    </div>

    <div class="container">
        <h2>Profile Management</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>User Email</th>
                    <th>User's name</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results
                if ($result && mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['user_email'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['user_gender'] . "</td>";
                        echo "<td>" . $row['user_address'] . "</td>";
                        echo "<td>" . $row['user_mobile'] . "</td>";
                        echo "<td>";
                        echo '<a href="/Online-Fashon-Store/profileUpdate.php?id=' . $row['id'] . '"><button class="edit-btn">Edit</button></a>';
                        echo '<a href="/Online-Fashon-Store/profileDelete.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this profile Details ?\');"><button class="delete-btn">Delete</button></a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No cars found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

   

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
