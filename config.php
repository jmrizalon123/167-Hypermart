<?php 
    $con = mysqli_connect("localhost", "root", "", "divimart");

    if(mysqli_connect_error()) {
        echo "Failed to connect to database0:" . mysqli_connect_error();
    }
?>