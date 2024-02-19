<?php
    require_once '../../core/init.php';

    if(isset($_POST['edit_qd'])){
        $edit_qd_id = mysqli_real_escape_string($conn, $_POST['edit_qd_id']);
        $edit_status = mysqli_real_escape_string($conn, $_POST['edit_status']);
        $edit_entry = mysqli_real_escape_string($conn,$_POST['edit_entry']);

        if($edit_entry == 0){
            $edit_status = 2;
        }


        $sql = "UPDATE queue_details SET status = $edit_status,entry_check = $edit_entry WHERE qd_id = $edit_qd_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../queue-screen.php?edit=successful");
            exit(); // Use exit() instead of die() for consistency
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    if(isset($_POST['edit_qd_all'])){
        $edit_qd_id = mysqli_real_escape_string($conn, $_POST['edit_qd_id']);
        $edit_client_id = mysqli_real_escape_string($conn, $_POST['edit_client_id']);
        $edit_status = mysqli_real_escape_string($conn, $_POST['edit_status']);
        $edit_entry = mysqli_real_escape_string($conn,$_POST['edit_entry']);
        
        if($edit_entry == 0){
            $edit_status = 2;
        }

        $sql = "UPDATE queue_details SET status = $edit_status, entry_check = $edit_entry  WHERE client_id = $edit_client_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../queue-screen.php?edit=successful");
            exit(); // Use exit() instead of die() for consistency
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }