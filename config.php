<?php
    $server = "sql210.epizy.com";
    $user = "epiz_31443331";
    $pass = "6JlHHEK3BaP";
    $db = "epiz_31443331_mobile_reload";

    $con = mysqli_connect($server,$user,$pass,$db);

    if(!$con){
        die("Connection LOST ....!".mysqli_connect_error());
    }
?>