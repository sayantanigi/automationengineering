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
                                        <th>Page Name</th>
                                        <th>Banner Image</th>
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
                <h4 class="modal-title">Add Banner</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Page Name</label>
                                <select class="form-control" name="page_name" id="page_name">
                                    <option value="">Select Page Name Page</option>
                                    <option value="Home Top">Home Top Page</option>
                                    <option value="Home Middle">Home Middle Page</option>
                                    <option value="Vendors">Vendors Page</option>
                                    <option value="Experts">Experts Page</option>
                                    <option value="Our Jobs">Our Jobs Page</option>
                                    <option value="Pricing">Pricing Page</option>
                                    <option value="About Us Top">About Us Top Page</option>
                                    <option value="About Us Middle">About Us Middle Page</option>
                                    <option value="Contact Us">Contact Us Page</option>
                                    <option value="Privacy policy">Privacy policy Page</option>
                                    <option value="Term and conditions">Term and conditions Page</option>
                                    <option value="Sign Up">Sign Up Page</option>
                                    <option value="Login">Login Page</option>
                                    <option value="Post Jobs">Post Jobs Page</option>
                                    <option value="Vendor Details">Vendor Details Page</option>
                                    <option value="Experts Details">Experts Details Page</option>
                                    <option value="Post Job Details">Post Job Details Page</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label>Heading</label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Enter Heading">
                            </div> -->
                            <div class="form-group">
                                <label>Image <span style="color:red;">*</span>(size : 1900 X 800) <span id="image_err"></span></label>
                                <input class="form-control" type="file" name="image" id="image">
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return create_banner();">Submit</button>
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
                <h4 class="modal-title">Edit Banner</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Page Name</label>
                                <select class="form-control" name="edit_page_name" id="edit_page_name">
                                    <option value="">Select Page Name Page</option>
                                    <option value="Home Top">Home Top Page</option>
                                    <option value="Home Middle">Home Middle Page</option>
                                    <option value="Vendors">Vendors Page</option>
                                    <option value="Experts">Experts Page</option>
                                    <option value="Our Jobs">Our Jobs Page</option>
                                    <option value="Pricing">Pricing Page</option>
                                    <option value="About Us Top">About Us Top Page</option>
                                    <option value="About Us Middle">About Us Middle Page</option>
                                    <option value="Contact Us">Contact Us Page</option>
                                    <option value="Privacy policy">Privacy policy Page</option>
                                    <option value="Term and conditions">Term and conditions Page</option>
                                    <option value="Sign Up">Sign Up Page</option>
                                    <option value="Login">Login Page</option>
                                    <option value="Post Jobs">Post Jobs Page</option>
                                    <option value="Vendor Details">Vendor Details Page</option>
                                    <option value="Experts Details">Experts Details Page</option>
                                    <option value="Post Job Details">Post Job Details Page</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label>Heading </label>
                                <input class="form-control" type="text" name="name" id="edit_name" placeholder="Enter Heading">
                            </div> -->
                            <div class="form-group">
                                <label>Image <span style="color:red;">*</span> (size : 1900 X 800)<span id="edit_image_err"></span></label>
                                <input class="form-control" type="file" name="image" id="edit_image">
                            </div>
                            <div id="show_img"> </div>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="old_image" id="old_image">
                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return update_banner();">Save Changes</button>
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
var url = '<?= admin_url('manage_home/Banner/ajax_manage_page')?>';
var actioncolumn=3;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/banner.js')?>"></script>
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
