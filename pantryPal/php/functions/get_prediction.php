<?php
    session_start();
    include_once "config.php";
    $sql = mysqli_query($conn, "SELECT * FROM incoming");
    $output = "";

    if (mysqli_num_rows($sql) == 1) {
        $output .= "No data";
    } elseif (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '<div class="chat-incoming">
                            <div class="details">
                                <div class="image-content">
                                    <p>Teachable Machine Response : '. $row['content'] .'</p>
                                </div>
                            </div>
                            <p>earl</p>
                        </div>';
        }
    }
    echo $output;
?>