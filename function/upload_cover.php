<?php 
	require_once ('function.php');
		$db_user_id = $_POST['sessionId']; //ang sulod ani id ang session id
		uploadImg_cover($db_user_id); //so we need to pass the data to arguments
?>