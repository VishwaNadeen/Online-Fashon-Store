<?php

$conn = new mysqli("localhost","root","","mystore");

if($conn->connect_error)
{
    die("Connection failed".$conn->connect_error);
}

?>