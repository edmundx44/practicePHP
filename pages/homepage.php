<?php 
	require_once('../main_conn.php');
	session_start();
	//session
	if(isset($_SESSION['id'])){
		$db_user_id = $_SESSION['id'];
		$db_user_email = $_SESSION['email_mobile'];

		//$sql = "SELECT * FROM facebook WHERE id = :db_user_id";
		$stmt = $main_conn->prepare("SELECT * FROM facebook WHERE id = :db_user_id");
		//return true if sakto error if dili
		/*$stmt->bindParam(":db_user_id", $db_user_id); //dili nako mag bind param kai na a na sa execute naku g butang*/
		$run = $stmt->execute([
			':db_user_id' => $db_user_id
		]);
		$check_record = $stmt->rowCount(); // check record if na ba parehas sa database return true
		if($check_record > 0){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);	//kwaon naku ang data na naka associative array
			$db_firstname = $row['firstname'];
			$db_lastname = $row['lastname'];

			$db_fullname = ucwords($db_firstname) ." ". ucfirst($db_lastname); 
			//print_r($_SESSION);
			//print_r($stmt);
			//var_dump($db_user_id); 
		} 
	}else{
		header("location:main.php");
	}
	/*if(isset($_SESSION['id'])){
		$db_user_id = $_SESSION['id'];
		$sql = "SELECT * FROM facebook WHERE id = '$db_user_id'";
		$query = $main_conn->query($sql);
		$check_record = $query->num_rows; // pwede d na mag ing ani
		if($check_record > 0){
			$row = $query->fetch_assoc();	//deretso diri
			$db_firstname = $row['firstname'];
			$db_lastname = $row['lastname'];

			$db_fullname = ucwords($db_firstname) ." ". ucfirst($db_lastname); 
			//echo $db_user_id;
		} 
	}else{
		header("location:main.php");
	}*/

?>
<!DOCTYPE html>
<html>
<head>
	<title>Facebook</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/homepage.css">
