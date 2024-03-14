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
            margin-top: 60.5rem;
            cursor: pointer;
            background-color: var(--color-white);
            padding: 20px !important;
            border-radius: var(--card-border-radius);
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            position: relative;
            left: 45em;
            bottom: 123em !important;
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
            left: 38em;
            bottom: 152em !important;
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
                bottom: 187em !important;
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
                bottom: 67em !important;
                width: 25em;
                height: auto;
                display: grid;

            }

            .card-title-analysis {
                font-size: 1.5em;
            }
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
    <?php
    require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- filter by today -->
        <button type="button" class="btn btn-success mb-3 mt-3 me-2">
            <a href="reports.php?filter=today" class="text-decoration-none text-light">Today</a>
        </button>

        <!-- filter by 7 days -->
        <button type="button" class="btn btn-success mb-3 mt-3 me-2">
            <a href="reports.php?filter=7days" class="text-decoration-none text-light">Past 7 Days</a>
        </button>

        <!-- filter by month -->
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Month</button>
            <div class="dropdown-content">
                <?php
                for ($month = 1; $month <= 12; $month++) {
                    $month_name = date("F", mktime(0, 0, 0, $month, 1));
                    echo '<a href="reports.php?filter=' . $month . '">' . $month_name . '</a>';
                }
                ?>
            </div>
        </div>

        <!-- filter by year -->
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Year</button>
            <div class="dropdown-content">
                <?php
                $sql_year = "SELECT DISTINCT YEAR(created_at) AS year FROM client ORDER BY year ASC";
                $result_year = mysqli_query($conn, $sql_year);

                while ($row_year = mysqli_fetch_assoc($result_year)) {
                    $year = $row_year['year'];
                    echo '<a href="reports.php?filter=' . $year . '" class="text-decoration-none text-dark">' . $year . '</a>';
                }
                ?>
            </div>
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
    // Initialize $sql_overall with a default query
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
                        e.emoji_id DESC LIMIT 5;";

    // Check if filter is set
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];

        switch ($filter) {
            case 'today':
                // Modify $sql_overall according to 'today' filter
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
                                        AND DATE(f.created_at) = CURDATE() -- Filter for today's feedback
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
                                    e.emoji_id DESC LIMIT 5;";
                break;
            case '7days':
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
                                        AND f.created_at >= CURRENT_DATE - INTERVAL 7 DAY -- Filter for feedback in the last 7 days
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
                                    e.emoji_id DESC LIMIT 5;";
                break;
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
            case '10':
            case '11':
            case '12':
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
                                        AND MONTH(f.created_at) = $filter -- Filter for feedback in the specified month
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
                                    e.emoji_id DESC LIMIT 5;";
                break;
            default:
                // Default case: no filter or unsupported filter, use a general query
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
                                    e.emoji_id DESC LIMIT 5;";
                break;
        }
    }
    

                            
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
                                        <p>
                                            <?= $formatted_percentage ?>%
                                        </p>
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
                                <div class="card-content">
    <div class="card-title">
        <p>
            <?php
            // Calculate the total count based on the filter
            $sql_count = "SELECT COUNT(*) AS total_count FROM feedback f
                          INNER JOIN questions q USING (question_id) 
                          INNER JOIN question_type qt USING (qt_id)
                          INNER JOIN question_category qc USING (qc_id) 
                          INNER JOIN emoji e ON f.answer_id = e.emoji_id
                          WHERE qc.question_category = '$question_category' 
                          AND qt.question_type = 'Emoji-based' 
                          AND e.in_choices != 0";

            // Check if filter is set
            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];
                switch ($filter) {
                    case 'today':
                        // Filter for today's feedback
                        $sql_count .= " AND DATE(f.created_at) = CURDATE()";
                        break;
                    case '7days':
                        // Filter for feedback in the last 7 days
                        $sql_count .= " AND f.created_at >= CURRENT_DATE - INTERVAL 7 DAY";
                        break;
                    case '1':
                    case '2':
                    case '3':
                    case '4':
                    case '5':
                    case '6':
                    case '7':
                    case '8':
                    case '9':
                    case '10':
                    case '11':
                    case '12':
                        // Filter for feedback in the specified month
                        $sql_count .= " AND MONTH(f.created_at) = $filter";
                        break;
                    default:
                        // No specific filter, use general query
                        break;
                }
            }

            // Execute the count query
            $result_count = mysqli_query($conn, $sql_count);
            $row_count = mysqli_fetch_assoc($result_count);
            $filter_count = $row_count['total_count'];

            // Display question category and count
            echo $question_category . '<span class=""> Experience</span> <span class="fs-6">(' . $filter_count . ')</span>';
            ?>
        </p>
    </div>
    <div class="card-body">
        <?php
        
        // Remaining code for displaying emoji feedback...
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
                qc.question_category = '$question_category' AND qt.question_type = 'Emoji-based' AND e.in_choices != 0";

        // Check if filter is set
        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
            switch ($filter) {
                case 'today':
                    // Filter for today's feedback
                    $sql_emoji .= " AND DATE(f.created_at) = CURDATE()";
                    break;
                case '7days':
                    // Filter for feedback in the last 7 days
                    $sql_emoji .= " AND f.created_at >= CURRENT_DATE - INTERVAL 7 DAY";
                    break;
                case '1':
                case '2':
                case '3':
                case '4':
                case '5':
                case '6':
                case '7':
                case '8':
                case '9':
                case '10':
                case '11':
                case '12':
                    // Filter for feedback in the specified month
                    $sql_emoji .= " AND MONTH(f.created_at) = $filter";
                    break;
                default:
                    // No specific filter, use general query
                    break;
            }
        }

        $sql_emoji .= " GROUP BY e.emoji_id, f.answer_id
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
                    <p>
                        <?= $formatted_percentage ?>%
                    </p>
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
    WHERE question_type = 'Text-based' AND question_category = 'Service'";

