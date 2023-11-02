<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Apimodel extends CI_Model
{
  function __construct() 
  {
    parent::__construct();
  }   

  
  public function add_details($tbl,$data)
  {  
    $this->db->insert($tbl,$data);
    $lastid= $this->db->insert_id();
    return $lastid;
  }

  public function email_exists($email)
  {
    $where = array( 
          'email' => $email
    );
    
   $this->db->where($where);
   $query = $this->db->get('users');

   if($query->num_rows()>0)
   { 
     return TRUE; 
   } 
   else 
   { 
     return FALSE; 
   }
 }

  public function get_cond($tablename,$cond)
  {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where($cond); 
    $query = $this->db->get();
    $res = $query->row();
    return $res; 
  }

  public function get_cond_all($tablename, $cond) 
  {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where($cond); 
    $query = $this->db->get();
    $res = $query->result();
    return $res ; 
  }

  public function update_cond($tablename,$cond,$value) 
  {
    $this->db->where($cond); 
    $this->db->update($tablename, $value);
    return true;
  }
  public function fetch_all_join($query)
  {
    $query = $this->db->query($query);
    return $query->result();        
  }
  public function fetch_single_join($query)
  {
    $query = $this->db->query($query);
    return $query->row();        
  }
  public function delete_single_con($tbl,$where)
  {
    $this->db->where($where);
    $delete = $this->db->delete($tbl); 
    return $delete;

  }

  public function validateOtp($email,$otp)
  {
    $where = "email = '".$email."' AND otp = '".$otp."' AND `status`=1";
    if ($this->count('users', $where) != 1) {
      $msg = 0;
    } else {
      $user = $this->db->query("SELECT * from users WHERE email = '".$email."' AND otp= '".$otp."'")->row();
      $msg = $user;
    }
    return $msg;
  }

  public function count($table, $where = NULL)
  {
    if ($where != NULL) {
      $this->db->where($where);

    }
    $this->db->from($table);
    return $this->db->count_all_results();

  }
  
}

?>