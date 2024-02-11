
<?php
    require_once('../core/init.php');
    if(isset($_SESSION['user_id'])){
        if(isset($_GET['queue_no']) && isset($_GET['client_id']) && isset($_GET['birthdate'])){
            $queue_no = $_GET['queue_no'];
            $client_id = $_GET['client_id'];
            $birthdate = $_GET['birthdate'];

            $sql = "SELECT * FROM client WHERE client_id = $client_id;";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $f_name = $row['f_name'];
                    $m_name = $row['m_name'];
                    $l_name = $row['l_name'];
                    $suffix = $row['suffix'];
                    $age_id = $row['age_id'];
                    $gender = $row['gender'];
                    $education = $row['education'];
                    $occupation = $row['occupation'];
                    $status = $row['status'];
                    $created_at = $row['created_at'];

                    if($status == 0){
                        $new_status = 'Normal';
                    }elseif($status == 1){
                        $new_status = 'Senior';
                    }elseif($status == 2){
                        $new_status = 'PWD';
                    }elseif($status == 3){
                        $new_status = 'Pregnant';
                    }
                }
            }else{
                header('location: ../../public/index.php');
                die();
            }
        }
    }else{
        header('location: ../../public/index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Others</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="../../public/assets/css/other-form.css">
<body>
    
<div class="container my-2">
    <div class="formbg">
    <div class="row">
        <div class="col" style="text-align: center;">
            <h1>New Form</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col">
                    <h2>New form</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <form>
                        <label class="form-label" for="first-name">First Name:</label>
                        <input type="text" class="form-control" id="first-name" placeholder="" value="<?= $f_name ?>">
                    </form>
                </div>
                <div class="col-6">
                    <form>
                        <label class="form-label" for="middle-name">Middle Name:</label>
                        <input type="text" class="form-control" id="middle-name" placeholder="" value="<?= $m_name ?>">
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-7">
                    <form>
                        <label class="form-label" for="last-name">Last Name:</label>
                        <input type="text" class="form-control" id="last-name" placeholder="" value="<?= $l_name ?>">
                    </form>
                </div>
                <div class="col-5">
                    <form>
                        <label class="form-label" for="suffix">Suffix: <span class="fst-italic">(Jr./Sr./II/III)</span></label>
                        <input type="text" class="form-control" id="suffix" placeholder="" value="<?= $suffix ?>">
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <form>
                        <label for="gender" class="form-label">Gender:</label>
                        <input type="text" class="form-control" id="gender" value="<?= $gender ?>">
                    </form>
                </div>
                <div class="col-6">
                    <form>
                        <label for="birthday" class="form-label">Birthdate:</label>
                        <input type="date" class="form-control" id="birthday" value="<?= $birthdate ?>">
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <form>
                        <label for="status" class="form-label me-2">Status:</label>
                        <input type="text" class="form-control" id="status" value="<?= $new_status ?>">
                    </form>
                </div>
            </div>
        </div>

        




        <!-- Queue Number Column -->
        <div class="col-4" style="text-align: center;">
            <div class="row">
            <div class="col" style="text-align: center;">
                            <h2>Queue Number</h2>       
                            <div class="card">
                                <h4><?= $queue_no ?></h4>
                            </div>
                        </div>
                        <div class="sub-information">
                            <h4 style="text-align:center;">Main Library</h4>
                            <h4 class="ps-4"><?= $created_at ?></h4>
                            <h4>2 Gov. ID</h4>
                            <p>1.___________
                            <p>
                            <p>2.___________
                            <p>
                        </div>
            </div>
        </div>
    </div>
    </div>
</div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
