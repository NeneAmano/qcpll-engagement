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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
    <?php
        require_once 'includes/sidebar.php';
    ?>
</head>
<body>
    <p>COMING SOON....</p>
</body>
</html>