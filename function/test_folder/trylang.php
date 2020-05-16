<?php 
	include 'main_conn.php';
	//for testing purposes only;
?>

<div class="box1">
			 <table border="0" width="auto" cellpadding="10">
			 		<tr>
			 			<td><b>Id</b></td>
			 			<td><b>Fullname</b></td>
						<td><b>Username</b></td>
						<td><b>Password</b></td>
						<td><b>Birthday</b></td>
						<td><b>Gender</b></td>
						<td><b>Change Data</b><td>
					</tr>

					<tr>
						<td colspan="7"><hr></td>
					</tr>
				<?php 
						$email = 'abao_edmund@yahoo.com';
						$password = '123123';
						$sql = "SELECT * FROM facebook WHERE email_mobile ='$email' && password = '$password'";
						$query = $main_conn->query($sql);
						$check_record = $query->num_rows;
						if($check_record > 0){
				
						//nag kuha kog data sa database
						while($row = mysqli_fetch_assoc($query)){
							$db_id= $row['id'];
							$db_firstname= $row['firstname'];
							$db_lastname= $row['lastname'];
							$db_pass_id = $row['password'];
							$db_birthday =$row['birthday'];
							$db_gender = $row['gender'];
							$db_email = $row['email_mobile'];

							$db_fullname = ucwords($db_firstname) ." ". ucfirst($db_lastname);
							echo "<tr>
								<td>$db_id</td>
								<td>$db_fullname</td>
								<td>$db_email</td>
								<td>$db_pass_id</td>
								<td>$db_birthday</td>
								<td>$db_gender</td>
								<td>
									<a href = 'edit.php?id=$db_id'>Update</a>
									|
									<a href = 'delete.php?id=$db_id'>Delete</a>
								</td>
							</tr>";
						}
			}
			else{	
					echo "wala";//wrong pass
				}
				?>
				<tr><td colspan="9"><hr></td></tr>
			</table>



