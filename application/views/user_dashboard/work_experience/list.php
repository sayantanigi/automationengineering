<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url(assets/images/resource/mslider1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header" style="padding-top: 90px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dashboardhak">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Work Experience</h2>
                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Work Experience</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-sm-12 display-table-cell v-align">
    <div class="user-dashboard">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12" style="text-align: right;">
                <a href="<?php echo base_url('add-workexperience')?>" class="btn btn-primary Work_Btn" style="border-radius: 40px; letter-spacing: 0;">Add Work Experience</a>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cardak custom-cardak">
                    <span class="text-success-msg f-20" style="text-align: center;">
                        <?php if($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                            unset($_SESSION['message']);
                        } ?>
                    </span>
                    <table class="table table-modific">
                        <tbody>
                        <?php  if(!empty($workexperience_list)) {
                        $i=1;
                        foreach ($workexperience_list as $row) {
                        ?>
                        <tr>
                            <td class="table-modific-td">
                                <table class="custom-table">
                                    <tr>
                                        <td class="heading"><?= ucfirst($row->designation); ?> <div>at</div> <?= ucfirst($row->company_name); ?></td>
                                        <td class="btn-option">
                                            <a href="<?= base_url('update-workexperience/'.base64_encode($row->id));?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            <!-- <a href="<?= base_url('user/Dashboard/delete_workexperience/'.$row->id);?>" onclick="if(confirm('Are you sure you want to Delete?')) commentDelete(1); return false"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
                                            <a href="javascript:void(0)" onclick="deleteWorkExperience(<?= $row->id?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="year"><?= date('d-m-Y',strtotime($row->from_date)); ?> to <?= date('d-m-Y',strtotime($row->to_date)); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="desc"><?= $row->description; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="height"></td>
                        </tr>
                        <?php $i++;} } else {?>
                            <tr>
                                <td colspan="6">
                                    <center>No Data Found</center>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
</section>
<script>
function deleteWorkExperience(id) {
	var w_id = id;
    $.confirm({
	    title: 'Confirm!',
	    content: confirmTextDelete,
	    buttons: {
	        confirm: function () {
                var base_url = $('#base_url').val();
                $.ajax({
                    url:base_url+"user/dashboard/delete_workexperience",
                    method:"POST",
                    data:{id: w_id},
                    beforeSend : function(){
                        $("#loader").show();
                    },
                    success:function(data) {
                        if (data == '1'){
                            setTimeout(function () {
                                location.reload(true);
                            }, 3000);
                        } else {
                            $('#err-messages').show();
                            setTimeout(function () {
                                window.scroll({top: 0, behavior: "smooth"})
                            }, 7000);
                            setTimeout(function () {
                                $('#err-messages').hide();
                            }, 9000);
                            setTimeout(function () {
                                location.reload(true);
                            }, 10000);
                        }
                    }

                })
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
</script>
