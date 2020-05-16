<?php //include 'mainvalidation.php';
	include '../fbloginscript.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/test_css1.css">
	<script src="../function/script/jQuery3_4_1.js"></script>
	<script src="../function/script/main.js"></script>
</head>
<body>
	<div class="box-header">
		<div class="box-header-content">
			<div class="logo-facebook">
				<h1>FACEBOOK</h1>
			</div>
			<div class="form-login">
				<form method="POST">
					<table border="0" cellspacing="5">
						<tr>
							<td>Email or Phone</td>
							<td>Password</td>
						</tr>
						<tr class="text-login">
							<td><input class="text-email-login" type="text" name="login_email" value=""></td>
							<td><input class="text-pass-login" type="password" name="login_password" value=""></td>
							<td><input class="text-btn-login" type="submit" name="login_btn_login" value="Log In"></td>
						</tr>
						<tr>
							<td></td>
							<td class="forgotPassword"><a href="rpass.php?recover=">Forgot Password</a></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<div class="box-container">
		<div class="box-content">
			<div class="recent-login-section">
				<h1>Recent Logins</h1>
				<h3>Click your picture or add an account</h3>
			</div>
			<div class="sign-up-section">
				<div class="header-signup-up">
					<h1>Create a New Account</h1>
					<h3>Quick and easy</h3>
				</div>
				<span id="error"></span>

				<div class="sign-up-form"> 
					<form method="POST">
						<div class="row-1">
							<input type="text" id="form_fname" name="Firstname" placeholder="First name" value="">
							<input type="text" id="form_lname" name="Lastname" placeholder="Last name" value="">
						</div>
						<div class="row-2">
							<input type="text" id="form_emailmobile" name="mobilenumber_email" placeholder="Mobile number or Email" value="">
							<img id="check" src="../img/check.png" style="display:none">
							<span id="wrong" style="display:none;color:red;">X</span>
						</div>
						<div class="row-3">
							<input type="password" id="fom_pass" name="newpassword" placeholder="New password" value="">
						</div>
						<div class="Birthday">
							<h4>Birthday</h4>
						</div>
						<div class="row-4" name="birthday">
							<select class="month" id="form_month" name="month" value="">
								<option>Month</option>
								<option value="01">Jan</option>
								<option value="02">Feb</option>
								<option value="03">Mar</option>
								<option value="04">Apr</option>
								<option value="05">May</option>
							</select>
							<select class="days" id="form_day" name="days" value="">
								<option>Day</option>
								<option value="01">1</option>
								<option value="02">2</option>
								<option value="03">3</option>
								<option value="04">4</option>
								<option value="05">5</option>
							</select>
							<select  class="years" id="form_year" name="year" value="">
								<option>Year</option>
								<option value="1995">1995</option>
								<option value="1996">1996</option>
								<option value="1997">1997</option>
								<option value="1998">1998</option>
								<option value="1999">1999</option>
							</select>
						</div>
						<div class="Gender">
							<h4>Gender</h4>
						</div>
						<div class="row-5">
							<input type="radio" name="gender" id="genderlbl1" class="gender1" value="Female">
							<label class="gender-label" >Female</label>
							<input type="radio" name="gender" id="genderlbl2" class="gender1" value="Male">
							<label class="gender-label" >Male</label>
							<!-- <input type="radio" name="gendercustom" id="genderlbl3" class="gender1" value=""><label class="gender-label">Custom</label>	
							<input type="text" name="customgender" id="genderOpt" style="display:none;" placeholder="Gender Optional"> -->
						</div>
						<div class="policy">
							<p>
								By clicking Sign Up, you agree to our 
								<a href="#">Terms</a>, 
								<a href="#">Data Policy</a> and 
								<a href="#">Cookies Policy</a>. You may receive SMS Notifications from us and can opt out any time
							</p>
						</div>
						<div class="row-6">
							<input class ="signup_btn" type="button" name="sign-up-btn" value="Sign Up">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="tempbox" style="text-align:center; display: none;">
		<input id="tempbox" type="text" name="tempbox" >
	</div>
</body>
</html>
