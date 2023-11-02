<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_template extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

	}
	function index()
	{
   $get_email=$this->Crud_model->GetData('email_template');
		$header = array('title' => 'email template');

		$data = array(
            'heading' => 'Email Template',
            'get_email' => $get_email,
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/email_template',$data);
        $this->load->view('admin/footer');

	}

  function get_emaildata()
  {
    $get_data=$this->Crud_model->GetData('email_template','',"id='".$_POST['email_id']."'",'','','','1');

    if(!empty($get_data))
    {

        $html_data=array(
          'id'=>$get_data->id,
          'title'=>$get_data->title,
          'description'=>$get_data->description,
          //'signature'=>$get_data->signature,
        );
    }


    echo json_encode($html_data); exit;
  }



  public function update_action()
{
    $data = array(
          //'signature' => $this->input->post('signature',TRUE),
          'description' => $this->input->post('description',TRUE),
      );
    $id=$this->input->post('email_id',TRUE);
    $this->Crud_model->SaveData("email_template",$data,"id='".$id."'");
    //$this->session->set_flashdata('success', 'Email template has been updated successfully !');
    // $this->session->set_flashdata('message', 'Email template has been updated successfully');
    echo "1"; exit;
}


}
