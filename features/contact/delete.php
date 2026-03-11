<?php
include "db_conn.php";
$u_email = $_GET["email"];

$sql = "DELETE FROM `cupage` WHERE u_email= '$u_email'";/* methanin wenne adhala coloum u email eke mail eka delete wenna cord eka*/
$result = mysqli_query($conn, $sql);

if ($result) {
	echo "
    <script>alert('delete successfully');
    document.location.href ='index.php';
    </script>
    ";//alert box ekak opean wennawa

} else {
  echo "Failed: " . mysqli_error($conn);
}

?>