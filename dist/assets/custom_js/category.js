function create_category() {
	var admin_url=$('#admin_url').val();
	var category_name=$('#category_name').val();
	if(category_name=="") {
		$("#category_err").fadeIn().html("Please Enter Category Name").css("color","red");
		setTimeout(function(){$("#category_err").fadeOut("&nbsp;");},2000)
		$("#category_name").focus();
		return false;
	}
	var form_data= new FormData();
	var category_image=$('#category_image')[0].files[0];
	form_data.append('category_image',category_image);
	form_data.append('category_name',category_name);
	$.ajax({
		type:"post",
		url:admin_url+"Category/create_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else{
				$("#category_err").fadeIn().html("This category already exits ").css("color","red");
				setTimeout(function(){$("#category_err").fadeOut("&nbsp;");},2000)
				$("#category_name").focus();
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
		url:admin_url+'Category/get_value',
		data:{
			id:id,
		},
		success:function(returndata) {
			var obj=$.parseJSON(returndata);
			$("#edit_category_name").val(obj.category_name);
			$("#id").val(obj.id);
			$("#show_img").html(obj.image);
			$("#old_image").val(obj.old_image);
		}
	});
}

function update_category() {
	var admin_url=$('#admin_url').val();
	var category_name=$('#edit_category_name').val();
	var old_image=$("#old_image").val();
	var id=$("#id").val();
	if(category_name=="") {
		$("#edit_category_err").fadeIn().html("Please Enter Category Name").css("color","red");
		setTimeout(function(){$("#edit_category_err").fadeOut("&nbsp;");},2000)
		$("#edit_category_name").focus();
		return false;
	}
	var form_data= new FormData();
	var category_image=$('#edit_category_image')[0].files[0];
	form_data.append('category_image',category_image);
	form_data.append('category_name',category_name);
	form_data.append('old_image',old_image);
	form_data.append('id',id);
	$.ajax({
		type:"post",
		url:admin_url+"Category/update_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else {
				$("#edit_category_err").fadeIn().html("This category already exits ").css("color","red");
				setTimeout(function(){$("#edit_category_err").fadeOut("&nbsp;");},2000)
				$("#edit_category_name").focus();
				return false;
			}
		}
	});
}

function categoryDelete(obj,cid) {
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
					url:admin_url+'Category/delete',
					data:datastring,
					cache:false,
					success:function(returndata) {
						if(returndata = 1){
							location.reload();
							table.draw();
						} else if(returndata = 0){
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
