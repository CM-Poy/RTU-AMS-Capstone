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
  ?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <title>SUPERADMIN:Manage Schedules</title>
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
                    <a class="nav-link" href="#">Logout</a>
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
                    <a href="#delModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>
                      <span class="custom-checkbox">
                        <input type="checkbox" id="selectAll">
                        <label for="selectAll"></label>
                      </span>
                    </th>
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
                        $sql = "SELECT schedules.id_schd, users.flname_users, subjects.code_subj, sections.code_sec, schedules.day_schd, schedules.strtime_schd, schedules.endtime_schd, room.code_room from schedules left join users on schedules.user_id = users.id_users LEFT JOIN subjects on schedules.sub_id = subjects.id_subj LEFT JOIN sections on schedules.sec_id = sections.id_sec LEFT JOIN room on schedules.room_id = room.id_room";
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
                                    <td>
                                      <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox5" name="options[]" value="1">
                                        <label for="checkbox5"></label>
                                      </span>
                                    </td>
                                    
                                
                                    
                                    <td name="flnameuser_schd">'.$user_id.'</td>
                                    <td name="sub_schd">'.$sub_id.'</td>
                                    <td name="sec_schd">'.$sec_id.'</td>
                                    <td name="day_schd">'.$day.'</td>
                                    <td name="strtime_schd">'.$strtime.'</td>
                                    <td name="endtime_schd">'.$endtime.'</td>
                                    <td name="room_schd">'.$room_id.'</td>

                                    
                                    <td>
                                      
                                      <a href="#editModal" value = '.$id_schd.' class="editBtn" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                      <a href="#delModal" value = '.$id_schd.' class="delBtn" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                     
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
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                  <li class="page-item disabled"><a href="#">Previous</a></li>
                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item active"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">4</a></li>
                  <li class="page-item"><a href="#" class="page-link">5</a></li>
                  <li class="page-item"><a href="#" class="page-link">Next</a></li>
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
                  <h4 class="modal-title">Edit Schedule</h4>
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





        <!-- Edit Modal HTML -->
        <div id="editModal" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content">
              <form>
              <input type="text" class="form-control" id="id" hidden>
                <div class="modal-header">						
                  <h4 class="modal-title">Edit Schedule</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                <div class="form-group">
                    <label>Full Name</label>

                        <?php
                          echo '<select name="usrNameSchd" id="user" style="width: 340px">
                          <option></option>';
                          global $conn;
                          $sql = "SELECT * from users";
                          $result = $conn->prepare($sql);
                          $result->execute();
                      
                          if($result->rowCount() > 0){
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                              $id_users=$row["id_users"];
                              $flname_users=$row["flname_users"];
                              
                          
                              echo '<option >'.$flname_users.'</option>';
                              }
                          }

                          echo '</select>';
                        ?>

                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    
                    <?php
                        echo '<select name="subNameSchd" id="sub" style="width: 340px">
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
                        echo '<select name="sectNameSchd" id="sec" style="width: 340px">
                        <option></option>';
                        
                        $sql = "SELECT * from sections";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_sect=$row["id_sec"];
                        
                            $code_sect=$row["code_sec"];
                        
                            echo '<option value= '.$id_sec.'>'.$code_sec.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>

                  </div>
                  
                  <div class="form-group">
                    <label>Day</label>
                    
                    <?php
                        echo '<select name="daySchd" id="day" style="width: 340px">
                        <option></option>';
                        
                        function myDate($dy) {

                            $daynum = date('w', $dy);
                            return '<option name="day">' . date("l", $dy). '</option>';
                        }

                        $dayid = strtotime("sunday");
                        while ($dayid < strtotime("+7 days")) {

                            echo myDate($dayid);
                            $dayid += 86400; // number of seconds in a day, to get to next day
                        }
                        
                        echo '</select>';
                        
                    ?>

                  </div>					
                  <div class="form-group">
                    <label>Start</label>
                    
                    <?php
                        echo '<select name=frmTimeSchd id="strtime" style="width: 340px">
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
                        echo '<select name=frmTimeSchd id="endtime" style="width: 340px">
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
                      echo '<select name="roomSchd" id="room" style="width: 340px">
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
                  <input type="submit" class="btn btn-info" value="Save">
                </div>
              </form>
            </div>
          </div>
        </div>





        <!-- Delete Modal HTML -->
        <div id="delModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <form>
                <div class="modal-header">						
                  <h4 class="modal-title">Delete Schedule</h4>
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
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>


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
          $('#user').val(data[1]);
          $('#sub').val(data[2]);
          $('#sec').val(data[3]);
          $('#day').val(data[4]);
          $('#strtime').val(data[5]);
          $('#endtime').val(data[6]);
          $('#room').val(data[7]);
    
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




  </body>
</html>
