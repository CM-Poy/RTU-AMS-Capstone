<!doctype html>
<html lang="en">

  <?php
  include('../includes/header.php');  
  require('../includes/config.php');


  if(isset($_POST['addbtn'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->addSchd($_POST['usrName'], $_POST['subName'], $_POST['secName'],  $_POST['day'], $_POST['strTime'], $_POST['endTime'], $_POST['room']);
  }

  if(isset($_POST['btnDel'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->delSchd($_POST['idschd']);
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
  $sql = "SELECT * from schedules";
  $totalnumrecords = $conn->prepare($sql); 
  $totalnumrecords->execute();
  //total records
  $result_totalnumrecords=$totalnumrecords->rowCount();
  //total pages
  $total_numpages = ceil($result_totalnumrecords/$total_records_perpage);



  ?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <title>SUPERADMIN: Manage Schedules</title>
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
                    <h2>Manage <b>Schedules</b></h2>
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
                    <th>Subject</th>
                    <th>Section</th>
                    <th>Day</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Room</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                 
                <?php
                        $sql = "SELECT schedules.id_schd, users.flname_users, subjects.code_subj, sections.code_sec, schedules.day_schd, schedules.strtime_schd, schedules.endtime_schd, room.code_room from schedules left join users on schedules.user_id = users.id_users LEFT JOIN subjects on schedules.sub_id = subjects.id_subj LEFT JOIN sections on schedules.sec_id = sections.id_sec LEFT JOIN room on schedules.room_id = room.id_room LIMIT $offset, $total_records_perpage";
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
                            <form action="subjects.php" method="post">
                              <tr>
                                  <td hidden>'.$id_schd.'</td>
                                  <td name="flnameuser_schd">'.$user_id.'</td>
                                  <td name="sub_schd">'.$sub_id.'</td>
                                  <td name="sec_schd">'.$sec_id.'</td>
                                  <td name="day_schd">'.$day.'</td>
                                  <td name="strtime_schd">'.$strtime.'</td>
                                  <td name="endtime_schd">'.$endtime.'</td>
                                  <td name="room_schd">'.$room_id.'</td>

                                  
                                  <td>
                                    
                                    <a href="update/upd_std.php?updid='.$id_schd.'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
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





        <!-- add Modal HTML -->
        <div id="addModal" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content">
              <form method="post">
              <input type="text" class="form-control" id="id" hidden>
                <div class="modal-header">						
                  <h4 class="modal-title">Add Schedule</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                <div class="form-group">
                    <label>Full Name</label>

                        <?php
                          echo '<select name="usrName" id="user" style="width: 340px">
                          <option></option>';
                          global $conn;
                          $sql = "SELECT * from users";
                          $result = $conn->prepare($sql);
                          $result->execute();
                      
                          if($result->rowCount() > 0){
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                              $id_users=$row["id_users"];
                              $flname_users=$row["flname_users"];
                              
                          
                              echo '<option value= '.$id_users.'>'.$flname_users.'</option>';
                              }
                          }

                          echo '</select>';
                        ?>

                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    
                    <?php
                        echo '<select name="subName" id="sub" style="width: 340px">
                        <option></option>';
                        
                        $sql = "SELECT * from subjects";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_subj=$row["id_subj"];
                        
                            $name_subj=$row["name_subj"];
                        
                            echo '<option value= '.$id_subj.'>'.$name_subj.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>


                  </div>
                  <div class="form-group">
                    <label>Section</label>
                    
                    <?php
                        echo '<select name="secName" id="sec" style="width: 340px">
                        <option></option>';
                        
                        $sql = "SELECT * from sections";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_sec=$row["id_sec"];
                        
                            $code_sec=$row["code_sec"];
                        
                            echo '<option value= '.$id_sec.'>'.$code_sec.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>

                  </div>
                  
                  <div class="form-group">
                    <label>Day</label>
                    
                    <?php
                        echo '<select name="day" id="day" style="width: 340px">
                        <option></option>';
                        
                        function myDay($dy) {

                            $daynum = date('w', $dy);
                            return '<option name="day">' . date("l", $dy). '</option>';
                        }

                        $dayid = strtotime("sunday");
                        while ($dayid < strtotime("+ 12 days")) {

                            echo myDay($dayid);
                            $dayid += 86400; // number of seconds in a day, to get to next day
                        }
                        
                        echo '</select>';
                        
                    ?>

                  </div>					
                  <div class="form-group">
                    <label>Start</label>
                    
                    <?php
                        echo '<select name=strTime id="strtime" style="width: 340px">
                        <option></option>';
                        
                        for ($hours=0; $hours<24; $hours++) { // the interval for hours is '1'
                            
                            for($mins=0; $mins<60; $mins+=30) {
                                // the interval for mins is '30'
                                $thehour = str_pad($hours,2,'0',STR_PAD_LEFT);
                                if ($thehour == "00") {

                                    $thehour = "12";
                                }
                                if ($thehour > "12") {

                                    $thehour = $thehour - 12;
                                    if ($thehour < 10) {
                                    $thehour = "0" . $thehour;  
                                    }
                                }

                                $theminutes = str_pad($mins,2,'0',STR_PAD_LEFT);
                                $mytime = $thehour.":".$theminutes;
                                if ($hours < 12) {

                                    $mytime = $mytime . " AM";    
                                }
                                else {

                                    $mytime = $mytime . " PM";
                                }
                                echo '<option>'.$mytime.'</option>';
                            } 
                        }
                        
                        echo '</select>';
                    ?>

                  </div>			
                  <div class="form-group">
                    <label>End</label>
                    
                    <?php
                        echo '<select name="endTime" id="endtime" style="width: 340px">
                        <option></option>';
                        
                        for ($hours=0; $hours<24; $hours++) { // the interval for hours is '1'
                            
                            for($mins=0; $mins<60; $mins+=30) {
                                // the interval for mins is '30'
                                $thehour = str_pad($hours,2,'0',STR_PAD_LEFT);
                                if ($thehour == "00") {

                                    $thehour = "12";
                                }
                                if ($thehour > "12") {

                                    $thehour = $thehour - 12;
                                    if ($thehour < 10) {
                                    $thehour = "0" . $thehour;  
                                    }
                                }

                                $theminutes = str_pad($mins,2,'0',STR_PAD_LEFT);
                                $mytime = $thehour.":".$theminutes;
                                if ($hours < 12) {

                                    $mytime = $mytime . " AM";    
                                }
                                else {

                                    $mytime = $mytime . " PM";
                                }
                                echo '<option>'.$mytime.'</option>';
                            } 
                        }
                        
                        echo '</select>';
                    ?>

                  </div>
                  <div class="form-group">
                    <label>Room</label>

                    <?php
                      echo '<select name="room" id="room" style="width: 340px">
                      <option></option>';
                      
                      $sql = "SELECT * from room";
                      $result = $conn->prepare($sql);
                      $result->execute();
                  
                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_room=$row["id_room"];
                      
                          $code_room=$row["code_room"];
                      
                          echo '<option value= '.$id_room.' >'.$code_room.'</option>';
                          }
                      }

                      echo '</select>';
                    ?>

                  </div>			
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <input type="submit" class="btn btn-info" name="addbtn" value="Save">
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
</script>




  </body>
</html>

