<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT * from building where id_bldg=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $idbldg=$row['id_bldg'];
            $code=$row['code_bldg'];
            $name=$row['name_bldg'];
        }
    }


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updBldg($_REQUEST['updid'], $_POST['name'], $_POST['code']);
        }


?>
  
  <head>
    <meta charset="UTF-8">
    <link rel='icon' href='../../../images/rtu-logo.png'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../../css/css_update/updstyle.css">
    <title>Edit Building</title>
</head>
<body>

    
   
    <div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">EDIT BUILDING</p>
            <div class="separator"></div>
            <form class="login-form" method="post">
                
                <label>Name</label>
                    <div class="form-control">
                    <textarea type="text" name="name" class="textarea" required><?php echo $name;?></textarea>
                    </div>
                    <div>
                        
                <label>Code</label>
                    <div class="form-control">
                        <input type="text" name="code" value="<?php echo $code;?>" required>
                    </div>
            
                    
                    <button class="submit" name="updBtn">Save </button>
                  <button class="cancel" name="cancel" type="cancel" onclick="window.location='../users.php';return false;" >Cancel</button>
            </form>
        </div>

    
</body>
</html>