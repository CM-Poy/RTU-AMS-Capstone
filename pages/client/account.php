<?php
include('../includes/header.php'); 
require('../includes/config.php');

session_start();

$userid=$_SESSION['user'];


$sql="SELECT * from users where id_users=$userid";
$result = $conn->prepare($sql);
$result->execute();
if($result->rowCount() > 0){
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
      $id=$row['id_users'];
      $hnr=$row['hnr_users'];
      $name=$row['flname_users'];
      $email=$row['instemail_users'];
      $empnum=$row['empnum_users'];
      $pwd=$row['pwd_users'];

    }
  }


if (!isset($_SESSION['pwderror'])) {
  $_SESSION['pwderror'] = false;
}




?>




<!doctype html>
<html lang="en">
  <head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
  	<title>Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/css_client/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       
   <style>

#content{
    margin: 0;
    padding: 0;
    background-image: url('../../images/blurbg.png');
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
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
                <div class="link p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(../../images/rtu-logo.png);"></a>
            <ul class="list-unstyled components mb-5">
              <li class="">
                <a href="today.php">&nbsp;&nbsp;&nbsp;<i class="fa-sharp fa-solid fa-calendar-day fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>TODAY</a>
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
      <div id="content" class=" p-4 p-md-5">
          
        <nav id="navbar"class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>

            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="nav-link font-weight-bold text-justify" id="page-title">ATTENDANCE MANAGEMENT SYSTEM</a> 
            <?php if ($_SESSION['pwderror']): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo $_SESSION['pwderror'];?></strong>
                        </div>
                        <?php   
                            $_SESSION['pwderror'] = false;
                        ?>
                      <?php endif ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <span class="sr-only">Toggle Menu</span>
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

          <div class="main-body">
            <div class="col-md-12">
              <div class="card mb-3">
                <div class="card-body">
               
                  <div class="row">
                    <div class="col-sm-3">
                      <div hidden>
                        <?php echo $id; ?>
                      </div>
                      <h6 class="mb-0">Honnorific</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $hnr; ?>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Fullname</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $name; ?>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Institutional Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $email; ?>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Employee Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $empnum; ?>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type=password value =<?php echo $pwd;?> disabled/>
                      <a href="update/upd_pwd.php?updid=<?php echo $id; ?>"  class="btn btn-info">Change</a>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col-sm-12">
                      
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

    <script>
     



$(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});
    </script>
  </body>
</html>