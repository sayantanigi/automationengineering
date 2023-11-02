<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("session");
        $this->load->helper('url');
        if (!$this->session->userdata('automation')) {
    	    header("location" . base_url() . "login");
        }
    }


    public function index($price_key) {
        // $subscription_id=base64_decode($id);
        // $data['get_data']=$this->Crud_model->get_single('subscription',"id='".$subscription_id."'");
        // $data['get_user']=$this->Crud_model->get_single('users',"userId='".$_SESSION['automation']['userId']."'");
        $data['amount']= base64_decode($price_key);
        $this->load->view('header');
        $this->load->view('stripe/product_form',$data);
        $this->load->view('footer');
    }

    public function check() {
        //check whether stripe token is not empty
        if(!empty($_POST['stripeToken'])) {
            //get token, card and user info from the form
            $token  = $_POST['stripeToken'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $card_num = $_POST['card_num'];
            $card_cvc = $_POST['cvc'];
            $card_exp_month = $_POST['exp_month'];
            $card_exp_year = $_POST['exp_year'];

            //include Stripe PHP library
            require_once APPPATH."third_party/stripe/init.php";

            //set api key
            /*$stripe = array(
                "secret_key"      => "sk_test_jQ3VKDVYXDwd75C4dNy2PFkD",
                "publishable_key" => "pk_test_mj53x8AO1emJ6ZO5D9k5P0fi"
            );*/

            $stripe = array(
                "secret_key"      => "sk_test_835fqzvcLuirPvH0KqHeQz9K",
                "publishable_key" => "pk_test_kSKjcWbAp63mFILy3vx1mx7Z"
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            //add customer to stripe
            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source'  => $token
            ));

            //item information
            $itemName = "Stripe Donation";
            $itemNumber = "PS123456";
            $itemPrice = 50;
            $currency = "usd";
            $orderID = "SKA92712382139";

            //charge a credit or a debit card
            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $itemPrice,
                'currency' => $currency,
                'description' => $itemNumber,
                'metadata' => array(
                'item_id' => $itemNumber
                )
            ));

            //retrieve charge details
            $chargeJson = $charge->jsonSerialize();

            //check whether the charge is successful
            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
                //order details
                $amount = $chargeJson['amount'];
                $balance_transaction = $chargeJson['balance_transaction'];
                $currency = $chargeJson['currency'];
                $status = $chargeJson['status'];
                $date = date("Y-m-d H:i:s");

                //print_r($status); exit;
                //insert tansaction data into the database
                $dataDB = array(
                    'employer_id' =>$_SESSION['automation']['userId'],
                    'subscription_id' => $_POST['subscription_id'],
                    'name_of_card' =>$name,
                    'email' => $email,
                    'amount' => $_POST['subscription_amount'],
                    'transaction_id' => $balance_transaction,
                    'payment_status' => $status,
                    'payment_date' => $date,
                    'created_date' => date('Y-m-d H:i:s'),
                );

                if ($this->db->insert('employer_subscription', $dataDB)) {
                    if($this->db->insert_id() && $status == 'succeeded') {
                        $this->load->library('email');
                        $data=array(
                            'name'=>$name,
                        );

                        $htmlContent = $this->load->view('email_template/subscription_plan',$data,TRUE);
                        $config = array(
                            'protocol' => 'ssmtp',
                            'smtp_host' => 'ssl://ssmtp.googlemail.com',
                            'smtp_port' => 587,
                            'smtp_user' => 'mediaadgroup',
                            'smtp_pass' => 'Kade2000',
                            'smtp_crypto' => 'security',
                            'mailtype' => 'html',
                            'smtp_timeout' => '4',
                            'charset' => 'iso-8859-1',
                            'wordwrap' => TRUE
                        );

                    	$this->email->initialize($config);
                    	$this->email->from('info@automation.pro','Automation Engineering Services PRO');
                    	$this->email->to($email);
                    	$this->email->subject('Subscription plan Confirmation message from Automation Engineering Services PRO');
                    	$this->email->message($htmlContent);
                    	$this->email->send();
                       // $this->load->view('stripe/payment_success', $data);
                        redirect(base_url('subscription'));
                    } else {
                    	$this->session->set_flashdata('message', 'Transaction has been failed');
                        redirect(base_url('stripe/'.base64_encode($_POST['subscription_id'])));
                    }
                } else {
                	$this->session->set_flashdata('message', 'Transaction has been failed');
                    redirect(base_url('stripe/'.base64_encode($_POST['subscription_id'])));
                }
            } else {
                $this->session->set_flashdata('message', 'Invalid Token');
                $statusMsg = "";
                redirect(base_url('stripe/'.base64_encode($_POST['subscription_id'])));
            }
        }
    }

    public function payment_success($id) {
        $data['s_id'] = $id;
        $this->load->view('header');
        $this->load->view('stripe/payment_success', $data);
        $this->load->view('footer');
    }

    public function payment_error() {
        $this->load->view('stripe/payment_error');
    }

    public function help() {
        $this->load->view('stripe/help');
    }
}
