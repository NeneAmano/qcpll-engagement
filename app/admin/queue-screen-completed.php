<?php
    require_once('../core/init.php');
    ob_start();
    if (($user_role_id_session !== 1) && ($user_role_id_session !== 2)) {
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
    <title>Queue Monitoring</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> <!-- Add this line -->
    <?php require_once 'includes/sidebar.php'; ?>
    <style>
        .row {
            box-shadow: 0 6rem 40rem rgba(132, 139, 234, 0.18);
            padding: 6px;
        }
        .container{
            overflow: scroll;
            height: 97vh;
        }
        .container::-webkit-scrollbar {
            display: none;
        }
        body{
        
        }
        .breadcrumb-item{
            border: 2px solid gray;
            padding: 10px;
            border-radius: 5px;
        }
        .breadcrumb-item a{
            text-decoration: none !important;
            color: gray;
        }
        li a:hover{
            text-decoration: underline !important;
        }
    </style>
</head>
<body>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="queue-screen.php">Pending Transaction</a></li>&nbsp;
    <li class="breadcrumb-item"><a href="queue-screen-completed.php">Completed Transaction</a></li>&nbsp;
    <li class="breadcrumb-item active" aria-current="page"><a href="queue-screen-cancelled.php">Cancelled Transaction</a></li>
  </ol>
</nav>

     <div class="container-fluid mt-3">
        <h1 class="d-flex justify-content-center">QUEUEING NUMBER MONITORING</h1>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th class="table-light text-uppercase text-center">Queue Details ID</th>
                                    <th class="table-light text-uppercase text-center">Client ID</th>
                                    <th class="table-light text-uppercase text-center">Client</th>
                                    <th class="table-light text-uppercase text-center">Queue Number</th>
                                    <th class="table-light text-uppercase text-center">Service</th>
                                    <th class="table-light text-uppercase text-center">Status</th>
                                    <th class="table-light text-uppercase text-center">Entry Check</th>
                                    <th class="table-light text-uppercase text-center">Created_at</th>
                                    <th class="table-light text-uppercase text-center">Updated_at</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                    <form action="functions/edit-queue-details.php" method="post">
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
                                                <input type="hidden" class="form-control" name="edit_qd_id" id="edit_qd_id" value="">
                                                <input type="hidden" class="form-control" name="edit_client_id" id="edit_client_id" value="">

                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_queue_number" class="ps-2 pb-2">Queue Number</label>
                                                        <input type="text" class="form-control" name="edit_queue_number" id="edit_queue_number" value="" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-6 mt-3">
                                                </div>

                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_status" class="ps-2 pb-2">Status</label>
                                                        <select class="form-select" name="edit_status" id="edit_status">
                                                            <option value="0">Pending</option>
                                                            <option value="1">Completed</option>
                                                            <option value="2">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_entry" class="ps-2 pb-2">Documents</label>
                                                        <select class="form-select" name="edit_entry" id="edit_entry">
                                                            <option value="1">Passed</option>
                                                            <option value="0">Rejected</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of edit modal row -->
                                        </div>
                                        <!-- end of edit modal card body -->
                                        <!-- start of edit modal footer -->
                                        <div class="modal-footer justify-content-end">
                                            <button type="submit" name="edit_qd_all" class="btn btn-primary">Update All Status</button>
                                            <button type="submit" name="edit_qd" class="btn btn-success">Save Changes</button>
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
        <!-- ends here -->


    <script>
        $(document).ready(function() {
    function fetchQueueData() {
        $.ajax({
            url: 'fetch_queue_data_completed.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var tableBody = $('#datatable tbody');
                tableBody.empty();
                if (data.length > 0) {
                    $.each(data, function(index, row) {
                        var newRow = $('<tr>');
                        newRow.append('<td>' + row.qd_id + '</td>');
                        newRow.append('<td>' + row.client_id + '</td>');
                        newRow.append('<td>' + row.client + '</td>');
                        newRow.append('<td>' + row.queue_number + '</td>');
                        newRow.append('<td>' + row.service + '</td>');
                        
                        var statusDescription = '';
                        var statusButtonClass = '';
                        if (row.status == 0) {
                            statusDescription = 'Pending';
                            statusButtonClass = 'btn-primary';
                        } else if (row.status == 1) {
                            statusDescription = 'Completed';
                            statusButtonClass = 'btn-success';
                        } else if (row.status == 2) {
                            statusDescription = 'Cancelled';
                            statusButtonClass = 'btn-danger';
                        }
                        newRow.append('<td class="text-center"><button class="btn ' + statusButtonClass + '">' + statusDescription + '</button></td>');

                        var entryDescription = '';
                        var entryButtonClass = '';
                        if (row.entry_check == 0) {
                            entryDescription = 'Rejected';
                            entryButtonClass = 'btn-danger'
                        } else if (row.entry_check == 1) {
                            entryDescription = 'Passed';
                            entryButtonClass = 'btn-success'
                        }
                        newRow.append('<td class="text-center"><button class="btn ' + entryButtonClass + '">' + entryDescription + '</button></td>');

                        
                        newRow.append('<td>' + row.created_at + '</td>');
                        newRow.append('<td>' + row.updated_at + '</td>');
                       
                        tableBody.append(newRow);
                    });
                } else {
                    tableBody.append('<tr><td colspan="10" class="text-center">No records found.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


    $('#datatable').DataTable();

    fetchQueueData();
    setInterval(fetchQueueData, 1000);

    // Handle modal trigger
    $('body').on('click', '.edit', function(event) {
        var $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#edit_qd_id').val(data[0]);
        $('#edit_client_id').val(data[1]);
        $('#edit_name').val(data[2]);
        $('#edit_queue_number').val(data[3]);
    });
});

    </script>
</body>
</html>
