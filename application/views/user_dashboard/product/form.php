<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url(<?= base_url()?>assets/images/resource/mslider1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
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
                <h2 class="breadcrumb-title">Add Product</h2>
                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-sm-12 display-table-cell v-align form-design">
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
                        <!-- <div class="container bootstrap snippet">
                            <div class="new-pro">
                                <a href="#" class="pull-right">
                                </a>
                            </div>
                        </div> -->
                        <div class="profile-dsd">
                            <div class="tab-content">
                                <div class="tab-pane active" style="padding: 0px;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="new-pro" style="padding-right: 20px;">
                                                <div class="profile-ak">
                                                    <h6>Upload a different photo...</h6>
                                                    <input type="file" name="prod_image[]" multiple class="text-center center-block file-upload" />
                                                </div>
                                            </div>
                                            <?php $get_product_image = $this->db->query("SELECT * FROM user_product_image WHERE prod_id='".$id."'")->result_array();
                                            if(!empty($get_product_image)){
                                            foreach ($get_product_image as $val) { ?>
                                                <img class="img-circle_<?php echo $val['id']?> img-responsive" src="<?php echo base_url('uploads/products/'.$val['prod_image']); ?>" style="width:60px;height: 60px;"/>
                                                <img class="img-circle-close_<?php echo $val['id']?> img-responsive" src="<?php echo base_url('uploads/close-icon.png'); ?>" onclick="deleteProdImg(<?php echo $val['id']?>);" style="width: 15px; height: 15px; position: relative;top: -7px;right: 9px;"/>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="first_name">
                                                    <h4>Product Name <span style="color: red">*</span></h4>
                                                </label>
                                                <input type="text" class="form-control" name="prod_name" placeholder="Product Name"  value="<?= @$product; ?>" required/>
                                            </div>
                                            <div class="col-lg-12"><br>
                                                <label for="first_name"><h4>Product Description </h4></label>
                                                <textarea type="text" class="form-control" name="prod_description" id="prod_description" value="<?= $description;?>" ><?= @$description; ?></textarea>
                                            </div>
                                            <input type="hidden" name="id" value="<?= @$id; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12 aksek">
                                            <button class="post-job-btn pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>
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
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('prod_description');
function deleteProdImg(pi_id) {
    var id = pi_id;
    var base_url = $('#base_url').val();
    $('.img-circle_'+id).css('display','none');
    $('.img-circle-close_'+id).css('display','none');
    $.ajax({
        url:base_url+"user/dashboard/delete_product_image",
        method:"POST",
        data:{id: id},
        beforeSend : function(){},
        success:function(data) {}
    })
}
</script>
