<?php
$get_setting=$this->Crud_model->get_single('setting');
$get_category=$this->Crud_model->GetData('category','',"status='Active'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $get_setting->website_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="<?=base_url(); ?>uploads/logo/<?= $get_setting->favicon?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>assets/css/icons.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>assets/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/chosen.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/colors/colors.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="<?=base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/rating_css.css" />
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <meta property="og:title" content="Join the best company in the world!" />
    <meta property="og:url" content="http://www.sharethis.com" />
    <meta property="og:image" content="http://sharethis.com/images/logo.jpg" />
    <meta property="og:description" content="ShareThis is its people. It's imperative that we hire smart,innovative people who can work intelligently as we continue to disrupt the very category we created. Come join us!" />
    <meta property="og:site_name" content="ShareThis" />
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=6163c52d38f8310012c86621&product=inline-share-buttons' async='async'></script>
    <style>
    .completeSub {display: none; text-align: center; margin-top: 20px; color: #1B3EA7; font-size: 20px;}
    #completeSub {
  position: relative;
  display: inline-block;
}

#completeSub #completeSubtext {
  visibility: hidden;
      width: max-content;
    background-color: white;
    color: #000;
    text-align: center;
    border-radius: 6px;
    padding: 5px 10px;
    position: absolute;
    z-index: 1;
    top: 50px;
    font-size: 13px;
    right: 0;
}

#completeSub:hover #completeSubtext {
  visibility: visible;
}
    </style>
<script>
function completeSub() {
    $('.completeSub').show();
    setTimeout(function(){
        $('.completeSub').fadeOut('slow');
    },4000);
}
$(function () {
    $('#completeSub').mouseover(function(){
        $("#completeSub").css("background-color", "yellow");
    });
})
</script>
</head>
<body>
    <div class="page-loading">
        <img src="<?=base_url(); ?>assets/images/loader.gif" alt="" />
    </div>
    <div class="theme-layout" id="scrollup">
        <div class="responsive-header">
            <div class="responsive-menubar">
                <div class="res-logo">
                    <a href="<?=base_url(); ?>" title=""><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" /></a>
                </div>
                <div class="menu-resaction">
                    <!-- <div class="res-openmenu"><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" /> Menu</div>
                    <div class="res-closemenu"><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" /> Close</div> -->
                    <div class="res-openmenu">Menu</div>
                    <div class="res-closemenu">Close</div>
                </div>
            </div>
            <div class="responsive-opensec">
                <div class="btn-extars">
                <?php if(!empty($_SESSION['automation']['userId'])){?>
                    <a href="<?= base_url('postjob')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
                <?php } else{?>
                    <a href="<?= base_url('login')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
                <?php } ?>
                    <ul class="account-btns">
                        <?php if(!empty($_SESSION['automation']['userId'])){?>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>dashboard"><i class="la la-key"></i> My Account</a>
                            </li>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>logout"><i class="la la-external-link-square"></i> Logout</a>
                            </li>
                        <?php } else {?>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>/register" title=""><i class="la la-key"></i> Sign Up</a>
                            </li>
                            <li class="signin-popup">
                                <a href="<?= base_url('login')?>" title=""><i class="la la-external-link-square"></i> Login</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <form class="res-search">
                    <input type="text" placeholder="Job title, keywords or company name" />
                    <button type="submit"><i class="la la-search"></i></button>
                </form>
                <div class="responsivemenu">
                    <ul>
                        <li class="menu-item-has-children">
                            <a href="#" title="">Our Services</a>
                            <ul>
                            <?php if(!empty($get_category)){
                            foreach ($get_category as $row ) {
                            $get_subcategory=$this->Crud_model->GetData('sub_category','',"category_id='".$row->id."'"); ?>
                                <li class="menu-item-has-children">
                                    <a href="#" title=""><?= ucfirst($row->category_name)?></a>
                                    <ul>
                                    <?php if(!empty($get_subcategory)){
                                    foreach ($get_subcategory as $key) { ?>
                                        <li><a href="<?= base_url('employees_list/'.base64_encode($key->id))?>"><?= ucfirst($key->sub_category_name)?></a></li>
                                    <?php } } ?>
                                    </ul>
                                </li>
                            <?php } } ?>
                            </ul>
                        </li>
                        <li class="account-btns">
                            <a href="<?= base_url('ourjobs')?>" title="">Our Jobs</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="<?= base_url('employer-list')?>" title="">Become a Automation Engineering Services Partner</a>
                            <ul>
                                <li><a href="#" title="">For Employer</a></li>
                                <li><a href="<?= base_url('workers-list')?>" title="">For Automation Engineering Services Experts</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
