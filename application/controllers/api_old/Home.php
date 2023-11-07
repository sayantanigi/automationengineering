<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Home extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Mymodel');
		$this->load->model('post_job_model');
		$this->load->model('Users_model');
	}

	public function home_list() {
		try {
			//$data['get_post'] = $this->Crud_model->GetData('postjob', 'id,post_title,description,user_id', "is_delete='0'", '', '(id)desc', '6', );
			$get_post = $this->db->query("SELECT postjob.id,postjob.post_title,postjob.description,postjob.user_id, users.companyname as company_name, users.profilePic as user_image FROM postjob JOIN users ON postjob.user_id = users.userId WHERE postjob.is_delete = '0' ORDER BY postjob.id DESC LIMIT 0,6")->result_array();
			if(!empty($get_post)) {
				foreach($get_post as $key => $arr) {
					$arr['user_image'] = base_url().'uploads/users/'.$arr['user_image'];
					$return[$key] = $arr;
				}
			}
			$data['get_post'] = $return;
			$data['countries']=$this->Crud_model->GetData('countries',"","");
			$data['get_freelancerspost'] = $this->Crud_model->GetData('postjob', '', "is_delete='0'", '', '', '8');
			//$data['get_users'] = $this->Users_model->get_users();
			//$data['get_users'] = $this->db->query("SELECT * FROM users WHERE userType = '2'")->result();
			$get_users = $this->db->query("SELECT * FROM users WHERE userType = '1'")->result_array();
			if(!empty($get_users)) {
				foreach ($get_users as $key => $val) {
					$val['profilePic'] = base_url().'uploads/users/'.$val['profilePic'];;
					$return[$key] = $val;
				}
			}
			$data['get_users'] = $return;
			$get_ourservice = $this->Crud_model->GetData('our_service', '', "status='Active'", '', '', '', '', [['key' => 'icon', 'base' => base_url("uploads/services/")]]);
			if(!empty($get_ourservice)) {
				foreach ($get_ourservice as $key => $val) {
					$getCatName = $this->Crud_model->get_single('category',"","id='".$val->id."'");
					//print_r($getCatName);
					$val->category_id = $getCatName->category_name;
					$return[$key] = $val;
				}
			}
			$data['get_ourservice'] = $return;
			$data['get_company'] = $this->Crud_model->GetData('company_logo', '', "status='Active'", '', '', '', '', [['key' => 'logo', 'base' => base_url("uploads/company_logo/")]]);
			$data['get_career'] = $this->Crud_model->GetData('career_tips', '', "status='Active'", '', '', '3', '', [['key' => 'image', 'base' => base_url("uploads/career/")]]);
			//$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Home Top'");
			//$data['get_banner_middle'] = $this->Crud_model->get_single('banner', "page_name='Home Middle'");
	        $response = array('status'=> 'success','result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error','result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function post_details() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$postid = $formdata['post_id'];
			$con = "postjob.id='".$postid."'";
			$data['post_data'] = $this->post_job_model->viewdata($con);
			$response = array('status'=> 'success','result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error','result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function careertips_details() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$careertip_id = $formdata['careertip_id'];
			//$data['get_career'] = $this->Crud_model->get_single('career_tips', "id='".$careertip_id."'");
			$get_career = $this->db->query("SELECT * FROM career_tips WHERE id='".$careertip_id."'")->result_array();
			foreach($get_career as $key => $arr) {
				$arr['image'] = base_url().'uploads/users/'.$arr['image'];
				$return[$key] = $arr;
			}
			$data['get_career'] = $return;
			$response = array('status'=> 'success','result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error','result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function vendor_lists() {
		try {
			$title = $this->input->post('title_keyword');
			$category_id = $this->input->post('category');
			$subcategory_id = $this->input->post('subcategory');
			$search_location = $this->input->post('location');
			$days = $this->input->post('days');
			$userType = 2;
			$this->load->library('pagination');
			$config = array();
			$config['base_url'] = '#';
			$config['total_rows'] = count($this->Users_model->get_employercount());
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = '&gt;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&lt;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='active'><a href='#'>";
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['num_links'] = 3;
			$this->pagination->initialize($config);
			$page = 1;
			$start = ($page - 1) * $config['per_page'];

			if(isset($title) || isset($category_id) || isset($subcategory_id) || isset($search_location) || isset($days) || isset($userType)) {
				$getdata = $this->Users_model->vendor_fetchdataForAPI($config["per_page"], $start, $title, $category_id, $subcategory_id, $search_location, $days, $userType);
			} else {
				$getdata = $this->Users_model->vendor_fetchdataForAPI($config["per_page"], $start, $title, $category_id, $subcategory_id, $search_location, $days, $userType);
			}
			$getVendorList = array();
			$getcategory= $this->Crud_model->GetData('category');
			foreach($getcategory as $key => $arr) {
				$arr->category_image = base_url().'uploads/category/'.$arr->category_image;
				$return[$key] = $arr;
			}
			$getVendorList['getcategory'] = $return;
			foreach ($getdata as $key => $row) {
				$countJob = $this->Crud_model->GetData('postjob','',"user_id='".$row['userId']."'");
				$getVendorList['vendor_lists'][$key]['userId'] = $row['userId'];
				$getVendorList['vendor_lists'][$key]['companyname'] = $row['companyname'];
				$getVendorList['vendor_lists'][$key]['email'] = $row['email'];
				$getVendorList['vendor_lists'][$key]['mobile'] = $row['mobile'];
				$getVendorList['vendor_lists'][$key]['dob'] = $row['dob'];
				$getVendorList['vendor_lists'][$key]['profilePic'] = $row['profilePic'];
				$getVendorList['vendor_lists'][$key]['userType'] = $row['userType'];
				$getVendorList['vendor_lists'][$key]['status'] = $row['status'];
				$getVendorList['vendor_lists'][$key]['email_verified'] = $row['email_verified'];
				$getVendorList['vendor_lists'][$key]['address'] = $row['address'];
				$getVendorList['vendor_lists'][$key]['latitude'] = $row['latitude'];
				$getVendorList['vendor_lists'][$key]['longitude'] = $row['longitude'];
				$getVendorList['vendor_lists'][$key]['short_bio'] = $row['short_bio'];
				$getVendorList['vendor_lists'][$key]['foundedyear'] = $row['foundedyear'];
				$getVendorList['vendor_lists'][$key]['teamsize'] = $row['teamsize'];
				$getVendorList['vendor_lists'][$key]['count_job'] = count($countJob);
			}
			$response = array('status'=> 'success', 'result'=> $getVendorList);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function vendor_details() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$userid = $formdata['user_id'];
			//$data['userdata'] = $this->Crud_model->get_single('users',"userId='".$userid."'");
			$userdata = $this->db->query('SELECT * FROM users WHERE userId="'.$userid.'"')->result_array();
			foreach($userdata as $key => $arr) {
				$arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];
				$return[$key] = $arr;
			}
			$data['userdata'] = $return;
			$data['get_post'] = $this->Crud_model->GetData('postjob','',"user_id='".$userid."' AND is_delete = '0'");
	        $data['count_post'] = $this->db->query("SELECT COUNT(id) as total FROM postjob WHERE user_id='".$userid."' AND is_delete = '0'")->result_array();
			$prod_list = $this->db->query("SELECT user_product.id, user_product.prod_name, user_product.prod_description, user_product_image.prod_image FROM user_product_image JOIN user_product ON user_product.id = user_product_image.prod_id WHERE user_product.status = 1 AND user_product.is_delete = 1 AND user_id='".$userid."' group by user_product.id")->result_array();
			foreach($prod_list as $key => $arr) {
				$arr['prod_image'] = base_url().'uploads/products/'.$arr['prod_image'];
				$return[$key] = $arr;
			}
			$data['prod_list'] = $return;
			$viewcount = $data['userdata'][0]['view_count']+1;
			$insert_data=array(
				'view_count'=>$viewcount,
			);
			$this->Crud_model->SaveData('users',$insert_data,"userId='".$userid."'");
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function freelancer_lists() {
		try {
			$title = $this->input->post('title_keyword');
			$search_location = $this->input->post('location');
			$specialist = $this->input->post('specialist');
			if($specialist) {
				$specialist = implode(',', $specialist);
			}
			$userType = 1;
			$this->load->library('pagination');
			$config = array();
			$config['base_url'] = '#';
			$config['total_rows'] = count($this->Users_model->getcount());
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = '&gt;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&lt;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='active'><a href='#'>";
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['num_links'] = 3;
			$this->pagination->initialize($config);
			$page = 1;
			$start = ($page - 1) * $config['per_page'];

			if(isset($title) || isset($search_location) || isset($specialist) || isset($userType)) {
				$getdata = $this->Users_model->freelancer_fetchdataForAPI($config["per_page"], $start, $title, $search_location, $specialist, $userType);
			} else {
				$getdata = $this->Users_model->freelancer_fetchdataForAPI($config["per_page"], $start, $title, $search_location, $specialist, $userType);
			}
			$getFreelancerList = array();
			$get_specialist = $this->Crud_model->GetData('specialist');
			foreach ($get_specialist as $key => $value) {
				$value->specialist_image = base_url().'uploads/specialist/'.$value->specialist_image;
				$return[$key] = $value;
			}
			$getFreelancerList['get_specialist'] = $return;
			foreach ($getdata as $key => $row) {
				$getFreelancerList['freelancer_lists'][$key]['userId'] = $row['userId'];
				$getFreelancerList['freelancer_lists'][$key]['firstname'] = $row['firstname'];
				$getFreelancerList['freelancer_lists'][$key]['lastname'] = $row['lastname'];
				$getFreelancerList['freelancer_lists'][$key]['email'] = $row['email'];
				$getFreelancerList['freelancer_lists'][$key]['mobile'] = $row['mobile'];
				$getFreelancerList['freelancer_lists'][$key]['profilePic'] = $row['profilePic'];
				$getFreelancerList['freelancer_lists'][$key]['userType'] = $row['userType'];
				$getFreelancerList['freelancer_lists'][$key]['status'] = $row['status'];
				$getFreelancerList['freelancer_lists'][$key]['email_verified'] = $row['email_verified'];
				$getFreelancerList['freelancer_lists'][$key]['address'] = $row['address'];
				$getFreelancerList['freelancer_lists'][$key]['latitude'] = $row['latitude'];
				$getFreelancerList['freelancer_lists'][$key]['longitude'] = $row['longitude'];
				$getFreelancerList['freelancer_lists'][$key]['zip'] = $row['zip'];
				$getFreelancerList['freelancer_lists'][$key]['short_bio'] = $row['short_bio'];
				$getFreelancerList['freelancer_lists'][$key]['gender'] = $row['gender'];
				$getFreelancerList['freelancer_lists'][$key]['view_count'] = $row['view_count'];
			}
			$response = array('status'=> 'success', 'result'=> $getFreelancerList);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function freelancer_details() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$userid = $formdata['user_id'];
			//$data['userdata'] = $this->Crud_model->get_single('users',"userId='".$userid."'");
			$userdata = $this->db->query('SELECT * FROM users WHERE userId="'.$userid.'"')->result_array();
			foreach($userdata as $key => $arr) {
				$arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];
				$return[$key] = $arr;
			}
			$data['userdata'] = $return;
			$data['get_post'] = $this->Crud_model->GetData('postjob','',"user_id='".$userid."' AND is_delete = '0'");
	        $data['count_post'] = $this->db->query("SELECT COUNT(id) as total FROM postjob WHERE user_id='".$userid."' AND is_delete = '0'")->result_array();
			$data['prod_list'] = $this->db->query("SELECT user_product.id, user_product.prod_name, user_product.prod_description, user_product_image.prod_image FROM user_product_image JOIN user_product ON user_product.id = user_product_image.prod_id WHERE user_product.status = 1 AND user_product.is_delete = 1 AND user_id='".$userid."' group by user_product.id")->result_array();
			$viewcount = $data['userdata'][0]['view_count']+1;
			$insert_data=array(
				'view_count'=>$viewcount,
			);
			$this->Crud_model->SaveData('users',$insert_data,"userId='".$userid."'");
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function product_details() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$prod_id = $formdata['prod_id'];
			$data['prod_details']=$this->db->query("SELECT * FROM user_product WHERE status = 1 AND is_delete = 1 AND id = '".$prod_id."'")->result_array();
	        $prod_images=$this->db->query("SELECT * FROM user_product_image WHERE prod_id = '".$prod_id."'")->result_array();
	        foreach($prod_images as $key => $arr) {
				$arr['prod_image'] = base_url().'uploads/products/'.$arr['prod_image'];
				$return[$key] = $arr;
			}
	        $data['prod_images']= $return;
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	function getVisIpAddr() {
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        	return $_SERVER['HTTP_CLIENT_IP'];
    	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	return $_SERVER['HTTP_X_FORWARDED_FOR'];
    	} else {
        	return $_SERVER['REMOTE_ADDR'];
    	}
	}

	public function vendor_pricing() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			if(!empty($formdata['user_id'])) {
				$user_id = $formdata['user_id'];
				$data['subcriber_pack'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$user_id."'");
			}
			$countryName = $formdata['country_name'];
			if($countryName == 'Nigeria') {
				$cond = " WHERE subscription_country = 'Nigeria' AND subscription_user_type = 'Vendor'";
			} else {
				$cond = " WHERE subscription_country = 'Global' AND subscription_user_type = 'Vendor'";
			}
			$data['get_subscription'] = $this->db->query("SELECT * FROM subscription ".$cond."")->result_array();
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function freelancer_pricing() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			if(!empty($formdata['user_id'])) {
				$user_id = $formdata['user_id'];
				$data['subcriber_pack'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$user_id."'");
			}
			$countryName = $formdata['country_name'];
			if($countryName == 'Nigeria') {
				$cond = " WHERE subscription_country = 'Nigeria' AND subscription_user_type = 'Experts'";
			} else {
				$cond = " WHERE subscription_country = 'Global' AND subscription_user_type = 'Experts'";
			}
			$data['get_subscription'] = $this->db->query("SELECT * FROM subscription ".$cond."")->result_array();
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function about() {
		try {
			$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='2'");
			//$get_banner = $this->Crud_model->get_single('banner', "page_name='About Us Top'");
			$get_banner = $this->db->query("SELECT * FROM banner WHERE page_name='About Us Top'")->result_array();
			foreach($get_banner as $key => $arr) {
				$arr['image'] = base_url().'uploads/banner/'.$arr['image'];
				$return[$key] = $arr;
			}
			$data['get_banner'] = $return;
			//$get_banner_middle = $this->Crud_model->get_single('banner', "page_name='About Us Middle'");
			$get_banner_middle = $this->db->query("SELECT * FROM banner WHERE page_name='About Us Middle'")->result_array();
			foreach($get_banner_middle as $key => $arr) {
				$arr['image'] = base_url().'uploads/banner/'.$arr['image'];
				$return[$key] = $arr;
			}
			$data['get_banner_middle'] = $return;
			$get_employer = $this->Crud_model->GetData('users', '', "userType='2'", '', '(userId)desc', '4');
			foreach($get_employer as $key => $arr) {
				$arr->profilePic = base_url().'uploads/users/'.$arr->profilePic;
				$return[$key] = $arr;
			}
			$data['get_employer'] = $return;
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function contact() {
		try {
			//$get_data = $this->Crud_model->get_single('setting');
			$get_data = $this->db->query('SELECT * FROM setting')->result_array();
			foreach($get_data as $key => $arr) {
				$arr['logo'] = base_url().'uploads/logo/'.$arr['logo'];
				$arr['flogo'] = base_url().'uploads/logo/'.$arr['flogo'];
				$arr['favicon'] = base_url().'uploads/logo/'.$arr['favicon'];
				$return[$key] = $arr;
			}
			$data['get_data'] = $return;
			// $get_banner = $this->Crud_model->get_single('banner', "page_name='Contact Us'");
			$get_banner = $this->db->query("SELECT * FROM banner WHERE page_name='Contact Us'")->result_array();
			foreach($get_banner as $key => $arr) {
				$arr['image'] = base_url().'uploads/banner/'.$arr['image'];
				$return[$key] = $arr;
			}
			$data['get_banner'] = $return;
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	function product_contact() {
		try{
			$formdata = json_decode(file_get_contents('php://input'), true);
			$data=array(
				'product_id' => $formdata['p_id'],
				'product_name' => $formdata['p_name'],
				'c_name' => $formdata['name'],
				'c_email' => $formdata['email'],
				'c_description' => $formdata['details'],
				'created_date'=> date('Y-m-d H:i:s')
			);
			$result = $this->Mymodel->insert('product_contact', $data);
			$insert_id = $this->db->insert_id();
			$get_setting=$this->Crud_model->get_single('setting');
			if(!empty($insert_id)) {
				$subject = 'New Product Inquiry';
				$message = "<div style='width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;'><div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'><img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'><h3 style='padding-top: 40px;line-height: 20px;font-weight: 100;font-size: 15px;'>Greetings from<span style='font-weight: 900;font-size: 23px;color: #1B3EA7;display: block;'>Automation Engineering Services</span></h3><p style='font-size: 15px;'>Hello Admin,</p><p style='font-size: 15px;'>Please find the below details for product related queries.</p><p style='font-size: 15px; padding: 0; margin: 0;'>Product Name: ".$formdata['p_name']."</p><p style='font-size: 15px; padding: 0; margin: 0;'>Customer Name: ".$formdata['name']."</p><p style='font-size: 15px; padding: 0; margin: 0;'>Customer Email: ".$formdata['email']."</p><p style='font-size: 15px; padding: 0; margin: 0;'>Message: ".$formdata['details']."</p><p style='font-size: 15px; padding: 0; margin: 18px 0 0 0;'>Thank you!</p><p style='font-size: 15px; padding: 0; margin: 0; list-style: none;'>Sincerly,</p><p style='font-size: 15px; list-style: none; padding: 0; margin: 0;'><b>Automation Engineering Services</b></p><p style='font-size: 15px; list-style: none; padding: 0; margin: 18px 0 0 0;'>Visit us: <span> $get_setting->address</span></p><p style='font-size: 15px; list-style: none; padding: 0; margin: 0;'>Email us: <span> $get_setting->email</span></p></div><table style='width: 100%;'><tr><td style='height:30px;width:100%; background: #1B3EA7;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Automation Engineering Services. All rights reserved.</td></tr></table></div>";
				require 'vendor/autoload.php';
				$mail = new PHPMailer(true);
				$mail->CharSet = 'UTF-8';
				$mail->SetFrom('no-reply@goigi.com', 'Automation Engineering Services');
				$mail->AddAddress($formdata['email']);
				$mail->IsHTML(true);
				$mail->Subject = $subject;
				$mail->AddEmbeddedImage('uploads/logo/'.$get_setting->flogo, 'Logo');
				$mail->Body = $message;
				//Send email via SMTP
				$mail->IsSMTP();
				$mail->SMTPAuth   = true;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Host       = "smtp.gmail.com";
				$mail->Port       = 587; //587 465
				$mail->Username   = "no-reply@goigi.com";
				$mail->Password   = "wj8jeml3eu0z";
				$mail->send();
				if(!$mail->send()) {
					$response = array('status'=> 'error', 'result'=>'Your message could not be sent. Please, try again later.');
				} else {
					$response = array('status'=> 'success', 'result'=>'The email message was sent.');
				}
			}
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function save_contact() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$data = array(
				'name'=> $formdata['name'],
				'email'=> $formdata['email'],
				'subject'=> $formdata['subject'],
				'message'=> $formdata['message'],
			);
			$this->Mymodel->insert('contact_us', $data);
			$insert_id = $this->db->insert_id();
			$get_setting=$this->Crud_model->get_single('setting');
			if(!empty($insert_id)) {
				$subject = $formdata['subject'];
				$imagePath = base_url().'uploads/logo/'.$get_setting->flogo;
				$message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tbody> <tr><td align='center'><table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'> <tbody> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'><img src='" . $imagePath . "' style='width: 250px'/></td> </tr> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Hello Team,</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'> Please find the below contact form details. </td> </tr> </tbody> </table> </td> </tr> <tr> <td align='center'> <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-bottom:2px solid #232323'> <tbody> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Name : ".$formdata['name'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Email : ".$formdata['email'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>".$formdata['message'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'> Sincerely, </td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>".$formdata['name']."</td> </tr> <tr> <td height='30'></td> </tr> </tbody> </table> </td> </tr> </tbody> </table>";
				require 'vendor/autoload.php';
				$mail = new PHPMailer(true);
				$mail->CharSet = 'UTF-8';
				$mail->SetFrom($formdata['email']);
				$mail->AddAddress('sayantan@goigi.in', 'sayantan bhakta');
				$mail->IsHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $message;
				$mail->IsSMTP();
				$mail->SMTPAuth   = true;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Host       = "smtp.gmail.com";
				$mail->Port       = 587; //587 465
				$mail->Username   = "no-reply@goigi.com";
				$mail->Password   = "wj8jeml3eu0z";
				$mail->send();
				if(!$mail->send()) {
					$response = array('status'=> 'error', 'result'=>'Your message could not be sent. Please, try again later.');
				} else {
					$response = array('status'=> 'success', 'result'=>'The email message was sent.');
				}
			}
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function privacy() {
		try {
			$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='3'");
			// $data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Privacy policy'");
			$get_banner = $this->db->query("SELECT * FROM banner WHERE page_name='Privacy policy'")->result_array();
			foreach($get_banner as $key => $arr) {
				$arr['image'] = base_url().'uploads/banner/'.$arr['image'];
				$return[$key] = $arr;
			}
			$data['get_banner'] = $return;
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function term_and_conditions() {
		try {
			$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='1'");
			// $data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Term and conditions'");
			$get_banner = $this->db->query("SELECT * FROM banner WHERE page_name='Term and conditions'")->result_array();
			foreach($get_banner as $key => $arr) {
				$arr['image'] = base_url().'uploads/banner/'.$arr['image'];
				$return[$key] = $arr;
			}
			$data['get_banner'] = $return;
			$response = array('status'=> 'success', 'result'=> $data);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function search_job() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			@$category_id = $formdata['category_id'];
			@$title = $formdata['title_keyword'];
			@$post_id = $formdata['post_id'];
			@$days = $formdata['days'];
			@$subcategory_id = $formdata['subcategory_id'];
			@$location = $formdata['location'];
			@$country = $formdata['country'];
			@$state = $formdata['state'];
			@$city = $formdata['city'];
			@$search_title = $formdata['search_title'];
			@$search_location = $formdata['search_location'];
			if(isset($category_id) && !empty($category_id) || isset($title) && !empty($title) || isset($days) && !empty($days)||isset($subcategory_id) && !empty($subcategory_id)|| isset($location) && !empty($location) || isset($search_title) && !empty($search_title) || isset($search_location) && !empty($search_location) || isset($country) && !empty($country) || isset($state) && !empty($state) || isset($city) && !empty($city)) {
				$total_count=$this->post_job_model->subcategory_getcount($title, $location,$days,$category_id,$subcategory_id,$search_title,$search_location,$country,$state,$city);
			} else {
				$get_product=$this->Crud_model->GetData('postjob','',"subcategory_id='".$post_id."' and is_delete='0' AND status = 'Active'");
				$total_count=count($get_product);
			}

			$this->load->library('pagination');
			$config = array();
			$config['base_url'] = '#';
			$config['total_rows'] = $total_count;
			$config['per_page'] =10;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = '&gt;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&lt;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='active'><a href='#'>";
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['num_links'] = 3;
			$this->pagination->initialize($config);
			$page = $this->uri->segment(3);
			if (!empty($page)){
				$start = ($page - 1) * $config['per_page'];
			} else {
				$start = '0';
			}

			if(isset($category_id) || isset($title)|| isset($days)||isset($subcategory_id)|| isset($location)|| isset($search_title)|| isset($search_location)|| isset($country)|| isset($state)|| isset($city)) {
				$getdata=$this->post_job_model->subcategory_fetchdataAPI($config["per_page"], $start, $title, $location,$days,$category_id,$subcategory_id,$post_id,$search_title,$search_location,$country,$state,$city);
			} else {
				$getdata=$this->post_job_model->subcategory_fetchdataAPI($config["per_page"], $start, $title, $location,$days,$category_id,$subcategory_id,$post_id,$search_title,$search_location,$country,$state,$city);
			}
			if(!empty($getdata)) {
				$response = array('status'=> 'success', 'result'=> $getdata);
			} else {
				$response = array('status'=> 'error', 'result'=> 'No Data Found');
			}
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function states_by_country() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			@$c_name = $formdata['country_name'];
			$get_cid = $this->db->query("SELECT * FROM countries WHERE name = '".$c_name."'")->result_array();
			$state_list = $this->db->query("SELECT id, name, country_id FROM states WHERE country_id = '".$get_cid[0]['id']."'")->result_array();
			$response = array('status'=> 'success', 'result'=> $state_list);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function cities_by_state() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			@$s_name = $formdata['state_name'];
			$get_sid = $this->db->query("SELECT * FROM states WHERE name = '".$s_name."'")->result_array();
			$cities_list = $this->db->query("SELECT * FROM cities WHERE state_id = '".$get_sid[0]['id']."'")->result_array();
			$response = array('status'=> 'success', 'result'=> $cities_list);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function categoryList() {
		try {
			$get_catList = $this->db->query("SELECT id, category_name FROM category WHERE status = 'Active'")->result_array();
			$response = array('status'=> 'success', 'result'=> $get_catList);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}

	public function subcategory_by_category() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			@$id = $formdata['id'];
			$get_subcatList = $this->db->query("SELECT id, sub_category_name FROM sub_category WHERE category_id = '".$id."' AND status = 'Active'")->result_array();
			$response = array('status'=> 'success', 'result'=> $get_subcatList);
		} catch (\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}
}
