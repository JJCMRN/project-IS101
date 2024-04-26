<?php 
    include_once "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
    // $outgoing_id = "463025258";
    $incoming_id = 2;

    $sql = "SELECT * FROM messages
    WHERE outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}'
    ORDER BY msg_id DESC
    LIMIT 1;
    ";

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        
        if (!empty($row)) {

            $menu_name = $row["menu_image_name"];

        } else {
            echo "the row is empty";
        } 
    }
?>