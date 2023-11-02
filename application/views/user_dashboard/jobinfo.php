<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url(assets/images/resource/mslider1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header" style="padding-top: 90px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dashboardhak">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Job Info</h2>
                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('sidebar');?>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="user-dashboard">
                <form class="form" action="<?php echo base_url('user/Dashboard/update_profile')?>" method="post" id="registrationForm" enctype="multipart/form-data">
                    <div class="row row-sm">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="profile-dsd">
                                <div class="tab-content">
                                    <div class="tab-pane active" style="padding: 0px;">
                                        <hr />
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                   <a href="<?php echo base_url('myjob')?>" class="btn btn-primary" style="float:right;">Back</a>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="first_name"><h4>Job Title</h4></label>
                                                    <p><?php if(!empty($get_postjob->post_title)){ echo $get_postjob->post_title;}?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="first_name"><h4>Duration</h4></label>
                                                    <p><?php if(!empty($get_postjob->duration)){ echo $get_postjob->duration;}?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="first_name"><h4>Charges</h4></label>
                                                    <p>USD <?php if(!empty($get_postjob->charges)){ echo $get_postjob->charges;}?></p>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="first_name"><h4>Apply Deadline</h4></label>
                                                    <p><?php if(!empty($get_postjob->appli_deadeline)){ echo date('d-M-Y',strtotime($get_postjob->appli_deadeline));}?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="first_name"><h4>Category</h4></label>
                                                    <p><?php if(!empty($get_postjob->category_name)){ echo $get_postjob->category_name;}?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="first_name"><h4>Sub Category</h4></label>
                                                    <p><?php if(!empty($get_postjob->sub_category_name)){ echo $get_postjob->sub_category_name;}?></p>
                                                </div>
                                                     <div class="col-lg-12">
                                                    <label for="first_name"><h4>Address</h4></label>
                                                    <p><?php if(!empty($get_postjob->complete_address)){ echo $get_postjob->complete_address;}?></p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="first_name"><h4>Description</h4></label>
                                                    <p><?php if(!empty($get_postjob->description)) { echo $get_postjob->description;}?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
