<!doctype html>
<html lang="en">

  <?php

  include('../includes/header.php');  
  require('../includes/config.php');

  if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = false;
  }
  

  if(isset($_POST['btnDel'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->delSchd($_POST['idschd']);
  }

  
  
  

 
  ?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>ADMIN: Manage Schedules</title>
</head>

  <body>

  <!--sidebar-->

  <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar">
                <div class="p-4 pt-5">
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
              <li>
              <a href="enroll.php" >&nbsp;&nbsp;<i class="fa fa-add fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;</i>ENROLL</a>
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
                    <h2>Enroll <b>Students</b> or <b>Section</b></h2>
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
              <table id= "tabler" class="table table-striped table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th hidden></th>
                    <th>Full Name</th>
                    <th>Subject</th>
                    <th>Section</th>
                    <th>Day</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Room</th>
                    <th>View Students</th>
                    <th>Enroll</th>
                  </tr>
                </thead>
                <tbody>
                 
                <?php
                      
                       $sql = "SELECT schedules.id_schd, users.flname_users, subjects.code_subj, sections.code_sec, schedules.day_schd, schedules.strtime_schd, schedules.endtime_schd, room.code_room from schedules left join users on schedules.user_id = users.id_users LEFT JOIN subjects on schedules.sub_id = subjects.id_subj LEFT JOIN sections on schedules.sec_id = sections.id_sec LEFT JOIN room on schedules.room_id = room.id_room ";
                       $result = $conn->prepare($sql);
                       $result->execute();
                       
                       if($result->rowCount() > 0){
                         while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                           $id_schd=$row["id_schd"];
                           $user_id=$row["flname_users"];
                           $sub_id=$row["code_subj"];
                           $sec_id=$row["code_sec"];
                           $day=$row["day_schd"];
                           $strtime=$row["strtime_schd"];
                           $endtime=$row["endtime_schd"];
                           $room_id=$row["code_room"];
                            echo '
                            <forM method="post">
                              <tr>
                                    <td hidden>'.$id_schd.'</td>
                                    <td>'.$user_id.'</td>
                                    <td>'.$sub_id.'</td>
                                    <td>'.$sec_id.'</td>
                                    <td>'.$day.'</td>
                                    <td>'.$strtime.'</td>
                                    <td>'.$endtime.'</td>
                                    <td>'.$room_id.'</td>

                                    
                                    <td>
                                      <a href="list_std.php?enid='.$id_schd.'"><i class="material-icons" data-toggle="tooltip" title="Student List">&#xe5d2;</i></a>
                                    </td>

                                    <td>
                                      <a href="en_std.php?enid='.$id_schd.'" data-toggle="tooltip" title="Enroll Students"><i class="material-icons" ></i>Students</a>
                                      <a href="en_sec.php?enid='.$id_schd.'" data-toggle="tooltip" title="Enroll Section"><i class="material-icons" ></i>Section</a>
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
                  <input type="hidden" name="idschd" id="idschd">
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
    <script src=" https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
   <script src=" https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
   <script src=" https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>


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
          $('#idschd').val(data[0]);
      });
  
  
    });
    
      
    $(document).ready(function() {
    var table = $('#tabler').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );


  
</script>




  </body>
</html>


