<?php
include(__DIR__ . '/../config/config.php');

// SQL query to fetch all entries from the faqq table
$sql = "SELECT * FROM faqq";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="/Online-Fashon-Store/assets/css/style1.css">
</head>
<body>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Answer</th>
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
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>"; // Use htmlspecialchars to prevent XSS
                        echo "<td>" . htmlspecialchars($row['fqs']) . "</td>"; // Assuming 'fqs' is the correct column name
                        echo "<td>";
                        echo '<a href="/Online-Fashon-Store/api/Fupdate.php?id=' . htmlspecialchars($row['id']) . '"><button class="edit-btn">Edit</button></a>';
                        echo '<a href="/Online-Fashon-Store/api/Fdelete.php?id=' . htmlspecialchars($row['id']) . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><button class="delete-btn">Delete</button></a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No items found</td></tr>";
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
