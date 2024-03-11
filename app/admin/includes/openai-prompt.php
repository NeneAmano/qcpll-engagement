<?php
    $openApiKey = "";

// start of emoji query
    // start of query for emoji staff
    $sql_est = "WITH EmojiFeedback AS (
        SELECT 
            e.emoji_id,
            f.answer_id,
            COUNT(*) AS count_per_answer,
            COUNT(*) * 100.0 / SUM(COUNT(*)) OVER (PARTITION BY qc_id) AS percentage
        FROM 
            feedback f
            INNER JOIN questions q USING (question_id) 
            INNER JOIN question_type qt USING (qt_id)
            INNER JOIN question_category qc USING (qc_id) 
            INNER JOIN emoji e ON f.answer_id = e.emoji_id
        WHERE 
            qc.question_category = 'Staff' AND qt.question_type = 'Emoji-based' AND e.in_choices != 0
        GROUP BY 
            e.emoji_id, f.answer_id, qc_id
    )
    
    SELECT 
        e.emoji_id,
        ef.answer_id,
        COALESCE(ef.count_per_answer, 0) AS count_per_answer,  -- Use COALESCE to handle NULL values
        COALESCE(ef.percentage, 0) AS percentage,  -- Use COALESCE to handle NULL values
        e.*  -- Include other columns from the emoji table if needed
    FROM 
        emoji e
        LEFT JOIN EmojiFeedback ef ON e.emoji_id = ef.emoji_id
    WHERE 
        e.in_choices != 0
    ORDER BY 
        e.emoji_id DESC
    LIMIT 5;
    ";
    $result_est = mysqli_query($conn, $sql_est);

    $output_lines_est = array(); // Array to store concatenated values
    // Mapping of emoji_id to labels
    $emoji_labels_est = array(
        110 => 'Very Satisfied',
        109 => 'Satisfied',
        108 => 'Neutral',
        107 => 'Disappointed',
        106 => 'Very Disappointed'
    );

    if(mysqli_num_rows($result_est) > 0){
        while($row_est = mysqli_fetch_assoc($result_est)){
            $emoji_id = $row_est['emoji_id'];
            $image_path = $row_est['image_path'];
            $percentage = $row_est['percentage'];
            $formatted_percentage = number_format($percentage, 1);

            // Get label based on emoji_id
            $label = isset($emoji_labels_est[$emoji_id]) ? $emoji_labels_est[$emoji_id] : 'Unknown';

            // Concatenate and store in array
            $output_lines_est[] = "$label: $formatted_percentage";
        }
    }
    // end of query for emoji staff


    // start of query for emoji service
    $sql_es = "WITH EmojiFeedback AS (
        SELECT 
            e.emoji_id,
            f.answer_id,
            COUNT(*) AS count_per_answer,
            COUNT(*) * 100.0 / SUM(COUNT(*)) OVER (PARTITION BY qc_id) AS percentage
        FROM 
            feedback f
            INNER JOIN questions q USING (question_id) 
            INNER JOIN question_type qt USING (qt_id)
            INNER JOIN question_category qc USING (qc_id) 
            INNER JOIN emoji e ON f.answer_id = e.emoji_id
        WHERE 
            qc.question_category = 'Service' AND qt.question_type = 'Emoji-based' AND e.in_choices != 0
        GROUP BY 
            e.emoji_id, f.answer_id, qc_id
    )
    
    SELECT 
        e.emoji_id,
        ef.answer_id,
        COALESCE(ef.count_per_answer, 0) AS count_per_answer,  -- Use COALESCE to handle NULL values
        COALESCE(ef.percentage, 0) AS percentage,  -- Use COALESCE to handle NULL values
        e.*  -- Include other columns from the emoji table if needed
    FROM 
        emoji e
        LEFT JOIN EmojiFeedback ef ON e.emoji_id = ef.emoji_id
    WHERE 
        e.in_choices != 0
    ORDER BY 
        e.emoji_id DESC
    LIMIT 5;
    ";
    $result_es = mysqli_query($conn, $sql_es);

    $output_lines_es = array(); // Array to store concatenated values
    // Mapping of emoji_id to labels
    $emoji_labels_es = array(
        110 => 'Very Satisfied',
        109 => 'Satisfied',
        108 => 'Neutral',
        107 => 'Disappointed',
        106 => 'Very Disappointed'
    );

    if(mysqli_num_rows($result_es) > 0){
        while($row_es = mysqli_fetch_assoc($result_es)){
            $emoji_id = $row_es['emoji_id'];
            $image_path = $row_es['image_path'];
            $percentage = $row_es['percentage'];
            $formatted_percentage = number_format($percentage, 1);

            // Get label based on emoji_id
            $label = isset($emoji_labels_es[$emoji_id]) ? $emoji_labels_es[$emoji_id] : 'Unknown';

            // Concatenate and store in array
            $output_lines_es[] = "$label: $formatted_percentage";
        }
    }
    // end of query for emoji service

    // start of query for emoji facility
    $sql_ef = "WITH EmojiFeedback AS (
        SELECT 
            e.emoji_id,
            f.answer_id,
            COUNT(*) AS count_per_answer,
            COUNT(*) * 100.0 / SUM(COUNT(*)) OVER (PARTITION BY qc_id) AS percentage
        FROM 
            feedback f
            INNER JOIN questions q USING (question_id) 
            INNER JOIN question_type qt USING (qt_id)
            INNER JOIN question_category qc USING (qc_id) 
            INNER JOIN emoji e ON f.answer_id = e.emoji_id
        WHERE 
            qc.question_category = 'Facility' AND qt.question_type = 'Emoji-based' AND e.in_choices != 0
        GROUP BY 
            e.emoji_id, f.answer_id, qc_id
    )

    SELECT 
        e.emoji_id,
        ef.answer_id,
        COALESCE(ef.count_per_answer, 0) AS count_per_answer,  -- Use COALESCE to handle NULL values
        COALESCE(ef.percentage, 0) AS percentage,  -- Use COALESCE to handle NULL values
        e.*  -- Include other columns from the emoji table if needed
    FROM 
        emoji e
        LEFT JOIN EmojiFeedback ef ON e.emoji_id = ef.emoji_id
    WHERE 
        e.in_choices != 0
    ORDER BY 
        e.emoji_id DESC
    LIMIT 5;
    ";
    $result_ef = mysqli_query($conn, $sql_ef);

    $output_lines_ef = array(); // Array to store concatenated values
    // Mapping of emoji_id to labels
    $emoji_labels_ef = array(
        110 => 'Very Satisfied',
        109 => 'Satisfied',
        108 => 'Neutral',
        107 => 'Disappointed',
        106 => 'Very Disappointed'
    );

    if(mysqli_num_rows($result_ef) > 0){
        while($row_ef = mysqli_fetch_assoc($result_ef)){
            $emoji_id = $row_ef['emoji_id'];
            $image_path = $row_ef['image_path'];
            $percentage = $row_ef['percentage'];
            $formatted_percentage = number_format($percentage, 1);

            // Get label based on emoji_id
            $label = isset($emoji_labels_ef[$emoji_id]) ? $emoji_labels_ef[$emoji_id] : 'Unknown';

            // Concatenate and store in array
            $output_lines_ef[] = "$label: $formatted_percentage";
        }
    }
    // end of query for emoji facility
