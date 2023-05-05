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
    color: black;
    margin-bottom: 25px;
    border-radius: 15px;
    box-shadow: 0px 0px 6px 0px;
  }
  #random-name {
    margin: 2rem 0;
    color: black;
    }
  .btn1{
    position: relative;
    border-radius: 4em;
    font-size: 16px;
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
    background-color: green;
    color: white;
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
    color: white;
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
                  <div class="card">					
                <center><div id="random-name">Generate Randomly</div></div>
            
               <center> <a class="btn1 btn-success" id="generate" name="generate" value="generate"
                    onclick="setRandomName()" style="color: white;">GENERATE</a>
                 <div id="jstable"></div></center>
                
                     
                
                  
            
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


