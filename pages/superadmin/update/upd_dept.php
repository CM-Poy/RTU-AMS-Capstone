<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT * from departments where id_dept=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $id=$row["id_dept"];
            $code=$row["code_dept"];
            $name=$row["name_dept"];
          
        }
    }


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updDept($_REQUEST['updid'],$_POST["name"],$_POST["code"]);
      }


?>
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Edit Buildings</title>
</head>
<body>

    
   
        <div class="login-container">
            <p class="title">EDIT BUILDINGS</p>
            <form method="post">
                <div>
                    <label>Name</label>
                    <input type="text" name="name"  value="<?php echo $name;?>" required/>
                </div>
                <div>
                    <label>Code</label>
                    <input type="text" name="code" class="form-control" value="<?php echo $code;?>" required>
                </div>
           
                <a href="../departments.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" ></a>
                <input type="submit" class="btn btn-info" name="updBtn" value="Save">
            </form>
        </div>

    
</body>
</html>