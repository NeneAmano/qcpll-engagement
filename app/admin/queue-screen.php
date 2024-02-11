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
    <title>Queue Monitoring</title>                        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
    <?php
        require_once 'includes/sidebar.php';
    ?>
    <!-- start of main section container -->
    <div class="container mt-3 ms-5">
<h1 class="d-flex" style="justify-content: center;">QUEUEING NUMBER MONITORING</h1>
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
                                    <th class="table-light text-uppercase text-center">Queue Details ID</th>
                                    <th class="table-light text-uppercase text-center">Client</th>
                                    <th class="table-light text-uppercase text-center">Queue Number</th>
                                    <th class="table-light text-uppercase text-center">Service</th>
                                    <th class="table-light text-uppercase text-center">Status</th>
                                    <th class="table-light text-uppercase text-center">Created_at</th>
                                    <th class="table-light text-uppercase text-center">Updated_at</th>
                                    <th class="table-light text-uppercase text-center">Action</th>
                                </tr>
                            </thead>
                            <!-- end of table header -->
                            <!-- start of table body -->
                            <tbody>
                                <?php
                                    $sql_select = "SELECT queue_details.qd_id,CONCAT(client.f_name, ' ' , client.l_name) AS client,queue_details.queue_number,queue_details.service,queue_details.`status`,queue_details.created_at,queue_details.updated_at
                                    FROM queue_details
                                    JOIN client ON queue_details.client_id = client.client_id
                                     WHERE DATE(queue_details.created_at) = CURDATE()
                                     GROUP BY queue_details.qd_id ;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                        if(mysqli_num_rows($result_select) > 0){
                                            while($row_select = mysqli_fetch_assoc($result_select)){
                                                $qd_id = $row_select['qd_id'];
                                                $client_name = $row_select['client'];
                                                $qnumber = $row_select['queue_number'];
                                                $service = $row_select['service'];
                                                $is_active_status = $row_select['status'];
                                                $created_at = $row_select['created_at'];
                                                $updated_at = $row_select['updated_at'];

                                                if($is_active_status == 0){
                                                    $is_active_status = 'Pending';
                                                }elseif($is_active_status == 1){
                                                    $is_active_status = 'Done';
                                                }

                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $qd_id; ?></td>
                                                    <td class="text-center"><?= $client_name ?></td>
                                                    <td class="text-center"><?= $qnumber ?></td>
                                                    <td class="text-center"><?= $service ?></td>
                                                    <td class="text-center"><?=  $is_active_status ?></td>
                                                    <td class="text-center"><?= $created_at ?></td>
                                                    <td class="text-center"><?= $updated_at ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_entry_status" data-modal-type="user"><i class="fa-solid fa-pen-to-square"></i></a>  
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
        <div class="modal fade" id="edit_entry_status">
            <!-- start of edit modal dialog -->
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <!-- start of edit modal content -->
                <div class="modal-content">
                    <!-- start of modal header -->
                    <div class="modal-header bg-dark border-0">
                        <h4 class="modal-title text-white">Queue Number Cancellation</h4>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                    <!-- end of modal header -->
                    <!-- start of edit modal form -->
                    <form action="" method="post">
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
                                                <input type="text" class="form-control" name="edit_qd_id" id="edit_qd_id" value="">
                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_queue_number" class="ps-2 pb-2">Queue Number</label>
                                                        <input type="text" class="form-control" name="edit_queue_number" id="edit_queue_number" value="" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_name" class="ps-2 pb-2">Fullname</label>
                                                        <input type="text" class="form-control" name="edit_name" id="edit_name" value="">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_entry_check" class="ps-2 pb-2">ENTRY STATUS</label>
                                                        <select class="form-select" name="edit_entry_check" id="edit_entry_check" >
                                                           <option value = 0>Pending</option>
                                                           <option value = 1>Completed</option>
                                                           <option value = 2>Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of edit modal row -->
                                        </div>
                                        <!-- end of edit modal card body -->
                                        <!-- start of edit modal footer -->
                                        <div class="modal-footer justify-content-end">                                         
                                            <button type="submit" name="edit_client" class="btn btn-success">Save Changes</button>
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
<script>
$(document).ready(function () {
    $('body').on('click', '.edit', function (event) {
        var $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();


        var modalType = $(this).data('modal-type');

        $('#edit_qd_id').val(data[0]);
        $('#edit_name').val(data[1]);
        $('#edit_queue_number').val(data[2])



        // Show the appropriate modal based on modal type
        if (modalType === 'user') {
            $('#edit_user_modal').modal('show');
        } else if(modalType === 'password') {
            $('#edit_user_password_modal').modal('show');
        }
    });
});


</script>
<?php
    require_once 'js/scripts.php';
?>
</body>
</html>