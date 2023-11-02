function create_rating(){
	var admin_url=$('#admin_url').val();
	var rating_type=$('#rating_type').val();
  if(rating_type=="") {
  	$("#rating_type_err").fadeIn().html("Please Enter Rating Type").css("color","red");
    setTimeout(function(){$("#rating_type_err").fadeOut("&nbsp;");},2000)
    $("#rating_type").focus();
    return false;
  } 
 	var form_data= new FormData();    
  form_data.append('rating_type',rating_type);
	$.ajax({
  	type:"post",
    url:admin_url+"Rating_type/create_action",
    cache:false,
    contentType: false,   
    processData:false,
    async:false,
    data:form_data,
    success:function(returndata) {
	    if(returndata==1) {
	      location.reload();
	    } else {
	   		$("#rating_type_err").fadeIn().html("This Rating Type already exits ").css("color","red");
	      setTimeout(function(){$("#rating_type_err").fadeOut("&nbsp;");},2000)
	      $("#rating_type").focus();
	      return false;
	    }
	  }
	});
}

function status(id) {
	var admin_url = $("#admin_url").val();
  var cnf = confirm('Are you sure to change the status?');
  var status=$("#status"+id).val();
  if(cnf==true) {
	 	$.ajax({
      type:"POST",
      url:admin_url+"post_job/change_status",
      data:{id:id,status:status,},
      cache:false,
      success:function(returndata) {
      	table.draw();
      }
    });
  }
}

function getValue(id)
{
	 var admin_url = $("#admin_url").val();
    
        $.ajax({
	        type:'post',
	        cache:false,

	        url:admin_url+'Rating_type/get_value',
	        data:{
	          id:id,
	        },
	        success:function(returndata)
	        {

		        var obj=$.parseJSON(returndata);

		        $("#edit_rating_type").val(obj.rating_type);
		        $("#id").val(obj.id);
	        }
      });

}

function update_rating()
{
	var admin_url=$('#admin_url').val();
	var rating_type=$('#edit_rating_type').val();
	 
   var id=$("#id").val();
    if(rating_type=="")
    {
      	$("#edit_rating_type_err").fadeIn().html("Please Enter Rating Type").css("color","red");
          setTimeout(function(){$("#edit_rating_type_err").fadeOut("&nbsp;");},2000)
    
        $("#edit_rating_type").focus();
        return false;
    } 
         var form_data= new FormData();
    	
	      form_data.append('rating_type',rating_type);
	      
	      	form_data.append('id',id);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"Rating_type/update_action",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {

	          location.reload();
	         
	        }
	        else{
	         $("#edit_rating_type_err").fadeIn().html("This Rating Type already exits ").css("color","red");
          setTimeout(function(){$("#edit_rating_type_err").fadeOut("&nbsp;");},2000)
            $("#edit_rating_type").focus();
                  return false;
	        }

	          
	        }
	    });

}

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
		      url:admin_url+"Rating_type/change_status",
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