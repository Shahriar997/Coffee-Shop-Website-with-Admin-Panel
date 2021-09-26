<?php
$server = "localhost";
    $username = "root";
    $password = "";    ////pass in server = t&Z$nEp0J1Q\8[SA 
    $db = "coffeeshop";

    //create connection
    $conn = new mysqli($server,$username,$password,$db);

    if(mysqli_connect_error()){
        echo("Error");
        die('Connect Error('.mysqli_connect_error().')'. mysqli_connect_error());
    }
?>