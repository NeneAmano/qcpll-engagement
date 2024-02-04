<?php
    require_once '../../core/init.php';

    if(isset($_POST['deactivate'])){
        $deactivate_user_id = mysqli_real_escape_string($conn, $_POST['deactivate_user_id']);

        $sql = "UPDATE users SET is_active = 0 WHERE user_id = $deactivate_user_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../users.php?deactivate=successful");
            die();
        }
    }else{
        header("location: ../users.php");
        die();
    }