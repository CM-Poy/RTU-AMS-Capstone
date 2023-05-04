<!doctype html>
<html lang="en">

<?php
include('../includes/header.php'); 
require('../includes/config.php');




$idschd=$_REQUEST['id'];


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
  }
}


?>
<style>
  #myTable td{
    border: 1px solid black;
    text-align: center;
    }

    #myTable{
      height: 2rem;
      
    }
#rando {
    padding-top: 80px;
  }

  #random-name {
    font-size: 30px;
  }
    

  #fulln {
    font-size: 15px;
    padding-left: 5px;
  }

  #rem {
    margin-left: 15px;
  }
  .card{
    color: aqua;
  }
  #random-name {
    margin: 2rem 0;
    color: black;
    }
  .btn1{
    position: relative;
    
    border-radius: 4em;
    font-size: 16px;
    color: white;
    padding: 0.8em 1.8em;
    cursor:pointer;
    user-select:none;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition-duration: 0.4s;
    -webkit-transition-duration: 0.4s; /* Safari */
   
  }
  
  .btn1:hover {
    transition-duration: 0.1s;
    background-color: #3A3A3A;
  }
  
  .btn1:after {
    content: "";
    display: block;
    position: absolute;
    border-radius: 4em;
    left: 0;
    top:0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: all 0.5s;
    box-shadow: 0 0 10px 40px white;
  }
  
  .btn1:active:after {
    box-shadow: 0 0 0 0 white;
    position: absolute;
    border-radius: 4em;
    left: 0;
    top:0;
    opacity: 1;
    transition: 0s;
  }
  
  .btn1:active {
    top: 1px;
  }
 
    #jstable{
      margin-top: 20px;
    }
    #randomizer {
  position: absolute;
  float: left;
  left: 50%;
  top: 65%;
  transform: translate(-50%, -50%);
}
.btn1 canvas {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  pointer-events: none;
}
$coin-size: 3.5rem;
$coin-thickness: $coin-size / 11;

$bg: #f4f7ff;
$bg-button: #031032;
$font-color: #fff;
$c-l: #fcfaf9;
$c-m: #c2cadf;
$c-d: #8590b3;
$c-side: #737c99;
$shine: #e9f4ff;

.tip-button {
  background: none;
  border: 0;
  border-radius: 0.25rem 0.25rem 0 0;
  cursor: pointer;
  font-family: 'Quicksand', sans-serif;
  font-size: 0.75rem;
  font-weight: 600;
  height: 2.6rem;
  margin-bottom: -4rem;
  outline: 0;
  position: relative;
  top: 0;
  transform-origin: 0% 100%;
  transition: transform 50ms ease-in-out;
  width: 9.5rem;
  -webkit-tap-highlight-color: transparent;
  &:active {
    transform: rotate(4deg);
  }
  // Button was clicked
  &.clicked {
    animation: 150ms ease-in-out 1 shake;
    pointer-events: none;
    .tip-button__text {
      opacity: 0;
      transition: opacity 100ms linear 200ms;
    }
    &::before { // background/bar
      height: 0.5rem;
      width: 60%;
    }
    .coin {
      transition: margin-bottom 1s linear 200ms;
      margin-bottom: 0;
    }
  }
  // Coin almost finished falling
  &.shrink-landing {
    &::before { // background/bar
      transition: width 200ms ease-in;
      width: 0;
    }
  }
  // Coin finished falling
  &.coin-landed {
    &::after { // Thank you message
      opacity: 1;
      transform: scale(1);
      transform-origin: 50% 100%;
    }

    // Make the little confetti looking dots on this wrapper
    .coin-wrapper {
      background:
        radial-gradient(circle at 35% 97%, rgba($bg-button, 0.4) 0.04rem, transparent 0.04rem),
        radial-gradient(circle at 45% 92%, rgba($bg-button, 0.4) 0.04rem, transparent 0.02rem),
        radial-gradient(circle at 55% 98%, rgba($bg-button, 0.4) 0.04rem, transparent 0.04rem),
        radial-gradient(circle at 65% 96%, rgba($bg-button, 0.4) 0.06rem, transparent 0.06rem);
      background-position: center bottom;
      background-size: 100%;
      bottom: -1rem;
      opacity: 0;
      transform: scale(2) translateY(-10px);
    }
  }

  &__text {
    color: $font-color;
    margin-right: 1.8rem;
    opacity: 1;
    position: relative;
    transition: opacity 100ms linear 500ms;
    z-index: 3;
  }

  // Background of button
  &::before {
    background: $bg-button;
    border-radius: 0.25rem;
    bottom: 0;
    content: '';
    display: block;
    height: 100%;
    left: 50%;
    position: absolute;
    transform: translateX(-50%);
    transition: height 250ms ease-in-out 400ms, width 250ms ease-in-out 300ms;
    width: 100%;
    z-index: 2;
  }

  // Thank you message
  &::after {
    bottom: -1rem;
    color: $bg-button;
    content: 'Thank you!';
    height: 110%;
    left: 0;
    opacity: 0;
    position: absolute;
    pointer-events: none;
    text-align: center;
    transform: scale(0);
    transform-origin: 50% 20%;
    transition: transform 200ms cubic-bezier(0,0,.35,1.43);
    width: 100%;
    z-index: 1;
  }
}

