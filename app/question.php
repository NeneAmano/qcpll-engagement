<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<div class="container">
        <?php require_once 'includes/sidebar.php' ?>
        <?php require_once 'includes/head.php' ?>
        <!-- Main Content -->
        <main>
            <h1>Feedback Questionnaire</h1>
            <!-- Analyses -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">Add Questionnaire</button>
            <br>
            <br>
            <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Time Added</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>keme keme keme?</td>
      <td>1:35am 11/22/2023</td>
      <td>
      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">Edit</button>
      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Delete</button>
      </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Pogi kaba?</td>
      <td>1:35am 11/22/2023</td>
      <td>
      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">Edit</button>
      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Delete</button>
      </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Ayus ba tayo dyan?</td>
      <td>1:35am 11/22/2023</td>
      <td>
      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">Edit</button>
      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Delete</button>
      </td>
    </tr>
  </tbody>
</table>

        </main>
        <!-- End of Main Content -->

 <!-- Add Modal -->
 <div class="modal" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Question</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Edit form goes here -->
        <form>
          <div class="form-group">
            <label for="editName">Title</label>
            <input type="text" class="form-control" id="editName">
            
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
        <h4 class="modal-title">Edit Question</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Edit form goes here -->
        <form>
          <div class="form-group">
            <label for="editName">Title</label>
            <input type="text" class="form-control" id="editName">
              
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
        <h4 class="modal-title">Delete Question</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <p>Are you sure you want to delete this service?</p>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>

        <?php require_once 'includes/rightsection.php' ?>
    </div>
    
  
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>