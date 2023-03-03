<?php
$servername = "localhost";
$username = "root";
$password = "";
	$conn = new PDO("mysql:host=$servername;dbname=capstone", $username, $password);
	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}
?>
