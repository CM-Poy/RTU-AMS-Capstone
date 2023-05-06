<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT room.id_room, room.code_room, room.bldg_id, building.name_bldg, building.id_bldg from room left join building on room.bldg_id = building.id_bldg  where id_room=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
           
            $code=$row["code_room"];
            $bldg_id=$row["bldg_id"];
            $name_bldg=$row["name_bldg"];
            $id_bldg=$row["id_bldg"];

          
        }
    }


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updRm($_REQUEST['updid'],$_POST["code"],$_POST["bldg"]);
      }


?>
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/css_update/updstyle.css">
    
    <title>Edit Room</title>
</head>
<body>

    
   
    <div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">EDIT ROOM</p>
            <div class="separator"></div>
            <form class="login-form" method="post">
                
                <label>Code</label>
                    <div class="form-control">
                        <input type="text" name="code" value="<?php echo $code;?>" required>
                    </div>

                    
                <label>Building</label>
                    <div class="form-control">
                        
                        <?php
                            echo '<select name="bldg" id="bldg" style="width: 100%">
                            <option value='.$bldg_id.'>'.$name_bldg.'</option>';
                            
                            $sql = "SELECT * from building";
                            $result = $conn->prepare($sql);
                            $result->execute();
                        
                            if($result->rowCount() > 0){
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                                $id_bldg=$row["id_bldg"];
                            
                                $name_bldg=$row["name_bldg"];
                            
                                echo '<option value= '.$id_bldg.'>'.$name_bldg.'</option>';
                                }
                            }

                            echo '</select>';
                        ?>


                    </div>
           
                    <button class="submit" name="updBtn">Save </button>
                    <button class="cancel" name="cancel" type="cancel" onclick="window.location='../rooms.php';return false;" >Cancel</button>        
            </form>
        </div>

    
</body>
</html>