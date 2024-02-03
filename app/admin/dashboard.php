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
    <?php
        require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of main row -->
        <div class="row">
            <!-- filler col -->
            <div class="col-md-2">
            </div>
            <!-- start of total clients card -->
            <div class="col-md-2">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header</div>
                    <div class="card-body">
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
            </div>
            <!-- end of total clients card -->

            <!-- start of feedbacks received card -->
            <div class="col-md-2">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header</div>
                    <div class="card-body">
                        <h5 class="card-title">Feedbacks Received</h5>
                        <p class="card-text">4</p>
                    </div>
                </div>
            </div>
            <!-- end of feedbacks received card -->

            <!-- start of completed transaction card -->
            <div class="col-md-2">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header</div>
                    <div class="card-body">
                        <h5 class="card-title">Completed Transaction</h5>
                        <p class="card-text">10</p>
                    </div>
                </div>
            </div>
            <!-- end of completed transaction card -->

            <!-- filler col -->
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end of main row -->
    </div>
    <!-- end of main section container -->
</div>
<!-- end of main container -->
<?php
    require_once 'js/scripts.php';
?>
</body>
</html>