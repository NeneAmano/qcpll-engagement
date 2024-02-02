<?php 
    require_once("../app/includes/header.php");
?>
<style>
    .dropdown {
        max-width: 10%;
        position: fixed;
        display: flex;
        justify-content: flex-start;
    }

    .dropdown:hover > .dropdown-menu {
        display: block;
    }

    .dropdown > .dropdown-toggle:active {
        pointer-events: none;
    }

    ion-icon {
        color: #ffffff;
        padding: 10px;
        background-color: #13a561;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        transition: 0.2s ease-in-out;
    }
    .logo-facebook:hover{
        color: #1877F2;
    }
    .logo-twitter:hover{
        color: #1D9BF0;
    }
    .logo-instagram:hover{
        color: rgb(225, 48, 108) ;
    }
    .logout-btn{
        display: flex;
        flex-direction: column;
        position: relative;
        gap:0.1px;
        right: 3em;
        bottom: 6em;

    }
    
    ion-icon:hover {
        color: #13a561;
        background-color: #ffffff;
    }

    .container-btn {
        position: fixed;
        top: 2em; /* Adjust the top position for smaller screens */
        right: 1em; /* Adjust the right position for smaller screens */
        z-index: 1000; /* Ensure the button stays on top of other elements */
    }

    @media screen and (min-width: 768px) {
        .container-btn {
            top: 35em; /* Adjust the top position for larger screens */
            right: 3em; /* Adjust the right position for larger screens */
        }
    }
</style>

<body>
    <section id="swup" class="transtion-fade">
    <?php  
        if(isset($_SESSION['user_id'])){
            $sql = "SELECT * FROM users WHERE user_id = $user_id_session";
            $res = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($res)){
                echo '<div class="container-btn">';
                echo '<div class="logout-btn">';
                    echo '<a href="../app/includes/logout.php"><ion-icon name="log-out-outline"></ion-icon></a>';
                    echo '<a href="../app/includes/logout.php"><ion-icon name="logo-facebook" class="logo-facebook"></ion-icon></a>';
                    echo '<a href="../app/includes/logout.php"><ion-icon name="logo-twitter"  class="logo-twitter"></ion-icon></a>';
                    echo '<a href="../app/includes/logout.php"><ion-icon name="logo-instagram" class="logo-instagram"></ion-icon></a>';
                echo '</div>';
            echo '</div>';
            }
        }else
        echo 'test';
    ?>

    
        <div class="logo">
            <img src="assets/images/qclogo.jpg" alt="">
            <div class="title">
            <p>Quezon City Public Library</p>
            <p>Quezon City Government</p>
            </div>
            <img src="assets/images/qcplLogo.png" alt="">
        </div>

    <div class="container-1">
        <div class="promotext-1">
            <h1>Welcome to </h1>
            <h3>EngageMate</h3>
            <p>Offers free assistance to all individuals <br>
                who wish to access the online government services <br>
                offered by different department agencies of the Philippines.</p>
        </div>
        <div class="pathBtn">
            <button class="QueueBtn" onclick="window.location.href='../app/queuing/queue.php';">Queuing</button>
            <button class="FeedbackBtn" onclick="window.location.href='../app/feedback/feedback.php';">Feedback</button>
            <!-- <a href="feedback.php" class="FeedbackBtn">To Feedback</a> -->
        </div>
    </div>
    
    <!-- for logout btn -->


    <script src="https://unpkg.com/swup@4"></script>
    <script src="./assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
