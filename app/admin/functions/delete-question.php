<?php
    require_once '../../core/init.php';

    if(isset($_POST['delete_question'])){
        $delete_question_id = mysqli_real_escape_string($conn, $_POST['delete_question_id']);

        $sql = "UPDATE questions SET is_deleted = 1 WHERE question_id = $delete_question_id;";
        if(mysqli_query($conn, $sql)){
            $logs_sql = "INSERT INTO history_logs (user_id, content, content_id, _action) VALUES ($user_id_session, 'questions', $delete_question_id, 'Delete');";
            $logs_result = mysqli_query($conn, $logs_sql);
            header("location: ../questions.php?archived-records=no&delete=successful");
            die();
        }
    }else{
        header("location: ../questions.php?archived-records=no");
        die();
    }