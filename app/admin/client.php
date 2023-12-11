<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="container">
        <?php require_once 'includes/sidebar.php' ?>
        <?php require_once 'includes/head.php' ?>
        
        <!-- Main Content -->
        <main>
          
            <h1>Clients</h1>
            <!-- Analyses -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Daily</button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Weekly</button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Monthly</button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Annually</button>
<br>
<br>
<br>
<div class="container" style="display: flex;">
    <div class="row">    
        <div class="col-xs-8 col-xs-offset-2">
		    <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#contains">Fullname</a></li>
                      <li><a href="#its_equal">Age</a></li>
                      <li><a href="#greather_than">Gender</a></li>
                      <li><a href="#less_than">Occupation</a></li>
                      <li><a href="#less_than">Educational Attainment</a></li>
                      <li><a href="#less_than">Purpose Of Visiting</a></a></li>
                      <li><a href="#less_than">Time-In</a></a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param" style="width: 100%;">         
                <input type="text" class="form-control" name="x" placeholder="Search here.." >
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
	</div>
</div>
<br>


            <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Fullname</th>
      <th scope="col">Age</th>
      <th scope="col">Gender</th>
      <th scope="col">Occupation</th>
      <th scope="col">Educational Attainment</th>
      <th scope="col">Time-In</th>
      <th scope="col">Time-Out</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark Hera</td>
      <td>22-35</td>
      <td>Male</td>
      <td>Student</td>
      <td>High School Level</td>
      <td>11:57am 11/21/2023</td>
      <td>1:00pm 11/21/2023</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>James Bon</td>
      <td>36-59</td>
      <td>Male</td>
      <td>Retired</td>
      <td>College Degree</td>
      <td>11:57am 11/21/2023</td>
      <td>1:00pm 11/21/2023</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Jacob Galang</td>
      <td>13-21</td>
      <td>Male</td>
      <td>Employed</td>
      <td>High School Graduate</td>
      <td>11:57am 11/21/2023</td>
      <td>1:00pm 11/21/2023</td>
    </tr>
  </tbody>
</table>


<br>
<br>
<h1>PURPOSE OF VISITING</h1>
<table class="table">
  <thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Queue Number</th>
    <th scope="col">Purpose of Visiting</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>23-422</td>
      <td>NBI</td>
    </tr>
    <tr>
    <th scope="row">1</th>
      <td>23-424</td>
      <td>POLICE CLEARANCE</td>
    </tr>
  </tbody>
</table>
        </main>
        <!-- End of Main Content -->

         <!-- Right Section -->
         <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Admin</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./assets/images/profile-1.jpg">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="./assets/images/qcpl.logo.png">
                    <h2>EngageMate</h2>
                    <p>Web-based KIOSK</p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <h2>Recent History</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                        notifications_none
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Users change questions</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            delete
                        </span>
                    </div>
                </div>

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                          notifications_none
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Users logIn</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            delete
                        </span>
                    </div>
                </div>


            </div>

        </div>
    </div>

    <!-- Add Modal -->
<div class="modal" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Edit form goes here -->
        <form>
          <div class="form-group">
            <label for="editName">Username:</label>
            <input type="text" class="form-control" id="editName">
            <label for="editName">Password:</label>
            <input type="text" class="form-control" id="editName">
              <br>
            <select class="form-select" aria-label="Default select example">
              <option selected>Specify Role</option>
              <option value="1">Admin</option>
              <option value="2">Staff</option>
            </select>
          </div>
          <br>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

    
<!-- Edit Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Edit form goes here -->
        <form>
          <div class="form-group">
            <label for="editName">Name:</label>
            <input type="text" class="form-control" id="editName">
              <br>
            <select class="form-select" aria-label="Default select example">
              <option selected>Specify Role</option>
              <option value="1">Admin</option>
              <option value="2">Staff</option>
            </select>
          </div>
          <br>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <p>Are you sure you want to delete this record?</p>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>

    <?php
        require_once 'includes/scripts.php';
    ?>
</body>
</html>