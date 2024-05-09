<?php 
    session_start();
    if (isset($_SESSION['user_id'])) {
        include_once "config.php";

        $logout_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
        if (isset($logout_id)) {
            $status = "Offline";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE user_id = '{$logout_id}'");
            if ($sql) {
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }

        } else {
            header("location: ../login.php");
        }

    } else {
        header("Location:../login.php");
        exit;
    }
?>