<?php
    require_once '../../core/init.php';

    if(isset($_POST['edit_user'])){
        $edit_user_id = mysqli_real_escape_string($conn, $_POST['edit_user_id']);
        $edit_user_role = mysqli_real_escape_string($conn, $_POST['edit_user_role']);
        $edit_username = mysqli_real_escape_string($conn, $_POST['edit_username']);

        if(empty($edit_user_id) || empty($edit_user_role) || empty($edit_username)){
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
            header("refresh:5;url=../users.php");
            die();
        }else{
            $sql = "UPDATE users SET user_role_id = $edit_user_role, username = '$edit_username' WHERE user_id = $edit_user_id;";
            if(mysqli_query($conn, $sql)){
                $logs_sql = "INSERT INTO history_logs (user_id, content, content_id, _action) VALUES ($user_id_session, 'users', $edit_user_id, 'Edit');";
                $logs_result = mysqli_query($conn, $logs_sql);

                header("location: ../users.php?edit=successful");
                die();
            }
        }
    }