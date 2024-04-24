<?php
    session_start();
    if(isset($_SESSION['user_id'])) {
        include_once "config.php";
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = "1";
        $object_name = "Object Name";
        $object_name1 = "";

        if(!empty($name)) {

                if ($_FILES["image"]["error"] === 4 ) {
                    echo "Image Does not Exist";
                }
                else {
                    
                    $filename = $_FILES["image"]["name"];
                    $fileSize = $_FILES["image"]["size"];
                    $tmpName = $_FILES["image"]["tmp_name"];

                    // Get the file extension using pathinfo
                    $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    $validImageExtension = ['jpg', 'png', 'jpeg'];

                    if (!in_array($imageExtension, $validImageExtension)){
                        echo "Invalid Image Extension";
                    } elseif ($fileSize > 10000000) {
                        echo "Image Size is too large";
                    }
                    else {
                        $newImageName = uniqid();
                        $newImageName .= '.'. $imageExtension;
        
                        move_uploaded_file($tmpName, 'image_uploaded\img' . $newImageName);

                        date_default_timezone_set("Asia/Manila");
                        $time = date("h:ia - m/d/Y");
       
                        $query = "INSERT INTO messages (msg_id, incoming_msg_id, outgoing_msg_id, image_name, menu_image_name, image, msg_date) 
                              VALUES (NULL, '$incoming_id', '$outgoing_id', '$name', '$object_name', '$newImageName', '$time')";

                        mysqli_query($conn,$query);

                        echo "Successfully Inserted";
                    }
                }
        } else {
            echo "There's no file or/and name";
        }
       
    } else {
        header("location : ../php/login.php");
    }
?>