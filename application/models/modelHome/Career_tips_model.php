<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Career_tips_model extends CI_Model
{

    var $column_order = array(null,'career_tips.image','career_tips.title','career_tips.description',null); //set column field database for datatable orderable
    // var $column_search = array('ms.country_name','md.state_name','mc.city_name','mc.status'); //set column field database for datatable searchable
    var $order = array('career_tips.id' => 'DESC');

    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('career_tips.*');
        $this->db->from('career_tips');

        $i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
        {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string)
            {
                $cond  = " ";
                $cond.=" (  career_tips.title LIKE '%".trim($show_string)."%' ";
                $cond.=" OR career_tips.description LIKE '%".trim($show_string)."%' ";
                $cond.=" OR  career_tips.status LIKE '%".trim($show_string)."%') ";
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




}
