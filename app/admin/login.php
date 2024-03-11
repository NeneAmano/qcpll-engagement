<?php
    require_once('../core/init.php');
    ob_start();
    $sql = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
    mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>QCPL Login</title>
    <style>
        body, html {
            height: 100%;
       
        }

        .card-container.card {
            max-width: 350px;
            padding: 40px 40px;
        }

        .btn {
            font-weight: 700;
            height: 36px;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            cursor: default;
        }

        /*
        * Card component
        */
        .card {
            background-color: #F7F7F7;
            /* just in case there no content*/
            padding:60px;
            transform: translate(140%,70%);
            /* shadows and rounded borders */
            -moz-border-radius: 4px;
            -webkit-border-radius: 2px;
            border-radius: 10px;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .profile-img-card {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }

        /*
        * Form styles
        */
        .profile-name-card {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0 0;
            min-height: 1em;
        }

        .reauth-email {
            display: block;
            color: #404040;
            line-height: 2;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin #inputEmail,
        .form-signin #inputPassword {
            direction: ltr;
            height: 44px;
            font-size: 16px;
        }

        .form-signin input[type=email],
        .form-signin input[type=password],
        .form-signin input[type=text],
        .form-signin button {
            width: 100%;
            display: block;
            margin-bottom: 10px;
            z-index: 1;
            position: relative;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            border-color: rgb(104, 145, 162);
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
        }

        .btn.btn-signin {
            /*background-color: #4d90fe; */
            background-color: rgb(104, 145, 162);
            /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
            padding: 0px;
            font-weight: 700;
            font-size: 14px;
            height: 36px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            border: none;
            -o-transition: all 0.218s;
            -moz-transition: all 0.218s;
            -webkit-transition: all 0.218s;
            transition: all 0.218s;
        }

        .btn.btn-signin:hover,
        .btn.btn-signin:active,
        .btn.btn-signin:focus {
            background-color: rgb(12, 97, 33);
        }

        .forgot-password {
            color: rgb(104, 145, 162);
        }

        .forgot-password:hover,
        .forgot-password:active,
        .forgot-password:focus{
            color: rgb(12, 97, 33);
        }
        @import url('https://fonts.googleapis.com/css?family=Exo:400,700');







.area{
    background-image:linear-gradient(rgba(18, 54, 39, 0.7),rgba(34, 42, 77, 0.7)),url(../public/assets/images/bg.png);
    background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);  
    width: 100%;
    height:100vh;
    
   
}

.circles{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: animate 25s linear infinite;
    bottom: -150px;
    
}

.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}


.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}



@keyframes animate {

    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }

}
    </style>
</head>
<body>

<div class="area" >
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
            <?php
        if(isset($_POST['login'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            if(empty($username) || empty($password)) {
                header('location: login.php?error=emptyfields');
                die();
            }

            // function to check if username already exists
            function usernameExists($conn, $username) {
                $sql = "SELECT * FROM users WHERE username = ?;";
                $stmt = mysqli_stmt_init($conn);
        
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                }
        
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
        
                $resultData = mysqli_stmt_get_result($stmt);
        
                if($row = mysqli_fetch_assoc($resultData)) {
                    return $row;
                } else {
                    $result = false;
                    return $result;
                }
        
                mysqli_stmt_close($stmt);
            }
            // end of function

            $usernameExists = usernameExists($conn, $username);

            if($usernameExists === false) {
                header("location: login.php?error=invalidusername");
                die();
            }
            
            $passwordHashed = $usernameExists["password"];

            $checkPassword = password_verify($password, $passwordHashed);

            if($checkPassword === false) {
                header("location: login.php?error=invalidpassword");
                die();
            } elseif($checkPassword === true) {
                
                $query = "SELECT * FROM users WHERE user_id = '" .$usernameExists['user_id']. "' AND username = '" .$usernameExists['username']. "' AND is_active = 0 AND (user_role_id = 1 OR user_role_id = 2);";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);
                if($count === 1) {    
       
                    $_SESSION['user_id'] = $usernameExists['user_id'];
                    $_SESSION['username'] = $usernameExists['username'];
                    $_SESSION['user_role_id'] = $usernameExists['user_role_id'];

                    $query = "UPDATE users SET last_login = NOW() WHERE user_id = '" .$usernameExists['user_id']. "' AND username = '" .$usernameExists['username']. "';";
                    $result = mysqli_query($conn, $query);

                    $logs_sql = "INSERT INTO history_logs (user_id, content, content_id, _action) VALUES (".$_SESSION['user_id'].", 'login', 0, 'Log in');";
                    $logs_result = mysqli_query($conn, $logs_sql);
                    echo '<script>
                    $(document).ready(function(){
                        swal({
                            title: "", 
                            text: "",
                            icon: "../../public/assets/images/loader/loader.gif",
                            buttons: false,      
                            closeOnClickOutside: false,
                            timer: 3000,
                        }).then(function(){
                            window.location.href = "dashboard.php";
                        });
                    });
                </script>';
                    die();
                } else {
                    header("location: login.php?error=invalidaccess");
                    die();
                }
            }
        }
    ?>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="../../public/assets/images/qcpl.logo.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username"  autofocus>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" >
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login">Log in</button>
                <?php
                    $error_message = '';
                    if(isset($_GET['error'])){
                        if($_GET['error'] === 'emptyfields'){
                            $error_message = 'All fields are required.';
                        }elseif($_GET['error'] === 'invalidusername'){
                            $error_message = 'Invalid username.';
                        }elseif($_GET['error'] === 'invalidpassword'){
                            $error_message = 'Invalid password.';
                        }elseif($_GET['error'] === 'invalidaccess'){
                            $error_message = 'Invalid access.';
                        }elseif($_GET['error'] === 'accessdenied'){
                            $error_message = 'Access denied.';
                        }
                    }
                ?>
                <p style="color: red; text-align: center;"><?= $error_message; ?></p>
            </form>
            <!-- /form -->
        </div>
        <!-- /card-container -->
    </div>

    </div >
    
    <!-- /container -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>