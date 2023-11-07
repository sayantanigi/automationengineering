<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Users_model extends My_Model {



    var $column_order = array(null,'users.userType','users.username','users.email','users.mobile','users.created','users.status',null); //set column field database for datatable orderable

    var $order = array('users.userId' => 'DESC');



    function __construct() {

        parent::__construct();

    }



    private function _get_datatables_query() {

        $this->db->select('users.*');

        $this->db->from('users');

        // $this->db->where($cond);

        $i = 0;



        if($_POST['search']['value']) {

            $explode_string = explode(' ', $_POST['search']['value']);

            foreach ($explode_string as $show_string) {

                $cond  = " ";

                $cond.=" ( users.username LIKE '%".trim($show_string)."%' ";

                $cond.=" OR  users.email LIKE '%".trim($show_string)."%' ";

                $cond.=" OR  users.mobile LIKE '%".trim($show_string)."%' ";

                $cond.=" OR  users.created LIKE '%".trim(date('Y-m-d',strtotime($show_string)))."%') ";





                $this->db->where($cond);

            }

        }

        $i++;

        if(isset($_POST['order'])) {

            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

        } else if(isset($this->order)) {

            $order = $this->order;

            $this->db->order_by(key($order), $order[key($order)]);

        }

    }



    function get_datatables() {

        $this->_get_datatables_query();

        if($_POST['length'] != -1)

        $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        //$this->db->where($cond);

        return $query->result();

    }



    public function count_all() {

        $this->_get_datatables_query();

        return $this->db->count_all_results();

    }



    function count_filtered() {

        $this->_get_datatables_query();

        $query = $this->db->get();

        return $query->num_rows();

    }



    function getChat() {

        //$this->db->select('chat.*,users.username,CONCAT(users.firstname," ",users.lastname) as full_name,users.profilePic,to_user.username as to_username,CONCAT(to_user.firstname," ",to_user.lastname) as to_fullname,to_user.profilePic as to_profile');

        $this->db->select('chat.*,users.username,CONCAT(users.firstname," ",users.lastname) as full_name,users.profilePic,to_user.username as to_username,CONCAT(to_user.firstname," ",to_user.lastname) as to_fullname');

        $this->db->from('chat');

        $this->db->join('users','users.userId=chat.userfrom_id');

        $this->db->join('users to_user','to_user.userId=chat.userto_id');

        $query = $this->db->get();

        //print_r($this->db->last_query());

        return $query->result();

    }



    function getCurrentChat($userfrom_id, $user_id, $post_id) {

        $this->db->select('chat.*,users.username,CONCAT(users.firstname," ",users.lastname) as full_name,users.profilePic,to_user.username as to_username,CONCAT(to_user.firstname," ",to_user.lastname) as to_fullname');

        $this->db->from('chat');

        $this->db->join('users','users.userId=chat.userfrom_id');

        $this->db->join('users to_user','to_user.userId=chat.userto_id');

        // $this->db->where("chat.postjob_id = '".$post_id."' AND ((userfrom_id ='".$userfrom_id."' AND userto_id ='".$user_id."') OR (userto_id ='".$user_id."' AND userfrom_id ='".$userfrom_id."'))");

        $this->db->where("chat.postjob_id = '".$post_id."'");

        $query = $this->db->get();

        // print_r($this->db->last_query());

        return $query->result();

    }



    function getmessage($con) {

        $this->db->select('chat.*,users.username,CONCAT(users.firstname," ",users.lastname) as full_name,users.profilePic,to_user.username as to_username,CONCAT(to_user.firstname," ",to_user.lastname) as to_fullname,to_user.profilePic as to_profile');

        $this->db->from('chat');

        $this->db->join('users','users.userId=chat.userfrom_id');

        $this->db->join('users to_user','to_user.userId=chat.userto_id');

        $this->db->where($con);

        $query = $this->db->get();

        return $query->row();

    }



    function get_jobbidding($cond) {

        $this->db->select('job_bid.*,job_bid.user_id as userid,users.username,CONCAT(users.firstname," ",users.lastname) as full_name,users.profilePic,postjob.user_id,postjob.id as post_id,postjob.post_title as post_title');

        $this->db->from('job_bid');

        $this->db->join('postjob','postjob.id=job_bid.postjob_id','left');

        $this->db->join('users','users.userId=job_bid.user_id','left');

        $this->db->where($cond);

        $query = $this->db->get();

        return $query->result();

    }



    /*function get_users() {

        //$this->db->select('users.*,rt.worker_id,AVG(rt.rating) as rate,category.category_name,');

        $this->db->select('users.*,rt.worker_id,AVG(rt.rating) as rate,');

        $this->db->from('users');

        //$this->db->join('category','category.id=users.serviceType','left');

        $this->db->join('employer_rating rt','rt.worker_id=users.userId','left');

        $this->db->where('users.userType','1');

        //$this->db->group_by('rt.worker_id');

        $this->db->group_by('users.userId');

        $this->db->order_by('users.userId','DESC');

        $this->db->limit(8);

        $query = $this->db->get();

        return $query->result();

    }*/



    function get_users() {

        // $query = $this->db->query("SELECT users.*, employer_subscription.*, rt.worker_id, AVG(rt.rating) as rate FROM users LEFT JOIN employer_subscription ON employer_subscription.employer_id = users.userId LEFT JOIN employer_rating rt ON rt.worker_id=users.userId WHERE users.userType = '1' AND users.status = '1' AND users.email_verified = '1' GROUP BY rt.worker_id ORDER BY users.userId DESC");

        $query = $this->db->query("SELECT users.*, employer_subscription.employer_id FROM users JOIN employer_subscription ON employer_subscription.employer_id = users.userId WHERE users.userType = '1' AND users.status = '1' AND users.email_verified = '1' ORDER BY users.userId DESC");

        return $query->result();

    }



    function users_detail($cond) {

        $this->db->select('users.*,category.category_name');

        $this->db->from('users');

        $this->db->join('category','category.id=users.serviceType','left');

        $this->db->where($cond);

        $query = $this->db->get();

        return $query->row();

    }



    function getcount() {

        $this->db->select('users.*,category.category_name');

        $this->db->from('users');

        $this->db->join('category','category.id=users.serviceType','left');

        $this->db->where('users.userType','1');

        $this->db->order_by('users.userId','desc');

        $query = $this->db->get();

        return $query->result();

    }



    function fetchdata($limit, $start) {

        $this->db->select('users.*,category.category_name');

        $this->db->from('users');

        $this->db->join('category','category.id=users.serviceType','left');

        $this->db->where('users.userType','1');

        $this->db->limit($limit, $start);

        $this->db->order_by('users.userId','desc');

        $data = $this->db->get();

        $output = '';

        if(!empty($data)) {

            foreach($data->result_array() as $row) {

                if(!empty($row['firstname'])) {

                    $name= $row['firstname'].' '.$row['lastname'];

                } else {

                    $name=$row['username'];

                }



                if(strlen($row['short_bio'])>100) {

                    $desc= substr($row['short_bio'], 0,100).'...';

                } else {

                    $desc= $row['short_bio'];

                }

                $output .= '<div class="emply-resume-list"> <div class="emply-resume-info"> <h3><a href="javascript:void(0)" title="">'.$name.'</a></h3> <span>'.$row['category_name'].'</span> <p><i class="la la-map-marker"></i>'. $row['address'].'</p> <p>'.strip_tags($desc).'</p> </div> <div class="shortlists" style="width:50px;"> <a href="'.base_url('worker-detail/'.base64_encode($row['userId'])).'" title="">View Profile<i class="la la-plus"></i></a> </div> </div>';

            }

        } else {

            $output .= ' <div class="emply-resume-list">

            <div class="emply-resume-thumb">

            <h2>No Data Found</h2>

            </div>

            </div>';

        }

        return $output;

    }

        ////////////////////// ajax list employer///////////////////////



    function get_employercount() {

        $this->db->select('users.*,category.category_name');

        $this->db->from('users');

        $this->db->join('category','category.id=users.serviceType','left');

        $this->db->where('users.userType','2');

        $this->db->order_by('users.userId','desc');

        $query = $this->db->get();

        return $query->result();

    }



    function make_query($title, $category_id, $subcategory_id, $search_location, $days, $userType) {

        if(isset($title) || isset($category_id) || isset($subcategory_id) || isset($search_location) || isset($days) || isset($userType)) {

            $query = "SELECT * FROM users LEFT JOIN postjob ON users.userId = postjob.user_id WHERE users.userType = $userType";

            if(isset($title) && !empty($title)) {

                $query .= " AND users.companyname like '%".$title."%'";

            }



            if(isset($search_location) && !empty($search_location)) {

                $query .= " AND users.address like '%".$search_location."%'";

            }



            if(isset($category_id) && !empty($category_id)) {

                $query .= " AND postjob.category_id='".$category_id."'";

            }



            if(isset($subcategory_id) && !empty($subcategory_id)) {

                $query .= " AND postjob.subcategory_id='".$subcategory_id."'";

            }



            if(isset($days) && !empty($days)) {

                if($days=='one') {

                    $query .=" AND users.created>=NOW()-INTERVAL 1 HOUR";

                } else {

                    $current_date=date('Y-m-d');

                    $dates=date('Y-m-d', strtotime($current_date.'-'.$days.'days'));

                    $query .=" AND users.created>='".$dates."'";

                }

            }



            if(isset($specialist) && !empty($specialist)) {

                $query .= " AND instr(concat(',', skills, ','), ',$specialist,'))";

            }

            $query .= " AND users.status = 1 and users.email_verified = 1 GROUP BY users.userId";

            return $query;

        }

    }



    function make_workers_query($title, $search_location, $specialist, $userType) {

        if(isset($title) || isset($search_location) || isset($specialist) || isset($userType)) {

            $query = "SELECT * FROM users WHERE users.userType = $userType";

            if(isset($title) && !empty($title)) {

                $query .= " AND users.companyname like '%".$title."%'";

            }



            if(isset($search_location) && !empty($search_location)) {

                $query .= " AND users.address like '%".$search_location."%'";

            }



            if(isset($specialist) && !empty($specialist)) {

                $query .= " AND instr(concat(',', skills, ','), ',$specialist,')";

            }

            //$query .= " AND users.userType = '2'";

            return $query;

        }

    }



    function employer_fetchdata($limit, $start, $title, $category_id, $subcategory_id, $search_location, $days, $userType) {

        if(isset($title) || isset($category_id) || isset($subcategory_id) || isset($search_location) || isset($days) || isset($userType)) {

            $query = $this->make_query($title, $category_id, $subcategory_id, $search_location, $days, $userType);

            $query .= ' ORDER BY userId DESC';

            $query .= ' LIMIT '.$start.', ' . $limit;

            $data = $this->db->query($query);

        } else {

            $query = "SELECT * FROM users WHERE status = '1' AND email_verified = '1' ORDER BY userId DESC";

            $query .= ' LIMIT '.$start.', ' . $limit;

            $data = $this->db->query($query);

        }



        $output = '';

        if(!empty($data->result_array())) {

            foreach($data->result_array() as $row) {

                $get_post=$this->Crud_model->GetData('postjob','',"user_id='".$row['userId']."'");

                if(!empty($row['firstname'])){

                    $name= $row['firstname'].' '.$row['lastname'];

                } else{

                    $name=$row['companyname'];

                }



                if(strlen($row['short_bio'])>100){

                    $desc= substr(strip_tags($row['short_bio']), 0,100).'...';

                } else {

                    $desc= strip_tags($row['short_bio']);

                }



                if(!empty($row['profilePic']) && file_exists('uploads/users/'.$row['profilePic'])){



                    $profile_pic= '<img src="'.base_url('uploads/users/'.$row['profilePic']).'" alt="" />';



                } else {

                    $profile_pic= '<img src="'.base_url('uploads/users/user.png').'" alt="" />';

                }

                $output .= '<div class="emply-resume-list"> <div class="emply-resume-thumb">'.$profile_pic.'</div> <div class="emply-resume-info"> <h3><a href="javascript:void(0)" title="">'.$name.'</a></h3><p><i class="la la-map-marker"></i>'. $row['address'].'</p> <p>'.$desc.'</p> <p>Job Posts : '.count($get_post).'</p> </div> <div class="shortlists" style="width:50px;"> <a href="'.base_url('employerdetail/'.base64_encode($row['userId'])).'" title="">View Profile<i class="la la-plus"></i></a> </div> </div>';

            }

        } else {

            $output .= '<div class="emply-resume-list"><div class="emply-resume-thumb"><h2>No Data Found</h2></div></div>';

        }

        return $output;

    }



    function workers_fetchdata($limit, $start, $title, $search_location, $specialist, $userType) {

        if(isset($title) || isset($search_location) || isset($specialist) || isset($userType)) {

            $query = $this->make_workers_query($title, $search_location, $specialist, $userType);

            $query .= ' AND users.status = 1 and users.email_verified = 1 ORDER BY userId DESC';

            $query .= ' LIMIT '.$start.', ' . $limit;

            $data = $this->db->query($query);

        } else {

            $query = "SELECT * FROM users WHERE status = '1' AND email_verified = '1' ORDER BY userId DESC";

            $query .= ' LIMIT '.$start.', ' . $limit;

            $data = $this->db->query($query);

        }



        $output = '';

        if(!empty($data->result_array())) {

            foreach($data->result_array() as $row) {

                $get_post=$this->Crud_model->GetData('postjob','',"user_id='".$row['userId']."'");

                if(!empty($row['firstname'])){

                    $name= $row['firstname'].' '.$row['lastname'];

                } else{

                    $name=$row['companyname'];

                }



                if(strlen($row['short_bio'])>100){

                    $desc= substr(strip_tags($row['short_bio']), 0,100).'...';

                } else {

                    $desc= strip_tags($row['short_bio']);

                }



                if(!empty($row['profilePic']) && file_exists('uploads/users/'.$row['profilePic'])){



                    $profile_pic= '<img src="'.base_url('uploads/users/'.$row['profilePic']).'" alt="" />';



                } else {

                    $profile_pic= '<img src="'.base_url('uploads/users/user.png').'" alt="" />';

                }

                $output .= '<div class="emply-resume-list"> <div class="emply-resume-thumb">'.$profile_pic.'</div> <div class="emply-resume-info"> <h3><a href="javascript:void(0)" title="">'.$name.'</a></h3><p><i class="la la-map-marker"></i>'. $row['address'].'</p> <p>'.$desc.'</p> <p> Jobs Bid : '.count($get_post).'</p> </div> <div class="shortlists" style="width:50px;"> <a href="'.base_url('worker-detail/'.base64_encode($row['userId'])).'" title="">View Profile<i class="la la-plus"></i></a> </div> </div>';

            }

        } else {

            $output .= '<div class="emply-resume-list"><div class="emply-resume-thumb"><h2>No Data Found</h2></div></div>';

        }

        return $output;

    }

    ////////////////////// end ajax list employer///////////////////////



    function vendor_fetchdataForAPI($limit, $start, $title, $category_id, $subcategory_id, $search_location, $days, $userType) {

        if(isset($title) || isset($category_id) || isset($subcategory_id) || isset($search_location) || isset($days) || isset($userType)) {

            $query = $this->make_query($title, $category_id, $subcategory_id, $search_location, $days, $userType);

            $query .= ' ORDER BY userId DESC';

            $query .= ' LIMIT '.$start.', ' . $limit;

            $data = $this->db->query($query)->result_array();

            foreach($data as $key => $arr) {

                $arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];

                $return[$key] = $arr;

            }

            $data = $return;

        } else {

            $query = "SELECT * FROM users WHERE status = '1' AND email_verified = '1' AND userType = '2' ORDER BY userId DESC";

            $query .= ' LIMIT '.$start.', ' . $limit;

            $data = $this->db->query($query)->result_array();

            foreach($data as $key => $arr) {

                $arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];

                $return[$key] = $arr;

            }

            $data = $return;

        }

        return $data;

    }



    function freelancer_fetchdataForAPI($limit, $start, $title, $search_location, $specialist, $userType) {

        if(isset($title) || isset($search_location) || isset($specialist) || isset($userType)) {

            $query = $this->make_workers_query($title, $search_location, $specialist, $userType);

            $query .= ' AND users.status = 1 and users.email_verified = 1 ORDER BY userId DESC';

            $query .= ' LIMIT '.$start.', ' . $limit;

            $data = $this->db->query($query)->result_array();

            $data = $this->db->query($query)->result_array();

            foreach($data as $key => $arr) {

                $arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];

                $return[$key] = $arr;

            }

            $data = $return;

        } else {

            $query = "SELECT * FROM users WHERE status = '1' AND email_verified = '1' AND userType = '1' ORDER BY userId DESC";

            $query .= ' LIMIT '.$start.', ' . $limit;

            $data = $this->db->query($query)->result_array();

            foreach($data as $key => $arr) {

                $arr['profilePic'] = base_url().'uploads/users/'.$arr['profilePic'];

                $return[$key] = $arr;

            }

            $data = $return;

        }

        return $data;

    }

}

