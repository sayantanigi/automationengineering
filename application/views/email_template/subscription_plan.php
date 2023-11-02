<?php $settings=$this->Crud_model->get_single('setting'); ?>
<!DOCTYPE html>
<html>
<head>
	   <title>Subscription Plan</title>
	   <meta charset="utf-8">
	  <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
	<div style="width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;">

		<div style="padding: 30px 30px 15px 30px;box-sizing: border-box;">

			<img src="<?=base_url('assets/images/gig-work01.jpg')?>" style="width:100px;float: right;margin-top: 0 auto;">
			<h3 style="padding-top:40px; line-height: 30px;">Greeting from<span style="font-weight: 900;font-size: 35px;color: #1B3EA7; display: block;">GreatGigz</span></h3>
			<p style="font-size:24px;">Hello <?php if(!empty($name)){ echo ucfirst($name); } ?></p>
			<p style="font-size:24px;">Add Your Subscription plan Successfully.</p>
		
    	<p style="font-size:20px;">Thank you!</p>
    	<li style="font-size:20px;list-style: none;">Sincerly</li>
    	<li style="list-style: none;"><b>Team GreatGigz</b></li>

    <!--	<ul style="list-style: none;padding: 0;box-sizing: border-box; margin: 4px 0;">-->


    <!--		<li style="vertical-align: top;display: inline-block;"><b style="font-size:10px;margin-bottom: 10px;">Download the App on</b></li>-->
    <!--			<li style="display: inline-block;"><a href="https://play.google.com/store/apps/details?id=com.utalii.utaliiworld&hl=en"><img src="<?= base_url('uploads/logos/playstore.png')?>" height="35px"></a></li>-->
    <!--				<li style="display: inline-block;"><a href="#"><img src="<?=base_url('uploads/logos/appstore.png')?>" style="height:35px;"></a></li>-->
    <!--</ul>-->
    	<li style="list-style:none;"><b>visit us:</b> <span><?=@$settings->address?></span></li>
    	<li style="list-style:none;"><b>call us:</b> <span><?=@$settings->phone?></span></li>
    	<li style="list-style:none"><b>Email us:</b> <span><?=@$settings->email?></span></li>
    	<!--<p>Click here to <a href="< ?= base_url('unsubscribe/'.$email)?>">unsubscribe </a> from our mailling list.</p>-->

		</div>
           <footer style="height:25px;width:100%;background: #1B3EA7;"><span style="padding-left: 10px;"> copyright &copy; <?=date('Y')?> GreatGigz All right reserverd</span></footer>
	</div>
</body>
</html>
