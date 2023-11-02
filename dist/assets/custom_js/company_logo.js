function create_logo() {
	var admin_url=$('#admin_url').val();
	var name=$('#name').val();
	var logo=$('#logo').val();

	if(name=="") {
		$("#name_err").fadeIn().html("Required").css("color","red");
		setTimeout(function(){$("#name_err").fadeOut("&nbsp;");},2000)
		$("#name").focus();
		return false;
	}

	if(logo=="") {
		$("#logo_err").fadeIn().html("Required").css("color","red");
		setTimeout(function(){$("#logo_err").fadeOut("&nbsp;");},2000)
		$("#logo").focus();
		return false;
	}
	var form_data= new FormData();
	var logo=$('#logo')[0].files[0];
	form_data.append('logo',logo);
	form_data.append('name',name);
	$.ajax({
		type:"post",
		url:admin_url+"manage_home/Company_logo/create_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				$('#name').val('');
				$('#logo').val('');
				location.reload();
			}
		}
	});
}


function getValue(id) {
	var admin_url = $("#admin_url").val();
	$.ajax({
		type:'post',
		cache:false,
		url:admin_url+'manage_home/Company_logo/get_value',
		data:{
			id:id,
		},
		success:function(returndata) {
			var obj=$.parseJSON(returndata);
			$("#edit_name").val(obj.name);
			$("#id").val(obj.id);
			$("#show_img").html(obj.image);
			$("#old_image").val(obj.old_image);
		}
	});
}

function update_logo() {
	var admin_url=$('#admin_url').val();
	var name=$('#edit_name').val();
	var old_image=$("#old_image").val();
	var id=$("#id").val();
	if(name=="") {
		$("#edit_name_err").fadeIn().html("Reuired").css("color","red");
		setTimeout(function(){$("#edit_name_err").fadeOut("&nbsp;");},2000)
		$("#edit_name").focus();
		return false;
	}
	var form_data= new FormData();
	var logo=$('#edit_logo')[0].files[0];
	form_data.append('logo',logo);
	form_data.append('name',name);
	form_data.append('old_image',old_image);
	form_data.append('id',id);
	$.ajax({
		type:"post",
		url:admin_url+"manage_home/Company_logo/update_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				$('#edit_name').val('');
				$('#edit_logo').val('');
				location.reload();
			}
		}
	});
}

function companyLogoDelete(obj,cid) {
	var admin_url=$('#admin_url').val();
	$.confirm({
	    title: 'Confirm!',
	    content: confirmTextDelete,
	    buttons: {
	        confirm: function () {
				$(".id"+cid).fadeOut();
				var datastring="cid="+cid;
				$.ajax({
					type:"POST",
					url:admin_url+'manage_home/Company_logo/delete',
					data:datastring,
					cache:false,
					success:function(returndata) {
						if(returndata = 1) {
							location.reload();
							table.draw();
						}
					}
				});
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
