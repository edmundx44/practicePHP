<?php 
	require_once('../main_conn.php');
	session_start();
	//session
	if(isset($_SESSION['id'])){
		$db_user_id = $_SESSION['id'];
		$db_user_email = $_SESSION['email_mobile'];

		//$sql = "SELECT * FROM facebook WHERE id = :db_user_id";
		$stmt = $main_conn->prepare("SELECT * FROM facebook WHERE id = :db_user_id");
		// $stmt->bindParam(":db_user_id", $db_user_id); dili nako mag bind param kai na a na sa execute naku g butang
		$stmt->execute([
			//key => value
			':db_user_id' => $db_user_id
		]);
		$check_record = $stmt->rowCount();
		if($check_record > 0){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);	//deretso diri
			$db_firstname = $row['firstname'];
			$db_lastname = $row['lastname'];

			$db_fullname = ucwords($db_firstname) ." ". ucfirst($db_lastname); 
			//echo $db_user_id;
		} 
	}else{
		header("location:main.php");
	}
	$main_conn = null;
?>

<!DOCTYPE html>
<html>
<head>
	<title>profile</title>
	<link rel="stylesheet" type="text/css" href="../css/profile.css">
	<script src="../function/script/jQuery3_4_1.js"></script>
	<script src="../function/script/function.js"></script>
