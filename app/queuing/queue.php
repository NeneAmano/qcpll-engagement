<?php 
    require_once("includes/header.php");
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

        <!-- start of demographic form -->
        <div class="wrapper">
            <div class="inner">
                <div class="image-holder">
                    <img src="./images/demographic-img.png" alt="">
                </div>
                <form action="">
                    <h3>Demographic Form</h3>
                    <div class="form-group">
                        <input type="text" name="surname" id="" placeholder="Surname" class="form-control" required>
                        <input type="text" name="firstname" id="" placeholder="Firstname" class="form-control" required>
                        <input type="text" name="suffix" id="" placeholder="Suffix" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="date" name="" id="">
                    </div>
                    <div class="form-wrapper">
                        <select name="" id="" class="form-control">
                            <option value="" disabled selected>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-wrapper">
                        <select name="" id="" class="form-control">
                            <option value="" disabled selected>Educational Attainment</option>
                            <option value="ElementaryGraduate">Elementary Graduate</option>
                            <option value="HighSchoolLevel">High School Level</option>
                            <option value="HighSchoolGraduate">High School Graduate</option>
                            <option value="CollegeLevel">College Level</option>
                            <option value="CollegeGraduate">College Graduate</option>
                            <option value="MastersDegree">Master’s Degree</option>
                            <option value="DoctorateDegree">Doctorate Degree</option>
                            <option value="Vocational">Vocational</option>
                        </select>
                    </div>
                    <div class="form-wrapper">
                        <select name="" id="" class="form-control">
                            <option value="" disabled selected>Occupation</option>
                            <option value="Student">Student</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Employed">Employed</option>
                            <option value="Retired">Retired</option>
                        </select>
                    </div>
                    <div class="form-wrapper">
                        <h1>Please Select Services</h1>
                        <input type="checkbox" id="nbi" name="nbi" value="nbi">
                        <label for="nbi"> NBI</label><br>
                        <input type="checkbox" id="policeclearance" name="policeclearance" value="nbi">
                        <label for="policeclearance"> POLICE CLEARANCE</label><br>
                        <input type="checkbox" id="checkbox1">Other
                        <input type="text" name="" id="dialog1">
                    </div>
                    <button class="existBtn" onclick="window.location.href='existProfile.php';">Already have Account?</button>
                    <!-- <a href="existProfile.php" class="existBtn">Already have Account?</a> -->
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


    
    <script src="https://unpkg.com/swup@4"></script>
    <script src="script.js"></script>
</body>
</html>