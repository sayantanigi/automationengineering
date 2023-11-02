<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right">
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
                                        <th>Company Logo</th>
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
                <h4 class="modal-title">Add Partner Companies Logo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Company Name <span style="color:red;">*</span> <span id="name_err"></span></label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Enter Company Name">
                            </div>
                            <div class="form-group">
                                <label>Company Logo <span style="color:red;">*</span> <span id="logo_err"></span></label>
                                <input class="form-control" type="file" name="logo" id="logo">
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return create_logo();">Submit</button>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Company Logo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Company Name <span style="color:red;">*</span> <span id="edit_name_err"></span></label>
                                <input class="form-control" type="text" name="name" id="edit_name" placeholder="Enter Company Name">
                            </div>
                            <div class="form-group">
                                <label>Company Logo <span style="color:red;">*</span> <span id="edit_logo_err"></span></label>
                                <input class="form-control" type="file" name="logo" id="edit_logo">
                            </div>
                            <div id="show_img"> </div>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="old_image" id="old_image">
                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return update_logo();">Save Changes</button>
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
var url = '<?= admin_url('manage_home/Company_logo/ajax_manage_page')?>';
var actioncolumn=2;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/company_logo.js')?>"></script>
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
