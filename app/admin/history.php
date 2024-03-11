<?php
    require_once('../core/init.php');
    ob_start();
    if($user_role_id_session !== 1){
        session_unset();
        session_destroy();
        header("Location: login.php?error=accessdenied");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../public/assets/images/qcplLogo.png" type="image/x-icon">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/css/uikit.min.css" />

    <title>History</title>
    <?php
    require_once 'includes/sidebar.php';
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');

        * {
            padding: 0%;
            margin: 0;
            max-height: 100vh !important;
            font-family: 'Poppins', sans-serif;
        }

        body {

        }

        .uk-timeline .uk-timeline-item .uk-card {
            max-height: 300px;
        }

        .uk-timeline .uk-timeline-item {
            display: flex;
            position: relative;
        }

        .uk-timeline .uk-timeline-item::before {
            background: #dadee4;
            content: "";
            height: 100%;
            left: 19px;
            position: absolute;
            top: 20px;
            width: 2px;
            z-index: -1;
        }

        .uk-timeline .uk-timeline-item .uk-timeline-icon .uk-badge {
            margin-top: 20px;
            width: 40px;
            height: 40px;
        }

        .uk-timeline .uk-timeline-item .uk-timeline-content {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 0 0 0 1rem;
        }

        .uk-container {
            overflow: scroll;
            height: 39em;
        }

        .uk-container::-webkit-scrollbar {
            display: none;
        }
        .uk-card{
            border-right: 8px solid #1B9C85;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="uk-container uk-padding">
        <div class="uk-timeline">
            
            
            <?php
                        $sql = "SELECT users.username, history_logs.content, history_logs._action,history_logs.created_at FROM history_logs JOIN users USING (USER_id);";
                        
                        $res = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $username = $row['username'];
                                $content = $row['content'];
                                $action = $row['_action'];
                                $date = $row['created_at'];
                                
                                $date_string = $date;
                                $timestamp = strtotime($date_string);
                                $formattedDate = date("F j, Y", $timestamp);
                                
                                echo'<div class="uk-timeline-item">';
                                    echo '<div class="uk-timeline-icon">';
                                        echo '<span class="uk-badge"><span uk-icon="check"></span></span>';
                                    echo '</div>';
                                    echo '<div class="uk-timeline-content">';
                                        echo '<div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">';
                                echo '<div class="uk-card-header">';
                                    echo '<div class="uk-grid-small uk-flex-middle" uk-grid>';
                                        echo '<h3 class="uk-card-title"><time datetime="2020-07-08">'.$formattedDate.'</time></h3>';
                                        echo'<span class="uk-label uk-label-success uk-margin-auto-left">'.$username.'</span>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="uk-card-body">';
                                    echo '<p>'.$action.'</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                    ?>
        </div>
    </div>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/js/uikit-icons.min.js"></script>
</body>

</html>