<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else{
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>List of Businesses</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max_height">
    <div class="block no-padding List_Of_Emp Employees_Search_List">
        <div class="container">
            <div class="row no-gape">
                <aside class="col-lg-3 column border-right Employees_Search_Panel">
                    <div class="Employees_Search_Panel_Data">
                        <form method="post" id="filter_form">
                            <div class="widget">
                                <div class="search_widget_job">
                                    <div class="field_w_search">
                                        <input type="text" id="title_keyword" name="title_keyword" placeholder="Search Keywords" value="" />
                                        <i class="la la-search"></i>
                                    </div>
                                    <div class="field_w_search">
                                        <input type="text" name="search_location" id="location" placeholder="All Locations" onchange="filter_job();" value="" autocomplete="off"/>
                                        <i class="la la-map-marker"></i>
                                    </div>
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
                            <div class="widget sub_cat">
                                <h3 class="sb-title closed">Subcategory</h3>
                                <div class="specialism_widget">
                                    <select class="chosen_state" name="subcategory_id" id="subcategory_id" onchange="filter_job();">
                                    </select>
                                </div>
                            </div>
                            <div class="widget">
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
                            </div>
                        </form>
                    </div>
                </aside>
                <div class="col-lg-9 column Employees_Search_Result">
                    <div class="padding-left">
                        <div class="emply-resume-sec">
                            <div id="employer_list"></div>
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
        $('#employer_list').html(createSkeleton(5));
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
        var location = $('#location').val();
        var category = $('#category_id').val();
        var subcategory = $('#subcategory_id').val();
        var days = $('input:radio[name=days]:checked').val();
        $.ajax({
            url: base_url + "home/employerlist_fetchdata/" + page,
            method: "POST",
            dataType: "JSON",
            data: {
                action: action,
                title_keyword: title_keyword,
                location: location,
                category: category,
                subcategory: subcategory,
                days: days,
            },
            success: function (data) {
                $('#employer_list').html(data.employer_list);
                $('#pagination_link').html(data.pagination_link);
            }
        })
    }

    $(document).on('click', '.pagination li a', function (event) {
        event.preventDefault();
        var page = $(this).data('ci-pagination-page');
        filter_data(page);
    });

    $('#title_keyword').keyup(function () {
        filter_data(1);
    });

    $('#location').on('change', function () {
        filter_data(1);
    });

    $('#category_id').on('change', function () {
        filter_data(1);
    });

    $('#subcategory_id').on('change', function () {
        filter_data(1);
    });

    $('input:radio').click(function () {
        filter_data(1);
    });
});
</script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/postjob_list.js')?>"></script>
