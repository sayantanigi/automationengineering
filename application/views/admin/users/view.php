<div class="page-wrapper">

    <div class="content container-fluid">


        <div class="page-header">

            <div class="row">

                <div class="col-12">

                    <h3 class="page-title"><?= $heading;?></h3>

                </div>

            </div>

        </div>

        <div class="row">


            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="card">

                    <div class="card-body p-0">


                        <div class="tab-content pt-0">


                            <div id="general" class="tab-pane active">

                                <div class="card mb-0">


                                    <div class="container">


                                        <div class="card-body">

                                            <div class="row">


                                                <div class="col-md-12">


                                                    <a href="<?= admin_url('users')?>" class="btn btn-primary" style="float: right;">Back</a>


                                                </div>

                                                <div class="col-md-4">

                                                    <div class="form-group">

                                                        <label >Type</label>

                                                        <p>

                                                            <?php

                                                            if($get_userdata->userType==1){

                                                                echo "Expert";

                                                            } else if($get_userdata->userType==2){

                                                                echo "Business";

                                                            }?>

                                                        </p>

                                                    </div>

                                                </div>

                                                <div class="col-md-4">

                                                    <div class="form-group">

                                                        <label >Profile</label>

                                                        <p>

                                                            <?php if(!empty($get_userdata->profilePic)){

                                                                if(!file_exists('uploads/users/'.$get_userdata->profilePic)){

                                                                    ?>

                                                                    <img class="rounded-circle profile-img avatar-view-img" src="<?= base_url('uploads/no_image.png')?>" alt="" width="100" height="100">

                                                                <?php } else{?>

                                                                    <img class="rounded-circle profile-img avatar-view-img" src="<?= base_url('uploads/users/'.$get_userdata->profilePic)?>" alt="" width="100" height="100">

                                                                <?php } } else{?>

                                                                    <img class="rounded-circle profile-img avatar-view-img" src="<?= base_url('uploads/no_image.png')?>" alt="" width="100" height="100">

                                                                <?php } ?>

                                                            </p>

                                                        </div>

                                                    </div>
                                                    <?php if(!empty($get_userdata->username)) { ?>
                                                    <div class="col-md-4">

                                                        <div class="form-group">

                                                            <label > User name</label>

                                                            <p><?= ucfirst($get_userdata->username); ?></p>

                                                        </div>

                                                    </div>
                                                    <?php } ?>
                                                    <div class="col-md-4">

                                                        <div class="form-group">

                                                            <label >Email</label>

                                                            <p><?= $get_userdata->email; ?></p>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-4">

                                                        <div class="form-group">

                                                            <label >Phone</label>

                                                            <p><?php if(!empty($get_userdata->mobile)){ echo $get_userdata->mobile;} ?></p>

                                                        </div>

                                                    </div>


                                                    <div class="col-md-4">

                                                        <div class="form-group">

                                                            <label > Zip</label>

                                                            <p><?php if(!empty($get_userdata->zip)){ echo $get_userdata->zip;} else{ echo "-";} ?></p>

                                                        </div>

                                                    </div>


                                                    <div class="col-md-4">

                                                        <div class="form-group">

                                                            <label > Date </label>

                                                            <p><?= date('d-M-Y',strtotime($get_userdata->created)); ?></p>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group">

                                                            <label > Address</label>

                                                            <p><?php if(!empty($get_userdata->address)){ echo ucfirst($get_userdata->address);} ?></p>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class="card-body pt-0">



                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>
