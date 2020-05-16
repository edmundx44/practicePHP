<?php 
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$db   = 'facebook';
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		try {
		     $main_conn = new PDO($dsn, $user, $pass);
		     // set the PDO error mode to exception
		     $main_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		     //echo "Connected successfully";
		} catch(PDOException $e){
   	 		echo "Connection failed: " . $e->getMessage();
    	}
?>