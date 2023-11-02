function create_service() {
	var admin_url=$('#admin_url').val();
	var category_id=$('#category_id').val();
	//var icon=$('#icon').val();
	var service_image=$('#service_image')[0].files[0];
	//var description=$('#description').val();
	var description=CKEDITOR.instances['description'].getData();
	if(category_id=="") {
		$("#category_err").fadeIn().html("Required").css("color","red");
		setTimeout(function(){$("#category_err").fadeOut("&nbsp;");},2000)
		$("#category_id").focus();
		return false;
	}

	if(description=="") {
		$("#description_err").fadeIn().html("Required").css('color','red');
		setTimeout(function(){$("#description_err").html("&nbsp;");},3000);
		$("#description").focus();
		return false;
	}

	var form_data= new FormData();

	form_data.append('category_id',category_id);
	//form_data.append('icon',icon);
	form_data.append('service_image',service_image);
	form_data.append('description',description);
	$.ajax({
		type:"post",
		url:admin_url+"manage_home/our_services/create_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			//console.log(returndata);
			if(returndata==1) {
				var category_id=$('#category_id').val('');
				var icon=$('#icon').val('');
				var description=$('#description').val('');
				location.reload();
			} else {
				$("#category_err").fadeIn().html("This category already exits").css("color","red");
				setTimeout(function(){$("#category_err").fadeOut("&nbsp;");},2000)
				$("#category_id").focus();
				return false;
			}
		}
	});
}


function getValue(id) {
	var admin_url = $("#admin_url").val();
	$.ajax({
		type:'post',
		cache:false,
		url:admin_url+'manage_home/our_services/get_value',
		data:{
			id:id,
		},
		success:function(returndata) {
			var obj=$.parseJSON(returndata);
			//console.log(obj);
			$("#edit_category_id").val(obj.category_id);
			$("#id").val(obj.id);
			$("#show_img").html(obj.icon);
			$("#old_image").val(obj.old_image);
			CKEDITOR.instances.edit_description.setData(obj.description);

		}
	})
}

function update_service() {
	var admin_url = $("#admin_url").val();
	var category_id=$("#edit_category_id").val().trim();
	var service_image=$('#edit_service_image')[0].files[0];
	//var description=$("#edit_description").val().trim();
	var old_image=$("#old_image").val();
	var description=CKEDITOR.instances['edit_description'].getData();
	var id=$("#id").val();
	var icon=$("#edit_icon").val();
	if(category_id=="") {
		$("#edit_category_err").fadeIn().html("Required").css('color','red');
		setTimeout(function(){$("#edit_category_err").html("&nbsp;");},3000);
		$("#edit_category_id").focus();
		return false;
	}

	if(description=="") {
		$("#edit_description_err").fadeIn().html("required").css('color','red');
		setTimeout(function(){$("#edit_description_err").html("&nbsp;");},3000);
		$("#edit_description").focus();
		return false;
	}
	var form_data= new FormData();
	form_data.append('category_id',category_id);
	form_data.append('service_image',service_image);
	form_data.append('old_image',old_image);
	form_data.append('description',description);
	//form_data.append('icon',icon);

	form_data.append('id',id);
	$.ajax({
		type:'post',
		cache:false,
		contentType: false,
		processData:false,
		url:admin_url+'manage_home/our_services/update_action',
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else {
				$("#edit_category_err").fadeIn().html("This category already exits").css('color','red');
				setTimeout(function(){$("#edit_category_err").html("&nbsp;");},3000);
				$("#edit_category_id").focus();
				return false;
			}
		}
	})
}



function ourServicesDelete(obj,cid) {
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
					url:admin_url+'manage_home/our_services/delete',
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
