	
		
		$(document).ready(function(){
			/*$("#genderlbl3").on("click", function(){
  				$("#genderOpt").show();			
 		 });
  		$("#genderlbl1,#genderlbl2").on("click", function(){
  				$("#genderOpt").hide();	
				$(".gender-label").css("border","none");
 		 });*/
 		 	checkemail();
	 		$(".signup_btn").on("click",function(){
	 				var fname = $("#form_fname").val();
				 	var lname = $("#form_lname").val();
				 	var emobile = $("#form_emailmobile").val();
				 	var pass = $("#fom_pass").val();
				 	var fmonth = $("#form_month").val();
				 	var fday = $("#form_day").val();
				 	var fyear = $("#form_year").val();
				 	var fgender = $(".gender1");
				 	var selectedGender = $("input[name='gender']:checked").val();
				 	var dateBirth = fmonth + "/" + fday + "/" + fyear;

	 				//var customgender = $("input[name='gendercustom']:checked")
	 				//var pattern = /^[A-Za-z]*$/;
		 			if(fname==''){
		 				$("#form_fname").css("border","1px solid red");
		 				$("#form_fname").on("blur", function(){
  					 	//$(this).css('background-color', 'red');
  					 	check_fname();

 		 				});
		 			}
		 			if(lname == ''){
			 			$("#form_lname").css("border","1px solid red");
			 			$("#form_lname").on("blur", function(){
  					 	//$(this).css('background-color', 'red');
  					 	check_lname();
 		 				});
		 			}
			 		if(emobile == ''){
				 		$("#form_emailmobile").css("border","1px solid red");
				 		$("#form_emailmobile").on("blur", function(){
  					 	//$(this).css('background-color', 'red');
  					 		check_femailmobile();
 		 				});
			 		}
				 	if(pass == ''){
					 	$("#fom_pass").css("border","1px solid red");
					 	$("#fom_pass").on("blur", function(){
  					 	//$(this).css('background-color', 'red');
  					 	check_fpass();
 		 				});
				 	}
				 	if(fmonth == 'Month'){
					 	$("#form_month").css("border","1px solid red");
					 	$("#form_month").on("blur", function(){
  					 	//$(this).css('background-color', 'red');
  					 	check_fmonth();
 		 				});
				 	}
				 	if(fday == 'Day'){
					 	$("#form_day").css("border","1px solid red");
					 	$("#form_day").on("blur", function(){
  					 	//$(this).css('background-color', 'red');
  					 	check_fday();
 		 				});
				 	}
					if(fyear == 'Year'){
						 $("#form_year").css("border","1px solid red");
						 $("#form_year").on("blur", function(){
  					 		//$(this).css('background-color', 'red');
  					 		check_fyear();
 		 				});
					 }
					 
					if(!fgender.is(":checked")){
						 $(".gender-label").css("border","1px solid red");
					 }
					//if na a nai sulod tanan field
					checkemail();
					if(fname && lname && emobile && pass && fmonth && fday && fyear && selectedGender){
						if(validateEmail(emobile) && $('#tempbox').val() ==='000'){	
							insertData();
						}else{
							$("#error").html("Wrong email or Already Taken");
						}
					}else{
						$("#error").html("Fill ALL with correct information");
					}
					//veiwData(); 			
	 		});
	 		/*
				pang tengting rako naku ni console log if mugawas ang output
				function insertData(){
					var fname = $("#form_fname").val();
	 				var lname = $("#form_lname").val();
	 				var emobile = $("#form_emailmobile").val();
	 				var pass = $("#fom_pass").val();
	 				var fmonth = $("#form_month").val();
	 				var fday = $("#form_day").val();
	 				var fyear = $("#form_year").val();
	 				var selectedGender = $("input[name='gender']:checked").val();
	 				var customgender = $("input[name='gendercustom']:checked");
	 				if(customgender.is(":checked")){
	 					//override
	 					selectedGender = $("#genderOpt").val();

	 				}
	 				var dateBirth = fmonth + "/" + fday + "/" + fyear;
	 				console.log(fname,lname,emobile,pass,dateBirth,selectedGender);		
				}*/
				//check if empty
				function check_fname(){
				var fname = $("#form_fname").val();
					if(fname !== ''){
		 				$("#form_fname").css("border","1px solid green");
	 				}else{
	 					$("#form_fname").css("border","1px solid red");
	 				}
				}
				function check_lname(){
				var lname = $("#form_lname").val();
					if(lname == ''){
		 				$("#form_lname").css("border","1px solid red");
	 				}else{
	 					$("#form_lname").css("border","1px solid green");
	 				}
				}
				function check_femailmobile(){
				var emobile = $("#form_emailmobile").val();
					if(emobile == ''){
		 				$("#form_emailmobile").css("border","1px solid red");
	 				}else{
	 					$("#form_emailmobile").css("border","1px solid green");
	 				}
				}
				function check_fpass(){
				var pass = $("#fom_pass").val();
					if(pass == ''){
		 				$("#fom_pass").css("border","1px solid red");
	 				}else{
	 					$("#fom_pass").css("border","1px solid green");
	 				}
				}
				function check_fmonth(){
				var fmonth = $("#form_month").val();
					if(fmonth == 'Month'){
		 				$("#form_month").css("border","1px solid red");
	 				}else{
	 					$("#form_month").css("border","1px solid green");
	 				}
				}
				function check_fday(){
				var fday = $("#form_day").val();
					if(fday == 'Day'){
		 				$("#form_day").css("border","1px solid red");
	 				}else{
	 					$("#form_day").css("border","1px solid green");
	 				}
				}
				function check_fyear(){
				var fyear = $("#form_year").val();
					if(fyear == 'Year'){
		 				$("#form_year").css("border","1px solid red");
	 				}else{
	 					$("#form_year").css("border","1px solid green");
	 				}
				}	
				function validateEmail(emobile) {
    			var pattern = /^([\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$/;
				return $.trim(emobile).match(pattern) ? true : false;
				}
				function lowercase(tolower){
					var lowercase = tolower.toLowerCase();
					return lowercase;
				}
			
			

				//function data using ajax
				function insertData(){
					var fname = $("#form_fname").val();
				 	var lname = $("#form_lname").val();
				 	var emobile = $("#form_emailmobile").val();
				 	var pass = $("#fom_pass").val();
				 	var fmonth = $("#form_month").val();
				 	var fday = $("#form_day").val();
				 	var fyear = $("#form_year").val();
				 	var fgender = $(".gender1");
				 	var selectedGender = $("input[name='gender']:checked").val();
				 	var dateBirth = fmonth + "/" + fday + "/" + fyear;

					fname = lowercase(fname);
					lname = lowercase(lname);
					emobile = lowercase(emobile);
	 				$.ajax({
	 					//request to insert in insert.php
	 					url: '../function/insert.php',
	 					method: 'POST',
	 					//assign any name i called it firstname this firstname mao ni akong gamiton pag post sa data sa php
	 					data:{firstname:fname ,lastname:lname , email_mobile:emobile , pass:pass , birthday:dateBirth , gender:selectedGender},
	 					success: function(data){
	 						// everytime na success na or good to go na
	 						//akong g call og e run to nako sulod sa akong function.php which akong g butang sa insert.php ang calling
	 							$("#error").html(data);
		 						//to reset the fields	
	 							$("form").trigger('reset');
	 							$("form_fname,#form_lname,#form_emailmobile,#fom_pass,#form_month,#form_day,#form_year").css("border","1px solid #bdc3c7");
	 							$(".gender-label").css("border","none");
	 					}
	 				})
				}	
				function checkemail(){
					$('#form_emailmobile').on('keyup', function(){
						var txtni = $(this).val();		
						$.ajax({
							url: '../function/view.php',
							method:'POST',
							data:{email:txtni},
							success: function(dataemail){
							//ang akong g return didto sa checkuserajax.php whick is echo "011" if true "000" if false
							//everytime na success nai data kai ma butang sa akong function(data)
							//console.log(data); para makit an unsay g return
							
							//console.log(dataemail)
									if(dataemail == '000'){
										//$('#check').show();
										//$('#wrong').hide();
										$('#tempbox').val(dataemail);
									}else{
										//$('#check').hide();
										//$('#wrong').show();
										$('#tempbox').val(dataemail);
									}
									/*if($("#form_emailmobile").val() == ''){
										$('#check').hide();
										$('#wrong').hide();
									}	*/	
							}
						})
					});
				}
				function veiwData(){
					$.ajax({
						url: 'view.php',
						method:'POST',
						success: function(db_data){
							//pass the parameter data then e store sa db_data
							db_data = $.parseJSON(db_data);
							if(db_data.success=='success')
							{
								console.log(db_data);
							}
						}
					})
				}				
		});		