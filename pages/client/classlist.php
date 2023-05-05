<!doctype html>
<html lang="en">

<?php

session_start();
include('../includes/header.php'); 
require('../includes/config.php');
date_default_timezone_set('Asia/Shanghai');


$idschd=$_GET['id'];




$sql="SELECT * from schedules  where id_schd=?";
$query = $conn->prepare($sql);
$query->execute([$idschd]);

if($query->rowCount() > 0){
  while ($row = $query->fetch(PDO::FETCH_ASSOC)){
    $id=$row['id_schd'];
    $user=$row['user_id'];
    $sub=$row['sub_id'];
    $sec=$row['sec_id'];
    $day=$row['day_schd'];
    $str=$row['strtime_schd'];
    $end=$row['endtime_schd'];
    $room=$row['room_id'];

    $_SESSION['secid']=$row["sec_id"];
    $_SESSION['schdid']=$row["id_schd"];
  }
}

 





?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <title>Student List</title>
</head>
  <body>

  <!--sidebar-->

  <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar">
                <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(../../images/rtu-logo.png);"></a>
                <ul class="list-unstyled components mb-5">
              <li class="">
                <a href="today.php">&nbsp;&nbsp;&nbsp;<i class="fa-sharp fa-solid fa-calendar-day fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>DASHBOARD</a>
              </li>
              <li class="">
               <a href="calendar.php">&nbsp;&nbsp;&nbsp;<i class="fa-sharp fa-solid fa-calendar-days fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>CALENDAR</a>
              </li>
              <li>
              <a href="account.php" >&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-user fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>ACCOUNT</a>
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
            <a class="nav-link font-weight-bold text-justify" id="page-title">ATTENDANCE MANAGEMENT SYSTEM - USER</a> 
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
                    <h2><b>Students</b></h2>
                  </div>
                  <div class="col-sm-6">
                  <form method="post">
                    <a type="button" class="btn btn-success" name="recAtt" href="rec_attendance.php?secid=<?php echo $_SESSION['secid']; ?>schdid=<?php echo $_SESSION['schdid']; ?>"><i class="material-icons custom">class</i> <span>RECORD ATTENDANCE</span></a>
                    <a type="button" class="btn btn-danger" name="rnd" ><i class="material-icons custom">autorenew</i> <span>RANDOMIZER</span></a></form>				  
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Student Number</th>
                    <th>Guardian Email</th>
                    <th>Section</th>
                  </tr>
                </thead>
                <tbody>


                <?php
                
                global $conn;
                $sql = "SELECT students.id_std,students.flname_std, students.studnum_std, students.gemail_std, students.sec_id, sections.code_sec from students left join sections on students.sec_id = sections.id_sec where sec_id=?";
                $query = $conn->prepare($sql);
                $query->execute([$sec]);
                if($query->rowCount() > 0){
                  while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $id_std=$row['id_std'];
                    
                   ?><tr><td><?php echo $row['flname_std']; ?></td>
                    <td><?php echo $row['studnum_std']; ?></td>
                    <td><?php echo $row['gemail_std']; ?></td>
                    <td><?php echo $row['code_sec']; ?></td></tr>
                   
                   
                   <?php
                  }
                }else{
                  echo "No Records Found.";
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






  
       
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>

      


  </body>
</html>


