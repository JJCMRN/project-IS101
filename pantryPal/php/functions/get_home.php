<?php 
    session_start();
    include_once "config.php";
    $sql = mysqli_query($conn, "SELECT * FROM messages");
    $output = "";

    if (mysqli_num_rows($sql) == 1) {
        $output .= "No data";
    } elseif (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '<div class="chat-outgoing">
                            <div class="details">
                                <div class="image-content">
                                    <p>File Name : <i>'. $row['image_name'] .'</i></p>
                                    <p>Menu Name : <i> '. $row['menu_image_name'] .'</i></p>
                                </div>
                                <img src="functions/image_uploaded/img'. $row['image'] .'" alt="Image Sent">
                            </div>
                            <p> Sent : '. $row['msg_date'] . ' (m/d/Y)' .'</p>
                        </div>';
        }
    }
    echo $output;
?>