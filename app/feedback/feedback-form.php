<?php
    require_once('../core/init.php');
    if (!isset($_SESSION['user_id'])) {
        header('location: ../../public/index.php');
        die();
    }else{
        if(isset($_GET['client_id'])){
            $client_id = $_GET['client_id'];

            $sql_completed = "UPDATE queue_details SET status = 1 WHERE entry_check = 1 AND client_id = $client_id;";
            (mysqli_query($conn, $sql_completed));
            
            $sql_rejected = "UPDATE queue_details SET status = 2 WHERE entry_check = 0 AND client_id = $client_id;";
            (mysqli_query($conn, $sql_rejected));

            // get the total rows of question table
            $sql_row = "SELECT COUNT(question_id) AS total_rows FROM questions WHERE is_deleted != 1;";
            $result_row = mysqli_query($conn, $sql_row);
            if (mysqli_num_rows($result_row) > 0) {
                while ($row_row = mysqli_fetch_assoc($result_row)) {
                    $total_rows = $row_row['total_rows'];
                }
            }

            if (isset($_POST['submit'])) {
                $sql_q_id = "SELECT question_id FROM questions WHERE is_deleted != 1;";
                $result_q_id = mysqli_query($conn, $sql_q_id);
                if (mysqli_num_rows($result_q_id) > 0) {
                    while ($row_q_id = mysqli_fetch_assoc($result_q_id)) {
                        $q_id = $row_q_id['question_id'];
                        // echo $q_id;
                        if (isset($_POST["question{$q_id}"])) {

                            $question_value = mysqli_real_escape_string($conn, $_POST["question{$q_id}"]);
                            
                            // Handle emoji-based questions
                            if (isset($_POST["emoji{$q_id}"])) {
                                $emoji_value = mysqli_real_escape_string($conn, $_POST["emoji{$q_id}"]);
                                $sql = "INSERT INTO feedback (client_id, question_id, answer_id) VALUES ($client_id, $question_value, $emoji_value);";
                                $emoji_query = mysqli_query($conn, $sql);
                            }
            
                            // Handle checkbox-based questions
                            if (isset($_POST["choice{$q_id}"])) {
                                $checkbox_values = $_POST["choice{$q_id}"];
                                foreach ($checkbox_values as $choice_value) {
                                    $sql = "INSERT INTO feedback (client_id, question_id, answer_id) VALUES ($client_id, $question_value, $choice_value);";
                                    $choice_query = mysqli_query($conn, $sql);
                                }
                            }
            
                            // Handle text-based questions
                            if (isset($_POST["text{$q_id}"])) {
                                $text_value = mysqli_real_escape_string($conn, $_POST["text{$q_id}"]);
                                $sql = "INSERT INTO feedback (client_id, question_id, text_feedback) VALUES ($client_id, $question_value, '$text_value');";
                                $text_query = mysqli_query($conn, $sql);
                            }
                        }
                    }
                    if($emoji_query == true && $choice_query == true && $text_query == true){
                        header('location: feedback.php');
                        die();
                    }
                }
            }
        }else{
            header('location: feedback.php');
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quezon City Public Library</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/qcplLogo.png" type="image/x-icon">
    <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <style>
        body{
            height: 40vh;
        }
        #regForm {
            background-color: #e0f0e3;
            margin: 100px auto;
            font-family: Raleway;
            padding: 40px;
            width: 50%;
            min-width: 300px;
            border-radius: 7px;
            margin-bottom: 40px !important;
            position: relative;
            bottom: 4.5em;
        }
        h1 {
            text-align: center;
            color: #e0f0e3;
        }
        p{
            color:#5a5255;
        }
        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }
        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }
        /* Hide all steps by default: */
        .tab {
            display: none;
        }
        button {
            background-color: #04AA6D;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.8;
        }
        #prevBtn {
            background-color: #bbbbbb;
        }
        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }
        .step.active {
            opacity: 1;
        }
        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
        }

        #question-container {
            text-align: center;
            padding: 30px;
            background-color: #c8e1cc;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        }
        #question {
            font-size: 1.8em;
            margin-bottom: 20px;
        }
        .reaction-container {
            display: flex;
            justify-content: space-around;
            gap: 0.5em;
        }
        .reaction {
            text-align: center;
        }
        .reaction img {
            width: 80px;
            /* Adjust the size as needed */
            margin-top: 10px;
        }
        .reaction img:hover {
            width: 100px;
            transition: ease-in-out 0.2s;
            cursor: pointer;
        }
        .word {
            font-size: 1.2em;
            margin-top: 10px;
        }
        label {
            font-size: 1em;
        }

            /* HIDE RADIO */
        [type=radio] { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
        cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            width: 120px;
        box-shadow: 26px 200px 203px -96px rgba(0,0,0,1);
        -webkit-box-shadow: 26px 200px 203px -96px rgba(0,0,0,1);
        -moz-box-shadow: 26px 200px 203px -96px rgba(0,0,0,1);
        filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3));
        border-radius: 50%;
        background-color: transparent;
        }
        .hidden {
            display: none;
        }
        
        /* for the next page btn design */
    button,.btn-lg {
    cursor: pointer;
    font-weight: 700;
    font-family: Helvetica,"sans-serif";
    transition: all .2s;
    padding: 10px 20px;
    border-radius: 100px;
    background-color: #c8e1cc;
    border: 1px solid transparent;
    display: flex;
    align-items: center;
    font-size: 15px;
    
    }

    button:hover,.btn-lg:hover {
    background: #68c4af;
    }

    button > svg,.btn-lg > svg {
    width: 34px;
    margin-left: 10px;
    transition: transform .3s ease-in-out;
    }

    button:hover svg,.btn-lg:hover svg {
    transform: translateX(5px);
    }

    button:active,.btn-lg:active {
    transform: scale(0.95);
    }
    </style>

