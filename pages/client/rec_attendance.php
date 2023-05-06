<?php 
require('../includes/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

    $sql="SELECT schd_id, doc, COUNT(*) AS count FROM attendance_list GROUP BY schd_id, doc HAVING count > 1";
    $query = $conn->prepare($sql);
    $query->execute();

    if($query->rowCount() > 0){
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $idschd = $row['schd_id'];
            $doc = $row['doc'];

            $sql2="DELETE FROM attendance_list WHERE schd_id = ? AND doc = ? ORDER BY id_attendance DESC LIMIT 1";
            $query2 = $conn->prepare($sql2);
            $query2->execute([$idschd,$doc]);

            //$_SESSION['error']="ATTENDANCE ALREADY DONE FOR THIS SUBJECT.";
        }
    }else{
        $idsched=$_SESSION['schdid'];
        $date=date('Y-m-d');
        $datetime=date('Y-m-d H:i:s');
        $sql="INSERT INTO attendance_list (`schd_id`,`doc`,`datetimecreated`) values (?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$idsched,$date,$datetime]);

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
            


            $idsched=$_SESSION['schdid'];
            $date=date('Y-m-d');
            $sql2= "SELECT * FROM attendance_list WHERE schd_id=? AND doc=?";
            $query2 = $conn->prepare($sql2);
            $query2->execute([$idsched,$date]);
            
            if($query2->rowCount() > 0){
        
                while ($row = $query2->fetch(PDO::FETCH_ASSOC)){
                    $present="1";
                    $idatt=$row["id_attendance"];
                    $_SESSION['idatt']=$row["id_attendance"];
                    $sql = "INSERT INTO  attendance_record (`attendance_id`,`stud_id`, `type`) VALUES ($idatt,$id,$present)  ";
                    $query = $conn->prepare($sql);
                    $query->execute();

                    $sql3= "SELECT * FROM students WHERE id_std=?";
                    $query3 = $conn->prepare($sql3);
                    $query3->execute([$id]);
                    if($query3->rowCount() > 0){
        
                        while ($row = $query3->fetch(PDO::FETCH_ASSOC)){
                            $stdname=$row['flname_std'];
                            $name=$row['gflname_std'];
                            $email=$row['gemail_std'];

                            $subj=$_SESSION['subid'];
                            $sql4= "SELECT * FROM subjects WHERE id_subj=?";
                            $query4 = $conn->prepare($sql4);
                            $query4->execute([$subj]);

                            if($query4->rowCount() > 0){
        
                                while ($row2 = $query4->fetch(PDO::FETCH_ASSOC)){
                                    $subj=$row2["name_subj"];
                                }
                            }

                            
                           
                            $subject = "ATTENDANCE RESULT";
                            $message = "Student ".$stdname." was present in his class ".$subj;

                            require "../../vendor/autoload.php";
                            $mail = new PHPMailer(true);

                            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                            $mail->isSMTP();
                            $mail->SMTPAuth = true;

                            $mail->Host = "smtp.gmail.com";
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;

                            $mail->Username = "rtuboni.ams@gmail.com";
                            $mail->Password = "eidwfqkytlhuzjdl";

                            $mail->setFrom("rtuboni.ams@gmail.com","RTU Boni-Attendance Management System");
                            $mail->addAddress($email, $name);

                            $mail->Subject = $subject;
                            $mail->Body = $message;

                            $mail->send();
                        }
                    }else{
                        
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
            <button type="submit" name="done" >DONE</button>
         </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


</html>



<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

