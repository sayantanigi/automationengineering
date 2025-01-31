<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobsbidding extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ModelLists/Jobsbid_model');
    }

    function index() {
  		$header = array('title' => 'jobs Bid');
  		$data = array(
            'heading' => 'Jobs Bid List',
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/table_list/jobbid_list',$data);
        $this->load->view('admin/footer');
  	}

    function ajax_manage_page() {
        $GetData = $this->Jobsbid_model->get_datatables();
        if(empty($_POST['start'])) {
            $no=0;
        } else {
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row) {
            if(!empty($row->fullname)){
                $name=$row->fullname;
            } else {
                $name= $row->username;
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            if(isset($row->post_job_id)){
                $btn = ''.anchor(base_url('postdetail/'.base64_encode($row->post_job_id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i></span>','target=_blank');
                $btn .= '<button class="btn btn-sm btn-danger mr-2" type="button" onClick="delete_detail(\''.$row->post_job_id.'\');"><i class="fa fa-trash mr-1"></i></button>';
            } else {
                $btn='';
            }
            $nestedData[] =ucfirst($row->post_job_name);
            $nestedData[] =ucfirst($row->job_bid_name);
            if(isset($row->post_title)){
                $nestedData[] = ucfirst($row->post_title);
            } else {
                $nestedData[] = '';
            }
            $nestedData[] = $row->duration;
            $nestedData[] = 'USD'.' '.$row->bid_amount;
            $nestedData[] = date('d-m-Y',strtotime($row->created_date));
            $nestedData[] = $row->bidding_status;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Jobsbid_model->count_all(),
            "recordsFiltered" => $this->Jobsbid_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function delete() {
        if(isset($_POST['id'])) {
            $this->Crud_model->DeleteData('chat',"postjob_id='".$_POST['id']."'");
            $this->Crud_model->DeleteData('job_bid',"postjob_id='".$_POST['id']."'");
            $this->session->set_flashdata('message', 'Data deleted successfully');
            echo 1; exit;
        } else {
            $this->session->set_flashdata('message', 'Something went wrong! Please try again later');
            echo 0; exit;
        }
    }
}