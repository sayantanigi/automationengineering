<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Specialist extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Specialistmodel');
	}

	function index() {
    	$get_specialist=$this->Crud_model->GetData('specialist');
		$header = array('title' => 'Specializations');
		$data = array(
			'heading' => 'Skill Set',
            'get_specialist' => $get_specialist
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/specialist/list',$data);
        $this->load->view('admin/footer');
	}

	function ajax_manage_page() {
	    $cond = "1=1";
	    $specialist = $_POST['SearchData6'];
        $from_date = $_POST['SearchData5'];
        //print_r($from_date); exit;
        //$to_date = $_POST['SearchData7'];

		if($specialist!='') {
            $cond .=" and specialist.id  = '".$specialist."' ";
        }

        if($from_date!='') {
            $cond .=" and specialist.created_date  >= '".date('Y-m-d',strtotime($from_date))."' ";
        }

        // if($to_date!='') {
        //     $cond .=" and specialist.created_date  <= '".date('Y-m-d',strtotime($to_date))."' ";
        // }

		$GetData = $this->Specialistmodel->get_datatables($cond);

		if(empty($_POST['start'])) {
    		$no=0;
       	} else {
            $no =$_POST['start'];
        }

        $data = array();
        foreach ($GetData as $row) {
            $btn = ''.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
			$btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2" onclick="specialDelete(this,'.$row->id.')" style="margin-left: 8px;">Delete</span>';
			if(!empty($row->specialist_image)) {
	            if(!file_exists("uploads/specialist/".$row->specialist_image)) {
	                $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
	            } else {
	               $img ='<a href="'.base_url('uploads/specialist/'.$row->specialist_image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/specialist/'.$row->specialist_image).'"><a>';
	            }
        	} else {
	            $img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
	        }
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = $img.' '.ucwords($row->specialist_name);
			$nestedData[] = date('d-m-Y',strtotime($row->created_date));
			$nestedData[] = $btn;
			$data[] = $nestedData;
        }

    	$output = array(
			"draw" => $_POST['draw'],
            "recordsTotal" => $this->Specialistmodel->count_all($cond),
            "recordsFiltered" => $this->Specialistmodel->count_filtered($cond),
            "data" => $data,
        );
    	echo json_encode($output);
	}

	public function create_action() {
		$get_data=$this->Crud_model->get_single('specialist',"specialist_name='".$_POST['specialist_name']."'");
		if(isset($_FILES['specialist_image']['name'])!='' ) {
			$_POST['specialist_image']= rand(0000,9999)."_".$_FILES['specialist_image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['specialist_image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/specialist/'.$_POST['specialist_image'];
			$config2['upload_path'] =  getcwd().'/uploads/specialist/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['specialist_image'];
			}
        } else {
           	$image  = "";
        }

        if(empty($get_data)) {
			$data=array(
				'specialist_name'=>$_POST['specialist_name'],
				'specialist_image'=>$image,
				'created_date'=>date('Y-m-d H:i:s'),
			);
			$this->db->insert('specialist',$data);
    		$this->session->set_flashdata('message', 'Skill Set created successfully');
    		echo "1"; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
        	echo "0"; exit;
      	}
	}

   	public function get_value() {
		$specialist_data=$this->Crud_model->get_single('specialist',"id='".$_POST['id']."'");
		if(!empty($specialist_data->specialist_image)) {
            if(!file_exists("uploads/specialist/".$specialist_data->specialist_image)) {
                $img ='<img class="rounded service-img mr-1" src="'.base_url('specialist/no_image.png').'">';
            } else {
               $img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/specialist/'.$specialist_data->specialist_image).'" >';
            }
        } else {
        	$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
        }
		$data=array(
			'id'=>$specialist_data->id,
			'specialist_name'=>$specialist_data->specialist_name,
			'image'=>$img,
			'old_image'=>$specialist_data->specialist_image,
		);
		echo json_encode($data);exit;
  	}

    function update_action() {
      	if(isset($_FILES['specialist_image']['name'])!='' ) {
			$_POST['specialist_image']= rand(0000,9999)."_".$_FILES['specialist_image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['specialist_image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/specialist/'.$_POST['specialist_image'];
			$config2['upload_path'] =  getcwd().'/uploads/specialist/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
          	} else {
                $image  = $_POST['specialist_image'];
             	@unlink('uploads/specialist/'.$_POST['old_image']);
          	}
        } else {
           	$image  = $_POST['old_image'];;
        }
    	$get_data=$this->Crud_model->get_single_record('specialist',"specialist_name='".$_POST['specialist_name']."' and id!='".$_POST['id']."'");
      	if(empty($get_data)) {
			$data = array(
				'specialist_name'=> $_POST['specialist_name'],
				'specialist_image'=>$image,
				'update_date'=>date('Y-m-d H:i:s'),
			);
       		$this->Crud_model->SaveData('specialist',$data,"id='".$_POST['id']."'");
        	$this->session->set_flashdata('message', 'Skill Set updated successfully');
       		echo 1; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
      		echo 0; exit;
     	}
    }

	public function delete() {
        if(isset($_POST['cid'])) {
            $this->Crud_model->DeleteData('specialist',"id='".$_POST['cid']."'");
        }
    }
}
