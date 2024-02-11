<?php
    require_once '../../core/init.php';

    if(isset($_POST['delete_question'])){
        $delete_question_id = mysqli_real_escape_string($conn, $_POST['delete_question_id']);

        $sql = "UPDATE questions SET is_deleted = 1 WHERE question_id = $delete_question_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../questions.php?delete=successful");
            die();
        }
    }else{
        header("location: ../questions.php");
        die();
    }