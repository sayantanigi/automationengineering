<?php
if(empty($_SESSION['automation']['userId']))
{
redirect(base_url('login'));
}
$seg1=$this->uri->segment(1);
?>
<section class="dashboard-gig User_Sidemenu max_height">
    <div class="container display-table" style="display: block;">
        <div class="completeSub">Please activate a subscription package and complete your profile to proceed with further activities within your dashboard</div>
        <div class="row display-table-row">
            <div class="col-md-12 col-md-12 col-sm-12 hidden-xs for-mobile-sidemenu display-table-cell v-align box" id="navigation">
                <div class="navi">
                    <ul>
                        <li <?php if($seg1=='subscription') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('subscription')?>"><i class="fa fa-bookmark" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Subscription</span>
                            </a>
                        </li>

                        <li <?php if($seg1=='profile') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <?php $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['automation']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                            if(!empty($get_sub_data)) {
                            ?>
                            <a href="<?= base_url('profile')?>"><i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Profile</span>
                            </a>
                            <?php } else { ?>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Profile</span>
                            </a>
                            <?php } ?>
                        </li>

                        <?php if(@$_SESSION['automation']['userType']=='1') {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['automation']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['automation']['userId']."'")->result_array();
                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['gender']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg1=='education-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Education</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='workexperience-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-id-card" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Work Experience</span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg1=='education-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('education-list')?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Education</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='workexperience-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('workexperience-list')?>"><i class="fa fa-id-card" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Work Experience</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='education-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Education</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='workexperience-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-id-card" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Work Experience</span>
                            </a>
                        </li>
                        <?php } } ?>

                        <?php if(@$_SESSION['automation']['userType']=='2') {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['automation']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['automation']['userId']."'")->result_array();
                        if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg1=='myjob') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg1=='myjob') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('myjob')?>"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('jobbid')?>"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='myjob') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } } else {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['automation']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['automation']['userId']."'")->result_array();
                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['gender']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('jobbid')?>"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <?php } } ?>

                        <?php if(@$_SESSION['automation']['userType']=='2') {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['automation']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['automation']['userId']."'")->result_array();
                        if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['automation']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationv1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationv"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('chat')?>"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['automation']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationv1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationv"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['automation']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationv1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationv"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } } else {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['automation']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['automation']['userId']."'")->result_array();
                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['gender']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['automation']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationf1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationf"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('chat')?>"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['automation']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationf1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationf"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['automation']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationf1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationf"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } } ?>
                    </ul>
                    <input type="hidden" name="userto_id" id="userto_id" value="<?php echo @$_SESSION['automation']['userId']?>">
                </div>
            </div>
<style>
    .completeSub {display: none; text-align: center; margin-top: 20px; color: #1B3EA7; font-size: 20px;}
</style>
<script>
function completeSub() {
    $('.completeSub').show();
    setTimeout(function(){
        $('.completeSub').fadeOut('slow');
    },4000);
}

function load_unseen_notification() {
    $('.notificationv1').hide();
    $('.notificationf1').hide();
    var userId = "<?php echo @$_SESSION['automation']['userId']?>";
    $.ajax({
        url:"<?= base_url('user/dashboard/showmessage_count') ?>",
        method:"POST",
        data:{userId:userId},
        dataType:"json",
        success:function(data) {
            //console.log(userId);
            //console.log(data);
            <?php if(@$_SESSION['automation']['userType']=='2') { ?>
            if(data.count > 0) {
                $('.notificationv').show();
                $('.notificationv').text(data.count);
            } else {
                $('.notificationv').hide();
            }
            <?php } else { ?>
            if(data.count > 0) {
                $('.notificationf').show();
                $('.notificationf').text(data.count);
            } else {
                $('.notificationf').hide();
            }
            <?php } ?>
        }
    });
}

$(document).ready(function(){
    $('.notificationv').hide();
    $('.notificationf').hide();
    setInterval(function(){
        load_unseen_notification();
    }, 5000);
})
</script>
