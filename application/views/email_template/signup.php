<?php $settings = $this->Crud_model->get_single('setting');
//print_r($settings); die();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
	<div style="width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;">
		<div style="padding: 30px 30px 15px 30px;box-sizing: border-box;">
		 	<img src="<?= base_url('uploads/logo/'.@$settings->logo)?>" style="width:100px;float: right;margin-top: 0 auto;">
			<h3 style="padding-top:40px; line-height: 30px;">Greetings from<span style="font-weight: 900;font-size: 20px;color: #1B3EA7; display: block;">Automation Engineering Services</span></h3>
			<p style="font-size:15px;">Hello <?php echo $fullname?>,</p>
			<p style="font-size:15px;">Thank you for registration on Automation Engineering Services.</p>
			<p style="font-size:15px;">Please click the button below to verify your email address.</p>
			<p style="text-align: center;">
				<a class="post-job-btn" href="<?= $activationURL?>" style="height: 40px;width: 170px;background: rgb(253,179,2);background: #1B3EA7;text-align: center;font-size: 15px;color: #fff;border-radius: 12px;display: inline-block;line-height: 40px;text-decoration: none;text-transform: uppercase;font-weight: 600">ACTIVATE</a>
			</p>
    		<p style="font-size: 15px; margin: 10px 0 0 0;">Thank you!</p>
    		<p style="font-size: 15px; list-style: none; margin: 0; padding: 0;">Sincerly,</p>
    		<p style="list-style: none; margin: 0; padding: 0; font-size: 15px;"><b>Automation Engineering Services</b></p>
	    	<p style="margin: 20px 0 0 0; list-style: none"><b>Visit us:</b> <span><?= @$settings->address?></span></p>
	    	<p style="list-style: none; margin: 0; padding: 0;"><b>Email us:</b> <span><?= @$settings->email?></span></p>
        </div>
        <footer style="height:25px;width:100%;background: #1B3EA7;"><span style="width: 100%;display: block;margin-bottom: 0px;text-align: center;background: #1B3EA7;color: #fff;padding: 15px 0 15px 0;"> Copyright &copy; <?=date('Y')?> Automation Engineering Services. All rights reserved.</span></footer>
	</div>
</body>
</html>
