<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "mobile_reload";

    $con = mysqli_connect($server,$user,$pass,$db);

    if(!$con){
        die("Connection LOST ....!".mysqli_connect_error());
    }
?>
