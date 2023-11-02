<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1"
            style="background: url('<?= base_url('assets/images/resource/mslider1.jpg')?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div>
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
                <h2 class="breadcrumb-title">Products</h2>
                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Products</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-md-12 col-sm-12 display-table-cell v-align">
    <div id="product-messages" class="text-success-msg f-20">
        <p style="color: #28a745;">Product Deleted Successfully.</p>
    </div>
    <div id="err-messages">
        <h4 style="color: red;">Error</h4>
        <p style="color: red;">Oops, somthing went wrong. Please try again later.</p>
    </div>
    <div class="text-success-msg f-20" style="text-align: center;">
        <?php if($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
        } ?>
    </div>
    <div class="user-dashboard">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12" style="margin-bottom: 10px; text-align: right;">
                <a href="<?php echo base_url('add-product')?>" class="btn btn-primary Education_Btn" style="border-radius: 40px; letter-spacing: 0;">Add Product</a>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cardak custom-cardak">
                    <table class="table table-modific Dash-Product">
                        <!-- <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Desctiption</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead> -->
                        <tbody>
                            <?php if (!empty($product_list)) {
                                $i=1;
                                foreach ($product_list as $value) {
                            ?>
                            <tr>
                                <td class="table-modific-td">
                                    <table class="custom-table">
                                        <tr>
                                            <td class="heading"><?php echo $value->prod_name;?></td>
                                            <td class="btn-option">
                                                <a href="javascript:void(0)" id="View1_<?php echo $value->id;?>" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="<?= base_url('update-product/'.base64_encode($value->id));?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" style="padding-left: 10px;"></i></a>
                                                <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="productDelete(<?php echo $value->id;?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="desc">
                                            <?php
                                            $string = strip_tags($value->prod_description);
                                            if (strlen($string) > 200) {
                                                $stringCut = substr($string, 0, 200);
                                                $endPoint = strrpos($stringCut, ' ');
                                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                $string .= '...';
                                            }
                                            echo $string;
                                            ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="height"></td>
                            </tr>
                            <tr id="Product-Data-Block1_<?php echo $value->id;?>">
                                <td colspan="4" class="Product-Details-Page" style="border: 0; padding: 0;">
                                    <div class="row Product-Block" style="margin-bottom: 20px !important;">
                                        <div class="col-lg-4 col-md-12 col-sm-12 column Product-Img">
                                            <div class="Product-Img-Container">
                                                <?php $product_image = $this->db->query("SELECT * FROM user_product_image WHERE prod_id = '".$value->id."'")->result_array();
                                                //print_r($product_image);
                                                if(!empty($product_image)) {
                                                foreach($product_image as $row) {
                                                ?>
                                                <div class="imgSlides">
                                                    <img src="<?php echo base_url('uploads/products/'.$row["prod_image"])?>" style="width:100%">
                                                </div>
                                                <?php } } ?>
                                                <a class="prev" onclick="plusSlides(-1)">❮</a>
                                                <a class="next" onclick="plusSlides(1)">❯</a>
                                                <div class="row Slider-All-Img">
                                                    <?php $product_image = $this->db->query("SELECT * FROM user_product_image WHERE prod_id = '".$value->id."'")->result_array();
                                                    $j = 1;
                                                    if(!empty($product_image)) {
                                                    foreach($product_image as $row) {
                                                    ?>
                                                    <div class="column">
                                                        <img class="demo cursor" src="<?php echo base_url('uploads/products/'.$row["prod_image"])?>" style="width:100%" onclick="currentSlide(<?= $j; ?>)">
                                                    </div>
                                                    <?php $j++; } } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column Product-Data">
                                            <div><h2 style="font-size: 20px;"><?php echo $value->prod_name;?></h2></div>
                                            <hr>
                                            <div class="prod_desc" style="margin-top: 0 !important;"><?php echo $value->prod_description; ?></div>
                                        </div>
                                        <div class="col-lg-4 column Product-Contact">
                                        <?php $product_contact = $this->db->query("SELECT * FROM product_contact WHERE product_id = '".$value->id."'")->result_array();
                                        if(!empty($product_contact)) {
                                        foreach($product_contact as $val) { ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Name</label>
                                                    <label class="data"><?php echo $val['c_name']?></label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Email</label>
                                                    <label class="data"><?php echo $val['c_email']?></label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Details</label>
                                                    <label class="data data-field"><?php echo $val['c_description']?></label>
                                                </div>
                                            </div>
                                        <?php } }?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">
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

<style>
#product-messages{display: none; text-align: center;}
#err-messages{display: none; text-align: center;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    <?php
    if(!empty($product_list)) {
    $i=1;
    foreach ($product_list as $value) { ?>
        $("#Product-Data-Block1_<?php echo $value->id;?>").hide();
        $('#View1_<?php echo $value->id?>').click(function () {
            //$("#Product-Data-Block1_<?php echo $value->id;?>").toggleClass('Show-Product-Block_<?php echo $value->id;?>');
            $("#Product-Data-Block1_<?php echo $value->id;?>").toggle();
        });
    <?php $i++; } } ?>
});

function productDelete(id) {
    var p_id = id;
    $.confirm({
	    title: 'Confirm!',
	    content: confirmTextDelete,
	    buttons: {
	        confirm: function () {
                var base_url = $('#base_url').val();
                $.ajax({
                    url:base_url+"user/dashboard/delete_product",
                    method:"POST",
                    data:{id: p_id},
                    beforeSend : function(){
                        $("#loader").show();
                        //$(".SignUp_Btn button").prop('disable','true');
                    },
                    success:function(data) {
                        if (data == '1'){
                            setTimeout(function () {
                                $("#loader").hide();
                                window.scroll({top: 0, behavior: "smooth"});
                                $('#product-messages').show();
                            }, 3000);
                            setTimeout(function () {
                                $('#product-messages').hide();
                            }, 5000);
                            setTimeout(function () {
                                location.reload(true);
                            }, 6000);
                        } else {
                            $('#err-messages').show();
                            setTimeout(function () {
                                window.scroll({top: 0, behavior: "smooth"})
                            }, 3000);
                            setTimeout(function () {
                                $('#err-messages').hide();
                            }, 5000);
                            setTimeout(function () {
                                location.reload(true);
                            }, 6000);
                        }
                    }

                })
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
</script>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("imgSlides");
        let dots = document.getElementsByClassName("demo");
        let captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
</script>
</section>
