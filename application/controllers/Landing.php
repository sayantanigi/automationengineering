<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mymodel');
	}

	public function index()
	{
		$data['title']='Home';
		$this->load->view('landing',$data);
	}

	
}
