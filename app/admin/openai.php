<?php
$openApiKey = "";

$searchkeyWord = "I have a staff category on my system and i conduct a survey

The results are:

Staff
Emoji-based ratings:
Very happy = 20%
Happy = 24%
Neutral = 16%
Angry = 20%
Very Angry = 20%


Based on the conducted survey, can you give me the best recommendation to improve staff category on emoji-based. Only show the result for highest percentage on each staff category and only show the percentage not the emotion and summarize the recommendation."; // Your survey content

$data = [
    "model" => "gpt-3.5-turbo",
    "messages" => [
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
    $decodedResponse = json_decode($response, true);

    // Check if 'choices' array is present and not empty
    if (isset($decodedResponse['choices']) && !empty($decodedResponse['choices'])) {
        // Access the first element of 'choices' array to get the generated content
        $generatedContent = $decodedResponse['choices'][0]['message']['content'];
        echo $generatedContent;
    } else {
        echo 'No valid content found in the response.';
    }
}

curl_close($ch);
?>