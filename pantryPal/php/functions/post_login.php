<?php    
    session_start();
    include_once "config.php";

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    if (!empty($email) && !empty($pass)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$pass}'");
            if (mysqli_num_rows($sql) > 0 ) {
                $row = mysqli_fetch_assoc($sql);
                
                $status = "Online";
                $sql1 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE user_id = '{$row['user_id']}' ");

                if ($sql1) {
                    $_SESSION['user_id'] = $row['user_id'];
                    echo "success";
                }
            } else {
                echo "The email or password is incorrect";
            }
        }
         else {
            echo "Email is invalid";
         }
    } else {
        echo "All input field must filled";
    }
?>