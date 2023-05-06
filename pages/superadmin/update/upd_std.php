<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT sections.id_sec, courses.id_crs, year.id_yr, students.yrlvl_id, students.id_std, students.flname_std, students.instemail_std, students.studnum_std, students.gflname_std, students.gemail_std, sections.code_sec, courses.code_crs, year.yearlvl_yr FROM students
LEFT JOIN courses on students.crs_id = courses.id_crs
left join year on students.yrlvl_id = year.id_yr
left join sections on students.sec_id = sections.id_sec where students.id_std=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            
    
            $idsec=$row['id_sec'];
            $id_crs=$row['id_crs'];
            $id_yr=$row['id_yr'];
            $id=$row['id_std'];
            $flname_std=$row['flname_std'];
            $studnum_std=$row['studnum_std'];
            $instemail_std=$row['instemail_std'];
            $gflname_std=$row['gflname_std'];
            $gemail_std=$row['gemail_std'];
            $code_sec=$row['code_sec'];
            $code_crs=$row['code_crs'];
            $yearlvl_yr=$row['yearlvl_yr'];
        }
    }


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updStd($_REQUEST['updid'], $_POST['flname'] , $_POST['email'] , $_POST['studnum'] , $_POST['gflname'] , $_POST['gemail'] , $_POST['crs'] , $_POST['yr'] , $_POST['sec']);
        }


?>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../../css/css_update/updatestyle.css">
     <link rel='icon' href='../../../images/rtu-logo.png'/>
    <title>Edit Student</title>
</head>
<body>

    
   
<div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">EDIT STUDENT</p>
            <div class="separator"></div>
            <form class="login-form" method="post">
              
              <label>Full Name</label>
                <div class="form-control">
                  <input type="text" name="flname"  value="<?php echo $flname_std;?>" required/>
                </div>
              
              <label>Institutional Email</label>
                <div class="form-control">
                  <input type="email" name="email" value="<?php echo $instemail_std;?>" required>
                </div>
                
              <label>Student Number</label>
                <div class="form-control">
                  <input type="text" name="studnum"  value="<?php echo $studnum_std;?>" required>
                </div>
                
              <label>Guardian Full Name</label>
                <div class="form-control">
                  <input type="text" name="gflname" value="<?php echo $gflname_std;?>" required>
                </div>			
                
              <label>Guardian Email</label>
                <div class="form-control">
                  <input type="email" name="gemail" value="<?php echo $gemail_std;?>"required>
                </div>	  
                
              <label>Course</label>
                <div class="form-control">
                  

                  <?php
                    echo '<select name="crs" id="crs"  style="width: 100%">
                    <option  value='.$id_crs.'>'.$code_crs.'</option>';
                    
                    $sql = "SELECT id_crs, name_crs, code_crs from courses";
                    $result = $conn->prepare($sql);
                    $result->execute();
                
                    if($result->rowCount() > 0){
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $id_crs=$row["id_crs"];
                        $name_crs=$row["name_crs"];
                        $code_crs=$row["code_crs"];
                    
                        echo '<option value= '.$id_crs.'>'.$name_crs.'</option>';
                        }
                    }

                    echo '</select>';
                  ?>

                </div>			
                
              <label>Year Level</label>
                <div class="form-control">

                  <?php

                    echo '<select name="yr" id="yr" style="width: 100%">
                    <option value='.$id_yr.'>'.$yearlvl_yr.'</option>';

                    $sql = "SELECT id_yr, yearlvl_yr from year";
                    $result = $conn->prepare($sql);
                    $result->execute();

                    if($result->rowCount() > 0){
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $id_yr=$row["id_yr"];
                        $yearlvl_yr=$row["yearlvl_yr"];

                        
                        echo'<option value= '.$id_yr.' >'.$yearlvl_yr.'</option>';
                        }
                    }

                    echo '</select>';
                  ?>

                </div>			
                
              <label>Section</label>
                <div class="form-control">
                  
                  <?php
                      echo '<select name="sec" id="sec" style="width: 100%">
                      <option value='.$idsec.'>'.$code_sec.'</option>';
                      
                      $sql = "SELECT * from sections";
                      $result = $conn->prepare($sql);
                      $result->execute();
                  
                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_sect=$row["id_sec"];
                      
                          $code_sect=$row["code_sec"];
                      
                          echo '<option value= '.$id_sect.'>'.$code_sect.'</option>';
                          }
                      }

                      echo '</select>';
                  ?>
                </div>						


                <a href="../students.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" ></a>
                <button class="submit" name="updBtn">Save</button>
            </form>
          </div>
        </div>

    
</body>
</html>