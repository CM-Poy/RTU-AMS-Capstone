<!doctype html>
<html lang="en">

  <?php include('header.php'); 
  require('../includes/config.php');
  ?>
  

<head>
    <title>Schedules</title>
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
              <a href="sections.php" >&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-th-large fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>SECTIONS</a>
              </li>
              <li>
              <a href="subjects.php" >&nbsp;&nbsp;&nbsp;<i class="fa fa-book fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>SUBJECTS</a>
              </li>
              <li>
               <a href="departments.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-building fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>DEPARTMENTS</a>  
              </li>
              <li>
               <a href="#">&nbsp;&nbsp;&nbsp;<i class="fa fa-folder-open fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>COURSES</a>
              </li>
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
                    <a class="nav-link" href="#">Logout</a>
                </li>
              </ul>
            </div>
          </div>
            
        </nav>
              <div class="container-lg">
          <div class="table-responsive">
              <div class="table-wrapper">
                  <div class="table-title">
                      <div class="row">
                          <div class="col-sm-8"><h2>Schedule <b>Details</b></h2></div>
                          <div class="col-sm-4">
                              <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                          </div>
                      </div>
                  </div>
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Full Name</th>
                              <th>Subject</th>
                              <th>Section</th>
                              <th>Day</th>
                              <th>Start</th>
                              <th>End</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            global $conn;
                            $sql = "SELECT * from schedules";
                            $result = $conn->prepare($sql);
                            $result->execute();
                            if($result->rowCount() > 0){
                              while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                                $fnameuser_schd=$row["fnameuser_schd"];
                                $subj_schd=$row["subj_schd"];
                                $sect_schd=$row["sect_schd"];
                                $day_schd=$row["day_schd"];
                                $strttime_schd=$row["strttime_schd"];
                                $endtime_schd=$row["endtime_schd"];
            
                                echo '

                                  <tr>
                                        <td>'.$fnameuser_schd.'</td>
                                        <td>'.$subj_schd.'</td>
                                        <td>'.$sect_schd.'</td>
                                        <td>'.$day_schd.'</td>
                                        <td>'.$strttime_schd.'</td>
                                        <td>'.$endtime_schd.'</td>
                                        <td><a class="add" name="addSchd" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                                        <a class="edit" name="editSchd" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                        <a class="delete" name="delSchd" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
                              </tr>';
                              }
                            }
                        ?>
                      </tbody>
                  </table>
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


<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  var actions = $("table td:last-child").html();
  // Append table with add row form on add new button click
    $(".add-new").click(function(){
    $(this).attr("disabled", "disabled");
    var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="name" id="name"></td>' +
            '<td><input type="text" class="form-control" name="subject" id="subject"></td>' +
            '<td><input type="text" class="form-control" name="section" id="section"></td>' +
            '<td><input type="text" class="form-control" name="day" id="day"></td>' +
            '<td><input type="text" class="form-control" name="start" id="start"></td>' +
            '<td><input type="text" class="form-control" name="end" id="end"></td>' +
      '<td>' + actions + '</td>' +
        '</tr>';
      $("table").append(row);   
    $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
  // Add row on add button click
  $(document).on("click", ".add", function(){
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
      if(!$(this).val()){
        $(this).addClass("error");
        empty = true;
      } else{
                $(this).removeClass("error");
            }
    });
    $(this).parents("tr").find(".error").first().focus();
    if(!empty){
      input.each(function(){
        $(this).parent("td").html($(this).val());
      });     
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new").removeAttr("disabled");
    }   
    });
  // Edit row on edit button click
  $(document).on("click", ".edit", function(){    
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
      $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
    });   
    $(this).parents("tr").find(".add, .edit").toggle();
    $(".add-new").attr("disabled", "disabled");
    });
  // Delete row on delete button click
  $(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
    $(".add-new").removeAttr("disabled");
    });
});
</script>