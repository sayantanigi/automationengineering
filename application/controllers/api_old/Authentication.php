<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require APPPATH . '/libraries/REST_Controller.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Authentication extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Mymodel');
    }

	public function registration() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$validate = $this->Crud_model->get_single('users',"email = '".$formdata['email']."'");
			if(!empty($validate)) {
				$msg = 'Sorry this member already exist, try with another email.';
				$response = array('status'=> 'error','result'=> $msg);
			} else {
				$data=array(
					'userType' => $formdata['user_type'],
					'firstname' => $formdata['first_name'],
					'lastname' => $formdata['last_name'],
					'companyname' => $formdata['company_name'],
					'email' => $formdata['email'],
					'address' => $formdata['location'],
					'latitude' => $formdata['latitude'],
					'longitude' => $formdata['longitude'],
					'password' => md5($formdata['password']),
					'created'=> date('Y-m-d H:i:s'),
					'status'=> 0
				);

				$result = $this->Mymodel->insert('users',$data);
				if($formdata['first_name']) {
					$fullname = $formdata['first_name']." ".$formdata['last_name'];
				} else {
					$fullname = $formdata['company_name'];
				}

				$insert_id = $this->db->insert_id();
				$get_setting = $this->Crud_model->get_single('setting');
				if(!empty($insert_id)) {
					$data = array(
						'activationURL' => base_url() . "email-verification/" . urlencode(base64_encode($insert_id)),
						'imagePath' => base_url().'uploads/logo/'.$get_setting->flogo,
						'fullname' => $fullname,
					);
					$message = $this->load->view('email_template/signup',$data,TRUE);
					require 'vendor/autoload.php';
					$mail = new PHPMailer(true);
					$mail->CharSet = 'UTF-8';
					$mail->SetFrom('no-reply@goigi.com', 'Automation Engineering Services');
					$mail->AddAddress($formdata['email']);
					$mail->IsHTML(true);
					$mail->Subject = 'Verify Your Email Address From Automation Engineering Services';
					$mail->Body = $message;
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail->Host = "smtp.gmail.com";
					$mail->Port = 587; //587 465
					$mail->Username = "no-reply@goigi.com";
					$mail->Password = "wj8jeml3eu0z";
					$mail->send();
					$msg = "We have sent an activation link to your account to continue with the registration process.";
					$response = array('status'=> 'success','result'=> $msg);
				} else {
					$msg = "Something went wrong. Please, try again later.";
					$response = array('status'=> 'error','result'=> $msg);
				}
			}
		} catch (\Exception $e) {
			$response = array('status'=> 'error','result'=> $e->getMessage());
	    }
		echo json_encode($response);
	}

    public function login() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $email = $formdata["email"];
    		$password = $formdata["password"];
			$check_user = $this->db->query("SELECT * FROM users WHERE email = '".$email."' AND password = '".md5($password)."' AND status = '1'")->result_array();
			if(!empty($check_user)) {
                $msg = 'Logged in successfully';
                if($check_user[0]['userType'] == '1') {
    				$check_sub = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$check_user[0]['userId']."' AND status IN (1,2)");
    				if(empty($check_sub)) {
    					$profilePic = array("profilePic"=> base_url()."uploads/users/".$check_user[0]['profilePic']);
    					$check_user = array_merge($check_user[0], $profilePic);
    					$response1 = array('status'=> 'success','result'=> $check_user);
						$response2 = array_merge($response1, array("subscription"=> "0"));
						$response3 = array_merge($response2, array("userType"=> '1'));
						$response = array_merge($response3, array("profile"=> '0'));
    				} else {
    					$profile_check = $this->db->query("SELECT `firstname`, `lastname`, `email`, `gender`, `address`, `zip`, `short_bio` FROM `users` WHERE userId = '".@$check_user[0]['userId']."'")->result_array();
    					if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['gender']) || empty($profile_check[0]['address']) || empty($profile_check[0]['zip']) || empty($profile_check[0]['short_bio'])) {
                            // $response = array('status'=> 'success','result'=> $check_user);
                            // $response = array_merge($response, array("profile"=> "0"));
                            $profilePic = array("profilePic"=> base_url()."uploads/users/".$check_user[0]['profilePic']);
	    					$check_user = array_merge($check_user[0], $profilePic);
	    					$response1 = array('status'=> 'success','result'=> $check_user);
							$response2 = array_merge($response1, array("profile"=> "0"));
							$response3 = array_merge($response2, array("userType"=> '1'));
							$response = array_merge($response3, array("subscription"=> '1'));
    					} else {
                            // $response = array('status'=> 'success','result'=> $check_user);
                            // $response = array_merge($response, array("profile"=> "1"));
                            $profilePic = array("profilePic"=> base_url()."uploads/users/".$check_user[0]['profilePic']);
	    					$check_user = array_merge($check_user[0], $profilePic);
	    					$response1 = array('status'=> 'success','result'=> $check_user);
							$response2 = array_merge($response1, array("profile"=> "1"));
							$response3 = array_merge($response2, array("userType"=> '1'));
							$response = array_merge($response3, array("subscription"=> '1'));
                        }
    				}
    			} else if ($check_user[0]['userType'] == '2') {
    				$check_sub = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$check_user[0]['userId']."' AND status IN (1,2)");
    				if(empty($check_sub)) {
                        	$profilePic = array("profilePic"=> base_url()."uploads/users/".$check_user[0]['profilePic']);
	    					$check_user = array_merge($check_user[0], $profilePic);
	    					$response1 = array('status'=> 'success','result'=> $check_user);
							$response2 = array_merge($response1, array("profile"=> "0"));
							$response3 = array_merge($response2, array("userType"=> '2'));
							$response = array_merge($response3, array("subscription"=> '0'));
                    } else {
                    	$profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$check_user[0]['userId']."'")->result_array();
                        if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) {
                        	$profilePic = array("profilePic"=> base_url()."uploads/users/".$check_user[0]['profilePic']);
	    					$check_user = array_merge($check_user[0], $profilePic);
	    					$response1 = array('status'=> 'success','result'=> $check_user);
							$response2 = array_merge($response1, array("profile"=> "0"));
							$response3 = array_merge($response2, array("userType"=> '2'));
							$response = array_merge($response3, array("subscription"=> '1'));
                    	} else {
                            $profilePic = array("profilePic"=> base_url()."uploads/users/".$check_user[0]['profilePic']);
	    					$check_user = array_merge($check_user[0], $profilePic);
	    					$response1 = array('status'=> 'success','result'=> $check_user);
							$response2 = array_merge($response1, array("profile"=> "1"));
							$response3 = array_merge($response2, array("userType"=> '2'));
							$response = array_merge($response3, array("subscription"=> '1'));
                    	}
                    }
    			} else {
                    // $response = array('status'=> 'success','result'=> $check_user);
                    // $response = array_merge($response, array("profile"=> "1"));
                    $profilePic = array("profilePic"=> base_url()."uploads/users/".$check_user[0]['profilePic']);
					$check_user = array_merge($check_user[0], $profilePic);
					$response1 = array('status'=> 'success','result'=> $check_user);
					$response2 = array_merge($response1, array("profile"=> "1"));
					$response3 = array_merge($response2, array("userType"=> '1'));
					$response = array_merge($response3, array("subscription"=> '1'));
    			}
            } else {
                $msg = 'Invalid Email Address or Password';
                $response = array('status'=> 'error','result'=> $msg);
            }
        } catch (\Exception $e) {
            $response = array('status'=> 'error', 'result'=> $e->getMessage());
        }
        echo json_encode($response);
    }

    public function send_forget_password() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
        	if(!empty($formdata['email'])) {
         		$get_email = $this->Crud_model->get_single('users',"email = '".$formdata['email']."'");
             	if(!empty($get_email)) {
                 	$data = array(
    					'email' => $get_email->email
    				);
    				$htmlContent = $this->load->view('email_template/forgot_password',$data,TRUE);
    				require 'vendor/autoload.php';
    				$mail = new PHPMailer(true);
    				try {
    					//Server settings
    					$mail->CharSet = 'UTF-8';
    					$mail->SetFrom('no-reply@goigi.com', 'Automation Engineering Services');
    					$mail->AddAddress($formdata['email']);
    					$mail->IsHTML(true);
    					$mail->Subject = "Forgot Password Confirmation message from Automation Engineering Services";
    					$mail->Body = $htmlContent;
    					//Send email via SMTP
    					$mail->IsSMTP();
    					$mail->SMTPAuth = true;
    					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    					$mail->Host = "smtp.gmail.com";
    					$mail->Port = 587; //587 465
    					$mail->Username = "no-reply@goigi.com";
    					$mail->Password = "wj8jeml3eu0z";
    					$mail->send();
    					$msg = 'Please check your inbox. We have sent you an email to reset your password.';
    					$response = array('status'=> 'success','result'=> $msg);
    				} catch (Exception $e) {
    					$msg = 'Something went wrong. Please try again later!';
    					$response = array('status'=> 'error','result'=> $msg);
    				}
             	} else {
       				$msg = 'Invalid Email Id!';
       				$response = array('status'=> 'error','result'=> $msg);
       			}
    		} else {
				$msg = 'Please enter a valid email address';
				$response = array('status'=> 'error','result'=> $msg);
			}
        } catch (\Exception $e) {
            $response = array('status'=> 'error','result'=> $e->getMessage());
        }
        echo json_encode($response);
	}

    public function logout() {
	    unset($_SESSION['automation']);
        $response = array('status'=> 'success','result'=> 'You have logged out.');
		echo json_encode($response);
	}
}
