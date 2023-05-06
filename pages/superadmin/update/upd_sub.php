<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT * from subjects where subjects.id_subj=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
           
            $id_subj=$row["id_subj"];
            $code_subj=$row["code_subj"];
            $name_subj=$row["name_subj"];
            $units_subj=$row["units_subj"];

        }
    }


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updSub($_REQUEST['updid'],$_POST["name"],$_POST["code"],$_POST["units"]);
      }


?>
  
<head>
<meta charset="UTF-8">
<link rel='icon' href='../../../images/rtu-logo.png'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../../css/css_update/updstyle.css">
    
    <title>Edit Subject</title>
</head>
<body>

    
   
<div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">EDIT SUBJECT</p>
            <div class="separator"></div>
            <form class="login-form" method="post">
               
                <label>Name</label>
                    <div class="form-control">
                        <textarea type="text" name="name" class="textarea" required><?php echo $name_subj;?></textarea>
                    </div>
                    
                <label>Code</label>
                    <div class="form-control">
                        <input type="text" name="code" value="<?php echo $code_subj;?>" required>
                    </div>
                
                <label>Units</label>
                    <div class="form-control">
                        <input type="text" name="units" value="<?php echo $units_subj;?>" required>
                    </div>
            
                    <button class="submit" name="updBtn">Save </button>
                    <button class="cancel" name="cancel" type="cancel" onclick="window.location='../subjects.php';return false;" >Cancel</button>
            </form>
        </div>

    
</body>
</html>