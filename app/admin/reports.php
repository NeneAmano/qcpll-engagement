<?php
    require_once('../core/init.php');
    ob_start();
    if(($user_role_id_session !== 1)) {
        header('location: login.php?error=accessdenied');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../public/assets/images/qcplLogo.png" type="image/x-icon">
    <title>Reports</title>
    <?php
        require_once 'includes/sidebar.php';
    ?>
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
            margin: 0%;
        }


        .main-card{
            margin-top: 2em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: var(--card-padding) !important;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            transform: scale(1.1);
            margin-left: 5em;
            margin-top: 5em;
            width: 50em;
            height: 40em;
            display: grid;
        }   
        .bar-graph{
            margin-top: 2em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: var(--card-padding) !important;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            margin-left: 4em;
            margin-top: 5em;
            height: 20em;
            min-width: 50em;
        }
        .main-card h3{
            margin-bottom: 70px;
        }
        .card-1{
            margin-top: 2em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: 20px !important;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            position: relative;
            left: 60em;
            bottom: 69em;
            width: 25em;
            height: 25em;
            display: grid;
        }
        .card-2{
            margin-top: 1em;
            cursor: pointer;
            background-color: var(--color-white);
            padding: 20px !important;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            position: relative;
            left: 60em;
            bottom: 68em;
            width: 25em;
            height: 25em;
            display: grid;
        }
        .card-body{
        display: flex;
        flex-direction: row;
        gap: 4em;
        }
        .card-body span{
            text-align: center;
        }

        .emoji-img{
            width: 45px;
        }
        span p{
            font-size: 0.8em;
            font-style: italic;
            color: #212121;
        }
        .card-title p{
            font-size: 1em;
            font-weight: 500;
        }

        /* Bar Graph Horizontal */
        .bar-graph .feelings {
        -webkit-animation: fade-in-text 2.2s 0.1s forwards;
        -moz-animation: fade-in-text 2.2s 0.1s forwards;
        animation: fade-in-text 2.2s 0.1s forwards;
        opacity: 0;
        }

        .bar-graph-horizontal {
        max-width: 380px;
        }

        .bar-graph-horizontal > div {
        float: left;
        margin-bottom: 8px;
        width: 100%;
        }

        .bar-graph-horizontal .feelings {
        float: left;
        margin-top: 18px;
        width: 50px;
        }

        .bar-graph-horizontal .bar {
        border-radius: 3px;
        height: 55px;
        float: left;
        overflow: hidden;
        position: relative;
        width: 0;
        margin-left:1.6em;
        }

        .bar-graph-one .bar::after {
        -webkit-animation: fade-in-text 2.2s 0.1s forwards;
        -moz-animation: fade-in-text 2.2s 0.1s forwards;
        animation: fade-in-text 2.2s 0.1s forwards;
        color: #fff;
        content: attr(data-percentage);
        font-weight: 700;
        position: absolute;
        right: 16px;
        top: 17px;
        }

        .bar-graph-one .bar-one .bar {
        background-color: #64b2d1;
        -webkit-animation: show-bar-one 1.2s 0.1s forwards;
        -moz-animation: show-bar-one 1.2s 0.1s forwards;
        animation: show-bar-one 1.2s 0.1s forwards;
        }

        .bar-graph-one .bar-two .bar {
        background-color: #5292ac;
        -webkit-animation: show-bar-two 1.2s 0.2s forwards;
        -moz-animation: show-bar-two 1.2s 0.2s forwards;
        animation: show-bar-two 1.2s 0.2s forwards;
        }

        .bar-graph-one .bar-three .bar {
        background-color: #407286;
        -webkit-animation: show-bar-three 1.2s 0.3s forwards;
        -moz-animation: show-bar-three 1.2s 0.3s forwards;
        animation: show-bar-three 1.2s 0.3s forwards;
        }

        .bar-graph-one .bar-four .bar {
        background-color: #2e515f;
        -webkit-animation: show-bar-four 1.2s 0.4s forwards;
        -moz-animation: show-bar-four 1.2s 0.4s forwards;
        animation: show-bar-four 1.2s 0.4s forwards;
        }

        /* Bar Graph Horizontal Animations */
        @-webkit-keyframes show-bar-one {
        0% {
            width: 0;
        }
        100% {
            width: 69.6%;
        }
        }

        @-webkit-keyframes show-bar-two {
        0% {
            width: 0;
        }
        100% {
            width: 71%;
        }
        }

        @-webkit-keyframes show-bar-three {
        0% {
            width: 0;
        }
        100% {
            width: 74.7%;
        }
        }

        @-webkit-keyframes show-bar-four {
        0% {
            width: 0;
        }
        100% {
            width: 76.8%;
        }
        }

        @-webkit-keyframes fade-in-text {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
        }

    </style>
