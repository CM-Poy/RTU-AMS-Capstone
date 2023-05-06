<!doctype html>
<html lang="en">

  <?php 
   include('../includes/header.php'); 
   require('../includes/config.php');
   session_start();
   if (!isset($_SESSION['user'])) {
     // session is not set, return false
     header("location: ../login.php");
   } 
  
   if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = false;
  }

  if(isset($_POST['addbtn'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->addSub($_POST['name'],$_POST['code'],$_POST['units']);
  }

  if(isset($_POST['btnDel'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->delSub($_POST["idsub"]);
  }

  if(!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
  }


  
  ?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <title>SUPERADMIN: Manage Subjects</title>
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
          
        <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
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
                  </style>

        </nav>
        <div class="container-xl">
          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col-sm-6">
                    <h2>Manage <b>Subjects</b></h2>
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
                    <th>Name</th>
                    <th>Code</th>
                    <th>Units</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                 	  <?php 
                        $sql = "SELECT * from subjects ";
                        $result = $conn->prepare($sql);
                        $result->execute();
                       
                        if($result->rowCount() > 0){
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_subj=$row["id_subj"];
                            $name_subj=$row["name_subj"];
                            $code_subj=$row["code_subj"];
                            $units_subj=$row["units_subj"];
  
                            echo '
                            <form action="subjects.php" method="post">
                              <tr>
                                    <td hidden>'.$id_subj.'</td>
                                    <td name="nameSubj">'.$name_subj.'</td>
                                    <td name="codeSubj">'.$code_subj.'</td>
                                    <td name="unitsSubj">'.$units_subj.'</td>
                                    <td>
                                      
                                      <a href="update/upd_sub.php?updid='.$id_subj.'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
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
          <div class="modal-dialog">
            <div class="modal-content">
              <form method = "post">
                <div class="modal-header">						
                  <h4 class="modal-title">Add Subject</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">	
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Units</label>
                    <input type="text" name="units" class="form-control" required>
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



        <!-- Delete Modal HTML -->
        <div id="delModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post">
                <div class="modal-header">						
                  <h4 class="modal-title">Delete Schedule</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                  <p>Are you sure you want to delete this record?</p>
                  <input type="hidden" name="idsub" id="idsub">
                  <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-danger"  name="btnDel" value="Delete">
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
          $('#idsub').val(data[0]);
        });
      });
      $(document).ready(function () {
    $('#tabler').DataTable({
      
      
    });
});
    </script>



  </body>
</html>

<script>

window.addEventListener('load', function() {
  // Get the current page URL
  var currentUrl = window.location.href;
  
  // Change the URL to the desired format
  var newUrl = currentUrl + '?rtuams-table-subj=cmqrmsjmdere';
  window.history.pushState({ path: newUrl }, '', newUrl);
});
</script>


