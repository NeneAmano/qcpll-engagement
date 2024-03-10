<?php
    require_once '../../core/init.php';

    if(isset($_POST['edit_qc'])){
        $edit_qc_id = mysqli_real_escape_string($conn, $_POST['edit_qc_id']);
        $edit_question_category = mysqli_real_escape_string($conn, $_POST['edit_question_category']);

        if(empty($edit_qc_id) || empty($edit_question_category)){
            $error_message = "All fields are required!";
            echo "<script type='text/javascript'>alert('$error_message');</script>";
            $error_redirect = '<h3 style="color: red; text-align: center;">All fields are required! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
            <script type="text/javascript">
                function countdown() {
                    var i = document.getElementById("counter");
                    if (parseInt(i.innerHTML)<=0) {
                        location.href = "../users.php";
                    }
                    i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
            </script>';
            echo $error_redirect;
            header("refresh:5;url=../question-category.php");
            die();
        }else{
            $sql = "UPDATE question_category SET question_category = '$edit_question_category' WHERE qc_id = $edit_qc_id;";
            if(mysqli_query($conn, $sql)){
                $logs_sql = "INSERT INTO history_logs (user_id, content, content_id, _action) VALUES ($user_id_session, 'question-category', $edit_qc_id, 'Edit');";
                $logs_result = mysqli_query($conn, $logs_sql);
                header("location: ../question-category.php?edit=successful");
                die();
            }
        }
    }