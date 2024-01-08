<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>About Us</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block About_Us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-us">
                        <div class="row">
                            <div class="col-lg-7">
                                <h2><?= ucfirst($get_cms->title)?></h2>
                                <p><?= $get_cms->description?></p>
                            </div>
                            <div class="col-lg-5">
                                <img src="<?= base_url('assets/images/resource/About_Us.jpg')?>" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block About_Us_Testimonial">
        <!-- <div data-velocity="-.1" style="background: url('<?= base_url('assets/images/resource/parallax2.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color light"></div> -->
        <?php if(!empty($get_banner_middle->image) && file_exists('uploads/banner/'.$get_banner_middle->image)){?>
        <div data-velocity="-.1" style="background: url(<?=base_url('uploads/banner/'.$get_banner_middle->image); ?>) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div>
        <?php } else{?>
        <div data-velocity="-.1" style="background: url(<?=base_url(); ?>assets/images/resource/parallax2.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div>
        <?php } ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading light">
                        <h2>Reviews submitted by our vendors</h2>
                        <span>What other people thought about the service provided by Automation Engineering Services</span>
                    </div>
                    <div class="reviews-sec" id="reviews-carousel">
                    <?php if(!empty($get_employer)) {
                        foreach($get_employer as $user) { ?>
                        <div class="col-lg-6">
                            <a href="<?= base_url('employerdetail/'.base64_encode($user->userId))?>">
                                <div class="reviews">
                                    <?php if(!empty($user->profilePic) && file_exists('uploads/users/'.$user->profilePic)) { ?>
                                    <img src="<?= base_url('uploads/users/'.$user->profilePic)?>" alt="" />
                                    <?php } else { ?>
                                    <img src="<?= base_url('uploads/users/user.png')?>" alt="" />
                                    <?php } ?>
                                    <h3>
                                    <?php if(!empty($user->firstname)) { 
                                        echo ucfirst($user->firstname).' '.$user->lastname;
                                    } else { 
                                        echo ucfirst($user->companyname);
                                    } ?>
                                    <span><?= ucfirst(@$user->skills);?></span>
                                    </h3>
                                    <p><?= @$user->short_bio;?></p>
                                </div>
                            </a>
                        </div>
                        <?php } }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
