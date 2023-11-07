<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {

	public function __construct() {
		parent::__construct();

	}

	function index() {
   		$row = $this->Crud_model->get_single('setting');
		$header = array('title' => 'setting');
		$data = array(
			'heading' => 'General Settings',
			'row'=>$row
		);
   		$this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/setting',$data);
        $this->load->view('admin/footer');
	}

  	public function update_action() {
        if($_FILES['logo']['name']!='') {
            $_POST['logo']= rand(0000,9999)."_".$_FILES['logo']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['logo']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/logo/'.$_POST['logo'];
            $config2['allowed_types'] = 'JPG|PNG|jpg|png|gif|GIF|JPEG|jpeg';
            $config2['maintain_ratio'] = FALSE;
            $this->image_lib->initialize($config2);
            if(!$this->image_lib->resize()) {
                $this->session->set_flashdata('message', 'This file type is not allowed');
                $this->index();
                return;
            } else {
				$logo  = $_POST['logo'];
                @unlink('uploads/logo/'.$_POST['old_logo']);
            }
        } else {
           	$logo  = $_POST['old_logo'];
        }

		if($_FILES['flogo']['name']!='') {
            $_POST['flogo']= rand(0000,9999)."_".$_FILES['flogo']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['flogo']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/logo/'.$_POST['flogo'];
            $config2['allowed_types'] = 'JPG|PNG|jpg|png|gif|GIF|JPEG|jpeg';
            $config2['maintain_ratio'] = FALSE;
            $this->image_lib->initialize($config2);
            if(!$this->image_lib->resize()) {
                $this->session->set_flashdata('message', 'This file type is not allowed');
                $this->index();
                return;
            } else {
				$flogo  = $_POST['flogo'];
                @unlink('uploads/logo/'.$_POST['old_flogo']);
            }
        } else {
           	$flogo  = $_POST['old_flogo'];
        }

        if($_FILES['favicon']['name']!='') {
            $_POST['favicon']= rand(0000,9999)."_".$_FILES['favicon']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['favicon']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/logo/'.$_POST['favicon'];
            $config2['allowed_types'] = 'JPG|PNG|jpg|png|gif|GIF|JPEG|jpeg|ico';
            //$config2['width'] = '16px';
            //$config2['height'] = '16px';
            $config2['maintain_ratio'] = FALSE;
            $this->image_lib->initialize($config2);
            if(!$this->image_lib->resize()) {
                $this->session->set_flashdata('message', 'This file type is not allowed');
                $this->index();
                return;
            } else {
                @unlink('uploads/logo/'.$_POST['old_favicon']);
                $favicon  = $_POST['favicon'];
            }
        } else {
        	$favicon  = $_POST['old_favicon'];
        }

    	$data = array(
			'website_name' => ucwords($this->input->post('website_name')),
          	'phone' => $this->input->post('phone'),
          	'email' => $this->input->post('email'),
          	'copyright' => $this->input->post('copyright'),
          	'address' => $this->input->post('address'),
            'fabout' => $this->input->post('fabout'),
          	//'fax' => $this->input->post('fax'),
          	'alternate_email' => $this->input->post('alternate_email'),
			'fb_link' => $this->input->post('fb_link'),
			'tw_link' => $this->input->post('tw_link'),
			'lnkd_link' => $this->input->post('lnkd_link'),
			'ptrs_link' => $this->input->post('ptrs_link'),
			//'baha_link' => $this->input->post('baha_link'),
          	'logo' => $logo,
			'flogo' => $flogo,
          	'favicon' => $favicon,
      	);
    	$id=$this->input->post('id');
    	$this->Crud_model->SaveData("setting",$data,"id='".$id."'");
    	$this->session->set_flashdata('message', 'Settings has been updated successfully');
    	redirect(admin_url('setting'));
	}
}
