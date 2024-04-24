<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, ($_SESSION['user_id']));
        $output = "";

        $sql = "SELECT * FROM `messages` WHERE outgoing_msg_id = '{$outgoing_id}' ORDER BY msg_id ASC";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                if ($row['outgoing_msg_id'] === $outgoing_id && $row['menu_image_name'] === "Object Name") {
                    $output .= '<div class="chat-outgoing">
                                    <div class="details">
                                        <div class="image-content">
                                            <p>Menu Name</p>
                                            <p id="menu-name">- '. $row['image_name'] .'</p>
                                        </div>
                                        <img src="functions/image_uploaded/img'. $row['image'] .'" alt="Image Sent">
                                    </div>
                                    <p> Sent : '. $row['msg_date'] .'</p>
                                </div>';
                    } 
                    else if ($row['image_name'] === "") {
                        $output .= '<div class="chat-incoming">
                                        <div class="details">
                                            <div class="image-content">
                                                <p>'. $row['menu_image_name'] .'</p>
                                            </div>
                                        </div>
                                        <p> Sent : '. $row['msg_date'].'</p>
                                    </div>';
                    } else {
                        echo "get_home.php can't find data";
                    }
            }
        } else {
            $output .= '<div class="begin">Want to know about details of dishes? Upload here and let me guide you</div>';
        }
        echo $output;
    } else {
        header("location : ../php/login.php");
    }
?>
