<?php
 if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
     $banner_img=base_url("uploads/banner/".$get_banner->image);
            } else{
       $banner_img=base_url("assets/images/resource/mslider1.jpg");
        } ?>

<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Our Jobs</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max_height">
    <!-- <div class="block no-padding Our_Jobs Employees_Search_List"> -->
    <div class="block no-padding Employees_Search_List">
        <div class="container">
            <div class="row no-gape">
                <aside class="col-lg-3 column border-right Employees_Search_Panel">
                    <div class="Employees_Search_Panel_Data">
                        <form method="post" id="filter_form">
                            <div class="widget">
                                <div class="search_widget_job">
                                    <div class="field_w_search">
                                        <input type="text" id="title_keyword" name="title_keyword" placeholder="Search Keywords"/>
                                        <i class="la la-search"></i>
                                    </div>
                                    <!-- <div class="field_w_search">
                                        <input type="text" name="search_location" id="location" placeholder="All Locations" oninput="getsourceaddress()" value="" />
                                        <i class="la la-map-marker"></i>
                                    </div> -->
                                </div>
                            </div>
                            <div class="widget">
                                <h3 class="sb-title closed">Category</h3>
                                <div class="specialism_widget">
                                    <select class="chosen" name="category_id" id="category_id" onchange="getsubcategory(this.value);filter_job();">
                                        <option value="">Select Category</option>
                                        <?php if(!empty($getcategory)){ foreach($getcategory as $item){?>
                                        <option value="<?= $item->id ?>"><?= ucfirst($item->category_name)?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="widget sub_cat">
                                <h3 class="sb-title open">Subcategory</h3>
                                <div class="specialism_widget" >
                                    <div class="simple-checkbox scrollbar" >
                                        <div id="subcategory_list"></div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="widget sub_cat">
                                <h3 class="sb-title closed">Subcategory</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_state" name="subcategory_id" id="subcategory_id" onchange="filter_job();">
                                    </select>
                                </div>
                            </div>
                            <div class="widget">
                                <h3 class="sb-title closed">Country</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_country" name="country" id="country" onchange="getState(this.value);filter_job();" style="color: #888; font-size: 13px;">
                                        <option value="">Select Country</option>
                                        <?php if(!empty($getcountry)){ foreach($getcountry as $item){?>
                                        <option value="<?= $item->name ?>"><?= ucfirst($item->name)?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="widget state_field">
                                <h3 class="sb-title closed">State</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_state" name="state" id="state" onchange="getCity(this.value);filter_job();">
                                    </select>
                                </div>
                            </div>
                            <div class="widget city_field">
                                <h3 class="sb-title closed">City</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_city" name="city" id="city" onchange="filter_job();">
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="widget">
                                <h3 class="sb-title closed">Last Activity</h3>
                                <div class="specialism_widget">
                                    <div class="simple-checkbox">
                                        <p><input type="radio" name="days" id="22"  onclick="filter_job()" value="one"/><label for="22">Last Hour</label></p>
                                        <p><input type="radio" name="days" id="23" onclick="filter_job()" value="1"/><label for="23">Last 24 hours</label></p>
                                        <p><input type="radio" name="days" id="24" onclick="filter_job()" value="7"/><label for="24">Last 7 days</label></p>
                                        <p><input type="radio" name="days" id="25" onclick="filter_job()" value="14"/><label for="25">Last 14 days</label></p>
                                        <p><input type="radio" name="days" id="26" onclick="filter_job()" value="30"/><label for="26">Last 30 days</label></p>
                                        <p><input type="radio" name="days" id="27" onclick="filter_job()" value="All"/><label for="27">All</label></p>
                                    </div>
                                </div>
                            </div> -->
                            <div class="widget">
                                <h3 class="sb-title closed">Specializations</h3>
                                <div class="specialism_widget">
                                    <div class="dropdown-field">
                                        <select id="example" class="example" name="specialist" multiple>
                                            <option value="">Choose Skills</option>
                                            <?php if(!empty($get_specialist)){
                                            foreach ($get_specialist as $key) {?>
                                            <option value="<?= $key->specialist_name?>"><?= $key->specialist_name?></option>
                                            <?php  } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </aside>
                <div class="col-lg-9 column Employees_Search_Result">
                    <div class="padding-left">
                        <div class="emply-resume-sec">
                            <div id="post_list">
                            </div>
                            <div align="center" id="pagination_link"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
<script>
$(document).ready(function () {
    filter_data(1);
    function filter_data(page) {
        var base_url = $("#base_url").val();
        var displayProduct = 5;
        $('#post_list').html(createSkeleton(displayProduct));
        function createSkeleton(limit) {
            var skeletonHTML = '';
            for (var i = 0; i < limit; i++) {
                skeletonHTML += '<div class="ph-item">';
                skeletonHTML += '<div class="ph-col-4">';
                skeletonHTML += '<div class="ph-picture"></div>';
                skeletonHTML += '</div>';
                skeletonHTML += '<div>';
                skeletonHTML += '<div class="ph-row">';
                skeletonHTML += '<div class="ph-col-12 big"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '</div>';
                skeletonHTML += '</div>';
                skeletonHTML += '</div>';
            }
            return skeletonHTML;
        }
        var action = 'fetch_data';
        var title_keyword = $('#title_keyword').val();
        var category_id = $('#category_id').val();
        //var subcategory_id = get_filter('storage');
        var subcategory_id = $('#subcategory_id').val();
        var days = $('input:radio[name=days]:checked').val();
        var post_id = $('#post_id').val();
        var location = $('#location').val();
        var country = $('#country').val();
        var state = $('#state').val();
        var city = $('#city').val();
        var search_title = $('#search_title').val();
        var search_location = $('#search_location').val();
        var specialist = $('#example').val();
        $.ajax({
            url: base_url + "welcome/fetch_data/" + page,
            method: "POST",
            dataType: "JSON",
            data: {
                action: action,
                title_keyword: title_keyword,
                category_id: category_id,
                post_id: post_id,
                subcategory_id: subcategory_id,
                days: days,
                location: location,
                country: country,
                state: state,
                city: city,
                search_title: search_title,
                search_location: search_location,
                specialist: specialist,
            },
            success: function (data) {
                //$('#title_keyword').val(data.keyword);
                // console.log(data.postlist);
                $('#location').val(data.keyword_location);
                $('#post_list').html(data.postlist);
                $('#pagination_link').html(data.pagination_link);
                moreDeatailsText();
            }
        })
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    $(document).on('click', '.pagination li a', function (event) {
        event.preventDefault();
        var page = $(this).data('ci-pagination-page');
        filter_data(page);
    });

    $('.common_selector').click(function () {
        filter_data(1);
    });

    $('#title_keyword').keyup(function () {
        filter_data(1);
    });

    $('#location').on('change', function () {
        filter_data(1);
    });

    $('input:radio').click(function () {
        filter_data(1);
    });

    $('#category_id').on('change', function () {
        filter_data(1);
    });

    $('#subcategory_id').on('change', function () {
        filter_data(1);
    });

    $('#country').on('change', function () {
        filter_data(1);
    });

    $('#state').on('change', function () {
        filter_data(1);
    });

    $('#city').on('change', function () {
        filter_data(1);
    });

    $('#example').on('change', function () {
        filter_data(1);
    });
});

function moreDeatailsText() {
    var showChar = 194;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.moreDetails p').each(function() {
		var content = $(this).html();
        //alert(content);
		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
}
</script>
<style>
a.morelink {
	text-decoration:none;
	outline: none;
}
.morecontent span {
	display: none;

}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/postjob_list.js')?>"></script>

<script>
    function MoreDetailsTxt(id) {
    //$(".MoreTxt_"+id).toggle();
    $(".MoreDetailsTxt_"+id).toggleClass('MoreDetailsTxtShow');
}
</script>
