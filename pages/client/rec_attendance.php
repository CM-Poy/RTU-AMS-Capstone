<?php 
require('../includes/config.php');
session_start();
$secid=$_SESSION['secid'];

global $conn;
$sql = "SELECT students.sec_id, students.flname_std, sections.code_sec from students left join sections on students.sec_id = sections.id_sec where sec_id=?";
$result = $conn->prepare($sql);
$result->execute([$secid]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            
            
            $sec=$row['code_sec'];
        }
    }


if (isset($_POST['qr'])){
		
    $qrdata = $_POST['qr'];
    $sql="SELECT * from students WHERE studnum_std=? and sec_id=?";
    $result = $conn->prepare($sql);
    $result->execute([$qrdata,$secid]);

    if($result->rowCount() > 0){
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $id=$row["id_std"];
        }

        $sql="SELECT * from attendance_record WHERE stud_id=?";
        $result2 = $conn->prepare($sql);
        $result2->execute([$id]);

        if($result2->rowCount() > 0){
            $_SESSION['error'] =  "Already Recorded.";
           
        }else{
            $present="1";

            $sql = "INSERT INTO  attendance_record (`stud_id`, `type`) VALUES ($id,$present)  ";
            $query = $conn->prepare($sql);
            $query->execute();
        }

            

            
            
    }else{
        $_SESSION['error'] =  "You are not enrolled to this subject.";
    }
}



?>






<!DOCTYPE html>
<html lang="en">
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec"  prefix="og: http://ogp.me/ns#" class="no-js">

<head>
    <meta charset="UTF-8">
    <link rel='icon' href='../../images/rtu-logo.png'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css_front/recattendstyle.css">
    <title>QR SCANNER</title>
    <link rel="shortcut icon" href="https://learncodeweb.com/demo/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>


</head>
<body>

    <section class="side">
      
        <div class="col-sm-12">
            <video id="preview" class="p-1 border" width="125%"></video>
                
        </div>
        <form action="rec_attendance.php" id = "qrscan" method="post">
            <input type = "text"  id="qr" name="qr" hidden>
        </form>
        
        <script type="text/javascript">

            var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
            scanner.addListener('scan',function(input_value){
                    
                //store scanned qr code to text and play beep sound
                qr.value = input_value;
                console.log(input_value);
                //	document.getElementById("demo").innerHTML = content;
                
                
                document.forms[0].submit();
                
            });
            Instascan.Camera.getCameras().then(function (cameras){
                if(cameras.length>0){
                    scanner.start(cameras[0]);
                    $('[name="options"]').on('change',function(){
                        if($(this).val()==1){
                            if(cameras[0]!=""){
                                scanner.start(cameras[0]);
                            }else{
                                alert('No Front camera found!');
                            }
                        }
                    });
                }else{
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            }).catch(function(e){
                console.error(e);
                alert(e);
            });
        
//          (function () {
//              if (!console) {
//                  console = {};
//              }
//              var old = console.log;
//              var logger = document.getElementById('demo');
//              console.log = function (message) {
//                  if (typeof message == 'object') {
//                      logger.innerHTML += (JSON && JSON.stringify ? JSON.stringify(message) : String(message)) + '\n';
//                  } else {
//                      logger.innerHTML += message + '\n';
//                  }
//              }
//          })()
            
        </script>
    </section>

    <section class="main">
        <div class="login-container">
            <p class="title"> <?php echo $sec; ?> Attendance</p>
            <div class="separator"></div>
            <?php if ($_SESSION['error']): ?>
                <div class="ralert alert-dange" role="alert">
                    <strong><?php echo $_SESSION['error'];?></strong>
                </div>
                <?php   
                    $_SESSION['error'] = false;
                ?>
            <?php endif ?>
            <p class="welcome-message">Registered Credentials</p>
            
            <form class="login-form">
                <table class="table table-striped w-auto">
                    <!--Table head-->
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            
                        </tr>
                    </thead>
                    <!--Table head-->
                    
                    <!--Table body-->
                    <tbody>
                    
                        <tr class="table-info">
                            <td></td>
                        </tr>
                    </tbody>
                     
                    <!--Table body-->
                </table>
                <!--Table-->
               
            </form>
         </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


</html>