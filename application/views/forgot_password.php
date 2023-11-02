
 <section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= base_url("assets/images/resource/mslider1.jpg")?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Forgot Password</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="max_height">
    <div class="block remove-bottom forgot-pass">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signin-popup-box static">
                        <div class="account-popup">
                            <h3>Forgot Password</h3>
                            <span class="text-success-msg f-20" style="text-align: center;">
                            <?php if($this->session->flashdata('message')) {
                                echo $this->session->flashdata('message');
                                unset($_SESSION['message']);
                            } ?>
                            </span>
                            <form action="<?= base_url('user/login/send_forget_password')?>" method="post">
                                <div class="error text-left">Registered Email Address</div>
                                <div class="cfield">
                                    <input type="email" placeholder="Registered Email Address" name="email" id="forget_email" required/>
                                    <i class="la la-user"></i>
                                </div>
                                <button type="submit" class="frgt_pass">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
