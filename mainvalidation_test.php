<?php 
	//signup area 
	$Firstname = $Lastname = $mobilenumber_email = $newpassword = $month = $days = $year = '';
	$err_empty_fn = $err_empty_ln = $err_empty_mn_email = $err_empty_pw = '';

	$error_field =''; //pang testing lang

	if(isset($_POST['sign-up-btn'])){
		//check firstname if empty
		if(empty($_POST['Firstname'])){
			$error_field ='Need to fill up this Field';
		}else{
			$Firstname = $_POST['Firstname'];
			if(!preg_match("/^[A-Za-z]*$/" , $Firstname)){
							$err_empty_fn = "Only letters in username";
				}
		}
		//check Lastname if empty
		if(empty($_POST['Lastname'])){
			$error_field ='Need to fill up this Field';
			}else{
				$Lastname = $_POST['Lastname'];
				if(!preg_match("/^[A-Za-z]*$/" , $Lastname)){
							$err_empty_ln = "Only letters in username";
				}
			}
		//check mobilenumber_email if empty	
		if(empty($_POST['mobilenumber_email'])){
			$error_field = 'Need to fill up this Field';
		}else{	
				//$mobilenumber_email=$_POST['mobilenumber_email'];
				echo $mobilenumber_email=phone_number_format($_POST['mobilenumber_email']);
		}
		//check newpassword if empty	
		if(empty($_POST['newpassword'])){
			$error_field = 'Need to fill up this Field';
		}else{
			$newpassword = $_POST['newpassword'];
		}
		//for month 
		if(empty($_POST['month'])){
			$error_field ='Need to fill up this Field';
		}else{
			$month = $_POST['month'];
		}
		//for days
		if(empty($_POST['days'])){
			$error_field ='Need to fill up this Field';
		}else{
			$days = $_POST['days'];
			}
		//for year
		if(empty($_POST['year'])){
			$error_field ='Need to fill up this Field';			
		}else{
				$year = $_POST['year'];
			}
		//for gender
		if(empty($_POST['gender'])){
			$error_field ='Need to fill up this Field';
		}else{
			$gender = $_POST['gender'];
		}
	}


		//if gamiton naku ni na function to get the input in form do phone_number_format($_POST[''])
	   	function phone_number_format($number) {
		  $number = preg_replace("/[^\d]/","",$number); // Allow only Digits, remove all other characters.  
		  $length = strlen($number);// get number length.
		  // if number = 10 if nag match sila na nag start og 9
		  if($length == 10 && preg_match("/^[9]\d{9}$/",$number)){
		 	 	$number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $number); //format will be xxx-xxx-xxxx
		 	 	return $number;
		 	}
		 	else{
		 		return $number = "Only start at 9 and put a real phone number for ph";
		 	}
		 	
		}

?>
