<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT users.id_users, users.hnr_users, usertype.id_usertype, users.flname_users, users.instemail_users, users.empnum_users, usertype.usertype, users.usertype_users, users.pwd_users FROM users
LEFT JOIN usertype ON users.usertype_users = usertype.id_usertype where users.id_users=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $id_usertype=$row["id_usertype"];
            $flname_users=$row["flname_users"];
            $hnr_users=$row["hnr_users"];
            $instemail_users=$row["instemail_users"];
            $empnum_users=$row["empnum_users"];
            $pwd_users=$row["pwd_users"];
            $usertype=$row["usertype"];
            
        }
    }


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updUsrSupAdmin($_REQUEST['updid'], $_POST['hnr'] , $_POST['flname'] , $_POST['email'] , $_POST['empnum'] , $_POST['pwd'], $_POST['usertype']);
        }


?>
  
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../../css/css_update/updatestyle.css">
     <link rel='icon' href='../../../images/rtu-logo.png'/>
    
    <title>Edit Teacher</title>
</head>
<body>

    
   
<div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">EDIT TEACHER</p>
            <div class="separator"></div>
            <form class="login-form" method="post">
                   
                
                <label>Honoriffic</label>
                    <div class="form-control">
                        <input type="text" name="hnr"  value="<?php echo $hnr_users;?>" required/>
                    </div>
                    
                <label>Full Name</label>
                    <div class="form-control">
                        <input type="text" name="flname"  value="<?php echo $flname_users;?>" required/>
                    </div>
                    
                <label>Institutional Email</label>
                    <div class="form-control">
                        <input type="email" name="email"  value="<?php echo $instemail_users;?>" required>
                    </div>
                    
                <label>Employee Number</label>
                    <div class="form-control">
                        <input type="text" name="empnum" value="<?php echo $empnum_users;?>" required>
                        </div>
                <label>Password</label>
                    <div class="form-control">
                        <input type="password" name="pwd" value="<?php echo $pwd_users;?>" required>
                    </div>	

                
                    <label>Usertype</label>
                <div class="form-control">
                    <?php
                        echo '<select name="usertype" style="width: 100%">
                        <option value='.$id_usertype.'>'.$usertype.'</option>';
                        
                        $sql = "SELECT * from usertype where id_usertype < 3";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_usertype=$row["id_usertype"];
                        
                            $usertype=$row["usertype"];
                        
                            echo '<option value= '.$id_usertype.'>'.$usertype.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>

                  </div>					
                


                <a href="../users.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" ></a>
                <button class="submit" name="updBtn">Save</button>
            </form>
        </div>

    
</body>
</html>