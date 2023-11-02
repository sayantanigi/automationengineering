<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Services_model');
    }

    function index()
    {

        $header = array('title' => 'service');
        $data = array(
            'heading' => 'Services List',
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/service/list',$data);
        $this->load->view('admin/footer');
    }

    function ajax_manage_page()
    {
        $GetData = $this->Services_model->get_datatables();
        if(empty($_POST['start']))
        {

            $no=0;
        }
        else{
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row)
        {

            //  $btn = ''.anchor(admin_url('users/view/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>view</span>');
            // $btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->id.')">Delete</span>';

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucfirst($row->username);
            $nestedData[] = ucfirst($row->service_name);
            $nestedData[] = $row->category_name;
            $nestedData[] = $row->sub_category_name;
            $nestedData[] = date('d-M-Y',strtotime($row->created_date));
            // $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Services_model->count_all(),
            "recordsFiltered" => $this->Services_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    function view($id)
    {
        $con="postjob.id='".base64_decode($id)."'";
        $get_post_job=$this->Post_job_model->viewdata($con);

        $header = array('title' => 'Post Job');
        $data = array(
            'heading' => 'Post Job',
            'get_post_job' => $get_post_job,
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/post_job/view',$data);
        $this->load->view('admin/footer');
    }

    public function change_status()
    {
        if($_POST['status']=='1')
        {
            $statuss='0';

        }
        else if($_POST['status']=='0'){
            $statuss='1';

        }
        $data=array(
            'status'=>$statuss,
        );
        $this->Crud_model->SaveData("users",$data,"userId='".$_POST['id']."'");

    }

    public function delete()
    {
        if(isset($_POST['cid']))
        {
            $this->Crud_model->DeleteData('users',"userId='".$_POST['cid']."'");
        }
    }

}//end controller

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
