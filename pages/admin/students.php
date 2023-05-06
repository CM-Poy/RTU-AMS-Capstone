<!doctype html>
<html lang="en">

  <?php
  include('../includes/header.php'); 
  require('../includes/config.php');

  if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = false;
  }


  if(isset($_POST['addbtn'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->addStd($_POST['flname'],$_POST['email'],$_POST['studnum'],$_POST['gflname'],$_POST['gemail'],$_POST['crsNameStd'],$_POST['yrLvlStd'],$_POST['sectNameStd'],);
  }

  if(isset($_POST['updbtn'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->updStd($_REQUEST['updid'],$_POST['flname'] , $_POST['email'] , $_POST['studnum'] , $_POST['gflname'] , $_POST['gemail'] , $_POST['crs'] , $_POST['yr'] , $_POST['sec']);
  }


  if(isset($_POST['btnDel'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->delStd($_POST['idstd']);
  } 

 
 


 


 






  ?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>ADMIN: Manage Students</title>
</head>
<script>
  if (window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
  }
</script>
  <body>

  <!--sidebar-->

  <div class="wrapper d-flex align-items-stretch  fixed-side">
            <nav id="sidebar">
                <div class="link p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(../../images/rtu-logo.png);"></a>
                <ul class="list-unstyled components mb-5">
              <li class="">
                <a href="teachers.php" >&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-user fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>TEACHERS</a>
              <li class="">
                <a href="schedules.php" >&nbsp;&nbsp;&nbsp;<i class="fa fa-file-text fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>SCHEDULES</a>
              </li>
              <li>
              <a href="students.php" >&nbsp;&nbsp;<i class="fa fa-users fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;</i>STUDENTS</a>
              </li>
            </ul>


          </div>
        </nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
          
        <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
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
                    <a class="nav-link" href="../login.php" id="logout">Logout</a>
                </li>
              </ul>
            </div>
          </div>
              <!-- StickyNavBAR-->
          <script>
                // When the user scrolls the page, execute myFunction
                    window.onscroll = function() {myFunction()};

                    // Get the navbar
                    var navbar = document.getElementById("navbar");

                    // Get the offset position of the navbar
                    var sticky = navbar.offsetTop;

                    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
                    function myFunction() {
                      if (window.pageYOffset >= sticky) {
                        navbar.classList.add("sticky")
                      } else {
                        navbar.classList.remove("sticky");
                      }
                    }
            </script>
              <!-- ENDStickyNavBAR-->
                  <style>
                      /*StickyNAVBAR*/
                        /* The sticky class is added to the navbar with JS when it reaches its scroll position */
                        .sticky {
                          position: fixed;
                          top: 0px;
                          width:79.2%;
                        }

                        /* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
                        .sticky + #content {
                          padding-top: 60px;
                        }
                        #navbar{
                          z-index: 900;
                        }
                        @media (max-width: 425px) {
                          #navbar  {
                            min-width:90%;
                          } 

                        }
                        /*END StickyNAVBAR*/
                        /*StickySIDEBAR*/
                        .link{
                          position: -webkit-sticky;
                          position: sticky;
                          top: 0;}
                        /*EndStickySIDEBAR*/
                  </style>
        </nav>
    
       
       


        <div class="container-xl">
          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col-sm-6">
                    <h2>Manage <b>Students</b></h2>
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
                    <th hidden>ID</th>
                    <th>Full Name</th>
                    <th>Institutional Email</th>
                    <th>Student Number</th>
                    <th>Guardian Full Name</th>
                    <th>Guardian Email</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Year Level</th>
                    
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  				
                <?php
                
                         $sql = "SELECT students.id_std, students.flname_std, students.instemail_std, students.studnum_std, students.gflname_std, students.gemail_std, students.qrcode_std, sections.code_sec, courses.code_crs, year.yearlvl_yr FROM students
                         LEFT JOIN courses on students.crs_id = courses.id_crs
                         left join year on students.yrlvl_id = year.id_yr
                         left join sections on students.sec_id = sections.id_sec";
                        $result = $conn->prepare($sql);
                        $result->execute();

                        if($result->rowCount() > 0)
                  {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                      $id_std=$row["id_std"];
                      $flname_std=$row["flname_std"];
                      $instemail_std=$row["instemail_std"];
                      $studnum_std=$row["studnum_std"];
                      $gflname_std=$row["gflname_std"];
                      $gemail_std=$row["gemail_std"];
                      $crs_id=$row["code_crs"];
                      $yrlvl_id=$row["yearlvl_yr"];
                      $sect_id=$row["code_sec"];
                      $qrcode=$row['qrcode_std'];

           
                      
                      echo '
                      <form method="post" action="students.php">
                        <tr>
                        <td hidden>'.$id_std.'</td>
                          <td>'.$flname_std.'</td>
                          <td>'.$instemail_std.'</td>
                          <td>'.$studnum_std.'</td>
                          <td>'.$gflname_std.'</td>
                          <td>'.$gemail_std.'</td>
                          <td>'.$crs_id.'</td>
                          <td>'.$sect_id.'</td>
                          <td>'.$yrlvl_id.'</td>
                          
                          
                          <td>

                          <a href="qrcode/showqr.php?qrid='.$id_std.'"><i class="material-icons " data-toggle="tooltip" title="QR-Code">&#xe3f4;</i></a>
                          <a href="update/upd_std.php?updid='.$id_std.'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#delModal" class="delBtn"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>

                          </td>
                      </tr>
                      </form>';
                    }
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
                  <h4 class="modal-title">Add Student</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="dialog">					
                  <div>
                    <label>Full Name</label>
                    <input type="text" name="flname" class="form-control" required>
                  </div>
                  <div>
                    <label>Institutional Email</label>
                    <input type="email" name="email" class="form-control" required>
                  </div>
                  <div>
                    <label>Student Number</label>
                    <input name="studnum" class="form-control" required></textarea>
                  </div>
                  <div>
                    <label>Guardian Full Name</label>
                    <input type="text" name="gflname" class="form-control" required>
                  </div>			
                  <div>
                    <label>Guardian Email</label>
                    <input type="email" name="gemail" class="form-control" required>
                  </div>	  
                  <div class="form-group">
                    <label>Course</label>
                   

                    <?php
                      echo '<select name="crsNameStd" id="crs" style="width: 340px">
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

                      echo '<select name="yrLvlStd" id="yrlvl" style="width: 340px">
                      <option></option>';

                      $sql = "SELECT id_yr, yearlvl_yr from year";
                      $result = $conn->prepare($sql);
                      $result->execute();

                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_yr=$row["id_yr"];
                          $yearlvl_yr=$row["yearlvl_yr"];

                          
                          echo'<option value= '.$id_yr.' >'.$yearlvl_yr.'</option>';
                          }
                      }

                      echo '</select>';
                    ?>

                  </div>			
                  <div class="form-group">
                    <label>Section</label>
                   
                    <?php
                        echo '<select name="sectNameStd" id="sect" style="width: 340px">
                        <option></option>';
                        
                        $sql = "SELECT * from sections";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_sect=$row["id_sec"];
                        
                            $code_sect=$row["code_sec"];
                        
                            echo '<option value= '.$id_sect.'>'.$code_sect.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>


                  </div>						
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" name="addbtn" class="btn btn-success" value="Add">
                </div>
              </form>
            </div>
          </div>
        </div>







        <!-- Edit Modal HTML -->
        <div id="editModal" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content">
              <form method="post">
              <input type="text" class="form-control" id = "id" hidden>
                <div class="modal-header">						
                  <h4 class="modal-title">Edit Student</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <div>
                 
                    <label>Full Name</label>
                    <input type="text" name="flname" id = "flname" class="form-control" required>
                  </div>
                  <div>
                    <label>Institutional Email</label>
                    <input type="email" name="email" id = "email" class="form-control" required>
                  </div>
                  <div>
                    <label>Student Number</label>
                    <input name="studnum" name = "studnum" id = "studnum" class="form-control" required></textarea>
                  </div>
                  <div>
                    <label>Guardian Full Name</label>
                    <input type="text" name="gflname" id = "gflname" class="form-control" required>
                  </div>			
                  <div>
                    <label>Guardian Email</label>
                    <input type="email" name="gemail" id = "gemail" class="form-control" required>
                    
                  </div>	  
                  <div class="form-group">
                    <label>Course</label>
                    <?php
                      echo '<select name="crs" id="crs" style="width: 340px" class="form-control" required>
                      <option></option>';
                      
                      $sql = "SELECT id_crs, name_crs, code_crs from courses";
                      $result = $conn->prepare($sql);
                      $result->execute();
                  
                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_crs=$row["id_crs"];
                          $name_crs=$row["name_crs"];
                      
                          echo '<option value= '.$id_crs.'>'.$name_crs.'</option>';
                          }
                      }

                      echo '</select>';
                    ?>

                  </div>			
                  <div class="form-group">
                    <label>Year Level</label>

                    <?php

                      echo '<select name="yrlvl" id="yrlvl" style="width: 340px" class="form-control" required>
                      <option></option>';

                      $sql = "SELECT id_yr, yearlvl_yr from year";
                      $result = $conn->prepare($sql);
                      $result->execute();

                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_yr=$row["id_yr"];
                          $yearlvl_yr=$row["yearlvl_yr"];

                          
                          echo'<option value= '.$id_yr.' >'.$yearlvl_yr.'</option>';
                          }
                      }

                      echo '</select>';
                    ?>

                  </div>			
                  <div class="form-group">
                    <label>Section</label>
                    <?php
                      echo '<select name="sect" id="sect" style="width: 340px" class="form-control" required>
                      <option></option>';

                      $sql = "SELECT * from sections";
                      $result = $conn->prepare($sql);
                      $result->execute();

                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_sec=$row["id_sec"];
                          $code_sec=$row["code_sec"];

                          
                          echo'<option value= '.$id_sec.' >'.$code_sec.'</option>';
                          }
                      }

                      echo '</select>';
                    ?>

                  </div>						
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" value="<?php echo $id_std; ?>">  
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-info" name="updbtn" value="Save">
                  
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
                <input type="hidden" name="idstd" id="idstd">							
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
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>



    <script>

      //EDIT MODAL 
        $(document).ready(function () {
          
            $('.delBtn').on('click', function () {
              $('#delModal').modal('show');
              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#idstd').val(data[0]);
            });
        });
      
    
   
        $(document).ready(function () {
    $('#tabler').DataTable({
      
      
    });
});
      
      
   
    $(document).ready(function(){
      // Activate tooltip
      $('[data-toggle="tooltip"]').tooltip();
      
     
    });
  
</script>

  </body>
</html>