<body>
<section id="swup" class="transtion-fade">\
    <div class="logo">
        <img src="../../public/assets/images/qclogo.jpg" alt="">
        <div class="title">
        <p>Quezon City Public Library</p>
        <p>Quezon City Government</p>
        </div>
        <img src="../../public/assets/images/qcplLogo.png" alt="">
    </div>

    <form id="regForm" method="post" action="">
        <!-- One "tab" for each step in the form: -->
        <?php
        $sql = "SELECT * FROM questions WHERE is_deleted != 1 ORDER BY qt_id;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $question_id = $row['question_id'];
                $qt_id = $row['qt_id'];
                $english_question = $row['english_question'];
                $tagalog_question = $row['tagalog_question'];
        ?>
                <!-- emoji based answer starts here -->
                <div class="tab">
                    <div id="question-container">
                        <p id="english<?= $question_id ?>" class="fs-4" style="font-size: 2em; font-weight:500;"><?= $english_question; ?></p>
                        <p id="tagalog<?= $question_id ?>" class="fs-6" style="font-size: 1.2em; font-style:italic;"><?= $tagalog_question; ?></p>
                        <input type="hidden" value="<?= $question_id ?>" name="question<?= $question_id ?>" id="answer<?= $question_id ?>">
                        <div class="reaction-container">
                            <?php
                            if ($qt_id == 1) {
                                $sql_emoji = "SELECT * FROM emoji WHERE in_choices != 0 ORDER BY emoji_id DESC LIMIT 5;";
                                $result_emoji = mysqli_query($conn, $sql_emoji);
                                if (mysqli_num_rows($result_emoji) > 0) {
                                    while ($row_emoji = mysqli_fetch_assoc($result_emoji)) {
                                        $emoji_id = $row_emoji['emoji_id'];
                                        $image_path = $row_emoji['image_path'];
                            ?>
                                        <div class="reaction">
                                            <label>
                                                <input type="radio" id="emoji<?= $question_id . $emoji_id ?>" name="emoji<?= $question_id ?>" value="<?= $emoji_id ?>" required>
                                                <img src="../../<?= $image_path ?>" alt="Option 1">
                                            </label>
                                        </div>
                                <?php
                                    }
                                }
                            } elseif($qt_id == 2) {
                                ?>
                                <div class="d-flex flex-column">
                                    <?php
                                        $sql_choice = "SELECT * FROM choices WHERE is_deleted != 1 AND question_id = $question_id";
                                        $result_choice = mysqli_query($conn, $sql_choice);
                                        if (mysqli_num_rows($result_choice) > 0) {
                                            while ($row_choice = mysqli_fetch_assoc($result_choice)) {
                                                $choice_id = $row_choice['choice_id'];
                                                $choice = $row_choice['choice'];
                                    ?>
                                                <div class="form-check">
                                                <label class="form-check-label" for="<?= $choice_id ?>">
                                                        <?= $choice ?>
                                                    </label>
                                                    <input class="form-check-input" type="checkbox" name="choice<?= $question_id ?>[]" value="<?= $choice_id ?>" id="<?= $choice_id ?>">

                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <style>
                                    .form-check{
                                        display: flex;
                                        flex-direction: row;
                                    }
                                    .form-check-input{
                                        /* display: flex;
                                        flex-direction: column;
                                        justify-content: flex-start;
                                        align-items: flex-start; */
                                        position: absolute;
                                        right: 10em;
                                    }
                                </style>
                            <?php
                            }elseif($qt_id == 3){
                                ?>
                                <input class="form-control form-control-lg" type="text" placeholder="" name="text<?= $question_id ?>" aria-label=".form-control-lg example" value="">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <!-- emoji based answer ends here -->
        
        <div style="overflow:auto;">

            <div style="float:right; margin-top:12px; display:flex; gap:1em;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)" class="">
                <span>Next Page</span>
                <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="37" cy="37" r="35.5" stroke="black" stroke-width="3"></circle>
                    <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="black"></path>
                </svg>
            </button>

                <button type="submit" class="d-none" id="submit" name="submit">
                <span>Submit</span>
                <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="37" cy="37" r="35.5" stroke="black" stroke-width="3"></circle>
                    <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="black"></path>
                </svg>
                </button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <?php
            for ($i = 0; $i < $total_rows; $i++) {
                echo '<span class="step"></span>';
            }
            ?>
        </div>

    </form>
</section>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            console.log("Showing tab " + n);
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("submit").className = 'btn btn-lg';
                document.getElementById("nextBtn").className = "d-none";
            } else {
                document.getElementById("submit").className = 'd-none';
                document.getElementById("nextBtn").className = "";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            console.log("Current tab: " + currentTab);
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                // document.getElementById("regForm").submit();
                // return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            // for (i = 0; i < y.length; i++) {
            //     // If a field is empty...
            //     if (y[i].value == "") {
            //         // add an "invalid" class to the field:
            //         y[i].className += " invalid";
            //         // and set the current valid status to false
            //         valid = false;
            //     }
            // }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>
    <!-- latest bootstrap js popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <!-- latest bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>
