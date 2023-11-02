<?php $get_setting=$this->Crud_model->get_single('setting');?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= base_url('assets/images/resource/mslider1.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
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
                <h2 class="breadcrumb-title">Subscription</h2>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-sm-12 display-table-cell v-align User_Sub">
    <div id="subscription-messages" class="text-success-msg f-20">
        <p style="color: #28a745;">Subscription Successful.</p>
    </div>
    <div id="cnclsubscription-messages" class="text-success-msg f-20">
        <p style="color: #28a745;">Successfully unsubsribed from the current plan.</p>
    </div>
    <div id="err-messages">
        <h4 style="color: red;">Error</h4>
        <p style="color: red;">Oops, something went wrong. Please try again later.</p>
    </div>
    <div class="user-dashboard">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cardak custom-cardak">
                    <span class="text-success-msg f-20" style="text-align: center;">
                        <?php if($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                            unset($_SESSION['message']);
                        } ?>
                    </span>
                    <?php if(!empty($current_plan)) { ?>
                    <div class="col-xl-12 col-lg-12 col-md-12" style="display: inline-block; text-align: center; padding-bottom: 15px;">
                        <h3>Active Plan</h3>
                    </div>
                    <?php } ?>
                    <div class="row row-sm">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="cardak custom-cardak">
                                <table class="table table-modific">
                                    <tbody>
                                        <?php if(!empty($current_plan)) {
                                            $i = 1;
                                            foreach ($current_plan as $row) { ?>
                                            <tr>
                                                <td class="table-modific-td">
                                                    <table class="custom-table">
                                                        <tr class="plan-active">
                                                            <td class="heading">Transaction ID: <?php echo $row->transaction_id;?></td>
                                                            <td class="btn-option">
                                                                <table class="plan-active-table">
                                                                    <!-- <tr>
                                                                        <?php
                                                                        if($row->status == '1') { ?>
                                                                        <td class="active-plan">Active Plan</td>
                                                                        <?php } ?>
                                                                        <td style="width: 8%;"></td>
                                                                        <?php
                                                                        if($row->status == '1') { ?>
                                                                        <td class="cnc-plan" id="cancelSubsription" onclick="cancelSubsription('<?php echo $row->id;?>','<?php echo $row->transaction_id;?>','<?php echo $row->amount?>')">Cancel Subscription</td>
                                                                        <?php } else if($row->status == '2') { ?>
                                                                        <td class="cnc-plan" style="font-size: 12px;">You have cancelled your subscription. Your automation subscription expires on <?php echo date ('d M Y',strtotime($row->expiry_date));?></td>
                                                                        <?php } else { ?>
                                                                        <td class="cnc-plan">Your Automation Engineering Services Subscription Expired on <?php echo date ('d M Y',strtotime($row->expiry_date));?></td>
                                                                        <?php } ?>
                                                                    </tr> -->
                                                                    <tr>
                                                                        <?php
                                                                        if($row->status == '1') { ?>
                                                                        <td class="active-plan"><span style="width: 70%">Active Plan</span></td>
                                                                        <?php } ?>
                                                                        <?php if($row->status == '3') { ?>
                                                                        <td class="cnc-plan">Your Automation Engineering Services Subscription Expired on <?php echo date ('d M Y',strtotime($row->expiry_date));?></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr class="plan-active">
                                                            <td class="heading">Subscription Plan Name: <?php echo $row->name_of_card;?></td>
                                                            <td class="btn-option">
                                                            <?php if($row->amount != '0') { ?>
                                                            <table class="plan-active-table">
                                                                <tr>
                                                                    <td class="active-plan"><a href="<?php echo $row->invoice_pdf?>"><span style="width: 70%;color: #fb6e20;">Download invoice</span></a></td>
                                                                </tr>
                                                            </table>
                                                            <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td class="heading">Subscription Plan Name: <?php echo $row->name_of_card;?></td>
                                                            <td class="btn-option"><a href="<?php echo $row->invoice_pdf?>" style="box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px; border-radius: 30px; padding: 7px 25px; font-weight: 500; color: orange;">Download invoice</a></td>
                                                        </tr> -->
                                                        <tr>
                                                            <td colspan="2" class="bid-amount">
                                                            <?php if($row->amount=='0') { ?>
                                                            <?php  } else { ?>
                                                                <?php if ($key['subscription_country'] == 'Nigeria') {
                                                                    $currency = '₦';
                                                                } else {
                                                                    $currency = '$';
                                                                }?>
                                                                <label>Price (<?php echo $currency?>):</label> <?php echo $currency.' '.number_format((float)$row->amount, 2, '.', '');?>
                                                            <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="year">
                                                                <label>Payment Date:</label> <?php echo date ('d M Y',strtotime($row->payment_date));?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="year">
                                                                <label>Expiry Date:</label> <?php echo date ('d M Y',strtotime($row->expiry_date));?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="height"></td>
                                            </tr>
                                        <?php $i++; }  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($expired_plan)) { ?>
                    <div class="col-xl-12 col-lg-12 col-md-12" style="display: inline-block; text-align: center; padding-bottom: 15px;">
                        <h3>Expired Plan</h3>
                    </div>
                    <?php } ?>
                    <div class="row row-sm">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="cardak custom-cardak">
                                <table class="table table-modific">
                                    <tbody>
                                        <?php if(!empty($expired_plan)) {
                                            $i = 1;
                                            foreach ($expired_plan as $row) { ?>
                                            <tr>
                                                <td class="table-modific-td">
                                                    <table class="custom-table">
                                                        <tr class="plan-active">
                                                            <td class="heading">Transaction ID: <?php echo $row->transaction_id;?></td>
                                                            <td class="btn-option">
                                                                <table class="plan-active-table">
                                                                    <tr>
                                                                        <?php
                                                                        if($row->status == '1') { ?>
                                                                        <td class="active-plan">Active Plan</td>
                                                                        <?php } ?>
                                                                        <td style="width: 8%;"></td>
                                                                        <?php
                                                                        if($row->status == '1') { ?>
                                                                        <td class="cnc-plan" id="cancelSubsription" onclick="cancelSubsription('<?php echo $row->id;?>','<?php echo $row->transaction_id;?>','<?php echo $row->amount?>')">Cancel Subscription</td>
                                                                        <?php } else if($row->status == '2') { ?>
                                                                        <td class="cnc-plan" style="font-size: 12px;">You have cancelled your subscription. Your automation subscription expires on <?php echo date ('d M Y',strtotime($row->expiry_date));?></td>
                                                                        <?php } else { ?>
                                                                        <td class="cnc-plan">Your Automation Engineering Services Subscription Expired on <?php echo date ('d M Y',strtotime($row->expiry_date));?></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="heading">Subscription Plan Name: <?php echo $row->name_of_card;?></td>
                                                            <td class="btn-option"><a href="<?php echo $row->invoice_pdf?>" style="box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px; border-radius: 30px; padding: 5px 25px; font-weight: 500; color: orange;">Download invoice</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="bid-amount">
                                                            <?php if($row->amount=='0') { ?>
                                                            <?php  } else { ?>
                                                                <?php if ($key['subscription_country'] == 'Nigeria') {
                                                                    $currency = '₦';
                                                                } else {
                                                                    $currency = '$';
                                                                }?>
                                                                <label>Price (<?php echo $currency?>):</label> <?php echo $currency.' '.number_format((float)$row->amount, 2, '.', '');?>
                                                            <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="year">
                                                                <label>Payment Date:</label> <?php echo date ('d M Y',strtotime($row->payment_date));?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="year">
                                                                <label>Expiry Date:</label> <?php echo date ('d M Y',strtotime($row->expiry_date));?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="height"></td>
                                            </tr>
                                        <?php $i++; }  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(empty($subscription_check)) { ?>
                <div class="cardak" style="background: #f2f2f2 !important; margin-top: 40px;">
                    <div style="display: inline-block; text-align: center;">
                        <h3>Pricing</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="row text-center align-items-end">
                            <!-- Pricing Table-->
                            <?php if(!empty($get_subscription)) {
                            $i=1;
                            foreach ($get_subscription as $value) { ?>
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="Sub_Block">
                                    <div class="Sub_Head">
                                        <div class="Heading">
                                            <h1><?= $value->subscription_name; ?></h1>
                                            <h2>
                                            <?php if ($key['subscription_country'] == 'Nigeria') {
                                                $currency = '₦';
                                            } else {
                                                $currency = '$';
                                            }?>
                                            Price: <?= $currency.''.$value->subscription_amount; ?><span></span></h2>
                                            <p style="text-align: justify;">Duration: <b><?= ' '.$value->subscription_duration." Days"; ?></b><span></span></p>
                                        </div>
                                        <div class="Icon">
                                            <span>
                                                <!-- <img src="<?php echo base_url()?>uploads/logo/3397_favicon.png" /> -->
                                                <img src="<?php echo base_url()?>uploads/logo/<?= $get_setting->favicon?>" />
                                            </span>
                                        </div>
                                    </div>
                                    <div></div>
                                    <div><?= $value->subscription_description; ?></div>
                                    <?php if($value->subscription_type == 'paid') {
                                    if(!empty($value->product_key)) { ?>
                                        <a class="btn btn-info" href="<?= base_url('stripe/'.base64_encode($value->price_key))?>">Subscribe</a>
                                        <?php } else { ?>
                                            <a class="btn btn-info" href="<?= base_url('paystackCheckout/'.base64_encode($value->plan_code).'/'.base64_encode($value->subscription_amount).'/'.base64_encode($_SESSION['automation']['userEmail']))?>">Subscribe</a>
                                        <?php } ?>
                                    <?php } else { ?>
                                    <a href="javascript:void(0);" class="btn btn-primary getSubscription_<?php echo $value->id?>" id="getSubscription_<?php echo $value->id?>">Subscribe</a>
                                    <input type="hidden" name="user_id_<?php echo $value->id?>" id="user_id_<?php echo $value->id?>" value="<?php echo $_SESSION['automation']['userId']?>">
                                    <input type="hidden" name="sub_id_<?php echo $value->id?>" id="sub_id_<?php echo $value->id?>" value="<?php echo $value->id?>">
                                    <input type="hidden" name="sub_name_<?php echo $value->id?>" id="sub_name_<?php echo $value->id?>" value="<?php echo $value->subscription_name?>">
                                    <input type="hidden" name="user_email_<?php echo $value->id?>" id="user_email_<?php echo $value->id?>" value="<?php echo $_SESSION['automation']['userEmail']?>">
                                    <input type="hidden" name="sub_price_<?php echo $value->id?>" id="sub_price_<?php echo $value->id?>" value="<?php echo $value->subscription_amount?>">
                                    <input type="hidden" name="sub_duration_<?php echo $value->id?>" id="sub_duration_<?php echo $value->id?>" value="<?php echo $value->subscription_duration?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <?php $i++; }} else { ?>
                            <div class="col-lg-12 mb-5 mb-lg-0">
                                <div class="bg-white p-5 rounded-lg shadow">
                                    <h1 class="h6 text-uppercase font-weight-bold mb-4">No Data Found</h1>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<style>
#loader {display: none; width: 40px;}
</style>
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
<style>
#subscription-messages{display: none; text-align: center;}
#cnclsubscription-messages{display: none; text-align: center;}
#err-messages{display: none; text-align: center;}
.User_Sub .Sub_Block .Sub_Head .Icon span img {
    width: 45px !important;
    height: 40px !important;
    object-fit: initial !important;
    background-repeat: no-repeat !important;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js" integrity="sha512-/bOVV1DV1AQXcypckRwsR9ThoCj7FqTV2/0Bm79bL3YSyLkVideFLE3MIZkq1u5t28ke1c0n31WYCOrO01dsUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$('.Sub_Block').matchHeight();
$('.Sub_Block ul').matchHeight();
$(document).ready(function(){
    <?php
    if(!empty($get_subscription)) {
        $i=1;
        foreach ($get_subscription as $value) { ?>
        $('#getSubscription_<?php echo $value->id?>').click(function() {
            var user_id = $('#user_id_<?php echo $value->id?>').val();
            var sub_id = $('#sub_id_<?php echo $value->id?>').val();
            var sub_name = $('#sub_name_<?php echo $value->id?>').val();
            var user_email = $('#user_email_<?php echo $value->id?>').val();
            var sub_price = $('#sub_price_<?php echo $value->id?>').val();
            var sub_duration = $('#sub_duration_<?php echo $value->id?>').val();
            var base_url = $('#base_url').val();
            $.ajax({
                url:base_url+"user/dashboard/userSubscription",
                method:"POST",
                data:{user_id: user_id,sub_id: sub_id,sub_name: sub_name,user_email: user_email,sub_price: sub_price,sub_duration: sub_duration},
                beforeSend : function(){
                    $("#loader").show();
                    $(".getSubscription_<?php echo $value->id?>").text('Please wait..');
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

function cancelSubsription(id,sub_id,amount){
    var id = id;
    var sub_id = sub_id;
    var amount = amount;
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+"user/dashboard/cancelSubscription",
        method:"POST",
        data:{id: id, sub_id: sub_id, amount: amount},
        beforeSend : function(){
            $("#cancelSubsription").text('Please wait..');
        },
        success:function(data) {
            if (data == '1'){
                setTimeout(function () {
                    window.scroll({top: 0, behavior: "smooth"});
                    $('#cnclsubscription-messages').show();
                }, 10000);
                setTimeout(function () {
                    $('#cnclsubscription-messages').hide();
                }, 13000);
                setTimeout(function () {
                    location.reload(true);
                }, 15000);
            } else {
                $('#err-messages').show();
                setTimeout(function () {
                    window.scroll({top: 0, behavior: "smooth"})
                }, 5000);
                setTimeout(function () {
                    $('#err-messages').hide();
                }, 6000);
                setTimeout(function () {
                    location.reload(true);
                }, 7000);
            }
        }

    })
}
</script>
