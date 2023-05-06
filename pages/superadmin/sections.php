<!doctype html>
<html lang="en">

  <?php
  include('../includes/header.php'); 
  require('../includes/config.php');


  if(isset($_POST['addbtn'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->addSec($_POST['code'],$_POST['crsName'],$_POST['yrlvl']);
  }


  if(isset($_POST['btnDel'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->delSec($_POST["idsec"]);
  }



 


  ?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <title>SUPERADMIN: Manage Sections</title>
</head>

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
                    <h2>Manage <b>Sections</b></h2>
                  </div>
                  <div class="col-sm-6">
                    <a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New</span></a>						
                  </div>
                </div>
              </div>
              <table id="tabler" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th hidden></th>
                    <th>Code</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>

                <?php
                        $sql = "SELECT sections.id_sec, sections.code_sec, courses.code_crs, year.yearlvl_yr FROM sections 
                        left JOIN courses on sections.crs_id = courses.id_crs 
                        LEFT JOIN year on sections.yrlvl_id = year.id_yr ";
                        $result = $conn->prepare($sql);
                        $result->execute();
                        
                        if($result->rowCount() > 0){
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_sec=$row["id_sec"];
                            $code_sec=$row["code_sec"];
                            $crs_id=$row["code_crs"];
                            $yrlvl_id=$row["yearlvl_yr"];
  
                            echo '
                            <form action="subjects.php" method="post">
                              <tr>
                                    <td hidden>'.$id_sec.'</td>
                                    <td name="code_sec">'.$code_sec.'</td>
                                    <td name="id_crs_fk">'.$crs_id.'</td>
                                    <td name="id_yr_fk">'.$yrlvl_id.'</td>
                                    
                                    <td>
                                      
                                      <a href="update/upd_sec.php?updid='.$id_sec.'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                      <a href="#delModal" value = '.$id_sec.' class="delBtn" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                     
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
             


          

                

                </ul>
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
                  <h4 class="modal-title">Add Section</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <div class="form-group">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Course</label>
                    <?php
                      echo '<select name="crsName" id="crs" style="width: 340px">
                      <option></option>';
              
                      $sql = "SELECT id_crs, name_crs, code_crs from courses";
                      $result = $conn->prepare($sql);
                      $result->execute();
                  
                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_crs=$row["id_crs"];
                          $name_crs=$row["name_crs"];
                          $code_crs=$row["code_crs"];
                      
                          echo '<option value= '.$id_crs.'>'.$name_crs.'</option>';
                          }
                      }

                      echo '</select>';

                    ?>
                  </div>
                  <div class="form-group">
                    <label>Year Level</label>
                    <?php
                      echo '<select name="yrlvl" id="yrlvl" style="width: 340px">
                      <option></option>';
              
                      $sql = "SELECT * from year";
                      $result = $conn->prepare($sql);
                      $result->execute();
                  
                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_yr=$row["id_yr"];
                          $yrlvl=$row["yearlvl_yr"];
                          
                      
                          echo '<option value= '.$id_yr.'>'.$yrlvl.'</option>';
                          }
                      }

                      echo '</select>';

                    ?>
                  </div>			
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-success" name="addbtn" value="Add">
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
                  <h4 class="modal-title">Delete Section</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <p>Are you sure you want to delete this record?</p>
                  <input type="hidden" name="idsec" id="idsec">
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
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>




    <script>

    //DELETE MODAL 
      $(document).ready(function () {
        $('.delBtn').on('click', function () {
        $('#delModal').modal('show');
        $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function () {
              return $(this).text();
          }).get();
          console.log(data);
          $('#idsec').val(data[0]);
        });
      });
    
    $(document).ready(function () {
    $('#tabler').DataTable({
      
      
    });
  });

</script>
  </body>
</html>


