<?php
    require_once('../../core/init.php');
    if(isset($_GET['user_id'])){
        $user_id_session = $_GET['user_id'];

        $logs_sql = "INSERT INTO history_logs (user_id, content, content_id, _action) VALUES ($user_id_session, 'logout', 0, 'Log out');";
        $logs_result = mysqli_query($conn, $logs_sql);
    }
    session_unset();
    session_destroy();
    header("Location: ../login.php");