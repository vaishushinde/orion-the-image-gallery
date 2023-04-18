<?php
    include "Database.php";

    $name = $_POST['name'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $insert = mysqli_query($conn, "INSERT INTO `accounts` VALUES (null, '$name', '$user', '$pass', null)") or die(mysqli_error($conn));
    if($insert){
        echo 1;
    }else{
        echo 0;
    }
?>
