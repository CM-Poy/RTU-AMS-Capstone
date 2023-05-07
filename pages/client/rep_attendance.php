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
<style>
table, th, td {
  border:1px solid black;
}
</style>
<head>

<link rel='icon' href='../images/rtu-logo.png'/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<h5><p>SUBJECT:  <?php echo $subname;?> </p>
<h5><p>SECTION:  <?php echo $codesec;?> </p>




<table style="width:100%">
  <tr>
    <th>Student</th>
    <th>Present</th>
    <th>Absent</th>
    <th>Late</th>
  </tr>

<?php

$schd=$_SESSION['schdid'];

  $sql= "SELECT * FROM attendance_list WHERE schd_id=?";
$query = $conn->prepare($sql);
$query->execute([$schd]);
if($query->rowCount() > 0){
        
    while ($row = $query->fetch(PDO::FETCH_ASSOC)){

        $attid=$row['id_attendance'];

        $sql2= "SELECT attendance_record.stud_id, attendance_record.attendance_id, students.flname_std from attendance_record left join students on attendance_record.stud_id=students.id_std WHERE attendance_id=?";
        $query2 = $conn->prepare($sql2);
        $query2->execute([$attid]);

        if($query2->rowCount() > 0){
                
            while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)){
                $student=$row2['stud_id'];
                $namestd=$row2['flname_std'];
                ?><tr><td><?php echo $namestd;?></td><?php
                
                $sql3="SELECT  attendance_record.stud_id, attendance_record.type, COUNT(*) AS count, students.flname_std FROM attendance_record left join students on attendance_record.stud_id=students.id_std where type=1 and stud_id=? and attendance_id=?  GROUP BY stud_id, type HAVING count > 0;";
                
                $query3 = $conn->prepare($sql3);
                $query3->execute([$student,$attid]);
                if($query3->rowCount() > 0){
                
                    while ($row3 = $query3->fetch(PDO::FETCH_ASSOC)){
                        $stdname=$row3['flname_std'];
                        $present=$row3['count'];

                        ?>
                        <td><?php echo $present;?></td>
                        <?php

                        $sql="SELECT  attendance_record.stud_id, attendance_record.type, COUNT(*) AS count FROM attendance_record left join students on attendance_record.stud_id=students.id_std where type=2 and stud_id=?  GROUP BY stud_id, type HAVING count > 0;";
                                        
                        $query = $conn->prepare($sql);
                        $query->execute([$student]);
                        if($query->rowCount() > 0){

                            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                                $absent=$row['count'];
                                
                                ?>
                                <td><?php echo $absent;?></td>
                                <?php 

                                $sql="SELECT  attendance_record.stud_id, attendance_record.type, COUNT(*) AS count FROM attendance_record left join students on attendance_record.stud_id=students.id_std where type=3 and stud_id=?  GROUP BY stud_id, type HAVING count > 0;";
                                                                        
                                $query = $conn->prepare($sql);
                                $query->execute([$student]);
                                if($query->rowCount() > 0){

                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                                        $late=$row['count'];
                                         
                                        ?>
                                        <td><?php echo $late;?></td>
                                        <?php 
                                    }
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
</table>

</BR><center><button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>



</body>
</html>
