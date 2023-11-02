<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= base_url('assets/images/resource/mslider1.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
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
    <div class="block no-padding">
        <div class="container">
            <div class="row no-gape">
                <aside class="col-lg-3 column border-right">
                    <form method="post" id="filter_form">
                        <div class="widget">
                            <div class="search_widget_job">
                                <div class="field_w_search">
                                    <input type="text" id="title_keyword" name="title_keyword" placeholder="Search Keywords"  onkeydown="filter_job();"  value="" />
                                    <i class="la la-search"></i>
                                </div>
                                <div class="field_w_search">
                                    <input type="text" name="search_location" id="location" placeholder="All Locations" onchange="filter_job();" value="" autocomplete="off"/>
                                    <i class="la la-map-marker"></i>
                                </div>
                           </div>
                        </div>
                        <div class="widget">
                            <h3 class="sb-title open">Category</h3>
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
                            <h3 class="sb-title open">Subcategory</h3>
                            <div class="specialism_widget" >
                                <div class="simple-checkbox scrollbar" >
                                    <div id="subcategory_list"></div>
                                </div>
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
                </aside>
                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="emply-resume-sec" id="post_list">
                        <?php if(!empty($get_postjob)){
                        foreach($get_postjob as $row) {
                        ?>
                            <div class="emply-resume-list">
                            <?php if(!empty($row->profilePic)){
                                if(!file_exists('uploads/users/'.$row->profilePic)){ ?>
                                <div class="emply-resume-thumb">
                                    <img src="<?php echo base_url('uploads/users/user.png')?>" alt="" />
                                </div>
                                <?php } else{?>
                                <div class="emply-resume-thumb">
                                    <img src="<?php echo base_url('uploads/users/'.$row->profilePic); ?>" alt="" />
                                </div>
                                <?php }} else{?>
                                <div class="emply-resume-thumb">
                                    <img src="<?php echo base_url('uploads/users/user.png')?>" alt="" />
                                </div>
                                <?php }?>
                                <div class="emply-resume-info">
                                    <h3><a href="#" title=""><?php echo $row->post_title ?></a></h3>
                                    <span><?= $row->category_name?></span>
                                    <span><?= $row->sub_category_name?> </span>
                                    <p><i class="la la-map-marker"></i><?= $row->complete_address; ?></p>
                                </div>
                                <div class="shortlists" style="width:50px;">
                                    <a href="<?= base_url('postdetail/'.base64_encode($row->id))?>" title="">View Details <i class="la la-plus"></i></a>
                                </div>
                            </div>
                            <?php } } else{?>
                            <div class="emply-resume-list">
                                <div class="emply-resume-thumb">
                                    <h2>No Data Found</h2>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="emply-resume-sec" id="show"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">

<script type="text/javascript">
function filter_job() {
    var base_url = $("#base_url").val();
    var formData = $('#filter_form').serialize();
    var displayProduct = 5;
    $('#show').html(createSkeleton(displayProduct));
    function createSkeleton(limit){
        var skeletonHTML = '';
        for(var i = 0; i < limit; i++){
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
    $.ajax({
        method:"POST",
        cache:false,
        url:base_url+"Welcome/filter_job",
        data: formData,
        beforeSend:function(){},
        success:function(returndata) {
            $('#post_list').hide();
            $('#show').html(returndata);
        }
    });
}
</script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/postjob_list.js')?>"></script>
