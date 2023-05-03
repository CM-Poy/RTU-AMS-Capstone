<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT courses.id_crs, courses.code_crs, courses.name_crs, departments.id_dept, departments.code_dept, departments.name_dept FROM courses left JOIN departments ON courses.dept_id = departments.id_dept where courses.id_crs=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $id_crs=$row["id_crs"];
            $code=$row["code_crs"];
            $name=$row["name_crs"];
            $dept=$row["id_dept"];
            $name_dept=$row["name_dept"];
        }
    }


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updCrs($_REQUEST['updid'],$_POST["name"],$_POST["code"],$_POST["dept"]);
      }


?>
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/css_update/updatestyle.css">
    
    <title>Edit Courses</title>
</head>
<body>

    
   
    <div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">EDIT COURSES</p>
            <div class="separator"></div>
            <form class="login-form" method="post">
                
                <label>Name</label>
                    <div class="form-control">
                    <textarea type="text" name="name" class="textarea" required><?php echo $name;?></textarea>
                    
                <label>Code</label>
                    <div class="form-control">
                        <input type="text" name="code"  value="<?php echo $code;?>" required>
                    </div>
                    
                <label>Department</label>
                    <div class="form-control">
                        <?php
                        echo '<select id="dept" name="dept" style="width: 340px">
                        <option value='.$dept.'>'.$name_dept.'</option>';
                
                        $sql = "SELECT * from departments";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_dept=$row["id_dept"];
                            $name_dept=$row["name_dept"];
                            $code_dept=$row["code_dept"];
                        
                            echo '<option value= '.$id_dept.'>'.$name_dept.'</option>';
                            }
                        }

                        echo '</select>';
                        ?>
                    </div>
           
                <a href="../courses.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" ></a>
                <button class="submit" name="updBtn">Save</button>  
            </form>
        </div>

    
</body>
</html>