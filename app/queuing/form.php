<?php
require_once ('../core/init.php');
if (isset ($_SESSION['user_id'])) {
    if (isset ($_GET['queue_no']) && isset ($_GET['client_id']) && isset ($_GET['birthdate']) && isset ($_GET['service'])) {
        $queue_no = $_GET['queue_no'];
        $client_id = $_GET['client_id'];
        $birthdate = $_GET['birthdate'];
        $service = $_GET['service'];


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
                

                
                $formatted_date = date("F d, Y", strtotime($birthdate));
                

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
                        <div class="sub-information">
                            <h4>Main Library</h4>
                            <h4 class="ps-4">
                                <?= $created_at ?>
                            </h4>
                            <h4>2 Gov. ID</h4>
                            <div class="mlMargin1">
                                <p>1.___________
                                <p>
                                <p class="mlMargin">2.___________
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6" style="text-align: center;">
                    <div class="header1">

                        <h4 class="text-uppercase"><?= $service ?> FORM - E GOVERNMENT SERVICE</h4>
                        <h4 class="contact-header">CONTACT DETAILS</h4>
                    </div>
                </div>

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

                <!-- NEW MODIFIED CONTENT STARTS HERE -->


                <div class="row">
                    <div class="col">
                        <div class="email-flex">
                            <label>Email Address:</label>
                            <p>______________________________________________________________
                            <p>
                        </div>
                    </div>
                </div>

                <!-- first name and civil status -->
                <div class="upperSectionMargin">
                    <div class="row">
                        <div class="col-6">
                            <label>First Name:</label>
                            <label>
                                <?= $f_name ?>
                            </label>
                        </div>
                        <div class="col-6">
                            <label>Civil Status:</label>
                            <label>
                                <?= $civil_status ?>
                            </label>
                        </div>

                    </div>
                    <!-- middle name and birthdate -->
                    <div class="row">
                        <div class="col-6">
                            <?php if ($gender == "Female" && ($civil_status == "Married" || $civil_status == "Widow")): ?>
                                <div class="middle-name">
                                    <label> Maiden Middle Name:</label>
                                    <p class="middlename-p">__________________________________</p>
                                </div>
                            <?php else: ?>
                                <label>Middle Name:</label>
                                <label>
                                    <?= $m_name ?>
                                </label>
                            <?php endif; ?>
                        </div>

                        <div class="col-6">
                            <label>Birthdate :</label>
                            <label>
                                <?=  $formatted_date ?>
                            </label>
                        </div>

                    </div>
                    <!-- last name and birthplace -->
                    <div class="row">
                        <div class="col-6">
                            <label>
                                <?php if ($gender == "Female" && ($civil_status == "Married" || $civil_status == "Widow")): ?>
                                    Last Name:
                                <?php else: ?>
                                    Last Name:
                                <?php endif; ?>
                            </label>
                            <label>
                                <?php if ($gender == "Female" && ($civil_status == "Married" || $civil_status == "Widow")): ?>
                                    <?= $m_name ?>
                                <?php else: ?>
                                    <?= $l_name ?>
                                <?php endif; ?>
                            </label>
                        </div>



                        <div class="col-6">
                            <div class="fill-0001">
                                <label>Birth Place:</label>
                                <p>_________________________________________________
                            </div>
                        </div>
                    </div>
                    <!-- suffix -->
                    <div class="row">
                        <div class="col-6">
                            <div class="test-suffix">
                                <label>
                                    <?php if ($gender == "Female" && ($civil_status == "Married" || $civil_status == "Widow")): ?>
                                        Husband's Surname:
                                    <?php else: ?>
                                        Suffix:
                                    <?php endif; ?>
                                </label>
                                <label>
                                    <?php if ($gender == "Female" && ($civil_status == "Married" || $civil_status == "Widow")): ?>
                                        <?= $l_name ?>
                                    <?php else: ?>
                                        <?= $suffix ?>
                                    <?php endif; ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="fill-0002">
                                <label>Citizenship:</label>
                                <p>_________________________________________________
                                <p>
                            </div>
                            <!-- <div class="fill-0003">
                                <label>Spouse Name:</label>
                                <p>______________________________________________________________
                                <p>
                            </div> -->
                        </div>
                    </div>
                </div>


                <!-- CONTACT DETAILS -->
                <div class="row">
                    <div class="col-8">
                        <div class="contact-1">
                            <label>Address:</label>
                            <p>________________________________________________________________________________
                                    </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="contact-2">
                            <label>Mobile:</label>
                            <p>______________________________________________
                                    </p>
                        </div>
                    </div>
                </div>


                <!-- FAMILY BACKGROUND -->

                <div class="row">
                    <div class="col-8">
                        <h4 class="lower-header">FAMILY BACKGROUND</h4>
                    </div>
                    <div class="col-4">
                        <h4 class="lower-header">EDUCATIONAL BACKGROUND</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="fill-area-fam">
                            <div class="fill-1">
                                <label>Spouse Name:</label>
                                <p>_______________________________________________________________________________
                                <p>
                            </div>
                            <div class="fill-2">
                                <label>Spouse Birthplace:</label>
                                <p>_______________________________________________________________________________
                                <p>
                            </div>
                            <div class="fill-3">
                                <label>Father Name:</label>
                                <p>_______________________________________________________________________________
                                <p>
                            </div>
                            <div class="fill-4">
                                <label>Father Birth Place:</label>
                                <p>_______________________________________________________________________________
                                <p>
                            </div>
                            <div class="fill-5">
                                <label>Mother Name:</label>
                                <p>_______________________________________________________________________________
                                <p>
                            </div>
                            <div class="fill-6">
                                <label>Mother Birth Place:</label>
                                <p>_______________________________________________________________________________
                                <p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="fill-area-educ">
                            <form>
                                <label for="educ" class="form-label">Educational Attainment:</label>
                                <input type="text" class="form-control" id="educ" value="<?= $education ?>">
                            </form>

                            <div class="fill-01">
                                <label>Occupation:</label>
                                <p>______________________________________________________________
                                <p>
                            </div>
                            <div class="fill-02">
                                <label>Religion:</label>
                                <p>______________________________________________________________
                                <p>
                            </div>
                            <div class="fill-03">
                                <div class="item-1">
                                    <label>Height:</label>
                                    <p>_____________________
                                    </p>
                                </div>
                                <div class="item-1">
                                    <label class="ps-3">Weight:</label>
                                    <p class="ps-3">_____________________
                                    </p>
                                </div>
                            </div>
                            <div class="fill-04">
                                <label>Complexion:</label>
                                <p>_____________________________________________
                                <p>
                            </div>
                            <div class="fill-05">
                                <label>Blood Type:</label>
                                <p>_____________________________________________
                                <p>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        // window.onload = function () {
        //     window.print();
        // };

        // window.onafterprint = function (e) {
        //     closePrintView();
        // };

        // function closePrintView() {
        //     window.location.href = 'queue.php';
        // }
    </script>
</body>


</html>
