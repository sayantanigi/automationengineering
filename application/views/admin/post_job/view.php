<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
            </div>
        </div>

        <!-- <ul class="nav nav-tabs menu-tabs">
          <li class="nav-item active">
            <a class="nav-link" href="#">General Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Email Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Payment Gateway</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">SMS Gateway</a>
          </li>
        </ul> -->
        <div class="row">
            <!-- <div class="col-xl-3 col-lg-4 col-md-4 settings-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="nav flex-column">
                            <a class="nav-link active" data-toggle="tab" href="#general">General</a>
                            <a class="nav-link" data-toggle="tab" href="#push_notification">Push Notification</a>
                            <a class="nav-link" data-toggle="tab" href="#terms">Terms & Conditions</a>
                            <a class="nav-link mb-0" data-toggle="tab" href="#privacy">Privacy</a>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="tab-content pt-0">
                            <div id="general" class="tab-pane active">
                                <div class="card mb-0">
                                    <!-- <div class="card-header">
                                      <h4 class="card-title">General Settings</h4>
                                    </div> -->
                                    <div class="container">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="<?= admin_url('post_job')?>" class="btn btn-primary" style="float: right;">Back</a>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >Post title</label>
                                                        <p><?= ucfirst($get_post_job->post_title)?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >  Post Duration</label>
                                                        <p><?= $get_post_job->duration; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >  Remuneration</label>
                                                        <p><?= "USD"." ".$get_post_job->charges; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label >  Post Description</label>
                                                        <p><?= " ".$get_post_job->description; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >  User Name</label>
                                                        <p><?= ucfirst($get_post_job->fullname); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >  Category</label>
                                                        <p><?= ucfirst($get_post_job->category_name); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >  Subcategory </label>
                                                        <p><?= ucfirst($get_post_job->sub_category_name); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >  Address </label>
                                                        <p><?= $get_post_job->complete_address; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >  Longitude </label>
                                                        <p><?= $get_post_job->longitude; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >  latitude </label>
                                                        <p><?= $get_post_job->latitude; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label > Application Deadline </label>
                                                        <p><?= date('d-M-Y',strtotime($get_post_job->appli_deadeline)); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div id="push_notification" class="tab-pane">
                              <div class="card mb-0">
                                <div class="card-header">
                                  <h4 class="card-title">Push Notification</h4>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <label>Firebase Server Key</label>
                                    <input type="text" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>APNS Key</label>
                                    <input type="text" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </div> -->

                            <!-- <div id="terms" class="tab-pane">
                              <div class="card mb-0">
                                <div class="card-header">
                                  <h4 class="card-title">Terms & Conditions</h4>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <label>Page Content</label>
                                    <textarea class="form-control content-textarea" rows="4">Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scel erisque the mattis, leo quam aliquet congue justo ut scelerisque. Praesent pharetra, justo ut scelerisque the mattis, leo quam aliquet congue justo ut scelerisque.</textarea>
                                  </div>
                                </div>
                              </div>
                            </div> -->

                            <!-- <div id="privacy" class="tab-pane pt-0">
                              <div class="card mb-0 shadow-none">
                                <div class="card-header">
                                  <h4 class="card-title">Privacy</h4>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <label>Page Content</label>
                                    <textarea class="form-control content-textarea" rows="4">Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scel erisque the mattis, leo quam aliquet congue justo ut scelerisque. Praesent pharetra, justo ut scelerisque the mattis, leo quam aliquet congue justo ut scelerisque.</textarea>
                                  </div>
                                </div>
                              </div>
                            </div> -->
                            <div class="card-body pt-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
