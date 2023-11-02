

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title"><?= $heading ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body profile-menu">
                        <!-- <ul class="nav nav-tabs nav-tabs-solid" role="tablist">
                            <li class="nav-item home_tab">
                                <a class="nav-link active" data-toggle="tab" href="#profile_settings" role="tab" aria-selected="false">
                                    Profile Settings
                                </a>
                            </li>
                            <li class="nav-item home_add">
                                <a class="nav-link" data-toggle="tab" href="#change_password" role="tab" aria-selected="false">
                                    Change password
                                </a>
                            </li>
                        </ul> -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="profile_settings" role="tabpanel">
                            <!-- <div class="row">
                                <div class="col-lg-7">
                                    <form method="post" action="<?= admin_url('login/update_profile')?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Profile Image</label>
                                            <div class="media align-items-center">
                                                <div class="media-left">
                                                <?php if(!empty($get_admin->profile)){
                                                    if(!file_exists('uploads/profile/'.$get_admin->profile)){
                                                        ?>
                                                        <img class="rounded-circle profile-img avatar-view-img" src="<?= base_url('dist/assets/img/user.jpg')?>" alt="" width="100" height="100">
                                                    <?php } else{?>
                                                        <img class="rounded-circle profile-img avatar-view-img" src="<?= base_url('uploads/profile/'.$get_admin->profile)?>" alt="" width="100" height="100">
                                                    <?php } } else{?>
                                                        <img class="rounded-circle profile-img avatar-view-img" src="<?= base_url('dist/assets/img/user.jpg')?>" alt="" width="100" height="100">
                                                    <?php } ?>
                                                </div>
                                                <div class="media-body">
                                                    <div class="uploader pl-3">
                                                        <input type="file"  name="profile" class="form-control bg-secondary text-white">
                                                        <input type="hidden" name="old_image" value="<?= $get_admin->profile?>">
                                                        <input type="hidden" name="id" value="<?= $get_admin->userId ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" value="<?= $get_admin->username?>" disabled >
                                        </div>
                                        <div class="mt-4 save-form">
                                            <button class="btn btn-primary save-btn" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div> -->
                                   
                                <div class="row">
                                    <div class="col-lg-7">
                                         <h3 class="h4 mb-3">Change Password</h3>
                                        <form method="post">
                                            <div class="form-group">
                                                <label>Current Password <span style="color:red">*</span> <span id="err_current"></span></label>
                                                <input type="password" class="form-control" name="curr_pass" id="cur-password" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password <span style="color:red">*</span> <span id="err_new"></span></label>
                                                <input type="password" class="form-control" name="new_pass" id="new-password" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Repeat Password <span style="color:red">*</span> <span id="err_repeat"></span></label>
                                                <input type="password" class="form-control" name="repeat_pass" id="repeat_pass" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <span id="password_match"></span>
                                            </div>
                                            <div class="mt-4 save-form">
                                                <button class="btn save-btn btn-primary" type="button" onclick="return change_password();">Update </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                <!-- <div class="tab-pane fade" id="change_password" role="tabpanel">
                                    
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/change_password.js')?>"></script>
