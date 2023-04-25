<!doctype html>
<html lang="en">

<?php 

  include('../includes/header.php'); 
  require('../includes/config.php');

  


 

  if(isset($_POST['addbtnSA'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->addUserSupAdmin($_POST["hnr"],$_POST["name"],$_POST["email"],$_POST["empnum"],$_POST["pwd"],$_POST["usertype"]);
  }

  if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
    $page_no = $_GET['page_no'];
  }else{
    $page_no = 1;
  }

  //total num rows to display
  $total_records_perpage = 10;
  //getting offset for for limit query
  $offset = ($page_no - 1) * $total_records_perpage;
  //previous page
  $previous_page = $page_no - 1;
  //next page
  $next_page = $page_no + 1;

  //getting the total number of records
  $sql = "SELECT * from users";
  $totalnumrecords = $conn->prepare($sql); 
  $totalnumrecords->execute();
  //total records
  $result_totalnumrecords=$totalnumrecords->rowCount();
  //total pages
  $total_numpages = ceil($result_totalnumrecords/$total_records_perpage);

?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <title>SUPERADMIN: Manage Teachers</title>
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
            <a class="nav-link font-weight-bold text-justify" id="page-title">ATTENDANCE MANAGEMENT SYSTEM - ADMIN</a> 
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
                    <h2>Manage <b>Teachers</b></h2>
                  </div>
                  <div class="col-sm-6">
                    <a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New</span></a>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
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
                        LEFT JOIN usertype ON users.usertype_users = usertype.id_usertype LIMIT $offset, $total_records_perpage";
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
                                    <td>'.$flname_users.'</td>
                                    <td>'.$hnr_users.'</td>
                                    <td>'.$instemail_users.'</td>
                                    <td>'.$empnum_users.'</td>
                                    <td>'.$pwd_users.'</td>
                                    <td>'.$usertype_users.'</td>
                                    <td>
                                      
                                      <a href="#editModal" value = '.$id_users.' class="editBtn" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                      <a href="#delModal" value = '.$id_users.' class="delBtn" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                     
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
              <div class="clearfix">
                <div class="hint-text">
                  Showing <b><?php echo $page_no; ?></b> of <b><?php echo $total_numpages; ?></b> pages.
                </div>
                <ul class="pagination">

                  <li class="page-item"><a  class="page-link <?= ($page_no <=1) ? 'disabled' : ''; ?> " <?= ($page_no > 1) ? 'href=? page_no=' .$previous_page : ''; ?>>Previous</a></li>


                  
                  <?php for($counter = 1; $counter <= $total_numpages; $counter ++){ ?>
                    
                    <?php if ($page_no != $counter){?>
                      <li class="page-item"><a class="page-link" href="?page_no=<?=$counter; ?>"><?=$counter; ?></a></li>
                    <?php }else{ ?> 
                      <li class="page-item"><a class="page-link active"><?=$counter; ?></a></li>
                    <?php } ?>
                   <?php } ?>


          

                  <li class="page-item"><a  class="page-link <?= ($page_no >= $total_numpages) ? 'disabled' : '' ; ?>" <?= ($page_no < $total_numpages) ? 'href=?page_no=' . $next_page : ''; ?>>Next</a></li>

                </ul>
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

                  <input type="text" class="form-control"name="pwd" hidden>

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




        <!-- Edit Modal HTML -->
        <div id="editModal" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content">
            <form method= "post">
              <input type="text" class="form-control" name="id" id="id"hidden>
                <div class="modal-header">						
                  <h4 class="modal-title">Edit Teacher</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" name="name" id="name"required>
                  </div>
                  <div class="form-group">
                    <label>Honoriffic</label>
                    <input type="text" class="form-control" name="hnr" id="hnr"required>
                  </div>
                  <div class="form-group">
                    <label>Institutional Email</label>
                    <input type="email" class="form-control" name="email" id="email"required>
                  </div>
                  <div class="form-group">
                    <label>Employee Number</label>
                    <input type="text" class="form-control" name="empnum" id="empnum" required>
                  </div>	
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="pwd" id="pwd" required>
                  </div>
                  <div class="form-group">
                    <label>Usertype</label>

                      <?php
                        echo '<select name="usertype" id="usertype" style="width: 340px">
                        ';
                        
                        $sql = "SELECT * from usertype";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_usertype=$row["id_usertype"];
                        
                            $usertype=$row["usertype"];
                        
                            echo '<option value= '.$usertype.'>'.$usertype.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>

                  </div>					
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-success" name="updBtn" value="Update">
                </div>
            </form>
            </div>
          </div>
        </div>




        <!-- Delete Modal HTML -->
        <div id="delModal" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content">
              <form>
                <div class="modal-header">						
                  <h4 class="modal-title">Delete Teacher</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <p>Are you sure you want to delete these Records?</p>
                  <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-danger" value="Delete">
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
</html>
<script>

      //EDIT MODAL 
        $(document).ready(function () {

            $('.editBtn').on('click', function () {

                $('#editModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id').val(data[0]);
                $('#name').val(data[1]);
                $('#hnr').val(data[2]);
                $('#email').val(data[3]);
                $('#empnum').val(data[4]);
                $('#pwd').val(data[5]);
                $('#usertype').val(data[6]);


          
            });
        });



        $(document).ready(function(){
      // Activate tooltip
      $('[data-toggle="tooltip"]').tooltip();
      
      // Select/Deselect checkboxes
      var checkbox = $('table tbody input[type="checkbox"]');
      $("#selectAll").click(function(){
        if(this.checked){
          checkbox.each(function(){
            this.checked = true;                        
          });
        } else{
          checkbox.each(function(){
            this.checked = false;                        
          });
        } 
      });
      checkbox.click(function(){
        if(!this.checked){
          $("#selectAll").prop("checked", false);
        }
      });
    });

    </script>