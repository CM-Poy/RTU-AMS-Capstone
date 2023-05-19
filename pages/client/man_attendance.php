<!doctype html>
<html lang="en">

  <?php
use PHPMailer\PHPMailer\PHPMailer;
session_start();
include('../includes/header.php'); 
require('../includes/config.php');

$secid=$_SESSION['secid'];
$idschd=$_SESSION['schdid'];


  if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = false;
  }

  
  
  
if(isset($_POST['saveAtt'])){

  $sql="SELECT schd_id, doc, COUNT(*) AS count FROM attendance_list GROUP BY schd_id, doc HAVING count > 1";
  $query = $conn->prepare($sql);
  $query->execute();

  if($query->rowCount() > 0){
      while ($row = $query->fetch(PDO::FETCH_ASSOC)){
          $idschd = $row['schd_id'];
          $doc = $row['doc'];

          $sql2="DELETE FROM attendance_list WHERE schd_id = ? AND doc = ? ORDER BY id_att DESC LIMIT 1";
          $query2 = $conn->prepare($sql2);
          $query2->execute([$idschd,$doc]);

          //$_SESSION['error']="ATTENDANCE ALREADY DONE FOR THIS SUBJECT.";
      }
  }else{
      $idsched=$_SESSION['schdid'];
      $date=date('Y-m-d');
      $datetime=date('Y-m-d H:i:s');
      $sql="INSERT INTO attendance_list (`schd_id`,`doc`,`datetimecreated`) values (?,?,?)";
      $query = $conn->prepare($sql);
      $query->execute([$idsched,$date,$datetime]);

  }

  if(isset($_POST['present'])){
    
    foreach($_POST['present'] as $std){
      $date=date('Y-m-d');
      $sql="SELECT * from attendance_list where schd_id=? AND doc=?";
      $result = $conn->prepare($sql);
      $result->execute([$idschd,$date]);
      if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
          $idatt = $row['id_att'];
          $idschd = $row['schd_id'];

          $sql="SELECT * from std_enrolled where schd_id=?";
          $result = $conn->prepare($sql);
          $result->execute([$idschd]);

          if($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)){
              $idstd = $row['std_id'];

              $sql="SELECT * from attendance_record WHERE att_id=? and std_id=?";
              $result2 = $conn->prepare($sql);
              $result2->execute([$idatt,$std]);

              if($result2->rowCount() > 0){
                while ($row = $result2->fetch(PDO::FETCH_ASSOC)){
                  $idstd = $row['std_id'];
                  $sql="SELECT * from students WHERE id_std=?";
                  $result = $conn->prepare($sql);
                  $result->execute([$std]);
                
                  foreach($result as $row){
                    echo "Attendance for <b>".$row['flname_std']."</b> was already recorded.<br>";
                  }
                  
                }
              }else{
                $type = 1;
                $date= date('Y-m-d');
                $idschd=$_SESSION['schdid'];
        
                $sql = "INSERT into attendance_record (att_id, std_id, `type`, `date`) VALUES (?,?,?,?)";
                $result = $conn->prepare($sql);
                $result->execute([$idatt,$std,$type,$date]);




                $sql3= "SELECT * FROM students WHERE id_std=?";
                $query3 = $conn->prepare($sql3);
                $query3->execute([$std]);
                if($query3->rowCount() > 0){
    
                    while ($row = $query3->fetch(PDO::FETCH_ASSOC)){
                        $stdname=$row['flname_std'];
                        $name=$row['gflname_std'];
                        $email=$row['gemail_std'];

                        $subj=$_SESSION['subid'];
                        $sql4= "SELECT * FROM subjects WHERE id_subj=?";
                        $query4 = $conn->prepare($sql4);
                        $query4->execute([$subj]);

                        if($query4->rowCount() > 0){
    
                            while ($row2 = $query4->fetch(PDO::FETCH_ASSOC)){
                                $subj=$row2["name_subj"];
                            }
                        }

                        
                    }
                        $datetime2=date('Y-m-d H:i:s');
                        $subject = "ATTENDANCE RESULT";
                        $message = $stdname." was PRESENT in his class ".$subj.". Recorded ".$datetime2.".";

                        require "../../vendor/autoload.php";
                        $mail = new PHPMailer(true);

                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        
                        $mail->isSMTP();
                        $mail->SMTPAuth = true;
                        
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                        
                        $mail->Username = "rtuboni.ams@gmail.com";
                        $mail->Password = "twaeftlsfuwcxhwo";
                        
                        $mail->setFrom("rtuboni.ams@gmail.com","RTU Boni-Attendance Management System");
                        $mail->addAddress($email, $name);
                        
                        $mail->Subject = $subject;
                        $mail->Body = $message;
                        
                        $mail->send();
                }

                
              }
            }
          }
        }
      }
    }
  }

  if(isset($_POST['absent'])){
    foreach($_POST['absent'] as $std){
      $date=date('Y-m-d');
      $sql="SELECT * from attendance_list where schd_id=? AND doc=?";
      $result = $conn->prepare($sql);
      $result->execute([$idschd,$date]);
      if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
          $idatt = $row['id_att'];
          $idschd = $row['schd_id'];

          $sql="SELECT * from std_enrolled where schd_id=?";
          $result = $conn->prepare($sql);
          $result->execute([$idschd]);

          if($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)){
              $idstd = $row['std_id'];

              $sql="SELECT * from attendance_record WHERE att_id=? and std_id=?";
              $result2 = $conn->prepare($sql);
              $result2->execute([$idatt,$std]);

              if($result2->rowCount() > 0){
                while ($row = $result2->fetch(PDO::FETCH_ASSOC)){
                  $idstd = $row['std_id'];
                  $sql="SELECT * from students WHERE id_std=?";
                  $result = $conn->prepare($sql);
                  $result->execute([$std]);
                
                  foreach($result as $row){
                    echo "Attendance for <b>".$row['flname_std']."</b> was already recorded.<br>";
                  }
                  
                }
              }else{
                $type = 2;
                $date= date('Y-m-d');
                $idschd=$_SESSION['schdid'];

                $sql = "INSERT into attendance_record (att_id, std_id, `type`, `date`) VALUES (?,?,?,?)";
                $result = $conn->prepare($sql);
                $result->execute([$idatt,$std,$type,$date]);

                $sql3= "SELECT * FROM students WHERE id_std=?";
                $query3 = $conn->prepare($sql3);
                $query3->execute([$std]);
                if($query3->rowCount() > 0){
    
                    while ($row = $query3->fetch(PDO::FETCH_ASSOC)){
                        $stdname=$row['flname_std'];
                        $name=$row['gflname_std'];
                        $email=$row['gemail_std'];

                        $subj=$_SESSION['subid'];
                        $sql4= "SELECT * FROM subjects WHERE id_subj=?";
                        $query4 = $conn->prepare($sql4);
                        $query4->execute([$subj]);

                        if($query4->rowCount() > 0){
    
                            while ($row2 = $query4->fetch(PDO::FETCH_ASSOC)){
                                $subj=$row2["name_subj"];
                            }
                        }

                        
                    }
                        $datetime2=date('Y-m-d H:i:s');
                        $subject = "ATTENDANCE RESULT";
                        $message = $stdname." was ABSENT in his class ".$subj.". Recorded ".$datetime2.".";

                        require "../../vendor/autoload.php";
                        $mail = new PHPMailer(true);

                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        
                        $mail->isSMTP();
                        $mail->SMTPAuth = true;
                        
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                        
                        $mail->Username = "rtuboni.ams@gmail.com";
                        $mail->Password = "twaeftlsfuwcxhwo";
                        
                        $mail->setFrom("rtuboni.ams@gmail.com","RTU Boni-Attendance Management System");
                        $mail->addAddress($email, $name);
                        
                        $mail->Subject = $subject;
                        $mail->Body = $message;
                        
                        $mail->send();
                }
              }
            }
          }
        }
      }
    }
  }
  
  if(isset($_POST['late'])){
    foreach($_POST['late'] as $std){
      $date=date('Y-m-d');
      $sql="SELECT * from attendance_list where schd_id=? AND doc=?";
      $result = $conn->prepare($sql);
      $result->execute([$idschd,$date]);
      if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
          $idatt = $row['id_att'];
          $idschd = $row['schd_id'];

          $sql="SELECT * from std_enrolled where schd_id=?";
          $result = $conn->prepare($sql);
          $result->execute([$idschd]);

          if($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)){
              $idstd = $row['std_id'];

              $sql="SELECT * from attendance_record WHERE att_id=? and std_id=?";
              $result2 = $conn->prepare($sql);
              $result2->execute([$idatt,$std]);

              if($result2->rowCount() > 0){
                while ($row = $result2->fetch(PDO::FETCH_ASSOC)){
                  $idstd = $row['std_id'];
                  $sql="SELECT * from students WHERE id_std=?";
                  $result = $conn->prepare($sql);
                  $result->execute([$std]);
                
                  foreach($result as $row){
                    echo "Attendance for <b>".$row['flname_std']."</b> was already recorded.<br>";
                  }
                  
                }
              }else{
                $type = 3;
                $date= date('Y-m-d');
                $idschd=$_SESSION['schdid'];

                $sql = "INSERT into attendance_record (att_id, std_id, `type`, `date`) VALUES (?,?,?,?)";
                $result = $conn->prepare($sql);
                $result->execute([$idatt,$std,$type,$date]);


                $sql3= "SELECT * FROM students WHERE id_std=?";
                $query3 = $conn->prepare($sql3);
                $query3->execute([$std]);
                if($query3->rowCount() > 0){
    
                    while ($row = $query3->fetch(PDO::FETCH_ASSOC)){
                        $stdname=$row['flname_std'];
                        $name=$row['gflname_std'];
                        $email=$row['gemail_std'];

                        $subj=$_SESSION['subid'];
                        $sql4= "SELECT * FROM subjects WHERE id_subj=?";
                        $query4 = $conn->prepare($sql4);
                        $query4->execute([$subj]);

                        if($query4->rowCount() > 0){
    
                            while ($row2 = $query4->fetch(PDO::FETCH_ASSOC)){
                                $subj=$row2["name_subj"];
                            }
                        }

                        
                    }
                        $datetime2=date('Y-m-d H:i:s');
                        $subject = "ATTENDANCE RESULT";
                        $message = $stdname." was LATE in his class ".$subj.". Recorded ".$datetime2.".";

                        require "../../vendor/autoload.php";
                        $mail = new PHPMailer(true);

                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        
                        $mail->isSMTP();
                        $mail->SMTPAuth = true;
                        
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                        
                        $mail->Username = "rtuboni.ams@gmail.com";
                        $mail->Password = "twaeftlsfuwcxhwo";
                        
                        $mail->setFrom("rtuboni.ams@gmail.com","RTU Boni-Attendance Management System");
                        $mail->addAddress($email, $name);
                        
                        $mail->Subject = $subject;
                        $mail->Body = $message;
                        
                        $mail->send();
                }
              }
            }
          }
        }
      }
    } 
  }
}



  



 


 






  ?>
  

