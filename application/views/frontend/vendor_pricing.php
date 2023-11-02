<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else{
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
                        <h3>Business Plan</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block Pricing_Data">
        <div data-velocity="-.2" style="background: url('<?= base_url('assets/images/resource/parallax5.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Become an Automation Engineering Services Partner Today!</h2>
                        <span>Find the most appropriate experts for your job from a varity of resources and global workforce.</span>
                    </div>
                    <div id="subscription-messages" class="text-success-msg f-20">
                        <p style="color: #28a745;">You Already have an active subscription plan.</p>
                    </div>
                    <!-- <div class="row pricing_filter">
                        <label>Filter By Type</label>
                        <div>
                            <select class="form-control" name="userType_id" id="userType_id" onchange="filterByuserType(this.value)" required>
                                <option value=''>Choose user type</option>
                                <option value="Experts">Experts</option>
                                <option value="Vendor">Vendors</option>
                            </select>
                        </div>
                    </div> -->
                    <!-- Heading -->
                    <div class="plans-sec">
                        <div class="row subscriptionFilteredData">
                            <?php if(!empty($get_subscription)){
                            foreach ($get_subscription as $key) {
                            $get_service=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$key['id']."'");
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="pricetable style2">
                                    <div class="Price_Shadow"></div>
                                    <div class="Price_Tag1">
                                        <div class="Price_Tag_data">
                                            <p><?= ucfirst($key['subscription_type'])?> Subscription</p>
                                        </div>
                                    </div>
                                    <div class="pricetable-head" style="text-align: center;">
                                        <!-- <img src="https://cdn-icons-png.flaticon.com/512/5673/5673647.png"> -->
                                        <h3><?= ucfirst($key['subscription_name'])?></h3>
                                        <div class="Price_Tag1">
                                            <div class="Price_Tag_data">
                                                <p style="margin-bottom: 0px !important;">
                                                    Price :
                                                    <?php if ($key['subscription_country'] == 'Nigeria') {
                                                        $currency = '₦';
                                                    } else {
                                                        $currency = '$';
                                                    }
                                                    echo $currency.' '.$key['subscription_amount']?>
                                                </p>
                                                <span>Validity :
                                                    <?php
                                                    echo "For ".$key['subscription_duration'];
                                                    if($key['subscription_duration'] > 1) {
                                                        echo " Days";
                                                    } else {
                                                        echo " Day";
                                                    } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  <input type="text" name="subscription_id" id="subscription_id<?= $key['id']; ?>" value="<?= $key['id']; ?>"> -->
                                    <input type="hidden" name="amount" id="amount<?= $key['id']; ?>" value="<?= $key['subscription_amount']; ?>">
                                    <div class="pricing-options">
            							<?php echo $key['subscription_description'];?>
            						</div>
                                    <?php
                                    if(!empty($_SESSION['automation']['userType'])) {
                                        if(!empty($subcriber_pack)) { ?>
                                        <a class="btn btn-info" href="javascript:void(0);" onclick="sub_alert()">Choose</a>
                                        <?php } else {
                                            if($key['subscription_type'] == 'paid') {
                                                if(!empty($key['product_key'])) { ?>
                                                <a class="btn btn-info" href="<?= base_url('stripe/'.base64_encode($key['price_key']))?>">Choose</a>
                                                <?php } else { ?>
                                                    <a class="btn btn-info" href="<?= base_url('paystackCheckout/'.base64_encode($key['plan_code']))?>">Choose</a>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <a href="javascript:void(0);" class="btn btn-primary getSubscription_<?php echo $key['id']?>" id="getSubscription_<?php echo $key['id']?>">Choose</a>
                                                <input type="hidden" name="user_id_<?php echo $key['id']?>" id="user_id_<?php echo $key['id']?>" value="<?php echo $_SESSION['automation']['userId']?>">
                                                <input type="hidden" name="sub_id_<?php echo $key['id']?>" id="sub_id_<?php echo $key['id']?>" value="<?php echo $key['id']?>">
                                                <input type="hidden" name="sub_name_<?php echo $key['id']?>" id="sub_name_<?php echo $key['id']?>" value="<?php echo $key['subscription_name']?>">
                                                <input type="hidden" name="user_email_<?php echo $key['id']?>" id="user_email_<?php echo $key['id']?>" value="<?php echo $_SESSION['automation']['userEmail']?>">
                                                <input type="hidden" name="sub_price_<?php echo $key['id']?>" id="sub_price_<?php echo $key['id']?>" value="<?php echo $key['subscription_amount']?>">
                                                <input type="hidden" name="sub_duration_<?php echo $key['id']?>" id="sub_duration_<?php echo $key['id']?>" value="<?php echo $key['subscription_duration']?>">
                                            <?php } ?>
                                        <?php $this->session->set_userdata('subid', $key['id'])?>
                                        <input type="hidden" name="sub_id" value="<?php echo $this->session->userdata('subid');?>">
                                    <?php } } else { ?>
                                    <a class="btn btn-info" href="<?= base_url('login')?>">Choose</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
#subscription-messages{display: none; text-align: center;}
</style>
<!-- <script type='text/javascript' src='https://code.jquery.com/jquery-1.12.4.min.js' crossorigin = "anonymous"></script>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js' crossorigin = "anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js" integrity="sha512-/bOVV1DV1AQXcypckRwsR9ThoCj7FqTV2/0Bm79bL3YSyLkVideFLE3MIZkq1u5t28ke1c0n31WYCOrO01dsUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$('.subscriptionFilteredData').matchHeight();
$('.pricetable ul').matchHeight();
$(document).ready(function(){
    <?php
    if(!empty($get_subscription)) {
        $i=1;
        foreach ($get_subscription as $value) { ?>
        $('#getSubscription_<?php echo $value['id']?>').click(function() {
            var user_id = $('#user_id_<?php echo $value['id']?>').val();
            var sub_id = $('#sub_id_<?php echo $value['id']?>').val();
            var sub_name = $('#sub_name_<?php echo $value['id']?>').val();
            var user_email = $('#user_email_<?php echo $value['id']?>').val();
            var sub_price = $('#sub_price_<?php echo $value['id']?>').val();
            var sub_duration = $('#sub_duration_<?php echo $value['id']?>').val();
            var base_url = $('#base_url').val();
            $.ajax({
                url:base_url+"user/dashboard/userSubscription",
                method:"POST",
                data:{user_id: user_id,sub_id: sub_id,sub_name: sub_name,user_email: user_email,sub_price: sub_price,sub_duration: sub_duration},
                beforeSend : function(){
                    $("#loader").show();
                    $(".getSubscription_<?php echo $value['id']?>").text('Please wait..');
                },
                success:function(data) {
                    if (data == '1'){
                        setTimeout(function () {
                            window.scroll({top: 0, behavior: "smooth"});
                            $('#subscription-messages').show();
                        }, 10000);
                        setTimeout(function () {
                            $('#subscription-messages').hide();
                        }, 13000);
                        setTimeout(function () {
                            location.reload(true);
                        }, 16000);
                    } else {
                        $('#err-messages').show();
                        setTimeout(function () {
                            window.scroll({top: 0, behavior: "smooth"})
                        }, 5000);
                        setTimeout(function () {
                            $('#err-messages').hide();
                        }, 8000);
                        setTimeout(function () {
                            location.reload(true);
                        }, 9000);
                    }
                }

            })
        })
<?php $i++; } } ?>
})

function sub_alert () {
    setTimeout(function () {
        //$("#loader").hide();
        window.scroll({top: 0, behavior: "smooth"});
        $('#subscription-messages').show();
    }, 0000);
    setTimeout(function () {
        $('#subscription-messages').hide();
    }, 13000);
}

function filterByuserType(id){
    var id = $('#userType_id').val();
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+"Home/filterByuserType",
        method:"POST",
        data:{user_type: id},
        beforeSend : function(){
            $("#loader").show();
            $(".getSubscription_<?php echo $value['id']?>").text('Please wait..');
        },
        success:function(data) {
            if(data) {
                $(".subscriptionFilteredData").html(data);
            }
        }

    })
}
</script>
