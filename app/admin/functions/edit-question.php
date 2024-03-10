<?php
    require_once '../../core/init.php';

    if(isset($_POST['edit_question'])){
        $edit_question_id = mysqli_real_escape_string($conn, $_POST['edit_question_id']);
        $edit_english_question = mysqli_real_escape_string($conn, $_POST['edit_english_question']);
        $edit_tagalog_question = mysqli_real_escape_string($conn, $_POST['edit_tagalog_question']);

        if(empty($edit_question_id) || empty($edit_english_question) || empty($edit_tagalog_question)){
            $error_message = "All fields are required!";
            echo "<script type='text/javascript'>alert('$error_message');</script>";
            $error_redirect = '<h3 style="color: red; text-align: center;">All fields are required! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
            <script type="text/javascript">
                function countdown() {
                    var i = document.getElementById("counter");
                    if (parseInt(i.innerHTML)<=0) {
                        location.href = "../questions.php";
                    }
                    i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
            </script>';
            echo $error_redirect;
            header("refresh:5;url=../questions.php?archived-records=no.php");
            die();
        }else{
            $sql = "UPDATE questions SET english_question = '$edit_english_question', tagalog_question = '$edit_tagalog_question' WHERE question_id = $edit_question_id;";
            if(mysqli_query($conn, $sql)){
                $logs_sql = "INSERT INTO history_logs (user_id, content, content_id, _action) VALUES ($user_id_session, 'questions', $edit_question_id, 'Edit');";
                $logs_result = mysqli_query($conn, $logs_sql);
                header("location: ../questions.php?archived-records=no&edit=successful");
                die();
            }
        }
    }