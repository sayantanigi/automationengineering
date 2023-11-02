<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    
class Services_model extends My_Model {
var $column_order = array(null,'emp.employer_id','emp.service_name','emp.category_id','emp.subcategory_id','emp.created_date',null); //set column field database for datatable orderable
 
    var $order = array('emp.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query()
	{
		$this->db->select('emp.*,category.category_name,CONCAT(users.firstname,"",users.lastname) as fullname,users.username,sub_category.sub_category_name' );
        $this->db->from('employer_services as emp');
        $this->db->join('category','category.id=emp.category_id','left');
        $this->db->join('users','users.userId=emp.employer_id','left');
        $this->db->join('sub_category','sub_category.id=emp.subcategory_id','left');
      // $this->db->where($cond);
		$i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  users.firstname LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  category.category_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  sub_category.sub_category_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  emp.service_name LIKE '%".trim($show_string)."%')";
                    $this->db->where($cond);
                }
            }
        $i++;
        
        if(isset($_POST['order'])) // here order processing
        {
            //print_r($this->column_order);exit;
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

	function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
       // $this->db->where();
        return $query->result();
    }

	 public function count_all()
    {    
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }


	function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function viewdata($con)
    {
        $this->db->select('postjob.*,category.category_name,CONCAT(users.firstname,"",users.lastname) as fullname,sub_category.sub_category_name' );
        $this->db->from('postjob');
        $this->db->join('category','category.id=postjob.category_id');
        $this->db->join('users','users.userId=postjob.user_id');
        $this->db->join('sub_category','sub_category.id=category.id');
        $this->db->where($con);
         $query = $this->db->get();
        return $query->row();
    }    
   
}