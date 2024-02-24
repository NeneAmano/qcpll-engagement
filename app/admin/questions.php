<?php
require_once('../core/init.php');
ob_start();
if (($user_role_id_session !== 1)) {
    header('location: login.php?error=accessdenied');
    die();
} else {
    if (isset($_GET['archived-records'])) {
        $archived = $_GET['archived-records'];

        if ($archived == 'yes') {
            $is_deleted = 1;
        } elseif ($archived == 'no') {
            $is_deleted = 0;
        }
    } else {
        header('location: dashboard.php');
        die();
    }
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
    if (isset($_POST['add_question'])) {
        $add_question_type = mysqli_real_escape_string($conn, $_POST['add_question_type']);
        $add_question_category = mysqli_real_escape_string($conn, $_POST['add_question_category']);
        $add_english_question = mysqli_real_escape_string($conn, $_POST['add_english_question']);
        $add_tagalog_question = mysqli_real_escape_string($conn, $_POST['add_tagalog_question']);
        $total_input = mysqli_real_escape_string($conn, $_POST['total_input']);

        // Initialize an empty array
        $choices = array();

        $sql_qt = "SELECT * FROM question_type WHERE qt_id = $add_question_type;";
        $result_qt = mysqli_query($conn, $sql_qt);
        if (mysqli_num_rows($result_qt) > 0) {
            $row_qt = mysqli_fetch_assoc($result_qt);

            $qt = $row_qt['question_type'];
            $table_name = strtolower(str_replace(" ", "_", $qt));
        }


        if ($add_question_type !== $add_question_type) {
            $sql = "INSERT INTO questions (qt_id, qc_id, english_question, tagalog_question) VALUES ($add_question_type, $add_question_category, '$add_english_question', '$add_tagalog_question');";
            if (mysqli_query($conn, $sql)) {
                header('location: questions.php?archived-records=no&add=successful');
            }
        } else {
            $sql = "INSERT INTO questions (qt_id, qc_id, english_question, tagalog_question) VALUES ($add_question_type, $add_question_category, '$add_english_question', '$add_tagalog_question');";
            if (mysqli_query($conn, $sql)) {
                $add_question_id = mysqli_insert_id($conn);
                // Use a loop to create $_POST['others'][] based on $total_input
                for ($i = 0; $i < $total_input; $i++) {
                    // Use mysqli_real_escape_string or any other necessary validation/sanitization
                    $choices[$i] = mysqli_real_escape_string($conn, $_POST['add_choices'][$i]);
                }
                // Iterate through $others and echo the values
                foreach ($choices as $key => $value) {
                    if (!empty($value) || $value !== '') {
                        $sql_others = "INSERT INTO $table_name (question_id, $table_name) VALUES ($add_question_id, '$value');";
                        if (mysqli_query($conn, $sql_others)) {
                            header('location: questions.php?archived-records=no&add=successful');
                        }
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
                    <!-- start of add question modal button -->
                    <button type="button" class="btn btn-primary mb-3 mt-3 float-start" data-bs-toggle="modal" data-bs-target="#add_question_modal">Add Question</button>
                    <?php
                    if ($is_deleted == 1) {
                        echo '<button type="button" class="btn btn-warning mb-3 mt-3 float-end"><a href="questions.php?archived-records=no" class="text-decoration-none text-dark">Show Current Records</a></button>';
                    } elseif ($is_deleted == 0) {
                        echo '<button type="button" class="btn btn-warning mb-3 mt-3 float-end"><a href="questions.php?archived-records=yes" class="text-decoration-none text-dark">Show Archived Records</a></button>';
                    }
                    ?>

                    <!-- end of add question modal button -->
                    <!-- start of add question modal -->
                    <div class="modal fade" id="add_question_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <div class="col-md-6 col-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="add_question_type" class="ps-2 pb-2">Question Type</label>
                                                                    <select class="form-select" aria-label="Default select example" name="add_question_type" id="add_question_type" onchange="showfield(this.options[this.selectedIndex].value)" required>
                                                                        <option value="" disabled selected>-- Select Question Type --</option>
                                                                        <?php
                                                                        $sql_question_type = "SELECT * FROM question_type;";
                                                                        $result_question_type = mysqli_query($conn, $sql_question_type);
                                                                        if (mysqli_num_rows($result_question_type) > 0) {
                                                                            while ($row_question_type = mysqli_fetch_assoc($result_question_type)) {
                                                                                $qt_id = $row_question_type['qt_id'];
                                                                                $qt_mc = $row_question_type['multiple_choice'];
                                                                                $question_type = $row_question_type['question_type'];
                                                                                echo '<option value="' . $qt_id . '" id="' . $qt_mc . '">' . $question_type . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="add_question_category" class="ps-2 pb-2">Question Category</label>
                                                                    <select class="form-select" aria-label="Default select example" name="add_question_category" id="add_question_category" required>
                                                                        <option value="" disabled selected>-- Select Question Category --</option>
                                                                        <?php
                                                                        $sql_question_category = "SELECT * FROM question_category;";
                                                                        $result_question_category = mysqli_query($conn, $sql_question_category);
                                                                        if (mysqli_num_rows($result_question_category) > 0) {
                                                                            while ($row_question_category = mysqli_fetch_assoc($result_question_category)) {
                                                                                $qc_id = $row_question_category['qc_id'];
                                                                                $question_category = $row_question_category['question_category'];
                                                                                echo '<option value="' . $qc_id . '">' . $question_category . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-6 mt-3">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" placeholder="Leave a comment here" id="add_english_question" name="add_english_question" style="height: 100px; resize: none;"></textarea required>
                                                                    <label for="add_english_question">English Translation</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-6 mt-3">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" placeholder="Leave a comment here" id="add_tagalog_question" name="add_tagalog_question"style="height: 100px; resize: none;"></textarea required>
                                                                    <label for="add_tagalog_question">Tagalog Translation</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-6 mt-3">
                                                                <div id="choices">Specify Choices
                                                                    <button onclick="add_status()" type="button" class="btn btn-primary mb-2 ms-2">Add</button>
                                                                    <button onclick="remove_status()" type="button" class="btn btn-danger mb-2 ms-2">Remove</button>
                                                                    <input type="text" class="add_choices[] form-control mb-2" name="add_choices[]" id="add_choices_1">
                                                                    <div id="new_chq_status"></div>
                                                                    <input type="hidden" value="1" id="total_chq_status" name="total_input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end of add modal row -->
                                                    </div>
                                                    <!-- end of add modal card body -->
                                                    <!-- start of add modal footer -->
                                                    <div class="modal-footer justify-content-end">
                                                        <button type="submit" name="add_question" class="btn btn-success">Add</button>
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
                    <!-- end of add question modal -->
                </div>
                <style>
                            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300;400;500&display=swap');
                            *{
                                font-family: 'Poppins',sans-serif;
                            }
                    .row{
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
                                            <th class="table-light text-uppercase text-center">question id</th>
                                            <th class="table-light text-uppercase d-none">question type id</th>
                                            <th class="table-light text-uppercase d-none">question category id</th>
                                            <th class="table-light text-uppercase text-center">question type</th>
                                            <th class="table-light text-uppercase text-center">question category</th>
                                            <th class="table-light text-uppercase text-center">english translation</th>
                                            <th class="table-light text-uppercase text-center">tagalog translation</th>
                                            <th class="table-light text-uppercase text-center">date added</th>
                                            <th class="table-light text-uppercase text-center">last updated</th>
                                            <th class="table-light text-uppercase text-center">action</th>
                                        </tr>
                                    </thead>
                                    <!-- end of table header -->
                                    <!-- start of table body -->
                                    <tbody>
                                    <?php
                                    $sql_select = "SELECT questions.*, question_type.question_type, question_category.question_category FROM question_category INNER JOIN questions USING (qc_id) INNER JOIN question_type USING (qt_id) WHERE questions.is_deleted = $is_deleted ORDER BY questions.question_id DESC;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if (mysqli_num_rows($result_select) > 0) {
                                        while ($row_select = mysqli_fetch_assoc($result_select)) {
                                            $question_id = $row_select['question_id'];
                                            $qt_id = $row_select['qt_id'];
                                            $qc_id = $row_select['qc_id'];
                                            $question_type = $row_select['question_type'];
                                            $question_category = $row_select['question_category'];
                                            $english_question = $row_select['english_question'];
                                            $tagalog_question = $row_select['tagalog_question'];
                                            $created_at = $row_select['created_at'];
                                            $updated_at = $row_select['updated_at'];
                                    ?>
                                                <tr>
                                                    <td class="text-center"><?= $question_id ?></td>
                                                    <td class="text-center d-none"><?= $qt_id ?></td>
                                                    <td class="text-center d-none"><?= $qc_id ?></td>
                                                    <td class="text-center"><?= $question_type ?></td>
                                                    <td class="text-center"><?= $question_category ?></td>
                                                    <td class="text-center"><?= $english_question ?></td>
                                                    <td class="text-center"><?= $tagalog_question ?></td>
                                                    <td class="text-center"><?= $created_at ?></td>
                                                    <td class="text-center"><?= $updated_at ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_question_modal" data-modal-type="question"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_question_modal"><i class="fa-solid fa-trash"></i></a>
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
                                            <td colspan="" class="text-center d-none"></td>
                                            <td colspan="" class="text-center d-none"></td>
                                            <td colspan="" class="text-center d-none"></td>
                                            <td colspan="" class="text-center d-none"></td>
                                            <td colspan="" class="text-center d-none"></td>
                                            <td colspan="10" class="text-center">No records found.</td>
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

                <!-- start of edit question modal -->
                <div class="modal fade" id="edit_question_modal">
                    <!-- start of edit modal dialog -->
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <!-- start of edit modal content -->
                        <div class="modal-content">
                            <!-- start of modal header -->
                            <div class="modal-header bg-dark border-0">
                                <h4 class="modal-title text-white">Edit Question</h4>
                                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                                </button>
                            </div>
                            <!-- end of modal header -->
                            <!-- start of edit modal form -->
                            <form action="functions/edit-question.php" method="post">
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
                                                        <input type="hidden" class="form-control" name="edit_question_id" id="edit_question_id" value="">
                                                        <div class="col-md-12 col-6 mt-3">
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Leave a comment here" id="edit_english_question" name="edit_english_question"style="height: 100px; resize: none;"></textarea required>
                                                                <label for="edit_english_question">English Translation</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-6 mt-3">
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Leave a comment here" id="edit_tagalog_question" name="edit_tagalog_question"style="height: 100px; resize: none;"></textarea required>
                                                                <label for="edit_tagalog_question">Tagalog Translation</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end of edit modal row -->
                                                </div>
                                                <!-- end of edit modal card body -->
                                                <!-- start of edit modal footer -->
                                                <div class="modal-footer justify-content-end">
                                                    <button type="submit" name="edit_question" class="btn btn-success">Save Changes</button>
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
                <!-- end of edit question modal -->
            </div>
            <!-- end of card body -->
        </div>
        <!-- end of card -->

        <!-- start of deactivate user modal -->
        <div class="modal fade" id="delete_question_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <!-- start of delete question modal form -->
                    <form action="functions/delete-question-modal.php" method="post">
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
                                                        <input type="hidden" name="delete_question_id" id="delete_question_id" class="form-control mb-3">
                                                        <h4>Are you sure you want to delete this question?</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of deactivate modal row -->
                                        </div>
                                        <!-- end of deactivate modal card body -->
                                        <!-- start of deactivate modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <button type="submit" name="delete_question" class="btn btn-danger">Yes</button>
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
        <!-- end of delete question modal -->
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