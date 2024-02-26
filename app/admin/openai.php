<?php
    $openApiKey = "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";

    $searchkeyWord = "I have a 3 category on my system and i conduct a survey

    Staff
    Facility
    Service
    
    The results are:
    
    Staff
    Emoji-based ratings:
    Very happy = 20%
    Happy = 24%
    Neutral = 16%
    Angry = 20%
    Very Angry = 20%
    
    Text-based ratings:
    Positive = 40%
    Neutral = 30%
    Negative = 30%
    Most used word = Accommodating (positive)
    
    Facility
    Emoji-based ratings:
    Very happy = 80%
    Happy = 14%
    Neutral = 2%
    Angry = 2%
    Very Angry = 2%
    
    
    Text-based ratings:
    Positive = 90%
    Neutral = 2%
    Negative = 8%
    Most used word = Mainit (negative)
    
    Service
    Emoji-based ratings:
    Very happy = 2%
    Happy = 14%
    Neutral = 2%
    Angry = 2%
    Very Angry = 80%
    
    
    Text-based ratings:
    Positive = 20%
    Neutral = 30%
    Negative = 50%
    Most used word = Poor (negative)
    
    
    Based on the conducted survey, can you give me the best recommendation to improve each category on emoji-based and text-based, focus the recommendation on text-based depends on the most used word. Separate the recommendation for emoji-based and text-based .Only show the result for highest percentage on each category and only show the percentage not the emotion";

    $data = [
          "model" => "gpt-3.5-turbo",
          "messages" =>[
            [
             "role" => "user",
             "content" => $searchkeyWord,
            ]
           ],
           "temperature" => 0.5,
           "max_tokens" => 200,
           "top_p" => 1.0,
           "frequency_penalty" => 0.52,
           "presence_penalty" => 0.5,
           "stop" => "[11.]",
           ];
           
           $ch = curl_init(); // Corrected function name

           curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($ch, CURLOPT_POST, 1);
           curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
           
           $header = []; // Corrected variable name
           
           $header[] = 'Content-Type: application/json'; // Fixed the header format
           $header[] = 'Authorization: Bearer ' . $openApiKey; // Added space after Bearer
           
           curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // Changed to correct variable name
           
           $response = curl_exec($ch);
           
           if (curl_errno($ch)) {
               echo 'Error: ' . curl_error($ch);
           } else {
               echo "<pre>";
               print_r($response);
           }
           
           curl_close($ch);
?>

<div class="card-2">
    <div class="card-title">
        <p>Recommendations</p>

        <?php
$openApiKey = "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";

$searchkeyWord = "hello";

$data = [
    "model" => "gpt-3.5-turbo",
    "messages" =>[
        [
            "role" => "user",
            "content" => $searchkeyWord,
        ]
    ],
    "temperature" => 0.5,
    "max_tokens" => 200,
    "top_p" => 1.0,
    "frequency_penalty" => 0.52,
    "presence_penalty" => 0.5,
    "stop" => "[11.]",
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$header = [];
$header[] = 'Content-Type: application/json';
$header[] = 'Authorization: Bearer ' . $openApiKey;
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    $responseData = json_decode($response, true);
    // Check if the response contains any messages
    if(isset($responseData['choices'][0]['message']['content'])){
        echo "Completion: " . $responseData['choices'][0]['message']['content'];
    } else {
        echo "No completion found.";
    }
}

curl_close($ch);
?>