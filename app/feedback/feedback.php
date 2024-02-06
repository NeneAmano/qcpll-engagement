<?php
    require_once('../core/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quezon City Public Library</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="shortcut icon" href="../../public/assets/images/qcplLogo.png" type="image/x-icon">
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    .dropdown {
        max-width: 10%;
        position: fixed;
        display: flex;
        justify-content: flex-start;
    }

    .dropdown:hover > .dropdown-menu {
        display: block;
    }

    .dropdown > .dropdown-toggle:active {
        pointer-events: none;
    }

    ion-icon {
        color: #ffffff;
        padding: 10px;
        background-color: #13a561;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        transition: 0.2s ease-in-out;
    }
    .logo-facebook:hover{
        color: #1877F2;
    }
    .logo-twitter:hover{
        color: #1D9BF0;
    }
    .logo-instagram:hover{
        color: rgb(225, 48, 108) ;
    }
    .logout-btn{
        display: flex;
        flex-direction: column;
        position: relative;
        gap:0.1px;
        right: 3em;
        bottom: 6em;

    }
    
    ion-icon:hover {
        color: #13a561;
        background-color: #ffffff;
    }

    .container-btn {
        position: fixed;
        top: 2em; /* Adjust the top position for smaller screens */
        right: 1em; /* Adjust the right position for smaller screens */
        z-index: 1000; /* Ensure the button stays on top of other elements */
    }

    @media screen and (min-width: 768px) {
        .container-btn {
            top: 35em; /* Adjust the top position for larger screens */
            right: 3em; /* Adjust the right position for larger screens */
        }
    }
</style>
<body>
<section id="swup" class="transtion-fade">
    
        <div class="logo">
            <img src="../../public/assets/images/qclogo.jpg" alt="">
            <div class="title">
            <p>Quezon City Public Library</p>
            <p>Quezon City Government</p>
            </div>
            <img src="../../public/assets/images/qcplLogo.png" alt="">
        </div>

        <?php  
        if(isset($_SESSION['user_id'])){
            $sql = "SELECT * FROM users WHERE user_id = $user_id_session";
            $res = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($res)){
                echo '<div class="container-btn">';
                echo '<div class="logout-btn">';
                    echo '<a href="../includes/logout.php"><ion-icon name="log-out-outline"></ion-icon></a>';
                    echo '<a href="#"><ion-icon name="logo-facebook" class="logo-facebook"></ion-icon></a>';
                    echo '<a href="#"><ion-icon name="logo-twitter"  class="logo-twitter"></ion-icon></a>';
                    echo '<a href="#"><ion-icon name="logo-instagram" class="logo-instagram"></ion-icon></a>';
                echo '</div>';
            echo '</div>';
            }
            }
        ?>

        <br>
        <br>
        <br>
        <br>
    <!-- Start of feedback form -->
    <form action="" method="post">
        <div class="flex">
            <div class="textBox">
                <p style="font-size: 1.5em;">Please enter your queue number</p>
                <p style="font-size: 1em; font-style:italic;">Mangyaring ilagay sa ibaba inyong queue number</p>
                <input type="text" name="id" id="" class="inputnum">
                <br>
                <br>
                <button class="btn btn-success flex" type="submit" name="search">Search my Name</button>
                <?php
                    if(isset($_POST['search'])){
                        $id = $_POST['id'];

                        $sql = "SELECT CONCAT(LEFT(client.f_name, 1), REPEAT('*', LENGTH(client.f_name) - 1), ' ', LEFT(client.l_name, 1), REPEAT('*', LENGTH(client.l_name) - 1)) AS masked_name, queue_details.queue_number, queue_details.client_id FROM client INNER JOIN queue_details ON client.client_id = queue_details.client_id WHERE queue_number = '$id' LIMIT 1";
                        $res = mysqli_query($conn,$sql);

                        if($row = mysqli_fetch_array($res)){
                            $client_id = $row['client_id']
                            ?>
                <p style="font-size: 1.5em;">Client Identifier</p>
                <p style="font-size: 1em; font-style:italic;">Note* This is a type box that will auto-fill when your account exists.</p>
                
                <p style="font-size: 1em; font-style:italic;">Paalala* Ito ay kusang naglalagay ng pangalan kung kayo ay nakagawa na ng account.</p>
                <input type="text" name="" id="" disabled class="inputnum" style="padding:0px;" value="<?php echo $row['masked_name']?>"/>

                <button type="button" class="btn btn-success feedbackbtn" data-toggle="modal" data-target="#exampleModalCenter">Submit</button>
                    <?php
            }else
            {
                echo '<br><br>';
                echo '<div class="alert alert-danger" role="alert">';
                echo 'No Data was found! Please enter again!';
                echo '</div>';
            }
                    }
                ?>
                <br>
                <br>
                <br>
            </div>
            
            <div class="numPan">
                <div class="nums">
                    <div class="flex r r1">
                        <div><span>1</span></div>
                        <div><span>2</span></div>
                        <div><span>3</span></div>
                    </div>
                    <div class="flex r r2">
                        <div><span>4</span></div>
                        <div><span>5</span></div>
                        <div><span>6</span></div>
                    </div>
                    <div class="flex r r3">
                        <div><span>7</span></div>
                        <div><span>8</span></div>
                        <div><span>9</span></div>
                    </div>
                    <div class="flex r r4">
                        <div><span>-</span></div>
                        <div><span>0</span></div>
                        <div class="del"><span>Del</span></div>
                    </div>
                    <div class="flex r r5">
                        <div><span>N</span></div>
                        <div class=""></div>
                        <div><span>P</span></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php
                if(isset($_POST['search'])){
                    $id = $_POST['id'];

                    $sql = "SELECT CONCAT(LEFT(client.f_name, 1), REPEAT('*', LENGTH(client.f_name) - 1), ' ', LEFT(client.l_name, 1), REPEAT('*', LENGTH(client.l_name) - 1)) AS masked_name, queue_details.queue_number FROM client INNER JOIN queue_details ON client.client_id = queue_details.client_id WHERE queue_number = '$id' LIMIT 1";
                    $res = mysqli_query($conn,$sql);

                    while($row = mysqli_fetch_array($res)){
            ?>
                        <p style="font-style: italic;">Hi,</p>
                        <p><?php echo $row['masked_name']?></p>
                <?php
                    }
                }else{
                    
                }
            ?>
                <p>Would you like to submit a feedback?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><a href="feedback-form.php" style="text-decoration:none; color:#fff;">No</a></button>
                <button type="button" class="btn btn-success"><a href="feedback-form.php?client_id=<?= $client_id ?>" style="text-decoration:none; color:#fff;">Yes</a></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7/dist/jquery.min.js"></script>
<script src="https://unpkg.com/swup@4"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- script for ion icon -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    var btn = document.querySelectorAll(".r > div");
    var inpt = document.querySelector(".inputnum");

    btn.forEach(val => {
        val.addEventListener("click", () => {
            if (val.innerText === "Del") {
                inpt.value = inpt.value.slice(0, -1); // Remove the last character
            } else {
                inpt.value += val.innerText;
            }
        });
    });
</script>

</body>
</html>
