<?php require_once '../app/core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');

    * {
        padding: 0;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .logo {
        display: flex;
        justify-content: space-evenly;
    }

    .logo-img {
        width: 150px;
        height: 150px;
    }

    .logo p {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 40px;
        color: #ffffff;
    }

    .main-container {
        display: flex;
        position: relative;
        left: 200px;
        gap: 4em;
    }

    .container {
        width: 100%;
        height: 100vh;
        background: linear-gradient(45deg,
                #3498db,
                #2ecc71);
        /* Gradient background */
        position: relative;
        overflow: hidden;
    }

    .container::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(90deg,
                rgba(255, 255, 255, 0.1) 1px,
                transparent 1px),
            linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        pointer-events: none;
        /* Allow clicking through the pattern layer */
    }

    .title {
        font-size: 50px;
        letter-spacing: 45px;
        color: #E1F0DA;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    /* card start design */
    /* .priority-container{
    max-height: 80vh;
    overflow: hidden;
}
.normal-container{
    max-height: 100vh;
    overflow: hidden;
} */
    .card {
        width: 410px;
        height: 120px;
        border-radius: 15px;
        box-shadow: 0px 0px 50px 21px rgba(0, 0, 0, 0.1);
        display: flex;
        color: white;
        justify-content: center;
        position: relative;
        flex-direction: column;
        background: linear-gradient(90deg,
                rgba(255, 255, 255, 0.1) 1px,
                transparent 1px),
            linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }

    .card:hover {
        box-shadow: 3px 6px 30px 8px rgb(58 58 58 /25%);
    }

    .queue-number {
        font-size: 50px;
        margin-top: 0px;
        margin-left: 15px;
        font-weight: 600;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }


    .transaction {
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 18px;
        margin-top: 0px;
        margin-left: 15px;
        font-weight: 500;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .user {
        font-size: 40px;
        color: #ffffff;
        position: absolute;
        right: 15px;
        top: 15px;
        transition: all 0.3s ease-in-out;
    }

    .card:hover>.user {
        font-size: 45px;
    }

    .duck {
        position: absolute;
        left: 65%;
        bottom: -5%;
        height: 600px;
    }
    .no-record{
        text-align: center;
        font-size: 20px;
        letter-spacing: 5px;
    }
</style>

<body>
    <div class="container">
        <p class="title">QUEZON CITY PUBLIC LIBRARY</p>
        <div class="main-container" id="main-container">

            <div class="priority-container">
                <h2 style="text-align: center; color:#ffffff; background-color:#3498db;">PRIORITY LANE</h2><br>

                <?php
                        $priorSql = "SELECT 
                        client.`status` AS client_status, 
                        queue_details.queue_number, 
                        GROUP_CONCAT(queue_details.service) AS services, 
                        MAX(queue_details.`status`) AS queue_status 
                        FROM 
                        client 
                        JOIN 
                        queue_details ON client.client_id = queue_details.client_id 
                        WHERE 
                        DATE(queue_details.created_at) = CURDATE() 
                        AND client.`status` IN (1, 2, 3) 
                        AND queue_details.`status` = 0 
                        AND queue_details.`entry_check` = 1
                        GROUP BY 
                        queue_details.queue_number
                        LIMIT 6";

                $result1 = mysqli_query($conn, $priorSql);

                while ($row = mysqli_fetch_assoc($result1)) {
                    $queueNumber = $row['queue_number'];
                    $service = $row['services'];
                    echo '<div class="card">';
                    echo '<p class="queue-number"><span>' . $queueNumber . '</span></span></p>';
                    echo '<p class="transaction">' . $service . '</p>';
                    echo '<p class="user">📢</p>';
                    echo '</div>';
                    echo '<br>';
                }

                if (mysqli_num_rows($result1) == 0) {
                    echo '<div class="card">';
                    echo '<p class="no-record"><span>NO RECORD TODAY</span></span></p>';
                    echo '<p class="no-record">THANK YOU!</p>';
                    echo '<p class="user">📢</p>';
                    echo '</div>';
                }
                ?>
            </div>


            <div class="normal-container">
                <h2 style="text-align: center; color:#ffffff; background-color:cadetblue">NON-PRIORITY LANE</h2><br>

                <?php
                $nonpriorSql = "SELECT client.`status` AS client_status, queue_details.queue_number, GROUP_CONCAT(queue_details.service) AS services, MAX(queue_details.`status`) AS queue_status
                                    FROM client
                                    JOIN queue_details ON client.client_id = queue_details.client_id
                                    WHERE DATE(queue_details.created_at) = CURDATE() AND client.`status` = 0  AND queue_details.`status` = 0 AND queue_details.`entry_check` = 1
                                    GROUP BY queue_details.queue_number LIMIT 6;
                                    ";
                $result2 = mysqli_query($conn, $nonpriorSql);

                while ($row = mysqli_fetch_assoc($result2)) {
                    $queueNumber = $row['queue_number'];
                    $service = $row['services'];
                    echo '<div class="card">';
                    echo '<p class="queue-number"><span>' . $queueNumber . '</span></span></p>';
                    echo '<p class="transaction">' . $service . '</p>';
                    echo '<p class="user">📢</p>';
                    echo '</div>';
                    echo '<br>';
                }

                if (mysqli_num_rows($result2) == 0) {
                    echo '<div class="card">';
                    echo '<p class="no-record"><span>NO RECORD TODAY</span></span></p>';
                    echo '<p class="no-record">THANK YOU!</p>';
                    echo '<p class="user">📢</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <img src="./assets/images/duck.gif" alt="" class="duck">

    <script>
        setInterval(function() {
            location.reload();
        }, 1000);
    </script>


</body>

</html>