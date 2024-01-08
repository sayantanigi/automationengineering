<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ModelLists/Payment_model');
    }

    function index() {
        $header = array('title' => 'payment');
        $data = array(
            'heading' => 'List of payment Subscriptions',
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/table_list/payment_list',$data);
        $this->load->view('admin/footer');
    }

    function ajax_manage_page() {

        $cond = "1=1";
	    $specialist = $_POST['SearchData6'];
        // echo $specialist;die;
        // $from_date = $_POST['SearchData5'];
        //print_r($from_date); exit;
        // $to_date = $_POST['SearchData7'];

		if($specialist!='') {
            $cond .=" and users.userType  = '".$specialist."' ";
        }

        // if($from_date!='') {
        //     $cond .=" and specialist.created_date  >= '".date('Y-m-d',strtotime($from_date))."' ";
        // }

        // if($to_date!='') {
        //     $cond .=" and specialist.created_date  <= '".date('Y-m-d',strtotime($to_date))."' ";
        // }





        $GetData = $this->Payment_model->get_datatables($cond);
        // $GetData = $this->Payment_model->get_datatables();
        if(empty($_POST['start'])) {
            $no=0;
        } else {
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row) {
            if(!empty($row->firstname)) {
                $fullname = $row->firstname.' '.$row->lastname;
            } else {
                $fullname = $row->companyname;
            }
            $currentDate = date('Y-m-d');
            $expiry_date=$row->expiry_date;
            if(strtotime($expiry_date)>strtotime($currentDate)){
                $current_status='Active';
            } else {
                $current_status='Inactive';
            }
            if($row->status == '1'){
                $status = 'Active';
            } else if($row->status == '2') {
                $status = 'Cancelled';
            } else {
                $status = 'Expired';
            }
            $btn = '<button data-transaction_id="'.$row->transaction_id.'" class="btn btn-sm bg-success-light mr-2" type="button"  onClick="view_detail(\''.$row->transaction_id.'\',\''.$status.'\',\''.$row->invoice_pdf.'\');"><i class="far fa-eye mr-1"></i>view</button>';


            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucfirst($row->name_of_card);
            $nestedData[] = ucwords($fullname);
            $nestedData[] = $row->email;
            // $nestedData[] = $row->transaction_id;
            if($row->userType=='1'){
                $usertype_name='Experts';
            }
            else{
                $usertype_name='Vendor';
            }

            $nestedData[] = $usertype_name;
            $nestedData[] = '$'.' '.$row->amount;
            $nestedData[] = date('d-M-Y',strtotime($row->payment_date));
            $nestedData[] = date('d-M-Y',strtotime($row->expiry_date));
            //$nestedData[] = $status;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = array(
            "draw" => $_POST['draw'],
            // "recordsTotal" => $this->Payment_model->count_all(),
            "recordsTotal" => $this->Payment_model->count_all($cond),
            // "recordsFiltered" => $this->Payment_model->count_filtered(),
            "recordsFiltered" => $this->Payment_model->count_filtered($cond),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
//end controller
