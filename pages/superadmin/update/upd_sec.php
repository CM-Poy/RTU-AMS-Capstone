<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT sections.id_sec, sections.code_sec, courses.code_crs, courses.name_crs, year.yearlvl_yr, sections.yrlvl_id, sections.crs_id FROM sections 
left JOIN courses on sections.crs_id = courses.id_crs 
LEFT JOIN year on sections.yrlvl_id = year.id_yr where sections.id_sec=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
           
            $id_sec=$row["id_sec"];
            $code_sec=$row["code_sec"];
            $code_crs=$row["code_crs"];
            $yrlvl_yr=$row["yearlvl_yr"];
            $crs_id=$row["crs_id"];
            $yrlvl_id=$row["yrlvl_id"];
            $name_crs=$row["name_crs"];



          
        }
    }


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updSec($_REQUEST['updid'],$_POST["code"],$_POST["crs"],$_POST["yr"]);
      }


?>
  
<head>
    <meta charset="UTF-8">
    <link rel='icon' href='../../../images/rtu-logo.png'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../../css/css_update/updstyle.css">
    <title>Edit Section</title>
</head>
<body>

    
   
<div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">EDIT SECTION</p>
            <div class="separator"></div>
            <form class="login-form" method="post">

                <label>Code</label>
                    <div class="form-control">
                        <input type="text" name="code"  value="<?php echo $code_sec;?>" required>
                    </div>

                    
                <label>Course</label>
                    <div class="form-control">
                    
                        <?php
                        echo '<select name="crs" id="crs" style="width: 100%">
                        <option value='.$crs_id.'>'.$name_crs.'</option>';
                        
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
                        <option value='.$yrlvl_id.'>'.$yrlvl_yr.'</option>';

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
           
                    <button class="submit" name="updBtn">Save </button>
                    <button class="cancel" name="cancel" type="cancel" onclick="window.location='../sections.php';return false;" >Cancel</button>
            </form>
        </div>

    
</body>
</html>