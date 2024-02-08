<?php
    require_once('../../core/init.php');
    if(isset($_GET['client_id'])){
        $client_id = $_GET['client_id'];

        $sql = "UPDATE queue_details SET status = 1 WHERE client_id = $client_id AND entry_check = 1;";
        if(mysqli_query($conn, $sql)){
            header('location: ../feedback.php');
            die();
        }
    }else{
        header('location: ../feedback.php');
        die();
    }