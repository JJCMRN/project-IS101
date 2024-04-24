<?php
    session_start();
    include_once "config.php";
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $outgoing_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
    $incoming_id = 1;
    $object_name = ""; 



    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the raw POST data
        $postData = file_get_contents("php://input");

        $requestData = json_decode($postData, true);

        if (isset($requestData['maxClassPrediction'])) {
            // Extract the maxClassPrediction parameter value
            $maxClassPrediction = $requestData['maxClassPrediction'];

            date_default_timezone_set("Asia/Manila");
            $time = date("h:ia - m/d/Y");
        

            $query = "INSERT INTO messages (msg_id, incoming_msg_id, outgoing_msg_id, image_name, menu_image_name, msg_date) 
                    VALUES (NULL, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iisss", $incoming_id, $outgoing_id, $name, $maxClassPrediction, $time);
                $success = mysqli_stmt_execute($stmt);

                if ($success) {
                    echo json_encode(array('success' => 'Max class prediction inserted successfully'));
                } else {
                    echo json_encode(array('error' => 'Failed to insert max class prediction'));
                }

                mysqli_stmt_close($stmt);
            } else {
                echo json_encode(array('error' => 'Failed to prepare statement'));
            }

        } else {
            // If maxClassPrediction parameter is not provided, send an error response
            echo json_encode(array('error' => 'maxClassPrediction is not provided'));
        }
    } else {
        // If the request method is not POST, send an error response
        echo json_encode(array('error' => 'Invalid request method'));
    }
?>
