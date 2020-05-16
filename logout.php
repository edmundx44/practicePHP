<?php 
include "main_conn.php";

session_start();

$db_user_id = $_SESSION['id'];
$user_md5 = md5($db_user_id);

updateLoginStatus($db_user_id);

function rand_a($length){
	$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$shuffled = substr(str_shuffle( $str ), 0, $length);
	return $shuffled;
}
$shuffled_logout = rand_a(10);

unset($_SESSION['id']);
session_unset();
session_destroy();

echo "<script>window.location.href='pages/main.php?$shuffled_logout&v_1=$user_md5';</script>";
exit();

//logout update login status
function updateLoginStatus($db_user_id){
	global $main_conn;
	
	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d H:i:s'); 

	$updateLoginHistoryQuery = $main_conn->prepare('UPDATE fb_loginhistory set loginStatus = :getStatus ,loginDate = :getDatenow where userId = :getId');
	$updateLoginHistoryQuery->execute(
			array(
				':getStatus' => 'offline',	
				':getId'=> $db_user_id,
				':getDatenow'=> $date
				)
		   	);
		}
?>