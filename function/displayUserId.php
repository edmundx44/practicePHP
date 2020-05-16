<?php 
require_once('../main_conn.php');
	 session_start();   //basta mag session_start() ko makuha na niya unsay sulod
	/*if(isset($_SESSION['id'])){
		$db_user_id = $_SESSION['id'];
		$stmt = $main_conn->prepare("SELECT * FROM facebook WHERE id = :db_user_id");
		$run = $stmt->execute([
			':db_user_id' => $db_user_id
		]);
		echo $db_user_id; //id = 
	}*/
	echo $db_user_id=$_SESSION['id']; //pwede ra ing ani deretso dili naka mag isset pwede rana e comment line 4-11 kani ra dili
?>