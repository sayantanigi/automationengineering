<?php
defined('BASEPATH')  OR exit('No direct script are allowed');
class Manage_cms extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cmsmodel');
    }

    public function index() {
        $header = array('title' => 'Content Management');
        $data = array(
            'heading' => 'Content Management',
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/cms/list',$data);
        $this->load->view('admin/footer');
    }

    public function ajax_manage_page() {
        $get_cms = $this->Cmsmodel->get_datatables();
        if(empty($_POST['start'])) {
            $no=0;
        } else {
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($get_cms as $row) {
            $btn = ''.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#viewModal" onclick="view_data('.$row->id.')" data-placement="right"><i class="far fa-eye mr-1"></i>View</span>';
            $btn .= '| '.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
            if(strlen($row->description)>100) {
                $desc=substr($row->description,0,60).'...';
            } else {
                $desc=$row->description;
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($row->title);
            $nestedData[] = $desc;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Cmsmodel->count_all(),
            "recordsFiltered" => $this->Cmsmodel->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function create_action() {
        $get_data=$this->Crud_model->get_single('manage_cms',"title='".$_POST['title']."'");
        if(empty($get_data)) {
            $data = array(
                'title'=> $_POST['title'],
                'description'=>$_POST['description'],
                'created_date'=> date('Y-m-d H:i:s'),
            );
            $this->Crud_model->SaveData('manage_cms',$data);
            $this->session->set_flashdata('message', 'CMS created successfully');
            echo "1"; exit;
        } else {
            $this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
            echo "0"; exit;
        }
    }

    public function get_value() {
        $get_data=$this->Crud_model->get_single('manage_cms',"id='".$_POST['id']."'");
        $data=array(
            'id'=>$get_data->id,
            'title'=>$get_data->title,
            'description'=>$get_data->description,
        );
        echo json_encode($data);exit;
    }

    public function update_action() {
        $update_data=$this->Crud_model->get_single('manage_cms',"title ='".$_POST['title']."' and id!='".$_POST['id']."'");
        if(empty($update_data)) {
            $data=array(
                'title'=>$_POST['title'],
                'description'=>$_POST['description'],
            );
            $this->Crud_model->SaveData('manage_cms',$data,"id='".$_POST['id']."'");
            $this->session->set_flashdata('message', 'CMS updated successfully');
            echo "1";exit;
        } else {
            $this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
            echo "0";exit;
        }
    }

    public function view() {
        $get_data=$this->Crud_model->get_single('manage_cms',"id='".$_POST['id']."'");
        $data=array(
            'description'=>$get_data->description,
        );
        echo json_encode($data);exit;
    }
}
