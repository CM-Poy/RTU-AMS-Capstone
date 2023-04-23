<?php 
require('../includes/config.php');
include('../includes/header.php');
session_start();


require "../includes/authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: ../authenticate_client.php");
    die();
}
$Authenticator = new Authenticator();




$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

if (!$checkResult) {
    $_SESSION['failed'] = true;
    header("location: ../authenticate_client.php");
    die();
} 

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Today</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/css_client/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".notifications .icon_wrap").click(function(){
              $(this).parent().toggleClass("active");
               $(".profile").removeClass("active");
            });

            $(".show_all .link").click(function(){
              $(".notifications").removeClass("active");
              $(".popup").show();
            });

            $(".close").click(function(){
              $(".popup").hide();
            });
        });
        $('subj1').click(function() {
  $(".modalcontainer,.modal").fadeIn("slow");
});

$(".close,.buttons").click(function() {
  $(".modalcontainer,.modal").fadeOut("slow");
});
    </script>
   <style>

.card{
    margin: 25px;
          }
.container{
    margin-top: 150px;
        }
.card{
    border-radius: 4px;
    background: #fff;
    box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
    transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
  cursor: pointer;
}

.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

.card h3{
  font-weight: 600;
}
#content{
    margin: 0;
    padding: 0;
    background-image: url('../../images/blurbg.png');
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}




