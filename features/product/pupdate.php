
<?php
// Database connection details
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "mystore"; 
$port = "3306";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the product ID from the query parameter
$id = $_GET['id'];

// Fetch the product details for the given ID
$sql = "SELECT * FROM pro WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing the SQL statement: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Check if product details were found
if (!$product) {
    die("Product not found");
}

// Variable to store success or error message
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pName = $_POST['pName'];
    $pPrice = $_POST['pPrice'];
    $Qty = $_POST['Qty'];
    $size = $_POST['size'];
    $Edate = $_POST['Edate'];
   
    // Update product details
    $updateSql = "UPDATE pro SET pName = ?, pPrice = ?, Qty = ?, size = ?, Edate = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);

    if ($updateStmt === false) {
        $message = "Error preparing the SQL update statement: " . $conn->error;
    } else {
        $updateStmt->bind_param("ssiiii", $pName, $pPrice, $Qty, $size, $Edate, $id);

        if ($updateStmt->execute()) {
            $updateStmt->close();
            $conn->close();
            // Redirect to pread.php after successful update
            header("Location: pread.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            $message = "Update unsuccessful: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Details</title>
    <link rel="stylesheet" href="styleBB.css">
</head>
<body>
    <div class="container">
        <h2>Edit Product Details</h2>
        
        <!-- Display the message after update attempt -->
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST" name="update">
            <label for="pName">Enter the product Name:</label>
            <input type="text" id="pName" name="pName" value="<?php echo htmlspecialchars($product['pName']); ?>" required>

            <label for="pPrice">Enter the product price :</label>
            <input type="text" id="pPrice" name="pPrice" value="<?php echo htmlspecialchars($product['pPrice']); ?>" required>

            <label for="Qty">Enter the Quantity :</label>
            <input type="text" id="Qty" name="Qty" value="<?php echo htmlspecialchars($product['Qty']); ?>" required>

            <label for="size">Enter the Size :</label>
            <input type="number" id="size" name="size" value="<?php echo htmlspecialchars($product['size']); ?>" required>

            <label for="Edate">Enter the Expire Date (YYYY-MM-DD):</label>
            <input type="date" id="Edate" name="Edate" value="<?php echo htmlspecialchars($product['Edate']); ?>" required>

            <button type="submit">Update</button>
            <a href="#"><button type="button">Cancel</button></a>
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
