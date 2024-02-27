<?php
require_once('../core/init.php');
ob_start();
if ($user_role_id_session !== 1) {
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
            left: 43em;
            bottom: 121em;
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
            left: 43em;
            bottom: 150em !important;
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

    

        main {
            overflow: scroll;
            height: 100vh;
        }

        main::-webkit-scrollbar {
            display: none;
        }

        .card-analysis {
            display: flex;
        }

        .card-main-contetn-analysis {
            display: block;
            gap: 1em;

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
                bottom: 244em !important;
                width: 25em;
                min-height: 50em !important;
                display: grid;
            }

            .card-2 p {
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
                bottom: 123em;
                width: 25em;
                height: auto;
                display: grid;

            }

            .card-title-analysis {
                font-size: 1.5em;
            }
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        /* start design for filter by year */

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1;
        }

        .row {
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            padding: 4px;
        }

        .dropdown-content a {
            color: black;
            padding: 8px 7px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    

    <!-- filter by today -->
    <button type="button" class="btn btn-success mb-3 mt-3 me-2 ms-5" data-bs-toggle="" data-bs-target=""><a href="others_logs.php?filter=today" class="text-decoration-none text-light">Today</a></button>

    <!-- filter by 7 days -->
    <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="others_logs.php?filter=7days" class="text-decoration-none text-light">Past 7 Days</a></button>

    <!-- filter by month -->
    <div class="dropdown">
        <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Month</button>
        <div class="dropdown-content">
            <?php
            for ($month = 1; $month <= 12; $month++) {
                $month_name = date("F", mktime(0, 0, 0, $month, 1));
                echo '<a href="others-logs.php?filter=' . $month . '">' . $month_name . '</a>';
            }
            ?>
        </div>
    </div>

    <!-- filter by year -->
    <div class="dropdown">
        <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Year</button>
        <div class="dropdown-content">
            <?php
            $sql_year = "SELECT DISTINCT YEAR(`created_at`) AS year FROM `client` ORDER BY year ASC";
            $result_year = mysqli_query($conn, $sql_year);

            while ($row_year = mysqli_fetch_assoc($result_year)) {
                $year = $row_year['year'];
                echo '<a href="others_logs.php?filter=' . $year . '" class="text-decoration-none text-dark">' . $year . '</a>';
            }
            ?>
        </div>
    </div>

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
                            if (mysqli_num_rows($result_overall) > 0) {
                                while ($row_overall = mysqli_fetch_assoc($result_overall)) {
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
                    if (mysqli_num_rows($result_category) > 0) {
                        while ($row_category = mysqli_fetch_assoc($result_category)) {
                            $qc_id = $row_category['qc_id'];
                            $question_category = $row_category['question_category'];

                            $sql_count = "SELECT COUNT(feedback_id) AS count, feedback.question_id, questions.qt_id, questions.qc_id, question_type.question_type, question_category.question_category FROM feedback INNER JOIN questions USING (question_id) INNER JOIN question_type USING (qt_id) INNER JOIN question_category USING (qc_id) WHERE question_type = 'Emoji-based' AND question_category = '$question_category';";
                            $result_count = mysqli_query($conn, $sql_count);
                            if (mysqli_num_rows($result_count) > 0) {
                                $row_count = mysqli_fetch_assoc($result_count);
                                $count = $row_count['count'];
                            }
                    ?>
                            <div class="card-content">
                                <div class="card-title">
                                    <p><?= $question_category . '<span class=""> Experience</span> <span class="fs-6">(' . $count . ')</span>' ?></p>
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
        <style>
            .container {
                display: flex;
                flex-direction: column;
                position: relative;
                left: 5em !important;

            }
        </style>
        <!-- text-based ratings for staff -->

        <?php
        $sql_text_staff = "SELECT
        question_id,
        question_type.question_type,
        question_category.question_category,
        COUNT(*) AS total_feedback,
        (SUM(CASE WHEN text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS negative,
        (SUM(CASE WHEN text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS neutral,
        (SUM(CASE WHEN text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS positive
        FROM
        feedback INNER JOIN questions USING (question_id) INNER JOIN question_category USING (qc_id) INNER JOIN question_type USING (qt_id)
        WHERE question_type = 'Text-based' AND question_category = 'Staff'
        GROUP BY
        question_id;";
        $result_text_staff = mysqli_query($conn, $sql_text_staff);
        foreach ($result_text_staff as $data1) {
            $staff_question_id[] = $data1['question_id'];
            $staff_question_category[] = $data1['question_category'];
            $staff_total_feedback[] = $data1['total_feedback'];
            $staff_negative[] = $data1['negative'];
            $staff_neutral[] = $data1['neutral'];
            $staff_positive[] = $data1['positive'];
        }
        ?>
        <div class="container ms-5 mt-5 mb-5" style="height: 300px; width: 400px;">
            <h4 class="ms-5"><?= $staff_question_category[0] ?> Text-based Ratings</h4>
            <canvas id="myChart1"></canvas>
        </div>
        <br>

        <!-- text-based ratings for service -->
        <?php
        $sql_text_service = "SELECT
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
        $result_text_service = mysqli_query($conn, $sql_text_service);
        foreach ($result_text_service as $data1) {
            $service_question_id[] = $data1['question_id'];
            $service_question_category[] = $data1['question_category'];
            $service_total_feedback[] = $data1['total_feedback'];
            $service_negative[] = $data1['negative'];
            $service_neutral[] = $data1['neutral'];
            $service_positive[] = $data1['positive'];
        }
        ?>
        <div class="container ms-5 mt-5 mb-5" style="height: 300px; width: 400px;">
            <h4 class="ms-5"><?= $service_question_category[0] ?> Text-based Ratings</h4>
            <canvas id="myChart2"></canvas>
        </div>
        <br>

        <!-- text-based ratings for facility -->
        <?php
        $sql_text_facility = "SELECT
        question_id,
        question_type.question_type,
        question_category.question_category,
        COUNT(*) AS total_feedback,
        (SUM(CASE WHEN text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS negative,
        (SUM(CASE WHEN text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS neutral,
        (SUM(CASE WHEN text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS positive
        FROM
        feedback INNER JOIN questions USING (question_id) INNER JOIN question_category USING (qc_id) INNER JOIN question_type USING (qt_id)
        WHERE question_type = 'Text-based' AND question_category = 'Facility'
        GROUP BY
        question_id;";
        $result_text_facility = mysqli_query($conn, $sql_text_facility);
        foreach ($result_text_facility as $data1) {
            $facility_question_id[] = $data1['question_id'];
            $facility_question_category[] = $data1['question_category'];
            $facility_total_feedback[] = $data1['total_feedback'];
            $facility_negative[] = $data1['negative'];
            $facility_neutral[] = $data1['neutral'];
            $facility_positive[] = $data1['positive'];
        }
        ?>
        <div class="container ms-5 mt-5 mb-5" style="height: 300px; width: 400px;">
            <h4 class="ms-5"><?= $facility_question_category[0] ?> Text-based Ratings</h4>
            <canvas id="myChart3"></canvas>
        </div>
        <br>

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
                        if (mysqli_num_rows($result_a_overall) > 0) {
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
                            if ($percentage == 0) {
                                echo '<img src="../../public/assets/images/question-mark.png" alt="" class="emoji-img-analysis">';
                                echo '<div class="card-body-analysis">';
                                echo '<p><b>Remarks:</b> No data found.</p>';
                                echo '<p><b>Sentiment Score:</b> No data found.</p>';
                                echo '</div>';
                            } else {
                                echo '<img src="../../' . $image_path . '" alt="" class="emoji-img-analysis">';
                                echo '<div class="card-body-analysis">';
                                echo '<p><b>Remarks:</b>' . $final_remarks . '</p>';
                                echo '<p><b>Sentiment Score:</b>' . $sentiment_score . '</p>';
                                echo '</div>';
                            }
                            ?>
                            <hr class="border border-dark">
                        </div>
                    </div>

                    <?php
                    $sql_a_category = "SELECT * FROM question_category;";
                    $result_a_category = mysqli_query($conn, $sql_a_category);
                    if (mysqli_num_rows($result_a_category) > 0) {
                        while ($row_a_category = mysqli_fetch_assoc($result_a_category)) {
                            $qc_id = $row_a_category['qc_id'];
                            $question_category = $row_a_category['question_category'];
                    ?>
                            <!-- for staff assistance -->
                            <div class="card-title-analysis">
                                <p><?= $question_category ?> Experience</p>
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
                                if (mysqli_num_rows($result_analysis) > 0) {
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
                                    if ($percentage == 0) {
                                        echo '<img src="../../public/assets/images/question-mark.png" alt="" class="emoji-img-analysis">';
                                        echo '<div class="card-body-analysis">';
                                        echo '<p><b>Remarks:</b> No data found.</p>';
                                        echo '<p><b>Sentiment Score:</b> No data found.</p>';
                                        echo '</div>';
                                    } else {
                                        echo '<img src="../../' . $image_path . '" alt="" class="emoji-img-analysis">';
                                        echo '<div class="card-body-analysis">';
                                        echo '<p><b>Remarks:</b>' . $final_remarks . '</p>';
                                        echo '<p><b>Sentiment Score:</b>' . $sentiment_score . '</p>';
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
                <p>Recommendations:</p>
               <?php
                    include 'includes/openai-prompt.php';
                    ?>
                    <p><?= $generatedContent; ?></p>
                </div>
            </div>
        </section>
    </main>
    <script>
        const ctx1 = document.getElementById('myChart1');
        const data1 = {
            labels: ['Negative', 'Neutral', 'Positive'],
            datasets: [{
                label: 'Sentiment Score',
                data: <?php echo json_encode([$staff_negative[0], $staff_neutral[0], $staff_positive[0]]); ?>,
                backgroundColor: [
                    'rgb(255, 99, 132)', // Negative
                    'rgb(54, 162, 235)', // Neutral
                    'rgb(255, 205, 86)', // Positive
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                ],
                borderWidth: 1
            }]
        };

        new Chart(ctx1, {
            type: 'pie', // Change the chart type to 'pie'
            data: data1,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('myChart2');
        const data2 = {
            labels: ['Negative', 'Neutral', 'Positive'],
            datasets: [{
                label: 'Sentiment Score',
                data: <?php echo json_encode([$service_negative[0], $service_neutral[0], $service_positive[0]]); ?>,
                backgroundColor: [
                    'rgb(255, 99, 132)', // Negative
                    'rgb(54, 162, 235)', // Neutral
                    'rgb(255, 205, 86)', // Positive
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                ],
                borderWidth: 1
            }]
        };

        new Chart(ctx2, {
            type: 'pie', // Change the chart type to 'pie'
            data: data2,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx3 = document.getElementById('myChart3');
        const data3 = {
            labels: ['Negative', 'Neutral', 'Positive'],
            datasets: [{
                label: 'Sentiment Score',
                data: <?php echo json_encode([$facility_negative[0], $facility_neutral[0], $facility_positive[0]]); ?>,
                backgroundColor: [
                    'rgb(255, 99, 132)', // Negative
                    'rgb(54, 162, 235)', // Neutral
                    'rgb(255, 205, 86)', // Positive
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                ],
                borderWidth: 1
            }]
        };

        new Chart(ctx3, {
            type: 'pie', // Change the chart type to 'pie'
            data: data3,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>