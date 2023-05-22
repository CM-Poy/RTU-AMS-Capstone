<?php


include('../includes/header.php'); 
require('../includes/config.php');
session_start();

$sub = $_SESSION['subid'];


$sql = "SELECT * from subjects where id_subj = $sub";
$query = $conn->prepare($sql);
$query->execute();
if($query->rowCount() > 0){
                
    while ($row = $query->fetch(PDO::FETCH_ASSOC)){
        $codesec=$row['name_subj'];

    }
}

$sec=$_SESSION['secid'];
$sql2 = "SELECT * from sections where id_sec = $sub";
$query2 = $conn->prepare($sql2);
$query2->execute();
if($query2->rowCount() > 0){
                
    while ($row = $query2->fetch(PDO::FETCH_ASSOC)){
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
        <a href="today.php" type="button" class="btn btn-warning"><span>GO BACK</span></a>
        
        

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
                    
                        <h2><b>REWARD HISTORY FOR THIS WEEK:</b></h2>
                        <h4><span>Please select date</span><h4>
                    
                    </div>
                    
                    
                </div>

                <div class="row">
                    
                    
                    
                    
                    
                    <?php
                            $idschd=$_SESSION['schdid'];
                            $sql = "SELECT schd_id, reward_date FROM rewards WHERE schd_id=?  GROUP by `reward_date`";
                            $query = $conn->prepare($sql);
                            $query->execute([$idschd]);
                            if($query->rowCount() > 0){
                                            
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)){

                                    $datetext=date('F j, Y', strtotime($row['reward_date']));

                                    

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
                        
                        ?> 
                        
               
                <thead>
                    
                  <tr>
                    <th hidden>ID</th>
                    <th>Full Name</th>
                    <th>Total reward</th>

                    
                  </tr>
                </thead>
                <tbody>
                    
                <?php
                
                    
                    
                    $datestamp = strtotime($datestring);

                    $date=date('Y-m-d',$datestamp);


                    

                            $sql2= "SELECT rewards.schd_id, rewards.id_reward, rewards.reward_date, rewards.std_id, students.flname_std, SUM(rewards.reward_val) as total from rewards left join students on rewards.std_id=students.id_std WHERE schd_id=? and `reward_date`=? GROUP BY rewards.std_id";
                            $query2 = $conn->prepare($sql2);
                            $query2->execute([$idschd,$date]);

                            if($query2->rowCount() > 0){
                                while ($row = $query2->fetch(PDO::FETCH_ASSOC)){
                                   
                                    
                                    $namestd=$row['flname_std'];
                                    $total=$row['total'];
                                    ?>
                                    <tr>
                                        <td hidden>
                                            
                                        </td>
                                        <td>
                                            <?php echo $namestd;?>
                                        </td>
                                        <td>
                                            <?php echo $total;?>
                                        </td>
                                            
                                    <?php
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
