<?php 
require_once("./includes/head.php")
?>
<body>

    <section>
    <div class="logo">
            <img src="./images/qclogo.jpg" alt="">
            <div class="title">
            <p>Quezon City Public Library</p>
            <p>Quezon City Government</p>
            </div>
            <img src="./images/qcplLogo.png" alt="">
        </div>

        <!-- start of demographic form -->
        <div class="wrapper">
            <div class="inner">
                <div class="image-holder">
                    <img src="./images/demographic-img.png" alt="">
                </div>
                <form action="">
                    <h3>For Existing User</h3>
                    <div class="form-group">
                        <input type="text" name="surname" id="" placeholder="Surname" class="form-control">
                        <input type="text" name="firstname" id="" placeholder="Firstname" class="form-control">
                        <input type="text" name="suffix" id="" placeholder="Suffix" class="form-control">
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="form-wrapper">
                        <h1>Please Select Services</h1>
                        <input type="checkbox" id="nbi" name="nbi" value="nbi">
                        <label for="nbi"> NBI</label><br>
                        <input type="checkbox" id="policeclearance" name="policeclearance" value="nbi">
                        <label for="policeclearance"> POLICE CLEARANCE</label><br>
                        <input type="checkbox" id="checkbox1">Other
                        <input type="text" name="" id="dialog1">
                    </div>
                    <button class="existBtn" onclick="window.location.href='queue.php';">
                    <a href="queue.php" class="existBtn">Don't have Account?</a></button>
                    <button class="profileBtn">Submit</button>
                </form>
            </div>
        </div>
        
    </section>


      <script>
         $(function() {

            var dialog1 = $("#dialog1");
            var checkbox1 = $("#checkbox1");

            dialog1.dialog({
               autoOpen: false,
               modal: true,
               buttons: {
                  Save: function() {$(this).dialog("close");}
               },
               title: "Type below...",
               close : function() {checkbox1.prop('checked', false);}

            });

            checkbox1.click(function() {
               if (checkbox1.prop("checked")) {
                   dialog1.dialog("open");
               }
            });

         });
      </script>
   </head>


</body>
</html>