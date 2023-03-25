<?php
require_once 'php/includes/config.php' ?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>EDIT CLASS</title>

  <!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/STYLE.css">
	<link rel="stylesheet" href="../css/class-editing.css">
	<link rel="stylesheet" href="../css/bg.css">

</head>

	<body>

		<header>

			<div class="container-fluid p-0">
				<nav class="navbar navbar-expand-lg">
  					<a class="navbar-brand" href="#">
  					 <img class="navbarpic" src="rtu-logo.png" width="50" height="50" alt="">
  					RIZAL TECHNOLOGICAL UNIVERSITY</a>
  						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
   						 <span class="navbar-toggler-icon"></span>
  						</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<div class="me-auto"></div>
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="#">Notification<span class="sr-only"></span></a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
								<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
								<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"></path>
								</svg>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="login-index.php">LOG OUT</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>

		</header>



		<div>
			<div class="sidebar">
				<div class="sidebar-item" >
						<a class="index" href="dash.php">
						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-app-indicator" viewBox="0 0 16 16"><path d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"/>
						<path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>

						&nbsp;&nbsp;<span>TODAY</span></a>

				</div>

				<div class="sidebar-item">
					<a class="index" href="dash-calendar.php">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="       currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16"><path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1
					1h12a1 1 0 0 0 1-1V4H1z"/></svg>

					&nbsp; &nbsp;<span>CALENDAR</span></a>
				</div>


				<div class="sidebar-item">
					<a class="index" href="">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clipboard2-data" viewBox="0 0 16 16">
					<path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/><path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/><path d="M10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V9a1 1 0 0 0-1-1Z"/></svg>

					&nbsp; &nbsp;<span>MANAGE</span></a>
				</div>


				<div class="sidebar-item">
					<a class="index" href="dash-account.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="       currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>

					&nbsp; &nbsp;<span>ACCOUNT</span></a>
				</div>


				<div class="container-fluid p-0">
					<div class="row text center">
						<div class="col-md-5 col-md-5">
							<h1 class="text-dark">About us</h1>
							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum maxime ea similique illum corrupti</p>
							<p class="pt-4 text-muted">Copyright ©2022 All rights reserved | This Webpage is made with by
							<span> 4k OGS </span></p>
						</div>
					<div class="col-md-5"></div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div>


     <section id="swup" class="transition-fade">
		<form class="whole">
	<div class="name">
	<h5>Class Name</h5>
			<input required name="database" placeholder="Introduction to Programming">
			</div>
	<div class="code">
	<h5>Class Code</h5>
			<input required name="database" placeholder="ITP201">
			</div>
			<div class="section">
	<h5>Section Code</h5>
			<input required name="database" placeholder="CEIT-37-702A">
			</div>

	<div class="day">
      	 <h5>Day</h5>
         <select id = "day" name="day">
           <option value="none" selected disabled hidden>Select a day</option> 
           <option value="Monday">Monday</option>
           <option value="Tuesday">Tuesday</option>
           <option value="Wednesday">Wednesday</option>
           <option value="Thursday">Thursday</option>
           <option value="Friday">Friday</option>
           <option value="Saturday">Saturday</option>
         </select>
        </div><br>

			<div id ="time"class="time">
        	<h5>Time</h5>
        	<input type="time"name="time" min="00:00" max="12:00"><input type="time" name="time2" min="00:00" max="12:00">

      	</div><br>

		<div class="cancelbtn">
			<a href="dash-manage.php"><button name="create" type="button"> Cancel </button>
			</div></a>

			<div class="addbtn"><button  type="submit"> EDIT </button>
			</div>

				<div class="studlistbtn">
			 		<a href="studlist.php"><button  name="create" type="button"> Student List </button>
			 </div>






     </form>
   </section>
</div>
</div>
<div class="container-fluid">
  <div class="col-md-12 text-center">
      <div class="card text-white" style="height: 720px; margin-top: 50px; width: 1500px; margin-left: 90px;background-color: #194F90;position: relative;">
        <div>
        <table class="table text-white">
          </tbody>
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">CLASS</th>
                <th scope="col">CLASS CODE</th>
                <th scope="col">SECTION CODE</th>
                <th scope="col">DAY</th>
                <th scope="col">FROM</th>
                <th scope="col">TO</th>
                <th></th>
              </tr>
            </thead>
          </tbody>

          <tbody>
              <?php
              global $conn;
              $sql = "SELECT * from class";
              $result = $conn->prepare($sql);
              $result->execute();
              if($result->rowCount() > 0){
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                  $idclass=$row["idclass"];
                  $subname=$row["subname"];
                  $subcode=$row["subcode"];
                  $sectcode=$row["sectcode"];
                  $day=$row["day"];
                  $fromtime=$row["fromtime"];
                  $totime=$row["totime"];

                  echo '
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
                    <link rel="stylesheet" href="../css/STYLE.css">


                  <form action= "php/includes/function.php" method= "post">
                    <tr>

                          <th scope ="row">'.$idclass.'</th>
                          <td>'.$subname.'</td>
                          <td>'.$subcode.'</td>
                          <td>'.$sectcode.'</td>
                          <td>'.$day.'</td>
                          <td>'.$fromtime.'</td>
                          <td>'.$totime.'</td>

                      <td><a href="Edit-class.php"><button name="addclass" type="button" class= "btn btn-primary"><i class<i class="bi bi-pen"></i>

                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                      </svg></button></a>

                      <button name="delclass" type="submit" id="delclass" class="btn btn-danger" ><i
                         class="far fa-trash-alt"></i>

                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                      </svg></button></td>
                         </tr></form>
                  ';
                }
              }
              ?>
          </tbody>
        </table>
        <div>
          <a href="Add-class.php"><button id="addclass" type="button" style="margin-left:1350px ; margin-top:500px;">ADD</button></a>
        </div>

    </div>

  </div>
</div>
</div>


      <script defer src="/Add-class.js"></script>
      <script src="JS/Add-class.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    	crossorigin="anonymous">
    	</script>

  		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    	crossorigin="anonymous"></script>






</body>




<html>