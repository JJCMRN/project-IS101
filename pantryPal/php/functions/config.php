<?php 
    $conn = mysqli_connect("localhost", "root", "", "pantryPal");
    if(!$conn) {
        echo "Database not connected" . mysqli_connect_error();
    }
?>