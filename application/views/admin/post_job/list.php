<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right">

                    <!--  <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i>
                </a> -->
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
                                    <th style="width: 165px">Post Title</th>
                                    <th>Job Category</th>
                                    <th>Duration</th>
                                    <th style="width: 95px;">Budget</th>
                                    <th>Status</th>
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

<script>
var url = '<?= admin_url('Post_job/ajax_manage_page')?>';
var actioncolumn=6;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/rating_type.js')?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#table td a:nth-child(3)").attr("href", "javascript:void(0)")
})
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
function deleteJobpost(jobid) {
    var admin_url=$('#admin_url').val();
    var jobid = jobid;
    $.confirm({
	    title: 'Confirm!',
	    content: confirmTextDelete,
	    buttons: {
	        confirm: function () {
				$(".id"+jobid).fadeOut();
				var datastring="jobid="+jobid;
				$.ajax({
					type:"POST",
					url:admin_url+'deletepostdetail',
					data:datastring,
					cache:false,
					success:function(returndata) {
						if(returndata = 1){
							location.reload();
							table.draw();
						}
					}
				});
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
</script>
<style>
    .sticky_thead1 {
    position: sticky;
    top: 96px;
    background: #fff;
    z-index: 100;
}
</style>
