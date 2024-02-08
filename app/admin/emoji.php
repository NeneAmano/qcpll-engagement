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
    <title>Emoji</title>
    <?php
        require_once 'includes/sidebar.php';
        $file_destination = '';
        if(isset($_POST['add_emoji'])){
            $unicode_name = mysqli_real_escape_string($conn, $_POST['unicode_name']);

            //validate profile picture
            $file = $_FILES['image'];
            $file_name = $_FILES['image']['name'];
            $file_tmp_name = $_FILES['image']['tmp_name'];
            $file_size = $_FILES['image']['size'];
            $file_error = $_FILES['image']['error'];
            $file_type = $_FILES['image']['type'];

            $file_ext = explode('.', $file_name);
            $file_actual_ext = strtolower(end($file_ext));

            $allowed = array('jpg', 'jpeg', 'png',);

            if($_FILES["image"]["error"] == 4) {
                //means there is no file uploaded
                $image_error = '';
                $file_destination = $image_value;
            }
            if(empty($unicode_name)){
                $error_message = "Unicode name is required.";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
            }

            //if all condition is met, update the profile
            if(!empty($unicode_name) && $file_destination !== ''){
                if(in_array($file_actual_ext, $allowed)) {
                    if($file_error === 0) {
                        if($file_size < 5000000) {
                            $file_name_new = $unicode_name. "." .$file_actual_ext;
                            $file_destination = '../../public/assets/images/emojis/' .$file_name_new;
                            move_uploaded_file($file_tmp_name, $file_destination);

                            // Read JSON file
                            $jsonData = file_get_contents('your_json_file.json');

                            // Decode JSON data
                            $data = json_decode($jsonData, true);




                            $sql_emojji = "UPDATE user_info SET phone_number = '$phone_number', first_name = '$first_name', last_name = '$last_name', image = '$file_destination' WHERE user_id = $user_id_session;";
                            $result_update = mysqli_query($conn, $sql_update);
                            if($result_update){
                                $success_message = ' Profile successfully updated.';
                            }
                        }else {
                            $image_error = ' *Your file is too big.';
                        }
                    }else {
                        $image_error = ' *There was an error uploading your file.';
                    }
                }else{
                    $image_error = ' *You cannot upload file of this type.';
                }


                
            }
        }
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of add service modal button -->
        <button type="button" class="btn btn-primary mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#add_emoji_modal">Add Emoji</button>
        <!-- end of add service modal button -->
        <!-- start of add emoji modal -->
        <div class="modal fade" id="add_emoji_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- start of add modal dialog -->
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <!-- start of add modal content -->
                <div class="modal-content">
                    <!-- start of add modal eader -->
                    <div class="modal-header bg-dark text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Emoji</h1>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                    </div>
                    <!-- end of add modal eader -->
                    <!-- start of add modal form -->
                    <form action="" method="post">
                        <!-- start of add modal body -->                
                        <div class="modal-body">
                            <!-- start of add modal row -->
                            <div class="row">
                                <!-- start of add modal col -->
                                <div class="col-md-12">
                                    <!-- start of add modal card -->
                                    <div class="card card-primary">
                                        <!-- start of add modal card body -->
                                        <div class="card-body">
                                            <!-- start of add modal row -->
                                            <div class="row">
                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="add_unicode_name" class="ps-2 pb-2">Unicode Name</label>
                                                        <input type="text" class="form-control" name="add_unicode_name" id="add_unicode_name" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="add_image" class="ps-2 pb-2">Emoji Image</label>
                                                        <input type="file" class="form-control" name="add_image" id="add_image" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of add modal row -->
                                        </div>
                                        <!-- end of add modal card body -->
                                        <!-- start of add modal footer -->
                                        <div class="modal-footer justify-content-end">
                                            <button type="submit" name="add_emoji" class="btn btn-success">Add</button>
                                        </div>
                                        <!-- end of add modal footer -->
                                    </div>
                                    <!-- end of add modal card -->
                                </div>
                                <!-- end of add modal col -->
                            </div>
                            <!-- end of add modal row -->
                        </div>
                        <!-- end of add modal body -->                
                    </form>
                    <!-- end of add modal form -->
                </div>
                <!-- end of add modal content -->
            </div>
            <!-- end of add modal dialog -->
        </div>
        <!-- end of add emoji modal -->
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
                                    <th class="table-light text-uppercase text-center">emoji id</th>
                                    <th class="table-light text-uppercase text-center">image</th>
                                    <th class="table-light text-uppercase text-center d-none">char</th>
                                    <th class="table-light text-uppercase text-center d-none">image[twemonji]</th>
                                    <th class="table-light text-uppercase text-center d-none">unicode codepoint</th>
                                    <th class="table-light text-uppercase text-center d-none">occurences[5...max]</th>
                                    <th class="table-light text-uppercase text-center d-none">position[0...1]</th>
                                    <th class="table-light text-uppercase text-center d-none">negative[0...1]</th>
                                    <th class="table-light text-uppercase text-center d-none">neutral[0...1]</th>
                                    <th class="table-light text-uppercase text-center d-none">positive[0...1]</th>
                                    <th class="table-light text-uppercase text-center d-none">sentiment score[-1...+1]</th>
                                    <th class="table-light text-uppercase text-center">unicode name</th>
                                    <th class="table-light text-uppercase text-center d-none">unicode block</th>
                                    <th class="table-light text-uppercase text-center">remarks</th>
                                    <th class="table-light text-uppercase text-center">date added</th>
                                    <th class="table-light text-uppercase text-center">last updated</th>
                                    <th class="table-light text-uppercase text-center">action</th>
                                </tr>
                            </thead>
                            <!-- end of table header -->
                            <!-- start of table body -->
                            <tbody>
                            <?php
                                $sql_select = "SELECT * FROM emoji ORDER BY emoji_id DESC;";
                                $result_select = mysqli_query($conn, $sql_select);
                                if(mysqli_num_rows($result_select) > 0){
                                    while($row_select = mysqli_fetch_assoc($result_select)){
                                        $emoji_id = $row_select['emoji_id'];
                                        $image_path = $row_select['image_path'];
                                        $char = $row_select['_char'];
                                        $image = $row_select['image'];
                                        $unicode_codepoint = $row_select['unicode_codepoint'];
                                        $occurences = $row_select['occurences'];
                                        $position = $row_select['_position'];
                                        $negative = $row_select['negative'];
                                        $neutral = $row_select['neutral'];
                                        $positive = $row_select['positive'];
                                        $sentiment_score = $row_select['sentiment_score'];
                                        $unicode_name = $row_select['unicode_name'];
                                        $unicode_block = $row_select['unicode_block'];
                                        $remarks = $row_select['remarks'];
                                        $created_at = $row_select['created_at'];
                                        $updated_at = $row_select['updated_at'];
                            ?>
                                        <tr>
                                            <td class="text-center"><?= $emoji_id ?></td>
                                            <td class="text-center"><?= $image_path ?></td>
                                            <td class="text-center d-none"><?= $char ?></td>
                                            <td class="text-center d-none"><?= $image ?></td>
                                            <td class="text-center d-none"><?= $unicode_codepoint ?></td>
                                            <td class="text-center d-none"><?= $occurences ?></td>
                                            <td class="text-center d-none"><?= $position ?></td>
                                            <td class="text-center d-none"><?= $negative ?></td>
                                            <td class="text-center d-none"><?= $neutral ?></td>
                                            <td class="text-center d-none"><?= $positive ?></td>
                                            <td class="text-center d-none"><?= $sentiment_score ?></td>
                                            <td class="text-center"><?= $unicode_name ?></td>
                                            <td class="text-center d-none"><?= $unicode_block ?></td>
                                            <td class="text-center"><?= $remarks ?></td>
                                            <td class="text-center"><?= $created_at ?></td>
                                            <td class="text-center"><?= $updated_at ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_emoji_modal"><i class="fa-solid fa-pen-to-square"></i></a>  
                                            </td>
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
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="16" class="text-center">No records found.</td>
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
    <script src="js/question-scripts.js"></script>
</body>
</html>