<?php
    require_once '../../core/init.php';

    if(isset($_POST['edit_user_password'])){
        $edit_user_password_id = mysqli_real_escape_string($conn, $_POST['edit_user_password_id']);
        $edit_current_password = mysqli_real_escape_string($conn, $_POST['edit_current_password']);
        $edit_password = mysqli_real_escape_string($conn, $_POST['edit_password']);
        $edit_repeat_password = mysqli_real_escape_string($conn, $_POST['edit_repeat_password']);

        if(empty($edit_user_password_id) || empty($edit_current_password) || empty($edit_password) || empty($edit_repeat_password)){
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
            $sql = "SELECT * FROM users WHERE user_id = $edit_user_password_id;";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $passwordHashed = $row["password"];

                $checkPassword = password_verify($edit_current_password, $passwordHashed);
                if($checkPassword === false){
                    $error_message = "Incorrect current password!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                    $error_redirect = '<h3 style="color: red; text-align: center;">Incorrect current password! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
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
                }

                if($edit_password === $edit_repeat_password){
                    $hashedPassword = password_hash($edit_password, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET password = '$hashedPassword' WHERE user_id = $edit_user_password_id;";
                    if(mysqli_query($conn, $sql)){
                        header("location: ../users.php?edit=successful");
                        die();
                    }
                }else{
                    $error_message = "Password does not match!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                    $error_redirect = '<h3 style="color: red; text-align: center;">Password does not match! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
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
                }
            }
        }
    }