//select user type
$(".user-tab").on("click",function(){
	var user_type= $(this).attr('user_type');
	$("#user_type").val(user_type);
});