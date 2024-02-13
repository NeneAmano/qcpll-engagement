<?php
    require_once('../core/init.php');
    if(isset($_SESSION['user_id'])){
        if(isset($_GET['queue_no']) && isset($_GET['client_id']) && isset($_GET['birthdate']) && isset($_GET['birthdate'])){
            $queue_no = $_GET['queue_no'];
            $client_id = $_GET['client_id'];
            $birthdate = $_GET['birthdate'];
            $service = $_GET['service'];

            $sql = "SELECT * FROM client WHERE client_id = $client_id;";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $f_name = $row['f_name'];
                    $m_name = $row['m_name'];
                    $l_name = $row['l_name'];
                    $suffix = $row['suffix'];
                    $age_id = $row['age_id'];
                    $gender = $row['gender'];
                    $education = $row['education'];
                    $occupation = $row['occupation'];
                    $status = $row['status'];
                    $created_at = $row['created_at'];

                    if($status == 0){
                        $new_status = 'Normal';
                    }elseif($status == 1){
                        $new_status = 'Senior';
                    }elseif($status == 2){
                        $new_status = 'PWD';
                    }elseif($status == 3){
                        $new_status = 'Pregnant';
                    }
                }
            }else{
                header('location: ../../public/index.php');
                die();
            }
        }
    }else{
        header('location: ../../public/index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBI Clearance</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/assets/css/style-nbi-clearance-form.css">

</head>
<body>
    <!-- nasa media query
input[type="radio"],
input[type="checkbox"]
input[type="text"],
input[type="email"],
input[type="date"],
select -->
    <div class="container my-4">
        <div class="formbg">
            <div class="row">
                <div class="col-12 sm-2 col-print-6" style="text-align: center;">

                    <h1 style="text-transform: uppercase;"><?=$service?> CLEARANCE FORM</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <div class="row">

                        <!-- APPLICATION FORM COLUMN -->
                        <div class="col-5 sm-2" style="">
                            <div class="row">
                                <div class="col" style=" text-align: center;">
                                    <h4>Application Profile</h4>
                                </div>
                            </div>

                            <!-- email address -->
                            <div class="row">
                                <div class="col">
                                    <form>
                                        <label class="form-label" for="email">Email Address:</label>
                                        <input type="email" class="form-control" id="email" placeholder="">
                                    </form>
                                </div>
                            </div>
                            <br>
                            <!-- first name and middle name -->
                            <div class="row">
                                <div class="col-6">
                                    <form>
                                        <label class="form-label" for="first-name">First Name:</label>
                                        <input type="text" class="form-control" id="first-name" placeholder="" value="<?= $f_name ?>">
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form>
                                        <label class="form-label" for="middle-name">Middle Name:</label>
                                        <input type="text" class="form-control" id="middle-name" placeholder="" value="<?= $m_name ?>">
                                    </form>
                                </div>
                            </div>
                            <br>
                            <!-- last name and suffix -->
                            <div class="row">
                                <div class="col-7">
                                    <form>
                                        <label class="form-label" for="last-name">Last Name:</label>
                                        <input type="text" class="form-control" id="last-name" placeholder="" value="<?= $l_name ?>">
                                    </form>
                                </div>
                                <div class="col-5">
                                    <form>
                                        <label class="form-label" for="suffix">Suffix: <span class="fst-italic">(Jr./Sr./II/III)</span></label>
                                        <input type="text" class="form-control" id="suffix" placeholder="" value="<?= $suffix ?>">
                                    </form>
                                </div>
                            </div>

                            <!-- gender options -->
                            <div class="row">
                                <div class="col-6">
                                    <form>
                                        <label for="gender" class="form-label">Gender:</label>
                                        <input type="text" class="form-control" id="gender" value="<?= $gender ?>">
                                    </form>
                                </div>
                                <div class="col-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">Single</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                        <label class="form-check-label" for="inlineCheckbox2">Married</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                        <label class="form-check-label" for="inlineCheckbox3">Widow</label>
                                    </div>
                                </div>
                            </div>


                            <!-- birthday and birthplace -->
                            <div class="row">
                                <div class="col-5">
                                    <form>
                                        <label for="birthday" class="form-label mt-3">Birthdate:</label>
                                        <input type="date" class="form-control" id="birthday" value="<?= $birthdate ?>">
                                    </form>
                                </div>
                                <div class="col-7">
                                    <form>
                                        <label for="birthplace" class="form-label mt-3">Birth Place:</label>
                                        <input type="text" class="form-control" id="birthplace">
                                    </form>
                                </div>
                            </div>

                            <!-- nationality and contact number -->
                            <div class="row">
                                <div class="col-5">
                                    <form>
                                        <label for="nationality" class="form-label mt-3">Nationality:</label>
                                        <input type="text" class="form-control" id="nationality">
                                    </form>
                                </div>
                                <div class="col-7">
                                    <form>
                                        <label for="contactNumber" class="form-label mt-3">Contact Number:</label>
                                        <input type="text" class="form-control" id="contactNumber" placeholder="">
                                    </form>
                                </div>
                            </div>


                            <!-- complete address -->
                            <div class="row">
                                <div class="col">
                                    <form>
                                        <label for="completeAddress" class="form-label mt-3">Complete Address:</label>
                                        <textarea class="form-control" id="completeAddress" row="3"></textarea>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- OTHER INFORMATION COLUMN -->
                        <div class="col-7">
                            <div class="row">
                                <div class="col" style="text-align: center;">
                                    <h4>Other Information</h4>
                                </div>
                            </div>

                            <!-- status -->
                            <div class="row">
                                <form class="d-flex align-items-center">
                                    <label for="status" class="form-label me-2">Status:</label>
                                    <input type="text" class="form-control" id="status" value="<?= $new_status ?>">
                                </form>
                            </div>

                            <!-- first time job seeker? -->
                            <div class="row">
                                <div class="col-7" style="text-align: center;">
                                    <label>First Time Job Seeker:</label>
                                </div>
                                <div class="col-5" style="text-align: center;">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                        <label class="form-check-label" for="inlineCheckbox2">No</label>
                                    </div>
                                </div>
                            </div>

                            <!-- height and weight -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="invi">
                                        <label>Height</label>
                                        <p>________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="height" class="form-label">Height (cm):</label>
                                            <input type="text" class="form-control" id="height">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="invi">
                                        <label>Weight (kg):</label>
                                        <p>________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="weight" class="form-label">Weight (kg):</label>
                                            <input type="text" class="form-control" id="weight">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- complexion and religion -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="invi subtop">
                                        <label>Complexion:</label>
                                        <p>________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="complexion" class="form-label">Complexion:</label>
                                            <input type="text" class="form-control" id="complexion">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="invi subtop">
                                        <label>Religion:</label>
                                        <p>________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="religion" class="form-label">Religion:</label>
                                            <input type="text" class="form-control" id="religion">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- blood type and educational attainment -->
                            <div class="row">
                                <div class="col-5">
                                    <div class="invi subtop-1">
                                        <label>Blood type:</label>
                                        <p>______________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="bloodType" class="form-label">Blood Type:</label>
                                            <input type="text" class="form-control" id="bloodType">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-7 ">
                                    <div class="subtop-1">
                                        <form>
                                            <label for="educ" class="form-label">Educational Attainment:</label>
                                            <input type="text" class="form-control" id="educ" value="<?= $education ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- work -->
                            <div class="row">
                                <div class="col worksec">
                                    <div class="invi subtop-2">
                                        <label>Work:</label>
                                        <p>____________________________________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="work" class="form-label">Work:</label>
                                            <input type="text" class="form-control" id="work">
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col" style="text-align: center;">
                                    <h4 class="subtop-3">Family Background</h4>
                                </div>
                            </div>

                            <!-- father's name and birthplace -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="invi subtop-4">
                                        <label>Father's Name:</label>
                                        <p>_________________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="fathersName" class="form-label">Father's Name:</label>
                                            <input type="text" class="form-control" id="fathersName">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="invi subtop-4 form-pad">
                                        <label>Birthplace:</label>
                                        <p>____________________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form class="form-pad">
                                            <label for="father-birthplace" class="form-label">Birthplace:</label>
                                            <input type="text" class="form-control" id="father-birthplace">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- mother's name and birthplace -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="invi subtop-5">
                                        <label>Mother's Maiden Name:</label>
                                        <p>_________________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="mothersName" class="form-label">Mother's Maiden Name:</label>
                                            <input type="text" class="form-control" id="mothersName">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="invi subtop-5 form-pad">
                                        <label>Birthplace:</label>
                                        <p>____________________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="father-birthplace" class="form-label">Birthplace:</label>
                                            <input type="text" class="form-control" id="father-birthplace">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- spouse's name and birthplace -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="invi subtop-6">
                                        <label>Spouse's Name:</label>
                                        <p>_________________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form>
                                            <label for="spouse" class="form-label">Spouse's Name:</label>
                                            <input type="text" class="form-control" id="spouse">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="invi subtop-6 form-pad">
                                        <label>Birthplace:</label>
                                        <p>____________________________________
                                        <p>
                                    </div>
                                    <div class="visi">
                                        <form class="form-pad">
                                            <label for="spouse-birthplace" class="form-label">Spouse's Birthplace:</label>
                                            <input type="text" class="form-control" id="spouse-birthplace">
                                        </form>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>

                <!-- QUE NUMBER COLUMN -->
                <div class="col-2" style>
                    <div class="row">
                        <div class="col" style="text-align: center;">
                            <h4>Queue Number</h4>
                            <div class="card">
                                <h4><?= $queue_no ?></h4>
                            </div>
                        </div>
                        <div class="sub-information">
                            <h4>Main Library</h4>
                            <h4 class="ps-4"><?= $created_at ?></h4>
                            <h4>2 Gov. ID</h4>
                            <p>1.___________
                            <p>
                            <p>2.___________
                            <p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .sub-information {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            margin-top: 5px;
        }
    </style>
    <!-- style="text-align: center;" -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
    // window.onload = function() {
    // window.print();
    // };

    // window.onafterprint = function(e) {
    //     closePrintView();
    // };

    // function closePrintView() {
    //     window.location.href = 'queue.php';   
    // }
    </script>
</body>
</html>