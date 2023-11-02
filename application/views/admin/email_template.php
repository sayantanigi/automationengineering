

<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row">
            <div class="col-12">
               <h3 class="page-title"><?= $heading?></h3>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-xl-3 col-lg-4 col-md-4 settings-tab">
            <div class="card">
               <div class="card-body">
                  <div class="nav flex-column">
                  	<?php if(!empty($get_email)){ foreach($get_email as $item){?>
                     <a class="nav-link" data-toggle="tab" href="#<?= $item->id?>" onclick="return get_data('<?= $item->id ?>')">
                     	<?= ucfirst($item->title)?></a>
                      <input type="hidden" id="emailtemplate_id" value="<?= $item->id?>">
                     <?php } } ?>
                    <!--  <a class="nav-link" data-toggle="tab" href="#push_notification">Push Notification</a>
                     <a class="nav-link" data-toggle="tab" href="#terms">Terms & Conditions</a>
                     <a class="nav-link mb-0" data-toggle="tab" href="#privacy">Privacy</a> -->
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-9 col-lg-8 col-md-8">
            <div class="card">
               <div class="card-body p-0">

                  <form method="post" action="#">
                    <div class="alert alert-success" id="success_msg" style="display:none;">Email template updated successfully !</div>
                     <div class="tab-content pt-0" >
                       <div class="card mb-0">
                              <div class="card-header">
                                 <h4 class="card-title" id="email_title"><?= ucfirst(@$get_email[0]->title)?></h4>
                              </div>
                              <div class="card-body">
                                 <div class="form-group">
                                    <label>Page Content</label>
                                    <textarea class="form-control" name="description" id="description"><?= @$get_email[0]->description ?></textarea>
                                 </div>
                                  <!-- <div class="form-group">
                                    <label>Signature</label>
                                     <input type="text" name="signature" id="signature" value="<?= @$get_email[0]->signature ?>" class="form-control">
                                 </div> -->
                              </div>
                             <input type="hidden" name="emailid" id="emailid" value="<?= @$get_email[0]->id ?>">
                           </div>
                           <div class="card-body pt-0">
                           <button type="button" class="btn btn-primary" onclick="return update_email()">Save Changes</button>
                        </div>
                        <!--  <div id="terms" class="tab-pane" >

                        </div>  -->


                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

 <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 <script>
       CKEDITOR.replace('description');

    </script>

 <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
 <script type="text/javascript">
 	function get_data(email_id)
 	{
 		var displayProduct = 2;
		 $('#emaildata').html(createSkeleton(displayProduct));
		  function createSkeleton(limit){
  var skeletonHTML = '';
  for(var i = 0; i < limit; i++){
	skeletonHTML += '<div class="ph-item">';
	skeletonHTML += '<div class="ph-col-4">';
	skeletonHTML += '<div class="ph-picture"></div>';
	skeletonHTML += '</div>';
	skeletonHTML += '<div>';
	skeletonHTML += '<div class="ph-row">';
	skeletonHTML += '<div class="ph-col-12 big"></div>';
	skeletonHTML += '<div class="ph-col-12"></div>';
	skeletonHTML += '<div class="ph-col-12"></div>';
	skeletonHTML += '<div class="ph-col-12"></div>';
	skeletonHTML += '<div class="ph-col-12"></div>';
	skeletonHTML += '</div>';
	skeletonHTML += '</div>';
	skeletonHTML += '</div>';
  }
  return skeletonHTML;
}
		$.ajax({
			url: "<?= admin_url('email_template/get_emaildata')?>",
			type: 'POST',
			data: {email_id:email_id},

			success: function(result)
			{
        var obj=$.parseJSON(result);
			 $('#email_title').html(obj.title);
       $('#emailid').val(obj.id);
       $('#signature').val(obj.signature);
        CKEDITOR.instances.description.setData(obj.description);
			}
		});
 	}

 function update_email()
  {
    var email_id=$('#emailid').val();
    var signature=$('#signature').val();

    var description=CKEDITOR.instances['description'].getData();
    $.ajax({
      url:"<?= admin_url('email_template/update_action')?>",
      type: 'POST',
      data: {description:description,email_id:email_id,signature:signature},
      success:function(returndata)
      {
        if(returndata==1)
        {
          $('#success_msg').show();
          setTimeout(function(){$("#success_msg").hide();},3000);
        }
      }
  });
  }

 </script>
