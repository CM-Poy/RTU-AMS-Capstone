<?php 

require('../includes/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();


$secid=$_SESSION['secid'];
$idschd=$_SESSION['schdid'];

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
		
        

        $sql="SELECT * from std_enrolled where schd_id=?";
        $result = $conn->prepare($sql);
        $result->execute([$idschd]);
        
        if($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                $idstd = $row['std_id'];
                $qrdata = $_POST['qr'];
                $sql2="SELECT * from students WHERE studnum_std=? and id_std=?";
                $result2 = $conn->prepare($sql2);
                $result2->execute([$qrdata,$idstd]);
            
                if($result2->rowCount() > 0){
                    
                    while ($row = $result2->fetch(PDO::FETCH_ASSOC)){
                        $id=$row["id_std"];
                    }
            
                    $sql3="SELECT * from attendance_record WHERE std_id=?";
                    $result3 = $conn->prepare($sql3);
                    $result3->execute([$id]);
            
                    if($result3->rowCount() > 0){
                        $_SESSION['error'] =  "Already Recorded.";
                    
                    }else{

                        $present="1";
                        $date= date('Y-m-d');
                        $sql5 = "INSERT INTO  attendance_record (`schd_id`,`std_id`, `type`,`date`) VALUES (?,?,?,?)  ";
                        $query5 = $conn->prepare($sql5);
                        $query5->execute([$idschd,$id,$present,$date]);

                        $sql6= "SELECT * FROM students WHERE id_std=?";
                        $query6 = $conn->prepare($sql6);
                        $query6->execute([$id]);
                        if($query6->rowCount() > 0){
            
                            while ($row = $query6->fetch(PDO::FETCH_ASSOC)){
                                $stdname=$row['flname_std'];
                                $name=$row['gflname_std'];
                                $email=$row['gemail_std'];

                                $subj=$_SESSION['subid'];
                                $sql7= "SELECT * FROM subjects WHERE id_subj=?";
                                $query7 = $conn->prepare($sql7);
                                $query7->execute([$subj]);

                                if($query7->rowCount() > 0){
            
                                    while ($row = $query7->fetch(PDO::FETCH_ASSOC)){
                                        $subj=$row["name_subj"];
                                    }
                                }

                                
                            }
                                $datetime2=date('Y-m-d H:i:s');
                                $subject = "ATTENDANCE RESULT";
                                $message = $stdname." was PRESENT in his class ".$subj.". Recorded ".$datetime2;

                                require "../../vendor/autoload.php";
                                $mail = new PHPMailer(true);

                                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                
                                $mail->isSMTP();
                                $mail->SMTPAuth = true;
                                
                                $mail->Host = "smtp.gmail.com";
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = 587;
                                
                                $mail->Username = "rtuboni.ams@gmail.com";
                                $mail->Password = "twaeftlsfuwcxhwo";
                                
                                $mail->setFrom("rtuboni.ams@gmail.com","RTU Boni-Attendance Management System");
                                $mail->addAddress($email, $name);
                                
                                $mail->Subject = $subject;
                                $mail->Body = $message;
                                
                                $mail->send();
                                
                            
                        } 
                    }       
                }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css_front/frontstyle.css">
    <title>QR SCANNER</title>
    <link rel="shortcut icon" href="https://learncodeweb.com/demo/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel='icon' href='../images/rtu-logo.png'/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
                                
                                window.location.href = "man_attendance.php";
                            }
                        }
                    });
                }else{
                    console.error('No cameras found.');
                    window.location.href = "man_attendance.php";
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
        <form method="post">
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
            
                <a href="javascript:void(0);" onclick="goBack()"  type="button" ><h2>DONE</h2></a>
            
         </div>
         
        </form>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


</html>



<script>

function goBack() {
    window.history.back();
  }


if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


