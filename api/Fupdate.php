<?php
include(__DIR__ . '/../config/config.php');

// Retrieve the car ID from the query parameter
$id = $_GET['id'];

// Fetch the car details for the given ID
$sql = "SELECT * FROM faqq WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing the SQL statement: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();

// Check if car details were found
if (!$car) {
    die("Car not found");
}

// Variable to store success or error message
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Cname = $_POST['Cname']; // Correctly get the input value

    // Update car details
    $updateSql = "UPDATE faqq SET fqs = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);

    if ($updateStmt === false) {
        $message = "Error preparing the SQL update statement: " . $conn->error;
    } else {
        $updateStmt->bind_param("si", $Cname, $id); // Correctly bind the parameters

        if ($updateStmt->execute()) {
            $updateStmt->close();
            $conn->close();
            // Redirect to Fread.php after successful update
            header("Location: Fread.php");
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
    <title>Edit Car Details</title>
    <link rel="stylesheet" href="/Online-Fashon-Store/assets/css/style2.css">
</head>
<body>
    <div class="container">
        <h2>Edit Car Details</h2>
        
        <!-- Display the message after update attempt -->
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST" name="update">
            <label for="Cname">Answer :</label>
            <input type="text" id="Cname" name="Cname" value="<?php echo htmlspecialchars($car['fqs']); ?>" required>
            <button type="submit">Update</button>
            <a href="/Online-Fashon-Store/api/Fread.php"><button type="button">Cancel</button></a>
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
