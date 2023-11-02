<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?= $heading?></h3>
				</div>
				<div class="col-auto text-right">
					<a href="<?= admin_url('subscription/create')?>" class="btn btn-primary add-button">
						<i class="fas fa-plus"></i>
					</a>
				</div>
			</div>
		</div>

		<div class="row pricing-box">
			<?php foreach ($offersdata as $key) { ?>
			<div class="col-md-6 col-lg-4 col-xl-3">
				<div class="card" style="height:400px;">
					<div class="card-body">
						<div class="pricing-header">
							<p style="text-align: center;"><?php echo "For ".ucwords($key->subscription_user_type) ?></p>
							<p style="text-align: center;"><?php echo "Country: ".ucwords($key->subscription_country) ?></p>
							<h2 style="text-align: center; margin-bottom: 12px;"><?php echo @$key->subscription_name; ?></h2>
							<?php if(@$key->subscription_type=='free') { ?>
								<p style="text-align: center;"><?php echo ucfirst(@$key->subscription_type)?> Subscription </p>
							<?php } else { ?>
							<p style="text-align: center;">
								<?php if ($key->subscription_country == 'Nigeria') {
									$currency = '₦';
								} else {
									$currency = '$';
								}?>
								<?php echo ucfirst(@$key->subscription_type)?> Subscription (<?php echo $currency; ?> <b><?php echo $key->subscription_amount?></b>)</p>
							<?php } ?>
						</div>
						<div class="pricing-card-price" style="text-align: center;">
							<!-- <h3 class="heading2 price"><?php //echo 'USD'.' '.$key->subscription_amount; ?></h3> -->
							<p>Duration: <span><?php echo $key->subscription_duration." days"; ?> </span></p>
						</div>
						<div class="pricing-options" style="text-align: center;">
							<?php echo $key->subscription_description;?>
						</div>
						<!-- <ul class="pricing-options">
						<?php //$suboffer=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$key->id."'");
						//foreach ($suboffer as $row) { ?>
							<li><i class="far fa-check-circle"></i><?php //echo $row->service;?></li>
						<?php //} ?>
						</ul> -->
						<a href="<?= admin_url('subscription/update/'.base64_encode($key->id))  ?>" class="btn btn-primary btn-block">Edit</a>
						<a href="javascript:void(0);" class="btn btn-sm btn-danger mr-2" onclick="subscriptionDelete(this,<?php echo $key->id?>)" style="margin-top: 10px; width: 100%; padding: 7px;">Delete</a>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</div>
</div>
<style>
.pricing-box .pricing-header {
    margin-bottom: 0 !important;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js" integrity="sha512-/bOVV1DV1AQXcypckRwsR9ThoCj7FqTV2/0Bm79bL3YSyLkVideFLE3MIZkq1u5t28ke1c0n31WYCOrO01dsUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$('.card').matchHeight();
$('.card ul').matchHeight();
function subscriptionDelete(obj,cid) {
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
					url:admin_url+'Subscription/delete',
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

</script>
