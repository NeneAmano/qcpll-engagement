<?php
    require_once('../core/init.php');
    if(isset($_GET['client_id'])){
        $client_id = $_GET['client_id'];
    }else{
        header('location:feedback.php');
        die();
    }
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Feedback</title>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<!-- latest bootstrap cdn -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<style>
    * {
        box-sizing: border-box;
    }
    body {
        background-color: #f1f1f1;
    }
    #regForm {
        background-color: #ffffff;
        margin: 100px auto;
        font-family: Raleway;
        padding: 40px;
        width: 70%;
        min-width: 300px;
    }
    h1 {
        text-align: center;
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
        color: #ffffff;
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
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f0f0;
        font-family: 'Arial', sans-serif;
    }
    #question-container {
        text-align: center;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
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
        width: 100px;
        /* Adjust the size as needed */
        margin-top: 10px;
    }
    .reaction img:hover {
        transform: translate(0px, -20px);
        transition: ease-in 0.1s;
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
  transform: translate(0px, -18px);
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
</style>
<body>
    <form id="regForm" action="" method="POST">
        <!-- One "tab" for each step in the form: -->
        <?php
            // get the total rows of question table
            $sql_row = "SELECT COUNT(question_id) AS total_rows FROM questions;";
            $result_row = mysqli_query($conn, $sql_row);
            if(mysqli_num_rows($result_row) > 0){
                while($row_row = mysqli_fetch_assoc($result_row)){
                    $total_rows = $row_row['total_rows'];
                }
            }

            $sql = "SELECT * FROM questions WHERE is_deleted != 1;";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    $question_id = $row['question_id'];
                    $qt_id = $row['qt_id'];
                    $english_question = $row['english_question'];
                    $tagalog_question = $row['tagalog_question'];
        ?>
                    <!-- emoji based answer starts here -->
                    <div class="tab">
                        <div id="question-container">
                            <p id="english<?= $qt_id ?>" class="fs-4"><?= $english_question; ?></p>
                            <p id="tagalog<?= $qt_id ?>" class="fs-6 fst-italic"><?= $tagalog_question; ?></p>
                            <div class="reaction-container">
                                <?php
                                    if($qt_id == 1){
                                        $sql_emoji = "SELECT * FROM emoji WHERE UNICODE != '0' ORDER BY emoji_id DESC LIMIT 5;";
                                        $result_emoji = mysqli_query($conn, $sql_emoji);
                                        if(mysqli_num_rows($result_emoji) > 0){
                                            while($row_emoji = mysqli_fetch_assoc($result_emoji)){
                                                $emoji_id = $row_emoji['emoji_id'];
                                                $image_path = $row_emoji['image_path'];
                                                $value = $row_emoji['value'];
                                        ?>
                                                <div class="reaction">
                                                <label>
                                                <input type="radio" id="emoji<?=$question_id .$emoji_id?>" name="emoji<?= $question_id ?>" value="<?=$emoji_id?>" required>
                                                <img src="../../<?= $image_path?>" alt="Option 1">
                                                </label>
                                                    <p class="word"><?= $value ?></p>
                                                </div>
                                        <?php
                                            }
                                        }
                                    }else{
                                    ?>
                                        <input class="form-control form-control-lg" type="text" placeholder="" name="text<?= $question_id ?>" aria-label=".form-control-lg example">
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
        
            <div style="float:right; margin-top:12px;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>

                
                <button type="button" id="nextBtn" onclick="nextPrev(1)" name="submit">Next</button>
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
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
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
                document.getElementById("nextBtn").innerHTML = "Submit";
                document.getElementById("nextBtn").setAttribute('type', 'submit');
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
                document.getElementById("nextBtn").setAttribute('type', 'button');

            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab += n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                // document.getElementById("regForm").submit();
                return false;
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
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
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