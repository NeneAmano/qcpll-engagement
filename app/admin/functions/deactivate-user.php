<?php
    require_once '../../core/init.php';

    if(isset($_POST['deactivate_user'])){
        $deactivate_user_id = mysqli_real_escape_string($conn, $_POST['deactivate_user_id']);

        $sql = "UPDATE users SET is_active = 1 WHERE user_id = $deactivate_user_id;";
        if(mysqli_query($conn, $sql)){
            $logs_sql = "INSERT INTO history_logs (user_id, content, content_id, _action) VALUES ($user_id_session, 'users', $deactivate_user_id, 'Deactivate');";
            $logs_result = mysqli_query($conn, $logs_sql);

            header("location: ../users.php?deactivate=successful");
            die();
        }
    }else{
        header("location: ../users.php");
        die();
    }