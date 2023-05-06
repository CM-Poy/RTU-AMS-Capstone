<?php


include('../includes/header.php'); 
require('../includes/config.php');




$sql= "SELECT * FROM students";
$query = $conn->prepare($sql);
$query->execute();
if($query->rowCount() > 0){
        
    while ($row = $query->fetch(PDO::FETCH_ASSOC)){
      $std=$row['flname_std'];

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
<body>



<table style="width:100%">
  <tr>
    <th>Student</th>
    <th>Present</th>
    <th>Absent</th>
    <th>Late</th>
  </tr>
  <tr>
    <td><?php echo $std; ?></td>
    <td><?php ?></td>
    <td><?php ?></td>
    <td></td>
  </tr>
 
</table>



</body>
</html>