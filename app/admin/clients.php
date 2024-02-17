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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../public/assets/images/qcplLogo.png" type="image/x-icon">
    <title>Clients</title>
    <style>
        /* start design for filter by year */

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 8px 7px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
    </style>
    <?php
        require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of add service modal button -->
        <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="clients.php?filter=today" class="text-decoration-none text-light">Today</a></button>


                        <!-- filter by month -->
        <div class="dropdown">
        <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Year</button>
        <div class="dropdown-content">
        <?php
                for ($month = 1; $month <= 12; $month++) {
                    $month_name = date("F", mktime(0, 0, 0, $month, 1));
                    echo '<a href="clients.php?filter=' .$month. '">' .$month_name. '</a>';
                }
            ?>
        </div>
        </div>

                <!-- filter by year -->
        <div class="dropdown">
        <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Year</button>
        <div class="dropdown-content">
        <?php
                $sql_year = "SELECT DISTINCT YEAR(`created_at`) AS year FROM `client` ORDER BY year ASC";
                $result_year = mysqli_query($conn, $sql_year);

                while ($row_year = mysqli_fetch_assoc($result_year)) {
                    $year = $row_year['year'];
                    echo '<a href="clients.php?filter=' .$year. '" class="text-decoration-none text-dark">' .$year. '</a>';
                }
            ?>
        </div>
        </div>

        
        <!-- end of add service modal button -->
        <!-- start of first row -->
        <div class="row">
            <!-- start of second container -->
            <div class="container">
                <!-- start of second row -->
                <div class="row">
                    <!-- start of div on center -->
                    <div class="col-md-12">
                        <!-- start of table -->
                        <table class="table table-bordered table-striped" id="datatable">
                            <!-- start of table header -->
                            <thead>
                                <tr>
                                    <th class="table-light text-uppercase text-center">client id</th>
                                    <th class="table-light text-uppercase text-center">first name</th>
                                    <th class="table-light text-uppercase text-center">middle name</th>
                                    <th class="table-light text-uppercase text-center">maiden name</th>
                                    <th class="table-light text-uppercase text-center">last name</th>
                                    <th class="table-light text-uppercase text-center">suffix</th>
                                    <th class="table-light text-uppercase text-center">age range</th>
                                    <th class="table-light text-uppercase text-center">gender</th>
                                    <th class="table-light text-uppercase text-center">education</th>
                                    <th class="table-light text-uppercase text-center">occupation</th>
                                    <th class="table-light text-uppercase text-center">status</th>
                                    <th class="table-light text-uppercase text-center">date added</th>
                                    <th class="table-light text-uppercase text-center">last updated</th>
                                </tr>
                            </thead>
                            <!-- end of table header -->
                            <!-- start of table body -->
                            <tbody>
                            <?php
                                if(isset($_GET['filter'])){
                                    $filter = $_GET['filter'];

                                    switch($filter){
                                        case 'today':
                                            $sql_select = "SELECT * FROM client WHERE DATE(created_at) = CURDATE() ORDER BY client_id DESC;";
                                            break;
                                        case '1':
                                        case '2':
                                        case '3':
                                        case '4':
                                        case '5':
                                        case '6':
                                        case '7':
                                        case '8':
                                        case '9':
                                        case '10':
                                        case '11':
                                        case '12':
                                            $sql_select = "SELECT * FROM client WHERE MONTH(created_at) = $filter ORDER BY client_id DESC;";
                                            break;
                                    }
                                    if($filter == 'today'){
                                        $sql_select = "SELECT * FROM client WHERE DATE(created_at) = CURDATE() ORDER BY client_id DESC;";
                                    }
                                }else{
                                    $sql_select = "SELECT * FROM client ORDER BY client_id DESC;";

                                }
                                $result_select = mysqli_query($conn, $sql_select);
                                if(mysqli_num_rows($result_select) > 0){
                                    while($row_select = mysqli_fetch_assoc($result_select)){
                                        $client_id = $row_select['client_id'];
                                        $f_name = $row_select['f_name'];
                                        $m_name = $row_select['m_name'];
                                        $maiden_name = $row_select['maiden_name'];
                                        $l_name = $row_select['l_name'];
                                        $suffix = $row_select['suffix'];
                                        $age_id = $row_select['age_id'];
                                        $gender = $row_select['gender'];
                                        $education = $row_select['education'];
                                        $occupation = $row_select['occupation'];
                                        $status = $row_select['status'];
                                        $created_at = $row_select['created_at'];
                                        $updated_at = $row_select['updated_at'];

                                        if($age_id == 1){
                                            $age_value = "0-12";
                                        }elseif($age_id == 2){
                                            $age_value = "13-21";
                                        }elseif($age_id == 3){
                                            $age_value = "22-35";
                                        }elseif($age_id == 4){
                                            $age_value = "36-59";
                                        }elseif($age_id == 5){
                                            $age_value = "60 above";
                                        }
                            ?>
                                        <tr>
                                            <td class="text-center"><?= $client_id ?></td>
                                            <td class="text-center"><?= $f_name ?></td>
                                            <td class="text-center"><?= $m_name ?></td>
                                            <td class="text-center"><?= $maiden_name ?></td>
                                            <td class="text-center"><?= $l_name ?></td>
                                            <td class="text-center"><?= $suffix ?></td>
                                            <td class="text-center"><?= $age_value ?></td>
                                            <td class="text-center"><?= $gender ?></td>
                                            <td class="text-center"><?= $education ?></td>
                                            <td class="text-center"><?= $occupation ?></td>
                                            <td class="text-center"><?= $status ?></td>
                                            <td class="text-center"><?= $created_at ?></td>
                                            <td class="text-center"><?= $updated_at ?></td>
                                        </tr>
                            <?php
                                    }
                                }else{
                            ?>
                                <tr>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="13" class="text-center">No records found.</td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                            <!-- end of table body -->
                        </table>
                        <!-- end of table -->
                    </div>
                    <!-- end of div on center -->
                </div>
                <!-- end of second row -->
            </div>
            <!-- end of second container -->
        </div>
        <!-- end of first row -->
    </div>
    <!-- end of main section container -->
</div>
<!-- end of main container -->
<?php
    require_once 'js/scripts.php';
?>
    <!-- <script src="js/question-scripts.js"></script> -->
</body>
</html>