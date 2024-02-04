<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');

    *{
    padding: 0;
    margin: 0;
    font-family: 'Poppins',sans-serif;
    }
    .logo {
    display: flex;
    justify-content:space-evenly;
    }

    .logo-img{
        width: 150px;
        height: 150px;
    }
    
    .logo  p{
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 40px;
    color: #ffffff;
    }
    .main-container{
    display: flex;
    position: relative;
    left: 200px;
    gap: 4em;
    }
    .container {
  width: 100%;
  height: 100vh;
  background: linear-gradient(
    45deg,
    #3498db,
    #2ecc71
  ); /* Gradient background */
  position: relative;
  overflow: hidden;
}

.container::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: linear-gradient(
      90deg,
      rgba(255, 255, 255, 0.1) 1px,
      transparent 1px
    ),
    linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
  background-size: 20px 20px;
  pointer-events: none; /* Allow clicking through the pattern layer */
}
.title{
    font-size: 50px;
    letter-spacing: 45px;
    color: #E1F0DA;
    font-weight: 600;
    font-family: 'Poppins',sans-serif;
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
  box-shadow: 0px 0px 50px 21px rgba(0,0,0,0.1);
  display: flex;
  color: white;
  justify-content: center;
  position: relative;
  flex-direction: column;
  background: linear-gradient(
      90deg,
      rgba(255, 255, 255, 0.1) 1px,
      transparent 1px
    ),
    linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  overflow: hidden;
}

.card:hover {
    box-shadow: 3px 6px 30px 8px rgb(58 58 58 /25%);
}

.queue-number{
  font-size: 50px;
  margin-top: 0px;
  margin-left: 15px;
  font-weight: 600;
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}


.transaction {
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

.card:hover > .user {
  font-size: 45px;
}

</style>
<body>
<div class="container">
    <p class="title">QUEZON CITY PUBLIC LIBRARY</p>
        <div class="main-container" id="main-container">
            <div class="priority-container">
                <h2 style="text-align: center; color:#ffffff; background-color:#3498db;">PRIORITY LANE</h2><br>

                    <div class="card">
                        <p class="queue-number"><span>P-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>P-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>P-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>P-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>P-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
            </div>


            <div class="normal-container">
                <h2 style="text-align: center; color:#ffffff; background-color:cadetblue">NON-PRIORITY LANE</h2><br>
                    <div class="card">
                        <p class="queue-number"><span>N-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>N-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>N-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>N-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>N-0001</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
                    <br>
                    <div class="card">
                        <p class="queue-number"><span>N-0004</span></span></p>
                        <p class="transaction">NBI</p>
                        <p class="transaction">POLICE CLEARANCE</p>
                        <p class="user">📢</p>
                    </div>
            </div>
            
        </div>
        <img src="./assets/images/duck.gif" alt="" class="duck">
</div>
<style>
    .duck{
        position: relative;
        left: 60%;
        bottom: 56%;
        height: 600px;
    }
</style>
    <script>
        setInterval(function() {
            location.reload();
        }, 1000);
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
