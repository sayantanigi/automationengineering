<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right">
                    <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                        <i class="fas fa-filter"></i>
                    </a>
                    <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card filter-card" id="filter_inputs" style="display: block">
            <div class="card-body pb-0">
                <form id="categorySearch" action="#" method="post">
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control select filter_search_data6" name="">
                                    <option value="">Select Subcategories</option>
                                    <?php if(!empty($get_subcategory)){
                                    foreach($get_subcategory as $item){ ?>
                                    <option value="<?= $item->id?>"><?= ucfirst($item->sub_category_name)?></option>
                                    <?php  } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Created Date</label>
                                <div class="cal-icon2">
                                    <!--  datetimepicker -->
                                    <input class="form-control  filter_search_data5" type="date" name="from_date" value="">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>To Date</label>
                                <div class="cal-icon2">
                                    <input class="form-control  filter_search_data7" type="date" name="to_date" value="">
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <!-- <a class="btn btn-primary btn-block" href="<?= admin_url('sub_category')?>">Refresh</a> -->
                                <a class="btn btn-primary btn-block" id="refreshForm" href="javascript:void(0)" style="line-height: 35px;">Refresh</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                                <thead class="sticky">
                                    <tr>
                                        <th>#</th>
                                        <th>Subcategory</th>
                                        <th>Category</th>
                                        <th>Created Date</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Sub Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Category Name <span style="color:red;">*</span> <span id="category_err"></span></label>
                                <select class="form-control" name="category_id" value="" id="category_id">
                                    <option value="">Select category</option>
                                    <?php if(!empty($get_category)){
                                    foreach($get_category as $item){ ?>
                                    <option value="<?= $item->id?>"><?= ucfirst($item->category_name)?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub Category <span style="color:red;">*</span> <span id="sub_category_name_id_err"></span></label>
                                <input class="form-control" type="text" name="sub_category_name" id="sub_category_name_id">
                            </div>
                            <div class="form-group">
                                <label>Sub Category Image</label>
                                <input class="form-control" type="file" name="image" id="image">
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return create_subcategory();">Add Sub Category</button>
                                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="return getvalidation()">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
<!--  end add modal -->
<!--  edit mmodal -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Sub Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Category Name <span style="color:red;">*</span> <span id="edit_category_err"></span></label>
                                <select class="form-control" name="category_id" value="" id="edit_category_id">
                                    <option value="">Select category</option>
                                    <?php
                                    if(!empty($get_category)) {
                                    foreach($get_category as $item){ ?>
                                        <option value="<?= $item->id?>"><?= ucfirst($item->category_name)?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub Category <span style="color:red;">*</span> <span id="edit_sub_category_name_id_err"></span></label>
                                <input class="form-control" type="text" name="sub_category_name" id="edit_sub_category_name_id">
                            </div>
                            <div class="form-group">
                                <label>Sub Category Image</label>
                                <input class="form-control" type="file" name="image" id="edit_image">
                            </div>
                            <div id="show_img"> </div>
                            <input type="hidden" name="old_image" id="old_image">
                            <input type="hidden" name="id" id="id">
                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return update_category();">Save Changes</button>
                                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  end edit modal -->
<script>
var url = '<?= admin_url('Sub_category/ajax_manage_page')?>';
var actioncolumn=4;
</script>
<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/subcategory.js')?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(window).scroll(function(){
    var filter_inputs = $('#filter_inputs');
    var table_wrapper = $('#table_wrapper .row:nth-child(1)');
    var table_header = $('#table thead');
    scroll = $(window).scrollTop();
    if (scroll >= 100) {
        filter_inputs.addClass('sticky_thead');
        table_wrapper.addClass('sticky_thead1');
        table_header.addClass('sticky_thead2');
    } else {
        filter_inputs.removeClass('sticky_thead');
        table_wrapper.removeClass('sticky_thead1');
        table_header.removeClass('sticky_thead2');
    }
});

$('#refreshForm').click(function(){
    $('#categorySearch').trigger("reset");
    $('.filter_search_data6').val('').trigger('change');
})
</script>