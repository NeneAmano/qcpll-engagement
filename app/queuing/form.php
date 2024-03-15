<?php
require_once ('../core/init.php');
if (isset ($_SESSION['user_id'])) {
    if (isset ($_GET['queue_no']) && isset ($_GET['client_id']) && isset ($_GET['birthdate']) && isset ($_GET['birthdate'])) {
        $queue_no = $_GET['queue_no'];
        $client_id = $_GET['client_id'];
        $birthdate = $_GET['birthdate'];

        $sql = "SELECT * FROM client WHERE client_id = $client_id;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $civil_status = $row['civil_status'];
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

                $maiden_middle_name = ""; // Initialize maiden middle name variable
                $maiden_last_name = ""; // Initialize maiden last name variable

                if ($gender == "female") {
                    // Remove the suffix input box
                    $suffix = "";
                }

                if ($civil_status == "married" || $civil_status == "widow") {
                    // Change middle name input to maiden middle name
                    $m_name = $row['maiden_middle_name'];
                    // Add maiden last name input
                    $maiden_last_name = $row['maiden_last_name'];
                }

                if ($status == 0) {
                    $new_status = 'Normal';
                } elseif ($status == 1) {
                    $new_status = 'Senior';
                } elseif ($status == 2) {
                    $new_status = 'PWD';
                } elseif ($status == 3) {
                    $new_status = 'Pregnant';
                }
            }
        } else {
            header('location: ../../public/index.php');
            die();
        }
    }
} else {
    header('location: ../../public/index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/assets/css/newForm.css">

</head>

<body>

    <div class="container my-4">
        <div class="formbg">
            <div class="row">
                <div class="col-3" style="text-align: center;">
                    <div class="header">
                        <h4>Queue Number</h4>
                        <div class="card">
                            <h4>
                                <?= $queue_no ?>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-6" style="text-align: center;">
                    <div class="header1">
                        <h4>NBI APPLICATION FORM - E GOVERNMENT SERVICE</h4>
                    </div>
                </div>

                <div class="col-3" style="text-align: center;">
                    <div class="header">
                        <div class="sub-information">
                            <h4>Main Library</h4>
                            <h4 class="ps-4">
                                <?= $created_at ?>
                            </h4>
                            <h4>2 Gov. ID</h4>
                            <p>1.___________
                            <p>
                            <p>2.___________
                            <p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="upperSectionMargin">
                <div class="row">
                    <div class="col-3">
                        <form>
                            <label class="form-label" for="first-name">First Name:</label>
                            <input type="text" class="form-control custom-input" id="first-name" placeholder=""
                                value="<?= $f_name ?>">
                        </form>
                    </div>
                    <?php if ($gender == "Male"): ?>
                        <div class="col-2">
                            <form>
                                <label class="form-label" for="middle-name">Middle Name:</label>
                                <input type="text" class="form-control custom-input" id="middle-name" placeholder=""
                                    value="<?= $m_name ?>">
                            </form>
                        </div>
                    <?php elseif ($civil_status == "Married" || $civil_status == "Widow"): ?>
                        <div class="col-2">
                            <div class="maidenMiddleName">

                                <label class="smol">Maiden Middle Name:</label>
                                <p class="pMargin">___________________
                                </p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-2">
                            <form>
                                <label class="form-label" for="middle-name">Middle Name:</label>
                                <input type="text" class="form-control custom-input" id="middle-name" placeholder=""
                                    value="<?= $m_name ?>">
                            </form>
                        </div>
                    <?php endif; ?>



                    <div class="col-3">
                        <form>
                            <label class="form-label" for="last-name">Last Name:</label>
                            <input type="text" class="form-control" id="last-name" placeholder=""
                                value="<?= $l_name ?>">
                        </form>
                    </div>
                    <div class="col-2">
                        <form>
                            <label class="form-label" for="suffix">Suffix: <span
                                    class="fst-italic">(Jr./Sr./II/III)</span></label>
                            <input type="text" class="form-control" id="suffix" placeholder="" value="<?= $suffix ?>">
                        </form>
                    </div>
                    <div class="col-2">
                        <form>
                            <label for="gender" class="form-label">Gender:</label>
                            <input type="text" class="form-control" id="gender" value="<?= $gender ?>">
                        </form>
                    </div>
                </div>




                <div class="row">
                    <div class="col-3">
                        <form>
                            <label for="educ" class="form-label">Educational Attainment:</label>
                            <input type="text" class="form-control" id="educ" value="<?= $education ?>">
                        </form>
                    </div>
                    <div class="col-3">
                        <form>
                            <label for="status" class="form-label me-2">Status:</label>
                            <input type="text" class="form-control" id="status" value="<?= $new_status ?>">
                        </form>
                    </div>
                    <div class="col-3">
                        <form>
                            <label for="civil-status" class="form-label">Civil Status</label>
                            <input type="text" class="form-control" id="civilstatus" value="<?= $civil_status ?>">
                        </form>
                    </div>
                    <div class="col">
                        <!-- <form>
                                        <label for="gender" class="form-label">Gender:</label>
                                        <input type="text" class="form-control" id="gender" value="<?= $gender ?>">
                                    </form> -->
                    </div>
                </div>
            </div>







            <!-- lower section -->
            <div class="lowerSectionMargin">
                <div class="row">
                    <div class="col-7">
                        <div class="row">
                            <div class="col" style="text-align: center;">
                                <h4>Family Background</h4>
                            </div>

                            <!-- spouse's name and birthplace -->
                            <div class="lowerSectionMargin2">
                                <div class="row">
                                    <div class="col">
                                        <div class="invi">
                                            <label>Spouse's Name:</label>
                                            <p>______________________________________________________________
                                            <p>
                                        </div>
                                        <div class="invi fb-margin">
                                            <label>Birthplace:</label>
                                            <p>______________________________________________________________
                                            <p>
                                        </div>
                                        <div class="visi">
                                            <form>
                                                <label for="spouse" class="form-label">Spouse's Name:</label>
                                                <input type="text" class="form-control" id="spouse">
                                            </form>
                                            <form>
                                                <label for="spouse-birthplace" class="form-label">
                                                    Birthplace:</label>
                                                <input type="text" class="form-control" id="spouse-birthplace">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- father's name and birthplace -->
                                <div class="row">
                                    <div class="col">
                                        <div class="invi fb-margin1">
                                            <label>Father's Name:</label>
                                            <p>______________________________________________________________
                                            <p>
                                        </div>
                                        <div class="invi fb-margin2">
                                            <label>Birthplace:</label>
                                            <p class="yawa">
                                                ______________________________________________________________
                                            <p>
                                        </div>
                                        <div class="visi">
                                            <form>
                                                <label for="fathersName" class="form-label">Father's Name:</label>
                                                <input type="text" class="form-control" id="fathersName">
                                            </form>
                                            <form class="form-pad">
                                                <label for="father-birthplace" class="form-label">Birthplace:</label>
                                                <input type="text" class="form-control" id="father-birthplace">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- mother's name and birthplace -->
                                <div class="row">
                                    <div class="col">
                                        <div class="invi fb-margin3">
                                            <label>Mother's Name:</label>
                                            <p>______________________________________________________________
                                            <p>
                                        </div>
                                        <div class="invi fb-margin4">
                                            <label>Birthplace:</label>
                                            <p>______________________________________________________________
                                            <p>
                                        </div>
                                        <div class="visi">
                                            <form>
                                                <label for="mothersName" class="form-label">Mother's Maiden
                                                    Name:</label>
                                                <input type="text" class="form-control" id="mothersName">
                                            </form>
                                            <form>
                                                <label for="-birthplace" class="form-label">Birthplace:</label>
                                                <input type="text" class="form-control" id="father-birthplace">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="row">
                            <div class="col" style="text-align: center;">
                                <h4>Other Information</h4>
                            </div>

                            <!-- height, weight and blood type -->
                            <div class="lowerSectionMargin2">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="invi">
                                            <label>Height:</label>
                                            <p>___________
                                            <p>
                                        </div>
                                        <div class="visi">
                                            <form>
                                                <label for="height" class="form-label">Height:</label>
                                                <input type="text" class="form-control" id="height">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="invi">
                                            <label>Weight (kg):</label>
                                            <p>___________
                                            <p>
                                        </div>
                                        <div class="visi">
                                            <form>
                                                <label for="weight" class="form-label">Weight (kg):</label>
                                                <input type="text" class="form-control" id="weight">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="invi">
                                            <label>Blood Type:</label>
                                            <p>___________
                                            <p>
                                        </div>
                                        <div class="visi">
                                            <form>
                                                <label for="bloodType" class="form-label">Blood Type:</label>
                                                <input type="text" class="form-control" id="bloodType">
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Occupation, contact number and complete address -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="invi otherInfoMargin">
                                                <label>Occupation:</label>
                                                <p>_________________________________________
                                                <p>
                                            </div>
                                            <div class="visi">
                                                <form>
                                                    <label for="work" class="form-label">Occupation:</label>
                                                    <input type="text" class="form-control" id="work">
                                                </form>
                                            </div>
                                            <div class="invi otherInfoMargin">
                                                <label>Contact Number:</label>
                                                <p>_________________________________________
                                                <p>
                                            </div>
                                            <div class="visi">
                                                <form>
                                                    <label for="work" class="form-label">Contact Number:</label>
                                                    <input type="text" class="form-control" id="work">
                                                </form>
                                            </div>
                                            <div class="invi otherInfoMargin">
                                                <div class="caMargin">
                                                    <label>Complete Address:</label>
                                                    <div class="paraMargin">
                                                        <p>_________________________________________
                                                        <p>
                                                        <p>_________________________________________
                                                        <p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="visi">
                                                <form>
                                                    <label for="work" class="form-label">Complete Address:</label>
                                                    <input type="text" class="form-control" id="work">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>


</html>