.coin-wrapper {
  background: none;
  bottom: 0;
  height: 18rem;
  left: 0;
  opacity: 1;
  overflow: hidden;
  pointer-events: none;
  position: absolute;
  transform: none;
  transform-origin: 50% 100%;
  transition: opacity 200ms linear 100ms, transform 300ms ease-out;
  width: 100%;
}

.coin {
  --front-y-multiplier: 0;
  --back-y-multiplier: 0;
  --coin-y-multiplier: 0;
  --coin-x-multiplier: 0;
  --coin-scale-multiplier: 0;
  --coin-rotation-multiplier: 0;
  --shine-opacity-multiplier: 0.4;
  --shine-bg-multiplier: 50%;
  bottom: calc(var(--coin-y-multiplier) * 1rem - #{$coin-size});
  height: $coin-size;
  margin-bottom: 3.05rem;
  position: absolute;
  right: calc(var(--coin-x-multiplier) * 34% + 16%);
  transform:
    translateX(50%)
    scale(calc(0.4 + var(--coin-scale-multiplier)))
    rotate(calc(var(--coin-rotation-multiplier) * -1deg));
  transition: opacity 100ms linear 200ms;
  width: $coin-size;
  z-index: 3;

  &__front,
  &__middle,
  &__back,
  &::before,
  &__front::after,
  &__back::after {
    border-radius: 50%;
    box-sizing: border-box;
    height: 100%;
    left: 0;
    position: absolute;
    width: 100%;
    z-index: 3;
  }

  // Tails
  &__front {
    background:
      radial-gradient(circle at 50% 50%, transparent 50%, rgba($c-side, 0.4) 54%, $c-m 54%),
      linear-gradient(210deg, $c-d 32%, transparent 32%),
      linear-gradient(150deg, $c-d 32%, transparent 32%),
      linear-gradient(to right, $c-d 22%, transparent 22%, transparent 78%, $c-d 78%),
      linear-gradient(to bottom, $c-l 44%, transparent 44%, transparent 65%, $c-l 65%, $c-l 71%, $c-d 71%),
      linear-gradient(to right, transparent 28%, $c-l 28%, $c-l 34%, $c-d 34%, $c-d 40%, $c-l 40%, $c-l 47%, $c-d 47%, $c-d 53%, $c-l 53%, $c-l 60%, $c-d 60%, $c-d 66%, $c-l 66%, $c-l 72%, transparent 72%);
    background-color: $c-d;
    background-size: 100% 100%;
    transform: translateY(calc(var(--front-y-multiplier) * #{$coin-thickness} / 2)) scaleY(var(--front-scale-multiplier));
  
    // Shadow on coin face
    &::after {
      background: rgba(#000, 0.2);
      content: '';
      opacity: var(--front-y-multiplier);
    }
  }

  &__middle {
    background: $c-side;
    transform: translateY(calc(var(--middle-y-multiplier) * #{$coin-thickness} / 2)) scaleY(var(--middle-scale-multiplier));
  }

  // Heads
  &__back {
    background:
      radial-gradient(circle at 50% 50%, transparent 50%, rgba($c-side, 0.4) 54%, $c-m 54%),
      radial-gradient(circle at 50% 40%, $c-l 23%, transparent 23%),
      radial-gradient(circle at 50% 100%, $c-l 35%, transparent 35%);
    background-color: $c-d;
    background-size: 100% 100%;
    transform: translateY(calc(var(--back-y-multiplier) * #{$coin-thickness} / 2)) scaleY(var(--back-scale-multiplier));
  
    // Shadow on coin face
    &::after {
      background: rgba(#000, 0.2);
      content: '';
      opacity: var(--back-y-multiplier);
    }
  }

  // Light glare on the coin
  &::before {
    background:
      radial-gradient(circle at 25% 65%, transparent 50%, rgba(white, 0.9) 90%),
      linear-gradient(55deg, transparent calc(var(--shine-bg-multiplier) + 0%), $shine calc(var(--shine-bg-multiplier) + 0%), transparent calc(var(--shine-bg-multiplier) + 50%));
    content: '';
    opacity: var(--shine-opacity-multiplier);
    transform:
      translateY(calc(var(--middle-y-multiplier) * #{$coin-thickness} / -2))
      scaleY(var(--middle-scale-multiplier))
      rotate(calc(var(--coin-rotation-multiplier) * 1deg));
    z-index: 10;
  }

  // Sqaure for the 'side' of the coin
  &::after {
    background: $c-side;
    content: '';
    height: $coin-thickness;
    left: 0;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    z-index: 2;
  }
}

@keyframes shake {
  0% { transform: rotate(4deg) }
  66% { transform: rotate(-4deg) }
  100% { transform: rotate() }
}
  </style>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <title>Student List</title>
</head>
  <body onload="createClassList()">

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
                    <a type="button" class="btn btn-success" name="attRec"><i class="material-icons custom">class</i> <span>RECORD ATTENDANCE</span></a>
                    <a href="#randomizer" class="btn btn-danger" name="rnd" data-toggle="modal"><i class="material-icons custom">autorenew</i> <span>RANDOMIZER</span></a>						
                  </div>
                </div>
              </div>
              <table id="tabler"class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th hidden></th>
                    <th>Full Name</th>
                    <th>Student Number</th>
                    <th>Guardian Email</th>
                    <th>Section</th>
                  </tr>
                </thead>
                <tbody>


                <?php
                
                global $conn;
                $sql = "SELECT students.flname_std, students.studnum_std, students.gemail_std, students.sec_id, sections.code_sec from students left join sections on students.sec_id = sections.id_sec where sec_id=?";
                $query = $conn->prepare($sql);
                $query->execute([$sec]);
                if($query->rowCount() > 0){
                  while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                   ?><tr>
                    <td hidden></td>
                    <td><?php echo $row['flname_std']; ?></td>
                    <td><?php echo $row['studnum_std']; ?></td>
                    <td><?php echo $row['gemail_std']; ?></td>
                    <td><?php echo $row['code_sec']; ?></td></tr>
                   
                   
                   
                   <?php
                  }
                }


                ?>


                  
                </tbody>
              </table>
              <?php
              include('randomizer_db.php');
              $stmt = $conn->prepare('SELECT FullName FROM students');
              $stmt->execute(array());
              $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
              foreach ($result as $value) {
                $data = $value;
              }
              ?>
              <div id="randomizer" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content">
              <form method="post">
              <input type="text" class="form-control" name="" hidden>
                <div class="modal-header">
                  <h4 class="modal-title">Section</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="dialog">					
                <center><div id="random-name">Generate Randomly</div>
                <a class="btn1 btn-primary" id="generate" name="generate" value="generate"
                    onclick="setRandomName()">
                  <span class="tip-button__text">GENERATE</span>
                  <div class="coin-wrapper">
                  <div class="coin">
                    <div class="coin__middle"></div>
                    <div class="coin__back"></div>
                    <div class="coin__front"></div>
                  </div>
                </div>
            </a>
                   
                   <center><div id="jstable"></div></center>
                
                     
                
                  
                  
                </div>
              </form>
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
   $(document).ready(function () {
    $('#tabler').DataTable({
      
      
    });
});
const fnames = (<?php echo json_encode($result); ?>);
  const getRandomName = () => {
    let x = fnames[Math.floor(Math.random() * fnames.length)]
    return fnames.length ? x['FullName'] : 'No value/s to show';
  }

  const setRandomName = () => {
    const initialTable = document.getElementById("myTable");
    initialTable.remove();
    document.getElementById('random-name').classList.add('animate');
    const dist = document.querySelector('#random-name');

  document.querySelector('a').addEventListener('click', () => {
  dist.classList.remove('animate');

  setTimeout(function(){
    dist.classList.add('animate');
  },);
});
  
    

    let randomName = getRandomName()
    document.getElementById('random-name').innerText = randomName;
    fnames.splice(fnames.findIndex((name) => name.FullName === randomName), 1);
    createClassList();
  }

  const createClassList = () => {
    //Create Table Element
    var element = document.createElement("TABLE");
    element.setAttribute("id", "myTable");
    document.getElementById("jstable").appendChild(element);

    //Create Table Header Element
    var theader = document.createElement("TR");
    theader.setAttribute("id", "header");
    document.getElementById("myTable").appendChild(theader);

    var heads =  'Class List';
    var x = document.createElement("TH");
    x.appendChild(document.createTextNode(heads));
    theader.appendChild(x);

    //Create Table Values (Student Names) Element
    var index;
    var len = fnames.length;

    if (len > 0) {
      for (index = 0, len; index < len; ++index) {
        var y = document.createElement("TR");
        y.setAttribute("id", "myTr");
        document.getElementById("myTable").appendChild(y);

        var t = document.createElement("TD");
        t.appendChild(document.createTextNode(fnames[index]['FullName']));
        y.appendChild(t);
        
        
      }
      }

    else {
      //Create Table Header Element
      var theader = document.createElement("TR");
      theader.setAttribute("id", "header");
      document.getElementById("myTable").appendChild(theader);

      var heads = 'No more values to show';
      var x = document.createElement("TD");
      x.appendChild(document.createTextNode(heads));
      theader.appendChild(x);
    }
  }


  </script>


  </body>
</html>


