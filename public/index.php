<?php 
    require_once("../app/includes/header.php");
?>
<body>

    <section id="swup" class="transtion-fade">
    <div class="logo">
            <img src="assets/images/qclogo.jpg" alt="">
            <div class="title">
            <p>Quezon City Public Library</p>
            <p>Quezon City Government</p>
            </div>
            <img src="assets/images/qcplLogo.png" alt="">
        </div>
        <div class="container">
            <div class="promotext">
                <h3>E-Government</h3>
                <h3>Services</h3>
                <p>Offers free assistance to all individuals <br>
                 who wish to access the online government services <br>
                 offered by different department agencies of the Philippines.</p>
            </div>
            <div class="login">
                <h4>Welcome Back!</h4>
                <p>Login to continue</p>
                <div class="logbox">
                    <div class="inputbox">
                        <input type="text" name="username" id="username" required>
                        <span>User name</span>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="pass" id="pass" required>
                        <span>Password</span>
                    </div>
                </div>
               <a href="../app/queuing/queue.php" class="button" style="text-decoration: none;">Log in</a>
            </div>
            <div class="bcgimage"></div>
        </div>
    </section>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="script.js"></script>
</body>
</html>