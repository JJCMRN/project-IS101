<?php 
    require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

    use Orhanerday\OpenAi\OpenAi;

    $outgoing_id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);

    
    $open_ai_key = '';

    $open_ai = new OpenAi($open_ai_key);

    $prompt = $_POST['prompt'];

    $complete = $open_ai->completion([
        'model' => 'gpt-3.5-turbo-0125',
        'prompt' => '',
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
     ]);
    
    
    var_dump($complete);

    $response = json_decode($complete, true);

    $response = $response['choices'][0]['text'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            
        </style>
    </head>
<body>
    
</body>
</html>