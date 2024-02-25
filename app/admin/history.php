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
            <div class="uk-timeline-item">
                <div class="uk-timeline-icon">
                    <span class="uk-badge"><span uk-icon="check"></span></span>
                </div>
                <div class="uk-timeline-content">
                    <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <h3 class="uk-card-title"><time datetime="2020-07-08">July 8</time></h3>
                                <span class="uk-label uk-label-success uk-margin-auto-left">Feature</span>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque mollitia voluptate vitae tempora repellat officiis iure dolorem accusantium sit temporibus?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-timeline-item">
                <div class="uk-timeline-icon">
                    <span class="uk-badge"><span uk-icon="check"></span></span>
                </div>
                <div class="uk-timeline-content">
                    <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <h3 class="uk-card-title"><time datetime="2020-07-07">July 7</time></h3>
                                <span class="uk-label uk-label-warning uk-margin-auto-left">Test</span>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                            <p>admin</p>
                        </div>

                    </div>

                </div>
            </div>
            <div class="uk-timeline-item">
                <div class="uk-timeline-icon">
                    <span class="uk-badge"><span uk-icon="check"></span></span>
                </div>
                <div class="uk-timeline-content">
                    <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <h3 class="uk-card-title"><time datetime="2020-07-06">July 6</time></h3>
                                <span class="uk-label uk-label-danger uk-margin-auto-left">Fix</span>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-timeline-item">
                <div class="uk-timeline-icon">
                    <span class="uk-badge"><span uk-icon="check"></span></span>
                </div>
                <div class="uk-timeline-content">
                    <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <h3 class="uk-card-title"><time datetime="2020-07-06">July 6</time></h3>
                                <span class="uk-label uk-label-danger uk-margin-auto-left">Fix</span>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-timeline-item">
                <div class="uk-timeline-icon">
                    <span class="uk-badge"><span uk-icon="check"></span></span>
                </div>
                <div class="uk-timeline-content">
                    <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <h3 class="uk-card-title"><time datetime="2020-07-06">July 6</time></h3>
                                <span class="uk-label uk-label-danger uk-margin-auto-left">Fix</span>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/js/uikit-icons.min.js"></script>
</body>

</html>