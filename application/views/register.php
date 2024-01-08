<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)) {
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<style>
#register-messages {text-align: center; margin-top: 25px; display: none;}
#err-messages {text-align: center; margin-top: 10px; display: none;}
</style>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Register</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max_height">
    <div class="block remove-bottom Sign_Up">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-10">
                    <div class="account-popup-area signup-popup-box static">
                        <div class="account-popup">
                            <div class="row m-0">
                                <div class="col-lg-4 col-md-12 col-sm-12 SignUp_Left">
                                    <h3>Sign Up</h3>
                                    <span>Let's create your account! Choose to sign up as either an Expert or a Business.</span>
                                    <div class="select-user">
                                        <span class="user-tab active" user_type="1" onclick="get_value(1)">Expert</span>
                                        <span class="user-tab" user_type="2" onclick="get_value(2)">Business</span>
                                    </div>
                                    <div class="error" id="err_usertype"></div>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12 SignUp_Right">
                                    <div id="register-messages" class="text-success-msg f-20">
                                        <h4>Successful Registration</h4>
                                        <p style="color: #28a745;">We have sent an activation link to your account to continue with the registration process.</p>
                                    </div>
                                    <div id="err-messages">
                                        <h4 style="color: red;">Error</h4>
                                        <p style="color: red;">Oops, somthing went wrong. Please try again later.</p>
                                    </div>
                                    <form id="signUp_form" action="#" method="post">
                                        <div class="row m-0">
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">Full Name</label>
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="Full Name" name="username" id="username" onkeypress="only_alphabets(event)" />
                                                        <i class="la la-user"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_username"></div>
                                            </div> -->
                                            <div class="col-lg-6 col-md-6 col-sm-6 first_name">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">First Name <span style="color:red">*</span></label>
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="First Name" name="first_name" id="first_name" onkeypress="only_alphabets(event)"/>
                                                        <i class="la la-user"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_firstname"></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 last_name">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">Last Name <span style="color:red">*</span></label>
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="Last Name" name="last_name" id="last_name" onkeypress="only_alphabets(event)"/>
                                                        <i class="la la-user"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_lastname"></div>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-6 company_name">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">Company Name <span style="color:red">*</span></label>
                                                    <div class="cfield_Input">
                                                        <!-- <input type="text" placeholder="Company Name" name="company_name" id="company_name" onkeypress="only_specialAlphabets(event)" /> -->
                                                        <input type="text" placeholder="Company Name" name="company_name" id="company_name"/>
                                                        <i class="la la-home"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_companyname"></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 email">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">Email Address <span style="color:red">*</span></label>
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="Email Address" name="email" id="email" />
                                                        <i class="la la-envelope-o"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_email"></div>
                                            </div>
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 mobile">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">Phone Number</label>
                                                    <div class="cfield_Input">
                                                        <input type="text" placeholder="Phone Number" name="mobile" maxlength="10" id="mobile" onkeypress="only_number(event)" />
                                                        <i class="la la-phone"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_mobile"></div>
                                            </div> -->
                                            <div class="col-lg-6 col-md-6 col-sm-6 addrss">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">Legal Address <span style="color:red;">*</span></label>
                                                    <div class="cfield_Input">
                                                        <input type="text" class="form-control" name="address" id="location" placeholder="Legal Address" autocomplete="off" required/>
                                                        <input type="hidden" name="latitude" id="search_lat" value="">
                                                        <input type="hidden" name="longitude" id="search_lon" value="">
                                                        <i class="la la-address-card"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_address"></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 pass">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">Password <span style="color:red">*</span></label>
                                                    <div class="cfield_Input">
                                                        <input type="password" placeholder="********" name="password" id="password" />
                                                        <i class="la la-key" onclick="checkPass()"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_password"></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 c_pass">
                                                <div class="cfield cfield_top">
                                                    <label for="" class="form-label">Confirm Password <span style="color:red">*</span></label>
                                                    <div class="cfield_Input">
                                                        <input type="password" placeholder="********" name="conf_password" id="conf_password" />
                                                        <i class="la la-key" onclick="checkConfPass()"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_confpassword"></div>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-6" id="err_check_pass" style="tex-align:center;"></div>
                                            <!-- <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="cfield">
                                                    <label for="" class="form-label">Select Option</label>
                                                    <div class="cfield_Input">
                                                        <div class="dropdown-field">
                                                            <select name="service" class="chosen" id="service" multiple>
                                                                <option value="">Please Select Specialization</option>
                                                                <?php if(!empty($get_category)){
                                                                foreach ($get_category as $key) {?>
                                                                <option value="<?= $key->id?>"><?= $key->category_name?></option>
                                                                <?php  } } ?>
                                                            </select>
                                                        </div>
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                </div>
                                                <div class="error text-left" id="err_service"></div>
                                            </div> -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 SignUp_Btn">
                                                <input type="hidden" name="user_type" id="user_type">
                                                <button type="button" class="btn btn-info" id="rSignUp" onclick="return btn_register();">Sign up</button>
                                                <!-- <button type="button" class="btn btn-info" id="please_wait" onclick="return">Please Wait...</button> -->
                                                <!-- <img src="<?php echo base_url()?>uploads/loading.gif" id="loader"> -->
                                            </div>
                                            <!-- <div class="col-lg-12 col-md-12 col-sm-12 d-none">
                                                <div class="extra-login">
                                                    <span>OR</span>
                                                    <div class="login-social">
                                                        <a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
                                                        <a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
#loader {display: none; width: 40px;}
.company_name {display: none}
</style>
<script src="<?= base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#user_type').val(1);
})
    function get_value(id) {
        $('#user_type').val(id);
        if(id == 1){
            $('.company_name').hide();
            $('.first_name').show();
            $('.last_name').show();
            $('.email').show();
            $('.pass').show();
            $('.c_pass').show();
            $('.addrss').show();
        } else {
            $('.company_name').show();
            $('.first_name').hide();
            $('.last_name').hide();
            $('.email').show();
            $('.pass').show();
            $('.c_pass').show();
            $('.addrss').show();
        }
    }
</script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/register.js')?>"></script>