// Check if filter is set
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    switch ($filter) {
        case 'today':
            // Filter for today's feedback
            $sql_text_service .= " AND DATE(feedback.created_at) = CURDATE()";
            break;
        case '7days':
            // Filter for feedback in the last 7 days
            $sql_text_service .= " AND feedback.created_at >= CURRENT_DATE - INTERVAL 7 DAY";
            break;
        case '1':
        case '2':
        case '3':
        case '4':
        case '5':
        case '6':
        case '7':
        case '8':
        case '9':
        case '10':
        case '11':
        case '12':
            
            // Filter for feedback in the specified month
            $sql_text_service .= " AND MONTH(feedback.created_at) = $filter";
            break;
        default:
            // No specific filter, use general query
            break;
    }
}

$sql_text_service .= " GROUP BY question_id;";
$result_text_service = mysqli_query($conn, $sql_text_service);

// Initialize variables
$service_question_id = [];
$service_question_category = [];
$service_total_feedback = [];
$service_negative = [];
$service_neutral = [];
$service_positive = [];

// Check if data is available
if (mysqli_num_rows($result_text_service) > 0) {
    foreach ($result_text_service as $data1) {
        $service_question_id[] = $data1['question_id'];
        $service_question_category[] = $data1['question_category'];
        $service_total_feedback[] = $data1['total_feedback'];
        $service_negative[] = $data1['negative'];
        $service_neutral[] = $data1['neutral'];
        $service_positive[] = $data1['positive'];
    }
} else {
    // Set default values when no data available
    $service_question_category[0] = "Service";
    $service_total_feedback[0] = 0;
    $service_negative[0] = 0;
    $service_neutral[0] = 0;
    $service_positive[0] = 0;
}
?>
<div class="container ms-5 mt-5 mb-5" style="height: 300px; width: 400px;">
    <h4 class="ms-5">Service Text-based Ratings</h4>
    <?php if (mysqli_num_rows($result_text_service) > 0): ?>
        <canvas id="myChart2"></canvas>
    <?php else: ?>
        <p>No data available.</p>
    <?php endif; ?>
</div>


        <section>
            <div class="card-1">
                <div class="card-title">
                    <p style="font-size: 1.5em;text-transform:capitalize;">Analysis</p>
                    <hr>

                    <!-- for overall Experience -->
                    <div class="card-title-analysis">
                        <p>Emoji-based</p>
                        <p>Overall Experience</p>
                    </div>
                    <div class="card-analysis">
                    <?php
// Overall emoji-based analysis
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
        qt.question_type = 'Emoji-based'";

// Check if filter is set
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    switch ($filter) {
        case 'today':
            // Filter for today's feedback
            $sql_a_overall .= " AND DATE(f.created_at) = CURDATE()";
            break;
        case '7days':
            // Filter for feedback in the last 7 days
            $sql_a_overall .= " AND f.created_at >= CURRENT_DATE - INTERVAL 7 DAY";
            break;
        case 'year':
            // Filter for feedback in the current year
            $sql_a_overall .= " AND YEAR(f.created_at) = YEAR(CURRENT_DATE)";
            break;
        default:
            // Check if it's a month filter
            if (ctype_digit($filter) && $filter >= 1 && $filter <= 12) {
                // Filter for feedback in the specified month
                $sql_a_overall .= " AND MONTH(f.created_at) = $filter";
            }
            break;
    }
}

