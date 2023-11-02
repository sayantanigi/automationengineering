<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right">
                    <!--  <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                    <i class="fas fa-filter"></i>
                </a> -->
                <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Career</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title <span style="color:red;">*</span> <span id="title_err"></span></label>
                                        <input class="form-control" type="text" name="title" id="title" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image <span style="color:red;">*</span> <span id="image_err"></span></label>
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span style="color:red;">*</span> <span id="description_err"></span></label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>


                            </div>   <!-- end row -->



                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return create_career();">Submit</button>
                                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--  end add modal -->

<!--  edit mmodal -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit career</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title <span style="color:red;">*</span> <span id="edit_title_err"></span></label>
                                        <input class="form-control" type="text" name="title" id="edit_title" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>image <span style="color:red;">*</span> <span id="edit_image_err"></span></label>
                                        <input class="form-control" type="file" name="image" id="edit_image">
                                    </div>

                                    <div id="show_img"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span style="color:red;">*</span> <span id="edit_description_err"></span></label>
                                        <textarea class="form-control" name="description1" id="edit_description"></textarea>
                                    </div>
                                </div>


                            </div>


                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="old_image" id="old_image">
                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return update_career();">Save Changes</button>
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

<!--  view mmodal -->
<div id="viewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View career</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div id="show_description"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--  end view modal -->


<script>
var url = '<?= admin_url('manage_home/Career_tips/ajax_manage_page')?>';
var actioncolumn=4;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/career.js')?>"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('description');
CKEDITOR.replace('description1');
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(window).scroll(function(){
    var filter_inputs = $('#filter_inputs');
    var table_wrapper = $('#table_wrapper .row:nth-child(1)');
    var table_header = $('#table thead');
    scroll = $(window).scrollTop();
    if (scroll >= 100) {
        table_wrapper.addClass('sticky_thead');
        table_header.addClass('sticky_thead1');
    } else {
        table_wrapper.removeClass('sticky_thead');
        table_header.removeClass('sticky_thead1');
    }
});

$('#refreshForm').click(function(){
    $('#categorySearch').trigger("reset");
    $('.filter_search_data6').val('').trigger('change');
})
</script>
<style>
    .sticky_thead1 {
    position: sticky;
    top: 96px;
    background: #fff;
    z-index: 100;
}
</style>
