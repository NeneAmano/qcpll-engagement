<?php
    require_once('../core/init.php');
    ob_start();
    if($user_role_id_session !== 1){
        session_unset();
        session_destroy();
        header("Location: login.php?error=accessdenied");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../public/assets/images/qcplLogo.png" type="image/x-icon">
    <title>Reports</title>
    <?php
        require_once 'includes/sidebar.php';
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');

        :root {
            --color-primary: #6C9BCF;
            --color-danger: #FF0060;
            --color-success: #1B9C85;
            --color-warning: #F7D060;
            --color-white: #fff;
            --color-info-dark: #7d8da1;
            --color-dark: #363949;
            --color-light: rgba(132, 139, 234, 0.18);
            --color-dark-variant: #677483;
            --color-background: #f6f6f9;
            --card-border-radius: 2rem;
            --border-radius-1: 0.4rem;
            --border-radius-2: 1.2rem;
            --card-padding: 1.8rem;
            --padding-1: 1.2rem;
            --box-shadow: 0 .4rem .6rem #28a745;
        }

        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            padding: 0%;
            margin: 0%;
        }

        .main-card {
            margin-top: 2em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: var(--card-padding) !important;
            border-radius: var(--card-border-radius);
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            transform: scale(1.1);
            margin-left: 5em;
            margin-top: 5em;
            min-width: 34em;
            height: auto;
            display: grid;
        }

        .bar-graph {
            margin-top: 7em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: var(--card-padding) !important;
            border-radius: var(--card-border-radius);
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            margin-left: 3em;
            margin-top: 5em;
            height: 20em;
            min-width: 38em;
        }

        .main-card h3 {
            margin-bottom: 70px;
        }

        .card-1 {
            margin-top: 6em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: 20px !important;
            border-radius: var(--card-border-radius);
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            position: relative;
            left: 45em;
            bottom: 70em;
            width: 25em;
            height: auto;
            display: grid;

        }

        .card-2 {
            margin-top: 25em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: 20px !important;
            border-radius: var(--card-border-radius);
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            position: relative;
            left: 45em;
            bottom: 98em;
            width: 38em;
            min-height: 50em !important;
            display: grid;
        }

        .card-body {
            display: flex;
            flex-direction: row;
            gap: 3em;
        }

        .card-body span {
            text-align: center;
        }

        .emoji-img {
            width: 35px;
        }

        span p {
            font-size: 0.8em;
            color: #212121;
        }

        .card-title p {
            font-size: 1em;
            font-weight: 500;
        }

        /* Bar Graph Horizontal */
        .bar-graph .feelings {
            -webkit-animation: fade-in-text 2.2s 0.1s forwards;
            -moz-animation: fade-in-text 2.2s 0.1s forwards;
            animation: fade-in-text 2.2s 0.1s forwards;
            opacity: 0;
        }

        .bar-graph-horizontal {
            max-width: 380px;
        }

        .bar-graph-horizontal>div {
            float: left;
            margin-bottom: 8px;
            width: 100%;
        }

        .bar-graph-horizontal .feelings {
            float: left;
            margin-top: 18px;
            width: 50px;
        }

        .bar-graph-horizontal .bar {
            border-radius: 3px;
            height: 55px;
            float: left;
            overflow: hidden;
            position: relative;
            width: 0;
            margin-left: 1.6em;
        }

        .bar-graph-one .bar::after {
            -webkit-animation: fade-in-text 2.2s 0.1s forwards;
            -moz-animation: fade-in-text 2.2s 0.1s forwards;
            animation: fade-in-text 2.2s 0.1s forwards;
            color: #fff;
            content: attr(data-percentage);
            font-weight: 700;
            position: absolute;
            right: 16px;
            top: 17px;
        }

        .bar-graph-one .bar-one .bar {
            background-color: #64b2d1;
            -webkit-animation: show-bar-one 1.2s 0.1s forwards;
            -moz-animation: show-bar-one 1.2s 0.1s forwards;
            animation: show-bar-one 1.2s 0.1s forwards;
        }

        .bar-graph-one .bar-two .bar {
            background-color: #5292ac;
            -webkit-animation: show-bar-two 1.2s 0.2s forwards;
            -moz-animation: show-bar-two 1.2s 0.2s forwards;
            animation: show-bar-two 1.2s 0.2s forwards;
        }

        .bar-graph-one .bar-three .bar {
            background-color: #407286;
            -webkit-animation: show-bar-three 1.2s 0.3s forwards;
            -moz-animation: show-bar-three 1.2s 0.3s forwards;
            animation: show-bar-three 1.2s 0.3s forwards;
        }

        .bar-graph-one .bar-four .bar {
            background-color: #2e515f;
            -webkit-animation: show-bar-four 1.2s 0.4s forwards;
            -moz-animation: show-bar-four 1.2s 0.4s forwards;
            animation: show-bar-four 1.2s 0.4s forwards;
        }

        /* Bar Graph Horizontal Animations */
        @-webkit-keyframes show-bar-one {
            0% {
                width: 0;
            }

            100% {
                width: 69.6%;
            }
        }

        @-webkit-keyframes show-bar-two {
            0% {
                width: 0;
            }

            100% {
                width: 71%;
            }
        }

        @-webkit-keyframes show-bar-three {
            0% {
                width: 0;
            }

            100% {
                width: 74.7%;
            }
        }

        @-webkit-keyframes show-bar-four {
            0% {
                width: 0;
            }

            100% {
                width: 76.8%;
            }
        }

        @-webkit-keyframes fade-in-text {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
        main{
            overflow: scroll;
            height:100vh;
        }
        main::-webkit-scrollbar {
            display: none;
        }
        .card-analysis {
            display: flex;
        }

        .card-main-contetn-analysis {
            display: block;
            gap:1em;
            
        }

        .emoji-img-analysis {
            width: 4em !important;
            height: 3em;
            margin-top: 0.8em;
        }

        .card-main-contetn-analysis p {
            font-size: 0.8em;
            color: #212121;
        }

        .card-body-analysis-text p {
            font-size: 1em;
            color: #212121;
        }

        @media only screen and (min-width: 1900px) {
            .card-2 {

                cursor: pointer;
                background-color: #fff;
                padding: 20px !important;
                border-radius: var(--card-border-radius);
                box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
                position: relative;
                left: 75em;
                bottom: 175em;
                width: 25em;
                min-height: 50em !important;
                display: grid;
            }   
            .card-2 p{
                font-size: 0.8em;
            }

            .bar-graph {
                position: relative;
                cursor: pointer;
                background-color: var(--color-white);
                padding: var(--card-padding) !important;
                border-radius: var(--card-border-radius);
                box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
                margin-left: 3em;
                height: 20em;
                min-width: 38em;
            }

            .card-1 {
                margin-top: 8em;
                cursor: pointer;
                background-color: var(--color-white);
                padding: 20px !important;
                border-radius: var(--card-border-radius);
                box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
                position: relative;
                left: 45em;
                bottom: 70em;
                width: 25em;
                height: auto;
                display: grid;

            }
            .card-title-analysis{
                font-size: 1.5em;
            }
        }
    </style>
</head>
<main>
    <section>
        <div class="try col-md-2">
            <div class="main-card">
                <h3>Emoji-based Feedback Ratings</h3>

                <div class="card-content">
                    <div class="card-title">
                        <p>
                            Overall Experience
                        </p>
                    </div>
                    <div class="card-body">
                    <?php
                        $sql_overall = "WITH EmojiFeedback AS (
                            SELECT 
                                e.emoji_id,
                                f.answer_id,
                                COUNT(*) AS count_per_answer,
                                COUNT(*) * 100.0 / SUM(COUNT(*)) OVER () AS percentage -- Calculate percentage across all rows
                            FROM 
                                feedback f
                                INNER JOIN questions q USING (question_id) 
                                INNER JOIN question_type qt USING (qt_id)
                                INNER JOIN question_category qc USING (qc_id) 
                                INNER JOIN emoji e ON f.answer_id = e.emoji_id
                            WHERE 
                                qt.question_type = 'Emoji-based' AND e.in_choices != 0
                            GROUP BY 
                                e.emoji_id, f.answer_id
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
                            e.emoji_id DESC LIMIT 5;
                        ";
                        $result_overall = mysqli_query($conn, $sql_overall);
                        if(mysqli_num_rows($result_overall) > 0){
                            while($row_overall = mysqli_fetch_assoc($result_overall)){
                                $emoji_id = $row_overall['emoji_id'];
                                $image_path = $row_overall['image_path'];
                                $percentage = $row_overall['percentage'];
                                $formatted_percentage = number_format($percentage, 1);
                    ?>
                                <span>
                                    <img src="../../<?= $image_path ?>" alt="" class="emoji-img">
                                    <p><?= $formatted_percentage ?>%</p>
                                </span>
                    <?php
                            }
                        }
                        
                    ?>
                    </div>
                </div>

                <?php
                    $sql_category = "SELECT * FROM question_category;";
                    $result_category = mysqli_query($conn, $sql_category);
                    if(mysqli_num_rows($result_category) > 0){
                        while($row_category = mysqli_fetch_assoc($result_category)){
                            $qc_id = $row_category['qc_id'];
                            $question_category = $row_category['question_category'];

                            $sql_count = "SELECT COUNT(feedback_id) AS count, feedback.question_id, questions.qt_id, questions.qc_id, question_type.question_type, question_category.question_category FROM feedback INNER JOIN questions USING (question_id) INNER JOIN question_type USING (qt_id) INNER JOIN question_category USING (qc_id) WHERE question_type = 'Emoji-based' AND question_category = '$question_category';";
                            $result_count = mysqli_query($conn, $sql_count);
                            if(mysqli_num_rows($result_count) > 0){
                                $row_count = mysqli_fetch_assoc($result_count);
                                $count = $row_count['count'];
                            }
                ?>
                            <div class="card-content">
                                <div class="card-title">
                                    <p><?= $question_category . '<span class=""> Experience</span> <span class="fs-6">(' .$count. ')</span>' ?></p>
                                </div>
                                <div class="card-body">
                                <?php
                                
                                    $sql_emoji = "WITH EmojiFeedback AS (
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
                                            qc.question_category = '$question_category' AND qt.question_type = 'Emoji-based' AND e.in_choices != 0
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
                                    LIMIT 5;";
                                    $result_emoji = mysqli_query($conn, $sql_emoji);
                                    if (mysqli_num_rows($result_emoji) > 0) {
                                        while ($row_emoji = mysqli_fetch_assoc($result_emoji)) {
                                            $emoji_id = $row_emoji['emoji_id'];
                                            $image_path = $row_emoji['image_path'];
                                            $percentage = $row_emoji['percentage'];
                                            $formatted_percentage = number_format($percentage, 1);
                                ?>
                                            <span>
                                                <img src="../../<?= $image_path ?>" alt="" class="emoji-img">
                                                <p><?= $formatted_percentage ?>%</p>
                                            </span>
                                <?php
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </section>
    
    <section class="bar-graph bar-graph-horizontal bar-graph-one">
        <div class="text-based-title">
            <h3>Text-Based Ratings</h3>
        </div>
        <div class="bar-one">
            <span class="feelings">Positive</span>
            <div class="bar" data-percentage="69.6%" style="background-color: #EEF296;"></div>
        </div>
        <div class="bar-two">
            <span class="feelings">Neutral</span>
            <div class="bar" data-percentage="71%" style="background-color: #9ADE7B;"></div>
        </div>
        <div class="bar-three">
            <span class="feelings">Negative</span>
            <div class="bar" data-percentage="74.7%" style="background-color: #508D69;"></div>
        </div>
        
    </section>
    
    <section>
        <div class="card-1">
            <div class="card-title">
                <p style="font-size: 1.5em;text-transform:capitalize;">Analysis</p>

                <!-- for overall Experience -->
                <div class="card-title-analysis">
                    <p>Overall Experience</p>
                </div>
                <div class="card-analysis">
                    <?php
                        $sql_a_overall = "WITH EmojiFeedback AS (
                            SELECT 
                                e.emoji_id,
                                f.answer_id,
                                COUNT(*) AS count_per_answer,
                                COUNT(*) * 100.0 / SUM(COUNT(*)) OVER () AS percentage
                            FROM 
                                feedback f
                                INNER JOIN questions q USING (question_id) 
                                INNER JOIN question_type qt USING (qt_id)
                                INNER JOIN question_category qc USING (qc_id) 
                                INNER JOIN emoji e ON f.answer_id = e.emoji_id
                            WHERE 
                                qt.question_type = 'Emoji-based'
                            GROUP BY 
                                e.emoji_id, f.answer_id
                        )
                        
                        SELECT 
                            e.emoji_id,
                            ef.answer_id,
                            COALESCE(ef.count_per_answer, 0) AS count_per_answer,
                            COALESCE(ef.percentage, 0) AS percentage,
                            e.*
                        FROM 
                            emoji e
                            LEFT JOIN EmojiFeedback ef ON e.emoji_id = ef.emoji_id
                        WHERE 
                            e.in_choices != 0
                        ORDER BY 
                            COALESCE(ef.count_per_answer, 0) DESC,
                            COALESCE(ef.percentage, 0) DESC,
                            e.emoji_id DESC
                        LIMIT 1;";
                        $result_a_overall = mysqli_query($conn, $sql_a_overall);
                        if(mysqli_num_rows($result_a_overall) > 0){
                            $row_a_overall = mysqli_fetch_assoc($result_a_overall);
                            $percentage = $row_a_overall['percentage'];
                            $image_path = $row_a_overall['image_path'];
                            $sentiment_score = $row_a_overall['sentiment_score'];
                            $unicode_name = $row_a_overall['unicode_name'];
                            $remarks = $row_a_overall['remarks'];

                            // Find the position of the first dot (.)
                            $dot_position = strpos($remarks, '.');

                            // Extract the substring after the first dot (.)
                            $final_remarks = substr($remarks, $dot_position + 1);
                        }
                    ?>
                    <div class="card-main-contetn-analysis">
                        <?php
                            if($percentage == 0){
                                echo '<img src="../../public/assets/images/question-mark.png" alt="" class="emoji-img-analysis">';
                                echo '<div class="card-body-analysis">';
                                echo '<p><b>Remarks:</b> No data found.</p>';
                                echo '<p><b>Sentiment Score:</b> No data found.</p>';
                                echo '</div>';
                            }else{
                                echo '<img src="../../' .$image_path. '" alt="" class="emoji-img-analysis">';
                                echo '<div class="card-body-analysis">';
                                echo '<p><b>Remarks:</b>' .$final_remarks. '</p>';
                                echo '<p><b>Sentiment Score:</b>' .$sentiment_score. '</p>';
                                echo '</div>';
                            }
                        ?>
                        <hr class="border border-dark">
                    </div>
                </div>

                <?php
                    $sql_a_category = "SELECT * FROM question_category;";
                    $result_a_category = mysqli_query($conn, $sql_a_category);
                    if(mysqli_num_rows($result_a_category) > 0){
                        while($row_a_category = mysqli_fetch_assoc($result_a_category)){
                            $qc_id = $row_a_category['qc_id'];
                            $question_category = $row_a_category['question_category'];
                ?>
                            <!-- for staff assistance -->
                            <div class="card-title-analysis">
                                <p><?= $question_category ?></p>
                            </div>
                            <div class="card-analysis">
                                <?php
                                    $sql_analysis = "WITH EmojiFeedback AS (
                                        SELECT 
                                            e.emoji_id,
                                            f.answer_id,
                                            COUNT(*) AS count_per_answer,
                                            COUNT(*) * 100.0 / SUM(COUNT(*)) OVER () AS percentage
                                        FROM 
                                            feedback f
                                            INNER JOIN questions q USING (question_id) 
                                            INNER JOIN question_type qt USING (qt_id)
                                            INNER JOIN question_category qc USING (qc_id) 
                                            INNER JOIN emoji e ON f.answer_id = e.emoji_id
                                        WHERE 
                                            qc.question_category = '$question_category' AND qt.question_type = 'Emoji-based'
                                        GROUP BY 
                                            e.emoji_id, f.answer_id
                                    )
                                    
                                    SELECT 
                                        e.emoji_id,
                                        ef.answer_id,
                                        COALESCE(ef.count_per_answer, 0) AS count_per_answer,
                                        COALESCE(ef.percentage, 0) AS percentage,
                                        e.*
                                    FROM 
                                        emoji e
                                        LEFT JOIN EmojiFeedback ef ON e.emoji_id = ef.emoji_id
                                    WHERE 
                                        e.in_choices != 0
                                    ORDER BY 
                                        COALESCE(ef.count_per_answer, 0) DESC,
                                        COALESCE(ef.percentage, 0) DESC,
                                        e.emoji_id DESC
                                    LIMIT 1;";
                                    $result_analysis = mysqli_query($conn, $sql_analysis);
                                    if(mysqli_num_rows($result_analysis) > 0){
                                        $row_analysis = mysqli_fetch_assoc($result_analysis);

                                        $percentage = $row_analysis['percentage'];
                                        $image_path = $row_analysis['image_path'];
                                        $sentiment_score = $row_analysis['sentiment_score'];
                                        $unicode_name = $row_analysis['unicode_name'];
                                        $remarks = $row_analysis['remarks'];

                                        // Find the position of the first dot (.)
                                        $dot_position = strpos($remarks, '.');

                                        // Extract the substring after the first dot (.)
                                        $final_remarks = substr($remarks, $dot_position + 1);
                                    }
                                ?>
                                <div class="card-main-contetn-analysis">
                                    <?php
                                        if($percentage == 0){
                                            echo '<img src="../../public/assets/images/question-mark.png" alt="" class="emoji-img-analysis">';
                                            echo '<div class="card-body-analysis">';
                                            echo '<p><b>Remarks:</b> No data found.</p>';
                                            echo '<p><b>Sentiment Score:</b> No data found.</p>';
                                            echo '</div>';
                                        }else{
                                            echo '<img src="../../' .$image_path. '" alt="" class="emoji-img-analysis">';
                                            echo '<div class="card-body-analysis">';
                                            echo '<p><b>Remarks:</b>' .$final_remarks. '</p>';
                                            echo '<p><b>Sentiment Score:</b>' .$sentiment_score. '</p>';
                                            echo '</div>';
                                        }
                                    ?>
                                <hr class="border border-dark">
                                </div>
                            </div>
                <?php
                        }
                    }
                ?>
                <!-- for text-based ratings -->
                <div class="card-title-analysis mb-5">
                    <p>Overall Text-Based Ratings</p>
                </div>
                <div class="card-analysis">
                    <div class="card-body-analysis-text">
                        <p>Remarks:Positive</p>
                        <p>Score: 69.1%</p>
                    </div>
                </div>
                <!-- reference website -->
                <div class="card-analysis">
                    <div class="card-body-analysis-text">
                        <p style="font-size: small; "><span><i class="fa-solid fa-circle-info"></i></span> Sentiment scoring was based on <a href="https://kt.ijs.si/data/Emoji_sentiment_ranking/?emoji">Emoji Sentiment Ranking v1.0</a></p>
                        <p style="font-size: small;"><span><i class="fa-solid fa-circle-info"></i></span> Remarks was based on <a href="https://emojipedia.org/">Emojipedia.org</a></p>
                    </div>
                </div>
            </div>
            <p></p>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="card-2">
            <div class="card-title">
                <p>Recommendations</p>
                <p>Staff:
                    <br>
                    Emoji-based recommendation: Improving staff satisfaction through regular training and team-building activities can significantly boost morale and create a positive work environment.
                    <br>
                    <br>
                    Text-based recommendation: Recognizing and rewarding staff members for their hard work and dedication can help improve overall satisfaction and motivation, leading to better service for customers.
                    <br>
                    <br>
                    Facility:
                    <br>
                    Emoji-based recommendation: Ensuring that facilities are regularly maintained and kept clean can help improve overall satisfaction and create a positive impression for visitors.
                    <br>
                    <br>
                    Text-based recommendation: Addressing any issues or concerns raised by customers regarding the facilities, such as temperature control, can help improve satisfaction and prevent negative experiences.
                    <br>
                    <br>
                    Service:
                    <br>
                    Emoji-based recommendation: Implementing training programs for service staff to improve customer interaction and problem-solving skills can greatly enhance overall satisfaction.
                    <br>
                    <br>
                    Text-based recommendation: Improving service quality and response time can help address any negative feedback and enhance overall customer satisfaction levels.</p>
            </div>

        </div>
    </section>
    </main>
</body>

</html>