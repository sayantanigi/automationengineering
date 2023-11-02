<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_logo extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelHome/Company_logo_model');
	}
	function index()
	{

		$header = array('title' => 'Partner Companies');
		$data = array(
			'heading' => 'List of Partner Companies',
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/managehome/companylogo_list',$data);
		$this->load->view('admin/footer');
	}

	public function ajax_manage_page()

	{
		$get_data = $this->Company_logo_model->get_datatables();
		if(empty($_POST['start']))
		{

			$no=0;
		}
		else{
			$no =$_POST['start'];
		}
		$data = array();
		foreach ($get_data as $row)
		{

			$btn = '<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
			$btn .= ' |  '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2" onclick="companyLogoDelete(this,'.$row->id.')" style="margin-left: 8px;">Delete</span>';
			if(!empty($row->logo) && file_exists("uploads/company_logo/".$row->logo))
			{

				$img ='<a href="'.base_url('uploads/company_logo/'.$row->logo).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/company_logo/'.$row->logo).'" ><a>';
			}

			else
			{
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'" >';
			}
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = $img.' '.ucwords($row->name);
			$nestedData[] = $btn;
			$data[] = $nestedData;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Company_logo_model->count_all(),
			"recordsFiltered" => $this->Company_logo_model->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}
	public function create_action()
	{

		if(isset($_FILES['logo']['name']))
		{
			$_POST['logo']= rand(0000,9999)."_".$_FILES['logo']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['logo']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/company_logo/'.$_POST['logo'];
			$config2['upload_path'] =  getcwd().'/uploads/company_logo/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;

			$this->image_lib->initialize($config2);

			if(!$this->image_lib->resize())
			{
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			}
			else{
				$image  = $_POST['logo'];
			}
		}

		else{
			$image  = "";
		}

		$data=array(
			'name'=>$_POST['name'],
			'logo'=>$image,
			'created_date'=>date('Y-m-d H:i:s'),
		);

		$this->db->insert('company_logo',$data);
		$this->session->set_flashdata('message', 'Partner companies logo created successfully');
		echo "1"; exit;

	}

	public function get_value()
	{
		$company_logo_data=$this->Crud_model->get_single('company_logo',"id='".$_POST['id']."'");
		if(!empty($company_logo_data->logo))
		{

			if(!file_exists("uploads/company_logo/".$company_logo_data->logo))
			{
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
			}
			else
			{

				$img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/company_logo/'.$company_logo_data->logo).'" >';
			}
		}

		else
		{
			$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
		}
		$data=array(
			'id'=>$company_logo_data->id,
			'name'=>$company_logo_data->name,
			'image'=>$img,
			'old_image'=>$company_logo_data->logo,
		);

		echo json_encode($data);exit;
	}

	function update_action()
	{
		if(isset($_FILES['logo']['name']))
		{
			$_POST['logo']= rand(0000,9999)."_".$_FILES['logo']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['logo']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/company_logo/'.$_POST['logo'];
			$config2['upload_path'] =  getcwd().'/uploads/company_logo/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;

			$this->image_lib->initialize($config2);

			if(!$this->image_lib->resize())
			{
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			}
			else{
				$image  = $_POST['logo'];
				@unlink('uploads/company_logo/'.$_POST['old_image']);
			}
		}

		else{
			$image  = $_POST['old_image'];;
		}

		$data = array(
			'name'=> $_POST['name'],
			'logo'=>$image,

		);
		$this->Crud_model->SaveData('company_logo',$data,"id='".$_POST['id']."'");
		$this->session->set_flashdata('message', 'Partner companies logo updated successfully');

		echo 1; exit;

	}

	public function delete() {
        if(isset($_POST['cid'])) {
            $this->Crud_model->DeleteData('company_logo',"id='".$_POST['cid']."'");
			$this->session->set_flashdata('message', 'Partner companies logo deleted successfully');
			echo 1; exit;
        }
    }
}
