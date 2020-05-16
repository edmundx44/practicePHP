<?php 
require_once('../main_conn.php');
	
session_start();
	if(isset($_SESSION['id'])){
		//$now = new DateTime(null, new DateTimeZone('America/New_York'));
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d H:i:s'); 

		$db_user_id = $_SESSION['id'];
		$stmt = $main_conn->prepare("SELECT * FROM facebook WHERE id = :db_user_id");
		$stmt->execute([
			':db_user_id' => $db_user_id
		]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$inserToHistory = insterLoginHistory($db_user_id, $date);
		// echo $date;
		//echo $db_user_id; //id =  	
	}


//insert record function in database
// function sa main.php
function InsertRecord(){
	global $main_conn;

	//g kuha naku ang data sa $.ajax function using post dili tong name sa form
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email_mobile = $_POST['email_mobile'];
	$password = $_POST['pass'];
	/*$month = $_POST['month'];
	$day = $_POST['day'];
	$year = $_POST['year'];*/
	$gender = $_POST['gender'];
	
	$dateBirth = $_POST['birthday'];
	try {
			/* $data = [
			 	//key=>value
			    ':firstname' => $firstname,
			    ':lastname' => $lastname,
			    ':email_mobile' => $email_mobile,
			    ':password' => $password,
			    ':birthday' => $dateBirth,
			    ':gender' => $gender,
				];*/
			//prepared statement
			$stmt = $main_conn->prepare("INSERT INTO facebook(firstname,lastname,email_mobile,password,birthday,gender) 
				VALUES(:firstname,:lastname,:email_mobile,:password,:birthday,:gender)");

			//run the prepared stmt
			$execute_run = $stmt->execute([
				//key=>value
			    ':firstname' => $firstname,
			    ':lastname' => $lastname,
			    ':email_mobile' => $email_mobile,
			    ':password' => $password,
			    ':birthday' => $dateBirth,
			    ':gender' => $gender,
			]);
			if($execute_run){	
				echo "New record created successfully";
			}else{
				echo "No Record has been saved";
			}
		}
	catch(PDOException $e){
		    	echo "Error: " . $e->getMessage();
		    }
		$main_conn = null;			
	}

	function display_record(){
		global $main_conn;
		$value ='';
		$value ='<table class="table">
					<tr>
						<td>Fullname</td>
						<td>Email/Mobile</td>
						<td>Birthday</td>
						<td>Gender</td>
						<td>Change Data</td>
					</tr>';
				
		$sql = "SELECT * FROM facebook";
		$query= $main_conn->query($sql);
		$db_fullname ='';
		while($row =$query->fetch_assoc()){
				$db_firstname = $row['firstname'];
				$db_lastname = $row['lastname'];
				$db_emobile = $row['email_mobile'];
				$db_birthday = $row['birthday'];
				$db_gender = $row['gender'];

				$db_fullname = ucfirst($db_firstname)." ".ucfirst($db_lastname);
				$value.='<tr>
							<td>$db_fullname</td>
							<td>$db_emobile</td>
							<td>$db_birthday</td>
							<td>$db_gender</td>
							<td>EDIT</td>
							<td>Delete</td>
						</tr>';
				$value.='</table>';
			}
			echo json_encode(['status'=>'success','html'=>$value]);

			$main_conn = null;	
		}


		// function sa homepage.php
		//check if email is already taken
		function checkAvailability(){

			global $main_conn;

			$checkemail = $_POST['email'];   //$checkemail = 'hello_world@yahoo.com';
			$stmt = $main_conn->prepare("SELECT email_mobile FROM facebook WHERE email_mobile = :checkemail");//gi butang naku sa prepared statement
			//execute stmt
			$stmt->execute([
				':checkemail' => $checkemail
			]);
			$checkrecord = $stmt->rowCount(); //check record if naa return true
			// print_r($query);
			// var_dump($query);
			if($checkrecord > 0){
				echo "011"; //return true
			}else{
					echo "000"; //return false
				}
			$main_conn = null;	
		}

	// function sa profile.php
	//print_r($_FILES['file_img_dp']); // print_r($_FILES);
	function uploadImg($get_db_user_id) //$get_db_user_id ang sulod ana kai session id sa user
		{
			global $main_conn;
			
			$filesName = $_FILES['file_img_dp']['name'];
			$filesType = $_FILES['file_img_dp']['type'];
			$filesTmp_name = $_FILES['file_img_dp']['tmp_name'];
			$filesError = $_FILES['file_img_dp']['error'];
			$filesSize = $_FILES['file_img_dp']['size'];
			$fileNameCmps = explode(".", $filesName);
			$fileExtension = strtolower(end($fileNameCmps));

			$allowedfileExtensions = array('png','jpg','jpeg');
			
			if(in_array($fileExtension, $allowedfileExtensions))
				{
						if($filesError === 0)
						{
								if($filesSize< 10000000 )
								{
									if (!is_dir('../upload/upload_user_dp/'.$get_db_user_id))
									{
		                                mkdir('../upload/upload_user_dp/'.$get_db_user_id);
		                            }
										$fileNameNew = rand(100, 999).'profile_id_'.$get_db_user_id. ".".$fileExtension;
										$fileDistination = '../upload/upload_user_dp/'.$get_db_user_id.'/'.$fileNameNew;
										$saveToFormat = '../upload/upload_user_dp/'.$get_db_user_id.'/'.$fileNameNew; //save sa dp

										if(!file_exists($fileDistination))
										{
											move_uploaded_file($filesTmp_name, $fileDistination);
											$stmt =$main_conn->prepare("INSERT INTO fb_img(user_id , dp_save_loc) VALUES(:db_user_id , :saveToFormat )");
											$stmt->execute([
												':db_user_id' => $get_db_user_id,
												':saveToFormat' =>$saveToFormat
											]);
											//echo "Your File has been uploaded.";

											// diri pag human upload ma display deretso ang image no need to refresh
											$displayUserPhotoQuery =$main_conn->prepare('SELECT * from fb_img where user_id = :db_user_id order by id desc limit 1');
											$displayUserPhotoQuery->execute([
												':db_user_id' => $get_db_user_id
											]);
											while ($row = $displayUserPhotoQuery->fetch(PDO::FETCH_ASSOC)) {
												 	$photo_user_id = $row['dp_save_loc'];
												 	//echo $photo_user_id; 
												 	echo "<img src=".$photo_user_id." class='img_thumbnail'>"; //return success function for ajax
												}
						
										}else{
												echo "File name already exist upload again.";
											 }
								}else{
										echo "Your files is too big";
									 }
						}else{
								echo "There was an error uploading your file";
							 }
				}else{
						echo "Not allowed to upload with this type of file";
					 }
		$main_conn = null;
		}

		//for cover photo
		function uploadImg_cover($get_db_user_id) //$get_db_user_id ang sulod ana kai session id sa user
		{
			global $main_conn;
			
			$filesName = $_FILES['file_img_cover']['name'];
			$filesType = $_FILES['file_img_cover']['type'];
			$filesTmp_name = $_FILES['file_img_cover']['tmp_name'];
			$filesError = $_FILES['file_img_cover']['error'];
			$filesSize = $_FILES['file_img_cover']['size'];
			$fileNameCmps = explode(".", $filesName);
			$fileExtension = strtolower(end($fileNameCmps));

			$allowedfileExtensions = array('png','jpg','jpeg');
			
			if(in_array($fileExtension, $allowedfileExtensions))
				{
						if($filesError === 0)
						{
								if($filesSize< 10000000 )
								{
									if (!is_dir('../upload/upload_user_cover/'.$get_db_user_id))
									{
		                                mkdir('../upload/upload_user_cover/'.$get_db_user_id);
		                            }
										$fileNameNew = rand(100, 999).'profile_id_'.$get_db_user_id. ".".$fileExtension;
										$fileDistination = '../upload/upload_user_cover/'.$get_db_user_id.'/'.$fileNameNew;
										$saveToFormat = '../upload/upload_user_cover/'.$get_db_user_id.'/'.$fileNameNew; //save sa dp

										if(!file_exists($fileDistination))
										{
											move_uploaded_file($filesTmp_name, $fileDistination);
											
											$stmt =$main_conn->prepare("INSERT INTO fb_img_cover(user_id , cover_save_loc) VALUES(:db_user_id , :saveToFormat )");
											$stmt->execute([
												':db_user_id' => $get_db_user_id,
												':saveToFormat' =>$saveToFormat
											]);
											//echo "Your File has been uploaded.";

											// diri pag human upload ma display deretso ang image no need to refresh
											$displayUserPhotoQuery =$main_conn->prepare('SELECT * from fb_img_cover where user_id = :db_user_id order by id desc limit 1');
											$displayUserPhotoQuery->execute([
												':db_user_id' => $get_db_user_id
											]);
											while ($row = $displayUserPhotoQuery->fetch(PDO::FETCH_ASSOC)) {
												 	$photo_user_id = $row['cover_save_loc'];
												 	//echo $photo_user_id; 
												 	echo "<img src=".$photo_user_id." class='img_thumbnail_cover'>"; //return success function for ajax
												}
						
										}else{
												echo "File name already exist upload again.";
											 }
								}else{
										echo "Your files is too big";
									 }
						}else{
								echo "There was an error uploading your file";
							 }
				}else{
						echo "Not allowed to upload with this type of file";
					 }
		$main_conn = null;
		}

		//display user photo function sa profile pic
		function displayUserPhoto($get_db_user_id){
					global $main_conn;

					$displayUserPhotoQuery =$main_conn->prepare('SELECT * from fb_img where user_id = :db_user_id order by id desc limit 1');
					$displayUserPhotoQuery->execute([
						':db_user_id' => $get_db_user_id
					]);

					while ($row = $displayUserPhotoQuery->fetch(PDO::FETCH_ASSOC)) {
						 	$photo_user_id = $row['dp_save_loc'];
						 	//echo $photo_user_id;
						 	echo "<img src=".$photo_user_id." class='img_thumbnail'>";
					}
					$main_conn = null;
				}
		//display cover photo function sa cover photo		
		function displayUserCover($get_db_user_id){
					global $main_conn;

					$displayUserCover =$main_conn->prepare('SELECT * from fb_img_cover where user_id = :db_user_id order by id desc limit 1');
					$displayUserCover->execute([
						':db_user_id' => $get_db_user_id
					]);
					while ($row = $displayUserCover->fetch(PDO::FETCH_ASSOC)) {
						 	$photo_user_id = $row['cover_save_loc'];
						 	//echo $photo_user_id;
						 	echo "<img src=".$photo_user_id." class='img_thumbnail'>";
					}
					$main_conn = null;
				}

		
				
		//instert sya if mag login
		function insterLoginHistory($db_user_id, $date){
					global $main_conn;


					$checkExistingHistory = $main_conn->prepare('SELECT * from fb_loginhistory where userId = :getId');
					$checkExistingHistory->execute(
						array(
							':getId'	=>	$db_user_id
						)
					);
					$row = $checkExistingHistory->rowcount();
					if($row > 0){
						$updateToLoginHistory = $main_conn->prepare('UPDATE fb_loginhistory set loginStatus = :getStatus ,loginDate = :getDatenow where userId = :getUserId');
						$updateToLoginHistory->execute(
							array(
								':getStatus' => 'online', 
								':getUserId' => $db_user_id,
								':getDatenow'=> $date
							)
						);
					}else{
						$insertToLoginHistory = $main_conn->prepare('INSERT into fb_loginhistory(loginStatus,userId) values (:getStatus,:getUserId)');
						$insertToLoginHistory->execute(
							array(
								':getStatus' => 'online', 
								':getUserId' => $db_user_id
							)
						);
					}

			}
		
		function displayOnlineUsers(){
			global $main_conn;
			$OnlineUsersQuery = $main_conn->prepare("SELECT (facebook.firstname) as firstname,(facebook.lastname) as lastname,(facebook.id) as ownId, (fb_loginhistory.loginStatus) as onStatus FROM facebook INNER JOIN fb_loginhistory ON (facebook.id) = fb_loginhistory.userId "); //where fb_loginhistory.loginStatus = :status and fb_loginhistory.userId = :ownId 

			$OnlineUsersQuery->execute(
				array()
			);
			$Online_Users = array(); //akong g define ang variable  $Online_Users as array
			while($row = $OnlineUsersQuery->fetch(PDO::FETCH_ASSOC))
			{
				$displayUserPhotoQuery = $main_conn->prepare('SELECT dp_save_loc from fb_img where user_id = :db_user_id order by id desc limit 1');
				$displayUserPhotoQuery->execute(
							array(':db_user_id' =>$row['ownId'])
						);
				$photo_user_id = $displayUserPhotoQuery->fetchColumn(); //echo "<br>". $row['username']. $row['ownId']. $photo_user_id;	
				$db_fullname = ucwords($row['firstname']) ." ". ucfirst($row['lastname']);
							//store assiociative array data into $Online_Users[]
						if($photo_user_id != ''){
							$Online_Users[] = array(
								'user_id' => $row['ownId'],
								'name' =>  $db_fullname,
								'image' => $photo_user_id,
								'status'=> $row['onStatus']

							);
						}else{
							$photo_user_id ="../img/fbcover.jpg";
							$Online_Users[] = array(
								'user_id' => $row['ownId'],
								'name' =>  $db_fullname,
								'image' => $photo_user_id,
								'status'=> $row['onStatus']
							);
						}	
					
					 echo '<a href="javascript:void(0);" onclick="register_popup(\''.$row['ownId'].'\',\''.$db_fullname.'\',\''.$photo_user_id.'\');">';
					 echo 	"<li class='Online_Users'>";
					 echo			"<div class='Online_Users_photo'><img src='".$photo_user_id."'></div>";
					 echo			"<div class='Online_Users_name'>".$db_fullname."</div>";
					 echo			"<div class='status'>".$row['onStatus']."</div>";
					 echo 	"</li>";
					 echo "</a>";
					
			}		 

					
				// convert data intro json
				//echo json_encode($Online_Users);
				// step 1
				//  select all from fb_loginhistory
				// kohaon ang id
				// step 2
				//  select all from facebook where id = loginhistory
				// step 3
				//  e display sa page sa
		}

		function updateLoginHistory($db_user_id){
					
					$updateLoginHistoryQuery = $main_conn->prepare('UPDATE fb_loginhistory set loginStatus = :getStatus where userId = :getId');
					$updateLoginHistoryQuery->execute(
						array(
							':getStatus'	=> ' ',
							':getId'		=> $db_user_id
						)
					);
				}
?>
