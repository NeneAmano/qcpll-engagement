<?php
    require_once('../../core/init.php');
    $sql_overall = "WITH EmojiFeedback AS (
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
    $result_overall = mysqli_query($conn, $sql_overall);

    $emoji_ids = array(); // Array to store emoji_id values
    $formatted_percentages = array();

    if(mysqli_num_rows($result_overall) > 0){
        while($row_overall = mysqli_fetch_assoc($result_overall)){
            $emoji_id = $row_overall['emoji_id'];
            $emoji_ids[] = $emoji_id; // Store emoji_id in the array
            $image_path = $row_overall['image_path'];
            $percentage = $row_overall['percentage'];
            $formatted_percentage = number_format($percentage, 1);
            $formatted_percentages[] = $formatted_percentage;
            echo $emoji_id;
            echo '<br>';
            echo $formatted_percentage;
            echo '<br>';
        }
    }

    // Access emoji_id values outside of the while loop
    foreach ($emoji_ids as $emoji_id) {
        echo "Outside Loop: " . $emoji_id . '<br>';
    }
    foreach ($formatted_percentages as $formatted_percentage) {
        echo "Outside Loop: " . $formatted_percentage . '<br>';
    }
