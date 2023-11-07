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
                    <!-- <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus"></i>
                    </a> -->
                </div>
                <!-- <div class="col-auto text-right"></div> -->
            </div>
        </div>


        <div class="card filter-card" id="filter_inputs" style="display: block !important;">
            <div class="card-body pb-0">
                <form action="#" method="post">
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>User type</label>
                                <select class="form-control select filter_search_data6" name="" id='userPaymentListA'>
                                    <option value="" disabled >Select Type</option>
                                    <option value="" selected>All</option>
                                    <option value="1">Expert</option>
                                    <option value="2">Business</option>

                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>From Date</label>
                                <div class="cal-icon">
                                    <input class="form-control  filter_search_data5" type="date" name="from_date" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>To Date</label>
                                <div class="cal-icon">
                                    <input class="form-control  filter_search_data7" type="date" name="to_date" value="">
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <a class="btn btn-primary btn-block" href="<?= admin_url('payment')?>">Refresh</a>
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
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subscription plan</th>
                                        <th class="changeName">Users Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Amount</th>
                                        <th>Payment Date</th>
                                        <th>Expiry Date</th>
                                        <!-- <th>Subscription Status</th> -->
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
<!-- Modal -->
<div class="modal fade" id="payment_detail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transaction detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
          <div class="form-group">
            <label for="transaction_id" class="col-form-label">Transaction Id:</label>
            <input type="text" class="form-control" id="transaction_id" readonly>
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Current Subscription Status:</label>
            <input type="text" class="form-control" id="status" readonly>
         </div>
         <a href="" id="download_invoice">Download Invoice</a>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
var url = '<?= admin_url('Payment/ajax_manage_page')?>';
var actioncolumn=8;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/user.js')?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#userPaymentListA').on('change', function() {
        var value = $('#userPaymentListA').val();
        if(value == '1') {
            $('.changeName').text('Freelance Name');
        } else if (value == '2') {
            $('.changeName').text('Vendor Name');
        } else {
            $('.changeName').text('Users Name');
        }
    })
})
</script>
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