</head>
<body>
<section>
        <div class="col-md-2">
            <div class="main-card">  
            <h3>Emoji-based Feedback Ratings</h3>

                <div class="card-content">
                    <div class="card-title">
                    <p>
                    Overall Experience
                    </p>
                    </div>
                    <div class="card-body">
                        <span>
                        <img src="../../public/assets/images/emojis/SMILING FACE WITH OPEN MOUTH AND SMILING EYES.png" alt="" class="emoji-img">
                        <p>28%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/SMILING FACE WITH SMILING EYES.png" alt="" class="emoji-img">
                        <p>1%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/NEUTRAL FACE.png" alt="" class="emoji-img">
                        <p>11%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/DISAPPOINTED FACE.png" alt="" class="emoji-img">
                        <p>81%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/ANGRY FACE.png" alt="" class="emoji-img">
                        <p>7%</p>
                        </span>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-title">
                    <p>
                    Staff Assistance
                    </p>
                    </div>
                    <div class="card-body">
                        <span>
                        <img src="../../public/assets/images/emojis/SMILING FACE WITH OPEN MOUTH AND SMILING EYES.png" alt="" class="emoji-img">
                        <p>3%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/SMILING FACE WITH SMILING EYES.png" alt="" class="emoji-img">
                        <p>11%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/NEUTRAL FACE.png" alt="" class="emoji-img">
                        <p>56%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/DISAPPOINTED FACE.png" alt="" class="emoji-img">
                        <p>78%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/ANGRY FACE.png" alt="" class="emoji-img">
                        <p>90%</p>
                        </span>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-title">
                    <p>
                    Services Experience
                    </p>
                    </div>
                    <div class="card-body">
                        <span>
                        <img src="../../public/assets/images/emojis/SMILING FACE WITH OPEN MOUTH AND SMILING EYES.png" alt="" class="emoji-img">
                        <p>32%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/SMILING FACE WITH SMILING EYES.png" alt="" class="emoji-img">
                        <p>12%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/NEUTRAL FACE.png" alt="" class="emoji-img">
                        <p>10%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/DISAPPOINTED FACE.png" alt="" class="emoji-img">
                        <p>78%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/ANGRY FACE.png" alt="" class="emoji-img">
                        <p>56%</p>
                        </span>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-title">
                    <p>
                    Ambiance Experience
                    </p>
                    </div>
                    <div class="card-body">
                        <span>
                        <img src="../../public/assets/images/emojis/SMILING FACE WITH OPEN MOUTH AND SMILING EYES.png" alt="" class="emoji-img">
                        <p>15%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/SMILING FACE WITH SMILING EYES.png" alt="" class="emoji-img">
                        <p>14%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/NEUTRAL FACE.png" alt="" class="emoji-img">
                        <p>74%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/DISAPPOINTED FACE.png" alt="" class="emoji-img">
                        <p>13%</p>
                        </span>
                        <span>
                        <img src="../../public/assets/images/emojis/ANGRY FACE.png" alt="" class="emoji-img">
                        <p>87%</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
</section>
    <section class="bar-graph bar-graph-horizontal bar-graph-one">
        <div class="text-based-title">
            <h3>Text-Based Ratings</h3>
        </div>
            <div class="bar-one">
                <span class="feelings">Positive</span> 
                <div class="bar" data-percentage="69.6%"></div>
            </div>
            <div class="bar-two">
                <span class="feelings">Neutral</span>
                <div class="bar" data-percentage="71%"></div>
            </div>
            <div class="bar-three">
                <span class="feelings">Negative</span>
                <div class="bar" data-percentage="74.7%"></div>
            </div>
    </section>
    <section>
    <div class="card-1">
        <div class="card-title">
            <p>Analysis</p>
        </div>

    </div>
    <div class="card-2">
        <div class="card-title">
            <p>Recommendations</p>
        </div>

    </div>
</section>
</body>
</html>