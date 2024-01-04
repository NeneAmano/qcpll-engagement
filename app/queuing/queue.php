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
        $age_value = '';

        if(isset($_POST['submit'])){
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
            $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $education = mysqli_real_escape_string($conn, $_POST['education']);
            $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
            $nbi = mysqli_real_escape_string($conn, $_POST['nbi']);
            $police = mysqli_real_escape_string($conn, $_POST['police']);
            $total_input = mysqli_real_escape_string($conn, $_POST['total_input']);

            // Initialize an empty array
            $others = array();

            // Use a loop to create $_POST['others'][] based on $total_input
            for ($i = 0; $i < $total_input; $i++) {
                // Use mysqli_real_escape_string or any other necessary validation/sanitization
                $others[$i] = mysqli_real_escape_string($conn, $_POST['others'][$i]);
            }
            // Iterate through $others and echo the values
            foreach ($others as $key => $value) {
                echo "Value of \$others[$key]: $value<br>";
            }


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

            if(empty($middlename)){
                $middlename_error = '';
            }

            if(empty($suffix)){
                $suffix_error = '';
            }

            //date in mm/dd/yyyy format; or it can be in other formats as well
            // $birthDate = "12/17/1983";
            //explode the date to get month, day and year
            $new_birthdate = date("m-d-Y", strtotime($birthdate));

            $new_birthdate = explode("-", $new_birthdate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $new_birthdate[0], $new_birthdate[1], $new_birthdate[2]))) > date("md")
                ? ((date("Y") - $new_birthdate[2]) - 1)
                : (date("Y") - $new_birthdate[2]));

            if(($age >= 0) && ($age <= 12)){
                $age_value = 1;
            }elseif(($age >= 13) && ($age <= 21)){
                $age_value = 2;
            }elseif(($age >= 22) && ($age <= 35)){
                $age_value = 3;
            }elseif(($age >= 36) && ($age <= 59)){
                $age_value = 4;
            }elseif($age >= 60){
                $age_value = 5;
            }
            
            if(!empty($firstname) && $firstname_error == '' && $middlename_error == '' && !empty($lastname) && $lastname_error == '' && $suffix_error == '' && !empty($birthdate)){

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
                <form action="" method="post" onsubmit="return validateForm()">
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
                        <input type="date" name="birthdate" id="birthdate" max="2000-13-13">
                    </div>
                    <div class="form-wrapper">
                        <select name="gender" id="" class="form-control">
                            <option value="" disabled selected>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-wrapper">
                        <select name="education" id="" class="form-control">
                            <option value="" disabled selected>Educational Attainment</option>
                            <option value="Elementary Graduate">Elementary Graduate</option>
                            <option value="HighSchool Level">High School Level</option>
                            <option value="HighSchool Graduate">High School Graduate</option>
                            <option value="College Level">College Level</option>
                            <option value="College Graduate">College Graduate</option>
                            <option value="Masters Degree">Master’s Degree</option>
                            <option value="Doctorate Degree">Doctorate Degree</option>
                            <option value="Vocational">Vocational</option>
                        </select>
                    </div>
                    <div class="form-wrapper">
                        <select name="occupation" id="" class="form-control">
                            <option value="" disabled selected>Occupation</option>
                            <option value="Student">Student</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Employed">Employed</option>
                            <option value="Retired">Retired</option>
                        </select>
                    </div>
                    <div class="form-wrapper">
                        <h1>Please Select Services</h1>
                        <input type="checkbox" id="nbi" name="checkbox-group" value="nbi">
                        <label for="nbi"> NBI</label><br>
                        <input type="checkbox" id="policeclearance" name="checkbox-group" value="police">
                        <label for="policeclearance"> POLICE CLEARANCE</label><br>

                        <input type="text" name="others[]">
                        <button onclick="add()" type="button">Add</button>
                        <button onclick="remove()" type="button">remove</button>
                        <div id="new_chq"></div>
                        <input type="hidden" value="1" id="total_chq" name="total_input">
                        
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

            // allows datepicker to disable date after today
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            } 
                
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("birthdate").setAttribute("max", today);

            // function For adding new input field
            function add(){
                var new_chq_no = parseInt($('#total_chq').val())+1;
                var new_input="<input type='text' id='new_"+new_chq_no+"' name='others[]'>";
                $('#new_chq').append(new_input);
                $('#total_chq').val(new_chq_no)
            }

            function remove(){
                var last_chq_no = $('#total_chq').val();
                if(last_chq_no>1){
                    $('#new_'+last_chq_no).remove();
                    $('#total_chq').val(last_chq_no-1);
                }
            }

            function validateForm() {
                // Get all checkboxes by their name attribute
                var checkboxes = document.getElementsByName('checkbox-group');

                // Check if at least one checkbox is checked
                var isChecked = false;
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        isChecked = true;
                        break;
                    }
                }

                // Display an alert if no checkbox is checked
                if (!isChecked) {
                    alert("Please select at least one checkbox.");
                    return false; // Prevent form submission
                }

                return true; // Allow form submission
            }
      </script>
   </head>


    
    <script src="https://unpkg.com/swup@4"></script>
    <script src="script.js"></script>
</body>
</html>