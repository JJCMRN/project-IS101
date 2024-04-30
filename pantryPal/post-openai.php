<?php 
    require __DIR__ . '/vendor/autoload.php';
    include_once 'php/functions/config.php';

    use Orhanerday\OpenAi\OpenAi;
    $open_ai_key = 'your_open_ai_api_key';
    $open_ai = new OpenAi($open_ai_key);

    session_start();
    if(isset($_SESSION['user_id'])) {
        include_once 'php/functions/get_dish.php';

        $outgoing_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
        $incoming_id = 3;
        

        $prompt = 'How to cook a Filipino Dish named '. $menu_name .'?,  Give a very short introductory part like you are happy that I want to cook '. $menu_name .' and then you must display its ingredients, instructions, serving size, and nutritional value  in a form of list.';

        $complete = $open_ai->completion([
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => ''. $prompt .'',
            'temperature' => 0.9,
            'max_tokens' => 5000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);

        if ($complete != null) {

            $response = json_decode($complete, true);
            $response = $response['choices'][0]['text'];
            // $php_obj = json_decode($complete);
            // $response = $php_obj->choices[0]->text;

            date_default_timezone_set("Asia/Manila");
            $time = date("h:ia - m/d/Y");

            $response = mysqli_real_escape_string($conn, $response);

            $stmt = $conn->prepare("INSERT INTO messages (msg_id, incoming_msg_id, outgoing_msg_id, menu_image_name, msg_date) 
                        VALUES (NULL, ?, ?, ?, ?)");

            $stmt->bind_param("ssss", $incoming_id, $outgoing_id, $response, $time);

            if ($stmt->execute()) {
                echo "post-openai.php - Successfully Inserted to Database";
            } else {
                echo "post-openai.php - Error: " . $stmt->error;
            }

            $stmt->close();            
        }
    }
?>
