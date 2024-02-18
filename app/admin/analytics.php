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
    <title>Questions</title>
    <?php
    require_once 'includes/sidebar.php';
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .analytics-dashboard {
            max-height: 23%;
            overflow: scroll;
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            margin-top: 20;
        }

        .main-content {
            max-width: 80%;
            position: relative;
            left: 4em;
        }

        .analytics-dashboard::-webkit-scrollbar {
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
    <main class="analytics-dashboard">
        <!-- Main Content -->
        <?php
        require_once 'includes/sidebar.php';
        ?>
        <!-- start of main section container -->
        <div class="container-fluid mt-3 top-btn">
            <!-- start of add service modal button -->
            <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="analytics.php?filter=today" class="text-decoration-none text-light">Today</a></button>


            <!-- filter by month -->
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Year</button>
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
                        echo '<a href="clients.php?filter=' . $year . '" class="text-decoration-none text-dark">' . $year . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <main class="main-content">

            <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
                <i class="fas fa-arrow-up"></i>
            </button>
            <!-- Analyses -->
            <div>

                <!-- start of data analysis of age -->
                <?php
                $query1 = "SELECT age.age_range AS AGE_RANGE, COUNT(client.client_id) AS client_count
                FROM age
                INNER JOIN client ON age.age_id = client.age_id
                GROUP BY age.age_range;
                ";
                $result1 = mysqli_query($conn, $query1);

                foreach ($result1 as $data1) {
                    $age_range[] = $data1['AGE_RANGE'];
                    $client_count[] = $data1['client_count'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart1"></canvas>
                </div>

                <script>
                    // const labels = Utils.months({count: 7});
                    const labels = <?php echo json_encode($age_range); ?>;
                    const data = {
                        labels: labels,
                        datasets: [{
                            label: 'TOTAL AGE COUNT PER MONTH',
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

                <!-- end of data analysis of age -->

                <!-- start of data analysis of gender -->
                <?php
                $query2 = "SELECT all_genders.gender as genders, COALESCE(COUNT(client.gender), 0) AS gender_count
FROM (
  SELECT 'Male' AS gender
  UNION
  SELECT 'Female'
  UNION
  SELECT 'Other'
) AS all_genders
LEFT JOIN client ON all_genders.gender = client.gender
GROUP BY all_genders.gender
";
                $result2 = mysqli_query($conn, $query2);

                foreach ($result2 as $data2) {
                    $genders[] = $data2['genders'];
                    $gender_count[] = $data2['gender_count'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart2"></canvas>
                </div>

                <script>
                    // const labels = Utils.months({count: 7});
                    const labels_gender = <?php echo json_encode($genders); ?>;
                    const data_gender = {
                        labels: labels_gender,
                        datasets: [{
                            label: 'TOTAL GENDER COUNT PER MONTH',
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

                <!-- end of data analysis of gender -->

                <!-- start of data analysis of education -->
                <?php
                $query3 = "SELECT all_education.education as educations, COALESCE(COUNT(client.education), 0) AS education_count
FROM (
  SELECT 'Elementary Graduate' AS education
  UNION
  SELECT 'HighSchool Level'
  UNION
  SELECT 'HighSchool Graduate'
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
GROUP BY all_education.education;

";
                $result3 = mysqli_query($conn, $query3);

                foreach ($result3 as $data3) {
                    $education[] = $data3['educations'];
                    $education_count[] = $data3['education_count'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart3"></canvas>
                </div>

                <script>
                    // const labels = Utils.months({count: 7});
                    const labels_education = <?php echo json_encode($education); ?>;
                    const data_education = {
                        labels: labels_education,
                        datasets: [{
                            label: 'TOTAL EDUCATION COUNT PER MONTH',
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

                <!-- end of data analysis of education -->



                <!-- start of data analysis of occupation -->
                <?php
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
GROUP BY all_occupation.occupation;
";
                $result4 = mysqli_query($conn, $query4);

                foreach ($result4 as $data4) {
                    $occupations[] = $data4['occupations'];
                    $occupation_count[] = $data4['occupation_count'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart4"></canvas>
                </div>

                <script>
                    const labels_occupations = <?php echo json_encode($occupations); ?>;
                    const data_occupations = {
                        labels: labels_occupations,
                        datasets: [{
                            label: 'TOTAL OCCUPATION COUNT PER MONTH',
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

                <!-- end of data analysis of education -->



                <!-- start of data analysis of services -->
                <?php
                $query5 = "SELECT service, COUNT(service) AS count_service FROM queue_details GROUP BY service;
";
                $result5 = mysqli_query($conn, $query5);

                foreach ($result5 as $data5) {
                    $service[] = $data5['service'];
                    $count_service[] = $data5['count_service'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart5"></canvas>
                </div>

                <script>
                    const labels_service = <?php echo json_encode($service); ?>;
                    const data_service = {
                        labels: labels_service,
                        datasets: [{
                            label: 'TOTAL SERVICE COUNT PER MONTH',
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


                <!-- start of data analysis of q1 -->
                <?php
                $query6 = "SELECT
emoji.value,
(SELECT questions.english_question
    FROM questions
    WHERE questions.question_id = 1
    ORDER BY RAND()
    LIMIT 1
) AS english_question,
COALESCE(COUNT(feedback.feedback_id), 0) AS count_feedback
FROM
emoji
LEFT JOIN feedback ON emoji.emoji_id = feedback.emoji_id AND feedback.question_id = 1
GROUP BY
emoji.emoji_id, emoji.value, emoji.image_path;
";

                $result6 = mysqli_query($conn, $query6);

                foreach ($result6 as $data6) {
                    $q1_label = $data6['english_question'];
                    $value[] = $data6['value'];
                    $count_feedback[] = $data6['count_feedback'];
                }
                ?>

                <div class="barchart1">
                    <canvas id="myChart6"></canvas>
                </div>

                <script>
                    const labels_feedback = <?php echo json_encode($value); ?>;
                    const data_feedback = {
                        labels: labels_feedback,
                        datasets: [{
                            label: '<?php echo json_encode($q1_label); ?>',
                            data: <?php echo json_encode($count_feedback); ?>,
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

                    const config_feedback = {
                        type: 'bar',
                        data: data_feedback,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };

                    const myChart_feedback = new Chart(
                        document.getElementById('myChart6'),
                        config_feedback
                    );
                </script>

                <!-- end of data analysis of q1 -->


                <!-- start of data analysis of q2 -->
                <?php
                $query7 = "SELECT
emoji.value,
(SELECT questions.english_question
  FROM questions
  WHERE questions.question_id = 2
  ORDER BY RAND()
  LIMIT 1
) AS english_question,
COALESCE(COUNT(feedback.feedback_id), 0) AS count_feedback
FROM
emoji
LEFT JOIN feedback ON emoji.emoji_id = feedback.emoji_id AND feedback.question_id = 2
GROUP BY
emoji.emoji_id, emoji.value, emoji.image_path;
";
                $result7 = mysqli_query($conn, $query7);

                foreach ($result7 as $data7) {
                    $q2_label = $data7['english_question'];
                    $value1[] = $data7['value'];
                    $count_feedback1[] = $data7['count_feedback'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart7"></canvas>
                </div>

                <script>
                    const labels_feedback2 = <?php echo json_encode($value1); ?>;
                    const data_feedback2 = {
                        labels: labels_feedback2,
                        datasets: [{
                            label: '<?php echo json_encode($q2_label); ?>',
                            data: <?php echo json_encode($count_feedback1); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 2
                        }]
                    };

                    const config_feedback2 = {
                        type: 'bar',
                        data: data_feedback2,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };

                    const myChart_feedback2 = new Chart(
                        document.getElementById('myChart7'),
                        config_feedback2
                    );
                </script>

                <!-- end of data analysis of q2 -->


                <!-- start of data analysis of q3 -->
                <?php
                $query8 = "SELECT
emoji.value,
(SELECT questions.english_question
  FROM questions
  WHERE questions.question_id = 3
  ORDER BY RAND()
  LIMIT 1
) AS english_question,
COALESCE(COUNT(feedback.feedback_id), 0) AS count_feedback
FROM
emoji
LEFT JOIN feedback ON emoji.emoji_id = feedback.emoji_id AND feedback.question_id = 3
GROUP BY
emoji.emoji_id, emoji.value, emoji.image_path;
";
                $result8 = mysqli_query($conn, $query8);

                foreach ($result8 as $data8) {
                    $q3_label = $data8['english_question'];
                    $value2[] = $data8['value'];
                    $count_feedback2[] = $data8['count_feedback'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart8"></canvas>
                </div>

                <script>
                    const labels_feedback3 = <?php echo json_encode($value2); ?>;
                    const data_feedback3 = {
                        labels: labels_feedback3,
                        datasets: [{
                            label: '<?php echo json_encode($q3_label); ?>',
                            data: <?php echo json_encode($count_feedback2); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 2
                        }]
                    };

                    const config_feedback3 = {
                        type: 'bar',
                        data: data_feedback3,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };

                    const myChart_feedback3 = new Chart(
                        document.getElementById('myChart8'),
                        config_feedback3
                    );
                </script>

                <!-- end of data analysis of q3 -->


                <!-- start of data analysis of q4 -->
                <?php
                $query9 = "SELECT
emoji.value,
(SELECT questions.english_question
  FROM questions
  WHERE questions.question_id = 4
  ORDER BY RAND()
  LIMIT 1
) AS english_question,
COALESCE(COUNT(feedback.feedback_id), 0) AS count_feedback
FROM
emoji
LEFT JOIN feedback ON emoji.emoji_id = feedback.emoji_id AND feedback.question_id = 4
GROUP BY
emoji.emoji_id, emoji.value, emoji.image_path;
";
                $result9 = mysqli_query($conn, $query9);

                foreach ($result9 as $data9) {
                    $q4_label = $data9['english_question'];
                    $value3[] = $data9['value'];
                    $count_feedback3[] = $data9['count_feedback'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart9"></canvas>
                </div>

                <script>
                    const labels_feedback4 = <?php echo json_encode($value3); ?>;
                    const data_feedback4 = {
                        labels: labels_feedback4,
                        datasets: [{
                            label: '<?php echo json_encode($q4_label); ?>',
                            data: <?php echo json_encode($count_feedback3); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 2
                        }]
                    };

                    const config_feedback4 = {
                        type: 'bar',
                        data: data_feedback4,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };

                    const myChart_feedback4 = new Chart(
                        document.getElementById('myChart9'),
                        config_feedback4
                    );
                </script>

                <!-- end of data analysis of q4 -->

                <!-- start of data analysis of q5 -->
                <?php
                $query10 = "SELECT
emoji.value,
(SELECT questions.english_question
  FROM questions
  WHERE questions.question_id = 5
  ORDER BY RAND()
  LIMIT 1
) AS english_question,
COALESCE(COUNT(feedback.feedback_id), 0) AS count_feedback
FROM
emoji
LEFT JOIN feedback ON emoji.emoji_id = feedback.emoji_id AND feedback.question_id = 5
GROUP BY
emoji.emoji_id, emoji.value, emoji.image_path;
";
                $result10 = mysqli_query($conn, $query10);

                foreach ($result10 as $data10) {
                    $q5_label = $data10['english_question'];
                    $value4[] = $data10['value'];
                    $count_feedback4[] = $data10['count_feedback'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart10"></canvas>
                </div>

                <script>
                    const labels_feedback5 = <?php echo json_encode($value4); ?>;
                    const data_feedback5 = {
                        labels: labels_feedback5,
                        datasets: [{
                            label: '<?php echo json_encode($q5_label); ?>',
                            data: <?php echo json_encode($count_feedback4); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 2
                        }]
                    };

                    const config_feedback5 = {
                        type: 'bar',
                        data: data_feedback5,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };

                    const myChart_feedback5 = new Chart(
                        document.getElementById('myChart10'),
                        config_feedback5
                    );
                </script>

                <!-- end of data analysis of q5 -->


                <!-- start of data analysis of q6 -->
                <?php
                $query11 = "SELECT
emoji.value,
(SELECT questions.english_question
  FROM questions
  WHERE questions.question_id = 6
  ORDER BY RAND()
  LIMIT 1
) AS english_question,
COALESCE(COUNT(feedback.feedback_id), 0) AS count_feedback
FROM
emoji
LEFT JOIN feedback ON emoji.emoji_id = feedback.emoji_id AND feedback.question_id = 6
GROUP BY
emoji.emoji_id, emoji.value, emoji.image_path;
";
                $result11 = mysqli_query($conn, $query11);

                foreach ($result11 as $data11) {
                    $q6_label = $data11['english_question'];
                    $value5[] = $data11['value'];
                    $count_feedback5[] = $data11['count_feedback'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart11"></canvas>
                </div>

                <script>
                    const labels_feedback6 = <?php echo json_encode($value5); ?>;
                    const data_feedback6 = {
                        labels: labels_feedback6,
                        datasets: [{
                            label: '<?php echo json_encode($q6_label); ?>',
                            data: <?php echo json_encode($count_feedback5); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 2
                        }]
                    };

                    const config_feedback6 = {
                        type: 'bar',
                        data: data_feedback6,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };

                    const myChart_feedback6 = new Chart(
                        document.getElementById('myChart11'),
                        config_feedback6
                    );
                </script>

                <!-- end of data analysis of q6 -->

                <!-- start of data analysis of q7 -->
                <?php
                $query12 = "SELECT
emoji.value,
(SELECT questions.english_question
  FROM questions
  WHERE questions.question_id = 7
  ORDER BY RAND()
  LIMIT 1
) AS english_question,
COALESCE(COUNT(feedback.feedback_id), 0) AS count_feedback
FROM
emoji
LEFT JOIN feedback ON emoji.emoji_id = feedback.emoji_id AND feedback.question_id = 7
GROUP BY
emoji.emoji_id, emoji.value, emoji.image_path;
";
                $result12 = mysqli_query($conn, $query12);

                foreach ($result12 as $data12) {
                    $q7_label = $data12['english_question'];
                    $value6[] = $data12['value'];
                    $count_feedback6[] = $data12['count_feedback'];
                }
                ?>
                <div class="barchart1">
                    <canvas id="myChart12"></canvas>
                </div>

                <script>
                    const labels_feedback7 = <?php echo json_encode($value6); ?>;
                    const data_feedback7 = {
                        labels: labels_feedback7,
                        datasets: [{
                            label: '<?php echo json_encode($q7_label); ?>',
                            data: <?php echo json_encode($count_feedback6); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 2
                        }]
                    };

                    const config_feedback7 = {
                        type: 'bar',
                        data: data_feedback7,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };

                    const myChart_feedback7 = new Chart(
                        document.getElementById('myChart12'),
                        config_feedback7
                    );
                </script>

                <!-- end of data analysis of q7 -->

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