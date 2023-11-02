<div class="page-wrapper">
  <div class="content container-fluid">

    <div class="page-header">
      <div class="row">
        <div class="col">
          <h3 class="page-title"><?= $heading;?></h3>
        </div>
        <div class="col-auto text-right">
          <!-- <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
            <i class="fas fa-filter"></i>
          </a> -->
          <!-- <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i>
          </a> -->
        </div>
      </div>
    </div>


    <div class="card filter-card" id="filter_inputs">
      <div class="card-body pb-0">
        <form action="#" method="post">
          <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label>Category</label>
                <select class="form-control select filter_search_data6" name="">
                  <option value="">Select category</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label>From Date</label>
                <div class="cal-icon">
                 <!--  datetimepicker -->
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
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
               <a class="btn btn-primary btn-block" href="<?= admin_url('Category')?>">Refresh</a>
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
                    <th>Full Name</th>
                    <th>Post Title</th>
                    <th>Duration</th>
                    <th>Cost</th>
                    <th>Date</th>
                    <!-- <th>Action</th> -->
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

             <script>
    var url = '<?= admin_url('Jobsbidding/ajax_manage_page')?>';
    var actioncolumn=5;
</script>
