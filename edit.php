<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>

  <!-- Custom CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    nav {
      background-color: #00ff5573;
      text-align: center;
      padding: 1em;
      font-size: 1.5em;
      margin-bottom: 20px;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      background-color: white;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
      text-align: center;
      color: #333;
    }

    p {
      text-align: center;
      color: #777;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      max-width: 600px;
      margin: 0 auto;
    }

    label {
      font-weight: bold;
    }

    input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
    }

    .button-group {
      display: flex;
      justify-content: space-between;
      gap: 10px;
    }

    .btn {
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-success {
      background-color: #28a745;
      color: white;
    }

    .btn-danger {
      background-color: #dc3545;
      color: white;
    }

    .btn:hover {
      opacity: 0.9;
    }
  </style>
</head>

<body>
  <nav>
    Contact History
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
      include "config.php";
      if ($_GET['email']) {
          $mail = $_GET['email'];
          $sql = "SELECT * FROM `cupage` WHERE u_email = '$mail' LIMIT 1";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
    ?>

    <form action="#" method="post">
      <div class="row mb-3">
        <div class="col">
          <label>First Name:</label>
          <input type="text" name="first_name" value="<?php echo $row['u_first_name'] ?>">
        </div>

        <div class="col">
          <label>Last Name:</label>
          <input type="text" name="last_name" value="<?php echo $row['u_last_name'] ?>">
        </div>

        <div class="col">
          <label>Phone Number:</label>
          <input type="text" name="u_phonenumber" value="<?php echo $row['u_phonenumber'] ?>">
        </div>
      </div>

      <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $row['u_email'] ?>">
      </div>

      <div class="form-group mb-3">
        <label>Message:</label>
        <input type="text" name="message" value="<?php echo $row['u_message'] ?>">
      </div>

      <?php } ?>
      
      <div class="button-group">
        <button type="submit" class="btn btn-success" name="submit">Update</button>
        <a href="ContactUs.php" class="btn btn-danger">Cancel</a>
      </div>
    </form>
  </div>

</body>

<?php
  if (isset($_POST["submit"])) {
    $u_email = $_POST['email'];
    $u_first_name = $_POST['first_name'];
    $u_last_name = $_POST['last_name'];
    $u_phone_number = $_POST['u_phonenumber'];
    $u_message = $_POST['message'];

    $sql = "UPDATE `cupage` SET `u_first_name`='$u_first_name',`u_last_name`='$u_last_name',`u_email`='$u_email',`u_phonenumber`='$u_phone_number',`u_message`='$u_message' WHERE u_email = '$u_email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: ContactUs.php?msg=Data updated successfully");
    } else {
      echo "Failed: " . mysqli_error($conn);
    }
  }
?>

</html>
