<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating_type extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rating_type_model');
	}
	function index()
	{
		$get_category=$this->Crud_model->GetData('category');
		$header = array('title' => 'Rating Type');
		$data = array(
			'heading' => 'Rating',
			'get_category' => $get_category
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/rating/list',$data);
		$this->load->view('admin/footer');
	}
	public function change_status()
    {
        if($_POST['status']=='Active')
        {
            $statuss='Inactive';

        }
        else if($_POST['status']=='Inactive'){
            $statuss='Active';

        }
        $data=array(
            'status'=>$statuss,
        );
        $this->Crud_model->SaveData("postjob",$data,"id='".$_POST['id']."'");

    }

	function ajax_manage_page()
	{

		//$category = $_POST['SearchData6'];


		$GetData = $this->Rating_type_model->get_datatables();
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
			if($row->status=="Active"){
				$status='<div class="status-toggle">
				<input id="rating_\''.$row->id.'\'" class="check" type="checkbox" checked onClick="status('.$row->id.');">
				<label for="rating_\''.$row->id.'\'" class="checktoggle">checkbox</label>
				</div>';
			}
			else if($row->status=="Inactive")
			{
				$status='<div class="status-toggle">
				<input id="rating_\''.$row->id.'\'" class="check" type="checkbox" onClick="status('.$row->id.');">
				<label for="rating_\''.$row->id.'\'" class="checktoggle">checkbox</label>
				</div>';
			}

			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucwords($row->rating_type);
			$nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
			$nestedData[] = $btn;
			$data[] = $nestedData;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Rating_type_model->count_all(),
			"recordsFiltered" => $this->Rating_type_model->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}


	public function create_action()
	{
		$get_data=$this->Crud_model->get_single('rating_type',"rating_type='".$_POST['rating_type']."'");

		if(empty($get_data))
		{
			$data=array(
				'rating_type'=>$_POST['rating_type'],
				'created_date'=>date('Y-m-d H:i:s'),
			);

			$this->db->insert('rating_type',$data);
			$this->session->set_flashdata('message', 'Rating type created successfully');
			echo "1"; exit;
		}

		else{
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0"; exit;
		}

	}


	public function get_value()
	{
		$rating_data=$this->Crud_model->get_single('rating_type',"id='".$_POST['id']."'");

		$data=array(
			'id'=>$rating_data->id,
			'rating_type'=>$rating_data->rating_type,
		);

		echo json_encode($data);exit;
	}


	function update_action()
	{

		$get_data=$this->Crud_model->get_single_record('rating_type',"rating_type='".$_POST['rating_type']."' and id!='".$_POST['id']."'");
		if(empty($get_data))
		{
			$data = array(
				'rating_type'=> $_POST['rating_type'],

				'update_date'=>date('Y-m-d H:i:s'),

			);
			$this->Crud_model->SaveData('rating_type',$data,"id='".$_POST['id']."'");
			$this->session->set_flashdata('message', 'Rating type Updated successfully');

			echo 1; exit;
		}
		else{
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo 0; exit;
		}

	}

	// public function change_status()
	// {
	// 	if($_POST['status']=='Active')
	// 	{
	// 		$statuss='Inactive';

	// 	}
	// 	else if($_POST['status']=='Inactive'){
	// 		$statuss='Active';

	// 	}
	// 	$data=array(
	// 		'status'=>$statuss,
	// 	);
	// 	$this->Crud_model->SaveData("rating_type",$data,"id='".$_POST['id']."'");

	// }

}
?>
