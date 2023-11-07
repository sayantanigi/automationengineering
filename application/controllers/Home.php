<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');



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



	public function index() {

		$data['get_post'] = $this->Crud_model->GetData('postjob', 'id,post_title,description,user_id', "is_delete='0'", '', '(id)desc', '6');

		$data['countries']=$this->Crud_model->GetData('countries',"", "", "", "(flag) DESC", "");

		$data['get_freelancerspost'] = $this->Crud_model->GetData('postjob', '', "is_delete='0'", '', '', '8');

		$data['get_career'] = $this->Crud_model->GetData('career_tips', '', "status='Active'", '', '', '3');

		$data['get_company'] = $this->Crud_model->GetData('company_logo', '', "status='Active'", '', '', '');

		$data['get_users'] = $this->Users_model->get_users();

		$data['get_ourservice'] = $this->Crud_model->GetData('our_service', '', "status='Active'", '', '', '');

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Home Top'");

		$data['get_banner_middle'] = $this->Crud_model->get_single('banner', "page_name='Home Middle'");

		$this->load->view('header');

		$this->load->view('home', $data);

		$this->load->view('footer');

	}



	public function signup() {

		$data['get_category'] = $this->Crud_model->GetData('category');

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Sign Up'");

		$this->load->view('header');

		$this->load->view('register', $data);

		$this->load->view('footer');

	}



	public function login_page() {

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Login'");

		$this->load->view('header');

		$this->load->view('login', $data);

		$this->load->view('footer');

	}



	public function about() {

		$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='2'");

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='About Us Top'");

		$data['get_banner_middle'] = $this->Crud_model->get_single('banner', "page_name='About Us Middle'");

		$data['get_employer'] = $this->Crud_model->GetData('users', '', "userType='2'", '', '(userId)desc', '4');

		$this->load->view('header');

		$this->load->view('frontend/about_us', $data);

		$this->load->view('footer');

	}



	public function contact() {

		$data['get_data'] = $this->Crud_model->get_single('setting');

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Contact Us'");

		$this->load->view('header');

		$this->load->view('frontend/contact_us', $data);

		$this->load->view('footer');

	}



	function save_contact() {

		$data = array(

			'name' => $_POST['name'],

			'email' => $_POST['email'],

			'subject' => $_POST['subject'],

			'message' => $_POST['message'],

		);

		$this->Mymodel->insert('contact_us', $data);

		$insert_id = $this->db->insert_id();

		$get_setting=$this->Crud_model->get_single('setting');

		if(!empty($insert_id)) {

			$subject = $_POST['subject'];

			//$imagePath = base_url().'uploads/logo/'.$get_setting->flogo;

			$message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tbody> <tr><td align='center'><table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'> <tbody> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'><img src='cid:Logo' style='width: 250px'/></td> </tr> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Hello Team,</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'> Please find the below contact form details. </td> </tr> </tbody> </table> </td> </tr> <tr> <td align='center'> <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-bottom:2px solid #232323'> <tbody> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Name : ".$_POST['name'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Email : ".$_POST['email'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>".$_POST['message'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'> Sincerely, </td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>".$_POST['name']."</td> </tr> <tr> <td height='30'></td> </tr> </tbody> </table> </td> </tr> </tbody> </table>";

			require 'vendor/autoload.php';

			$mail = new PHPMailer(true);

			try {

				//Server settings

				$mail->CharSet = 'UTF-8';

				$mail->SetFrom($_POST['email']);

				$mail->AddAddress('no-reply@goigi.com', 'Automation Engineering Services');

				//$mail->AddAddress('sayantan@goigi.in', 'sayantan bhakta');

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

				// echo 'Message has been sent';

			} catch (Exception $e) {

				//$this->session->set_flashdata('message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");

				$this->session->set_flashdata('message', "Your message could not be sent. Please, try again later.");

			}

			//$msg = "An email has been sent to your email address containing an activation link. Please click on the link to activate your account. If you do not click the link your account will remain inactive and you will not receive further emails. If you do not receive the email within a few minutes, please check your spam folder.";

			$this->session->set_flashdata('message', 'Thank you for your message. Our team will connect you soon!');

			redirect('contact-us');

		} else {

			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');

			redirect('contact-us');

		}

	}



	public function privacy() {

		$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='3'");

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Privacy policy'");

		$this->load->view('header');

		$this->load->view('frontend/privacy_policy', $data);

		$this->load->view('footer');

	}



	public function term_and_conditions() {

		$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='1'");

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Term and conditions'");

		$this->load->view('header');

		$this->load->view('frontend/term_and_conditions', $data);

		$this->load->view('footer');

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



	function pricing() {

		$vis_ip = $this->getVisIPAddr(); // Store the IP address

		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));



		$countryName = $ipdat->geoplugin_countryName;

		if($countryName == 'Nigeria') {

			$cond = " WHERE subscription_country = 'Nigeria'";

		} else {

			$cond = " WHERE subscription_country = 'Global'";

		}



		//$data['get_subscription'] = $this->Crud_model->GetData('subscription');

		$data['get_subscription'] = $this->db->query("SELECT * FROM subscription ".$cond."")->result_array();

		$data['subcriber_pack'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . @$_SESSION['automation']['userId'] . "'");

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Pricing'");

		$this->load->view('header');

		$this->load->view('frontend/pricing', $data);

		$this->load->view('footer');

	}



	function vendor_pricing() {

		$vis_ip = $this->getVisIPAddr(); // Store the IP address

		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));



		$countryName = $ipdat->geoplugin_countryName;

		if($countryName == 'Nigeria') {

			$cond = " WHERE subscription_country = 'Nigeria' AND subscription_user_type = 'Business'";

		} else {

			$cond = " WHERE subscription_country = 'Global' AND subscription_user_type = 'Business'";

		}



		//$data['get_subscription'] = $this->Crud_model->GetData('subscription');

		$data['get_subscription'] = $this->db->query("SELECT * FROM subscription ".$cond."")->result_array();

		$data['subcriber_pack'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".@$_SESSION['automation']['userId']."'");

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Pricing'");

		$this->load->view('header');

		$this->load->view('frontend/vendor_pricing', $data);

		$this->load->view('footer');

	}



	function freelancer_pricing() {

		$vis_ip = $this->getVisIPAddr(); // Store the IP address

		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));



		$countryName = $ipdat->geoplugin_countryName;

		if($countryName == 'Nigeria') {

			$cond = " WHERE subscription_country = 'Nigeria' AND subscription_user_type = 'Expert'";

		} else {

			$cond = " WHERE subscription_country = 'Global' AND subscription_user_type = 'Expert'";

		}



		//$data['get_subscription'] = $this->Crud_model->GetData('subscription');

		$data['get_subscription'] = $this->db->query("SELECT * FROM subscription ".$cond."")->result_array();

		$data['subcriber_pack'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . @$_SESSION['automation']['userId'] . "'");

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Pricing'");

		$this->load->view('header');

		$this->load->view('frontend/freelancer_pricing', $data);

		$this->load->view('footer');

	}



	function our_jobs() {

		$data['getcategory']=$this->Crud_model->GetData('category');

		//$data['getcountry']=$this->Crud_model->GetData('countries');

		$data['getcountry']=$this->Crud_model->GetData('countries',"", "", "", "(flag) DESC", "");

		$data['get_specialist'] = $this->Crud_model->GetData('specialist');

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Our Jobs'");

		$this->load->view('header');

		$this->load->view('frontend/post_jobslist', $data);

		$this->load->view('footer');

	}



	function ourjob_fetchdata() {

		sleep(1);

		$this->load->library('pagination');

		$config = array();

		$config['base_url'] = '#';

		$config['total_rows'] = count($this->post_job_model->getcount());

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

		$page = $this->uri->segment(3);

		$start = ($page - 1) * $config['per_page'];

		$output = array(

			'pagination_link'  => $this->pagination->create_links(),

			'product_list'   => $this->post_job_model->fetchdata($config["per_page"], $start)

		);

		echo json_encode($output);

	}



	function post_bidding($postid) {

		$vis_ip = $this->getVisIPAddr(); // Store the IP address

		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));

		//print_r($_SESSION); die();

		$data['countryName'] = $ipdat->geoplugin_countryName;

		if(!empty($_SESSION['automation_admin'])){

			$type='admin';

		} else if(!empty($_SESSION['automation'])) {

			$type='user';

		} else {

			$type='nouser';

		}

		$con = "postjob.id='" . base64_decode($postid) . "'";

		$data['post_data'] = $this->post_job_model->viewdata($con);

		//print_r($data['post_data']);die;

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Post Jobs'");



		if($type=='admin'){

			$this->load->view('header',$data);

			$data['type']='admin';

		} else if($type=='user') {

			$this->load->view('header',$data);

			$data['type']='user';

		} else {

			$this->load->view('header',$data);

			$data['type']='';

		}

		$this->load->view('frontend/post_detail', $data);

		$this->load->view('footer');

	}



	function workers_list() {

		$data['get_specialist'] = $this->Crud_model->GetData('specialist');

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Experts'");

		$this->load->view('header');

		$this->load->view('frontend/workers_list', $data);

		$this->load->view('footer');

	}



	function workerlist_fetchdata() {

		sleep(1);

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

		$page = $this->uri->segment(3);

		$start = ($page - 1) * $config['per_page'];



		if(isset($title) || isset($search_location) || isset($specialist) || isset($userType)) {

			$getdata=$this->Users_model->workers_fetchdata($config["per_page"], $start, $title, $search_location, $specialist, $userType);

		} else {

			$getdata=$this->Users_model->workers_fetchdata($config["per_page"], $start, $title, $search_location, $specialist, $userType);

		}



		$output = array(

			'pagination_link'  => $this->pagination->create_links(),

			'product_list'   => $getdata

		);

		echo json_encode($output);

	}



	public function worker_detail($user_id) {

		$cond = "users.userType='1' and users.userId='" . base64_decode($user_id) . "'";

		$data['user_detail'] = $this->Users_model->users_detail($cond);

		$data['user_education'] = $this->Crud_model->GetData('user_education', '', "user_id='" . base64_decode($user_id) . "'", '', '(id)desc');

		$data['user_work'] = $this->Crud_model->GetData('user_workexperience', '', "user_id='" . base64_decode($user_id) . "'", '', '(id)desc');

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Experts Details'");

		$this->load->view('header');

		$this->load->view('frontend/worker_profile', $data);

		$this->load->view('footer');

	}



	function employer_list() {

		$data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Vendors'");

		$data['getcategory']=$this->Crud_model->GetData('category');

		$this->load->view('header');

		$this->load->view('frontend/employer_list', $data);

		$this->load->view('footer');

	}



	function employerlist_fetchdata() {

		sleep(1);

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

		$page = $this->uri->segment(3);

		$start = ($page - 1) * $config['per_page'];



		if(isset($title) || isset($category_id) || isset($subcategory_id) || isset($search_location) || isset($days) || isset($userType)) {

			$getdata=$this->Users_model->employer_fetchdata($config["per_page"], $start, $title, $category_id, $subcategory_id, $search_location, $days, $userType);

		} else {

			$getdata=$this->Users_model->employer_fetchdata($config["per_page"], $start, $title, $category_id, $subcategory_id, $search_location, $days, $userType);

		}



		$output = array(

			'pagination_link'  => $this->pagination->create_links(),

			'employer_list'   => $getdata

		);

		echo json_encode($output);

	}



	function career_tip($id) {

		$data['get_career'] = $this->Crud_model->get_single('career_tips', "id='".base64_decode($id)."'");

		$this->load->view('header');

		$this->load->view('frontend/career_tip', $data);

		$this->load->view('footer');

	}



	function product_contact() {

		$data=array(

			'product_id' => $this->input->post('p_id'),

			'product_name' => $this->input->post('p_name'),

			'c_name' => $this->input->post('name'),

			'c_email' => $this->input->post('email'),

			'c_description' => $this->input->post('details'),

			'created_date'=> date('Y-m-d H:i:s')

		);



		$result = $this->Mymodel->insert('product_contact', $data);

		$insert_id = $this->db->insert_id();

		$get_setting=$this->Crud_model->get_single('setting');

		if(!empty($insert_id)) {

			$subject = 'New Product Inquiry';

			// $imagePath = base_url().'uploads/logo/'.$get_setting->flogo;

			// $message = "";

			// $message = $this->load->view('email_template/signup',$data,TRUE);

			//$message = $this->load->view('email_template/product_query',$data,TRUE);

			$message = "<div style='width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;'><div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'><img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'><h3 style='padding-top: 40px;line-height: 20px;font-weight: 100;font-size: 15px;'>Greetings from<span style='font-weight: 900;font-size: 23px;color: #1B3EA7;display: block;'>Automation Engineering Services</span></h3><p style='font-size: 15px;'>Hello Admin,</p><p style='font-size: 15px;'>Please find the below details for product related queries.</p><p style='font-size: 15px; padding: 0; margin: 0;'>Product Name: ".$_POST['p_name']."</p><p style='font-size: 15px; padding: 0; margin: 0;'>Customer Name: ".$_POST['name']."</p><p style='font-size: 15px; padding: 0; margin: 0;'>Customer Email: ".$_POST['email']."</p><p style='font-size: 15px; padding: 0; margin: 0;'>Message: ".$_POST['details']."</p><p style='font-size: 15px; padding: 0; margin: 18px 0 0 0;'>Thank you!</p><p style='font-size: 15px; padding: 0; margin: 0; list-style: none;'>Sincerly,</p><p style='font-size: 15px; list-style: none; padding: 0; margin: 0;'><b>Automation Engineering Services</b></p><p style='font-size: 15px; list-style: none; padding: 0; margin: 18px 0 0 0;'>Visit us: <span> $get_setting->address</span></p><p style='font-size: 15px; list-style: none; padding: 0; margin: 0;'>Email us: <span> $get_setting->email</span></p></div><table style='width: 100%;'><tr><td style='height:30px;width:100%; background: #1B3EA7;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Automation Engineering Services. All rights reserved.</td></tr></table></div>";

			require 'vendor/autoload.php';

			$mail = new PHPMailer(true);

			try {

				//Server settings

				$mail->CharSet = 'UTF-8';

				$mail->SetFrom('no-reply@goigi.com', 'Automation Engineering Services');

				$mail->AddAddress($_POST['email']);

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

				// echo 'Message has been sent';

			} catch (Exception $e) {

				//$this->session->set_flashdata('message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");

				$this->session->set_flashdata('message', "Your message could not be sent. Please, try again later.");

			}

			//$msg = "An email has been sent to your email address containing an activation link. Please click on the link to activate your account. If you do not click the link your account will remain inactive and you will not receive further emails. If you do not receive the email within a few minutes, please check your spam folder.";

			$res = 1;

		} else {

			$res = 2;

		}

		echo $res; exit;

	}



	public function filterByuserType() {

		$vis_ip = $this->getVisIPAddr(); // Store the IP address

		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));



		$countryName = $ipdat->geoplugin_countryName;

		$userType = $this->input->post('user_type');

		if($countryName == 'Nigeria') {

			if(!empty($userType)) {

				$cond = " WHERE subscription_country = 'Nigeria' AND subscription_user_type = '".$userType."'";

			} else {

				$cond = " WHERE subscription_country = 'Nigeria'";

			}

		} else {

			if(!empty($userType)) {

				$cond = " WHERE subscription_country = 'Global' AND subscription_user_type = '".$userType."'";

			} else {

				$cond = " WHERE subscription_country = 'Global'";

			}

		}

		$getfilterData = $this->db->query("SELECT * FROM subscription ".$cond."")->result_array();

		if(!empty($getfilterData)) {

			$html='';

			foreach ($getfilterData as $key) {

				$get_service=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$key['id']."'");

				$html .= "

				<div class='col-lg-3 col-md-6 col-sm-6 col-xs-12'>

					<div class='pricetable style2'>

						<div class='Price_Shadow'></div>

						<div class='Price_Tag'>

							<div class='Price_Tag_data'>

								<h2>".ucfirst($key['subscription_type'])."</h2>

								<h2>".$key['subscription_amount']."</h2>

								<span>".$key['subscription_duration']."</span>

							</div>

						</div>

						<div class='pricetable-head'>

							<img src='https://cdn-icons-png.flaticon.com/512/5673/5673647.png'>

							<h3>".ucfirst($key['subscription_name'])."</h3>

						</div>

						<input type='hidden' name='amount' id='amount".$key['id']."' value='".$key['subscription_amount']."'>

						<div class='pricing-options'>".$key['subscription_description']."</div>";

						if(!empty($_SESSION['automation']['userType'])) {

							$subcriber_pack = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . @$_SESSION['automation']['userId'] . "'");

							if(!empty($subcriber_pack)) {

								$html .= "<a class='btn btn-info' href='javascript:void(0);' onclick='sub_alert()'>Buy</a>";

							} else {

								if($key['subscription_type'] == 'paid') {

									if(!empty($key['product_key'])) {

										$html .= "<a class='btn btn-info' href=".base_url('stripe/'.base64_encode($key['price_key'])).">Buy</a>";

									} else {

										$html .= "<a class='btn btn-info' href=".base_url('paystack/'.base64_encode($key['plan_code'])).">Buy</a>";

									}

								} else {

									$html .= "<a href='javascript:void(0);' class='btn btn-primary getSubscription_".$key['id']." id='getSubscription_".$key['id'].">Buy</a>";

									$html .= "<input type='hidden' name='user_id_".$key['id']." id='user_id_".$key['id']." value=".$_SESSION['automation']['userId'].">";

									$html .= "<input type='hidden' name='sub_id_".$key['id']." id='sub_id_".$key['id']." value=".$key['id'].">";

									$html .= "<input type='hidden' name='sub_name_".$key['id']." id='sub_name_".$key['id']." value=".$key['subscription_name'].">";

									$html .= "<input type='hidden' name='user_email_".$key['id']." id='user_email_".$key['id']." value=".$_SESSION['automation']['userEmail'].">";

									$html .= "<input type='hidden' name='sub_price_".$key['id']." id='sub_price_".$key['id']." value=".$key['subscription_amount'].">";

									$html .= "<input type='hidden' name='sub_duration_".$key['id']." id='sub_duration_".$key['id']." value=".$key['subscription_duration'].">";

								}

								$this->session->set_userdata('subid', $key['id']);

								$html .= "<input type='hidden' name='sub_id' value='".$this->session->userdata('subid')."'>";

							}

						} else {

							$html .= "<a class='btn btn-info' href=".base_url('login').">Buy</a>";

						}

						$html .= "</div></div>";

			}

		} else {

			$html = "<div class='col-lg-3 col-md-6 col-sm-6 col-xs-12'>No Data Found</div>";

		}

		echo $html;

	}



	public function paystackCheckout($planCode,$price,$email) {

		//echo $this->input->get('plan_code');

		$plan_code = base64_decode($planCode);

		$price = base64_decode($price);

		$email = base64_decode($email);

		$url = "https://api.paystack.co/transaction/initialize";

		$fields = [

			'email' => $email,

			'amount' => $price,

			'plan' => $plan_code

		];



  		$fields_string = http_build_query($fields);

		$ch = curl_init();  //open connection

		curl_setopt($ch,CURLOPT_URL, $url);   //set the url, number of POST vars, POST data

		curl_setopt($ch,CURLOPT_POST, true);

		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(

			"Authorization: Bearer sk_test_b5ecb7ebabe448ed580eacd648227acd1dbcf4fc",

			"Cache-Control: no-cache",

		));

		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);    //So that curl_exec returns the contents of the cURL; rather than echoing it

		$result = curl_exec($ch);    //execute post

		//echo $result;

		$initialize_data = json_decode($result);

		$initialization_url = $initialize_data->data->authorization_url;

		if($result) {

			header("Location: ".$initialization_url);

		}

	}

}

