<?php
    include "Database.php";

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $check = mysqli_query($conn, "SELECT * FROM `accounts` WHERE email='$user' AND pass='$pass'") or die(mysqli_error($conn));
    if($check){
        if(mysqli_num_rows($check) > 0){
            $data = mysqli_fetch_array($check);
            echo $data['id'];
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
?>