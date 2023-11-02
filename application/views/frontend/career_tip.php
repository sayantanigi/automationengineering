<?php 
 if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
     $banner_img=base_url("uploads/banner/".$get_banner->image);
            } else{
       $banner_img=base_url("assets/images/resource/mslider1.jpg");
        } ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1"
            style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3><?= ucfirst(@$get_career->title)?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="max_height">
    <div class="block Career_Tips">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 column">
                    <div class="blog-single">
                        <h2><?= ucfirst(@$get_career->title)?></h2>
                        <p>
                            <?= ucfirst($get_career->description)?>
                        </p>



                        <!--  <div class="commentform-sec">

                        <h3>Leave a Reply</h3>

                        <form>

                            <div class="row">

                                <div class="col-lg-6">

                                    <span class="pf-title">Full Name</span>

                                    <div class="pf-field">

                                        <input type="text" placeholder="ALi TUFAN" />

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <span class="pf-title">Email</span>

                                    <div class="pf-field">

                                        <input type="text" placeholder="" />

                                    </div>

                                </div>

                                <div class="col-lg-12">

                                    <span class="pf-title">Phone</span>

                                    <div class="pf-field">

                                        <input type="text" placeholder="" />

                                    </div>

                                </div>

                                <div class="col-lg-12">

                                    <span class="pf-title">Description</span>

                                    <div class="pf-field">

                                        <textarea></textarea>

                                    </div>

                                </div>

                                <div class="col-lg-12">

                                    <button type="submit">Post Comment</button>

                                </div>

                            </div>

                        </form>

                    </div> -->
                    </div>
                </div>
                <div class="col-lg-5 column">
                    <div class="bs-thumb">
                        <?php if(!empty($get_career->image) && file_exists('uploads/career/'.$get_career->image)){?>
                        <img src="<?= base_url('uploads/career/'.$get_career->image)?>" alt="" />
                        <?php } else{ ?>
                        <img src="<?= base_url('uploads/no_image.png')?>" alt="" />
                        <?php } ?>
                    </div>
                </div>

                <!--    <aside class="col-lg-4 column">

                <div class="widget">

                    <div class="search_widget_job no-margin">

                        <div class="field_w_search">

                            <input placeholder="Search Keywords" type="text" />

                            <i class="la la-search"></i>

                        </div>

                       

                    </div>

                </div>

                <div class="widget">

                    <h3>Categories</h3>

                    <div class="sidebar-links">

                        <a href="#" title=""><i class="la la-angle-right"></i>Remote Computer Repair</a>

                        <a href="#" title=""><i class="la la-angle-right"></i>Website Design</a>

                        <a href="#" title=""><i class="la la-angle-right"></i>Graphic Design</a>

                        <a href="#" title=""><i class="la la-angle-right"></i>Marketing Campaigns</a>

                        <a href="#" title=""><i class="la la-angle-right"></i>Virtual Office Work</a>

                    </div>

                </div>

                <div class="widget">

                    <h3>Recent Posts</h3>

                    <div class="post_widget">

                        <div class="mini-blog">

                            <span>

                                <a href="#" title=""><img src="images/resource/mb1.jpg" alt="" /></a>

                            </span>

                            <div class="mb-info">

                                <h3><a href="#" title="">Canada adds 12,500 jobs in modest July rebound</a></h3>

                                <span>October 25, 2017</span>

                            </div>

                        </div>

                        <div class="mini-blog">

                            <span>

                                <a href="#" title=""><img src="images/resource/mb2.jpg" alt="" /></a>

                            </span>

                            <div class="mb-info">

                                <h3><a href="#" title="">How to “Woo” a Recruiter and Land Your Dream Job</a></h3>

                                <span>October 25, 2017</span>

                            </div>

                        </div>

                        <div class="mini-blog">

                            <span>

                                <a href="#" title=""><img src="images/resource/mb3.jpg" alt="" /></a>

                            </span>

                            <div class="mb-info">

                                <h3><a href="#" title="">Hey Job Seeker, It’s Time To Get Up And Get Hired</a></h3>

                                <span>October 25, 2017</span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="widget">

                    <h3>Our Photo</h3>

                    <div class="photo-widget">

                        <div class="row">

                            <div class="col-lg-4 col-md-2 col-sm-2 col-xs-6">

                                <a href="#" title=""><img src="images/resource/op1.jpg" alt="" /></a>

                            </div>

                            <div class="col-lg-4 col-md-2 col-sm-2 col-xs-6">

                                <a href="#" title=""><img src="images/resource/op2.jpg" alt="" /></a>

                            </div>

                            <div class="col-lg-4 col-md-2 col-sm-2 col-xs-6">

                                <a href="#" title=""><img src="images/resource/op3.jpg" alt="" /></a>

                            </div>

                            <div class="col-lg-4 col-md-2 col-sm-2 col-xs-6">

                                <a href="#" title=""><img src="images/resource/op4.jpg" alt="" /></a>

                            </div>

                            <div class="col-lg-4 col-md-2 col-sm-2 col-xs-6">

                                <a href="#" title=""><img src="images/resource/op5.jpg" alt="" /></a>

                            </div>

                            <div class="col-lg-4 col-md-2 col-sm-2 col-xs-6">

                                <a href="#" title=""><img src="images/resource/op6.jpg" alt="" /></a>

                            </div>

                        </div>

                    </div>

                </div>

            </aside> -->

            </div>

        </div>

    </div>

</section>