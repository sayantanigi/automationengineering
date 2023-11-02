<?php 
 if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
     $banner_img=base_url("uploads/banner/".$get_banner->image);
            } else{
       $banner_img=base_url("assets/images/resource/mslider1.jpg");
        } ?>

<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3><?= ucfirst($get_cms->title)?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max_height">
    <div class="block Term_Nd_Con">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="terms-conditions">
                        <div class="terms">
                            <?= $get_cms->description?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>