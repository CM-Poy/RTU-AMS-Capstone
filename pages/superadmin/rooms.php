<!doctype html>
<html lang="en">

  <?php
  include('../includes/header.php'); 
  require('../includes/config.php');


  if(isset($_POST['addbtn'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->addRoom($_POST["bldg"],$_POST["code"]);
  }

  if(isset($_POST['btnDel'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->delRoom($_POST["idroom"]);
  }




  ?>
  

  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <title>SUPERADMIN: Manage Rooms</title>
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
                    <h2>Manage <b>Rooms</b></h2>
                  </div>
                  <div class="col-sm-6">
                    <a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New</span></a>					
                  </div>
                </div>
              </div>
              <table id = "tabler" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th hidden></th>
                    <th>Code</th>
                    <th>Building</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                 
                <?php
                        $sql = "SELECT room.id_room, room.code_room, building.name_bldg from room LEFT JOIN building on room.bldg_id = building.id_bldg";
                        $result = $conn->prepare($sql);
                        $result->execute();
                        
                        if($result->rowCount() > 0){
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_room=$row["id_room"];
                            $code_room=$row["code_room"];
                            $bldg_id=$row["name_bldg"];
                            
  
                            echo '
                            <form method="post">
                              <tr>
                                <td hidden>'.$id_room.'</td>
                                <td name="name_dept">'.$code_room.'</td>
                                <td name="code_dept">'.$bldg_id.'</td>
                                
                                <td>
                                  <a href="update/upd_rooms.php?updid='.$id_room.'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                  <a href="#delModal"  class="delBtn" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post">
                <div class="modal-header">						
                  <h4 class="modal-title">Add Department</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <div class="form-group">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Building</label>
                    <?php
                      echo '<select id="bldg" name="bldg" style="width: 340px" required>
                      <option></option>';
              
                      $sql = "SELECT * from building";
                      $result = $conn->prepare($sql);
                      $result->execute();
                  
                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_dept=$row["id_bldg"];
                          $name_dept=$row["name_bldg"];
                          $code_dept=$row["code_bldg"];
                      
                          echo '<option value= '.$id_dept.'>'.$name_dept.'</option>';
                          }
                      }

                      echo '</select>';
                    ?>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-success" name = "addbtn" value="Add">
                </div>
              </form>
            </div>
          </div>
        </div>


        <!-- Delete Modal HTML -->
        <div id="delModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post">
                <div class="modal-header">						
                  <h4 class="modal-title">Delete Student</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <input type="text" name="idroom" id="idroom">							
                  <p>Are you sure you want to delete this record?</p>
                  <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <button type="submit" class="btn btn-danger" name="btnDel">DELETE</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      
      
      </div>
    </div>
        
  </body>
</html>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


    <script>

      
        $(document).ready(function () {

          $('.delBtn').on('click', function () {
              $('#delModal').modal('show');
              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#idroom').val(data[0]);
            });
        });
        $(document).ready(function () {
    $('#tabler').DataTable({
      
      
    });
});


    </script> 


