<!-- favicon -->
<link rel="icon" href="../../resources/images/favicon.ico" type="image/x-icon">
    <!-- jquery datatable css cdn -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <!-- font-awesome cdn -->
    <script src="https://kit.fontawesome.com/3481525a72.js" crossorigin="anonymous"></script>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../../public/assets/css/style-admin.css">
    <!-- cdn of chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- start of main container -->
    <div class="main-container d-flex">
        <!-- start of sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="header-box px-2 pt-3 pb-2 d-flex justify-content-around">
                    
                <h1 class="fs-4"><a href="dashboard.php" class="text-decoration-none"><span class="bg-white text-dark rounded shadow px-2 me-2 p-1 fs-6">Quezon City</span><span class="text-white fs-6">Public Library</span></a></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <div class="d-flex mt-1 ps-2 pb-1">
                    <img class="text-white rounded-circle" src="../../public/assets/images/qclogo.jpg" alt="" style="width: 20%; height: 30%;">
                    <li class="px-3 py-2 d-block text-white">Admin</li>
                </div>
                <div class="text-white">
                    <hr class="mx-2">
                </div>
                        <li class=""><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"></i> Dashboard</a></li>

                        <li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i><span class="ps-2">Users</span></a></li>
                        <li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i><span class="ps-2">Clients</span></a></li>
                        <li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i><span class="ps-2">History</span></a></li>
                        <li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i><span class="ps-2">Analytics</span></a></li>
                        <li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i><span class="ps-2">Feedbacks</span></a></li>
                        <li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i><span class="ps-2">Questions</span></a></li>
                        <li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i><span class="ps-2">Reports</span></a></li>
                        <li class=""><a href="user.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-user"></i><span class="ps-2">Queuing</span></a></li>



                        <li class=""><a href="appointment.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-regular fa-calendar-days"></i></i> Appointments</a></li>

                        <li class=""><a href="category.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-dog"></i> Categories</a></li>
                        <li class=""><a href="service.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-syringe"></i> Services</a></li>

                    
                        <div class="text-white">
                            <hr class="mx-2">
                        </div>
            </ul>
            <ul class="list-unstyled px-2">
                <li class=""><a href="includes/logout.inc.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-right-from-bracket"></i> Log out</a></li>
            </ul>
        </div>
        <!-- end of sidebar -->

        <div class="content">
            <!-- start of navbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <a class="navbar-brand fs-4" href="#">Online Shop</a>
                        <button class="btn px-1 py-0 open-btn"><i class="fa-solid fa-bars-staggered"></i></button>
                    </div>
                    
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end me-5" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        // if(isset($_SESSION['user_id'])){
                                        //     $sql = "SELECT * FROM users WHERE user_id = 4;";
                                        //     $result = mysqli_query($conn, $sql);
                                        //     if(mysqli_num_rows($result) > 0){
                                        //         while($row = mysqli_fetch_assoc($result)){
                                        //             $username = $row['username'];
                                        //         }
                                        //     }
                                        // }
                                        echo 'Admin';
                                        ?>
                                </a>
                                <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item bg-dark text-white admin-dropdown" href="change-password.php">Change Password</a></li>
                                    <li><a class="dropdown-item bg-dark text-white admin-dropdown" href="includes/logout.inc.php">Log out</a></li>
                                </ul>
                            </li>
                            <!-- to create invisible space after the dropdown -->
                            <li class="me-5"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- end of navbar -->