<script src="../function/script/jQuery3_4_1.js"></script>
<script src="../function/script/function.js"></script>
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
				<span class="home_profile_photo"><img src="../img/prof.png"></span><a href="profile.php"><?php echo $db_fullname; ?></a>
			</div>
			<div class="fbhome home">
				<a href="#">Home</a>
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
	<div class="classbody">
		<div id="sidebar-left">
			<div class="sidebar-left-box">
				<span class="profile_photo"><img src="../img/prof.png"></span>
				<div id="side1"><a href="#"><?php echo $db_fullname; ?></a></div>
			</div>
			<div class="sidebar-left-box1">
				<div id="side3" class="bodyn">News feed</div>
				<div id="side4" class="bodyn">Messages</div>
				<div id="side5" class="bodyn">Events</div>
			</div>
			<div class="sidebar-left-box2">
				<div id="side6" class="bodyn">PAGES</div>
				<div id="side7" class="bodyn">Pages feed</div>
				<div id="side8" class="bodyn">Like pages</div>
				<div id="side9" class="bodyn">Create page</div>
				<div id="side10" class="bodyn">Create ad</div>
			</div>
			<div class="sidebar-left-box3">
				<div id="side11" class="bodyn">GROUPS</div>
				<div id="side12" class="bodyn">New groups</div>
				<div id="side13" class="bodyn">Create group</div>
			</div>
			<div class="sidebar-left-box4">
				<div id="side14" class="bodyn">APPS</div>
				<div id="side15" class="bodyn">Games</div>
				<div id="side16" class="bodyn">On this day</div>
				<div id="side17" class="bodyn">Games feed</div>
			</div>
			<div class="sidebar-left-box5">
				<div id="side18" class="bodyn">FRIENDS</div>
				<div id="side19" class="bodyn">Close friends</div>
				<div id="side20" class="bodyn">Family</div>
			</div>
			<div class="sidebar-left-box6">
				<div id="side21" class="bodyn">INTERESTS</div>
				<div id="side22" class="bodyn">Pages and public</div>
			</div>
			<div class="sidebar-left-box7">
				<div id="side23" class="bodyn">EVENTS</div>
				<div id="side24" class="bodyn">Create event</div>
			</div>
		</div>
		<div class="content-container">
			<div class="createPost">
				<div class="post-content">Create Post</div><hr>
				<div class="textarea">
					<span class="profile_post_photo"><img src="../img/prof.png"></span><input type="text" name="text1" placeholder="What's on your mind?">
				</div>
				<hr><div class="post-content1">
						<div class="action1">Photo/Video</div>
						<div class="action1">Tag Friends</div>
						<div class="action1">Activity</div>
					</div>
			</div>
			<div class="postcontainer0">
				<div class="posttext0">
					<span class="profile_posted_photo"><img class="posttext0-name" src="../img/prof.png"></span>
						<div class="posttext0-name marginkilid">
							<p class="post0-name posttext0-name">Edmund Abao</p> 
							<p  class="post0-name-1 posttext0-name"> with </p>
							<p class="post0-name-2 posttext0-name">Cole Sprouse </p>
							<p  class="post0-name-1 posttext0-name">and </p>
							<p class="post0-name-2 posttext0-name">15k others.</p><br>
							<div class="posthours"><p>12hrs.</p></div>
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
				<div>
					<div class="textlikes">
						<p1 class="post0-name posttext0-name">Cole Sprouse</p1>
						<p2 class="post0-name-1 posttext0-name"> and </p2>
						<p3 class="post0-name-2 posttext0-name"> 10k others </p3>
						<p4 class="post0-name-1 posttext0-name"> like this.</p4><br>
					</div>
				</div>
				<div class="comment-box">
						<span class="profile_comment_photo"><img class="comment-name" src="../img/prof.png" ></span>
						<input class="comment" type="text" name="" placeholder="Comment">
				</div>
			</div>
			<div class="postcontainer1">
				<div class="posttext0">
					<span class="profile_posted_photo"><img class="posttext0-name" src="../img/prof.png"></span>
						<div class="posttext0-name marginkilid">
							<p class="post0-name posttext0-name">Jin Woo</p> 
							<p  class="post0-name-1 posttext0-name"> with </p>
							<p class="post0-name-2 posttext0-name">Cole Sprouse </p>
							<p  class="post0-name-1 posttext0-name">and </p>
							<p class="post0-name-2 posttext0-name">10k others.</p><br>
							<div class="posthours"><p>12hrs.</p></div>
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
				<div>
					<div class="textlikes">
						<p1 class="post0-name posttext0-name">Cole Sprouse</p1>
						<p2 class="post0-name-1 posttext0-name"> and </p2>
						<p3 class="post0-name-2 posttext0-name"> 10k others </p3>
						<p4 class="post0-name-1 posttext0-name"> like this.</p4><br>
					</div>
				</div>
				<div class="comment-box">
						<span class="profile_comment_photo"><img class="comment-name" src="../img/prof.png"></span>
						<input class="comment" type="text" name="" placeholder="Comment">
				</div>
			</div>
			</div>

			
			<!-- chat chat chat-->
			<div class="chat_box_pos">
				
			</div>
			<!-- end chat chat chat -->

			<div id="sidebar-right">
				<div class="birthdaybox">
					<p class="post0-name-2 posttext0-name">Birthday Today</p><br><hr>
					<p class="post0-name posttext0-name">Shimizo Lapad Ulo</p>
					<p class="post0-name posttext0-name">Aginomoto Walay Ulo</p>
				</div>
				<div class="Gamingvideobox">
					<p class="post0-name-2 posttext0-name">Gaming</p><br><hr>
					<img src="../img/ggg.jpg">
				</div>
				<div class="populargames">
					<p class="post0-name-2 posttext0-name">Popular Games</p><br><hr>
					<img src="../img/gg.png">
				</div>
				<div class="suggested">
					<p class="post0-name-2 posttext0-name">Suggested</p><br><hr>
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
	</div>
</body>
<script type="text/javascript">
		$(document).ready(function(){
			
		});
</script>
</html>