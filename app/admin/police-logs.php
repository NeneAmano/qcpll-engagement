<?php
require_once('../core/init.php');
ob_start();
if (($user_role_id_session !== 1) && ($user_role_id_session !== 2)) {
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Logs</title>
    <?php
    require_once 'includes/sidebar.php';
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            font-size: 30px;
            text-transform: uppercase;
            font-weight: 300;
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            table-layout: fixed;

        }

        section {
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            height: 30em;
            padding: 30px;
        }

        .tbl-header {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .tbl-content {
            height: 300px;
            overflow-x: auto;
            margin-top: 0px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 20px;
            text-transform: uppercase;
        }

        td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 16px;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }

        section {
            margin: 50px;
        }



        /* for custom scrollbar for webkit browser*/

        ::-webkit-scrollbar {
            width: 1px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

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
    </style>
</head>

<body>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of card -->
        <div class="card">
            <!-- start of card header -->
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link text-dark" id="nbi-logs" href="nbi-logs.php">NBI Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" id="police-logs" href="police-logs.php">Police Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" id="others-logs" href="others-logs.php">Others Logs</a>
                    </li>
                </ul>
            </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="police" role="tabpanel" aria-labelledby="police-tab">

                        <!-- filter by today -->
                        <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="police-logs.php?filter=today" class="text-decoration-none text-light">Today</a></button>

                        <!-- filter by 7 days -->
                        <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="police-logs.php?filter=7days" class="text-decoration-none text-light">Past 7 Days</a></button>

                        <!-- filter by month -->
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Month</button>
                            <div class="dropdown-content">
                                <?php
                                for ($month = 1; $month <= 12; $month++) {
                                    $month_name = date("F", mktime(0, 0, 0, $month, 1));
                                    echo '<a href="police-logs.php?filter=' . $month . '">' . $month_name . '</a>';
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
                                    echo '<a href="police-logs.php?filter=' . $year . '" class="text-decoration-none text-dark">' . $year . '</a>';
                                }
                                ?>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- start -->
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
                                            <th class="table-light text-uppercase text-center">Name</th>
                                            <th class="table-light text-uppercase text-center">Age</th>
                                            <th class="table-light text-uppercase text-center">Gender</th>
                                            <th class="table-light text-uppercase text-center">TimeIn</th>
                                            <th class="table-light text-uppercase text-center">TimeOut</th>
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
                                                    $sql_select = "SELECT DISTINCT CONCAT(client.f_name, ' ' , client.l_name, ' ' ,client.suffix) AS Name, age.age_range AS Age, client.Gender, queue_details.created_at AS TimeIn, feedback.created_at AS TimeOut FROM client INNER JOIN queue_details
                                                                            ON client.client_id = queue_details.client_id INNER JOIN age ON  client.age_id = age.age_id INNER JOIN feedback ON client.client_id = feedback.client_id WHERE queue_details.service = 'Police' AND DATE(client.created_at) = CURDATE() ORDER BY client.client_id DESC;";
                                                    break;
                                                case '7days':
                                                    $sql_select = "SELECT DISTINCT CONCAT(client.f_name, ' ' , client.l_name, ' ' ,client.suffix) AS Name, age.age_range AS Age, client.Gender, queue_details.created_at AS TimeIn, feedback.created_at AS TimeOut FROM client INNER JOIN queue_details
                                                                            ON client.client_id = queue_details.client_id INNER JOIN age ON  client.age_id = age.age_id INNER JOIN feedback ON client.client_id = feedback.client_id WHERE queue_details.service = 'Police' AND client.created_at >= CURRENT_DATE - INTERVAL 7 DAY;";
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
                                                    $sql_select = "SELECT DISTINCT CONCAT(client.f_name, ' ' , client.l_name, ' ' ,client.suffix) AS Name, age.age_range AS Age, client.Gender, queue_details.created_at AS TimeIn, feedback.created_at AS TimeOut FROM client INNER JOIN queue_details
                                                                            ON client.client_id = queue_details.client_id INNER JOIN age ON  client.age_id = age.age_id INNER JOIN feedback ON client.client_id = feedback.client_id WHERE queue_details.service = 'Police' AND MONTH(client.created_at) = $filter ORDER BY client.client_id DESC;";
                                                    break;
                                                case $filter:
                                                    $sql_select = "SELECT DISTINCT CONCAT(client.f_name, ' ' , client.l_name, ' ' ,client.suffix) AS Name, age.age_range AS Age, client.Gender, queue_details.created_at AS TimeIn, feedback.created_at AS TimeOut FROM client INNER JOIN queue_details
                                                                            ON client.client_id = queue_details.client_id INNER JOIN age ON  client.age_id = age.age_id INNER JOIN feedback ON client.client_id = feedback.client_id WHERE queue_details.service = 'Police' AND YEAR(client.created_at) = $filter ORDER BY client.client_id DESC;";
                                                    break;
                                            }
                                        } else {
                                            $sql_select = "SELECT DISTINCT CONCAT(client.f_name, ' ' , client.l_name, ' ' ,client.suffix) AS Name, age.age_range AS Age, client.Gender, queue_details.created_at AS TimeIn, feedback.created_at AS TimeOut FROM client INNER JOIN queue_details
                                                                ON client.client_id = queue_details.client_id INNER JOIN age ON  client.age_id = age.age_id INNER JOIN feedback ON client.client_id = feedback.client_id WHERE queue_details.service = 'Police' AND DATE(client.created_at) = CURDATE() ORDER BY client.client_id DESC;";
                                        }
                                        $result_select = mysqli_query($conn, $sql_select);
                                        if (mysqli_num_rows($result_select) > 0) {
                                            while ($row_select = mysqli_fetch_assoc($result_select)) {
                                                $Name = $row_select['Name'];
                                                $Age = $row_select['Age'];
                                                $Gender = $row_select['Gender'];
                                                $TimeIn = $row_select['TimeIn'];
                                                $TimeOut = $row_select['TimeOut'];
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?= $Name ?></td>
                                                    <td class="text-center"><?= $Age ?></td>
                                                    <td class="text-center"><?= $Gender ?></td>
                                                    <td class="text-center"><?= $TimeIn ?></td>
                                                    <td class="text-center"><?= $TimeOut ?></td>
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
        </div>
    </div>
    <?php
    require_once 'js/scripts.php';
    ?>
    <script src="js/logs-scripts.js"></script>
</body>
</html>