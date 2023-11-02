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
                <h2 class="breadcrumb-title">Services</h2>
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
        <form class="form" action="<?= $action; ?>" method="post" id="registrationForm" enctype="multipart/form-data">
            <div class="row row-sm">

                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="cardak">
                        <span class="text-success-msg f-20">
                            <?php if($this->session->flashdata('message')) {
                                echo $this->session->flashdata('message');
                                unset($_SESSION['message']);
                            } ?>
                        </span>
                        <div class="container bootstrap snippet">
                            <div class="new-pro">
                                <a href="#" class="pull-right">

                                </a>
                            </div>
                        </div>
                        <div class="profile-dsd">
                            <div class="tab-content">
                                <div class="tab-pane active" style="padding: 0px;">
                                    <hr />

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="first_name"><h4>Service Name  <span style="color: red">*</span></h4></label>
                                                <input type="text" class="form-control" name="service_name" id="service_name" placeholder="Service name"  value="<?= $service_name; ?>" required onkeypress="only_alphabets(event)"/>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="first_name"><h4>Category <span style="color: red">*</span></h4></label>
                                                <select type="text" class="form-control" name="category_id" id="category_id"  value="<?= $category_id; ?>" required  onchange="return get_subcategory(this.value);" >

                                                    <option>Select Category</option>
                                                    <?php if(!empty($get_category)){ foreach ($get_category as $key) {?>
                                                        <option value="<?= $key->id;?>" <?php if($key->id==$category_id){ echo "selected";}?>  ><?= $key->category_name;?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="first_name"><h4>Sub Category  <span style="color: red">*</span></h4></label>
                                                <select type="text" class="form-control" name="subcategory_id" id="subcategory_id"  value="<?= $subcategory_id; ?>" required >
                                                    <option>Select Subcategory</option>
                                                    <?php if(!empty($get_subcategory))  { foreach ($get_subcategory as $sub) {?>
                                                        <option value="<?= $sub->id;?>" <?php if($sub->id==$subcategory_id){echo "selected";}?>><?= $sub->sub_category_name;?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <div class="col-lg-12"><br>
                                                <label for="first_name"><h4>Description  <span style="color: red">*</span></h4></label>
                                                <textarea type="text" class="form-control" name="description" id="description"   value="<?= $description; ?>" required ><?= $description; ?></textarea>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $id; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12 aksek">
                                            <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> <?= $button; ?></button>
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
<div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Project Title" name="name" />
                <input type="text" placeholder="Post of Post" name="mail" />
                <input type="text" placeholder="Author" name="passsword" />
                <textarea placeholder="Desicrption"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel" data-dismiss="modal">Close</button>
                <button type="button" class="add-project" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
</section>
