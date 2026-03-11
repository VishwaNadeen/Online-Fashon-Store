<?php
    $server="localhost";
    $user ="root";
    $password="";
    $db ="mystore";
    
    $conn = mysqli_connect($server,$user,$password,$db);
    
    if(!$conn){
        die("connection error");
    }

    
?>