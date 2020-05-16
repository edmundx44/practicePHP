
var globalSessionUserId = ""; //global varviable
		
			
		$(document).ready(function(){

		
			// $('body').on('click','.Online_Users',function(){
			// 	 var txtni = $(this).find('.Online_Users_name').text();
			// 	 alert(txtni);
			// });
			
			
	

		//for logout
		window.addEventListener("beforeunload", function () {
	    	goOffline();
		});


		getUserId(); //e run na ni niya para makuha ang session id
		getUserPhoto();
		getUserCover();
		displayOnlineUsers();
	
		//diri ko mag display img using ajax
		//mag upload og profile picture
		$("#upload_btn_dp").on("click",function(){
			var property = $('.filename')[0].files[0]; //gikuha naku ang namefile
			var image_name = property.name; //property.name ang name nakuha naku sa input type  name="file"
			var image_extension = image_name.split('.').pop().toLowerCase();
			var image_size = property.size;
			//console.log(image_extension);  return the extension files
			if(jQuery.inArray(image_extension, ['png','jpg','jpeg']) == -1){
			alert('invalid file');
			}else{
				var	form_data = new FormData();
				form_data.append("file_img_dp", property); //create an array name file_img mao ni akong gamiton pag $_FILES['file_img']
				form_data.append("sessionId", globalSessionUserId); //kuaon naku ang globalSessionUserId store to sessionId used $_POST['sessionId'] to get
				$.ajax({
					url: "../function/upload_dp.php",
					method: "POST",
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,
					success: function (data){
					console.log(data);
					//alert(data);
					alert("Uploaded Success");

						$('.profile_photo').html(data);
						//pede rani e comment e refresh nalang pag human upload
						$('.profile_header_photo').html(data);
						$('.profile_post_photo').html(data);
						$('.profile_posted_photo').html(data);
						$('.profile_comment_photo').html(data);
						//$('.profile_chat_photo').html(data);
						$('.profile_chat_icon').html(data);
						$('.profile_sent_icon_chat').html(data);

						if($('.'+id).attr() == globalSessionUserId){
							$('.'+id).html(data);
						}
						//location.reload(true); refresh ni sya
						$("form").trigger('reset'); //para dili ma upload utro
					}
				})
				
			}
		});

		//mag upload og cover photo
		$("#upload_btn_cover").on("click",function(){
			var property = $('.filename_cover')[0].files[0]; //gikuha naku ang namefile
			var image_name = property.name; //property.name ang name nakuha naku sa input type  name="file"
			var image_extension = image_name.split('.').pop().toLowerCase();
			var image_size = property.size;
			//console.log(image_extension);  return the extension files
			if(jQuery.inArray(image_extension, ['png','jpg','jpeg']) == -1){
			alert('invalid file');
			}else{
				var	form_data = new FormData();
				form_data.append("file_img_cover", property); //create an array name file_img mao ni akong gamiton pag $_FILES['file_img_cover']
				form_data.append("sessionId", globalSessionUserId); //kuaon naku ang globalSessionUserId store to sessionId used $_POST['sessionId'] to get
				$.ajax({
					url: "../function/upload_cover.php",
					method: "POST",
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,
					success: function (data){
					console.log(data);
					alert("Uploaded Success");
						$('.cover_photo').html(data);
						//location.reload(true); refresh ni sya
						$("form").trigger('reset'); //para dili ma upload utro
					}
				})
				
			}
		});

	// for profile photo display need ni sya ef mag refresh dili mawala ang profile photo
	function getUserPhoto(){
			 $.ajax({
				url: '../function/displayUserPhoto.php',
				type: 'POST',
				data: {sessionId: globalSessionUserId},
				cache: false,
				success: function(data){
					    //var userPhoto = "'"+$.trim(data)+"'"; //para way white space 'dirimabutang'
					    //console.log(userPhoto);
						//$('#img_display').attr('src',data);
						if(data !== ''){
								//para sa profile
						 		$('.profile_photo').html(data);
								$('.profile_header_photo').html(data);
								$('.profile_post_photo').html(data);  //same sa homepage
								$('.profile_posted_photo').html(data);
								$('.profile_comment_photo').html(data);
								//$('.profile_chat_photo').html(data);
								$('.profile_chat_icon').html(data);
								$('.profile_sent_icon_chat').html(data);
								//para sa homepage
								$('.home_profile_photo').html(data);
								console.log(data);
						 	}else{
						 		console.log(data);
						 	}
					}
			});
	}
	// for Cover photo display need ni sya para ef mag refresh dili mawala ang cover photo
	function getUserCover(){
			 $.ajax({
				url: '../function/displayUserCover.php',
				type: 'POST',
				data: {sessionId: globalSessionUserId},
				cache: false,
				success: function(data){
					    //var userPhoto = "'"+$.trim(data)+"'"; //para way white space 'dirimabutang'
					    //console.log(userPhoto);
						//$('#img_display').attr('src',data);
						if(data !== ''){
							//para sa profile
						 	$('.cover_photo').html(data);
								console.log(data);
						 	}else{
						 		console.log(data);
						 	}
					}
			});
	}

	// get user id session then mao ni akong gamiton kung mag kuha og session id
	function getUserId($get_db_user_id){
		 $.ajax({
				url: '../function/displayUserid.php',
				type: 'GET',
				cache: false,
				async: false,
				success: function(data){
				globalSessionUserId = $.trim(data); //sodlan ang global session id
				console.log(data); //display session id
				}
			});
		}

	}); // end of ducoment
	
