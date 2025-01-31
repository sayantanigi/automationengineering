function btn_register() {
	var base_url=$('#base_url').val();
    var user_type=$('#user_type').val();
	//var username=$('#username').val();
	//var mobile=$('#mobile').val();
	var first_name=$('#first_name').val();
	var last_name=$('#last_name').val();
	var company_name=$('#company_name').val();
	var password=$('#password').val();
	var conf_password=$('#conf_password').val();
	var email=$('#email').val();
    var pattern_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	var location=$('#location').val();
	var latitude=$('#search_lat').val();
	var longitude=$('#search_lon').val();

	if(user_type=='') {
		$('#err_usertype').fadeIn().html('Please select user type').css('color','red');
		setTimeout(function(){$("#err_usertype").html("&nbsp;");},3000);
		$("#user_type").focus();
		return false;
	}

	if(user_type == 1){
		if(first_name=='') {
			$('#err_firstname').fadeIn().html('Please enter First Name').css('color','red');
			setTimeout(function(){$("#err_firstname").html("&nbsp;");},3000);
			$("#first_name").focus();
			return false;
		}

		if(last_name=='') {
			$('#err_lastname').fadeIn().html('Please enter Last Name').css('color','red');
			setTimeout(function(){$("#err_lastname").html("&nbsp;");},3000);
			$("#last_name").focus();
			return false;
		}
	} else if(user_type == 2) {
		if(company_name=='') {
			$('#err_companyname').fadeIn().html('Please enter Company Name').css('color','red');
			setTimeout(function(){$("#err_companyname").html("&nbsp;");},3000);
			$("#companyname").focus();
			return false;
		}

	}

	if(email=='') {
		$('#err_email').fadeIn().html('Please enter email').css('color','red');
		setTimeout(function(){$("#err_email").html("&nbsp;");},3000);
		$("#email").focus();
		return false;

	} else if(!pattern_email.test(email)) {
		$("#err_email").fadeIn().html("Please enter valid email");
		setTimeout(function(){$("#err_email").html("&nbsp;");},5000)
		$("#email").focus();
		return false;
	}

	/*if(mobile=='') {
		$('#err_mobile').fadeIn().html('Please enter mobile').css('color','red');
		setTimeout(function(){$("#err_mobile").html("&nbsp;");},3000);
		$("#mobile").focus();
		return false;
	} else if(mobile.length!=10) {
        $("#err_mobile").fadeIn().html("Please enter 10 digit phone").css('color','red');
    	setTimeout(function(){$("#err_mobile").html("&nbsp;");},3000);
        $("#mobile").focus();
        return false;
    }*/

	if(location=='') {
		$('#err_address').fadeIn().html('Please enter legal address').css('color','red');
		setTimeout(function(){$("#err_address").html("&nbsp;");},3000);
		$("#location").focus();
		return false;
	}

	if(password=='') {
		$('#err_password').fadeIn().html('Please enter password').css('color','red');
		setTimeout(function(){$("#err_password").html("&nbsp;");},3000);
		$("#password").focus();
		return false;
	}

   	if(password.length<6) {
		$('#err_password').fadeIn().html('please enter at least 6 character').css('color','red');
		setTimeout(function(){$("#err_password").html("&nbsp;");},3000);
		$("#password").focus();
		return false;
	}

	if(conf_password=='') {
		$('#err_confpassword').fadeIn().html('Please enter confirm password').css('color','red');
		setTimeout(function(){$("#err_confpassword").html("&nbsp;");},3000);
		$("#conf_password").focus();
		return false;
	}

   	if(conf_password.length<6) {
		$('#err_confpassword').fadeIn().html('please enter at least 6 character').css('color','red');
		setTimeout(function(){$("#err_confpassword").html("&nbsp;");},3000);
		$("#conf_password").focus();
		return false;
	}

	if (password != conf_password) {
		$('#err_check_pass').fadeIn().html('Password Mismatch').css('color','red');
		setTimeout(function(){$("#err_check_pass").html("&nbsp;");},3000);
		return false;
	}


	$.ajax({
		url: base_url+'save',
		type: 'POST',
		//data: {user_type:user_type,username:username,email:email,password:password,service:service,mobile:mobile},
		data: {user_type:user_type, first_name:first_name, last_name:last_name, company_name:company_name, email:email, password:password, location:location, latitude:latitude, longitude:longitude},
		dataType:'json',
		beforeSend : function(){
			$("#rSignUp").text("Please Wait...");
			$("#rSignUp").prop("disable", "true");
		},
		success:function(returndata) {
			if(returndata.result==1) {
				$('#signUp_form').hide();
				$('.select-user').hide();
				$('#register-messages').show();
				$("#signUp_form")[0].reset();
				/*setTimeout(function () {
                 	$('#register-messages').hide();
             	}, 20000);*/
			}
			if(returndata.result=='0') {
				/*if(returndata.data=='phone') {
					$("#err_mobile").fadeIn().html("This phone already exists").css('color','red');
					setTimeout(function(){$("#err_mobile").html("&nbsp;");},3000);
					$("#mobile").focus();
					return false;
				}*/
				if(returndata.data=='email') {
					$('#err_email').fadeIn().html('This email already exists').css('color','red');
					setTimeout(function(){$("#err_email").html("&nbsp;");},3000);
					$("#email").focus();
					$("#rSignUp").text("Sign Up");
					return false;
				}
			}
			if(returndata.result==2) {
				$('#err-messages').show();
				setTimeout(function () {
                 	$('#register-messages').hide();
             	}, 20000);
				$("#rSignUp").text("Sign Up");
			}
		}
	});
}

function checkPass() {
	var x = document.getElementById("password");
  	if (x.type === "password") {
    	x.type = "text";
  	} else {
    	x.type = "password";
  	}
}

function checkConfPass() {
	var x = document.getElementById("conf_password");
  	if (x.type === "password") {
    	x.type = "text";
  	} else {
    	x.type = "password";
  	}
}
