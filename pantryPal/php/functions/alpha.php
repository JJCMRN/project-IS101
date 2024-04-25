<?php 
    include_once "config.php";
    $outgoing_id = "463025258";

    $sql = "SELECT * FROM messages
    WHERE outgoing_msg_id = '{$outgoing_id}' AND menu_image_name != 'Object Name'
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

    echo $menu_name;
?>