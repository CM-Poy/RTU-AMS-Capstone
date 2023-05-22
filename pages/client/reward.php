<!doctype html>
<html lang="en">

  <?php
  include('../includes/header.php'); 
  require('../includes/config.php');
  session_start();
  



  if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = false;
  }


  $idschd=$_SESSION['schdid'];

  if(isset($_POST['btnRem'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->RemStd($_POST['idstd']);
  } 

 
 


 


 






  ?>
  
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>ADMIN: Enroll Students</title>
</head>
<style>
#btnr1{
  margin-right: 5px;
  padding: 2px
}
#btnr2{
  margin-right: 5px;
  padding: 2px
}
#btnr3{
  padding: 2px
}
</style>
<script>
  if (window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
  }
</script>
  <body>

  <!--sidebar-->

  <div class="wrapper d-flex align-items-stretch  fixed-side">
           

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
          
    
       
       


        <div class="container-xl">
          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col-sm-6">
                    <h2>List of <b>Students</b> in this Class.</h2>
                  </div>
                  
                  <div class="col-sm-6">
                   
                    <a href="rwd_total.php" type="button" class="btn btn-info"><i class="material-icons custom">class</i> <span>REWARD HISTORY</span></a>
                  </div>
                </div>
              </div>

              <?php if ($_SESSION['error']): ?>
                <div class="alert alert-danger" role="alert" >
                    <center><strong><?php echo $_SESSION['error'];?></strong><center>
                </div>
                <?php   
                    $_SESSION['error'] = false;
                ?>
              <?php endif ?>
              
              <table id="tabler" class="table table-striped table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th hidden>ID</th>
                    <th>Full Name</th>
                    <th>Student Number</th>
                
                    <th>Reward</th>
                  </tr>
                </thead>
                <tbody>
                  				
                <?php

                  $sql="SELECT * from std_enrolled where schd_id=?";
                  $result = $conn->prepare($sql);
                  $result->execute([$idschd]);
                  if($result->rowCount() > 0){
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $idstd = $row['std_id'];

                    $sql2 = "SELECT students.id_std, students.flname_std, students.instemail_std, students.studnum_std, students.gflname_std, students.gemail_std, students.qrcode_std, sections.code_sec, courses.code_crs, year.yearlvl_yr FROM students
                    LEFT JOIN courses on students.crs_id = courses.id_crs
                    left join year on students.yrlvl_id = year.id_yr
                    left join sections on students.sec_id = sections.id_sec where students.id_std=?";
                    $result2 = $conn->prepare($sql2);
                    $result2->execute([$idstd]);

                      if($result2->rowCount() > 0)
                      {
                        while ($row = $result2->fetch(PDO::FETCH_ASSOC)){
                          $id_std=$row["id_std"];
                          $flname_std=$row["flname_std"];
                          $studnum_std=$row["studnum_std"];
                          
                          $crs_id=$row["code_crs"];
                          $yrlvl_id=$row["yearlvl_yr"];
                          $sect_id=$row["code_sec"];
                          $qrcode=$row['qrcode_std'];

                
                          
                          echo '
                          <form method="post" action="students.php">
                            <tr>
                              <td hidden>'.$id_std.'</td>
                              <td>'.$flname_std.'</td>
                              <td>'.$studnum_std.'</td>
                              
                             

                              
                              <td>
                              <a type="button" href="rwd_functions/reward5.php?id='.$id_std.'" class="btn btn-primary" id="btnr1" value="+5" name="rwrdbtn1">+5</button>
                              <a type="button" href="rwd_functions/reward10.php?id='.$id_std.'" class="btn btn-primary" id="btnr2" value="+10" name="rwrdbtn2">+10</button>
                              <a type="button" href="rwd_functions/reward15.php?id='.$id_std.'" class="btn btn-primary" id="btnr3" value="+15" name="rwrdbtn3">+15</button>
                          </td>
                        </tr>
                              </td>
                          </tr>
                          </form>';
                        }
                      }
                    }
                  }
                
                         
  
                    ?>
                </tbody>
              </table>
             
              </div>
            </div>
          </div>        
        </div>

         <!-- Delete Modal HTML -->
         <div id="delModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post">
                <div class="modal-header">						
                  <h4 class="modal-title">Remove Student</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <input type="hidden" name="idstd" id="idstd">
                  <p>Are you sure you want to remove <input id="name" disabled> from this class?</p>
                  <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <button type="submit" class="btn btn-danger" name="btnRem">Remove</button>
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
    
   <script src=" https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
   <script src=" https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
   <script src=" https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>




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
          $('#idstd').val(data[0]);
          $('#name').val(data[1]);
      });
  
  
    });


    

    
   
        $(document).ready(function() {
    var table = $('#tabler').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );
      
      
   
    $(document).ready(function(){
      // Activate tooltip
      $('[data-toggle="tooltip"]').tooltip();
      
     
    });
  
</script>

  </body>
</html>


