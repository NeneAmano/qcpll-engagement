<?php
require_once('../core/init.php');
ob_start();
if (($user_role_id_session !== 1)) {
    header('location: login.php?error=accessdenied');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../public/assets/images/qcplLogo.png" type="image/x-icon">
    <title>Feedback</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        /* start design for filter by year */

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1;
        }

        .row {
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            padding: 4px;
        }

        .dropdown-content a {
            color: black;
            padding: 8px 7px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
    <?php
    require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of add service modal button -->
        <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="feedback.php?filter=today" class="text-decoration-none text-light">Today</a></button>


        <!-- filter by month -->
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Month</button>
            <div class="dropdown-content">
                <?php
                    for ($month = 1; $month <= 12; $month++) {
                        $month_name = date("F", mktime(0, 0, 0, $month, 1));
                        echo '<a href="feedback.php?filter=' . $month . '">' . $month_name . '</a>';
                    }
                ?>
            </div>
        </div>

        <!-- filter by year -->
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Year</button>
            <div class="dropdown-content">
                <?php
                    $sql_year = "SELECT DISTINCT YEAR(`created_at`) AS year FROM `client` ORDER BY year ASC";
                    $result_year = mysqli_query($conn, $sql_year);

                    while ($row_year = mysqli_fetch_assoc($result_year)) {
                        $year = $row_year['year'];
                        echo '<a href="feedback.php?filter=' . $year . '" class="text-decoration-none text-dark">' . $year . '</a>';
                    }
                ?>
            </div>
        </div>

        <!-- end of add service modal button -->
        <!-- start of first row -->
        <div class="row">
            <!-- start of second container -->
            <div class="container">
                <!-- start of second row -->
                <div class="row">
                    <!-- start of div on center -->
                    <div class="col-md-12">
                        <!-- start of table -->
                        <table class="table table-bordered table-striped" id="datatable">
                            <!-- start of table header -->
                            <thead>
                                <tr>
                                    <th class="table-light text-uppercase text-center">feedback id</th>
                                    <th class="table-light text-uppercase text-center">client id</th>
                                    <th class="table-light text-uppercase text-center">date added</th>
                                    <th class="table-light text-uppercase text-center">last updated</th>
                                    <th class="table-light text-uppercase text-center">action</th>
                                </tr>
                            </thead>
                            <!-- end of table header -->
                            <!-- start of table body -->
                            <tbody>
                                <?php
                                if (isset($_GET['filter'])) {
                                    $filter = $_GET['filter'];
                                        switch ($filter) {
                                            case 'today':
                                                $sql_select = "SELECT MIN(feedback_id) AS feedback_id, client_id, created_at, updated_at FROM feedback WHERE DATE(created_at) = CURDATE() GROUP BY client_id;";
                                                break;
                                            case '1':
                                            case '2':
                                            case '3':
                                            case '4':
                                            case '5':
                                            case '6':
                                            case '7':
                                            case '8':
                                            case '9':
                                            case '10':
                                            case '11':
                                            case '12':
                                                $sql_select = "SELECT MIN(feedback_id) AS feedback_id, client_id, created_at, updated_at FROM feedback WHERE MONTH(created_at) = $filter GROUP BY client_id;";
                                                break;
                                            case $filter:
                                                $sql_select = "SELECT MIN(feedback_id) AS feedback_id, client_id, created_at, updated_at FROM feedback WHERE YEAR(created_at) = $filter GROUP BY client_id;";
                                                break;
                                        }
                                } else {
                                    $sql_select = "SELECT MIN(feedback_id) AS feedback_id, client_id, created_at, updated_at FROM feedback GROUP BY client_id;";
                                }
                                $result_select = mysqli_query($conn, $sql_select);
                                if (mysqli_num_rows($result_select) > 0) {
                                    while ($row_select = mysqli_fetch_assoc($result_select)) {
                                        $feedback_id = $row_select['feedback_id'];
                                        $client_id = $row_select['client_id'];
                                        $created_at = $row_select['created_at'];
                                        $updated_at = $row_select['updated_at'];
                                ?>
                                        <tr>
                                            <td class="text-center"><?= $feedback_id ?></td>
                                            <td class="text-center"><?= $client_id ?></td>
                                            <td class="text-center"><?= $created_at ?></td>
                                            <td class="text-center"><?= $updated_at ?></td>
                                            <td class="text-center"><?= $updated_at ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="5" class="text-center">No records found.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <!-- end of table body -->
                        </table>

                        <!-- end of table -->
                    </div>
                    <!-- end of div on center -->
                </div>
                <!-- end of second row -->
            </div>
            <!-- end of second container -->
        </div>
        <!-- end of first row -->
    </div>
    <!-- end of main section container -->
    </div>
    <!-- end of main container -->
    <?php
    require_once 'js/scripts.php';
    ?>
    <!-- <script src="js/question-scripts.js"></script> -->
    </body>

</html>