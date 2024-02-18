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
    </style>
</head>

<body>
    <section>
        <!--for demo wrap-->
        <h1>Clients LogBook</h1>
        <div class="tbl-header">
            <table cellpadding="1" cellspacing="1" border="0">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Transaction</th>
                        <th>Time-In</th>
                        <th>Time-Out</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="1" cellspacing="1" border="0">
                <tbody>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>Test Test</td>
                        <td>21</td>
                        <td>Male</td>
                        <td>NBI,POLICE CLEARANCE</td>
                        <td>2024-02-08 09:26:03</td>
                        <td>2024-02-08 09:26:03</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>


    <script>
        // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
        $(window).on("load resize ", function() {
            var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
            $('.tbl-header').css({
                'padding-right': scrollWidth
            });
        }).resize();
    </script>
</body>

</html>