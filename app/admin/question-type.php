<?php
require_once('../core/init.php');
ob_start();
if (($user_role_id_session !== 1)) {
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
    <title>Questions</title>
    <?php
    require_once 'includes/sidebar.php';
    if (isset($_POST['add_qt'])) {
        $add_question_type = mysqli_real_escape_string($conn, $_POST['add_question_type']);
        $add_multiple = mysqli_real_escape_string($conn, $_POST['add_multiple']);

        $sql = "SELECT * FROM question_type WHERE question_type = '$add_question_type';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error_message = "Question Type already exists.";
            echo "<script type='text/javascript'>alert('$error_message');</script>";
        } elseif (empty($add_question_type)) {
            $error_message = "Question Type is required.";
            echo "<script type='text/javascript'>alert('$error_message');</script>";
        } else {
            $sql = "INSERT INTO question_type (question_type, multiple_choice) VALUES ('$add_question_type', '$add_multiple');";
            if (mysqli_query($conn, $sql)) {
                if ($add_multiple == 1) {

                    $table_name = strtolower(str_replace(" ", "_", $add_question_type));

                    $parts = explode("_", $table_name);
                    $first_part = $parts[0];

                    $primary_key = $first_part . '_id';

                    $sql_table = "CREATE TABLE IF NOT EXISTS $table_name (
                            $primary_key INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                            question_id INT(11),
                            $table_name VARCHAR(255) NOT NULL,
                            is_deleted tinyint NOT NULL DEFAULT 0,
                            created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                            updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                            FOREIGN KEY(question_id) REFERENCES questions(question_id) ON DELETE SET NULL ON UPDATE CASCADE
                        );";
                    if (mysqli_query($conn, $sql_table)) {


                        header('location: question-type.php?add=successful');
                        die();
                    }
                }
            }
        }
    }
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of card -->
        <div class="card">
            <!-- start of card header -->
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link text-dark" id="questions" href="questions.php?archived-records=no">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" id="question-type" href="question-type.php">Question Type</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" id="question-category" href="question-category.php">Question Category</a>
                    </li>
                </ul>
            </div>
            <!-- end of card header -->
            <!-- start of card body -->
            <div class="card-body d-flex flex-column">
                <div class="container-fluid">
                    <!-- start of add service modal button -->
                    <button type="button" class="btn btn-primary mb-3 mt-3 float-start" data-bs-toggle="modal" data-bs-target="#add_question_type_modal">Add Type</button>
                    <!-- end of add service modal button -->
                    <!-- start of add question type modal -->
                    <div class="modal fade" id="add_question_type_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <!-- start of add modal dialog -->
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <!-- start of add modal content -->
                            <div class="modal-content">
                                <!-- start of add modal eader -->
                                <div class="modal-header bg-dark text-white">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Question Type</h1>
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
                                                            <div class="col-md-12 col-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="add_question_type" class="ps-2 pb-2">Question Type</label>
                                                                    <input type="text" class="form-control" name="add_question_type" id="add_question_type" value="" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 col-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="add_multiple" class="ps-2 pb-2">Does it have choices?</label>
                                                                    <select class="form-select" aria-label="Default select example" name="add_multiple" id="add_multiple" required>
                                                                        <option value="0" selected>No</option>
                                                                        <option value="1">Yes</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- end of add modal row -->
                                                    </div>
                                                    <!-- end of add modal card body -->
                                                    <!-- start of add modal footer -->
                                                    <div class="modal-footer justify-content-end">
                                                        <button type="submit" name="add_qt" class="btn btn-success">Add</button>
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
                    <!-- end of add question type modal -->
                </div>
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');

                    * {
                        font-family: 'Poppins', sans-serif;
                    }

                    .row {
                        box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
                        padding: 3px;
                    }
                </style>
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
                                            <th class="table-light text-uppercase text-center">question type id</th>
                                            <th class="table-light text-uppercase text-center">question type</th>
                                            <th class="table-light text-uppercase text-center">date added</th>
                                            <th class="table-light text-uppercase text-center">last updated</th>
                                            <th class="table-light text-uppercase text-center">action</th>
                                        </tr>
                                    </thead>
                                    <!-- end of table header -->
                                    <!-- start of table body -->
                                    <tbody>
                                        <?php
                                        $sql_select = "SELECT * FROM question_type ORDER BY qt_id DESC;";
                                        $result_select = mysqli_query($conn, $sql_select);
                                        if (mysqli_num_rows($result_select) > 0) {
                                            while ($row_select = mysqli_fetch_assoc($result_select)) {
                                                $qt_id = $row_select['qt_id'];
                                                $question_type = $row_select['question_type'];
                                                $created_at = $row_select['created_at'];
                                                $updated_at = $row_select['updated_at'];
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?= $qt_id ?></td>
                                                    <td class="text-center"><?= $question_type ?></td>
                                                    <td class="text-center"><?= $created_at ?></td>
                                                    <td class="text-center"><?= $updated_at ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_question_type_modal"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="" class="text-center d-none"></td>
                                                <td colspan="5" class="text-center">No records found.</td>
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

                <!-- start of edit question type modal -->
                <div class="modal fade" id="edit_question_type_modal">
                    <!-- start of edit modal dialog -->
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <!-- start of edit modal content -->
                        <div class="modal-content">
                            <!-- start of modal header -->
                            <div class="modal-header bg-dark border-0">
                                <h4 class="modal-title text-white">Edit Question Type</h4>
                                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                                </button>
                            </div>
                            <!-- end of modal header -->
                            <!-- start of edit modal form -->
                            <form action="functions/edit-question-type.php" method="post">
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
                                                        <input type="hidden" class="form-control" name="edit_qt_id" id="edit_qt_id" value="">

                                                        <div class="col-md-12 col-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="edit_question_type" class="ps-2 pb-2">Question Type</label>
                                                                <input type="text" class="form-control" name="edit_question_type" id="edit_question_type" value="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end of edit modal row -->
                                                </div>
                                                <!-- end of edit modal card body -->
                                                <!-- start of edit modal footer -->
                                                <div class="modal-footer justify-content-end">
                                                    <button type="submit" name="edit_qt" class="btn btn-success">Save Changes</button>
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
                <!-- end of edit question type modal -->

            </div>
            <!-- end of card body -->
        </div>
        <!-- end of card -->
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