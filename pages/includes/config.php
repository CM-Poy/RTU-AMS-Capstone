<?php

$servername = "localhost";
$username = "root";
$password = "";
	$conn = new PDO("mysql:host=$servername;dbname=rtuams", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}
?>

