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
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Skill Set</label>
                                <select class="form-control select filter_search_data6" name="">
                                    <option value="">Select Skill Set</option>
                                    <?php if(!empty($get_specialist)){
                                        foreach($get_specialist as $item){ ?>
                                        <option value="<?= $item->id?>"><?= ucfirst($item->specialist_name)?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Created Date</label>
                                    <div class="cal-icon">
                                        <!--  datetimepicker -->
                                        <input class="form-control filter_search_data5" type="date" name="from_date" value="">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control  filter_search_data7" type="date" name="to_date" value="">
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <!-- <a class="btn btn-primary btn-block" href="<?= admin_url('Specialist')?>">Refresh</a> -->
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
                                            <th>Skill Set Name</th>
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
<!--  Add mmodal -->
<div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Skill Set</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Skill Set Name <span style="color:red;">*</span> <span id="specialist_err"></span></label>
                                <input class="form-control" type="text" name="specialist_name" id="specialist_name">
                            </div>
                            <div class="form-group">
                                <label>Skill Set Image</label>
                                <input class="form-control" type="file" name="specialist_image" id="specialist_image">
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return create_specialist();">Add Skill Set</button>
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
                <h4 class="modal-title">Edit Skill Set</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Skill Set Name <span style="color:red;">*</span> <span id="edit_specialist_err"></span></label>
                                <input class="form-control" type="text" name="specialist_name" id="edit_specialist_name">
                            </div>
                            <div class="form-group">
                                <label>Skill Set Image</label>
                                <input class="form-control" type="file" name="specialist_image" id="edit_specialist_image">
                            </div>
                            <div id="show_img"> </div>
                            <input type="hidden" name="old_image" id="old_image">
                            <input type="hidden" name="id" id="id">
                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return update_specialist();">Save Changes</button>
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
var url = '<?= admin_url('Specialist/ajax_manage_page')?>';
var actioncolumn=3;
</script>
<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/specialist.js')?>"></script>
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
