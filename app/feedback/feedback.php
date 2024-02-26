<?php
require_once('../core/init.php');
if (!isset($_SESSION['user_id'])) {
    header('location: ../../public/index.php');
    die();
}

// Check if client_id is set
$client_id = isset($_POST['id']) ? $_POST['id'] : null;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style>
    .dropdown {
        max-width: 10%;
        position: fixed;
        display: flex;
        justify-content: flex-start;
    }

    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown>.dropdown-toggle:active {
        pointer-events: none;
    }

    .m-b {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #212121;
    }

    .check-icon {
        background-color: #212121;
        padding: 30px;
        height: 200px !important;
        border-radius: 50%;
    }

    .alert {
        display: flex;
        align-items: center;
        margin-top: 2em;
        padding: 0.55rem 0.65rem 0.55rem 0.75rem;
        border-radius: 1rem;
        min-width: 400px;
        justify-content: space-between;
        margin-bottom: 2rem;
        box-shadow:
            0px 3.2px 13.8px rgba(0, 0, 0, 0.02),
            0px 7.6px 33.3px rgba(0, 0, 0, 0.028),
            0px 14.4px 62.6px rgba(0, 0, 0, 0.035),
            0px 25.7px 111.7px rgba(0, 0, 0, 0.042),
            0px 48px 208.9px rgba(0, 0, 0, 0.05),
            0px 115px 500px rgba(0, 0, 0, 0.07)
    }

    .content {
        display: flex;
        align-items: center;
    }

    .icon {
        padding: 0.5rem;
        margin-right: 1rem;
        border-radius: 39% 61% 42% 58% / 50% 51% 49% 50%;
        box-shadow:
            0px 3.2px 13.8px rgba(0, 0, 0, 0.02),
            0px 7.6px 33.3px rgba(0, 0, 0, 0.028),
            0px 14.4px 62.6px rgba(0, 0, 0, 0.035),
            0px 25.7px 111.7px rgba(0, 0, 0, 0.042),
            0px 48px 208.9px rgba(0, 0, 0, 0.05),
            0px 115px 500px rgba(0, 0, 0, 0.07)
    }

    .close {
        background-color: transparent;
        border: none;
        outline: none;
        transition: all 0.2s ease-in-out;
        padding: 0.75rem;
        border-radius: 0.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close:hover {
        background-color: #fff;
    }

    .danger {
        background-color: rgba(236, 77, 43, 0.2);
        border: 2px solid #EF9400;
    }

    .danger .icon {
        background-color: #EC4D2B;
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

        <!-- Start of feedback form -->
        <form action="" method="post">
            <div class="flex">
                <div class="textBox">
                    <p style="font-size: 1.5em; font-weight:500; text-transform:capitalize;">Please enter your queue number</p>
                    <p style="font-size: 1em; font-style:italic;">Mangyaring ilagay sa ibaba inyong queue number</p>
                    <input type="text" name="id" id="" class="inputnum" readonly>
                    <br>
                    <br>
                    <button class="btn btn-success flex" type="submit" name="search">Search my Name</button>
                    <?php
                    if (isset($_POST['search'])) {
                        $id = $_POST['id'];

                        $sql = "SELECT 
                        CONCAT(
                            LEFT(client.f_name, 1), 
                            REPEAT('*', LENGTH(client.f_name) - 1), 
                            ' ', 
                            LEFT(client.l_name, 1), 
                            REPEAT('*', LENGTH(client.l_name) - 1)
                        ) AS masked_name, 
                        queue_details.queue_number, 
                        queue_details.client_id, 
                        queue_details.created_at AS created_at 
                    FROM 
                        client 
                    INNER JOIN 
                        queue_details ON client.client_id = queue_details.client_id 
                    WHERE 
                        queue_number = '$id' 
                        AND DATE(queue_details.created_at) = CURDATE() 
                        AND queue_details.status = 0 AND queue_details.entry_check = 1
                    LIMIT 1;
                    ";
                        $res = mysqli_query($conn, $sql);

                        if ($row = mysqli_fetch_array($res)) {
                            $client_id = $row['client_id'];

                            echo '<script>
                            $(document).ready(function(){
                                swal({
                                    title: "", 
                                    text: "Loading...",
                                    icon: "",
                                    buttons: false,      
                                    closeOnClickOutside: false,
                                    timer: 3000,
                                })
                            });
                        </script>';
                    ?>
                            <p style="font-size: 1.5em;">Client Identifier</p>
                            <p style="font-size: 0.7em; font-style:italic;">Note* This is a type box that will auto-fill when your account exists.</p>

                            <p style="font-size: 0.7em; font-style:italic;">Paalala* Ito ay kusang naglalagay ng pangalan kung kayo ay nakagawa na ng account.</p>
                            <input type="text" name="" id="" disabled class="inputnum" style="padding:0px;" value="<?php echo $row['masked_name'] ?>" />
                            <br>
                            <button type="button" class="btn btn-success feedbackbtn" data-toggle="modal" data-target="#exampleModalCenter">Submit</button>
                        <?php
                        } else {
                        ?>
                            <div class="danger alert">
                                <div class="content">
                                    <div class="icon">
                                        <svg height="50" viewBox="0 0 512 512" width="50" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="#fff" d="M449.07,399.08,278.64,82.58c-12.08-22.44-44.26-22.44-56.35,0L51.87,399.08A32,32,0,0,0,80,446.25H420.89A32,32,0,0,0,449.07,399.08Zm-198.6-1.83a20,20,0,1,1,20-20A20,20,0,0,1,250.47,397.25ZM272.19,196.1l-5.74,122a16,16,0,0,1-32,0l-5.74-121.95v0a21.73,21.73,0,0,1,21.5-22.69h.21a21.74,21.74,0,0,1,21.73,22.7Z" />
                                        </svg>
                                    </div>
                                    <p>Sorry, No Data was found.</p>
                                </div>
                                <button class="close">
                                    <svg height="18px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path fill="#69727D" d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z" />
                                    </svg>
                                </button>
                            </div>
                    <?php
                        }
                    }
                    ?>

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
                    if (isset($_POST['search'])) {
                        $id = $_POST['id'];

                        $sql = "SELECT CONCAT(LEFT(client.f_name, 1), REPEAT('*', LENGTH(client.f_name) - 1), ' ', LEFT(client.l_name, 1), REPEAT('*', LENGTH(client.l_name) - 1)) AS masked_name, queue_details.queue_number FROM client INNER JOIN queue_details ON client.client_id = queue_details.client_id WHERE queue_number = '$id' LIMIT 1";
                        $res = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($res)) {
                    ?>
                            <p style="font-style: italic;">Hi,</p>
                            <p><?php echo $row['masked_name'] ?></p>
                    <?php
                        }
                    } else {
                    }
                    ?>
                    <p>Would you like to submit a feedback?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="feedbackbtn1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter1"><a href="includes/transaction-completed.php?client_id=<?= $client_id ?>" class="text-decoration-none text-light">No</a></button>
                    <button type="button" class="btn btn-success"><a href="feedback-form.php?client_id=<?= $client_id ?>" style="text-decoration:none; color:#fff;">Yes</a></button>
                </div>
            </div>
        </div>
    </div>

    <!--2nd Modal -->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="border-radius: 5px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-b">

                    <p style="text-align: center; font-size:50px;">Thank you</p>
                    <img src="../../public/assets/images/check-icon.gif" alt="" class="check-icon">
                </div>
            </div>
        </div>
    </div>

    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
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


            $('#feedbackbtn1').click(function() {
                // Close the first modal
                $('#exampleModalCenter').modal('hide');

                // Show the second modal after a brief delay
                setTimeout(function() {
                    $('#exampleModalCenter1').modal('show');
                }, 200); // Adjust the delay time as needed

                // Redirect to the feedback-complete.php page after showing the second modal
                setTimeout(function() {
                }, 3000); // Adjust the delay time as needed
            });

            // Handle click event for "Yes" button in the first modal
            $('#yesButton').click(function() {
                // Redirect to the feedback form page
                window.location.href = 'feedback-form.php?client_id=<?= $client_id ?>';
            });
        });
        $(".close").click(function() {
            $(this).parent().fadeOut();
        });
    </script>

</body>

</html>