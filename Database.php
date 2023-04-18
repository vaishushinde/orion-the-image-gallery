<?php
    $conn = mysqli_connect('localhost', 'root', '', 'orionweb');
    if(!$conn){
        echo "Database not connected";
    }
    
?>