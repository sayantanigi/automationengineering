<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	function index() {
		$offersdata=$this->Crud_model->GetData('subscription','','');
		$header = array('title' => 'Subscription Plans');
		$data = array('heading' => 'Subscription Plans','offersdata' => $offersdata);
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/subscription/list',$data);
        $this->load->view('admin/footer');
	}

	public function create() {
		$countries = $this->Crud_model->GetData('countries');
    	$header = array('title'=> 'Add');
      	$data = array(
			'heading'=>'Add Subscription Plan',
			'button'=>'Create',
			'subscription_name' =>set_value('subscription_name'),
			'subscription_user_type' =>set_value('subscription_user_type'),
			'subscription_type' =>set_value('subscription_type'),
			'subscription_amount' =>set_value('subscription_amount'),
			'subscription_country' =>set_value('subscription_country'),
			'subscription_duration' =>set_value('subscription_duration'),
			'subscription_id' =>set_value('subscription_id'),
			//'payment_link' =>set_value('payment_link'),
			'product_key' =>set_value('product_key'),
			'price_key' =>set_value('price_key'),
			'plan_code' =>set_value('plan_code'),
			'subscription_description' =>set_value('subscription_description'),
			'countries' => $countries,
			'id' =>set_value('id')
		);
		//print_r($data); die;
		$this->load->view('admin/header',$header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/subscription/form',$data);
        $this->load->view('admin/footer');
  	}

	public function create_action() {
		$data = array(
			'subscription_name'=> $_POST['subscription_name'],
			'subscription_user_type' =>$_POST['subscription_user_type'],
			'subscription_type'=> $_POST['subscription_type'],
			'subscription_amount'=> $_POST['subscription_amount'],
			'subscription_country' =>$_POST['subscription_country'],
			'subscription_duration'=> $_POST['subscription_duration'],
			'subscription_description'=> $_POST['subscription_description'],
			//'payment_link'=> $_POST['payment_link'],
			'product_key'=> $_POST['product_key'],
			'price_key'=> $_POST['price_key'],
			'plan_code' => $_POST['plan_code'],
			'created_date'=> date('Y-m-d H:i:s')
		);
        $this->Crud_model->SaveData('subscription',$data);
        $last_id=$this->db->insert_id();
       	/*$count = count($this->input->post('service'));
		for ($i=0; $i < $count; $i++) {
			$log = array(
				'service'=>$_POST['service'][$i],
				'subscription_id'=>$last_id,
				'created_date'=>date('Y-m-d H:m:s')
			);
			$this->Crud_model->SaveData('subscription_service',$log);
      	}*/
		//$this->Crud_model->SaveData('subscription_service',$log);
        $this->session->set_flashdata('message', 'Subscription plan created successfully');
        redirect(admin_url('subscription'));
	}

	public function update($id) {
		$sub_id=base64_decode($id);
		$countries = $this->Crud_model->GetData('countries');
		$update_sub=$this->Crud_model->get_single('subscription',"id='".$sub_id."'");
		//$sub_offer=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$update_sub->id."'");
		$header=array('title'=>'update');
		// $data=array('heading'=>'Edit Subscription', 'button'=>'Update', 'subscription_name'=>set_value('subscription_name',$update_sub->subscription_name), 'subscription_amount'=>set_value('subscription_amount',$update_sub->subscription_amount), 'subscription_duration'=>set_value('subscription_duration',$update_sub->subscription_duration), 'id'=>$sub_id, 'sub_offer'=>$sub_offer);
		$data=array(
			'heading'=>'Edit Subscription Plan',
			'button'=>'Update',
			'subscription_name'=>set_value('subscription_name',$update_sub->subscription_name),
			'subscription_user_type' =>set_value('subscription_user_type',$update_sub->subscription_user_type),
			'subscription_type'=>set_value('subscription_type',$update_sub->subscription_type),
			'subscription_amount'=>set_value('subscription_amount',$update_sub->subscription_amount),
			'subscription_country'=>set_value('subscription_country',$update_sub->subscription_country),
			'subscription_duration'=>set_value('subscription_duration',$update_sub->subscription_duration),
			'subscription_description'=>set_value('subscription_description',$update_sub->subscription_description),
			//'payment_link'=>set_value('payment_link',$update_sub->payment_link),
			'product_key'=>set_value('product_key',$update_sub->product_key),
			'price_key'=>set_value('price_key',$update_sub->price_key),
			'plan_code' => set_value('plan_code',$update_sub->plan_code),
			'countries' => $countries,
			'id'=>$sub_id
		);
		//print_r($data); die();
		$this->load->view('admin/header',$header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/subscription/form',$data);
		$this->load->view('admin/footer');
	}

	public function update_action() {
		//$data = array('subscription_name'=> $_POST['subscription_name'], 'subscription_amount'=> $_POST['subscription_amount'], 'subscription_duration'=> $_POST['subscription_duration'], 'created_date'=> date('Y-m-d H:i:s'));
		$data = array(
			'subscription_name'=> $_POST['subscription_name'],
			'subscription_user_type'=> $_POST['subscription_user_type'],
			'subscription_type'=> $_POST['subscription_type'],
			'subscription_amount'=> $_POST['subscription_amount'],
			'subscription_country'=> $_POST['subscription_country'],
			'subscription_duration'=> $_POST['subscription_duration'],
			'subscription_description'=> $_POST['subscription_description'],
			//'payment_link'=> $_POST['payment_link'],
			'product_key'=> $_POST['product_key'],
			'price_key'=> $_POST['price_key'],
			'plan_code' => $_POST['plan_code'],
			'created_date'=> date('Y-m-d H:i:s')
		);
        $this->Crud_model->SaveData('subscription',$data,"id='".$_POST['id']."'");
        /*$last_id=$_POST['id'];
        $this->Crud_model->DeleteData('subscription_service',"subscription_id='".$_POST['id']."'");
       	$count = count($this->input->post('service'));

		for ($i=0; $i < $count; $i++) {
			$log = array(
				'service'=>$_POST['service'][$i],
				'subscription_id'=>$last_id,
				'created_date'=>date('Y-m-d H:m:s')
			);
            $this->Crud_model->SaveData('subscription_service',$log);
		}*/
        $this->session->set_flashdata('message', 'Subscription plan update successfully');
        redirect(admin_url('subscription'));
	}

	public function delete() {
        if(isset($_POST['cid'])) {
			$check_catData = $this->db->query("SELECT * FROM employer_subscription where subscription_id = '".$_POST['cid']."'")->num_rows();
			if($check_catData > 0) {
				$this->session->set_flashdata('message', 'Cannot Delete. User already subscribed with this subscription plan.');
				echo 1; exit;
			} else {
				$this->Crud_model->DeleteData('subscription',"id='".$_POST['cid']."'");
				$this->session->set_flashdata('message', 'Subscription plan deleted successfully');
				echo 0; exit;
			}
        }
    }
}
