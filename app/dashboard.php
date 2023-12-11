<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="container">
        <?php require_once 'includes/sidebar.php' ?>
        <?php require_once 'includes/head.php' ?>
        <!-- Main Content -->
        <main>
            <h1>Dashboard</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Total clients</h3>
                            <h1>100</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+81%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Feedback Recieve</h3>
                            <h1>100</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+81%%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Services Offered</h3>
                            <h1>4</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+100%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->

            <!-- New Users Section -->
            <div class="new-users">
                <h2>New Users</h2>
                <div class="user-list">
                    <div class="user">
                        <img src="<?= ROOT ?>/assets/images/profile-2.jpg">
                        <h2>Jack Roberto</h2>
                        <p>54 Min Ago</p>
                    </div>
                    <div class="user">
                        <img src="<?= ROOT ?>/assets/images/profile-3.jpg">
                        <h2>Amir Khan</h2>
                        <p>3 Hours Ago</p>
                    </div>
                    <div class="user">
                        <img src="<?= ROOT ?>/assets/images/profile-4.jpg">
                        <h2>Ember Drake</h2>
                        <p>6 Hours Ago</p>
                    </div>
                    <div class="user">
                        <img src="<?= ROOT ?>/assets/images/plus.png">
                        <h2>More</h2>
                        <p>New User</p>
                    </div>
                </div>
            </div>
            <!-- End of New Users Section -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Recent Feedbacks</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Queue Number</th>
                            <th>Time Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <th scope="row">Luffy</th>
                      <td>23-0732</td>
                      <td>11:59pm</td>
                      <td>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal">Details</button>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Zoro</th>
                      <td>23-0452</td>
                      <td>1:00pm</td>
                      <td>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal">Details</button>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Nami</th>
                      <td>23-0567</td>
                      <td>10:11am</td>
                      <td>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal">Details</button>
                      </td>
                    </tr>
                    </tbody>
                </table>
                <a href="feedback.php">Show All</a>
            </div>
            <!-- End of Recent Orders -->

        </main>
        <!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>How did you learn about our service?</h4>
        <ul>
          <li>Online Search [ Sa Internet ]</li>
          <li>Word of Mouth [ Kwento ng Iba ]</li>
        </ul>
        <h4>How was your experience with our services?</h4>
        <ul>
          <li>Neutral &#128578;</li>
        </ul>
        <h4>How likely are you to recommend specific services within the E-Government Section to others?</h4>
        <ul>
          <li>Excellent &#128513;</li>
        </ul>
        <h4>How satisfied are you with the response time of the E-Government Section in addressing your queries and concerns?</h4>
        <ul>
        <li>Neutral &#128578;</li>
        </ul>
        <h4>Did you find the staff in the E-Government Section
helpful and knowledgeable?</h4>
        <ul>
        <li>Neutral &#128578;</li>
        </ul>
        <h4>Did you find the information presented within the E-Government Section to be easily comprehensible?</h4>
        <ul>
        <li>Neutral &#128578;</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
                        <img src="<?= ROOT ?>/assets/images/profile-1.jpg">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="<?= ROOT ?>/assets/images/qcpl.logo.png">
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
    
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/assets/js/index.js"></script>
</body>

</html>