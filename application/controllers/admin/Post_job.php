<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_job extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Post_job_model');
	}

	function index() {
		//$get_category=$this->Crud_model->GetData('category');
		$header = array('title' => 'Job Posts');
		$data = array(
			'heading' => 'Job Posts',
            //'get_category' => $get_category
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/post_job/list',$data);
        $this->load->view('admin/footer');
	}

	function ajax_manage_page() {
		$GetData = $this->Post_job_model->get_datatables();
        if(empty($_POST['start'])) {
    		$no=0;
       	} else {
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row) {
			$string = strip_tags($row->post_title);
			if (strlen($string) > 100) {
				$stringCut = substr($string, 0, 50);
				$endPoint = strrpos($stringCut, ' ');
				$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
				$string .= '...';
			}
			if($row->status=="Active"){
                $status='<div class="status-toggle">
                <input id="rating_\''.$row->id.'\'" class="check" type="checkbox" checked onClick="status('.$row->id.');">
                <label for="rating_\''.$row->id.'\'" class="checktoggle">checkbox</label>
                </div>';
            }
            else
            {
                $status='<div class="status-toggle">
                <input id="rating_\''.$row->id.'\'" class="check" type="checkbox" onClick="status('.$row->id.');">
                <label for="rating_\''.$row->id.'\'" class="checktoggle">checkbox</label>
                </div>';
            }
			$btn = ''.anchor(base_url('postdetail/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2" title="View"><i class="far fa-eye mr-1"></i></span>');
			$btn .= ''.anchor(base_url('admin/update-postjob/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2" title="Edit"><i class="far fa-edit mr-1"></i></span>');
			// $btn .= ''.anchor(base_url('admin/deletepostdetail/'.base64_encode($row->id)),'<span class="btn btn-sm bg-danger-light mr-2" title="Delete" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash mr-1"></i></span>');
			$btn .= '<span class="btn btn-sm bg-danger-light mr-2" title="Delete" onclick="deleteJobpost('.$row->id.');"><i class="fa fa-trash mr-1"></i></span>';

			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucwords($string);
			$nestedData[] = ucwords($row->category_name);
			$nestedData[] = $row->duration;
			$nestedData[] = "USD"." ".$row->charges;
			$nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
			$nestedData[] = $btn;
			$data[] = $nestedData;
        }

    	$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Post_job_model->count_all(),
            "recordsFiltered" => $this->Post_job_model->count_filtered(),
            "data" => $data,
        );
    	echo json_encode($output);
	}

	function getVisIpAddr() {
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        	return $_SERVER['HTTP_CLIENT_IP'];
    	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	return $_SERVER['HTTP_X_FORWARDED_FOR'];
    	} else {
        	return $_SERVER['REMOTE_ADDR'];
    	}
	}

	public function update_post_job($id) {
		$vis_ip = $this->getVisIPAddr(); // Store the IP address
		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));
		$work_id = base64_decode($id);
		$update_data = $this->Crud_model->get_single('postjob', "id='" . $work_id . "'");
		//$get_keySkills = $this->Crud_model->GetData('specialist', 'id, specialist_name', "");
		//$getcategory = $this->Crud_model->GetData('category', 'id, category_name', "");
		//$getsubcategory = $this->Crud_model->GetData('sub_category', 'id, sub_category_name', "");
		//$get_country = $this->Crud_model->GetData('countries', 'id, name', "");
		//$get_state = $this->Crud_model->GetData('states', 'id, name', "");
		//$get_cities = $this->Crud_model->GetData('cities', 'id, name', "");
		$data = array(
			'button' => 'update',
			'action' => base_url('admin/Post_job/edit_post_job'),
			'post_title' => $update_data->post_title,
			'description' => $update_data->description,
			//'duration' => $update_data->duration,
			'key_skills' => $update_data->required_key_skills,
			'duration' => $update_data->duration,
			'charges' => $update_data->charges,
			'currency' => $update_data->currency,
			'category' => $update_data->category_id,
			'subcategory' => $update_data->subcategory_id,
			'appli_deadeline' => $update_data->appli_deadeline,
			'countries' => $update_data->country,
			'state' => $update_data->state,
			'cities' => $update_data->city,
			'location' => $update_data->location,
			'latitude' => $update_data->latitude,
			'longitude' => $update_data->longitude,
			'id' => $work_id,
			'heading' => 'Job Posts',
			'countryName' => $ipdat->geoplugin_countryName,
		);
		$header = array('title' => 'Job Posts');
		$this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/post_job/update_postjob', $data);
        $this->load->view('admin/footer');
	}


	public function edit_post_job() {
		//echo "<pre>"; print_r($_SESSION); die();
		$key_skills = $this->input->post('key_skills');
		for ($i=0; $i < count($key_skills); $i++) {
			$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '".$key_skills[$i]."'")->result();
			if(empty($get_specialist)) {
				$insrt = array(
					'specialist_name'=>ucfirst($key_skills[$i]),
					'created_date'=>date('Y-m-d H:i:s'),
				);
				$this->db->insert('specialist',$insrt);
			}
		}
		$id = $_POST['id'];
		$data=array(
			//'user_id'=>$_SESSION['automation']['userId'],
			'required_key_skills'=>implode(", ",$this->input->post('key_skills',TRUE)),
			'category_id'=>$this->input->post('category_id',TRUE),
			'subcategory_id'=>$this->input->post('subcategory_id',TRUE),
			'post_title'=>$this->input->post('post_title',TRUE),
			'description'=>$this->input->post('description',TRUE),
			'duration'=>$this->input->post('duration',TRUE),
			'charges'=>$this->input->post('charges',TRUE),
			'currency'=>$this->input->post('currency',TRUE),
			'location'=>$this->input->post('location',TRUE),
			'latitude'=>$this->input->post('latitude',TRUE),
			'longitude'=>$this->input->post('longitude',TRUE),
			//'complete_address'=>$this->input->post('complete_address',TRUE),
			'country'=>$this->input->post('country-dropdown',TRUE),
			'state'=>$this->input->post('state-dropdown',TRUE),
			'city'=>$this->input->post('city-dropdown',TRUE),
			'appli_deadeline'=>$this->input->post('appli_deadeline',TRUE),
			'created_date'=>date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('postjob', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Post Job Updated Successfully !');
		redirect(base_url('admin/post_job'));
		// if(!empty($_SESSION['automation_admin'])) {
		// 	redirect(base_url('admin/post_job'));
		// } else {
		// 	redirect(base_url('myjob'));
		// }

	}

	function view($id) {
	 	$con="postjob.id='".base64_decode($id)."'";
	 	$get_post_job=$this->Post_job_model->viewdata($con);
		//print_r($get_post_job); die();
		$header = array('title' => 'Job Details');
		$data = array(
			'heading' => 'Job Details',
			'get_post_job' => $get_post_job,
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/post_job/view',$data);
		$this->load->view('admin/footer');
	}

	function deletepostdetail() {
	 	$con = $this->input->post('jobid');
	 	$query = $this->db->query("DELETE FROM postjob WHERE id = ".$con."");
	 	if($query) {
	 		echo '1';
	 	} else {
			echo '2';
		}
	 }
}
?>
