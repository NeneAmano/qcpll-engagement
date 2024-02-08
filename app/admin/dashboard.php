<?php
    require_once('../core/init.php');
    if(($user_role_id_session !== 1)) {
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
            --color-light: rgba(132, 139, 200, 0.18);
            --color-dark-variant: #677483;
            --color-background: #f6f6f9;
            --card-border-radius: 2rem;
            --border-radius-1: 0.4rem;
            --border-radius-2: 1.2rem;
            --card-padding: 1.8rem;
            --padding-1: 1.2rem;
            --box-shadow: 0 2rem 3rem var(--color-light);
        }
        *{
            font-family: 'Poppins',sans-serif;
            box-sizing: border-box;
            padding: 0%;
            margin: 0;
        }
        section {
            position: relative;
            min-height: 100vh;
            background-image:linear-gradient(rgba(18, 54, 39, 0.7),rgba(34, 42, 77, 0.7)),url(../../public/assets/images/bg.png);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .card{
            margin-top: 30px;
            cursor: pointer;
            background-color: var(--color-white);
            padding: var(--card-padding);
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            transition: all 0.3s ease;
            border: none;
        }
        .card:hover{
            transform: scale(1.1);
        }
        .row{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2em;
            width: 100%;
        }
        
        .col-md-2 .card{
            height: 170px;
            min-width: 110%;
            padding: 20px;
        }
       .person-icon{
            color: #6C9BCF;
            font-size: 60px;
       }
       .book-icon{
            color: #1B9C85;
            font-size: 60px;
       }
       .case-icon{
            color: olive;
            font-size: 60px;
       }
       .card-text{
            font-size: 30px;
            font-weight: 600;
       }
       .card-title{
            font-size: 15px;
       }
    </style>
    <?php
        require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <section>
        <!-- start of main row -->
        <div class="row">

            <!-- start of total clients card -->
            <div class="col-md-2">
                <div class="card" >
                            <ion-icon name="person-circle" class="person-icon"></ion-icon>
                            <h5 class="card-title">Total Clients</h5>
                        <?php
                            $sql_clients = "SELECT COUNT(client_id) AS total_clients FROM client;";
                            $result_clients = mysqli_query($conn, $sql_clients);
                            if(mysqli_num_rows($result_clients) > 0){
                                $row_clients = mysqli_fetch_assoc($result_clients);
                                echo '<p class="card-text">' .$row_clients['total_clients']. '</p>';
                            }
                        ?>
                </div>
            </div>
            <!-- end of total clients card -->

            <!-- start of feedbacks received card -->
            <div class="col-md-2">
                <div class="card" >
                        <ion-icon name="book" class="book-icon"></ion-icon>
                        <h5 class="card-title">Feedbacks Received</h5>
                        <p class="card-text">4</p>
                </div>
            </div>
            <!-- end of feedbacks received card -->

            <!-- start of completed transaction card -->
            <div class="col-md-2">
                <div class="card " >
                        <ion-icon name="briefcase" class="case-icon"></ion-icon>
                        <h5 class="card-title">Completed Transaction</h5>
                        <p class="card-text">10</p>
                </div>
            </div>
            <!-- end of completed transaction card -->
        </div>
        <!-- end of main row -->
    </div>
    <!-- end of main section container -->

    </section>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<?php
    require_once 'js/scripts.php';
?>

</body>
</html>