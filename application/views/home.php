<section class="topak">
    <div class="block no-padding">
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-featured-sec">
                        <ul class="main-slider-sec text-arrows">
                            <li class="slideHome">
                                <?php if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){?>
                                <img src="<?=base_url('uploads/banner/'.$get_banner->image); ?>" alt="" />
                                <?php } else{?>
                                <img src="<?=base_url(); ?>assets/images/resource/mslider1.jpg" alt="" />
                                <?php } ?>
                            </li>
                        </ul>
                        <div class="job-search-sec">
                            <div class="job-search">
                                <h3>The Easiest Way to Get Your New Job</h3>
                                <span>Find Jobs, Employment & Career Opportunities</span>
                                <form method="post" action="<?= base_url('search-job')?>">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="job-field">
                                                <input type="text" name="search_title" placeholder="Job title, keywords or company name" value="" />
                                                <i class="la la-search"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="job-field">
                                                <ul class="chosen_country" onchange="getState(this.value)">
                                                    <div class="select_countryvalue">Select Country</div>
                                                    <input type="hidden" name="country" id="country" value="">
                                                </ul>
                                                <?php //print_r($countries); die;?>
                                                <div class="showCountry" style="position: absolute;z-index: 999999;width: 85%;bottom: -10px;">
                                                    <input type="text" name="search_country" id="search_country" style="height: 28px; border-radius: 0px;" placeholder="Search Country">
                                                    <div class="makeCountryList slim-scroll" id="slim-scroll">
                                                        <?php if(!empty($countries)){ foreach($countries as $item) { ?>
                                                        <li class="countryList" value="<?= $item->name ?>" onclick="selectCountry('<?= $item->name ?>')"><?= ucfirst($item->name)?></li>
                                                        <?php } }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="job-field">
                                                <ul class="custom-select chosenState">
                                                    <div class="chosen_state select_statevalue">Select State</div>
                                                    <input type="hidden" name="state" id="state" value="">
                                                </ul>
                                                <div class="showState" style="position: absolute;z-index: 999999;width: 85%;bottom: -10px;">
                                                    <input type="text" name="search_state" id="search_state" style="height: 28px; border-radius: 0px;" placeholder="Search State">
                                                    <div id="makeStateList" class="makeStateList slim-scroll" id="slim-scroll"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="job-field">
                                                <ul class="custom-select chosenCity">
                                                    <div class="chosen_city select_cityvalue">Select City</div>
                                                    <input type="hidden" name="city" id="city" value="">
                                                </ul>
                                                <div class="showCity" style="position: absolute;z-index: 999999;width: 85%;bottom: -10px;">
                                                    <input type="text" name="search_city" id="search_city" style="height: 28px; border-radius: 0px;" placeholder="Search City">
                                                    <div id="makeCityList" class="makeCityList slim-scroll" id="slim-scroll"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 search-btn">
                                            <button type="submit"><i class="la la-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="scroll-to d-none">
                            <a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block Opp_Block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Automation Engineering Services Opportunities</h2>
                        <span>Look for the latest jobs and projects posted on the portal.</span>
                    </div>
                    <div class="blog-sec">
                        <div class="row">
                        <?php if(!empty($get_post)) {
                        foreach($get_post as $row){
                        if(strlen($row->description)>195) {
                            $desc=substr($row->description,0,195).'...';
                        } else {
                            $desc=$row->description;
                        }
                        $get_user = $this->db-> query("SELECT * FROM users WHERE userId = '$row->user_id'")->result_array();?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="my-blog" onclick="location.href='<?= base_url('postdetail/'.base64_encode($row->id))?>';">
                                    <div class="blog-details">
                                        <div class="Blog-Emp-Details">
                                            <div class="Blog-Emp-Img">
                                                <?php if (!empty($get_user[0]['profilePic'])) { ?>
                                                <img src="<?php echo base_url('uploads/users/'.$get_user[0]['profilePic']);?>">
                                                <?php } else {?>
                                                <img src="<?php echo base_url('uploads/users/user.png');?>">
                                                <?php } ?>
                                            </div>
                                            <div class="Blog-Emp-Data">
                                                <?php
                                                if(!empty($row->post_title)) {
                                                    if(strlen($row->post_title)>30) {
                                                        $title = substr($row->post_title,0,30).'...';
                                                    } else {
                                                        $title = $row->post_title;
                                                    }
                                                } else {
                                                    $title = '';
                                                } ?>
                                                <p><?= ucfirst($title)?></p>
                                                <p>By <?php echo @$get_user[0]['companyname']?></p>
                                            </div>
                                        </div>
                                        <h3 class="nkash"><a href="javascript:void(0)" title="">Description</a></h3>
                                        <p style="text-align: justify !important;"><?= ucfirst(strip_tags($desc))?></p>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
                <?php if(count($get_post) > 6) { ?>
                <div class="col-lg-12">
                    <div class="browse-all-cat">
                        <a href="<?= base_url('ourjobs')?>" title="">View More</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block Worker-Block">
        <div data-velocity="-.1" style="background: #F9FAFC" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Available Automation Engineering Services Experts</h2>
                        <span>Find the most eligible experts within the portal.</span>
                    </div>
                    <div class="blog-sec">
                        <div class="row">
                            <?php
                            if(!empty($get_users)){
                                foreach($get_users as $user){
                                if(strlen($user->short_bio)>200) {
                                    $shortbio=substr($user->short_bio,0,200).'...';
                                } else {
                                    $shortbio=$user->short_bio;
                                }
                            if(!empty($user->firstname) && !empty($user->lastname) && !empty($user->email) && !empty($user->gender) && !empty($user->address) && !empty($user->short_bio)) {
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="my-blog">
                                    <div class="blog-thumbak">
                                        <a href="<?= base_url('worker-detail/'.base64_encode(@$user->userId))?>" title="">
                                            <?php if(!empty($user->profilePic)&& file_exists('uploads/users/'.$user->profilePic)){?>
                                            <img src="<?=base_url('uploads/users/'.$user->profilePic); ?>" alt="" style="height: 300px;" />
                                            <?php } else{?>
                                            <img src="<?=base_url('uploads/no_image.png'); ?>" alt="" style="height: 300px;" />
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="blog-details">
                                        <div class="blog-head">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <ul class="gigasjh">
                                                        <li>Member Since</li>
                                                        <li><?php echo date('m/d/Y', strtotime(@$user->created));?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $user_rating = $this->db->query("SELECT AVG(rt.rating) as rate FROM employer_rating rt WHERE rt.worker_id = '".@$user->userId."'")->result(); ?>
                                        <div class="staak">
                                        <?php if($user_rating[0]->rate > 0) {
                                            for ($i = 0; $i < $user_rating[0]->rate; $i++) { ?>
                                            <span class="fa fa-star checked"></span>
                                        <?php } } else { ?>
                                            <span class="">Not Rated Yet</span>
                                        <?php } ?>
                                        </div>
                                        <h3 class="nkash">
                                            <a type="button" class="btn" href="<?= base_url('worker-detail/'.base64_encode(@$user->userId))?>" title="">
                                                <?php if(!empty($user->firstname)){ echo $user->firstname.' '.$user->lastname; } else{ echo ucfirst($user->username);}?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <?php }}} ?>
                        </div>
                    </div>
                </div>
                <?php if(count($get_users) > 8) { ?>
                <div class="col-lg-12">
                    <div class="browse-all-cat">
                        <a href="<?= base_url('workers-list')?>" title="">View More</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section id="scroll-here">
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Our Services</h2>
                        <span>The marketplace for the most eligible experts and businesses. <br> Find the latest jobs in the industry globally.</span>
                    </div>
                    <!-- Heading -->
                    <div class="cat-sec">
                        <div class="row no-gape">
                            <?php if(!empty($get_ourservice)){
                                foreach($get_ourservice as $item){
                                    $get_category=$this->Crud_model->get_single('category',"id='".$item->category_id."'");
                                    if(strlen($item->description)>100) {
                                        $description=substr($item->description,0,100).'...';
                                    } else {
                                        $description=$item->description;
                                    }
                                ?>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="p-category">
                                    <a href="javascript:void(0)" title="">
                                        <img src="<?php echo base_url()?>/uploads/services/<?php echo $item->icon?>" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;">
                                        <?php if(!empty($get_category->category_name)) { ?>
                                        <span><?= ucfirst($get_category->category_name)?></span>
                                        <?php } else { ?>
                                        <span></span>
                                        <?php } ?>
                                        <?php if(!empty($description)) { ?>
                                        <p><?= ucfirst(strip_tags($description));?></p>
                                        <?php } else { ?>
                                        <p></p>
                                        <?php } ?>
                                    </a>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block double-gap-top double-gap-bottom">
        <?php if(!empty($get_banner_middle->image) && file_exists('uploads/banner/'.$get_banner_middle->image)){?>
        <div data-velocity="-.1" style="background: url(<?=base_url('uploads/banner/'.$get_banner_middle->image); ?>) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div>
        <?php } else{?>
        <div data-velocity="-.1" style="background: url(<?=base_url(); ?>assets/images/resource/parallax1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div>
        <?php } ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="simple-text-block">
                        <h3>Make a Difference with Your Online Resume!</h3>
                        <span>Get access to the latest jobs and projects globally!!</span>
                        <?php if(empty($_SESSION['automation']['userId'])){?>
                        <a href="<?= base_url('register')?>" title="">Create an Account</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Companies We've Helped</h2>
                        <span>Some of the companies we've helped recruit excellent applicants over the years.</span>
                    </div>
                    <section class="customer-logos slider">
                    <?php if(!empty($get_company)) {
                        foreach($get_company as $item) { 
                        if(!empty($item->logo)&& file_exists('uploads/company_logo/'.$item->logo)) { ?>
                        <div class="slide"><img src="<?=base_url('uploads/company_logo/'.$item->logo); ?>" alt="" style="display: block; width: 100%; height: 150px; object-fit: cover;"/></div>
                        <?php } else { ?>
                        <img src="<?=base_url(); ?>assets/images/resource/b1.jpg" alt="" style="display: block; width: 100%; height: 150px; object-fit: cover;"/>
                        <?php } } }?>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block Career">
        <div data-velocity="-.1" style="background: #F9FAFC" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Quick Career Tips</h2>
                        <span>Review the latest updates and informations in the industry.</span>
                    </div>
                    <!-- Heading -->
                    <div class="blog-sec">
                        <div class="row">
                            <?php if(!empty($get_career)){ foreach($get_career as $career){
                            if(strlen($career->description)>100) {
                                $desc=substr($career->description,0,100).'...';
                            } else {
                                $desc=$career->description;
                            }
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="my-blog">
                                    <div class="blog-thumb">
                                        <a href="<?= base_url('career-tip/'.base64_encode($career->id))?>" title="">
                                            <?php if(!empty($career->image)&& file_exists('uploads/career/'.$career->image)){?>
                                            <img src="<?=base_url('uploads/career/'.$career->image); ?>" alt="" />
                                            <?php } else{?>
                                            <img src="<?=base_url(); ?>assets/images/resource/b1.jpg" alt="" />
                                            <?php } ?>
                                        </a>
                                        <div class="blog-metas">
                                            <a href="javascript:void(0)" title=""><?= date('M d,Y',strtotime($career->update_date))?></a>
                                            <a href="javascript:void(0)" title="">0 Comments</a>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3><a href="<?= base_url('career-tip/'.base64_encode($career->id))?>" title=""><?= ucfirst($career->title)?></a></h3>
                                        <div><?= ucfirst($desc)?></div>
                                        <a href="<?= base_url('career-tip/'.base64_encode($career->id))?>" title=""><span>Read More</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php } }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
                    
<style>
    .chosen_country {color: #888888; height: 60px; border-radius: 50px; padding: 17px !important; background: #e9e9ed; cursor: pointer;}
    .showCountry {display: none;}
    .showState {display: none;}
    .showCity {display: none;}
    .chosenState, .chosen_state {color: #888888; height: 60px; border-radius: 50px; padding: 17px !important; background: #e9e9ed; cursor: pointer;}
    .chosenCity, .chosen_city {color: #888888; height: 60px; border-radius: 50px; padding: 17px !important; background: #e9e9ed; cursor: pointer;}
    #state {display: block;color: #888888; height: 60px; border-radius: 50px; padding: 17px !important;}
    #city {display: block;color: #888888; height: 60px; border-radius: 50px; padding: 17px !important;}
    .makeCountryList {background: #e9e9ed;position: absolute;z-index: 999999;top: 28px;width: 100%;max-height: 300px;overflow: auto; display: none;}
    .makeCountryList {border-radius: 0 0 10px 10px; scrollbar-width: thin;}
    .makeStateList {background: #e9e9ed;position: absolute;z-index: 999999;top: 28px;width: 100%;max-height: 300px;overflow: auto; display: none;}
    .makeStateList {border-radius: 0 0 10px 10px; scrollbar-width: thin;}
    .makeCityList {background: #e9e9ed;position: absolute;z-index: 999999;top: 28px;width: 100%;max-height: 300px;overflow: auto; display: none;}
    .makeCityList {border-radius: 0 0 10px 10px; scrollbar-width: thin;}
    .slim-scroll::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); background-color: #F5F5F5; border-radius: 0 0 30px 0;}
    .slim-scroll::-webkit-scrollbar {width: 5px; background-color: #F5F5F5;}
    .slim-scroll::-webkit-scrollbar-thumb {border-radius: 5px; background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.44, rgb(122, 153, 217)), color-stop(0.72, rgb(73, 125, 189)), color-stop(0.86, rgb(28, 58, 148)));}
    .makeCountryList li.countryList {list-style: none !important; padding: 4px 0 4px 20px; border-bottom: 1px solid #ddd;}
    .makeStateList li.stateList {list-style: none !important; padding: 4px 0 4px 20px; border-bottom: 1px solid #ddd; cursor: pointer;}
    .makeCityList li.cityList {list-style: none !important; padding: 4px 0 4px 20px; border-bottom: 1px solid #ddd; cursor: pointer;}
    .makeCountryList li.countryList:hover {background: #738edb; color: #fff; cursor: pointer;}
    .makeCountryList li.countryList:hover {background: #738edb; color: #fff; cursor: pointer;}
    .makeCityList li.cityList:hover {background: #738edb; color: #fff; cursor: pointer;}
    h2 {text-align:center; padding: 20px;}
    .slick-slide {margin: 0px 20px;}
    .slick-slide img {width: 100%;}
    .slick-slider{position: relative; display: block; box-sizing: border-box; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-touch-callout: none; -khtml-user-select: none; -ms-touch-action: pan-y; touch-action: pan-y; -webkit-tap-highlight-color: transparent;}
    .slick-list{position: relative; display: block; overflow: hidden; margin: 0; padding: 0;}
    .slick-list:focus {outline: none;}
    .slick-list.dragging {cursor: pointer; cursor: hand;}
    .slick-slider .slick-track,
    .slick-slider .slick-list {-webkit-transform: translate3d(0, 0, 0); -moz-transform: translate3d(0, 0, 0); -ms-transform: translate3d(0, 0, 0); -o-transform: translate3d(0, 0, 0); transform: translate3d(0, 0, 0);}
    .slick-track {position: relative; top: 0; left: 0; display: block;}
    .slick-track:before, .slick-track:after {display: table; content: '';}
    .slick-track:after {clear: both;}
    .slick-loading .slick-track {visibility: hidden;}
    .slick-slide {display: none; float: left; height: 100%; min-height: 1px;}
    [dir='rtl'] .slick-slide {float: right;}
    .slick-slide img {display: block;}
    .slick-slide.slick-loading img {display: none;}
    .slick-slide.dragging img {pointer-events: none;}
    .slick-initialized .slick-slide {display: block;}
    .slick-loading .slick-slide {visibility: hidden;}
    .slick-vertical .slick-slide {display: block; height: auto; border: 1px solid transparent;}
    .slick-arrow.slick-hidden {display: none;}
    .customer-logos .slick-track {background: #fff;}
</style>
<script>
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 60000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });

    $('#search_country').on('input',function(e){
        let lists = document.querySelectorAll('.countryList')
        lists.forEach((list) => {
            if(!list.innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                list.classList.add('d-none')
            } else {
                list.classList.remove('d-none')
            }
        })
        //e.preventDefault();
        // var text = $(this).val();
        // console.log(text);
        // var base_url = $("#base_url").val();
        // $.ajax({
        //     type:"post",
        //     cache:false,
        //     url:base_url+"Welcome/searchByCountry",
        //     data:{
        //         country_name:text
        //     },
        //     beforeSend:function(){},
        //     success:function(returndata) {
        //         $('.makeCountryList').html(returndata);
        //         //$('#city').html('<option value="">Select State First</option>');
        //     }
        // });
    })

    $('#search_state').on('input',function(e){
        let lists = document.querySelectorAll('.stateList')
        lists.forEach((list) => {
            if(!list.innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                list.classList.add('d-none')
            } else {
                list.classList.remove('d-none')
            }
        })
    })

    $('#search_city').on('input',function(e){
        let lists = document.querySelectorAll('.cityList')
        lists.forEach((list) => {
            if(!list.innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                list.classList.add('d-none')
            } else {
                list.classList.remove('d-none')
            }
        })
    })
});
$(window).load(function () {
    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(showLocation);
    // } else {
    //     $('#location').html('Geolocation is not supported by this browser.');
    // }
    $('.chosen_country').click(function(){
        $('.showCountry').toggle();
        $('.makeCountryList').toggle();
    })

    $('.chosen_state').click(function(){
        if($('#makeStateList li').text() != ''){
            $('.showState').toggle();
            $('.makeStateList').toggle();
        }
    })

    $('.chosen_city').click(function(){
        if($('#makeCityList li').text() != ''){
            $('.showCity').toggle();
            $('.makeCityList').toggle();
        }
    })
});

// function showLocation(position) {
//     var latitude = position.coords.latitude;
//     var longitude = position.coords.longitude;
//     displayLocation(latitude, longitude);
// }

// function displayLocation(latitude, longitude) {
//     var geocoder;
//     geocoder = new google.maps.Geocoder();
//     var latlng = new google.maps.LatLng(latitude, longitude);
//     geocoder.geocode({'latLng': latlng},
//         function (results, status) {
//             if (status == google.maps.GeocoderStatus.OK) {
//                 if (results[0]) {
//                     var add = results[0].formatted_address;
//                     var value = add.split(",");
//                     count = value.length;
//                     country = value[count - 1];
//                     state = value[count - 2];
//                     city = value[count - 3];
//                     $("#paymentLocation").val(city);
//                 }
//             }
//         }
//     );
// }
</script>
<script>
    //function getState(val) {
    //$('.countryList').click(function(){
    function selectCountry(id) {
        //var selected = $(this).text();
        var selected = id;
        $('.select_countryvalue').text(selected);
        $('#country').val(selected);
        $('.makeCountryList').hide();
        $('.showCountry').hide();
        var base_url = $("#base_url").val();
        $.ajax({
            type:"post",
            cache:false,
            url:base_url+"Welcome/statesByCountry",
            data:{
                country_name:selected
            },
            beforeSend:function(){},
            success:function(returndata) {
                //$('.makeStateList').show();
                $('#makeStateList').html(returndata);
                $('#city').html('<option value="">Select State First</option>');
            }
        });
    }
    //})

    function getCity(val) {
        var base_url = $("#base_url").val();
        var id = val;
        $('.select_statevalue').text(id);
        $('#state').val(id);
        $('.makeStateList').hide();
        $('.showState').hide();
        $.ajax({
            type:"post",
            cache:false,
            url:base_url+"Welcome/citiesByState",
            data:{
                state_name:id
            },
            beforeSend:function(){},
            success:function(returndata) {
                $('#makeCityList').html(returndata);
                $('#city').html('<option value="">Select State First</option>');
            }
        });
    }

    function selectCity(val) {
        $('.select_cityvalue').text(val);
        $('#city').val(val);
        $('.makeCityList').hide();
        $('.showCity').hide();
    }
</script>
