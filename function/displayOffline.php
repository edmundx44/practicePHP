<?php  
	require_once ('function.php');
		$db_user_id = $_POST['sessionId'];
		updateLoginHistory($db_user_id);
?>
