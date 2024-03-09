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
    <title>Analytics</title>
    <?php
    require_once 'includes/sidebar.php';
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }


        .main-content {
            max-width: 80%;
            position: relative;
            left: 4em;
            height: 40%;
            overflow: scroll;
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
        }

        .main-content::-webkit-scrollbar {
            display: none;
        }

        .top-btn {
            position: -webkit-sticky;
            /* Safari */
            position: sticky;
            top: 0;
            background-color: #fff;
            box-shadow: 0 10px 15px -2px rgba(0, 0, 0, 0.1);
            padding: 10px;
            z-index: 3;
        }

        #btn-back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
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
</head>

<body>

    <!-- Main Content -->
    <?php
    require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of add service modal button -->
        <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="analytics.php?filter=today" class="text-decoration-none text-light">Today</a></button>

        <!-- filter by 7 days -->
        <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="analytics.php?filter=7days" class="text-decoration-none text-light">Past 7 Days</a></button>
        <!-- filter by month -->
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Month</button>
            <div class="dropdown-content">
                <?php
                for ($month = 1; $month <= 12; $month++) {
                    $month_name = date("F", mktime(0, 0, 0, $month, 1));
                    echo '<a href="analytics.php?filter=' . $month . '">' . $month_name . '</a>';
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
                    echo '<a href="analytics.php?filter=' . $year . '" class="text-decoration-none text-dark">' . $year . '</a>';
                }
                ?>
            </div>
        </div>
        <style>
            .row {
                box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
                padding: 4px;
            }
        </style>

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
                                    <th class="table-light text-uppercase text-center">Age Range</th>
                                    <th class="table-light text-uppercase text-center">Gender</th>
                                    <th class="table-light text-uppercase text-center">Education</th>
                                    <th class="table-light text-uppercase text-center">Occupation</th>
                                    <th class="table-light text-uppercase text-center">Status</th>
                                    <th class="table-light text-uppercase text-center">Services</th>
                                    <th class="table-light text-uppercase text-center">Count</th>

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
                                            $sql_select = "SELECT 
                                            age.age_range,
                                            client.gender,
                                            client.education,
                                            client.occupation,
                                            client.status,
                                            queue_details.service AS services,
                                            COUNT(*) AS count
                                        FROM 
                                            client
                                        INNER JOIN 
                                            age ON client.age_id = age.age_id 
                                        INNER JOIN 
                                            queue_details ON client.client_id = queue_details.client_id
                                            WHERE 
                                                                                    DATE(client.created_at) = CURDATE()
                                        GROUP BY 
                                            age.age_range, client.gender, client.education, client.occupation, client.status, queue_details.service
                                        ORDER BY
                                            age.age_range, client.gender, client.education, client.occupation, client.status;                                        
                                        ";
                                            break;
                                        case '7days':
                                            $sql_select = "SELECT 
                                            age.age_range,
                                            client.gender,
                                            client.education,
                                            client.occupation,
                                            client.status,
                                            queue_details.service AS services,
                                            COUNT(*) AS count
                                        FROM 
                                            client
                                        INNER JOIN 
                                            age ON client.age_id = age.age_id 
                                        INNER JOIN 
                                            queue_details ON client.client_id = queue_details.client_id
                                            WHERE 
                                               client.created_at >= CURRENT_DATE - INTERVAL 7 DAY 
                                        GROUP BY 
                                            age.age_range, client.gender, client.education, client.occupation, client.status, queue_details.service
                                        ORDER BY
                                            age.age_range, client.gender, client.education, client.occupation, client.status;                                                                                
                                        ";
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
                                            $sql_select = "SELECT 
                                            age.age_range,
                                            client.gender,
                                            client.education,
                                            client.occupation,
                                            client.status,
                                            queue_details.service AS services,
                                            COUNT(*) AS count
                                        FROM 
                                            client
                                        INNER JOIN 
                                            age ON client.age_id = age.age_id 
                                        INNER JOIN 
                                            queue_details ON client.client_id = queue_details.client_id
                                            WHERE 
                                               MONTH(client.created_at) = $filter
                                        GROUP BY 
                                            age.age_range, client.gender, client.education, client.occupation, client.status, queue_details.service
                                        ORDER BY
                                            age.age_range, client.gender, client.education, client.occupation, client.status;                                                                                
                                     ";
                                            break;
                                        case $filter:
                                            $sql_select = "SELECT 
                                            age.age_range,
                                            client.gender,
                                            client.education,
                                            client.occupation,
                                            client.status,
                                            queue_details.service AS services,
                                            COUNT(*) AS count
                                        FROM 
                                            client
                                        INNER JOIN 
                                            age ON client.age_id = age.age_id 
                                        INNER JOIN 
                                            queue_details ON client.client_id = queue_details.client_id
                                            WHERE 
                                               YEAR(client.created_at) = $filter 
                                        GROUP BY 
                                            age.age_range, client.gender, client.education, client.occupation, client.status, queue_details.service
                                        ORDER BY
                                            age.age_range, client.gender, client.education, client.occupation, client.status;                                          
                                        ";
                                            break;
                                    }
                                } else {
                                    $sql_select = "SELECT 
                                    age.age_range,
                                    client.gender,
                                    client.education,
                                    client.occupation,
                                    client.status,
                                    queue_details.service AS services,
                                    COUNT(*) AS count
                                FROM 
                                    client
                                INNER JOIN 
                                    age ON client.age_id = age.age_id 
                                INNER JOIN 
                                    queue_details ON client.client_id = queue_details.client_id
                                GROUP BY 
                                    age.age_range, client.gender, client.education, client.occupation, client.status, queue_details.service
                                ORDER BY
                                    age.age_range, client.gender, client.education, client.occupation, client.status;                                
                                ";
                                }
                                $result_select = mysqli_query($conn, $sql_select);
                                if (mysqli_num_rows($result_select) > 0) {
                                    while ($row_select = mysqli_fetch_assoc($result_select)) {
                                        $age_range = $row_select['age_range'];
                                        $gender = $row_select['gender'];
                                        $education = $row_select['education'];
                                        $occupation = $row_select['occupation'];
                                        $status = $row_select['status'];
                                        $services = $row_select['services'];
                                        $count = $row_select['count'];

                                        if ($status == 0) {
                                            $status_value = "Normal";
                                        } elseif ($status == 1) {
                                            $status_value = "Senior Citizen";
                                        } elseif ($status == 2) {
                                            $status_value = "PWD";
                                        } elseif ($status == 3) {
                                            $status_value = "Pregnant";
                                        }
                                ?>
                                        <tr>

                                            <td class="text-center"><?= $age_range ?></td>
                                            <td class="text-center"><?= $gender ?></td>
                                            <td class="text-center"><?= $education ?></td>
                                            <td class="text-center"><?= $occupation ?></td>
                                            <td class="text-center"><?= $status_value  ?></td>
                                            <td class="text-center"><?= $services  ?></td>
                                            <td class="text-center"><?= $count  ?></td>
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
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>


                                        <td colspan="8" class="text-center">No records found.</td>
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


    <main class="main-content">

        <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>
        <!-- Analyses -->
        <div>






            <?php
            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];

                switch ($filter) {
                    case 'today':
                        $query1 = "SELECT age.age_range AS AGE_RANGE, COUNT(client.client_id) AS client_count
                                            FROM age
                                            INNER JOIN client ON age.age_id = client.age_id
                                            AND DATE(client.created_at) = CURDATE()
                                            GROUP BY age.age_range;
                                            ;";
                        break;
                    case '7days':
                        $query1 = "SELECT age.age_range AS AGE_RANGE, COUNT(client.client_id) AS client_count
                            FROM age
                            INNER JOIN client ON age.age_id = client.age_id
                            AND client.created_at >= CURRENT_DATE - INTERVAL 7 DAY
                            GROUP BY age.age_range;";
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
                        $query1 = "SELECT age.age_range AS AGE_RANGE, COUNT(client.client_id) AS client_count
                                            FROM age
                                            INNER JOIN client ON age.age_id = client.age_id
                                            AND MONTH(client.created_at) = $filter
                                            GROUP BY age.age_range;
                                     ";
                        break;
                    case $filter:
                        $query1 = "SELECT age.age_range AS AGE_RANGE, COUNT(client.client_id) AS client_count
                                            FROM age
                                            INNER JOIN client ON age.age_id = client.age_id
                                            AND YEAR(client.created_at) = $filter
                                            GROUP BY age.age_range;";
                        break;
                }
            } else {
                $query1 = "SELECT age.age_range AS AGE_RANGE, COUNT(client.client_id) AS client_count
                                    FROM age
                                    INNER JOIN client ON age.age_id = client.age_id
                                    GROUP BY age.age_range;";
            }
            $result1 = mysqli_query($conn, $query1);
            $age_range = array();
            $client_count = array();
            foreach ($result1 as $data1) {
                $age_range[] = $data1['AGE_RANGE'];
                $client_count[] = $data1['client_count'];
            }

            ?>

            <!-- start of data analysis of age -->
            <div class="barchart1">
                <canvas id="myChart1"></canvas>
                <p></p>
            </div>

            <script>
                // const labels = Utils.months({count: 7});
                const labels = <?php echo json_encode($age_range); ?>;
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'TOTAL AGE',
                        data: <?php echo json_encode($client_count); ?>,
                        backgroundColor: [
                            '#12372A',
                            '#436850',
                            '#ADBC9F',
                            '#FBFADA',
                            '#12372A',
                            '#436850',
                            '#ADBC9F'
                        ]
                    }]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                const myChart = new Chart(
                    document.getElementById('myChart1'),
                    config
                );


                //Get the button
                let mybutton = document.getElementById("btn-back-to-top");

                // When the user scrolls down 20px from the top of the document, show the button
                window.onscroll = function() {
                    scrollFunction();
                };

                function scrollFunction() {
                    if (
                        document.body.scrollTop > 20 ||
                        document.documentElement.scrollTop > 20
                    ) {
                        mybutton.style.display = "block";
                    } else {
                        mybutton.style.display = "none";
                    }
                }
                // When the user clicks on the button, scroll to the top of the document
                mybutton.addEventListener("click", backToTop);

                function backToTop() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                }
            </script>
            <?php
            // Initialize variables
            $max_index = null;
            $second_max_index = null;
            $third_max_index = null;
            $fourth_max_index = null;

            if (isset($age_range) && isset($client_count)) {


                if (!empty($client_count)) {
                    // Find the index of the maximum client count
                    $max_index = array_search(max($client_count), $client_count);
                    // Display the highest age range and its client count
                    echo "The highest age range is " . $age_range[$max_index] . " with " . $client_count[$max_index] . " clients.<br>";
                }



                // Remove the highest age range and its count to find the second highest
                unset($age_range[$max_index]);
                unset($client_count[$max_index]);

                if (!empty($client_count)) {
                    // Find the index of the new maximum client count (second highest)
                    $second_max_index = array_search(max($client_count), $client_count);
                    // Display the second highest age range and its client count
                    echo "The second highest age range is " . $age_range[$second_max_index] . " with " . $client_count[$second_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($age_range[$second_max_index]);
                unset($client_count[$second_max_index]);

                if (!empty($client_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $third_max_index = array_search(max($client_count), $client_count);
                    // Display the third highest age range and its client count
                    echo "The third highest age range is " . $age_range[$third_max_index] . " with " . $client_count[$third_max_index] . " clients.<br>";
                }


                // Remove the second highest age range and its count to find the third highest
                unset($age_range[$third_max_index]);
                unset($client_count[$third_max_index]);

                if (!empty($client_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $fourth_max_index = array_search(max($client_count), $client_count);
                    // Display the third highest age range and its client count
                    echo "The fourth highest age range is " . $age_range[$fourth_max_index] . " with " . $client_count[$fourth_max_index] . " clients.<br>";
                }


                // Remove the second highest age range and its count to find the third highest
                unset($age_range[$fourth_max_index]);
                unset($client_count[$fourth_max_index]);

                if (!empty($client_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $fifth_max_index = array_search(max($client_count), $client_count);
                    // Display the third highest age range and its client count
                    echo "The fifth highest age range is " . $age_range[$fifth_max_index] . " with " . $client_count[$fifth_max_index] . " clients.<br>";
                }
            } else {
                echo "There are no age ranges to analyze.<br>";
            }
            ?>

            <!-- end of data analysis of age -->








            <?php
            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];

                switch ($filter) {
                    case 'today':
                        $query2 = "SELECT all_genders.gender as genders, COALESCE(COUNT(client.gender), 0) AS gender_count
            FROM (
              SELECT 'Male' AS gender
              UNION
              SELECT 'Female'
              UNION
              SELECT 'Other'
            ) AS all_genders
            LEFT JOIN client ON all_genders.gender = client.gender AND DATE(client.created_at) = CURDATE()
            GROUP BY all_genders.gender
            ;";
                        break;
                    case '7days':
                        $query2 = "SELECT all_genders.gender as genders, COALESCE(COUNT(client.gender), 0) AS gender_count
                            FROM (
                              SELECT 'Male' AS gender
                              UNION
                              SELECT 'Female'
                              UNION
                              SELECT 'Other'
                            ) AS all_genders
                            LEFT JOIN client ON all_genders.gender = client.gender AND client.created_at >= CURRENT_DATE - INTERVAL 7 DAY 
                            GROUP BY all_genders.gender;";
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
                        $query2 = "SELECT all_genders.gender as genders, COALESCE(COUNT(client.gender), 0) AS gender_count
            FROM (
                SELECT 'Male' AS gender
                UNION
                SELECT 'Female'
                UNION
                SELECT 'Other'
            ) AS all_genders
            LEFT JOIN client ON all_genders.gender = client.gender AND MONTH(client.created_at) = $filter
            GROUP BY all_genders.gender;
            
     ";
                        break;
                    case $filter:
                        $query2 = "SELECT all_genders.gender as genders, COALESCE(COUNT(client.gender), 0) AS gender_count
            FROM (
                SELECT 'Male' AS gender
                UNION
                SELECT 'Female'
                UNION
                SELECT 'Other'
            ) AS all_genders
            LEFT JOIN client ON all_genders.gender = client.gender AND YEAR(client.created_at) = $filter
            GROUP BY all_genders.gender;";
                        break;
                }
            } else {
                $query2 = "SELECT all_genders.gender as genders, COALESCE(COUNT(client.gender), 0) AS gender_count
    FROM (
      SELECT 'Male' AS gender
      UNION
      SELECT 'Female'
      UNION
      SELECT 'Other'
    ) AS all_genders
    LEFT JOIN client ON all_genders.gender = client.gender
    GROUP BY all_genders.gender;";
            }

            $result2 = mysqli_query($conn, $query2);

            foreach ($result2 as $data2) {
                $genders[] = $data2['genders'];
                $gender_count[] = $data2['gender_count'];
            }
            ?>

            <!-- start of data analysis of gender -->
            <div class="barchart1">
                <canvas id="myChart2"></canvas>
            </div>

            <script>
                // const labels = Utils.months({count: 7});
                const labels_gender = <?php echo json_encode($genders); ?>;
                const data_gender = {
                    labels: labels_gender,
                    datasets: [{
                        label: 'TOTAL GENDER',
                        data: <?php echo json_encode($gender_count); ?>,
                        backgroundColor: [
                            '#12372A',
                            '#436850',
                            '#ADBC9F',
                            '#FBFADA',
                            '#12372A',
                            '#436850',
                            '#ADBC9F'
                        ]
                    }]
                };

                const config_gender = {
                    type: 'bar',
                    data: data_gender,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                const myChart_gender = new Chart(
                    document.getElementById('myChart2'),
                    config_gender
                );
            </script>
            <?php
            // Initialize variables
            $max_index = null;
            $second_max_index = null;
            $third_max_index = null;

            if (isset($genders) && isset($gender_count)) {


                if (!empty($gender_count)) {
                    // Find the index of the maximum client count
                    $max_index = array_search(max($gender_count), $gender_count);
                    // Display the highest age range and its client count
                    echo "The highest gender count is " . $genders[$max_index] . " with " . $gender_count[$max_index] . " clients.<br>";
                }



                // Remove the highest age range and its count to find the second highest
                unset($genders[$max_index]);
                unset($gender_count[$max_index]);

                if (!empty($gender_count)) {
                    // Find the index of the new maximum client count (second highest)
                    $second_max_index = array_search(max($gender_count), $gender_count);
                    // Display the second highest age range and its client count
                    echo "The second highest gender count is " . $genders[$second_max_index] . " with " . $gender_count[$second_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($genders[$second_max_index]);
                unset($gender_count[$second_max_index]);

                if (!empty($gender_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $third_max_index = array_search(max($gender_count), $gender_count);
                    // Display the third highest age range and its client count
                    echo "The third highest gender count is " . $genders[$third_max_index] . " with " . $gender_count[$third_max_index] . " clients.<br>";
                }
            } else {
                echo "There are no age ranges to analyze.<br>";
            }
            ?>

            <!-- end of data analysis of gender -->






            <?php
            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];

                switch ($filter) {
                    case 'today':
                        $query3 = "SELECT all_education.education as educations, COALESCE(COUNT(client.education), 0) AS education_count
            FROM (
              SELECT 'Elementary Graduate' AS education
              UNION
              SELECT 'High School Level'
              UNION
              SELECT 'High School Graduate'
              UNION
              SELECT 'College Level'
              UNION
              SELECT 'College Graduate'
              UNION
              SELECT 'Master''s Degree' -- Corrected single quote usage
              UNION
              SELECT 'Doctorate Degree'
              UNION
              SELECT 'Vocational'
            ) AS all_education
            LEFT JOIN client ON all_education.education = client.education AND DATE(client.created_at) = CURDATE()
            GROUP BY all_education.education
            ;";
                        break;
                    case '7days':
                        $query3 = "SELECT all_education.education as educations, COALESCE(COUNT(client.education), 0) AS education_count
                            FROM (
                              SELECT 'Elementary Graduate' AS education
                              UNION
                              SELECT 'High School Level'
                              UNION
                              SELECT 'High School Graduate'
                              UNION
                              SELECT 'College Level'
                              UNION
                              SELECT 'College Graduate'
                              UNION
                              SELECT 'Master''s Degree' -- Corrected single quote usage
                              UNION
                              SELECT 'Doctorate Degree'
                              UNION
                              SELECT 'Vocational'
                            ) AS all_education
                            LEFT JOIN client ON all_education.education = client.education AND created_at >= CURRENT_DATE - INTERVAL 7 DAY
                            GROUP BY all_education.education;";
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
                        $query3 = "SELECT all_education.education as educations, COALESCE(COUNT(client.education), 0) AS education_count
            FROM (
              SELECT 'Elementary Graduate' AS education
              UNION
              SELECT 'High School Level'
              UNION
              SELECT 'High School Graduate'
              UNION
              SELECT 'College Level'
              UNION
              SELECT 'College Graduate'
              UNION
              SELECT 'Master''s Degree' -- Corrected single quote usage
              UNION
              SELECT 'Doctorate Degree'
              UNION
              SELECT 'Vocational'
            ) AS all_education
            LEFT JOIN client ON all_education.education = client.education AND MONTH(client.created_at) = $filter
            GROUP BY all_education.education;
            
     ";
                        break;
                    case $filter:
                        $query3 = "SELECT all_education.education as educations, COALESCE(COUNT(client.education), 0) AS education_count
            FROM (
              SELECT 'Elementary Graduate' AS education
              UNION
              SELECT 'High School Level'
              UNION
              SELECT 'High School Graduate'
              UNION
              SELECT 'College Level'
              UNION
              SELECT 'College Graduate'
              UNION
              SELECT 'Master''s Degree' -- Corrected single quote usage
              UNION
              SELECT 'Doctorate Degree'
              UNION
              SELECT 'Vocational'
            ) AS all_education
            LEFT JOIN client ON all_education.education = client.education AND YEAR(client.created_at) = $filter
            GROUP BY all_education.education;";
                        break;
                }
            } else {
                $query3 = "SELECT all_education.education as educations, COALESCE(COUNT(client.education), 0) AS education_count
    FROM (
      SELECT 'Elementary Graduate' AS education
      UNION
      SELECT 'High School Level'
      UNION
      SELECT 'High School Graduate'
      UNION
      SELECT 'College Level'
      UNION
      SELECT 'College Graduate'
      UNION
      SELECT 'Master''s Degree' -- Corrected single quote usage
      UNION
      SELECT 'Doctorate Degree'
      UNION
      SELECT 'Vocational'
    ) AS all_education
    LEFT JOIN client ON all_education.education = client.education
    GROUP BY all_education.education;";
            }
            $result3 = mysqli_query($conn, $query3);
            $education = array();
            $education_count = array();

            foreach ($result3 as $data3) {
                $education[] = $data3['educations'];
                $education_count[] = $data3['education_count'];
            }


            ?>

            <!-- start of data analysis of education -->
            <div class="barchart1">
                <canvas id="myChart3"></canvas>
            </div>

            <script>
                // const labels = Utils.months({count: 7});
                const labels_education = <?php echo json_encode($education); ?>;
                const data_education = {
                    labels: labels_education,
                    datasets: [{
                        label: 'TOTAL EDUCATION ',
                        data: <?php echo json_encode($education_count); ?>,
                        backgroundColor: [
                            '#12372A',
                            '#436850',
                            '#ADBC9F',
                            '#FBFADA',
                            '#12372A',
                            '#436850',
                            '#ADBC9F'
                        ]
                    }]
                };

                const config_education = {
                    type: 'bar',
                    data: data_education,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                const myChart_education = new Chart(
                    document.getElementById('myChart3'),
                    config_education
                );
            </script>
            <?php
            // Initialize variables
            $max_index = null;
            $second_max_index = null;
            $third_max_index = null;
            $fourth_max_index = null;
            $fifth_max_index = null;
            $sixth_max_index = null;
            $second_max_index = null;
            $eight_max_index = null;

            if (isset($education) && isset($education_count)) {


                if (!empty($education_count)) {
                    // Find the index of the maximum client count
                    $max_index = array_search(max($education_count), $education_count);
                    // Display the highest age range and its client count
                    echo "The highest education count is " . $education[$max_index] . " with " . $education_count[$max_index] . " clients.<br>";
                }



                // Remove the highest age range and its count to find the second highest
                unset($education[$max_index]);
                unset($education_count[$max_index]);

                if (!empty($education_count)) {
                    // Find the index of the new maximum client count (second highest)
                    $second_max_index = array_search(max($education_count), $education_count);
                    // Display the second highest age range and its client count
                    echo "The second highest education count is " . $education[$second_max_index] . " with " . $education_count[$second_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($education[$second_max_index]);
                unset($education_count[$second_max_index]);

                if (!empty($education_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $third_max_index = array_search(max($education_count), $education_count);
                    // Display the third highest age range and its client count
                    echo "The third highest education count is " . $education[$third_max_index] . " with " . $education_count[$third_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($education[$third_max_index]);
                unset($education_count[$third_max_index]);

                if (!empty($education_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $fourth_max_index = array_search(max($education_count), $education_count);
                    // Display the third highest age range and its client count
                    echo "The Fourth highest education count is " . $education[$fourth_max_index] . " with " . $education_count[$fourth_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($education[$fourth_max_index]);
                unset($education_count[$fourth_max_index]);

                if (!empty($education_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $fifth_max_index = array_search(max($education_count), $education_count);
                    // Display the third highest age range and its client count
                    echo "The Fifth highest education count is " . $education[$fifth_max_index] . " with " . $education_count[$fifth_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($education[$fifth_max_index]);
                unset($education_count[$fifth_max_index]);

                if (!empty($education_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $sixth_max_index = array_search(max($education_count), $education_count);
                    // Display the third highest age range and its client count
                    echo "The Sixth highest education count is " . $education[$sixth_max_index] . " with " . $education_count[$sixth_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($education[$sixth_max_index]);
                unset($education_count[$sixth_max_index]);

                if (!empty($education_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $seven_max_index = array_search(max($education_count), $education_count);
                    // Display the third highest age range and its client count
                    echo "The Seven highest education count is " . $education[$seven_max_index] . " with " . $education_count[$seven_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($education[$seven_max_index]);
                unset($education_count[$seven_max_index]);

                if (!empty($education_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $eight_max_index = array_search(max($education_count), $education_count);
                    // Display the third highest age range and its client count
                    echo "The Eight highest education count is " . $education[$eight_max_index] . " with " . $education_count[$eight_max_index] . " clients.<br>";
                }
            } else {
                echo "There are no age ranges to analyze.<br>";
            }
            ?>

            <!-- end of data analysis of education -->











            <?php
            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];

                switch ($filter) {
                    case 'today':
                        $query4 = "SELECT all_occupation.occupation as occupations, COALESCE(COUNT(client.occupation), 0) AS occupation_count
            FROM (
              SELECT 'Student' AS occupation
              UNION
              SELECT 'Unemployed'
              UNION
              SELECT 'Employed'
              UNION
              SELECT 'Retired'
            ) AS all_occupation
            LEFT JOIN client ON all_occupation.occupation = client.occupation AND DATE(client.created_at) = CURDATE()
            GROUP BY all_occupation.occupation;";
                        break;
                    case '7days':
                        $query4 = "SELECT all_occupation.occupation as occupations, COALESCE(COUNT(client.occupation), 0) AS occupation_count
                            FROM (
                              SELECT 'Student' AS occupation
                              UNION
                              SELECT 'Unemployed'
                              UNION
                              SELECT 'Employed'
                              UNION
                              SELECT 'Retired'
                            ) AS all_occupation
                            LEFT JOIN client ON all_occupation.occupation = client.occupation AND client.created_at >= CURRENT_DATE - INTERVAL 7 DAY
                            GROUP BY all_occupation.occupation;";
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
                        $query4 = "SELECT all_occupation.occupation as occupations, COALESCE(COUNT(client.occupation), 0) AS occupation_count
            FROM (
              SELECT 'Student' AS occupation
              UNION
              SELECT 'Unemployed'
              UNION
              SELECT 'Employed'
              UNION
              SELECT 'Retired'
            ) AS all_occupation
            LEFT JOIN client ON all_occupation.occupation = client.occupation AND MONTH(client.created_at) = $filter
            GROUP BY all_occupation.occupation;     
     ";
                        break;
                    case $filter:
                        $query4 = "SELECT all_occupation.occupation as occupations, COALESCE(COUNT(client.occupation), 0) AS occupation_count
            FROM (
              SELECT 'Student' AS occupation
              UNION
              SELECT 'Unemployed'
              UNION
              SELECT 'Employed'
              UNION
              SELECT 'Retired'
            ) AS all_occupation
            LEFT JOIN client ON all_occupation.occupation = client.occupation AND YEAR(client.created_at) = $filter
            GROUP BY all_occupation.occupation;";
                        break;
                }
            } else {
                $query4 = "SELECT all_occupation.occupation as occupations, COALESCE(COUNT(client.occupation), 0) AS occupation_count
    FROM (
      SELECT 'Student' AS occupation
      UNION
      SELECT 'Unemployed'
      UNION
      SELECT 'Employed'
      UNION
      SELECT 'Retired'
    ) AS all_occupation
    LEFT JOIN client ON all_occupation.occupation = client.occupation
    GROUP BY all_occupation.occupation;";
            }
            $result4 = mysqli_query($conn, $query4);

            foreach ($result4 as $data4) {
                $occupations[] = $data4['occupations'];
                $occupation_count[] = $data4['occupation_count'];
            }



            ?>
            <!-- start of data analysis of occupation -->
            <div class="barchart1">
                <canvas id="myChart4"></canvas>
            </div>

            <script>
                const labels_occupations = <?php echo json_encode($occupations); ?>;
                const data_occupations = {
                    labels: labels_occupations,
                    datasets: [{
                        label: 'TOTAL OCCUPATION ',
                        data: <?php echo json_encode($occupation_count); ?>,
                        backgroundColor: [
                            '#12372A',
                            '#436850',
                            '#ADBC9F',
                            '#FBFADA',
                            '#12372A',
                            '#436850',
                            '#ADBC9F'
                        ]
                    }]
                };

                const config_occupations = {
                    type: 'bar',
                    data: data_occupations,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                const myChart_occupations = new Chart(
                    document.getElementById('myChart4'),
                    config_occupations
                );
            </script>
            <?php
            // Initialize variables
            $max_index = null;
            $second_max_index = null;
            $third_max_index = null;
            $fourth_max_index = null;
            $fifth_max_index = null;
            $sixth_max_index = null;
            $second_max_index = null;
            $eight_max_index = null;

            if (isset($occupations) && isset($occupation_count)) {


                if (!empty($occupation_count)) {
                    // Find the index of the maximum client count
                    $max_index = array_search(max($occupation_count), $occupation_count);
                    // Display the highest age range and its client count
                    echo "The highest occupation count is " . $occupations[$max_index] . " with " . $occupation_count[$max_index] . " clients.<br>";
                }



                // Remove the highest age range and its count to find the second highest
                unset($occupations[$max_index]);
                unset($occupation_count[$max_index]);

                if (!empty($occupation_count)) {
                    // Find the index of the new maximum client count (second highest)
                    $second_max_index = array_search(max($occupation_count), $occupation_count);
                    // Display the second highest age range and its client count
                    echo "The second highest occupation count is " . $occupations[$second_max_index] . " with " . $occupation_count[$second_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($occupations[$second_max_index]);
                unset($occupation_count[$second_max_index]);

                if (!empty($occupation_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $third_max_index = array_search(max($occupation_count), $occupation_count);
                    // Display the third highest age range and its client count
                    echo "The third highest occupation count is " . $occupations[$third_max_index] . " with " . $occupation_count[$third_max_index] . " clients.<br>";
                }

                // Remove the second highest age range and its count to find the third highest
                unset($occupations[$third_max_index]);
                unset($occupation_count[$third_max_index]);

                if (!empty($occupation_count)) {
                    // Find the index of the new maximum client count (third highest)
                    $fourth_max_index = array_search(max($occupation_count), $occupation_count);
                    // Display the third highest age range and its client count
                    echo "The Fourth highest occupation count is " . $occupations[$fourth_max_index] . " with " . $occupation_count[$fourth_max_index] . " clients.<br>";
                }
            } else {
                echo "There are no age ranges to analyze.<br>";
            }
            ?>
            <!-- end of data analysis of education -->




            <?php
            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];

                switch ($filter) {
                    case 'today':
                        $query5 = "SELECT service, COUNT(service) AS count_service FROM queue_details where DATE(created_at) = CURDATE() GROUP BY service;";
                        break;
                    case '7days':
                        $query5 = "SELECT service, COUNT(service) AS count_service FROM queue_details WHERE created_at >= CURRENT_DATE - INTERVAL 7 DAY GROUP BY service;";
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
                        $query5 = "SELECT service, COUNT(service) AS count_service FROM queue_details where MONTH(created_at) = $filter GROUP BY service;     
     ";
                        break;
                    case $filter:
                        $query5 = "SELECT service, COUNT(service) AS count_service FROM queue_details where YEAR(created_at) = $filter GROUP BY service;";
                        break;
                }
            } else {
                $query5 = "SELECT service, COUNT(service) AS count_service FROM queue_details GROUP BY service;";
            }
            $result5 = mysqli_query($conn, $query5);

            foreach ($result5 as $data5) {
                $service[] = $data5['service'];
                $count_service[] = $data5['count_service'];
            }

            ?>
            <!-- start of data analysis of services -->
            <div class="barchart1">
                <canvas id="myChart5"></canvas>
            </div>

            <script>
                const labels_service = <?php echo json_encode($service); ?>;
                const data_service = {
                    labels: labels_service,
                    datasets: [{
                        label: 'TOTAL SERVICE',
                        data: <?php echo json_encode($count_service); ?>,
                        backgroundColor: [
                            '#12372A',
                            '#436850',
                            '#ADBC9F',
                            '#FBFADA',
                            '#12372A',
                            '#436850',
                            '#ADBC9F'
                        ]
                    }]
                };

                const config_service = {
                    type: 'bar',
                    data: data_service,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                const myChart_service = new Chart(
                    document.getElementById('myChart5'),
                    config_service
                );
            </script>

            <!-- end of data analysis of services -->

    </main>
    <!-- End of Main Content -->
    </main>
</body>
<?php
require_once 'js/scripts.php';
?>
<script src="js/question-scripts.js"></script>
</body>

</html>