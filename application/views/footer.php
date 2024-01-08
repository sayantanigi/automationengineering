<?php
$get_setting=$this->Crud_model->get_single('setting');
if(!empty($_SESSION['automation']['userId'])) {
    $userid=$_SESSION['automation']['userId'];
    $get_video=$this->Crud_model->GetData('friends_video','',"subscription_id='".$userid."' and status='0'",'','(video_id)desc','','1');
}
?>
<footer>
    <div class="blocknwe">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="widget">
                        <div class="about_widget">
                            <div class="logo">
                                <a href="<?=base_url(); ?>" title=""><img
                                        src="<?=base_url(); ?>uploads/logo/<?= $get_setting->flogo?>" alt="" /></a>
                            </div>
                            <?php if(!empty($get_setting->fabout)) { ?>
                            <span><?= $get_setting->fabout?></span>
                            <?php } else { ?>
                            <span></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="widget">
                        <h3 class="footer-title">Quick Links</h3>
                        <div class="link_widgets">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- <a href="<?= base_url('employer-list')?>" title="Business">Business</a> -->
                                    <a href="<?= base_url('workers-list')?>" title="Experts">Experts</a>
                                    <a href="<?= base_url('vendor_pricing')?>" title="">Business Pricing</a>
                                    <a href="<?= base_url('experts_pricing')?>" title="">Experts Pricing</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="widget">
                        <h3 class="footer-title">Support Link</h3>
                        <div class="link_widgets">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="<?= base_url('about-us')?>" title="About us">About Us</a>
                                    <a href="<?= base_url('contact-us')?>" title="Contact us">Contact Us</a>
                                    <a href="<?= base_url('privacy-policy')?>" title="privacy policy">Privacy Policy</a>
                                    <a href="<?= base_url('term-and-conditions')?>" title="Term & condition">Terms &
                                        Conditions </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="about_widget">
                        <h3 class="footer-title">Contact Us</h3>
                        <div class="link_widgets">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="#"><?= $get_setting->address?></a>
                                    <a href="#"><?= $get_setting->phone ?></a>
                                    <a href="#"><?= $get_setting->email ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="social">
                        <a href="<?php echo $get_setting->fb_link; ?>" title="" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="<?php echo $get_setting->tw_link; ?>" title="" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="<?php echo $get_setting->lnkd_link; ?>" title="" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="<?php echo $get_setting->ptrs_link?>" title="" target="_blank"><i class="fa fa-pinterest"></i></a>
                        <a href="<?php echo $get_setting->insta_link?>" title="" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="<?php echo $get_setting->truth_social_link?>" title="" target="_blank"><img src="<?= base_url('uploads/truth-social.png')?>" style=" width: 17px; height: 17px; margin-top: 1px;"></a>
                        <!-- <a href="<?php echo $get_setting->truth_social_link?>" title="" target="_blank"><i class="fa fa-pinterest"></i></a>
                        <a href="<?php echo $get_setting->baha_link?>" title="" target="_blank"><i class="fa fa-behance"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="bottom-line">
        <span>Copyright © <?php echo date('Y')?> Automation Engineering Services. All rights reserved.</span>
        <a href="#scrollup" class="scrollup" title=""><i class="la la-arrow-up"></i></a>
    </div>
</footer>
<input type="hidden" name="base_url" id="base_url" value="<?= base_url()?>">
<!-- <input type="text" name="paymentLocation" id="paymentLocation" value=""> -->
<style>
<?php $seg2 = $this->uri->segment(1);
    if($seg2 == 'register') { ?>
        .scrollup {display: none !important;}
    <?php } elseif ($seg2 != 'login') { ?>
        .scrollup {display: none !important;}
    <?php } ?>
</style>
<?php
if(!empty($_SESSION['automation']['userId'])){
    if(!empty($get_video->created_date)){
        $date=date('Y-m-d',strtotime(@$get_video->created_date));
    }
    if(@$_SESSION['automation']['userId']==@$get_video->subscription_id && $date==date('Y-m-d') && @$get_video->status=='0'){
?>
<div id="video_modal" class="modal modal-top fade calendar-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Receive video calling </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    onclick="receiveVideoCallWindow(<?= @$get_video->publisher_id?>);">video call</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php }
} ?>
<!--  end modal -->
<script src="<?= base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/modernizr.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/script.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/wow.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/slick.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/parallax.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/select-chosen.js')?>" type="text/javascript"></script>
<!-- <script src="<?= base_url('assets/js/jquery.scrollbar.min.js')?>" type="text/javascript"></script> -->
<script src="<?= base_url('assets/js/maps2.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.js')?>" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/validation.js')?>"></script>
<script src="<?= base_url();?>dist/assets/notify/notify.min.js"></script>
<!-- multi Select option for worker list page-->
<!-- Default Themes -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/default/tail.select-dark-feather.min.css" /> -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/default/tail.select-dark.min.css" /> -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/default/tail.select-light-feather.min.css" /> -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/default/tail.select-light.min.css" /> -->
<!-- Modern Themes -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-dark-feather.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-dark.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-light-feather.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-light.min.css" />
<!-- Bootstrap themes -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/bootstrap4/tail.select-THEME-NAME.min.css" /> -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/bootstrap3/tail.select-THEME-NAME.min.css" /> -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/bootstrap2/tail.select-THEME-NAME.min.css" /> -->
<!-- Core JavaScript -->
<script src="<?php echo base_url()?>assets/multi_select/js/tail.select.min.js"></script>
<!-- Languages -->
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-de.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-es.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-fi.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-fr.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-it.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-no.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-pt_BR.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-ru.js"></script>
<script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-tr.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script type="text/javascript">
//Confirmation box for user panel
var confirmTextDelete = 'Are you sure you want to delete this record?';
var confirmationText = 'Are you sure you want to change this status?';
    $(document).ready(function () {
        // alert(1);
        tail.select('#example',{
            startOpen: true,
            multiple: true,
            stayOpen: true,
            multiPinSelected: true,
            multiShowCount: false,
            multiShowLimit: true,
            multiContainer: true,
            search: true,
            searcgConfig: [
                "text", "value"
            ],
            searchFocus: true,
            searchMarked: true,
            searchMinLength: 1,
        });
        var sessionMessage = '<?php echo $this->session->userdata('
        message ') <> '
        ' ? $this->session->userdata('
        message ') : '
        '; ?>';
        if (sessionMessage == null || sessionMessage == "") {
            return false;
        }
        $.notify(sessionMessage, {
            position: "top right",
            className: 'success'
        }); //session msg

        $('.dropdown-optgroup').click(function() {
            var selected = $(".dropdown-optgroup :selected").map((_,e) => e.value).get();
            alert(selected);
      });
    });
    setInterval(function () {
        $('#video_modal').modal('show');
    }, 5000);

    var targetDiv = $('.about_widget img').attr('src');
    var targetDiv1 = $('.hidden-logo').val();
    $(window).scroll(function () {
        var windowpos = $(window).scrollTop();
        if (windowpos >= 50) {
            $(".Header_Menu_Nav img").attr("src", targetDiv);
            $(".Header_Menu_Nav img").attr("src", targetDiv);
        } else {
            $(".Header_Menu_Nav img").attr("src", targetDiv1);
            $(".Header_Menu_Nav img").attr("src", targetDiv1);
        }

    });

    function receiveVideoCallWindow(fid) {
        $('#video_modal').css('display', 'none');
        var callPath = "<?php echo base_url('livevideo/video/');?>" + fid;
        window.open(callPath, "_blank",
            "toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=20,width=600,height=450");
    }
</script>
</body>

</html>
