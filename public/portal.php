<?php 
    require_once("../app/queuing/includes/header.php");
?>
<body>

    <section id="swup" class="transtion-fade">
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
    </section>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="script.js"></script>
</body>
</html>