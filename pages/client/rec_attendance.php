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

</head>
<body>
    <section class="side">
       <div class="col-sm-12">
                  <video id="preview" class="p-1 border"></video>
                    
                </div>
                <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                <script type="text/javascript">

                    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                    scanner.addListener('scan',function(content){
                            
                        //store scanned qr code to text and play beep sound
                        
                        //  console.log(content);
                        document.getElementById("demo").innerHTML = content;
                        var audio = new Audio('beep.mp3');
                        audio.play();
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
            <p class="title"> QR SCANNER INFORMATION</p>
            <div class="separator"></div>
            <p class="welcome-message">Registered Credentials</p>

            <form class="login-form">
                <table class="table table-striped w-auto">
                    <!--Table head-->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                        </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody>
                        <tr class="table-info">
                            <th scope="row">1</th>
                            <td>Kate Morriss</td>
                        </tr>
                    </tbody>
                     <tr class="table-info">
                            <th scope="row">1</th>
                            <td>Kate Kalentong</td>
                        </tr>
                    <!--Table body-->
                </table>
                <!--Table-->
               
            </form>
         </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


</html>