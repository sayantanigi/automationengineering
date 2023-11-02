<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_category extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subcategory_model');
	}
	function index()
	{
		$get_category=$this->Crud_model->GetData('category');
		$get_subcategory=$this->Crud_model->GetData('sub_category');
		$header = array('title' => 'Subcategories');
		$data = array(
			'heading' => 'Subcategories',
			'get_category' => $get_category,
			'get_subcategory' => $get_subcategory,
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/sub_category/list',$data);
		$this->load->view('admin/footer');
	}

	function ajax_manage_page()
	{
		$cond = "1=1";
		$sub_category = $_POST['SearchData6'];

		$from_date = $_POST['SearchData5'];
		//print_r($from_date); exit;
		//$to_date = $_POST['SearchData7'];


		if($sub_category!='')
		{
			$cond .=" and sub_category.id  = '".$sub_category."' ";
		}
		if($from_date!='')
		{
			$cond .=" and sub_category.created_date  >= '".date('Y-m-d',strtotime($from_date))."' ";
		}
		// if($to_date!='')
		// {
		// 	$cond .=" and sub_category.created_date  <= '".date('Y-m-d',strtotime($to_date))."' ";
		// }
		$GetData = $this->Subcategory_model->get_datatables($cond);
		//print_r($GetData); exit;
		if(empty($_POST['start']))
		{

			$no=0;
		}
		else{
			$no =$_POST['start'];
		}
		$data = array();
		foreach ($GetData as $row)
		{

			$btn = ''.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
			$btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2" onclick="subCategoryDelete(this,'.$row->id.')" style="margin-left: 8px;">Delete</span>';
			if(!empty($row->image))
			{

				if(!file_exists("uploads/category/".$row->image))
				{
					$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
				}
				else
				{

					$img ='<a href="'.base_url('uploads/category/'.$row->image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/category/'.$row->image).'"><a>';
				}
			}

			else
			{
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
			}
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = $img.' '.ucwords($row->sub_category_name);
			$nestedData[] = ucwords($row->category_name);

			$nestedData[] = date('d-m-Y',strtotime($row->created_date));
			$nestedData[] = $btn;
			$data[] = $nestedData;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Subcategory_model->count_all($cond),
			"recordsFiltered" => $this->Subcategory_model->count_filtered($cond),
			"data" => $data,
		);

		echo json_encode($output);
	}



	public function create_action() {
		if(isset($_FILES['image']['name'])!='' ) {
			$_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/category/'.$_POST['image'];
			$config2['upload_path'] =  getcwd().'/uploads/category/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;

			$this->image_lib->initialize($config2);

			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['image'];
			}
		} else {
			$image  = "";
		}
		$get_data=$this->Crud_model->get_single('sub_category',"sub_category_name='".$_POST['sub_category_name']."'");
		if(empty($get_data)) {
			$data=array(
				'category_id'=>$_POST['category_id'],
				'sub_category_name'=>$_POST['sub_category_name'],
				'image'=>$image,
				'created_date'=>date('Y-m-d H:i:s'),
			);
			$this->db->insert('sub_category',$data);
			$this->session->set_flashdata('message', 'Subcategory created successfully');
			echo "1"; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
	      	echo "0"; exit;
	    }
	}

	public function get_value()
	{
		$category_data=$this->Crud_model->get_single('sub_category',"id='".$_POST['id']."'");
		if(!empty($category_data->image))
		{

			if(!file_exists("uploads/category/".$category_data->image))
			{
				$img ='<img class="rounded service-img mr-1" src="'.base_url('category/no_image.png').'">';
			}
			else
			{

				$img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/category/'.$category_data->image).'" >';
			}
		}

		else
		{
			$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
		}
		$data=array(
			'id'=>$category_data->id,
			'category_id'=>$category_data->category_id,
			'sub_category_name'=>$category_data->sub_category_name,
			'image'=>$img,
			'old_image'=>$category_data->image,
		);

		echo json_encode($data);exit;
	}


	function update_action()
	{

		if(isset($_FILES['image']['name'])!='' )
		{
			$_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/category/'.$_POST['image'];
			$config2['upload_path'] =  getcwd().'/uploads/category/';
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
				$image  = $_POST['image'];
				@unlink('uploads/category/'.$_POST['old_image']);
			}
		}

		else{
			$image  = $_POST['old_image'];;
		}
		$get_data=$this->Crud_model->get_single_record('sub_category',"sub_category_name='".$_POST['sub_category_name']."' and id!='".$_POST['id']."'");
		if(empty($get_data))
		{
			$data = array(
				'sub_category_name'=> $_POST['sub_category_name'],
				'category_id'=> $_POST['category_id'],
				'image'=>$image,
				'update_date'=>date('Y-m-d H:i:s'),

			);
			$this->Crud_model->SaveData('sub_category',$data,"id='".$_POST['id']."'");
			$this->session->set_flashdata('message', 'Subcategory updated successfully');

			echo 1; exit;
		}
		else{
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo 0; exit;
		}

	}


	public function delete() {
        if(isset($_POST['cid'])) {
			$check_catData = $this->db->query("SELECT * FROM postjob where subcategory_id = '".$_POST['cid']."'")->num_rows();
			if($check_catData > 0) {
				$this->session->set_flashdata('message', 'Job post is there related to this sub category. Please delete the job first to delete this sub category');
				echo 1; exit;
			} else {
				$this->Crud_model->DeleteData('sub_category',"id='".$_POST['cid']."'");
				$this->session->set_flashdata('message', 'Subcategory deleted successfully');
				echo 0; exit;
			}
        }
    }
















}


?>
