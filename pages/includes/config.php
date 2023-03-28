<?php

$servername = "localhost";
$username = "root";
$password = "";
	$conn = new PDO("mysql:host=$servername;dbname=rtuams", $username, $password);
	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}
?>

