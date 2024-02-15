<?php
    require_once('../../core/init.php');
    if(isset($_GET['client_id'])){
        $client_id = $_GET['client_id'];

        $sql_completed = "UPDATE queue_details SET status = 1 WHERE entry_check = 1 AND client_id = $client_id;";
        if(mysqli_query($conn, $sql_completed)){
            header("location: ../feedback.php");
        }
        $sql_rejected = "UPDATE queue_details SET status = 2 WHERE entry_check = 0 AND client_id = $client_id;";
        if(mysqli_query($conn, $sql_rejected)){
            header("location: ../feedback.php");
        }
    }