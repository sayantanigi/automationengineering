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
            //$btn = ''.anchor(admin_url('jobsbidding/view/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>view</span>');
            //$btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')">Delete</span>';
            if(!empty($row->fullname)){
                $name=$row->fullname;
            } else {
                $name= $row->username;
            }
            // if(!empty($row->bidding_status=='Accept')){
            //     $bidding_status='Accepted';
            // }
            // else if(!empty($row->bidding_status=='Reject')){
            //     $bidding_status='Rejected';

            // }
            // else {
            //     $bidding_status= $row->bidding_status;
            // }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            // $nestedData[] =ucfirst($name);
            $btn = ''.anchor(base_url('postdetail/'.base64_encode($row->post_job_id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i></span>','target=_blank');
            $nestedData[] =ucfirst($row->post_job_name);
            $nestedData[] =ucfirst($row->job_bid_name);
            //$nestedData[] = ucfirst($row->post_title).$btn;
            $nestedData[] = ucfirst($row->post_title);
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
}
