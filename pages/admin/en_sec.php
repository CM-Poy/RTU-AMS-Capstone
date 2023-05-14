<!doctype html>
<html lang="en">

  <?php
  include('../includes/header.php'); 
  require('../includes/config.php');
  



  if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = false;
  }


  $id=$_REQUEST['enid'];


  if(isset($_POST['btnEnsec'])){
    include('../includes/functions.php');
    $obj=new dbfunction();
    $obj->enrSec($_POST['idsec']);
  }
 
 


 


 






  ?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>ADMIN: Enroll Section</title>
</head>
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
                    <h2>Enroll <b>Section</b></h2>
                  </div>
                  
                  <div class="col-sm-6">
                    <a href="enroll.php" class="btn btn-danger"><i class="material-icons">&#xe5c4;</i> <span>Back</span></a>
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
                  <th hidden></th>
                    <th>Code</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  				
                <?php
                
                $sql = "SELECT sections.id_sec, sections.code_sec, courses.code_crs, year.yearlvl_yr FROM sections 
                left JOIN courses on sections.crs_id = courses.id_crs 
                LEFT JOIN year on sections.yrlvl_id = year.id_yr ";
                $result = $conn->prepare($sql);
                $result->execute();
                
                if($result->rowCount() > 0){
                  while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $id_sec=$row["id_sec"];
                    $code_sec=$row["code_sec"];
                    $crs_id=$row["code_crs"];
                    $yrlvl_id=$row["yearlvl_yr"];

                    echo '
                    <form method="post">
                      <tr>
                            <td hidden>'.$id_sec.'</td>
                            <td name="code_sec">'.$code_sec.'</td>
                            <td name="id_crs_fk">'.$crs_id.'</td>
                            <td name="id_yr_fk">'.$yrlvl_id.'</td>
                            
                            <td>
                              
                            <a href="#EnrollModal" value = '.$id_sec.' class="enBtn" data-toggle="modal">Enroll</a>
                             
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
             
              </div>
            </div>
          </div>        
        </div>

  <!-- Enroll Modal HTML -->
  <div id="EnrollModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post">
                <div class="modal-header">						
                  <h4 class="modal-title">Enroll Section</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <input type="hidden" name="idsec" id="idsec">							
                  <p>Are you sure you want to enroll this Section?</p>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  <button type="submit" class="btn btn-success" name="btnEnsec">ENROLL</button>
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


  $(document).ready(function () {
            $('.enBtn').on('click', function () {
              $('#EnrollModal').modal('show');
              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#idsec').val(data[0]);
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


