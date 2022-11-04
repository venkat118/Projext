<?php
    $serverName = "localhost";
    $user = "root";
    $password = "";
    $db = "csit314";

    try{
        $conn = mysqli_connect($serverName , $user, $password, $db);
    }
    catch(mysqli_sql_exception $e){
        die("Connection failed: " . mysqli_connect_errno(). " - " . mysqli_connect_error());
    }
?>