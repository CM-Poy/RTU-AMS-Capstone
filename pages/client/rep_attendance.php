<?php


include('../includes/header.php'); 
require('../includes/config.php');
session_start();

$sub =$_SESSION['subid'];

$sql = "SELECT * from subjects where id_subj = $sub";
$query = $conn->prepare($sql);
$query->execute();
if($query->rowCount() > 0){
                
    while ($row = $query->fetch(PDO::FETCH_ASSOC)){
        $subname=$row['name_subj'];

    }
}

$sec=$_SESSION['secid'];
$sql = "SELECT * from sections where id_sec = $sub";
$query = $conn->prepare($sql);
$query->execute();
if($query->rowCount() > 0){
                
    while ($row = $query->fetch(PDO::FETCH_ASSOC)){
        $codesec=$row['code_sec'];

    }
}







?>


<!DOCTYPE html>
<html>

<style id="table_style" type="text/css">
    body
    {
        font-family: Arial;
        font-size: 10pt;
    }
    table
    {
        border: 1px solid #ccc;
        border-collapse: collapse;
    }
    table th
    {
        background-color: #F7F7F7;
        color: #333;
        font-weight: bold;
    }
    table th, table td
    {
        padding: 5px;
        border: 1px solid #ccc;
    }
</style>
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


           

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
          
    
       
       

      <form method="post">
        <div class="container-xl">
      
        
        

          <div class="table-responsive">
            <div class="table-wrapper">
              <div class="table-title">
                
                <div class="row">
                    <div class="col-sm-4">
                        <h2><B><?php echo $subname; ?></B></h2>
                        
                        </div>

                    
                </div>
                <div class="row">
                    <div class="col-sm-4">
                    
                        <h2><B><?php echo $codesec; ?></B></h2>
                
                    </div>

                    
                    
                </div>
                <div class="row">
                    
                    <div class="col-sm-4">
                    
                        <h2>PAST ATTENDANCE:</h2>
                    
                    </div>
                    
                    
                </div>

                <div class="row">
                    
                    
                    
                    
                    
                    <?php
                            $idschd=$_SESSION['schdid'];
                            $sql = "SELECT schd_id, date FROM attendance_record WHERE schd_id=?  GROUP by `date`";
                            $query = $conn->prepare($sql);
                            $query->execute([$idschd]);
                            if($query->rowCount() > 0){
                                            
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)){

                                    $datetext=date('F j, Y', strtotime($row['date']));

                                    

                                    ?><button type="submit" class="btn btn-info" name="btnDate" value="<?php echo $datetext;?>"><?php echo $datetext;?></button>
                                    

                                    <?php
                                    
                                }
                            }

                    ?>
                    
                    
                </div>
                 
                    
                   
                     
                      
                    
                  
            </div>
              <table id="tabler" class="table table-striped table-hover" style="width:100%">

                <?php

                    if(isset($_POST['btnDate'])){
                        $datestring = $_POST['btnDate'];
                        
                        ?> <button onclick="printTabler();" class="btn btn-success" id="print-btn">Print Attendance</button>
                        <h2><B><?php echo $datestring; ?></B></h2>
                        
               
                <thead>
                    
                  <tr>
                    <th hidden>ID</th>
                    <th>Full Name</th>
                    <th>Attendance</th>

                    
                  </tr>
                </thead>
                <tbody>
                    
                <?php
                
                    
                    
                    $datestamp = strtotime($datestring);

                    $date=date('Y-m-d',$datestamp);


                    $idschd=$_SESSION['schdid'];
                    $sql = "SELECT id_att, std_id, `type` FROM attendance_record WHERE schd_id=? AND date=? ";
                    $query = $conn->prepare($sql);
                    $query->execute([$idschd,$date]);
                    if($query->rowCount() > 0){
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                            $idatt=['id_att'];
                            $idstd=$row['std_id'];

                            $sql2= "SELECT attendance_record.date, attendance_record.std_id, attendance_record.id_att, students.flname_std from attendance_record left join students on attendance_record.std_id=students.id_std WHERE students.id_std=? and `date`=?";
                            $query2 = $conn->prepare($sql2);
                            $query2->execute([$idstd,$date]);

                            if($query2->rowCount() > 0){
                                while ($row = $query2->fetch(PDO::FETCH_ASSOC)){
                                   
                                    $student=$row['std_id'];
                                    $namestd=$row['flname_std'];

                                    ?>
                                    <tr>
                                        <td hidden>
                                            <?php echo $student;?>
                                        </td>
                                        <td>
                                            <?php echo $namestd;?>
                                        </td>
                                            
                                    <?php

                                    $sql3="SELECT attendance_record.std_id, attendance_record.type, students.flname_std, type.typename FROM attendance_record  left join `type` on attendance_record.type=type.id_type left join students on attendance_record.std_id=students.id_std where std_id=? and `date`=?";
                
                                    $query3 = $conn->prepare($sql3);
                                    $query3->execute([$student,$date]);
                                    if($query3->rowCount() > 0){
                                        while ($row = $query3->fetch(PDO::FETCH_ASSOC)){

                                            $type=$row['typename'];

                                            ?>
                                                <td>
                                                    <?php echo $type;?>
                                                </td>
                                            
                                            <?php  
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
              
                </tbody>
                
              </table>
              



              
              
             
              </div>
            </div>
            <a href="sum_attendance.php" type="button" class="btn btn-danger"><span>View Attendance Summary</span></a>  
          </div>   
             
        </div>
        
        </form>
        

        



      
      
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

function printTabler() {
   
        var printWindow = window.open('', '', 'height=1000,width=1000');
        printWindow.document.write('<html><head><title>ATTENDANCE</title>');
 
        //Print the Table CSS.
        var table_style = document.getElementById("table_style").innerHTML;
        printWindow.document.write('<style type = "text/css">');
        printWindow.document.write(table_style);
        printWindow.document.write('</style>');
        printWindow.document.write('</head>');
 
        //Print the DIV contents i.e. the HTML Table.
        printWindow.document.write('<body>');
        printWindow.document.write('<h3><?php echo $subname; ?></h3>');
        printWindow.document.write('<h3><?php echo $codesec; ?></h3>');
        printWindow.document.write('<p><?php echo $datestring; ?></p>');
        printWindow.document.write('<table>');
        var divContents = document.getElementById("tabler").innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.write('</table>');
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        printWindow.document.close();
        printWindow.print();
    
}


function printTable() {
   
   var printWindow = window.open('', '', 'height=1000,width=1000');
   printWindow.document.write('<html><head><title>ATTENDANCE</title>');

   //Print the Table CSS.
   var table_style = document.getElementById("table_style").innerHTML;
   printWindow.document.write('<style type = "text/css">');
   printWindow.document.write(table_style);
   printWindow.document.write('</style>');
   printWindow.document.write('</head>');

   //Print the DIV contents i.e. the HTML Table.
   printWindow.document.write('<body>');
   printWindow.document.write('<h3><?php echo $subname; ?></h3>');
   printWindow.document.write('<h3><?php echo $codesec; ?></h3>');
   printWindow.document.write('<table>');
   var divContents = document.getElementById("table").innerHTML;
   printWindow.document.write(divContents);
   printWindow.document.write('</table>');
   printWindow.document.write('</body>');

   printWindow.document.write('</html>');
   printWindow.document.close();
   printWindow.print();

}




    
   
    $(document).ready(function() {
    var table = $('#tabler').DataTable( {
        order: [[1, 'asc']],
        responsive: true
    } );
} );
      
      
   
    




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
