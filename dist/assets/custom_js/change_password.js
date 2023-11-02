function change_password()
			{
        var admin_url=$('#admin_url').val();
				var cur_password=$('#cur-password').val();
				if(cur_password=="")
		       {
				$("#err_current").fadeIn().html("Required").css('color','red');
				 setTimeout(function(){$("#err_current").html("&nbsp;");},3000);
				 $("#cur-password").focus();
				 return false;
		       }
				var new_password=$('#new-password').val();
				if(new_password=='')
             {
               $("#err_new").fadeIn().html("Required").css('color','red');;
              setTimeout(function(){$("#err_new").html("&nbsp;");},5000)
              $("#new-password").focus();
                return false;
              }
				else if(new_password.length<6)
              {
               $("#err_new").fadeIn().html("please enter at least 6 character").css('color','red');;
              setTimeout(function(){$("#err_new").html("&nbsp;");},5000)
              $("#new-password").focus();
                return false;
              }
				var confirm_password=$('#repeat_pass').val();
				if(confirm_password=='')
             {
               $("#err_repeat").fadeIn().html("Required").css('color','red');;
                setTimeout(function(){$("#err_repeat").html("&nbsp;");},5000)
                 $("#repeat_pass").focus();
                  return false;
              }
               if(new_password!=confirm_password)
              {
                $('#password_match').html('password does not match').css('color','red');
                   return null
                 }


				 $.ajax({
                 url:admin_url+'login/change_password',
                 type: 'POST',
                  data: {cur_password:cur_password,new_password:new_password,confirm_password:confirm_password},
                  success:function(data)
                   {
                   	if(data==1)
                   	{
                   		 location.reload();
                   	}
                   	else{
                   		$("#err_current").fadeIn().html("current password doest not match").css('color','red');
				 setTimeout(function(){$("#err_current").html("&nbsp;");},3000);
				 $("#cur-password").focus();
				 return false;
                   	}
                   }

                  });
				}
