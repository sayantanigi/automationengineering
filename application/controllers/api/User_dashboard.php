<?php



defined('BASEPATH') OR exit('No direct script access allowed');



//require APPPATH . '/libraries/REST_Controller.php';



use PHPMailer\PHPMailer\PHPMailer;



use PHPMailer\PHPMailer\SMTP;



use PHPMailer\PHPMailer\Exception;







class User_dashboard extends CI_Controller {







	public function __construct() {



        parent::__construct();



        $this->load->model('Mymodel');



		$this->load->model('Users_model');



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







	public function subscription_details() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$user_id = $formdata['user_id'];



			$userType = $formdata['user_type'];



			$vis_ip = $this->getVisIPAddr(); // Store the IP address



			$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));



			$countryName = $ipdat->geoplugin_countryName;



			if($countryName == 'Nigeria') {



				$cond = " WHERE subscription_country = 'Nigeria'";



			} else {



				$cond = " WHERE subscription_country = 'Global'";



			}







			if($userType == '1') {



				$uType = 'Experts';



			} else {



				$uType = 'Vendor';



			}







			$subscription_check = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".@$user_id."' AND (status = '1' OR status = '2')")->result_array();



			if(!empty($subscription_check)) {



				$data['current_plan'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".@$user_id."' AND status IN (1,2)");



				$data['expired_plan'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".@$user_id."' AND status = '3'");



			} else {



				$data['get_subscription'] = $this->db->query("SELECT * FROM subscription ".$cond." AND subscription_user_type = '".$uType."'")->result();



			}



			$response = array('status'=> 'success','result'=> $data);



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function userSubscription() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$paymentDate = date('Y-m-d H:i:s');



			$n=24;



			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';



			$randomString = '';



			for ($i = 0; $i < $n; $i++) {



				$index = rand(0, strlen($characters) - 1);



				$randomString .= $characters[$index];



			}



			$data = array(



				'employer_id' => $formdata['user_id'],



				'subscription_id' => $formdata['sub_id'],



				'name_of_card' => $formdata['sub_name'],



				'email' => $formdata['user_email'],



				'amount' => $formdata['sub_price'],



				'duration' => $formdata['sub_duration'],



				'transaction_id' => "sub_".$randomString,



				'payment_date' => $paymentDate,



				'created_date' => $paymentDate,



				'payment_status' => 'paid',



				'expiry_date' => date("Y-m-d", strtotime('+'.$formdata['sub_duration'].'days'))



			);



			$this->Crud_model->SaveData('employer_subscription', $data);



			$insert_id = $this->db->insert_id();



			if(!empty($insert_id)) {



				$response = array('status'=> 'success','result'=> 'Subscription Successful.');



			} else {



				$response = array('status'=> 'error','result'=> 'Oops, something went wrong. Please try again later.');



			}



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function payment_success() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userId = $formdata['user_id'];



			$s_id = $formdata['subscription_id'];



			require 'vendor/autoload.php';



			require_once APPPATH."third_party/stripe/init.php";



			\Stripe\Stripe::setApiKey('sk_test_835fqzvcLuirPvH0KqHeQz9K');



			$session = \Stripe\Checkout\Session::retrieve($s_id);



			$invoice_id = $session["invoice"];



			$stripe = new \Stripe\StripeClient('sk_test_835fqzvcLuirPvH0KqHeQz9K');



			$sub_data = $stripe->subscriptions->retrieve($session['subscription'],[]);



			$invoice = $stripe->invoices->retrieve($session['invoice'],[]);



			$expire_date = date('Y-m-d', $sub_data['current_period_end']);



			$created_date = date('Y-m-d');



			$futureDate = $expire_date;



			$month = (int)abs((strtotime($created_date) - strtotime($futureDate))/(60*60*24*30));



			$price = $session['amount_total']/100;



			$subQuery = $this->db->query("SELECT * FROM subscription where subscription_amount = '".$price."'")->result_array();



			if($session['status'] == 'complete') {



				$dataDB = array(



					'employer_id' => $userId,



					'subscription_id' => $subQuery[0]['id'],



					'name_of_card' => $subQuery[0]['subscription_name'],



					'email' => $session['customer_details']['email'],



					'amount' => $price,



					'transaction_id' => $session['subscription'],



					'payment_status' => $session['payment_status'],



					'payment_date' => date('Y-m-d H:i:s'),



					'expiry_date' => $expire_date,



					'invoice_url' => $invoice['hosted_invoice_url'],



					'invoice_pdf' => $invoice['invoice_pdf'],



					'duration' => $month,



					'created_date' => date('Y-m-d'),



				);



				$this->db->insert('employer_subscription', $dataDB);



				if($this->db->insert_id()) {



					$subject = "Subscription Payment Invoice";



					$get_setting=$this->Crud_model->get_single('setting');



					$imagePath = base_url().'uploads/logo/'.$get_setting->flogo;



					$message = "<table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'> <tbody> <tr> <td align='center'> <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'> <tbody> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'> <img src='".$imagePath."' style='width:100%'/> </td> </tr> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Dear ".ucwords($fullName).",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Congratulations! Your purchase on <strong style='font-weight:bold;'>Automation Engineering Services</strong> was successful. </td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Please click on the below link to view purchase invoice.</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='text-align:center;padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> <a href=".$invoice['hosted_invoice_url']." target='_blank' style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>Click Here</a> </td> </tr> <tr> <td height='30'></td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>Thank you!</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Sincerely</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Automation Engineering Services</td> </tr> </tbody> </table> </td> </tr> </tbody> </table>";



					$mail = new PHPMailer(true);



					//Server settings



					$mail->CharSet = 'UTF-8';



					$mail->SetFrom('no-reply@goigi.com', 'Automation Engineering Services');



					$mail->AddAddress($userEmail);



					$mail->IsHTML(true);



					$mail->Subject = $subject;



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



			}



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function getUserSubscriptionDetails() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userid = $formdata['userid'];



			$usersubinfo = $this->db->query("SELECT `employer_subscription`.*, `users`.`firstname`, `users`.`lastname`, `users`.`companyname` FROM `employer_subscription` JOIN users ON `users`.`userId` = `employer_subscription`.`employer_id` WHERE `employer_subscription`.`employer_id` = '".$userid."'")->result_array();



			$data['usersubinfo'] = $usersubinfo;



			$response = array('status'=> 'success', 'result'=> $data);



		} catch(\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function profile_settings() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userid = $formdata['user_id'];



			/*$user_info = $this->Crud_model->get_single('users', "userId='".$userid."'");



			$data['userinfo'] = $user_info;*/



			$user_info = $this->db->query('SELECT * FROM users WHERE userId="'.$userid.'"')->result_array();



			foreach($user_info as $key => $arr) {



				$arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];



				$return[$key] = $arr;



			}



			$data['userinfo'] = $return;



			$response = array('status'=> 'success', 'result'=> $data);



		} catch(\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function update_profile() {



		try {



			if (@$_FILES['profilePic']['name'] != '') {



				$_POST['profilePic'] = rand(0000, 9999) . "_" . @$_FILES['profilePic']['name'];



				$config2['image_library'] = 'gd2';



				$config2['source_image'] =  $_FILES['profilePic']['tmp_name'];



				$config2['new_image'] =   getcwd() . '/uploads/users/' . $_POST['profilePic'];



				$config2['upload_path'] =  getcwd() . '/uploads/users/';



				$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';



				$config2['maintain_ratio'] = FALSE;



				$this->image_lib->initialize($config2);



				if (!$this->image_lib->resize()) {



					echo ('<pre>');



					echo ($this->image_lib->display_errors());



					exit;



				} else {



					$image  = $_POST['profilePic'];



					@unlink('uploads/users/' . $_POST['old_image']);



				}







				if(!empty($this->input->post('key_skills'))) {



					$key_skills = $this->input->post('key_skills');



					for ($i=0; $i < count($key_skills); $i++) {



						$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '".$key_skills[$i]."'")->result();



						if(empty($get_specialist)) {



							$insrt = array(



								'specialist_name'=>ucfirst($key_skills[$i]),



								'created_date'=>date('Y-m-d H:i:s'),



							);



							$this->db->insert('specialist',$insrt);



						}



					}



					$skills = implode(", ",$this->input->post('key_skills',TRUE));



				} else {



					$skills = '';



				}



			} else {



				$image  = @$_POST['old_image'];



			}







			$data = array(



				'user_id' => @$_POST['user_id'],



				'companyname' => @$_POST['companyname'],



				'firstname' => @$_POST['firstname'],



				'lastname' => @$_POST['lastname'],



				//'email' => @$_POST['email'],



				'mobile' => @$_POST['mobile'],



				'gender' => $this->input->post('gender', TRUE),



				'skills' => @$skills,



				'profilePic' => $image,



				'zip' => @$_POST['zip'],



				'address' => @$_POST['address'],



				'foundedyear' => @$_POST['foundedyear'],



				'teamsize' => @$_POST['teamsize'],



				'latitude' => @$_POST['latitude'],



				'longitude' => @$_POST['longitude'],



				'short_bio' => @$_POST['short_bio']



			);



			//print_r($data); exit;



			$updateProfile = $this->db->query("UPDATE users SET companyname = '".@$_POST['companyname']."', firstname = '".@$_POST['firstname']."', lastname = '".@$_POST['lastname']."', mobile = '".@$_POST['mobile']."', gender = '".@$_POST['gender']."', skills = '".@$skills."', profilePic = '".@$image."', zip = '".@$_POST['zip']."', address = '".@$_POST['address']."', foundedyear = '".@$_POST['foundedyear']."', teamsize = '".@$_POST['teamsize']."', latitude = '".@$_POST['latitude']."', longitude = '".@$_POST['longitude']."', short_bio = '".@$_POST['short_bio']."' WHERE userId = '".@$_POST['user_id']."'");



			if($updateProfile > 0){



				$response = array('status'=> 'success','result'=> 'Profile updated successfully');



			} else {



				$response = array('status'=> 'error','result'=> 'Oops, Something went wrong please try again later');



			}



		} catch(\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function education_list() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userid = $formdata['user_id'];



			$education_list = $this->Crud_model->GetData('user_education', '', "user_id='".@$userid."' order by id DESC");



			if(!empty($education_list)) {



				$response = array('status'=> 'success','result'=> $education_list);



			} else {



				$response = array('status'=> 'error','result'=> 'No Data Found');



			}



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function save_education() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$data = array(



				'user_id' => $formdata['user_id'],



				'education' => $formdata['education'],



				'passing_of_year' => $formdata['passing_of_year'],



				'college_name' => $formdata['college_name'],



				'department' => $formdata['department'],



				'description' => $formdata['description'],



				'created_date' => date('Y-m-d H:i:s'),



			);



			$this->Crud_model->SaveData('user_education', $data);



			$response = array('status'=> 'success', 'result'=> 'Education Created Successfully !');



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function get_educationDetails() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$education_id = $formdata['id'];



			$get_education = $this->Crud_model->get_single('user_education', "id='" . $education_id . "'");



			$response = array('status'=> 'success', 'result'=> $get_education);



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function update_education() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$data = array(



				'education' => $formdata['education'],



				'passing_of_year' => $formdata['passing_of_year'],



				'college_name' => $formdata['college_name'],



				'department' => $formdata['department'],



				'description' => $formdata['description'],



				'id' => $formdata['id']



			);



			$this->Crud_model->SaveData('user_education', $data, "id='".$formdata['id']."'");



			$response = array('status'=> 'success', 'result'=> 'Education Updated Successfully !');



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function delete_education() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$education_id = $formdata['id'];



			$this->Crud_model->DeleteData('user_education', "id='".$education_id."'");



			$response = array('status'=> 'success', 'result'=> 'Education Deleted successfully !');



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function workexperience_list() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$user_id = $formdata['user_id'];



			$workexperience_list = $this->Crud_model->GetData('user_workexperience', '', "user_id='".$user_id."' order by id DESC");



			if(!empty($workexperience_list)) {



				$response = array('status'=> 'success','result'=> $workexperience_list);



			} else {



				$response = array('status'=> 'error','result'=> 'No Data Found');



			}



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function save_workexperience() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$data = array(



				'user_id' => $formdata['user_id'],



				'designation' => $formdata['designation'],



				'company_name' => $formdata['company_name'],



				'from_date' => $formdata['from_date'],



				'to_date' => $formdata['to_date'],



				'description' => $formdata['description'],



				'created_date' => date('Y-m-d H:i:s'),



			);



			$this->Crud_model->SaveData('user_workexperience', $data);



			$response = array('status'=> 'success', 'result'=> 'Work Experience Created Successfully !');



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function get_workexperience() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$work_id = $formdata['id'];



			$get_workexperience = $this->Crud_model->get_single('user_workexperience', "id='".$work_id."'");



			$response = array('status'=> 'success', 'result'=> $get_workexperience);



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function update_workexperience() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$data = array(



				'designation' => $formdata['designation'],



				'company_name' => $formdata['company_name'],



				'from_date' => $formdata['from_date'],



				'to_date' => $formdata['to_date'],



				'description' => $formdata['description'],



				'id' => $formdata['id']



			);



			$this->Crud_model->SaveData('user_workexperience', $data, "id='".$formdata['id']."'");



			$response = array('status'=> 'success', 'result'=> 'Work Experience Updated Successfully !');



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function delete_workexperience() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$work_id = $formdata['id'];



			$this->Crud_model->DeleteData('user_workexperience', "id='".$work_id."'");



			$response = array('status'=> 'success', 'result'=> 'Work Experience Deleted successfully !');



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function save_postbid() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$data = array(



				'postjob_id' => $formdata['postjob_id'],



				'user_id' => $formdata['user_id'],



				'bid_amount' => $formdata['bid_amount'],



				'currency' => $formdata['currency'],



				'duration' => $formdata['duration'],



				'description' => $formdata['description'],



				'created_date' => date('Y-m-d H:i:s'),



			);



			$this->Crud_model->SaveData('job_bid', $data);



			$insert_id = $this->db->insert_id();



			if(!empty($insert_id)) {



				$response = array('status'=> 'success', 'result'=> 'Bid Submitted Successfully! You will be notified once the Vendor has approved your bid');



			} else {



				$response = array('status'=> 'error', 'result'=> 'Something went wrong. Please try again later.');



			}



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function jobbid() {



		$this->load->model('Post_job_model');



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userType = $formdata['user_type'];



			if($userType == '1'){



				$cond = "job_bid.user_id='".@$formdata['user_id']."'";



			} else {



				$cond = "postjob.user_id='".@$formdata['user_id']."'";



			}



			$get_postjob = $this->Post_job_model->postjob_bid($cond);



			if(!empty($get_postjob)) {



				foreach($get_postjob as $key => $arr) {



					$arr->profilePic = base_url().'uploads/users/'.$arr->profilePic;



					$return[$key] = $arr;



				}



				$get_postjob = $return;



				$response = array('status'=> 'success', 'result'=> $get_postjob);



			} else {



				$response = array('status'=> 'error', 'result'=> 'No Data Found');



			}



		} catch (\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function delete_job() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$jobbid_id = $formdata['id'];



			$delete_prod = $this->db->query("DELETE FROM postjob WHERE id = '$jobbid_id'");



			if($delete_prod > 0){



				$response = array('status'=> 'success','result'=> 'Job deleted successfully');



			} else {



				$response = array('status'=> 'error','result'=> 'Something went wrong. Please try again later');



			}



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function myjob() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userid = $formdata['user_id'];



			$get_postjob = $this->Crud_model->GetData('postjob', '', "user_id='".$userid."'");



			if(!empty($get_postjob)) {



				$response = array('status'=> 'success', 'result'=> $get_postjob);



			} else {



				$response = array('status'=> 'error', 'result'=> 'No data found');



			}



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function save_postjob() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$key_skills = $formdata['key_skills'];



			for ($i=0; $i < count($key_skills); $i++) {



			 	$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '".$key_skills[$i]."'")->result();



			 	if(empty($get_specialist)) {



			 		$insrt = array(



			 			'specialist_name'=>ucfirst($key_skills[$i]),



			 			'created_date'=>date('Y-m-d H:i:s'),



			 		);



			 		$this->db->insert('specialist',$insrt);



			 	}



			}



			$data=array(



				'user_id'=> $formdata['user_id'],



				'post_title'=> $formdata['post_title'],



				'description'=> $formdata['description'],



				'required_key_skills'=> implode(", ",$formdata['key_skills']),



				'duration'=> $formdata['duration'],



				'currency'=> $formdata['currency'],



				'charges'=> $formdata['charges'],



				'category_id'=> $formdata['category_id'],



				'subcategory_id'=> $formdata['subcategory_id'],



				'appli_deadeline'=> $formdata['appli_deadeline'],



				'country'=> $formdata['country'],



				'state'=> $formdata['state'],



				'city'=> $formdata['city'],



				'location'=> $formdata['location'],



				'latitude'=> $formdata['latitude'],



				'longitude'=> $formdata['longitude'],



				'created_date'=>date('Y-m-d H:i:s'),



			);



			$this->Crud_model->SaveData('postjob',$data);



			$response = array('status'=> 'success', 'result'=> 'Post Job Created Successfully !');



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}



	



	public function edit_post_job() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$postid = $formdata['post_id'];



			$update_data = $this->Crud_model->get_single('postjob', "id='".$postid."'");



			if(!empty($update_data)) {



				$data = array(



					'post_title' => $update_data->post_title,



					'description' => $update_data->description,



					//'duration' => $update_data->duration,



					'key_skills' => $update_data->required_key_skills,



					'duration' => $update_data->duration,



					'charges' => $update_data->charges,



					'currency' => $update_data->currency,



					'category' => $update_data->category_id,



					'subcategory' => $update_data->subcategory_id,



					'appli_deadeline' => $update_data->appli_deadeline,



					'countries' => $update_data->country,



					'state' => $update_data->state,



					'cities' => $update_data->city,



					'location' => $update_data->location,



					'latitude' => $update_data->latitude,



					'longitude' => $update_data->longitude,



					'id' => $postid,



				);



				$response = array('status'=> 'success', 'result'=> $data);



			} else {



				$response = array('status'=> 'error', 'result'=> 'No data found');



			}



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function update_post_job() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$key_skills = $formdata['key_skills'];



			for ($i=0; $i < count($key_skills); $i++) {



			 	$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '".$key_skills[$i]."'")->result();



			 	if(empty($get_specialist)) {



			 		$insrt = array(



			 			'specialist_name'=>ucfirst($key_skills[$i]),



			 			'created_date'=>date('Y-m-d H:i:s'),



			 		);



			 		$this->db->insert('specialist',$insrt);



			 	}



			}



			$data=array(



				'id'=> $formdata['id'],



				'post_title'=> $formdata['post_title'],



				'description'=> $formdata['description'],



				'required_key_skills'=> implode(", ",$formdata['key_skills']),



				'duration'=> $formdata['duration'],



				'currency'=> $formdata['currency'],



				'charges'=> $formdata['charges'],



				'category_id'=> $formdata['category_id'],



				'subcategory_id'=> $formdata['subcategory_id'],



				'appli_deadeline'=> $formdata['appli_deadeline'],



				'country'=> $formdata['country'],



				'state'=> $formdata['state'],



				'city'=> $formdata['city'],



				'location'=> $formdata['location'],



				'latitude'=> $formdata['latitude'],



				'longitude'=> $formdata['longitude'],



				'created_date'=>date('Y-m-d H:i:s'),



			);



			$this->Crud_model->SaveData('postjob', $data, "id='".$formdata['id']."'");



			$response = array('status'=> 'success', 'result'=> 'Post Job Updated Successfully !');



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function changebiddingstatus() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$bidstatus = $formdata['bidstatus'];



			$jodBidid = $formdata['jodBidid'];



			$postJobid = $formdata['postJobid'];



			$jobbiduserid = $formdata['jobbiduserid'];



			$jobpostuserid = $formdata['jobpostuserid'];



			$data1 = array('bidding_status' => $bidstatus);



			$this->Crud_model->SaveData('job_bid', $data1, "id='".$jodBidid."' AND postjob_id='".$postJobid."'");



			if($bidstatus == "Selected") {



				$this->Crud_model->SaveData('job_bid', $data1, "id='".$jodBidid."' AND postjob_id='".$postJobid."'");



				$binddingstatus = $this->Crud_model->GetData('job_bid', '', "postjob_id = '".$postJobid."' and bidding_status IN ('Under Review','Short Listed')");



				foreach ($binddingstatus as $row) {



					$data = array('bidding_status' => 'Rejected');



					$this->Crud_model->SaveData('job_bid', $data, "id='" . $row->id . "'");



				}



				$getChatData = $this->db->query("SELECT * FROM chat WHERE userfrom_id != '".$jobbiduserid."' AND userto_id != '".$jobbiduserid."' AND postjob_id = '".$postJobid."'")->result();



				if(!empty($getChatData)) {



					$updateChatData = $this->db->query("UPDATE chat SET is_delete = '2' WHERE userfrom_id != '".$jobbiduserid."' AND userto_id != '".$jobbiduserid."' AND postjob_id = '".$postJobid."'");



				}



				$updatepost = array('is_delete' => 1);



				$this->Crud_model->SaveData('postjob', $updatepost, "id='".$postJobid."'");



				$response = array('status'=> 'success', 'result'=> 'Bid status changed successfully');



			}



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function products() {
		try{
			$formdata = json_decode(file_get_contents('php://input'), true);
			$user_id = $formdata['user_id'];
			$product_list = $this->Crud_model->GetData('user_product', '', "user_id='".$user_id."' AND status = 1 and is_delete = 1");
			//$product_list = $this->db->query('')->result_array();
			//print_r($product_list); die();
			if(!empty($product_list)) {
				$productList = array();
				foreach ($product_list as $key => $value) {
					$productList[$key]['id'] = $value->id;
					$productList[$key]['user_id'] = $value->user_id;
					$productList[$key]['prod_name'] = $value->prod_name;
					$productList[$key]['prod_description'] = $value->prod_description;
					$productList[$key]['status'] = $value->status;
					$productList[$key]['is_delete'] = $value->is_delete;
					$pro_Img = $this->db->query("SELECT * FROM user_product_image where prod_id = '".$value->id."'")->result_array();
					foreach($pro_Img as $key1 => $arr) {
						$arr['prod_image'] = base_url().'uploads/products/'.$arr['prod_image'];
						$return[$key1] = $arr;
					}
					$pro_Img = $return;
					$productList[$key]['prod_image'] = $pro_Img;
					$pro_contact = $this->db->query("SELECT * FROM product_contact where product_id = '".$value->id."'")->result_array();
					$productList[$key]['prod_inquery'] = $pro_contact;
				}
				$response = array('status'=> 'success', 'result'=> $productList);
			} else {
				$response = array('status'=> 'error', 'result'=> 'No data found');
			}
		} catch(\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}







	public function add_product() {



		try{



			if(!empty($this->input->post())){



				$data = array(



					'user_id' => $this->input->post('user_id'),



					'prod_name' => $this->input->post('prod_name'),



					'prod_description' => $this->input->post('prod_description'),



					'created_date' => date("Y-m-d H:i:s"),



				);



				$this->Crud_model->SaveData('user_product', $data);



				$insert_id = $this->db->insert_id();



				if(!empty($insert_id)) {



					if ($_FILES['prod_image']['name'] != '') {



						$cpt = count($_FILES['prod_image']['name']);



						for($i=0; $i<$cpt; $i++) {



							$_POST['prod_image'] = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];



							$config2['image_library'] = 'gd2';



							$config2['source_image'] =  $_FILES['prod_image']['tmp_name'][$i];



							$config2['new_image'] =   getcwd() . '/uploads/products/'.$_POST['prod_image'];



							$config2['upload_path'] =  getcwd() . '/uploads/products/';



							$config2['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG';



							$config2['maintain_ratio'] = TRUE;



							$this->load->library('image_lib', $config2);



							$this->image_lib->initialize($config2);



							if (!$this->image_lib->resize()) {



								$response = array('status'=> 'error', 'result'=> $this->image_lib->display_errors());



								exit;



							} else {



								$image = $_POST['prod_image'];



								@unlink('uploads/products/' . $_POST['old_image']);



							}



							$data_image = array(



								'prod_id' => $insert_id,



								'prod_image' => $image,



								'created_date' => date("Y-m-d H:i:s"),



							);



							$this->Crud_model->SaveData('user_product_image', $data_image);



							$response = array('status'=> 'success', 'result'=> 'Product Created Successfully !');



						}



					}



				}



			}



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function edit_product() {
		try{
			$formdata = json_decode(file_get_contents('php://input'), true);
			$prod_id = $formdata['id'];
			//$product_list = $this->Crud_model->GetData('user_product', '', "user_id='".$user_id."' AND status = 1 and is_delete = 1");
			$product_list = $this->db->query("SELECT * FROM user_product WHERE id='".$prod_id."'")->result_array();
			if(!empty($product_list)) {
				$productList = array();
				foreach ($product_list as $key => $value) {
					$productList[$key]['id'] = $value['id'];
					$productList[$key]['user_id'] = $value['user_id'];
					$productList[$key]['prod_name'] = $value['prod_name'];
					$productList[$key]['prod_description'] = $value['prod_description'];
					$productList[$key]['status'] = $value['status'];
					$productList[$key]['is_delete'] = $value['is_delete'];
					$pro_Img = $this->db->query("SELECT * FROM user_product_image where prod_id = '".$value['id']."'")->result_array();
					foreach ($pro_Img as $img) {
						$productList[$key]['prod_image']['image'] = base_url().'uploads/products/'.$img['prod_image'];
					}
				}
				$response = array('status'=> 'success', 'result'=> $productList);
			} else {
				$response = array('status'=> 'error', 'result'=> 'No data found');
			}
		} catch(\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}







	public function update_product() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			if(!empty($formdata)){



				$data = array(



					'prod_name' => $formdata['prod_name'],



					'prod_description' => $formdata['prod_description'],



					'id' =>  $formdata['id']



				);



				$updateQuery = $this->Crud_model->SaveData('user_product', $data, "id='".$id."'");



				if (!empty($_FILES['prod_image']['name'][0])) {



					$cpt = count($_FILES['prod_image']['name']);



					for($i=0; $i<$cpt; $i++) {



						$_POST['prod_image'] = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];



						$config2['image_library'] = 'gd2';



						$config2['source_image'] =  $_FILES['prod_image']['tmp_name'][$i];



						$config2['new_image'] =   getcwd() . '/uploads/products/'.$_POST['prod_image'];



						$config2['upload_path'] =  getcwd() . '/uploads/products/';



						$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';



						$config2['maintain_ratio'] = FALSE;



						$this->image_lib->initialize($config2);



						if (!$this->image_lib->resize()) {



							$this->image_lib->display_errors();



							$response = array('status'=> 'error', 'result'=> $this->image_lib->display_errors());



							exit;



						} else {



							$image  = $_POST['prod_image'];



							@unlink('uploads/products/' . $_POST['old_image']);



						}



						$data_image = array(



							'prod_id' => $_POST['id'],



							'prod_image' => $image,



							'created_date' => date("Y-m-d H:i:s"),



						);



						$this->Crud_model->SaveData('user_product_image', $data_image);



						$response = array('status'=> 'success', 'result'=> 'Product Updated Successfully !');



					}



				}



			}



			$response = array('status'=> 'success', 'result'=> 'Product Updated Successfully !');



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function delete_product() {



		try{



			$formdata = json_decode(file_get_contents('php://input'), true);



			$p_id = $formdata['id'];



			$delete_prod = $this->db->query("UPDATE user_product SET is_delete = '2' WHERE id = '$p_id'");



			if($delete_prod > 0){



				$response = array('status'=> 'success', 'result'=> 'Product Deleted Successfully');



			} else {



				$response = array('status'=> 'error', 'result'=> 'Oops! Something went wrong Please try again later.');



			}



		} catch(\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function delete_product_image() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$pi_id = $this->input->post('id');



			$delete_prod = $this->db->query("DELETE FROM user_product_image WHERE id = '$pi_id'");



			if($delete_prod > 0){



				$response = array('status'=> 'success', 'result'=> 'Product image deleted');



			} else {



				$response = array('status'=> 'error', 'result'=> 'Oops! Something went wrong Please try again later.');



			}



		} catch (\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function save_employer_rating() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$data = array(



				'employer_id' => $formdata["employer_id"],



				'worker_id' => $formdata["worker_id"],



				'rating' => $formdata["rating"],



				'subject' => $formdata["subject"],



				'review' => $formdata["review"],



				'created_date' => date('Y-m-d H:i:s'),



			);



			$this->Crud_model->SaveData('employer_rating', $data);



			$response = array('status'=> 'success','result'=> 'Rating successfully');



		} catch (\Exception $e) {



			$response = array('status'=> 'error','result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function chatUser_list() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userId = $formdata['user_id'];



			//$data['get_user'] = $this->Crud_model->get_single('users', "userId ='".$userId."'");



			$get_user = $this->db->query("SELECT * FROM users WHERE userId ='".$userId."'")->result_array();



			foreach($get_user as $key => $arr) {



				$arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];



				$return[$key] = $arr;



			}



			$data['get_user'] = $return;



			$cond = "job_bid.bidding_status IN ('Short Listed','Selected')";



			$get_jobbid = $this->Users_model->get_jobbidding($cond);



			foreach($get_jobbid as $key => $arr) {



				$arr->profilePic = base_url().'uploads/users/'.$arr->profilePic;



				$return[$key] = $arr;



			}



			$data['get_userlistbbyjobbid'] = $return;



			$response = array('status'=> 'success', 'result'=> $data);



		} catch (\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}



	



	public function sent_message() {



	    try {



			$formdata = json_decode(file_get_contents('php://input'), true);



    		$userfromid = $formdata['userfromid'];



    		$usertoid = $formdata['usertoid'];



    		$postjob_id = $formdata['postjob_id'];



    		$message = $formdata['message'];



    		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='".$usertoid."' AND userto_id ='".$userfromid."') OR (userto_id ='".$usertoid."' AND userfrom_id ='".$userfromid."')");



    		if (!empty($usertoid)) {



    			$data = array(



    				'userfrom_id' => $userfromid,



    				'userto_id' => $usertoid,



    				'postjob_id' => $postjob_id,



    				'message' => $message,



    				'created_date' => date('Y-m-d H:i:s'),



    			);



    			$this->db->insert('chat', $data);



    			$lastid = $this->db->insert_id();



    			$con = "id='" . $lastid . "'";



    			$getdata = $this->Users_model->getmessage($con);



    			if (@$getdata->profilePic && file_exists('uploads/users/' . @$getdata->profilePic)) {



    				$from_pic = '<img src="' . base_url('uploads/users/' . @$getdata->profilePic) . '" alt="" />';



    			} else {



    				$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';



    			}



    			$response = array('status'=> 'success', 'result'=> 'Message Sent');



    		}



	    } catch (\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function showmessage_count() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$user_id = $formdata['user_id'];



			$getUserType = $this->db->query("Select * FROM users WHERE userId ='".$user_id."'")->result();



			$uType = $getUserType[0]->userType;



			$countMessage = $this->db->query("Select COUNT(id) as msgcount, userfrom_id, userto_id FROM chat WHERE userto_id ='".$user_id."' AND status = '0'")->result();



			$data = array(



				'userfrom_id' => $countMessage[0]->userfrom_id,



				'userto_id' => $countMessage[0]->userto_id,



				'count' => $countMessage[0]->msgcount,



			);



			$response = array('status'=> 'success', 'result'=> $data);



		} catch (\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function showmessageCountEach() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userfromid = $this->input->post('userfromid');



			$usertoid = $this->input->post('usertoid');



			$postid = $this->input->post('postid');



			$getEachChatCount = $this->db->query("Select COUNT(id) as msgcount, userfrom_id, userto_id, postjob_id FROM chat WHERE userto_id ='".$userfromid."' AND postjob_id ='".$postid."' AND status = '0'")->result();



			$data = array(



				'userfrom_id' => $getEachChatCount[0]->userfrom_id,



				'userto_id' => $getEachChatCount[0]->userto_id,



				'count' => $getEachChatCount[0]->msgcount,



			);



			$response = array('status'=> 'success', 'result'=> $data);



		} catch (\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}







	public function showmessage_list() {



		try {



			$formdata = json_decode(file_get_contents('php://input'), true);



			$userf_id = $formdata['userf_id'];



			$usert_id = $formdata['usert_id'];



			$post_id = $formdata['post_id'];



			//$get_data = $this->Users_model->getChat();



			$get_data = $this->db->query("SELECT chat.*, users.username, CONCAT(users.firstname,'',users.lastname) as full_name, users.profilePic, to_user.username as to_username, CONCAT(to_user.firstname,'', to_user.lastname) as to_fullname FROM chat JOIN users ON users.userId = chat.userfrom_id JOIN users as to_user ON to_user.userId = chat.userto_id WHERE (userfrom_id ='".$usert_id."' OR userto_id ='".$usert_id."') AND postjob_id ='".$post_id."'")->result_array();



			$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='".$usert_id."' AND userto_id ='".$userf_id."') OR (userto_id ='".$userf_id."' AND userfrom_id ='".$usert_id."')");



			$get_chatuser = $this->Crud_model->get_single('users', "userId='".$usert_id."'");



			if(!empty($get_data)){



				foreach ($get_data as $key => $arr) {



					$arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];



					$return[$key] = $arr;



				}



				$get_data = $return;



				$response = array('status'=> 'success', 'result'=> $get_data);



			} else {



				$response = array('status'=> 'error', 'result'=> 'No Message');



			}



		} catch (\Exception $e) {



			$response = array('status'=> 'error', 'result'=> $e->getMessage());



		}



		echo json_encode($response);



	}



}



