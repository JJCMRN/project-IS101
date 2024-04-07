<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $confirmPass = mysqli_real_escape_string($conn, $_POST['confirmPass']);
    
    if (!empty($email) && !empty($pass) && !empty($confirmPass)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}' ");
            if (mysqli_num_rows($sql) > 0 ) {
                echo "$email - This email is already exist!";
            } else {
                if ($pass === $confirmPass) {
                    $time = time();
                    $status = "Active now";
                    $random_id = rand(time(),1000000);

                    $sql2 = mysqli_query($conn, "INSERT INTO users (user_id, email, password, status)
                                                    VALUES ('{$random_id}', '{$email}', '{$pass}', '{$status}')");
                    if ($sql2) {
                        $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        if (mysqli_num_rows($sql3) > 0) {
                            $row = mysqli_fetch_assoc($sql3);
                            $_SESSION['user_id'] = $row['user_id'];
                            echo "success";
                        }
                    }
                } else {
                    echo "The password not match";
                }
                
            }
        } else {
            echo "$email - The email is invalid";
        }
    }
    else {
        echo "All data must fill";
    }
?>