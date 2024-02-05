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
    <title>Users</title>
    <?php
        require_once 'includes/sidebar.php';
        if(isset($_POST['add_user'])){
            $add_user_role = mysqli_real_escape_string($conn, $_POST['add_user_role']);
            $add_username = mysqli_real_escape_string($conn, $_POST['add_username']);
            $add_password = mysqli_real_escape_string($conn, $_POST['add_password']);
            $add_repeat_password = mysqli_real_escape_string($conn, $_POST['add_repeat_password']);
            
            $sql = "SELECT * FROM users WHERE username = '$add_username';";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $error_message = "Username already taken.";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
            }elseif(empty($add_user_role) || empty($add_username) || empty($add_password) || empty($add_repeat_password)){
                $error_message = "All fields are required.";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
            }elseif($add_password !== $add_repeat_password){
                $error_message = "Password does not match.";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
            }else{
                $hashed_password = password_hash($add_password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (user_role_id, username, password) VALUES ($add_user_role, '$add_username', '$hashed_password');";
                if(mysqli_query($conn, $sql)){
                    header('location: users.php?add=successful');
                }
            }
        }
    ?>
    <!-- start of main section container -->
    <div class="container mt-3 ms-5">
        <!-- start of add user modal button -->
        <button type="button" class="btn btn-primary mb-3 mt-5" data-bs-toggle="modal" data-bs-target="#add_user_modal">Add User</button>
        <!-- end of add user modal button -->
        
        <!-- start of add user modal -->
        <div class="modal fade" id="add_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                    </div>
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
                                                        <label for="add_user_role" class="ps-2 pb-2">User role</label>
                                                        <select class="form-select" aria-label="Default select example" name="add_user_role" id="add_user_role" required>
                                                            <?php
                                                                $sql_user_role = "SELECT * FROM user_role;";
                                                                $result_user_role = mysqli_query($conn, $sql_user_role);
                                                                if(mysqli_num_rows($result_user_role) > 0){
                                                                    while($row_user_role = mysqli_fetch_assoc($result_user_role)){
                                                                        $user_role_id = $row_user_role['user_role_id'];
                                                                        $user_role = $row_user_role['user_role'];

                                                                        echo '<option value="' .$user_role_id. '">' .$user_role. '</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="add_username" class="ps-2 pb-2">Username</label>
                                                        <input type="text" class="form-control" name="add_username" id="add_username" value="" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="add_password" class="ps-2 pb-2">Password</label>
                                                        <input type="password" class="form-control" name="add_password" id="add_password" value="" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="add_repeat_password" class="ps-2 pb-2">Repeat password</label>
                                                        <input type="password" class="form-control" name="add_repeat_password" id="add_repeat_password" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of add modal row -->
                                        </div>
                                        <!-- end of add modal card body -->
                                        <!-- start of add modal footer -->
                                        <div class="modal-footer justify-content-end">
                                            <button type="submit" name="add_user" class="btn btn-success">Save Changes</button>
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
            </div>
        </div>
        <!-- end of add user modal -->

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
                                    <th class="d-none">user role id</th>
                                    <th class="table-light text-uppercase text-center">user id</th>
                                    <th class="table-light text-uppercase text-center">user role</th>
                                    <th class="table-light text-uppercase text-center">username</th>
                                    <th class="table-light text-uppercase text-center">status</th>
                                    <th class="table-light text-uppercase text-center">last login</th>
                                    <th class="table-light text-uppercase text-center">date added</th>
                                    <th class="table-light text-uppercase text-center">last updated</th>
                                    <th class="table-light text-uppercase text-center">action</th>
                                </tr>
                            </thead>
                            <!-- end of table header -->
                            <!-- start of table body -->
                            <tbody>
                                <?php
                                    $sql_select = "SELECT user_role.user_role, user_role.user_role_id, users.* FROM user_role INNER JOIN users USING (user_role_id) WHERE users.is_active != 0 ORDER BY users.user_id DESC;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                        if(mysqli_num_rows($result_select) > 0){
                                            while($row_select = mysqli_fetch_assoc($result_select)){
                                                $user_role_id = $row_select['user_role_id'];
                                                $user_id = $row_select['user_id'];
                                                $user_role = $row_select['user_role'];
                                                $username = $row_select['username'];
                                                $is_active = $row_select['is_active'];
                                                $last_login = $row_select['last_login'];
                                                $created_at = $row_select['created_at'];
                                                $updated_at = $row_select['updated_at'];

                                                if($is_active == 0){
                                                    $is_active = 'Not active';
                                                }elseif($is_active == 1){
                                                    $is_active = 'Active';
                                                }
                                ?>
                                                <tr>
                                                    <td class="d-none"><?= $user_role_id; ?></td>
                                                    <td class="text-center"><?= $user_id ?></td>
                                                    <td class="text-center"><?= $user_role ?></td>
                                                    <td class="text-center"><?= $username ?></td>
                                                    <td class="text-center"><?= $is_active ?></td>
                                                    <td class="text-center"><?= $last_login ?></td>
                                                    <td class="text-center"><?= $created_at ?></td>
                                                    <td class="text-center"><?= $updated_at ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_user_modal" data-modal-type="user"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                        <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#deactivate_user_modal"><i class="fa-solid fa-ban"></i></a>
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
                                                <td colspan="8" class="text-center">No records found.</td>
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


        <!-- start of edit user modal -->
        <div class="modal fade" id="edit_user_modal">
            <!-- start of edit modal dialog -->
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <!-- start of edit modal content -->
                <div class="modal-content">
                    <!-- start of modal header -->
                    <div class="modal-header bg-dark border-0">
                        <h4 class="modal-title text-white">Edit user</h4>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                    <!-- end of modal header -->
                    <!-- start of edit modal form -->
                    <form action="functions/edit-user.php" method="post">
                        <!-- start of edit modal body -->                
                        <div class="modal-body">
                            <!-- start of edit modal row -->
                            <div class="row">
                                <!-- start of edit modal col -->
                                <div class="col-md-12">
                                    <!-- start of edit modal card -->
                                    <div class="card card-primary">
                                        <!-- start of edit modal card body -->
                                        <div class="card-body">
                                            <!-- start of edit modal row -->
                                            <div class="row">
                                                <input type="text" class="form-control" name="edit_user_id" id="edit_user_id" value="">
                                                
                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_user_role" class="ps-2 pb-2">User role</label>
                                                        <select class="form-select" aria-label="Default select example" name="edit_user_role" id="edit_user_role" required>
                                                            <?php
                                                                $sql_user_role = "SELECT * FROM user_role;";
                                                                $result_user_role = mysqli_query($conn, $sql_user_role);
                                                                if(mysqli_num_rows($result_user_role) > 0){
                                                                    while($row_user_role = mysqli_fetch_assoc($result_user_role)){
                                                                        $user_role_id = $row_user_role['user_role_id'];
                                                                        $user_role = $row_user_role['user_role'];

                                                                        echo '<option value="' .$user_role_id. '">' .$user_role. '</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_username" class="ps-2 pb-2">Username</label>
                                                        <input type="text" class="form-control" name="edit_username" id="edit_username" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of edit modal row -->
                                        </div>
                                        <!-- end of edit modal card body -->
                                        <!-- start of edit modal footer -->
                                        <div class="modal-footer justify-content-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_user_password_modal" data-modal-type="password">Change Password</button>
                                            
                                            <button type="submit" name="edit_user" class="btn btn-success">Save Changes</button>
                                        </div>
                                        <!-- end of edit modal footer -->
                                    </div>
                                    <!-- end of edit modal card -->
                                </div>
                                <!-- end of edit modal col -->
                            </div>
                            <!-- end of edit modal row -->
                        </div>
                        <!-- end of edit modal body -->                
                    </form>
                    <!-- end of edit modal form -->
                </div>
                <!-- end of edit modal content -->
            </div>
            <!-- end of edit modal dialog -->
        </div>
        <!-- end of edit user modal -->

        <!-- start of edit password modal -->
        <div class="modal fade" id="edit_user_password_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <!-- start of edit modal dialog -->
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <!-- start of edit modal content -->
                <div class="modal-content">
                    <!-- start of modal header -->
                    <div class="modal-header bg-dark border-0">
                        <h4 class="modal-title text-white">Edit user</h4>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                    <!-- end of modal header -->

                    <!-- start of edit modal form -->
                    <form action="functions/edit-user-password.php" method="post">
                        <!-- start of edit modal body -->                
                        <div class="modal-body">
                            <!-- start of edit modal row -->
                            <div class="row">
                                <!-- start of edit modal col -->
                                <div class="col-md-12">
                                    <!-- start of edit modal card -->
                                    <div class="card card-primary">
                                        <!-- start of edit modal card body -->
                                        <div class="card-body">
                                            <!-- start of edit modal row -->
                                            <div class="row">
                                                <input type="text" class="form-control" name="edit_user_password_id" id="edit_user_password_id" value="">

                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_password" class="ps-2 pb-2">Current Password</label>
                                                        <input type="password" class="form-control" name="edit_current_password" id="edit_current_password" value="" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-6 mt-3">
                                                </div>

                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_password" class="ps-2 pb-2">Password</label>
                                                        <input type="password" class="form-control" name="edit_password" id="edit_password" value="" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_repeat_password" class="ps-2 pb-2">Repeat password</label>
                                                        <input type="password" class="form-control" name="edit_repeat_password" id="edit_repeat_password" value="" required>
                                                    </div>
                                                </div>    
                                            </div>
                                            <!-- end of edit modal row -->
                                        </div>
                                        <!-- end of edit modal card body -->
                                        <!-- start of edit modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-target="#edit_user_modal" data-bs-toggle="modal">Go back</button>
                                            <button type="submit" name="edit_user_password" class="btn btn-success">Save Changes</button>
                                        </div>
                                        <!-- end of edit modal footer -->
                                    </div>
                                    <!-- end of edit modal card -->
                                </div>
                                <!-- end of edit modal col -->
                            </div>
                            <!-- end of edit modal row -->
                        </div>
                        <!-- end of edit modal body -->                
                    </form>
                    <!-- end of edit modal form -->
                </div>
                <!-- end of edit modal content -->
            </div>
            <!-- end of edit modal dialog -->
        </div>
        <!-- end of edit password modal -->

        <!-- start of deactivate user modal -->
        <div class="modal fade" id="deactivate_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- start of deactivate modal dialog -->
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <!-- start of deactivate modal content -->
                <div class="modal-content">
                    <!-- start of deactivate modal header -->
                    <div class="modal-header bg-dark text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Deactivate user</h1>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                    </div>
                    <!-- end of deactivate modal header -->

                    <!-- start of deactivate modal form -->
                    <form action="functions/deactivate-user.php" method="post">
                        <!-- start of deactivate modal body -->                
                        <div class="modal-body">
                            <!-- start of deactivate modal row -->
                            <div class="row">
                                <!-- start of deactivate modal col -->
                                <div class="col-md-12">
                                    <!-- start of deactivate modal card -->
                                    <div class="card card-primary">
                                        <!-- start of deactivate modal card body -->
                                        <div class="card-body">
                                            <!-- start of deactivate modal row -->
                                            <div class="row">
                                                <div class="col-md-12 col-12 mt-3">
                                                    <div class="form-group">
                                                        <input type="hidden" name="deactivate_user_id" id="deactivate_user_id" class="form-control mb-3">
                                                        <h4>Are you sure you want to deactivate this user?</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of deactivate modal row -->
                                        </div>
                                        <!-- end of deactivate modal card body -->
                                        <!-- start of deactivate modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <button type="submit" name="deactivate" class="btn btn-danger">Yes</button>
                                        </div>
                                        <!-- end of deactivate modal footer -->
                                    </div>
                                    <!-- end of deactivate modal card -->
                                </div>
                                <!-- end of deactivate modal col -->
                            </div>
                            <!-- end of deactivate modal row -->
                        </div>
                        <!-- end of deactivate modal body -->                
                    </form>
                    <!-- end of deactivate modal form -->
                </div>
                <!-- end of deactivate modal content -->
            </div>
            <!-- end of deactivate modal dialog -->
        </div>
        <!-- end of deactivate user modal -->
    </div>
    <!-- end of main section container -->
</div>
<!-- end of main container -->
<?php
    require_once 'js/scripts.php';
?>
    <script src="js/user-scripts.js"></script>
</body>
</html>