<?php
    require_once('../core/init.php');
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
    <title>Dashboard</title>
    <?php
        require_once 'includes/sidebar.php';
    ?>
    <div class="container-fluid mt-3 bg-danger">
        <p>test</p>
    </div>
    <?php
        require_once 'includes/scripts.php';
    ?>