<?php 
	/*include ('main_conn.php');

	if(isset($_POST['buttoni'])){
	$checkemail = $_POST['checkemail'];

	$sql = "SELECT * FROM facebook WHERE email_mobile = '$checkemail'";
	$query = $main_conn->query($sql);
	$checkrecord = $query->num_rows; 

	if($checkrecord > 0){
		//return true
		echo $checkrecord .'<br>';
		echo "naa";
	}else{
		//return false
		echo "wala pa";
	}
}	*/
?>
<script src="jQuery3_4_1.js"></script>
<script>
	$(document).ready(function(){
		$('.textt').on('keyup', function(){
			var txtni = $(this).val();		
					$.ajax({
						url: 'function/view.php',
						method:'POST',
						data:{email:txtni},
						success: function(data){
						//ang akong g return didto sa checkuserajax.php whick is echo "011" if true "000" if false
						//everytime na success nai data kai ma butang sa akong function(data)
						//console.log(data); para makit an unsay g return
						console.log(data)	
							if(data== '011'){
								$('.availableSpn').show();
								$('.notavailableSpn').hide();
							}else{
								$('.availableSpn').hide();
								$('.notavailableSpn').show();
							}
						}
					})
				
		});
	});
</script>

<style>
	.availableSpn{
		margin-right: 5px;
		margin-left: 5px;
		padding: 0 5px 0 5px;
		border: 3px solid green;
		border-radius: 50px;
	}
	.notavailableSpn{
		padding: 0 5px 0 5px;
		border: 3px solid red;
		border-radius: 50px;
	}
	.textt{
		padding: 5px 0 5px 5px;
	}
	.btn{
		margin-top: 10px;
		background: green;
		color: white;
		padding: 5px;
	}
</style>

<form method="POST">
	<div id=error></div>
	<input type="text" name="checkemail" class="textt">
	<span class="availableSpn"    style="display:none;">/</span>
	<span class="notavailableSpn" style="display:none;">X</span>
	<br>
	<!-- <input type="submit" name="buttoni" value="submit" class="btn"> -->
</form>	

