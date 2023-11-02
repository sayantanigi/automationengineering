<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobsbidding extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelLists/Jobsbid_model');
    }

    function index()
  	{

  		$header = array('title' => 'jobsBid');
  		$data = array(
              'heading' => 'Jobs Bid List',
          );
          $this->load->view('admin/header', $header);
          $this->load->view('admin/sidebar');
          $this->load->view('admin/table_list/jobbid_list',$data);
          $this->load->view('admin/footer');
  	}

  function ajax_manage_page()
  	{
  		 $GetData = $this->Jobsbid_model->get_datatables();
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

               $btn = ''.anchor(admin_url('users/view/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>view</span>');
             // $btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')">Delete</span>';

  	            $no++;
  	            $nestedData = array();
  	          $nestedData[] = $no;
  	            $nestedData[] = if(!empty($row->fullname)){ echo ucfirst($row->fullname);} else{ echo $row->username};
                $nestedData[] = ucfirst($row->post_title);
                $nestedData[] = $row->duration;
                $nestedData[] = 'USD'.' '.$row->cost;
                $nestedData[] = date('d-M-Y',strtotime($row->created_date));
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



}//end controller
