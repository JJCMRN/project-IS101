<?php 
    require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.
    include_once '../pantryPal/php/functions/dish.php';

    use Orhanerday\OpenAi\OpenAi;

    $open_ai_key = 'sk-proj-u8FxFAzLTEnYDXdoGMYkT3BlbkFJBs9eUi4bewgV3j6SMSuJ';

    $open_ai = new OpenAi($open_ai_key);

    $prompt = 'This is a menu '. $menu_name .'';

    echo $prompt;

    $complete = $open_ai->completion([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => ''.$prompt.'',
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
     ]);
    

    if ($complete != null) {

        $response = json_decode($complete, true);
        $response = $response['choices'][0]['text'];
        
        echo $response;
    }
?>