// end of emoji query



// start of text query
    

    // start of query for text service
    $sql_ts = "SELECT
        question_id,
        question_type.question_type,
        question_category.question_category,
        COUNT(*) AS total_feedback,
        (SUM(CASE WHEN text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS negative,
        (SUM(CASE WHEN text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS neutral,
        (SUM(CASE WHEN text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS positive
        FROM
        feedback INNER JOIN questions USING (question_id) INNER JOIN question_category USING (qc_id) INNER JOIN question_type USING (qt_id)
        WHERE question_type = 'Text-based' AND question_category = 'Service'
        GROUP BY
        question_id;";
        $result_ts = mysqli_query($conn, $sql_ts);
        $output_lines_ts = array(); // Array to store concatenated values
    
    if(mysqli_num_rows($result_ts) > 0){
        while($row_ts = mysqli_fetch_assoc($result_ts)){
            $total_feedbac_ts = $row_ts['total_feedback'];
            $negative_ts = $row_ts['negative'];
            $neutral_ts = $row_ts['neutral'];
            $positive_ts = $row_ts['positive'];
        }
    }
    // end of query for text service
// end of text query



    $searchkeyWord = "I have a 3 category on my system and i conduct a survey

    The results are:
    
    Staff
    Emoji-based ratings:";

    // Assume $output_lines is the array containing your concatenated values
    foreach ($output_lines_est as $output_line_est) {
        $searchkeyWord .= "\n" . $output_line_est;
    }

    $searchkeyWord .= "\n
    Service
    Emoji-based ratings:";

    foreach ($output_lines_es as $output_line_es) {
        $searchkeyWord .= "\n" . $output_line_es;
    }

    $searchkeyWord .= "\n
    Text-based ratings:
    Negative: $negative_ts
    Neutral: $neutral_ts
    Positive: $positive_ts";

    $searchkeyWord .= "\n
    Facility
    Emoji-based ratings:";

    foreach ($output_lines_ef as $output_line_ef) {
        $searchkeyWord .= "\n" . $output_line_ef;
    }

    $searchkeyWord .= "\n\nBased on the conducted survey, give me the best recommendation to improve each category on emoji-based and text-based. Separate the recommendation for emoji-based and text-based. Only show the result for highest percentage on each category and only show the percentage not the emotion. And every end of each recommendation, wrap it to html <p> tag and <br> tag so I can output it on my web app in a more presentable way.";

    // Echo the final string
    // echo nl2br($searchkeyWord); // Use nl2br to preserve line breaks in HTML output

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
            
        } else {
            echo 'No valid content found in the response.';
        }
    }
    
    curl_close($ch);