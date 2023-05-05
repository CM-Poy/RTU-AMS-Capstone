<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['updid'];

global $conn;
$sql = "SELECT users.id_users, subjects.id_subj, sections.id_sec, room.id_room, schedules.id_schd, users.flname_users, subjects.code_subj, sections.code_sec, schedules.day_schd, schedules.strtime_schd, schedules.endtime_schd, room.code_room from schedules left join users on schedules.user_id = users.id_users LEFT JOIN subjects on schedules.sub_id = subjects.id_subj LEFT JOIN sections on schedules.sec_id = sections.id_sec LEFT JOIN room on schedules.room_id = room.id_room where schedules.id_schd=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $iduser=$row['id_users'];
            $idsub=$row['id_subj'];
            $idsec=$row['id_sec'];
            $idroom=$row['id_room'];
            $id=$row['id_schd'];
            $user=$row['flname_users'];
            $sub=$row['code_subj'];
            $sec=$row['code_sec'];
            $day=$row['day_schd'];
            $strtime=$row['strtime_schd'];
            $endtime=$row['endtime_schd'];
            $room=$row['code_room'];
        }
    }


if(isset($_POST['btnUpd'])){
    include('includes/functions.php');
    $obj=new dbfunction();
    $obj->updUsrPwd($_REQUEST['updid'],$_POST['oldpwd'], $_POST['newpwd'], $_POST['conpwd']);
    }

    


?>
  
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../../css/css_update/editstyle.css">
    
    <title>Edit Schedule</title>
</head>
<body>

    
   
    <div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">EDIT SCHEDULE</p>
            <div class="separator"></div>
            <form class="login-form" method="post">

            <label>Old Password</label>  
                <div class="form-control">
                    <input type="password" name="oldpwd" id="oldpwd"><span toggle="#oldpwd" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
            
            <label>New Password</label>
                <div class="form-control">
                    <input type="password" name="newpwd" id="newpwd"><span toggle="#newpwd" class="fa fa-fw fa-eye field-icon toggle-password"> </span>
                </div>
            
            <label>Confirm Password</label>
                <div class="form-control">
                    <input type="password" name="conpwd" id="conpwd"><span toggle="#conpwd" class="fa fa-fw fa-eye field-icon toggle-password"> </span>
                </div>
                 
                	
                <button class="submit" name="updBtn">Save </button>
                <button class="cancel" name="cancel" type="cancel" onclick="window.location='../account.php';return false;" >Cancel</button>
                   
            </form>
            </div>
            </div>
    </div>
        		
               

    
</body>
</html>

<script>
     



     $(".toggle-password").click(function() {
     
     $(this).toggleClass("fa-eye fa-eye-slash");
     var input = $($(this).attr("toggle"));
     if (input.attr("type") == "password") {
       input.attr("type", "text");
     } else {
       input.attr("type", "password");
     }
     });
         </script>