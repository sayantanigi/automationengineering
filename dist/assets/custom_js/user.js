function status(id) {
	var admin_url = $("#admin_url").val();
	var status=$("#status"+id).val();
	$.confirm({
	    title: 'Confirm!',
	    content: confirmChangeStatus,
	    buttons: {
	        confirm: function () {
	            $.ajax({
					type:"POST",
					url:admin_url+"users/change_status",
					data:{id:id,status:status,},
					cache:false,
					success:function(returndata) {
						table.draw();
					}
				});
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}

function email_verified(id) {
	//alert(id);
	var admin_url = $("#admin_url").val();
	var email_verified=$("#email_verified"+id).val();
	$.confirm({
	    title: 'Confirm!',
	    content: userEmailVerification,
	    buttons: {
	        confirm: function () {
				$.ajax({
					type:"POST",
					url:admin_url+"users/email_verification",
					data:{id:id,email_verified:email_verified,},
					cache:false,
					success:function(returndata) {
						table.draw();
					}
				});
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}

function Delete(obj,cid) {
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
					url:admin_url+'users/delete',
					data:datastring,
					cache:false,
					success:function(returndata) {
						table.draw();

					}
				});
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
