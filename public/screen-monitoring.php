<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QUEUING DISPLAY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins:wght@100;200;300;400;500;700;800;900&family=Roboto:wght@300&family=Teko:wght@300;400&display=swap" rel="stylesheet">
    <style type="text/css">
        body {
            background-color:#fff;
            padding: 2px;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            width: 40%;
            height: 670px;
            border: none    ;
            text-align: center;
            display: flex;
            flex-direction: column;
        }
.serve-container{
    max-width: 700px;
    max-height: 800px;


}
        .serving {
        flex: 1;
        text-align: center;
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .serving h1{
    	margin-top: 0%;
        font-size: 35px;
        position: relative;
    }

    .serving .queueNum {
        margin: 5px 0;
        padding: 10px;
        border-radius: 8px;
        color: #fff;
        width: 10%;
        font-size: 30px;
        justify-content: space-between;
        align-items: center;
        border-radius: 25% 10%;
        border: 3px solid rgb(0, 203, 169);
        border-left: 10px solid rgb(0, 203, 169);
    }

        .onqueue {
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .onqueue h1 {
            margin-top: 0%;
            font-size: 35px;
            position: relative;
        }

        .queue-list {
            flex: 0.5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }

         .line {
            width: 3px;
            height: 90%;
            background-color: black;
            margin: 0 10px;
        }

        .prior {
            flex: 0.5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }

        .queue-item {
            margin: 5px 0;
            padding: 10px;
            border-radius: 8px;
            background-color: #fff;
            color: #333;
            width: 80%;
            font-size: 30px;
            justify-content: space-between;
            align-items: center;
        border-radius: 25% 10%;
        border: 3px solid rgb(0, 203, 169);
        border-left: 40px solid rgb(0, 203, 169);
        }

        .prior-item {
            margin: 5px 0;
            padding: 10px;
            border-radius: 8px;
            background-color: #fff;
            color: #333;
            width: 80%;
            font-size: 30px;
            justify-content: space-between;
            align-items: center;
                border-radius: 25% 10%;
                border: 3px solid rgb(0, 203, 169);
                border-left: 40px solid rgb(0, 203, 169);  
                border-right: 10px solid #D13A28;  
                    }

        a{
        	display: block;
        	color: #333;
  			text-decoration: none;
  			position: relative;
        }

        video{
            position:   relative        ;
        	float: right;
            right:  4%;
        	margin-top: -670px;
        	width: 900px;
        	height: 665px;

        }

    </style>
</head>
<body>
    <div class="container">

        <div class="onqueue">
            <div class="queue-list">
                <h1 style="text-transform: uppercase;">queueing line</h1>
                <div class="prior-item"><a href=""> P-0001 </a></div>
                <div class="queue-item"><a href=""> N-0002 </a></div>
                <div class="queue-item"><a href=""> N-0003 </a></div>
            </div>
        </div>
    </div>
    <video controls autoplay>
 		 <source src="video/movid.mp4" type="video/mp4">
	</video>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#00cba9" fill-opacity="1" d="M0,96L40,90.7C80,85,160,75,240,96C320,117,400,171,480,160C560,149,640,75,720,74.7C800,75,880,149,960,192C1040,235,1120,245,1200,224C1280,203,1360,149,1400,122.7L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
</body>
</html>
