<!doctype html>
<html lang="en">
<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <title>Calendar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/css_client/style.css">
    <link rel="stylesheet" href="../../css/css_calendar/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
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
  z-index: 9999;
}
@media (max-width: 425px) {
  #navbar  {
    min-width:90%;
  } 

}
/*END StickyNAVBAR*/

</style>
  
  <body>

  <!--sidebar-->

  <div class="wrapper d-flex align-items-stretch  fixed-side">
            <nav id="sidebar">
                <div class="p-4 pt-5">
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
            <a class="nav-link font-weight-bold text-justify" id="page-title">ATTENDANCE MANAGEMENT SYSTEM</a> 
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="logout">Logout</a>
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
        </nav>
        <!-- Calendar -->
        <div class="container-wrapper">
          <div class="container">
            <div class="left">
              <div class="calendar">
                <div class="month">
                  <i class="fas fa-angle-left prev"></i>
                  <div class="date">december 2015</div>
                  <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                  <div>Sun</div>
                  <div>Mon</div>
                  <div>Tue</div>
                  <div>Wed</div>
                  <div>Thu</div>
                  <div>Fri</div>
                  <div>Sat</div>
                </div>
                <div class="days"></div>
                <div class="goto-today">
                  <div class="goto">
                    <input type="text" placeholder="mm/yyyy" class="date-input" />
                    <button class="goto-btn">Go</button>
                  </div>
                  <button class="today-btn">Today</button>
                </div>
              </div>
            </div>
            <div class="right">
              <div class="today-date">
                <div class="event-day">wed</div>
                <div class="event-date">12th december 2022</div>
              </div>
              <div class="events"></div>
              <div class="add-event-wrapper">
                <div class="add-event-header">
                  <div class="title">Add Event</div>
                  <i class="fas fa-times close"></i>
                </div>
                <div class="add-event-body">
                  <div class="add-event-input">
                    <input type="text" placeholder="Event Name" class="event-name" />
                  </div>
                  <div class="add-event-input">
                    <input
                      type="text"
                      placeholder="Event Time From"
                      class="event-time-from"
                    />
                  </div>
                  <div class="add-event-input">
                    <input
                      type="text"
                      placeholder="Event Time To"
                      class="event-time-to"
                    />
                  </div>
                </div>
                <div class="add-event-footer">
                  <button class="add-event-btn">Add Event</button>
                </div>
              </div>
            </div>
            <button class="add-event">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        
          
      </div>
    
    <script src="../../js/script.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>

  </body>
</html>


