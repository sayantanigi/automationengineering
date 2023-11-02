<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else{
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
}
@$subcategory_id=$this->uri->segment(2);
@$postid=base64_decode($subcategory_id);
?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Search Result</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block no-padding Employees_Search_List">
        <div class="container">
            <div class="row no-gape">
                <aside class="col-lg-3 column border-right Employees_Search_Panel">
                    <div class="Employees_Search_Panel_Data">
                        <form method="post">
                            <div class="widget">
                                <div class="search_widget_job">
                                    <div class="field_w_search">
                                        <input type="text" id="title_keyword" name="title_keyword" placeholder="Search Keywords" value="" />
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
                                    <select class="chosen" name="category_id" id="category_id"
                                        onchange="getsubcategory(this.value);">
                                        <option value="">Select Category</option>
                                        <?php if(!empty($getcategory)){ foreach($getcategory as $item){?>
                                        <option value="<?= $item->id ?>"><?= ucfirst($item->category_name)?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="widget Last_widget sub_cat">
                                <h3 class="sb-title open">Subcategory</h3>
                                <div class="specialism_widget">
                                    <div class="simple-checkbox scrollbar">
                                        <div id="subcategory_list"></div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="widget sub_cat">
                                <h3 class="sb-title closed">Subcategory</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_state" name="subcategory_id" id="subcategory_id">
                                    </select>
                                </div>
                            </div>
                            <div class="widget">
                                <h3 class="sb-title open">Country</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_country" name="country" id="country" onchange="getState(this.value);">
                                        <option value="">Select Country</option>
                                        <?php if(!empty($countries)){ foreach($countries as $item){?>
                                        <option value="<?= $item->name ?>" <?php if(@$item->name == @$_POST['country']){ echo "selected"; } ?>><?= ucfirst($item->name)?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="widget state_field1">
                                <h3 class="sb-title open">State</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_state" name="state" id="state" onchange="getCity(this.value);">
                                        <option value="">Select State</option>
                                        <?php if(!empty($states)){ foreach($states as $item){?>
                                        <option value="<?= $item->name ?>" <?php if(@$item->name == @$_POST['state']){ echo "selected"; } ?>><?= ucfirst($item->name)?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="widget city_field1">
                                <h3 class="sb-title open">City</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_city" name="city" id="city">
                                        <option value="">Select City</option>
                                        <?php if(!empty($cities)){ foreach($cities as $item){?>
                                        <option value="<?= $item->name ?>" <?php if(@$item->name == @$_POST['city']){ echo "selected"; } ?>><?= ucfirst($item->name)?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="widget">
                                <h3 class="sb-title closed">Last Activity</h3>
                                <div class="specialism_widget">
                                    <div class="simple-checkbox">
                                        <p><input type="radio" name="days" id="22" value="one" /><label for="22">Last Hour</label></p>
                                        <p><input type="radio" name="days" id="23" value="1" /><label for="23">Last 24 hours</label></p>
                                        <p><input type="radio" name="days" id="24" value="7" /><label for="24">Last 7 days</label></p>
                                        <p><input type="radio" name="days" id="25" value="14" /><label for="25">Last 14 days</label></p>
                                        <p><input type="radio" name="days" id="26" value="30" /><label for="26">Last 30 days</label></p>
                                        <p><input type="radio" name="days" id="27" value="All" /><label for="27">All</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php if(!empty($postid)){?>
                            <input type="hidden" name="post_id" id="post_id" value="<?= @$postid?>">
                            <?php } else{?>
                            <input type="hidden" name="post_id" id="post_id" value="">
                            <?php } ?>
                            <?php  if(isset($_POST['search_title']) &&!empty($_POST['search_title']) || isset($_POST['search_location']) &&!empty($_POST['search_location']) || isset($_POST['country']) &&!empty($_POST['country']) || isset($_POST['state']) &&!empty($_POST['state']) || isset($_POST['city']) &&!empty($_POST['city']) ){ ?>
                            <input type="hidden" name="search_title" id="search_title" value="<?= @$_POST['search_title']?>">
                            <input type="hidden" name="search_location" id="search_location" value="<?= @$_POST['search_location']?>">
                            <input type="hidden" name="country" id="country" value="<?= @$_POST['country']?>">
                            <input type="hidden" name="state" id="state" value="<?= @$_POST['state']?>">
                            <input type="hidden" name="city" id="city" value="<?= @$_POST['city']?>">
                            <?php } else{?>
                            <input type="hidden" name="search_title" id="search_title" value="">
                            <input type="hidden" name="search_location" id="search_location" value="">
                            <?php  } ?>
                        </form>
                    </div>
                </aside>

                <div class="col-lg-9 column Employees_Search_Result">
                    <div class="padding-left">
                        <div class="emply-resume-sec">
                            <div id="post_list"></div>
                        </div>
                        <div id="pagination_link" style="float:right;">
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
        var subcategory_id = get_filter('storage');
        var days = $('input:radio[name=days]:checked').val();
        var post_id = $('#post_id').val();
        var location = $('#location').val();
        var country = $('#country').val();
        var state = $('#state').val();
        var city = $('#city').val();
        var search_title = $('#search_title').val();
        var search_location = $('#search_location').val();
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
                search_location: search_location
            },
            success: function (data) {
                //console.log(data);
                $('#title_keyword').val(data.keyword);
                $('#location').val(data.keyword_location);
                $('#post_list').html(data.postlist);
                $('#pagination_link').html(data.pagination_link);
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

    $('#title_keyword').keydown(function () {
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
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/postjob_list.js')?>"></script>

<script>
    function MoreDetailsTxt(id) {
    //$(".MoreTxt_"+id).toggle();
    $(".MoreDetailsTxt_"+id).toggleClass('MoreDetailsTxtShow');
}
</script>