</head>
<body>
	<div class="homepage-box-header">
		<div class="box-header-content">
			<div class="f-logo">
				<img src="../img/fb.png">
			</div>
			<div class="f-search">
				<input type="text" name="">
				<input class="s-btn" type="submit" name="" value="OK">
			</div>
			<div class="name profile">
				<span class="profile_header_photo"><img src="../img/prof.png"></span><a href=""><?php echo $db_fullname; ?></a>
			</div>
			<div class="fbhome home">
				<a href="main.php">Home</a>
			</div>
			<div class="fbcreate create">
				<a href="#">Create</a>
			</div>
			<div class="friend icons">
				<img src="../img/friend.png">
			</div>
			<div class="mes icons">
				<img src="../img/messenger.png">
			</div>
			<div class="noti icons">
				<img src="../img/notification.png">
			</div>
			<div class="logout">
				<a href="../logout.php">Logout</a>
			</div>
		</div>
	</div>
	<div class="body-container">
		<div class="content-box">
			<div class="box-cover-photo">
				<div class="cover_photo">
					<img src="../img/fbcover.jpg">
				</div>
			</div>
			<div class="upload_box_icon_4_cover">

					<form id="file_upload_cover" method="POST" enctype="multipart/form-data">
						<label for="file_cover" class="lbl_file">
							<div class="fa"><span><img src="../img/camera.png"></span></div>
						</label>
						<input type="file" name="file_cover" class="file_cover filename_cover" id="file_cover">
						<center><input type="button" name="btn_cover" id="upload_btn_cover" value="Upload"></center>
					</form>

			</div>
			<div class="box-profile-photo">
				<div class="profile_photo">
					<img src="../img/fbcover.jpg">
				</div>
				<div class="upload_box_icon">

					<form id="file_upload" method="POST" enctype="multipart/form-data">
						<label for="file" class="lbl_file">
							<div class="fa"><span><img src="../img/camera.png"></span></div>
						</label>
						<input type="file" name="file" class="file filename" id="file">
						<center><input type="button" name="btn" id="upload_btn_dp" value="Upload"></center>
					</form>

				</div>
				<div class="profile-name-box">
					<div class="profile_name">
						<a href="#"><?php echo $db_fullname; ?></a>
					</div>
				</div>
			</div>
			<div class="fb-headline">
				<ul class="text-headline">
					<li><a href="" class="txt-bckgnd">Timeline</a></li>
					<li><a href="" class="txt-bckgnd">About</a></li>
					<li><a href="" class="txt-bckgnd">Friends</a></li>
					<li><a href="" class="txt-bckgnd">Photos</a></li>
					<li><a href="" class="txt-bckgnd">Archieve</a></li>
					<li><a href="" class="txt-bckgnd last">More</a></li>
				</ul>
			</div>
			<div class="content_box">
				<div class="left_content">
					<div class="fb_sidebar_left">
						<div class="intro_header">
							<img src="../img/fb_globe.png">
							<span class="intro_text">Intro</span>
						</div>
						<div class="bio_content">
							<span>In Jesus Name Amen</span>
						</div>
						<div class="bio_btn_box">
							<input class="btn_bio" type="button" name="" value="Edit Bio">
						</div>
						<div class="details_box">
							<div class="detail_edit">
								<ul>
									<li>Work: </li>
									<li>Education: </li>
									<li>Current City: </li>
									<li>Hometown: </li>
									<li>Relationship: </li>
								</ul>
							</div>
						</div>
						<div class="details_box_box">
							<input class="btn_details" type="button" name="" value="Edit Details">
						</div>
						<div class="fb_featured_content">
							
						</div>
						<div class="fb_featured">
							<span class="text_featured">Showcase what's important to you by adding photos, pages, groups and more to your featured section on your public profile.</span>
							<div class="add_featured">
								<a href="#"><span>Add to Featured</span></a>
							</div>
						</div>
					</div>
					<div class="fb_sidebar_left_second">
						<div class="header_">
							<div class="left">Photos</div>
							<div class="right">Add Photos</div>
						</div>
						<div class="header_photos">
							<div class="photos_row1">
								
							</div>
							<div class="photos_row2">
								
							</div>
						</div>
					</div>
					<div class="fb_friends_container">
						<div class="header_">
							<div class="left">Fb Friends</div>
							<div class="right">Find Friends</div>
						</div>
						<div class="header_photos_friends">
							<div class="friends_photos_row1">
								
							</div>
							<div class="friends_photos_row2">
								
							</div>
							<div class="friends_photos_row3">
								
							</div>
						</div>
					</div>
				</div>
				
				<!-- chat starts -->
				<div class="chat_box_pos">
					<div class="chat_container">
					<!-- <div class="chat_header">
						<div class="header_img_profile">
							<span class="profile_chat_icon"><img src="../img/fbcover.jpg"></span>
						</div>
						<div class="x_box">
							<div id="mdiv">
							  <div class="mdiv">
							    <div class="md"></div>
							  </div>
							</div>
						</div>
						<div class="active">
							<h4><?php //echo $db_fullname; ?></h4>
							<h6>10 hours ago...</h6>
						</div>
						<div class="icon_header">
							<ul>
								<li>icon</li>
								<li>icon</li>
								<li>icon</li>
							</ul>
						</div>		
						</div> -->
						<!-- <div class="chat_page">
							<div class="msg_inbox">
								<div class="chats">
									<div class="msg_page">

										<div class="received_chats">
											<div class="received_chats_img">
												<img src="../img/fbcover.jpg">
											</div>
											<div class="received_msg">
												<div class="received_msg_inbox">
													<p>Hahahaha!</p>
												</div>
												<span class="time">11:11 PM</span>
											</div>
										</div>

										<div class="send_chats">
											<div class="sent_chats_img">
												<span class="profile_sent_icon_chat"><img src="../img/fbcover.jpg"></span>
											</div>
											<div class="sent_msg">
												<div class="send_msg_inbox">
													<p>Hahahaha!</p>
												</div>
												<span class="sent_time">11:11 PM</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					<!-- 	<div class="msg_bottom_box">
							<div class="msg_bottom">
								<textarea onkeypress="handleInput(event)" class="chat-footer__form-input" placeholder="Chat here!"></textarea>
							</div>
							<div class="icon_bottom_header">
									<ul>
										<li>icon</li>
										<li>icon</li>
										<li>icon</li>
									</ul>
							</div>
						</div> -->	
					</div>
				</div>
				<!-- chat ends -->

					<div class="right_content">
						<div class="createPost">
							<div class="post_content">Create Post</div>
							<hr>
							<div class="textarea">
								<span class="profile_post_photo"><img src="../img/prof.png"></span><input type="text" name="text1" placeholder="What's on your mind?">
							</div>
							<hr>
							<div class="post_content1">

								<label for="file" class="custom-file-upload">
								    <i class="fa fa-cloud-upload"></i><div class="action1 uploadhover">Photo/Video</div>
								</label>
								<input type="file" name="file" class="file filename" id="file">

								<div class="action1">Tag Friends</div>
								<div class="action1">Activity</div>
							</div>
						</div>
						<div class="post_container">
							<div>
								<div><span class="profile_posted_photo"><img class="posttext0-name" src="../img/prof.png"></span></div>
								<div class="posted_detail_box">
										<span class="profile_name"><?php echo $db_fullname; ?></span> 
										<span  class="concat_text">with</span>
										<span class="tag_name">Cole Sprouse </span>
										<span  class="concat_text">and </span>
										<span class="tag_name">15k others.</span><br>
										<div class="posted_hours"><p>12hrs.</p></div>
								</div class="posttext0_name">
							</div>
							<img class="wallpost "src="../img/wall.jpg">
							<div class="like-comment-share-box">
								<div class="Like-comment-share">
										<div class="like">Like</div>
										<div class="comment">Comment</div>
										<div class="share">Share</div>
								</div>
							</div>
							<div class="posted_likes">
									<span class="profile_name"><?php echo $db_fullname; ?></span> 
									<span  class="concat_text">with</span>
									<span class="tag_name">Cole Sprouse </span>
									<span  class="concat_text">and </span>
									<span class="tag_name">15k others.</span><br>
									<div class="posted_hours">12hrs.</div>
							</div>
							<div class="comment_box">
									<span class="profile_comment_photo"><img class="comment-name" src="../img/prof.png" ></span>
									<div class="comment_text_box"><input type="text" name="comment" class="comment" placeholder="Comment"></div>
							</div>
						</div>
						
					</div>
			</div>
		</div>
		<div id="chatbox">
				<div class="chatchat">
					<h3>Online</h3>
				</div>
					<div class="displayOnlineUsers">
						<ul class="append_ol_users">
							<!-- <li class="Online_Users">
								<div class="Online_Users_box">
									<div class="Online_Users_photo"><img src="../img/fbcover.jpg"></div>
									<div class="Online_Users_name">Edmund Franz</div>
									<div class="status">ON</div>
								</div>
							</li> -->
						</ul>
					</div>					
			</div>
			<div id="chatsearch-container">
				<div class="chatsearch">
					<input class="chat-searchname" type="text" name="" placeholder="Search">
					<input class="chat-submit"type="submit" name="" value="Ok">
				</div>		
			</div>
	</div>
</body>		
</html>