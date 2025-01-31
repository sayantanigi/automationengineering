function create_subcategory() {
	var admin_url=$('#admin_url').val();
	var category_id=$('#category_id').val();
	var sub_category_name=$('#sub_category_name_id').val();
	if(category_id=="") {
		$("#category_err").fadeIn().html("Please Select Category Name").css("color","red");
		setTimeout(function(){$("#category_err").fadeOut("&nbsp;");},2000)
		$("#category_id").focus();
		return false;
	}

	if(sub_category_name=="") {
		$("#sub_category_name_id_err").fadeIn().html("Please Enter Sub Category Name").css("color","red");
		setTimeout(function(){$("#sub_category_name_id_err").fadeOut("&nbsp;");},2000)
		$("#sub_category_name_id").focus();
		return false;
	}

	var form_data= new FormData();
	var image=$('#image')[0].files[0];
	form_data.append('image',image);
	form_data.append('category_id',category_id);
	form_data.append('sub_category_name',sub_category_name);
	$.ajax({
		type:"post",
		url:admin_url+"Sub_category/create_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
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
		url:admin_url+'Sub_category/get_value',
		data:{
			id:id,
		},
		success:function(returndata) {
			var obj=$.parseJSON(returndata);
			$("#edit_sub_category_name_id").val(obj.sub_category_name);
			$("#edit_category_id").val(obj.category_id);
			$("#id").val(obj.id);
			$("#show_img").html(obj.image);
			$("#old_image").val(obj.old_image);
		}
	});
}

function update_category() {
	var admin_url=$('#admin_url').val();
	var category_id=$('#edit_category_id').val();
	var sub_category_name=$('#edit_sub_category_name_id').val();
	var old_image=$("#old_image").val();
	var id=$("#id").val();
	if(category_id=="") {
		$("#edit_category_err").fadeIn().html("Please Select Category Name").css("color","red");
		setTimeout(function(){$("#edit_category_err").fadeOut("&nbsp;");},2000)
		$("#edit_category_name").focus();
		return false;
	}

	if(sub_category_name=="") {
		$("#edit_sub_category_name_id_err").fadeIn().html("Please Enter Category Name").css("color","red");
		setTimeout(function(){$("#edit_sub_category_name_id_err").fadeOut("&nbsp;");},2000)
		$("#edit_sub_category_name_id").focus();
		return false;
	}
	var form_data= new FormData();
	var image=$('#edit_image')[0].files[0];
	form_data.append('image',image);
	form_data.append('category_id',category_id);
	form_data.append('sub_category_name',sub_category_name);
	form_data.append('old_image',old_image);
	form_data.append('id',id);
	$.ajax({
		type:"post",
		url:admin_url+"Sub_category/update_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			}
		}
	});
}

function subCategoryDelete(obj,cid) {
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
					url:admin_url+'Sub_category/delete',
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
