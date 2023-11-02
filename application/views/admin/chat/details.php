<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right"></div>
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
                        <div class="table-responsive Chat-Table">
                            <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                                <thead></thead>
                                <tbody>
                                    <div id="frame">
                                        <div class="content">
                                            <div id="message_list" style="height:650px;  overflow-y: scroll;overflow-y: hidden;">
                                                <div class="messages">
                                                    <ul style="padding: 0;">
                                                    <?php echo $chat_detail;?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<style>
.chat-post-title {text-align: center;}
.chat-details {text-align: center; font-size: 26px}
</style>
