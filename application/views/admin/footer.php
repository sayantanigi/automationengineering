<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/js/jquery-3.5.0.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/js/popper.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/js/moment.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url(); ?>dist/assets/plugins/datatables/datatables.min.js"></script>
<script src="<?= base_url('dist/assets/js/bootstrapValidator.min.html')?>"></script>
<script src="<?= base_url('dist/assets/js/select2.min.js')?>"></script>
<script src="<?= base_url('dist/assets/js/admin.js')?>"></script>
<!-- server side table script -->
<script src="<?php echo base_url('dist/admin_assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
<script src="<?php echo base_url('dist/admin_assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('dist/admin_assets/plugins/bootstrap-select/bootstrap-select.min.js')?>"></script>
<script src="<?php echo base_url('dist/admin_assets/plugins/multiselect/js/jquery.multi-select.js')?>"></script>
<!-- end server side table script -->
<input type="hidden" name="admin_url" id="admin_url" value="<?= admin_url();?>">
<script src="<?= base_url();?>dist/assets/notify/notify.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
// alert();
$(document).ready(function(){
    var sessionMessage = '<?php if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); unset($_SESSION['message']); } ?>';
    if(sessionMessage==null || sessionMessage=="" ){ return false;}
    $.notify(sessionMessage,{ position:"top right",className: 'success' });//session msg
});
</script>

<script type="text/javascript" language="javascript" class="init">

//Confirmation box for admin panel
var confirmTextDelete = 'Are you sure you want to delete this record?';
var confirmChangeStatus = 'Are you sure you want to change the status?';
var userEmailVerification = 'Are you sure you want to verify this user?';

$(document).ready(function() {
    $(".msghide").fadeOut(8000);
    table = $('.example_datatable').DataTable({
        dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "oLanguage": {
            "sProcessing": "<img src='<?= base_url()?>dist/admin_assets/server_side/media/images/ajax-loader.gif'>"
        },
        "stateSave": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [], //Initial no order.
        "lengthMenu" : [[10,25, 100,200,500,1000,2000], [10,25, 100,200,500,1000,2000 ]],"pageLength" : 10,
        "ajax": {
            "url": url,
            "type": "POST",
            "data": function(d) {
                d.Foo = 'gmm';
                d.select_all = $(".select_all").is(":checked");
                d.SearchData = $(".filter_search_data").val();
                d.SearchData1 = $(".filter_search_data1").val();
                d.SearchData2 = $(".filter_search_data2").val();
                d.SearchData3 = $(".filter_search_data3").val();
                d.SearchData4 = $(".filter_search_data4").val();
                d.SearchData5 = $(".filter_search_data5").val();
                d.SearchData6 = $(".filter_search_data6").val();
                d.SearchData7 = $(".filter_search_data7").val();
                d.SearchData8 = $(".filter_search_data8").val();
                d.SearchData9 = $(".filter_search_data9").val();
                d.SearchData10 = $(".filter_search_data10").val();
                d.FormData = $(".filter_data_form").serializeArray();
            },
        },
        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [ actioncolumn ], //first column / numbering column
            "orderable": false, //set not orderable
            }],
        <?php if(!empty($show)){ ?>
            "fnDrawCallback": function() {
                var api = this.api()
                var json = api.ajax.json();
                $(".append_ids").val(json.ids);
            },
        <?php } ?>
    });

    $(".filter_search_data4").change(function(){
        table
        .draw();
    });

    $(".filter_search_data5").change(function(){
        table
        .draw();
    });

    $(".filter_search_data6").change(function(){
        table
        .draw();
    });

    $(".filter_search_data7").change(function(){
        table
        .draw();
    });

    $(".filter_search_data8").change(function(){
        table
        .draw();
    });

    $(".filter_search_data9").change(function(){
        table
        .draw();
    });

    $(".filter_search_data10").change(function(){
        table
        .draw();
    });
});

function view_detail(transaction_id,status,invoice_pdf){
    $("#transaction_id").val(transaction_id);
    $("#status").val(status);
    $("#download_invoice").attr("href", invoice_pdf);
    $("#payment_detail_modal").modal('show');
}

function imageFile() {
        // alert("hi");
    $('#image').change(function () {
        var files = this.files;
        var reader = new FileReader();
        name=this.value;
        //validation for photo upload type
        var filetype = name.split(".");
        ext = filetype[filetype.length-1];  //alert(ext);return false;
        if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='img') && !(ext=='JPEG')) {
            $("#image_err").html("Please select proper type like jpg, png, jpeg image");
            setTimeout(function(){$("#image_err").html("&nbsp;")},8000);
            $("#image").val("");
            return false;
        }
        reader.readAsDataURL(files[0]);
    });
}
//Timepicker
$('.timepicker').timepicker({
    showInputs: false
})

$( ".dob" ).datepicker({
    defaultDate: "today",
    endDate: 'today',
    format: 'yyyy-mm-dd',
    minDate:0,
    endDate: "today",
    changeMonth: true,
    changeYear: true,
    autoclose: true
});

$( ".datepick" ).datepicker({
    /*endDate: 'today',*/
    format: 'yyyy-mm-dd',
    minDate: 'today',
    /* endDate: "today",*/
    changeMonth: true,
    changeYear: true,
    autoclose: true
});

$(document).ready(function(){
    $('.select2').select2();
    var dob_n =$("#dob").val();
    if (dob_n!="0000:00:00" && dob_n!=undefined) {
        ageCalculator(dob_n);
    } else {
    }
});

$('.dateee').datepicker({
    multidate: true,
    format: 'dd-mm-yyyy',
    multidate:3,
    closeOnDateSelect:true
});

$('.datepicker_date').datepicker({
    // multidate: true,
    format: 'dd-mm-yyyy',
    endDate: "today",
    changeMonth: true,
    changeYear: true,
    autoclose: true
});

$('.datepicker_date1').datepicker({
    // multidate: true,
    format: 'dd-mm-yyyy',
    changeMonth: true,
    changeYear: true,
    autoclose: true
});
</script>

</body>
</html>