@media(max-width: 990px){
  .card{
    margin: 20px;
  }
}
      </style>
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
              <a class="nav-link font-weight-bold text-justify" id="page-title">ATTENDANCE MANAGEMENT SYSTEM</a> 
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                     <div class="navbar_right">
                        <div class="notifications">
                          <div class="icon_wrap"><i class="far fa-bell"></i></div>
                          
                          <div class="notification_dd">
                             
                                  <li class="present">
                                      <div class="notify_icon">
                                          <span class="icon"></span>  
                                      </div>
                                      <div class="notify_data">
                                          <div class="title">
                                              Lorem, ipsum dolor.  
                                          </div>
                                          <div class="sub_title">
                                            Lorem ipsum dolor sit amet consectetur.
                                        </div>
                                      </div>
                                      <div class="notify_status">
                                          <p>PRESENT</p>  
                                      </div>
                                  </li>  
                                  <li class="absent">
                                      <div class="notify_icon">
                                          <span class="icon"></span>  
                                      </div>
                                      <div class="notify_data">
                                          <div class="title">
                                              Lorem, ipsum dolor.  
                                          </div>
                                          <div class="sub_title">
                                            Lorem ipsum dolor sit amet consectetur.
                                        </div>
                                      </div>
                                      <div class="notify_status">
                                          <p>ABSENT</p>  
                                      </div>
                                  </li> 
                                  <li class="show_all">
                                      <p class="link">Show All Activities</p>
                                  </li> 
                             
                          </div>
                          
                        </div>
                        
                      </div>
                  
                  <li class="nav-item">
                <a class="nav-link" href="../login.php">Logout</a>
                </li> 
            </ul>
            
            </div>

          </div>
            
        </nav>
 

                <?php
                    $userid=$_SESSION['user'];

                    $sql = "SELECT schedules.id_schd, users.flname_users, subjects.code_subj, sections.code_sec, schedules.day_schd, schedules.strtime_schd, schedules.endtime_schd, room.code_room from schedules
                    left join users on schedules.user_id = users.id_users
                    left JOIN subjects on schedules.sub_id = subjects.id_subj
                    LEFT JOIN sections on schedules.sec_id = sections.id_sec
                    LEFT JOIN room on schedules.room_id = room.id_room where user_id = $userid ";
                    $result = $conn->prepare($sql);
                    $result->execute();
                
                    if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            
                ?>
                            
                    <div class="col-md-4">
                        <div class="card text-center card-1" style="width: 18rem;" id="subj1" data-toggle="modal" data-target="#myModal">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["code_subj"]; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $row["code_sec"];?>  |  <?php echo $row["day_schd"];?>  |  <?php echo $row["strtime_schd"];?>  -  <?php echo $row["endtime_schd"];?>  |  <?php echo $row["code_room"];?></h6>
                            </div>
                        </div>
                    </div>

                <?php
  
                           
                        }
                    }
                   
                ?>
              
          
        <!--/show all notification-->

        <div class="popup">
            <div class="shadow"></div>
            <div class="inner_popup">
                <div class="notification_dd">
                    
                        <li class="title">
                            <p>All Notifications</p>
                            <p class="close"><i class="fas fa-times" aria-hidden="true"></i></p>
                        </li> 
                        <li class="starbucks success">
                            <div class="notify_icon">
                                <span class="icon"></span>  
                            </div>
                            <div class="notify_data">
                                <div class="title">
                                    Lorem, ipsum dolor.  
                                </div>
                                <div class="sub_title">
                                  Lorem ipsum dolor sit amet consectetur.
                              </div>
                            </div>
                            <div class="notify_status">
                                <p>Success</p>  
                            </div>
                        </li>  
                        <li class="baskin_robbins failed">
                            <div class="notify_icon">
                                <span class="icon"></span>  
                            </div>
                            <div class="notify_data">
                                <div class="title">
                                    Lorem, ipsum dolor.  
                                </div>
                                <div class="sub_title">
                                  Lorem ipsum dolor sit amet consectetur.
                              </div>
                            </div>
                            <div class="notify_status">
                                <p>Failed</p>  
                            </div>
                        </li> 
                        <li class="mcd success">
                            <div class="notify_icon">
                                <span class="icon"></span>  
                            </div>
                            <div class="notify_data">
                                <div class="title">
                                    Lorem, ipsum dolor.  
                                </div>
                                <div class="sub_title">
                                  Lorem ipsum dolor sit amet consectetur.
                              </div>
                            </div>
                            <div class="notify_status">
                                <p>Success</p>  
                            </div>
                        </li>  
                        <li class="baskin_robbins failed">
                            <div class="notify_icon">
                                <span class="icon"></span>  
                            </div>
                            <div class="notify_data">
                                <div class="title">
                                    Lorem, ipsum dolor.  
                                </div>
                                <div class="sub_title">
                                  Lorem ipsum dolor sit amet consectetur.
                              </div>
                            </div>
                            <div class="notify_status">
                                <p>Failed</p>  
                            </div>
                        </li> 
                        <li class="pizzahut failed">
                            <div class="notify_icon">
                                <span class="icon"></span>  
                            </div>
                            <div class="notify_data">
                                <div class="title">
                                    Lorem, ipsum dolor.  
                                </div>
                                <div class="sub_title">
                                  Lorem ipsum dolor sit amet consectetur.
                              </div>
                            </div>
                            <div class="notify_status">
                                <p>Failed</p>  
                            </div>
                        </li> 
                        <li class="kfc success">
                            <div class="notify_icon">
                                <span class="icon"></span>  
                            </div>
                            <div class="notify_data">
                                <div class="title">
                                    Lorem, ipsum dolor.  
                                </div>
                                <div class="sub_title">
                                  Lorem ipsum dolor sit amet consectetur.
                              </div>
                            </div>
                            <div class="notify_status">
                                <p>Success</p>  
                            </div>
                        </li>
                   
                </div>
            </div>
          </div>
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" id="modal">
        <div class="modal-header">
            <h4 class="modal-title">SUBJECT</h4>
          <button type="button" class="close" data-dismiss="modal"></button>
        </div>
        <div class="modal-body">
        <table>
            <tbody>
                <tr>
             <th>Name</th>
             <th>Student Number</th>
                                 
             </tr>
             


          <?php
                  global $conn;
                  $sql = "SELECT schedules.id_schd, sections.code_sec, schedules.sec_id from schedules
                    left join users on schedules.user_id = users.id_users
                    LEFT JOIN sections on schedules.sec_id = sections.id_sec where user_id = $userid ";
                  $result = $conn->prepare($sql);
                  $result->execute();
                  if($result->rowCount() > 0){
                    while ($row=$result->fetch(PDO::FETCH_ASSOC)){
                        $sec = $row['sec_id'];

                    }
                  }
                  
                  
                  $sql2 = "SELECT * from students where sec_id = ? ";
                  $result2 = $conn->prepare($sql2);
                  $result2->execute([$sec]);
                  if($result2->rowCount() > 0){
                      while ($row2=$result2->fetch(PDO::FETCH_ASSOC)){
                          ?><tr>
                          <td><?php echo $row2['flname_std']; ?> </td>
                          <td><?php echo $row2['studnum_std']; ?> </td>
                          <td><?php echo $sec; ?> </td></tr>
                          

                                

                     

                      <?php
                    }
                }
            
        




          ?>
          </thead>
             </tbody>
         </table>
         <div>
         <button class="att">ATTENDANCE</button>
         <button class="att2">RANDOMIZER</button>
         
         </div>
        </div>
       </div>
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