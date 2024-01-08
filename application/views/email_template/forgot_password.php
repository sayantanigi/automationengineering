<?php $settings = $this->Crud_model->get_single('setting');
//print_r($settings); die();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot-password</title>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
	<div style="width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;">
		<div style="padding: 30px 30px 15px 30px;box-sizing: border-box;">
		 	<img src="<?= base_url('uploads/logo/'.@$settings->logo)?>" style="width:100px;float: right;margin-top: 0 auto;">
			<h3 style="padding-top:40px; line-height: 30px;">Greetings from<span style="font-weight: 900;font-size: 35px;color: #1B3EA7; display: block;">Automation Engineering Services</span></h3>
			<p style="font-size:24px;">Hello User</p>
			<p style="font-size:24px;">Trouble signing in? Resetting your password is easy.</p>
			<p style="font-size:24px;">Just press the button below and follow the instructions.</p>
			<p style="text-align: center;">
				<a href="<?= base_url('new-password/'.base64_encode($email))?>" style="height: 50px; width: 300px; background: rgb(253,179,2); background: #1B3EA7; text-align: center; font-size: 18px; color: #fff; border-radius: 12px; display: inline-block; line-height: 50px; text-decoration: none; text-transform: uppercase; font-weight: 600;">CLICK HERE TO RESET</a>
			</p>
    		<p style="font-size:20px;">Thank you!</p>
			<p style="font-size:20px;list-style: none;">Sincerly</p>
    		<p style="list-style: none;"><b>Automation Engineering Services</b></p>
	    	<p style="list-style:none;"><b>Visit us:</b> <span><?= @$settings->address?></span></p>
	    	<p style="list-style:none"><b>Email us:</b> <span><?= @$settings->email?></span></p>
        </div>
        <footer style="height:25px;width:100%;background: #1B3EA7;"><span style="padding-left: 10px; width:100%; display: block; margin-bottom: 20px; text-align: center;"> Copyright &copy; <?=date('Y')?> Automation Engineering Services. All rights reserved.</span></footer>
	</div>
</body>
</html>