<head>
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Record Attendance Manual</title>
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
          
    
       
       

      <form method="post">
        <div class="container-xl">
          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col-sm-6">
                    <h2>Record <b>Attendance</b> Manually</h2>
                  </div>
                  
                    <div class="col-sm-6">
                    <button type="submit" class="btn btn-danger" name="saveAtt">Save</button>
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
                    <th>Attendance</th>
                    
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

                      if($result2->rowCount() > 0){
                        while ($row = $result2->fetch(PDO::FETCH_ASSOC)){
                          $id_std=$row["id_std"];
                          $flname_std=$row["flname_std"];
                          $studnum_std=$row["studnum_std"];
                          
                          $crs_id=$row["code_crs"];
                          $yrlvl_id=$row["yearlvl_yr"];
                          $sect_id=$row["code_sec"];
                          $qrcode=$row['qrcode_std'];
                          
                        
    
    
    
                             //     $sql="SELECT * from std_enrolled where schd_id=? and std_id=?";
                             //     $query = $conn->prepare($sql);
                             //     $query->execute([$idschd,$std]);
                      
                             //     if($query->rowCount() > 0){
                             //         while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                             //         $idstd=$row['std_id'];
                                      
                             //         $sql2="INSERT INTO draft_att (`schd_id`,`std_id`,`type`) VALUES (?,?,?)";
                             //        $query2 = $conn->prepare($sql2);
                              //        $query2->execute([$idschd,$id_std,$value]);
                                  
                                  
                              
                              
                              //        }
                              //    }
                            
                          
                
                          
                          echo '
                          <form method="post">
                            <tr>
                                <td hidden>'.$id_std.'
                                <input type="hidden" name="idstd" id="idstd" value='.$id_std.'></td>
                                <td>'.$flname_std.'</td>
                           
                                <td style="width: 750px; font-size:15px;">


                                <input type="checkbox" name="present[]" value='.$id_std.' onchange="handleCheckbox(this)">Present     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</input>
                                
                                <input type="checkbox" name="absent[]" value='.$id_std.' onchange="handleCheckbox(this)">Absent     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                
                                <input type="checkbox" name="late[]" value='.$id_std.' onchange="handleCheckbox(this)">Late</label>
                                

                                </td>
                          </tr>
                          </form>';
                    
                            }
                          }
                        }
                      }else{
                        echo "No Records Found.";
                      }
                    

                      

                        
                    
                    
                  
                
                      
                  



                  





  
                    ?>
                </tbody>
              </table>
             
              </div>
            </div>
          </div>        
        </div>
        </form>

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
        order: [[1, 'asc']],
        responsive: true
    } );
} );
      
      
   
    $(document).ready(function(){
      // Activate tooltip
      $('[data-toggle="tooltip"]').tooltip();
      
     
    });




        function handleCheckbox(checkbox) {
            var checkboxes = checkbox.parentNode.parentNode.getElementsByTagName("input");
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type === "checkbox" && checkboxes[i] !== checkbox) {
                    checkboxes[i].checked = false;
                }
            }
        }

  
</script>

  </body>
</html>


