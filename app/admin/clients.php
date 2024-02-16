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
    <?php
        require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of add service modal button -->
        <button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target="">Today</button>

        <!-- filter by month -->
        <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filter by Month</button>
        <ul class="dropdown-menu bg-success monthly" id="monthly">
            <?php
                for ($month = 1; $month <= 12; $month++) {
                    $month_name = date("F", mktime(0, 0, 0, $month, 1));
                    echo '<li><a class="dropdown-item" href="#">' .$month_name. '</a></li>';
                }
            ?>
        </ul>
        
        <!-- filter by year -->
        <select class="form-select btn btn-success ps-0" style="width: 150px;" aria-label="Default select example">
            <option selected disabled>Filter by Year</option>
            <?php
                $sql_year = "SELECT DISTINCT YEAR(`created_at`) AS year FROM `client`";
                $result_year = mysqli_query($conn, $sql_year);

                while ($row_year = mysqli_fetch_assoc($result_year)) {
                    $year = $row_year['year'];
                    echo '<li><a class="dropdown-item" href="#">' .$year. '</a></li>';
                    echo '<option value="' .$year. '">' .$year. '</option>';
                }
            ?>
        </select>

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
                                $sql_select = "SELECT * FROM client ORDER BY client_id DESC;";
                                $result_select = mysqli_query($conn, $sql_select);
                                if(mysqli_num_rows($result_select) > 0){
                                    while($row_select = mysqli_fetch_assoc($result_select)){
                                        $client_id = $row_select['client_id'];
                                        $f_name = $row_select['f_name'];
                                        $m_name = $row_select['m_name'];
                                        $l_name = $row_select['l_name'];
                                        $suffix = $row_select['suffix'];
                                        $age_id = $row_select['age_id'];
                                        $gender = $row_select['gender'];
                                        $education = $row_select['education'];
                                        $occupation = $row_select['occupation'];
                                        $status = $row_select['status'];
                                        $created_at = $row_select['created_at'];
                                        $updated_at = $row_select['updated_at'];
                            ?>
                                        <tr>
                                            <td class="text-center"><?= $client_id ?></td>
                                            <td class="text-center"><?= $f_name ?></td>
                                            <td class="text-center"><?= $m_name ?></td>
                                            <td class="text-center"><?= $l_name ?></td>
                                            <td class="text-center"><?= $suffix ?></td>
                                            <td class="text-center"><?= $age_id ?></td>
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
                                    <td colspan="11" class="text-center">No records found.</td>
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