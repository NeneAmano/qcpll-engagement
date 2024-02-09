<?php
    require_once '../../core/init.php';

    if(isset($_POST['edit_client'])){
        $edit_qd_id = mysqli_real_escape_string($conn, $_POST['edit_qd_id']);
        $edit_entry_check = mysqli_real_escape_string($conn, $_POST['edit_entry_check']);

        if(empty($edit_qd_id) || empty($edit_entry_check)){
            echo "erro: " . mysqli_error($conn);
        }else{
            if($edit_entry_check == 'Fail'){
                $edit_entry_check = 0;
            }elseif($edit_entry_check == 'Pass'){
                $edit_entry_check = 1;
            }
            $sql = "UPDATE queue_details SET entry_check = $edit_entry_check WHERE qd_id = $edit_qd_id;";
            if(mysqli_query($conn, $sql)){
                header("location: ../queue-screen.php?edit=successful");
                exit(); // Use exit() instead of die() for consistency
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }

        }
    }