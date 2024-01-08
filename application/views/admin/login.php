<?php
$get_setting=$this->Crud_model->get_single('setting');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Automation Engineering Services</title>
    <link rel="shortcut icon" href="<?=base_url(); ?>uploads/logo/<?= $get_setting->favicon?>">
    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>dist/assets/css/admin.css">
</head>
<body>
<div class="main-wrapper">
    <div class="login-page">
        <div class="login-body container">
            <div class="loginbox">
                <div class="login-right-wrap">
                    <div class="account-header">
                        <div class="account-logo text-center mb-4">
                            <a href="<?=base_url()?>">
                                <img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" class="img-fluid"/>
                            </a>
                        </div>
                    </div>
                    <div class="login-header" style="text-align: center;">
                        <h3>Login <span><?= $get_setting->website_name;?></span></h3>
                        <p class="text-muted">Access the Admin Dashboard</p>
                    </div>
                    <span class="msghide">
                    <?php if($this->session->flashdata('error')) {
                        echo $this->session->flashdata('error');
                        unset($_SESSION['error']);
                    } ?>
                    </span>
                    <form class="pt-3" method="post" action="<?=admin_url(); ?>Login/actionLogin" onsubmit="return validation()">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="email_id" name="email_id" placeholder="Email Address">
                            <span class="error" id="error_email"><?php echo form_error('email_id'); ?></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                            <span class="error" id="error_password"><?php echo form_error('password'); ?></span>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                        </div>
                        <!--  <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" class="form-check-input">
                                    Keep me signed in
                                </label>
                            </div>
                            <a href="#" class="auth-link text-black">Forgot password?</a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url(); ?>dist/assets/js/jquery-3.5.0.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/js/popper.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/js/admin.js"></script>
<script type="text/javascript">
function validation(){
    var email = $("#email_id").val().trim();
    var password = $("#password").val().trim();
    if(email =='') {
        $("#error_email").fadeIn().html("Please enter email or usernamme").css("color","red");
        setTimeout(function(){$("#error_email").fadeOut("&nbsp;");},2000)
        $("#email_id").focus();
        return false;
    }

    if(password =='') {
        $("#error_password").fadeIn().html("Please enter password").css("color","red");
        setTimeout(function(){$("#error_password").fadeOut("&nbsp;");},2000)
        $("#password").focus();
        return false;
    }
}
</script>
</body>
</html>
