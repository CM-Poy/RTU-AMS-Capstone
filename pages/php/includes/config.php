<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	try {
		$pdo = new PDO("mysql:host=$servername;dbname=capstone", $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo 'Connection Failed: ' .$e->getMessage();
	}
?>
