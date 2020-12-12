<?php 
    $conn=new mysqli("localhost", "root", "", "divimart");
    if($conn->connect_error){
        die("Connect Failed". $conn->connect_error);
    }
?>