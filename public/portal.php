<?php 
    require_once("../app/includes/header.php");
?>

<body>
<style>
    .dropdown{
        max-width: 10%;
        position: fixed;
        display: flex;
        justify-content: flex-start;
    }
    .dropdown:hover>.dropdown-menu {
        display: block;
}

.dropdown>.dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
    pointer-events: none;
}
</style>
    <section id="swup" class="transtion-fade">
    <?php  if(isset($_SESSION['user_id'])){
        $sql = "SELECT username FROM users";
        $res = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($res)){
            $username = $row['username'];
            echo '<div class="dropdown">';
                echo '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    '.$username.'
                </button>';
                    echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
                        echo '<li><a class="dropdown-item" href="../app/includes/logout.php">Log out</a></li>';
                    echo '</ul>';
            echo '</div>';
        }
       }?>
    <div class="logo">
            <img src="./images/qclogo.jpg" alt="">
            <div class="title">
            <p>Quezon City Public Library</p>
            <p>Quezon City Government</p>
            </div>
            <img src="./images/qcplLogo.png" alt="">
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
        

    

    <script src="https://unpkg.com/swup@4"></script>
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
