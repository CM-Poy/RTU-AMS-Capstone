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


    if(isset($_POST['updBtn'])){
        include('../../includes/functions.php');
        $obj=new dbfunction();
        $obj->updSchd($_REQUEST['updid'], $_POST['user'], $_POST['sub'], $_POST['sec'], $_POST['day'], $_POST['strtime'], $_POST['endtime'], $_POST['room']);
        }


?>
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Edit Schedule</title>
</head>
<body>

    
   
        <div class="login-container">
            <p class="title">EDIT SCHEDULE</p>
                   
            <form class="login-form" method="post">
                <div class="form-group">
                    <label>Full Name</label>

                        <?php
                          echo '<select name="user" id="user" style="width: 340px">
                          <option value='.$iduser.'>'.$user.'</option>';
                          global $conn;
                          $sql = "SELECT * from users";
                          $result = $conn->prepare($sql);
                          $result->execute();
                      
                          if($result->rowCount() > 0){
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                              $id_users=$row["id_users"];
                              $flname_users=$row["flname_users"];
                              
                          
                              echo '<option value= '.$id_users.'>'.$flname_users.'</option>';
                              }
                          }

                          echo '</select>';
                        ?>

                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    
                    <?php
                        echo '<select name="sub" id="sub" style="width: 340px">
                        <option value='.$idsub.'>'.$sub.'</option>';
                        
                        $sql = "SELECT * from subjects";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_subj=$row["id_subj"];
                        
                            $name_subj=$row["name_subj"];
                        
                            echo '<option value= '.$id_subj.'>'.$name_subj.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>


                  </div>
                  <div class="form-group">
                    <label>Section</label>
                    
                    <?php
                        echo '<select name="sec" id="sec" style="width: 340px">
                        <option value='.$idsec.'>'.$sec.'</option>';
                        
                        $sql = "SELECT * from sections";
                        $result = $conn->prepare($sql);
                        $result->execute();
                    
                        if($result->rowCount() > 0){
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_sec=$row["id_sec"];
                        
                            $code_sec=$row["code_sec"];
                        
                            echo '<option value= '.$id_sec.'>'.$code_sec.'</option>';
                            }
                        }

                        echo '</select>';
                    ?>

                  </div>
                  
                  <div class="form-group">
                    <label>Day</label>
                    
                    <?php
                        echo '<select name="day" id="day" style="width: 340px">
                        <option>'.$day.'</option>';
                        
                        function myDay($dy) {

                            $daynum = date('w', $dy);
                            return '<option name="day">' . date("l", $dy). '</option>';
                        }

                        $dayid = strtotime("sunday");
                        while ($dayid < strtotime("+ 7 days")) {

                            echo myDay($dayid);
                            $dayid += 86400; // number of seconds in a day, to get to next day
                        }
                        
                        echo '</select>';
                        
                    ?>

                  </div>					
                  <div class="form-group">
                    <label>Start</label>
                    
                    <?php
                        echo '<select name="strtime" id="strtime" style="width: 340px">
                        <option>'.$strtime.'</option>';
                        
                        for ($hours=0; $hours<24; $hours++) { // the interval for hours is '1'
                            
                            for($mins=0; $mins<60; $mins+=30) {
                                // the interval for mins is '30'
                                $thehour = str_pad($hours,2,'0',STR_PAD_LEFT);
                                if ($thehour == "00") {

                                    $thehour = "12";
                                }
                                if ($thehour > "12") {

                                    $thehour = $thehour - 12;
                                    if ($thehour < 10) {
                                    $thehour = "0" . $thehour;  
                                    }
                                }

                                $theminutes = str_pad($mins,2,'0',STR_PAD_LEFT);
                                $mytime = $thehour.":".$theminutes;
                                if ($hours < 12) {

                                    $mytime = $mytime . " AM";    
                                }
                                else {

                                    $mytime = $mytime . " PM";
                                }
                                echo '<option>'.$mytime.'</option>';
                            } 
                        }
                        
                        echo '</select>';
                    ?>

                  </div>			
                  <div class="form-group">
                    <label>End</label>
                    
                    <?php
                        echo '<select name="endtime" id="endtime" style="width: 340px">
                        <option>'.$endtime.'</option>';
                        
                        for ($hours=0; $hours<24; $hours++) { // the interval for hours is '1'
                            
                            for($mins=0; $mins<60; $mins+=30) {
                                // the interval for mins is '30'
                                $thehour = str_pad($hours,2,'0',STR_PAD_LEFT);
                                if ($thehour == "00") {

                                    $thehour = "12";
                                }
                                if ($thehour > "12") {

                                    $thehour = $thehour - 12;
                                    if ($thehour < 10) {
                                    $thehour = "0" . $thehour;  
                                    }
                                }

                                $theminutes = str_pad($mins,2,'0',STR_PAD_LEFT);
                                $mytime = $thehour.":".$theminutes;
                                if ($hours < 12) {

                                    $mytime = $mytime . " AM";    
                                }
                                else {

                                    $mytime = $mytime . " PM";
                                }
                                echo '<option>'.$mytime.'</option>';
                            } 
                        }
                        
                        echo '</select>';
                    ?>

                  </div>
                  <div class="form-group">
                    <label>Room</label>

                    <?php
                      echo '<select name="room" id="room" style="width: 340px">
                      <option value='.$idroom.'>'.$room.'</option>';
                      
                      $sql = "SELECT * from room";
                      $result = $conn->prepare($sql);
                      $result->execute();
                  
                      if($result->rowCount() > 0){
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                          $id_room=$row["id_room"];
                      
                          $code_room=$row["code_room"];
                      
                          echo '<option value= '.$id_room.' >'.$code_room.'</option>';
                          }
                      }

                      echo '</select>';
                    ?>

                  </div>			
                </div>

                <a href="../schedules.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" ></a>
                <input type="submit" class="btn btn-info" name="updBtn" value="Save">
            </form>
        </div>

    
</body>
</html>