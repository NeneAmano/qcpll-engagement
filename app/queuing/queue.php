<?php 
    require_once("includes/queue-header.php");

    if(isset($_SESSION['user_id'])){
        $firstname_error = '';
        $middlename_error = '';
        $surname_error = '';
        $suffix_error = '';

        $firstname_success = '';
        $middlename_success = '';
        $surname_success = '';
        $suffix_success = '';

        $firstname_value = '';
        $middlename_value = '';
        $surname_value = '';
        $suffix_value = '';

        if(isset($_POST['submit'])){
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);

            if(nameInvalid($firstname) !== false) {
                $firstname_error = ' *Invalid First Name';
            } else {
                $firstname_error = '';
                $firstname_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                $firstname_value = $firstname;
            }

            if(nameInvalid($middlename) !== false) {
                $middlename_error = ' *Invalid Middle Name';
            } else {
                $middlename_error = '';
                $middlename_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                $middlename_value = $middlename;
            }

            if(nameInvalid($surname) !== false) {
                $surname_error = ' *Invalid Surname';
            } else {
                $surname_error = '';
                $surname_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                $surname_value = $surname;
            }

            if(nameInvalid($suffix) !== false) {
                $suffix_error = ' *Invalid Suffix';
            } else {
                $suffix_error = '';
                $suffix_success = ' <i class="fa-sharp fa-solid fa-circle-check"></i>';
                $suffix_value = $suffix;
            }
        }
    }


?>
<body>
    <section id="swup" class="transtion-fade">
    <div class="logo">
            <img src="../../public/assets/images/qclogo.jpg" alt="">
            <div class="title">
            <p>Quezon City Public Library</p>
            <p>Quezon City Government</p>
            </div>
            <img src="../../public/assets/images/qcplLogo.png" alt="">
        </div>

        <!-- start of demographic form -->
        <div class="wrapper">
            <div class="inner">
                <div class="image-holder">
                    <img src="../../public/assets/images/demographic-img.png" alt="">
                </div>
                <form action="" method="post">
                    <h3>Demographic Form</h3>
                    <div class="form-group">
                        <span class="text-danger"><?= $firstname_error ?></span><span class="text-success"><?= $firstname_success ?></span>
                        <input type="text" name="firstname" id="" placeholder="First Name" class="form-control" value="<?= $firstname_value ?>" required>

                        <span class="text-danger"><?= $middlename_error ?></span><span class="text-success"><?= $middlename_success ?></span>
                        <input type="text" name="middlename" id="" placeholder="Middle Name" class="form-control" value="<?= $middlename_value ?>" >

                        <span class="text-danger"><?= $surname_error ?></span><span class="text-success"><?= $surname_success ?></span>
                        <input type="text" name="surname" id="" placeholder="Surname" class="form-control" value="<?= $surname_value ?>" required>

                        <span class="text-danger"><?= $suffix_error ?></span><span class="text-success"><?= $suffix_success ?></span>
                        <input type="text" name="suffix" id="" placeholder="Suffix" class="form-control" value="<?= $suffix_value ?>" >
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
                    <button class="existBtn" onclick="window.location.href='existProfile.php';">Already have an account?</button>
                    <!-- <a href="existProfile.php" class="existBtn">Already have Account?</a> -->
                    <button type="submit" name="submit" class="profileBtn">Submit</button>
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