$sql_a_overall .= " GROUP BY e.emoji_id, f.answer_id
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
        echo $question_category . '<span class=""> Experience</span>';
        ?>

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
                        qc.question_category = '$question_category' AND qt.question_type = 'Emoji-based'";

            // Check if filter is set
            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];
                switch ($filter) {
                    case 'today':
                        // Filter for today's feedback
                        $sql_analysis .= " AND DATE(f.created_at) = CURDATE()";
                        break;
                    case '7days':
                        // Filter for feedback in the last 7 days
                        $sql_analysis .= " AND f.created_at >= CURRENT_DATE - INTERVAL 7 DAY";
                        break;
                    case 'year':
                        // Filter for feedback in the current year
                        $sql_analysis .= " AND YEAR(f.created_at) = YEAR(CURRENT_DATE)";
                        break;
                    default:
                        // Check if it's a month filter
                        if (ctype_digit($filter) && $filter >= 1 && $filter <= 12) {
                            // Filter for feedback in the specified month
                            $sql_analysis .= " AND MONTH(f.created_at) = $filter";
                        }
                        break;
                }
            }

            $sql_analysis .= " GROUP BY e.emoji_id, f.answer_id
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
    <p>Text-based</p>
</div>
<?php
// Initialize $sql_overall with a default query
$sql_overall = "WITH SentimentFeedback AS (
                    SELECT 
                        qc.question_category,
                        COUNT(*) AS total_feedback,
                        (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS negative,
                        (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS neutral,
                        (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS positive,
                        CASE
                            WHEN GREATEST(
                                (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                            ) = (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Negative'
                            WHEN GREATEST(
                                (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                            ) = (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Neutral'
                            WHEN GREATEST(
                                (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                            ) = (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Positive'
                        END AS highest_sentiment,
                        GREATEST(
                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                        ) AS highest_percentage
                    FROM
                        feedback f
                        INNER JOIN questions q USING (question_id)
                        INNER JOIN question_category qc USING (qc_id)
                        INNER JOIN question_type qt USING (qt_id)
                    WHERE qt.question_type = 'Text-based'
                    GROUP BY qc.question_category
                )
                
                SELECT 
                    sf.question_category,
                    sf.total_feedback,
                    sf.negative,
                    sf.neutral,
                    sf.positive,
                    sf.highest_sentiment,
                    sf.highest_percentage
                FROM 
                    SentimentFeedback sf;";

// Check if filter is set
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];

    switch ($filter) {
        case '7days':
            // Modify $sql_overall according to '7days' filter
            $sql_overall = "WITH SentimentFeedback AS (
                                SELECT 
                                    qc.question_category,
                                    COUNT(*) AS total_feedback,
                                    (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS negative,
                                    (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS neutral,
                                    (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS positive,
                                    CASE
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Negative'
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Neutral'
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Positive'
                                    END AS highest_sentiment,
                                    GREATEST(
                                        (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                        (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                        (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                    ) AS highest_percentage
                                FROM
                                    feedback f
                                    INNER JOIN questions q USING (question_id)
                                    INNER JOIN question_category qc USING (qc_id)
                                    INNER JOIN question_type qt USING (qt_id)
                                WHERE qt.question_type = 'Text-based'
                                    AND f.created_at >= CURRENT_DATE - INTERVAL 7 DAY -- Filter for feedback in the last 7 days
                                GROUP BY qc.question_category
                            )
                            
                            SELECT 
                                sf.question_category,
                                sf.total_feedback,
                                sf.negative,
                                sf.neutral,
                                sf.positive,
                                sf.highest_sentiment,
                                sf.highest_percentage
                            FROM 
                                SentimentFeedback sf;";
            break;
        case '1':
        case '2':
        case '3':
        case '4':
        case '5':
        case '6':
        case '7':
        case '8':
        case '9':
        case '10':
        case '11':
        case '12':
            $month = intval($filter); // Convert month filter to integer
            // Modify $sql_overall according to month filter
            $sql_overall = "WITH SentimentFeedback AS (
                                SELECT 
                                    qc.question_category,
                                    COUNT(*) AS total_feedback,
                                    (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS negative,
                                    (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS neutral,
                                    (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS positive,
                                    CASE
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Negative'
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Neutral'
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Positive'
                                    END AS highest_sentiment,
                                    GREATEST(
                                        (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                        (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                        (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                    ) AS highest_percentage
                                FROM
                                    feedback f
                                    INNER JOIN questions q USING (question_id)
                                    INNER JOIN question_category qc USING (qc_id)
                                    INNER JOIN question_type qt USING (qt_id)
                                WHERE qt.question_type = 'Text-based'
                                    AND MONTH(f.created_at) = $month -- Filter for feedback in the specified month
                                GROUP BY qc.question_category
                            )
                            
                            SELECT 
                                sf.question_category,
                                sf.total_feedback,
                                sf.negative,
                                sf.neutral,
                                sf.positive,
                                sf.highest_sentiment,
                                sf.highest_percentage
                            FROM 
                                SentimentFeedback sf;";
            break;
        case 'year':
            // Modify $sql_overall according to year filter
            $sql_overall = "WITH SentimentFeedback AS (
                                SELECT 
                                    qc.question_category,
                                    COUNT(*) AS total_feedback,
                                    (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS negative,
                                    (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS neutral,
                                    (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS positive,
                                    CASE
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Negative'
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Neutral'
                                        WHEN GREATEST(
                                            (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                            (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                        ) = (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100 THEN 'Positive'
                                    END AS highest_sentiment,
                                    GREATEST(
                                        (SUM(CASE WHEN f.text_sentiment = 0 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                        (SUM(CASE WHEN f.text_sentiment = 1 THEN 1 ELSE 0 END) / COUNT(*)) * 100,
                                        (SUM(CASE WHEN f.text_sentiment = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100
                                    ) AS highest_percentage
                                FROM
                                    feedback f
                                    INNER JOIN questions q USING (question_id)
                                    INNER JOIN question_category qc USING (qc_id)
                                    INNER JOIN question_type qt USING (qt_id)
                                WHERE qt.question_type = 'Text-based'
                                    AND YEAR(f.created_at) = YEAR(CURRENT_DATE) -- Filter for feedback in the current year
                                GROUP BY qc.question_category
                            )
                            
                            SELECT 
                                sf.question_category,
                                sf.total_feedback,
                                sf.negative,
                                sf.neutral,
                                sf.positive,
                                sf.highest_sentiment,
                                sf.highest_percentage
                            FROM 
                                SentimentFeedback sf;";
            break;
        default:
            // Default case: no filter or unsupported filter, use a general query
            break;
    }
}

$result_overall = mysqli_query($conn, $sql_overall);

if (mysqli_num_rows($result_overall) > 0) {
    while ($row_overall = mysqli_fetch_assoc($result_overall)) {
        $question_category = $row_overall['question_category'];
        $total_feedback = $row_overall['total_feedback'];
        $negative = $row_overall['negative'];
        $neutral = $row_overall['neutral'];
        $positive = $row_overall['positive'];
        $highest_sentiment = $row_overall['highest_sentiment'];
        $highest_percentage = $row_overall['highest_percentage'];
?>
        <div class="card-analysis">
            <div class="card-body-analysis-text">
                <p><b><?= $question_category ?> Experience</b></p>
                <p><b>Total Feedback:</b> <?= $total_feedback ?></p>
                <p><b>Negative:</b> <?= $negative ?>%</p>
                <p><b>Neutral:</b> <?= $neutral ?>%</p>
                <p><b>Positive:</b> <?= $positive ?>%</p>
                <p><b>Highest Sentiment:</b> <?= $highest_sentiment ?></p>
                <p><b>Highest Percentage:</b> <?= $highest_percentage ?>%</p>
                <br>
            </div>
        </div>
<?php
    }
}
?>


    




                    <!-- reference website -->
                    <div class="card-analysis">
                        <div class="card-body-analysis-text">
                            <p style="font-size: small; "><span><i class="fa-solid fa-circle-info"></i></span>
                                Sentiment scoring was based on <a
                                    href="https://kt.ijs.si/data/Emoji_sentiment_ranking/?emoji">Emoji Sentiment
                                    Ranking v1.0</a></p>
                            <p style="font-size: small;"><span><i class="fa-solid fa-circle-info"></i></span>
                                Remarks was based on <a href="https://emojipedia.org/">Emojipedia.org</a></p>
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
                    <p>
                        <?= $generatedContent; ?>
                    </p>
                </div>
            </div>
        </section>
    </main>
    <script>
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
    </script>
    </div>
    <?php
    require_once 'js/scripts.php';
    ?>
</body>

</html>
