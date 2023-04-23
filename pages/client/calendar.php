<!doctype html>
<html lang="en">
  <head>
  	<title>Calendar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/css_client/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
    <script src='fullcalendar/main.js'></script>
<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        });
        calendar.render();
      });

      headerToolbar:{
        center:'title'
      }
    </script>
    <script>
        $(document).ready(function(){
            $(".profile .icon_wrap").click(function(){
              $(this).parent().toggleClass("active");
              $(".notifications").removeClass("active");
            });

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
    </script>
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
        <!--Calendar-->
          <div class="container">
              <div id='calendar'>
              </div>
         </div>
    </div>
    
  </div>

        <!--ALL NOTIFICATIONS-->
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

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.js"></script>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
  </body>
</html>