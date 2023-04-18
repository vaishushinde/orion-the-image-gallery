<?php
    include("./Database.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $filename = "";
        $filename = $_FILES['uploadfile']['name'];

        if($filename != ""){
            // destination of the file on the server
            $destination = '../uploads/' . $filename;
            // get the file extension
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['uploadfile']['tmp_name'];
            $size = $_FILES['uploadfile']['size'];

            if (!in_array(strtolower($extension), ['zip', 'pdf', 'jpg', 'png', 'jpeg'])) {
                echo "You file extension must be image or pdf format";
            } elseif ($_FILES['uploadfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
                echo "File too large! must be 1MB";
            } else {
                // check if account exists
                $check = mysqli_query($conn, "SELECT * FROM `accounts` WHERE email='$email' AND pass='$pass'") or die(mysqli_error($conn));
                if($check){
                    if(mysqli_num_rows($check) > 0){
                        if (move_uploaded_file($file, $destination)) {
                            $quary = "UPDATE `accounts` SET `file` = '$filename' WHERE email='$email'";
                            $res = mysqli_query($conn, $quary) or die(mysqli_error($con));
                            if ($res) {
                                echo "Thankyu for your Contribute, your file has been added.";
                            } else {
                                echo "We are not able to accept your contribution.";
                            }
                        } else {
                            echo "Failed to upload contribution file.";
                        }
                    }else{
                        echo "No account was found!";
                    }
                }else{
                    echo "No account was found";
                }
            }
        }    
    }
?>