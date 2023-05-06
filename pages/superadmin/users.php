<!doctype html>
<html lang="en">

<?php 

  include('../includes/header.php'); 
  require('../includes/config.php');

  if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = false;
  }

  

  
  if(isset($_POST['addbtnSA'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->addUserSupAdmin($_POST["hnr"],$_POST["name"],$_POST["email"],$_POST["empnum"],$_POST["pwd"],$_POST["usertype"]);
  }
  if(isset($_POST['btnDel'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->delUserSuperAdmin($_POST["idusers"]);
  }

  

?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <title>SUPERADMIN: Manage Teachers</title>
</head>
<script>
  if (window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
  }
</script>
  <body>

  <!--sidebar-->

  <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar">
                <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(../../images/rtu-logo.png);"></a>
                <ul class="list-unstyled components mb-5">
              <li class="">
                <a href="users.php" >&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-user fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>USERS</a>
              <li class="">
                <a href="schedules.php" >&nbsp;&nbsp;&nbsp;<i class="fa fa-file-text fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>SCHEDULES</a>
              </li>
              <li>
              <a href="students.php" >&nbsp;&nbsp;<i class="fa fa-users fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;</i>STUDENTS</a>
              </li>
              <li>
              <a href="sections.php" >&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-th-large fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>SECTIONS</a>
              </li>
              <li>
              <a href="subjects.php" >&nbsp;&nbsp;&nbsp;<i class="fa fa-book fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>SUBJECTS</a>
              </li>
              <li>
               <a href="departments.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-building fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>DEPARTMENTS</a>  
              </li>
              <li>
               <a href="courses.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-folder-open fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>COURSES</a>
              </li>
              <li>
               <a href="buildings.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-building fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>BUILDINGS</a>  
              </li>
              <li>
               <a href="rooms.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-building fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>ROOMS</a>  
              </li>
            </ul>


          </div>
        </nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
          
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>

            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="nav-link font-weight-bold text-justify" id="page-title">ATTENDANCE MANAGEMENT SYSTEM - SUPERADMIN</a> 
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" href="../login.php">Logout</a>
                </li>
              </ul>
            </div>
          </div>
            
        </nav>
  


        <div class="container-xl">
          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col-sm-6">
                    <h2>Manage <b>Users</b></h2>
                  </div>
                  <div class="col-sm-6">
                    <a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New</span></a>
                  </div>
                </div>
              </div>
              <?php if ($_SESSION['error']): ?>
                <div class="alert alert-danger" role="alert" >
                    <center><strong><?php echo $_SESSION['error'];?></strong><center>
                </div>
                <?php   
                    $_SESSION['error'] = false;
                ?>
              <?php endif ?>
              <table id="tabler" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th hidden></th>
                    <th>Full Name</th>
                    <th>Honoriffic</th>
                    <th>Institutional Email</th>
                    <th>Employee Number</th>
                    <th>Password</th>
                    <th>Usertype</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  
                <?php
                        $sql = "SELECT users.id_users, users.hnr_users, users.flname_users, users.instemail_users, users.empnum_users, usertype.usertype, users.usertype_users, users.pwd_users FROM users
                        LEFT JOIN usertype ON users.usertype_users = usertype.id_usertype where users.usertype_users<3";
                        $result = $conn->prepare($sql);
                        $result->execute();
                       
                        if($result->rowCount() > 0){
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_users=$row["id_users"];
                            $hnr_users=$row["hnr_users"];
                            $flname_users=$row["flname_users"];
                            $instemail_users=$row["instemail_users"];
                            $empnum_users=$row["empnum_users"];
                            $pwd_users=$row["pwd_users"];
                            $usertype_users=$row["usertype"];
  
                            echo '
                            <form action="subjects.php" method="post">
                              <tr>
                                    <td hidden>'.$id_users.'</td>
                                    <td>'.$flname_users.'</td>
                                    <td>'.$hnr_users.'</td>
                                    <td>'.$instemail_users.'</td>
                                    <td>'.$empnum_users.'</td>
                                    <td>'.$pwd_users.'</td>
                                    <td>'.$usertype_users.'</td>
                                    <td>
                                      
                                    <a href="update/upd_users.php?updid='.$id_users.'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                      <a href="#delModal" class="delBtn" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                     
                                    </td>
                            </tr>
                            </form>';
                          }
                        }else{
                          echo "No Record Found";
                        }
                    ?>

                </tbody>
              </table>
             
              </div>
            </div>
          </div>        
        </div>



        <!-- Add Modal HTML -->
        <div id="addModal" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content">
              <form method="post">
              <input type="text" class="form-control" name="addid" hidden>
                <div class="modal-header">						
                  <h4 class="modal-title">Add Teacher</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control"name="name" required>
                  </div>
                  <div class="form-group">
                    <label>Honoriffic</label>
                    <input type="text" class="form-control"name="hnr" required>
                  </div>
                  <div class="form-group">
                    <label>Institutional Email</label>
                    <input type="email" class="form-control"name="email" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control"name="pwd"  required>
                  </div>
                  <div class="form-group">
                    <label>Employee Number</label>
                    <input type="text" class="form-control"name="empnum"  required>
                  </div>
                  <div class="form-group">
                    <label>Usertype</label>
                    <?php
                        echo '<select name="usertype" style="width: 340px">
                        <option></option>';
                        
                        $sql = "SELECT * from usertype where id_usertype < 3";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_usertype=$row["id_usertype"];
                        
                            $usertype=$row["usertype"];
                        
                            echo '<option value= '.$id_usertype.'>'.$usertype.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>

                  </div>					
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-success" name="addbtnSA" value="Add">
                </div>
              </form>
            </div>
          </div>
        </div>



        <!-- Delete Modal HTML -->
        <div id="delModal" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content">
              <form method=post>
                <div class="modal-header">						
                  <h4 class="modal-title">Delete Teacher</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <p>Are you sure you want to delete these Records?</p>
                  <input type="hidden" name="idusers" id="idusers">
                  <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-danger" name="btnDel" value="Delete">
                </div>
              </form>
            </div>
          </div>
        </div>
        

      </div>
    </div>
</form>
</body>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</html>
<script>

$(document).ready(function () {

$('.delBtn').on('click', function () {
  $('#delModal').modal('show');
  $tr = $(this).closest('tr');

  var data = $tr.children("td").map(function () {
        return $(this).text();
    }).get();

    console.log(data);
    $('#idusers').val(data[0]);
});



});



        $(document).ready(function(){
      // Activate tooltip
      $('[data-toggle="tooltip"]').tooltip();
      
    });
    $(document).ready(function () {
    $('#tabler').DataTable({
      
      
    });
});
$(document).ready(function () {
        $('.delBtn').on('click', function () {
        $('#delModal').modal('show');
        $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function () {
              return $(this).text();
          }).get();
          console.log(data);
          $('#idusers').val(data[0]);
        });
      });
        

    </script>