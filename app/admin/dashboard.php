<?php
require_once('../core/init.php');
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
    <title>Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');

        :root {
            --color-primary: #6C9BCF;
            --color-danger: #FF0060;
            --color-success: #1B9C85;
            --color-warning: #F7D060;
            --color-white: #fff;
            --color-info-dark: #7d8da1;
            --color-dark: #363949;
            --color-light: rgba(132, 139, 234, 0.18);
            --color-dark-variant: #677483;
            --color-background: #f6f6f9;
            --card-border-radius: 2rem;
            --border-radius-1: 0.4rem;
            --border-radius-2: 1.2rem;
            --card-padding: 1.8rem;
            --padding-1: 1.2rem;
            --box-shadow: 0 2rem 5rem var(--color-light);
        }

        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            padding: 0%;
            margin: 0;

        }
        body{
            background-color: #181a1e;
        }

        /* section {
            position: relative;
            min-height: 100vh;
            background-image:linear-gradient(rgba(18, 54, 39, 0.7),rgba(34, 42, 77, 0.7)),url(../../public/assets/images/bg.png);
            background-repeat: no-repeat;
            background-size: cover;
        } */
        .card {
            margin-top: 2em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: var(--card-padding);
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            transition: all 0.3s ease;
            border: none !important;
            transform: scale(1.1);
            margin-left: 3em;
        }

        #myChart {
            background-color: var(--color-white);
            padding: var(--card-padding);
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            width: 70% !important;
            cursor: pointer;
        }

        .card:hover {
            transform: none;
        }

        .row {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 4em;
            width: 100%;
        }

        .admin-title {
            font-size: 1.3em;
            position: relative;
            top: 2em;
            left: 3em;
            margin-bottom: 2em;
            width: 14% !important;
        }

        .col-md-2 .card {
            height: 170px;
            min-width: 110%;
            padding: 20px;
        }

        .person-icon {
            color: #6C9BCF;
            font-size: 60px;
        }

        .book-icon {
            color: #1B9C85;
            font-size: 60px;
        }

        .case-icon {
            color: olive;
            font-size: 60px;
        }

        .card-text {
            font-size: 30px;
            font-weight: 600;
        }

        .card-title {
            font-size: 15px;
        }
    </style>
    <?php
    require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <section>
        <p class="admin-title">WELCOME, ADMIN</p>
        <!-- start of main row -->
        <div class="row">


            <!-- start of total clients card -->
            <div class="col-md-2">

                <div class="card">
                    <ion-icon name="person-circle" class="person-icon"></ion-icon>
                    <h5 class="card-title">Total Clients</h5>
                    <?php
                    $sql_clients = "SELECT COUNT(client_id) AS total_clients FROM client;";
                    $result_clients = mysqli_query($conn, $sql_clients);
                    if (mysqli_num_rows($result_clients) > 0) {
                        $row_clients = mysqli_fetch_assoc($result_clients);
                        echo '<p class="card-text">' . $row_clients['total_clients'] . '</p>';
                    }
                    ?>
                </div>
            </div>
            <!-- end of total clients card -->

            <!-- start of feedbacks received card -->
            <div class="col-md-2">
                <div class="card">
                    <ion-icon name="book" class="book-icon"></ion-icon>
                    <h5 class="card-title">Feedbacks Received</h5>
                    <p class="card-text">4</p>
                </div>
            </div>
            <!-- end of feedbacks received card -->

            <!-- start of completed transaction card -->
            <div class="col-md-2">
                <div class="card ">
                    <ion-icon name="briefcase" class="case-icon"></ion-icon>
                    <h5 class="card-title">Completed Transaction</h5>
                    <p class="card-text">10</p>
                </div>
            </div>
            <!-- end of completed transaction card -->
        </div>
        <!-- end of main row -->
        <br>
        <br>
        <div class="data-client-analytics">
            <div>
                <canvas id="myChart" width="400" height="100" aria-label="Hello ARIA World" role="img"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    </section>
    <style>
        .history-section{
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
            position: relative;
            bottom: 35em;
            right:6em;
            flex-direction: column;
            font-family:Georgia, 'Times New Roman', Times, serif !important;
        }
        .card-container{
            display: flex;
            justify-content: center;
            left: 3em;
            align-items: center;
            flex-direction: column;
            cursor: pointer;
            background-color: var(--color-white);
            padding: var(--card-padding);
            box-shadow: var(--box-shadow);
            border: none !important;
            transition: all 0.3s ease;
            border-radius: 5px;

        }
        .card-container:hover{
            box-shadow: none;
        }
        .notif-icon{
            position: relative;
            left: 3em;
            font-size: 2em;
            background-color: #1B9C85;
            width: 20px;
            height: 20px;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
        }
        #history-icon{
            position: relative;
            left: 6em;
            top: 0.2em;
            font-size: 1.5em;
        }
    </style>
    <section class="history-section">
  
        <div class="main-container">
            
        <h4><ion-icon name="alert-circle-outline" id="history-icon"></ion-icon>Recent History</h4>
        
            <div class="history-container">
                <div class="card-container">
                <ion-icon name="notifications-circle-outline" class="notif-icon"></ion-icon>
                     Admin change questions
                    <div class="time-date">
                        <p>8:00 am - 9:00pm</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="history-container">
                <div class="card-container">
                <ion-icon name="notifications-circle-outline" class="notif-icon"></ion-icon>
                     Admin change questions
                    <div class="time-date">
                        <p>8:00 am - 9:00pm</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="history-container">
                <div class="card-container">
                <ion-icon name="notifications-circle-outline" class="notif-icon"></ion-icon>
                     Admin change questions
                    <div class="time-date">
                        <p>8:00 am - 9:00pm</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['January', 'Febraury', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        datasets: [{
                            label: 'Client Per Month',
                            data: [12, 19, 3, 5, 2, 3, 6, 8, 4, 2, 7, 8],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <?php
    require_once 'js/scripts.php';
    ?>

    </body>

</html>