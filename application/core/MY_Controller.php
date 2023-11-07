<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $favicon;
	public $logo;
	public $cms;
	public $msg;

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('date', 'english');
		$this->load->model('usermodel');
		//$this->load->library('menu');
		//$this->load->helper('admin_helper');
	}


	public function loggedIn()
	{
		if (!$this->session->has_userdata('userId') || !$this->session->has_userdata('admin')) {
			$redirectto = urlencode(current_url());
			redirect(admin_url('login?redirectto='.$redirectto),'refresh');
		}
	}


	public function eshopLoggedIn()
	{
		if (!$this->session->has_userdata('eshopId') || !$this->session->has_userdata('peokartEshop')) {
			$redirectto = urlencode(current_url());
			redirect(admin_url('login?redirectto='.$redirectto),'refresh');
		}
	}


	public function callApi($url, $method, $data = false)
	{

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('x-api-key: '.RESTAPIKEY));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		switch ($method)
		{
			case "post":
				curl_setopt($curl, CURLOPT_POST, 1);
				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;

			case "put":
				curl_setopt($curl, CURLOPT_PUT, 1);
				break;

			default:
				if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		}

		$result = curl_exec($curl);
		curl_close($curl);
		return json_decode($result);
	}


	public function testInput($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	public function uw($data)
	{
		$data = $this->testInput($data);
		$data = ucwords(strtolower($data));
		return $data;
	}


	public function uc($data)
	{
		$data = $this->testInput($data);
		$data = strtoupper($data);
		return $data;
	}


	public function lc($data)
	{
		$data = $this->testInput($data);
		$data = strtolower($data);
		return $data;
	}


	public function removeNull($array)
	{
		array_walk_recursive($array, function (&$array, $key){
			$array = (null === $array)? '' : $array;
		});
		return $array;
	}


	public function enc_password($password)
	{
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		return $encrypted_password;
	}


	public function my_encrypt($data) {
		return $this->my_simple_crypt($data, 'e');
	}


	public function my_decrypt($data) {
		return $this->my_simple_crypt($data, 'd');
	}


	public function my_simple_crypt( $string, $action = 'e' ) {
		// you may change these values to your own
		$secret_key = HASH_KEY;
		$secret_iv = HASH_KEY;
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

		if ( $action == 'e' ) {
			$output = urlencode(base64_encode(openssl_encrypt( $string, $encrypt_method, $key, 0, $iv )));
		} else if ( $action == 'd' ) {
			$output = urldecode(openssl_decrypt(base64_decode( $string ), $encrypt_method, $key, 0, $iv));
		}
		return $output;
	}


	public function generate_otp($length = 6)
	{
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


	public function mail($data)
	{
		$this->load->library('email');

		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$this->email->from('no_reply@tiuton.co.in', 'Tiunow');
		$this->email->to($data['email']);

		$this->email->subject($data['subject'].' | '.'Tiunow');
		$this->email->message($data['msg']);

		if ($this->email->send()) {
			return true;
		} else {
			return true;
		}
	}


}