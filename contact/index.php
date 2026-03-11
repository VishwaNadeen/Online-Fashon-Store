<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="ContactUs.css">
  <link rel="icon" href="images/icon.png"/>

 
  <title> CONTACT US</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .navbar {
      background-color: #00ff5573;
      padding: 1rem;
      text-align: center;
      font-size: 24px;
    }

    .container {
      width: 80%;
      margin: 2rem auto;
      background-color: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #333;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .table-action {
      color: black;
      cursor: pointer;
      margin-right: 10px;
      text-decoration: none;
    }

    .table-action i {
      font-size: 18px;
    }

    .table-action:hover {
      color: #555;
    }

    .btn {
      display: inline-block;
      padding: 10px 15px;
      margin-top: 1rem;
      color: white;
      background-color: #333;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #555;
    }

    .alert {
      background-color: #f8d7da;
      color: #721c24;
      padding: 15px;
      margin-bottom: 1rem;
      border-radius: 5px;
      border: 1px solid #f5c6cb;
    }

  </style>

</head>

<body>

  <div class="navbar">Complete the form below to give information</div>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert">
        ' . $msg . '
      </div>';
    }
    ?>

   

    <table>
      <thead>
        <tr>
          <th scope="col">Email</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Message</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `cupage`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["u_email"] ?></td>
            <td><?php echo $row["u_first_name"] ?></td>
            <td><?php echo $row["u_last_name"] ?></td>
            <td><?php echo $row["u_phonenumber"] ?></td>
            <td><?php echo $row["u_message"] ?></td>
            <td>
              <a href='edit.php?email=<?php echo $row["u_email"]; ?>' class='table-action'>
                <i class='fa-solid fa-pen-to-square'></i> Edit
              </a>
              <a href='delete.php?email=<?php echo $row["u_email"]; ?>' class='table-action'>
                <i class='fa-solid fa-trash'></i> Delete
              </a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

</body>
</html>
