<?php
    session_start();
    include_once "config.php";

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the raw POST data
        $postData = file_get_contents("php://input");

        // Parse the JSON data into a PHP associative array
        $requestData = json_decode($postData, true);

        // Check if the maxClassPrediction parameter is provided
        if (isset($requestData['maxClassPrediction'])) {
            // Extract the maxClassPrediction parameter value
            $maxClassPrediction = $requestData['maxClassPrediction'];

            // Your database insertion code here
            // Example using mysqli
            $query = "INSERT INTO outgoing (picture) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $maxClassPrediction);
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
