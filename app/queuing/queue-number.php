<?php 
    require_once("includes/queue-header.php");
    if(isset($_GET['queue_no'])){
        $queue_no = $_GET['queue_no'];
    }else{
        header("location: queue.php");
        die();
    }
?>
<body>
    <h1 class="text-center"><?= $queue_no; ?></h1>
</body>
</html>