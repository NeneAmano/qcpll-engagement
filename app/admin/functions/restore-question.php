<?php
    require_once '../../core/init.php';

    if(isset($_POST['restore_question'])){
        $restore_question_id = mysqli_real_escape_string($conn, $_POST['restore_question_id']);

        $sql = "UPDATE questions SET is_deleted = 0 WHERE question_id = $restore_question_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../questions.php?archived-records=yes&restore=successful");
            die();
        }
    }else{
        header("location: ../questions?archived-records=no.php");
        die();
    }