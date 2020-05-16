<?php 
	include 'main_conn.php';
	//session
	session_start();
	//any name akong i pangalan sa session in this example i called it 'id'
	if(isset($_SESSION['id'])){
		$db_user_id = $_SESSION['id'];
		$db_user_email = $_SESSION['email_mobile'];
		header("location: homepage.php");
	}
	$email = $password = '';
	if(isset($_POST['login_btn_login'])){
		if(empty($_POST['login_email'])){

		}else{
			$email = $_POST['login_email'];
		}
		if(empty($_POST['login_password'])){

		}else{
			$password = $_POST['login_password'];
		}
		if($email && $password){
			//$sql = "SELECT id FROM facebook WHERE email_mobile = :email && password = :password";
			$stmt = $main_conn->prepare("SELECT * FROM facebook WHERE email_mobile = :email && password = :password");
			$run = $stmt->execute([
				':email' => $email,
				':password' => $password
			]);
			$check_record = $stmt->rowCount();
			if($check_record > 0){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$db_user_id = $row['id'];
				$db_user_email = $row['email_mobile'];
				
				$_SESSION['id'] = $db_user_id;
				$_SESSION['email_mobile'] = $db_user_email;
				header("location: homepage.php");
			}
		}
		
/*	if($email && $password){
		$sql = "SELECT id FROM facebook WHERE email_mobile ='$email' && password = '$password'";
		$query = $main_conn->query($sql);
		$check_record = $query->num_rows;

		$db_pass = $password;
		if($check_record > 0){
				if($password == $db_pass){
						//means na a kuy kuaon na data which is ID only
						$row = mysqli_fetch_assoc($query);
						//gi butang naku diri para sa session and id na akong g kuha
						$db_user_id = $row['id'];
						$_SESSION['id'] = $db_user_id;
						header("location: homepage.php");
				}
			}
			else{	
					//wrong pass
				}
	}*/
}

?>