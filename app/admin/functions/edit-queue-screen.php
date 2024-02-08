<?php
    require_once '../../core/init.php';

    if(isset($_POST['edit_user'])){
        $edit_qt_id = mysqli_real_escape_string($conn, $_POST['edit_qt_id']);
        $edit_entry_check = mysqli_real_escape_string($conn, $_POST['edit_entry_check']);

        if(empty($edit_qt_id) || empty($edit_entry_check)){
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
            header("refresh:5;url=../queue-screen.php");
            die();
        }else{
            $sql = "UPDATE users SET user_role_id = $edit_user_role, username = '$edit_username' WHERE user_id = $edit_user_id;";
            if(mysqli_query($conn, $sql)){
                header("location: ../users.php?edit=successful");
                die();
            }
        }
    }