/*	function displayOnlineUsers(){
		$.ajax({
			url:"../function/displayOnlineUsers.php",
			type:"POST",
			dataType:"json",
			success:function(result){
				//console.log(result)
				setTimeout(function(){
					//displayOnlineUsers();
				}, 1000);
				$.each(result, function(index , dataValue){
					//console.log(result);
				var append ="<li class='Online_Users'>";
					append +=	"<div class='Online_Users_photo'><img src='"+dataValue.image+"'></div>";
					append +=		"<div class='Online_Users_name'>"+dataValue.name+"</div>";
					append +=		"<div class='status'>"+dataValue.status+"</div>";
					append +=	"</div>";
					append += "</li>";
					$(".append_ol_users").append(append);
				});

			}
		});
	}
*/

	function displayOnlineUsers(){
		setTimeout(function(){
			$('.append_ol_users').load('../function/displayOnlineUsers.php');
		 	displayOnlineUsers();
		}, 5000);
	}

	//go offline updateLoginStatus to offline
	function goOffline(){
		$.ajax({
			url: '../../function/logout.php',
			type: 'GET',
			cache: false,
			async: false,
			success: function(data){

			}
		});
	}

 			Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
       
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
           
            //arrays of popups ids
            var popups = [];
       
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                       
                        document.getElementById(id).style.display = "none";
                       
                        calculate_popups();
                       
                        return;
                    }
                }  
            }
       
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 275;
               
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        //console.log(element);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
               
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
           
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name,photoId)
            {
               console.log(name);
                for(var iii = 0; iii < popups.length; iii++)
                {  
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                   
                        popups.unshift(id);
                       
                        calculate_popups();
                       
                       
                        return;
                    }
                }              
               
               
                var element = '<div class="chat_container" id='+ id +'>';
					element+=		'<div class="chat_header">';
					element+=			'<div class="header_img_profile">';
					element+=				'<span class='+id+'><img src='+photoId+'></span>';
					element+=			'</div>';
					element+=			'<a href="javascript:close_popup(\''+ id +'\');">';
					element+=			'<div class="x_box">';
					element+=				'<div id="mdiv">';
					element+=				  '<div class="mdiv">';
					element+=				    '<div class="md"></div>';
					element+=				  '</div>';
					element+=				'</div>';
					element+=			'</div>';
					element+=			'</a>';
					element+=				'<div class="active">';
					element+=					"<h4>"+ name +"</h4>";
					element+=					'<h6>Time here:no function yet</h6>';
					element+=				'</div>';
					element+=		'</div>';

					element+=  '<div class="chat_body" id='+ id +'>';
					element+=		'<div class="chat_page">';
					element+=			'<div class="msg_inbox">';
					element+=				'<div class="chats">';
					element+=					'<div class="msg_page">';

					element+=						'<div class="received_chats">';
					element+=							'<div class="received_chats_img">';
					element+=								'<img src="../img/fbcover.jpg">';
					element+=							'</div>';
					element+=							'<div class="received_msg">';
					element+=								'<div class="received_msg_inbox">';
					element+=									'<p>Hahahaha!</p>';
					element+=								'</div>';
					element+=								'<span class="time">11:11 PM</span>';
					element+=							'</div>';
					element+=						'</div>';

					element+=						'<div class="send_chats">';
					element+=							'<div class="sent_chats_img">';
					element+=								'<span class="profile_sent_icon_chat"><img src='+photoId+'></span>';
					element+=							'</div>';
					element+=							'<div class="sent_msg">';
					element+=								'<div class="send_msg_inbox">';
					element+=									'<p>Hahahaha!</p>';
					element+=								'</div>';
					element+=								'<span class="sent_time">11:11 PM</span>';
					element+=							'</div>';
					element+=						'</div>';

					element+=					'</div>';
					element+=				'</div>';
					element+=			'</div>';
					element+=		'</div>';

					element+=		'<div class="msg_bottom_box">';
					element+=			'<div class="msg_bottom">';
					element+=				'<textarea onkeypress="handleInput(event)" id='+id+' class="chat-footer__form-input" placeholder="Chat here!"></textarea>';
					element+=			'</div>';
					element+=			'<div class="icon_bottom_header">';
					element+=					'<ul>';
					element+=						'<li>icon</li>';
					element+=						'<li>icon</li>';
					element+=						'<li>icon</li>';
					element+=					'</ul>';
					element+=			'</div>';
					element+=		'</div>';
					element+= 	'</div>';

					element+= '</div>';
				
					
				//console.log(element);
                $('.chat_box_pos').append(element);
       			
                popups.unshift(id);
                       
                calculate_popups();

               	$(".chat-footer__form-input").keypress(function (e) {
               		var input = $(".chat-footer__form-input").val();

				    if(e.which == 13 && !e.shiftKey) {        
				        e.preventDefault();
				       	    send=	'<div class="send_chats" id='+ id +'>';
							send+=		'<div class="sent_chats_img">';
							send+=			'<span class="profile_sent_icon_chat"><img src='+photoId+'></span>';
							send+=		'</div>';
							send+=		'<div class="sent_msg">';
							send+=			'<div class="send_msg_inbox">';
							send+=				'<p>'+input+'</p>';
							send+=			'</div>';
							send+=			'<span class="sent_time">11:11 PM</span>';
							send+=		'</div>';
							send+=	'</div>';				       
    					$(".msg_page").append(send);
    					$(".chat-footer__form-input").val('');
				    }
				});
            }
           
            // $('body').on('click','.Online_Users',function(){
			// 	 var txtni = $(this).find('.Online_Users_name').text();
			// 	 alert(txtni);
			// });

           
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
               
                display_popups();
               
            }
           
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);