<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else{
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<style>
#register-messages {text-align: center; margin-top: 10px; display: none;}
#err-messages {text-align: center; margin-top: 10px; display: none;}
</style>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Product Details</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max_height">
    <div class="container Product-Details-Page">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 column">
                <div class="row Product-Block">
                    <div class="col-lg-4 col-md-12 col-sm-12 column Product-Img">
                        <div class="Product-Img-Container">
                            <?php
                            $p_id = $prod_details[0]['id'];
                            $pro_img_list = $this->db->query("SELECT * FROM user_product_image WHERE prod_id = '".$p_id."'")->result_array();
                            if(!empty($pro_img_list)) {
                                foreach($pro_img_list as $img_val) { ?>
                            <div class="imgSlides">
                                <img src="<?php echo base_url()?>/uploads/products/<?php echo $img_val['prod_image']?>" style="width:100%">
                            </div>
                            <?php } } ?>
                            <a class="prev" onclick="plusSlides(-1)">❮</a>
                            <a class="next" onclick="plusSlides(1)">❯</a>
                            <div class="row Slider-All-Img">
                            <?php
                            if(!empty($pro_img_list)) {
                                $i = 1;
                                foreach($pro_img_list as $img_val1) { ?>
                                <div class="column">
                                    <img class="demo cursor" src="<?php echo base_url()?>/uploads/products/<?php echo $img_val1['prod_image']?>" style="width:100%" onclick="currentSlide(<?php echo $i?>)">
                                </div>
                            <?php $i++; } }?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 column Product-Data">
                        <div><h2><?php echo $prod_details[0]['prod_name'];?></h2></div>
                        <p style="text-align: center;"><span>Vendor:</span>
                            <span>
                                <?php
                                $usr_data = $this->db->query("SELECT * FROM users WHERE userId = '".$prod_details[0]['user_id']."'")->result_array();
                                if(!empty($usr_data[0]['companyname'])){
                                    echo $usr_data[0]['companyname'];
                                } else {
                                    echo $usr_data[0]['username'];
                                }
                                ?>
                            </span>
                        </p>
                        <div class="prod_desc"><?php echo $prod_details[0]['prod_description']; ?></div>
                    </div>
                    <div class="col-lg-4 column Product-Contact">
                        <form id="productQuery_form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Type your name ..." required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Type your email ..." required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Details</label>
                                    <textarea placeholder="Type comments ..." id="details" rows="4" cols="50" required></textarea>
                                </div>
                                <div class="col-lg-12 text-center ContactBtn">
                                    <a type="button" class="btn btn-info" onclick="contactSubmit()">Contact</a>
                                    <input type="hidden" id="product_id" value="<?php echo $p_id;?>" />
                                    <input type="hidden" id="product_name" value="<?php echo $prod_details[0]['prod_name'];?>" />
                                </div>
                                <div id="register-messages" class="text-success-msg f-20">
                                    <p style="color: #28a745;">Thank you for you message. Our contact person will get in touch with you soon!</p>
                                </div>
                                <div id="err-messages">
                                    <p style="color: red;">Oops, somthing went wrong. Please try again later.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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

    function contactSubmit(){
        var p_id = $('#product_id').val();
        var p_name = $('#product_name').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var details = $('#details').val();
        $.ajax({
			url: "<?= base_url('home/product_contact')?>",
			type: 'POST',
			data: {p_id:p_id, p_name:p_name, name:name, email:email, details:details},
			success: function(result) {
                console.log(result);
                $("#productQuery_form")[0].reset();
                if(result == '1'){
                    $('#register-messages').show();
    				setTimeout(function () {
                     	$('#register-messages').hide();
                 	}, 20000);
                } else {
                    $('#err-messages').show();
    				setTimeout(function () {
                     	$('#register-messages').hide();
                 	}, 20000);
                }
            }
		});
    }
</script>
