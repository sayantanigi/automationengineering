<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends MY_Model {

	public function insert($table, $data)
	{

		if($this->db->insert($table, $data)) {

			return true;

		} else {

			return false;

		}
	}

	public function getApprovalStatus($userId)
	{

		$user = $this->select('approval', 'users', true, ['userId' => $userId]);
		return $user->approval;
	}

	public function getSettings()
	{

		return $this->get('settings', true, 'settingId', '1');
	}

	public function cartlist($userId)
	{
		$sql="SELECT ct.cartId,p.productId, p.productName, ct.quantity, p.price,(SELECT pimg.productImage FROM product_images AS pimg WHERE pimg.productId = p.productId LIMIT 1) AS productImage
		From cart as ct
		JOIN products AS p ON p.productId=ct.productId
		JOIN subcategory AS sc ON sc.subcategoryId = p.subcategoryId
		JOIN category AS c ON c.categoryId = sc.categoryId
		WHERE ct.userId = '".$userId."'";

		return $this->fetch($sql,false);

	}

	public function check_record($email, $password){
		$this->db->select ( "*" );
		$this->db->from("users");
		$this->db->where("email", $email);
		$this->db->where("password", md5($password));
        $this->db->where("status", '1');
		$query = $this->db->get();
		if($query->num_rows() > 0) {
            $result = $query->row();
            $data['automation'] = array(
                'userId'=>$result->userId,
				'companyname'=>$result->companyname,
                'firstname'=>$result->firstname,
				'lastname'=>$result->lastname,
                'userEmail'=>$result->email,
                'userMobile'=>$result->mobile,
                'userType'=>$result->userType,
                'UserLoggedIn'=> TRUE,
            );
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
	}

	function get_unique_url($url, $id = false)
    {
        $this->db->select('slug, productId');
        $this->db->where('slug', $url);
        $rest = $this->db->get('products');
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_url($url, $id);
            }
        }
    }

    function get_unique_urlCategory($url, $id = false)
    {
        $this->db->select('slug, categoryId');
        $this->db->where('slug', $url);
        $rest = $this->db->get('category');
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_urlCategory($url, $id);
            }
        }
    }

    function get_unique_urlSubCategory($url, $id = false)
    {
        $this->db->select('slug, subcategoryId');
        $this->db->where('slug', $url);
        $rest = $this->db->get('subcategories');
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_urlSubCategory($url, $id);
            }
        }
    }

    function get_unique_urlchildSubCategory($url, $id = false)
    {
        $this->db->select('slug, id');
        $this->db->where('slug', $url);
        $rest = $this->db->get('childsubcategoies');
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_urlchildSubCategory($url, $id);
            }
        }
    }

    public function getIP()
    {
        if ( getenv("HTTP_CLIENT_IP") ) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif ( getenv("HTTP_X_FORWARDED_FOR") ) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if ( strstr($ip, ',') ) {
                $tmp = explode(',', $ip);
                $ip = trim($tmp[0]);
            }
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
        if($ip=='::1')
        {
            $ip = "103.94.87.38";
        }
        return $ip;
    }

    public function updateCouponStatus($tbl, $order_id)
    {
        $this->db->where(array('order_id'=>$order_id));
        $this->db->update($tbl,array('used_status'=>'1'));
    }

    public function save_msg($data)
    {
        $this->db->insert('chats',$data);
        $q = $this->db->insert_id();
        return $q;
    }

    public function chat_history($sender_id,$receiver_id,$product_id)
    {
        $sql = "SELECT c.*, u.firstName, u.lastName FROM chats AS c JOIN users as u ON c.sender_id = u.userId WHERE (sender_id = '".$sender_id."' AND receiver_id = '".$receiver_id."' AND product_id = '".$product_id."') OR (sender_id = '".$receiver_id."' AND receiver_id = '".$sender_id."' AND product_id = '".$product_id."') ORDER BY c.created_at ASC  ";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    public function chat_history_for_admin($sender_id,$receiver_id,$product_id)
    {
        $sql = "SELECT c.* FROM chats AS c JOIN users as u ON c.sender_id = u.userId WHERE (sender_id = '".$sender_id."' AND receiver_id = '".$receiver_id."' AND product_id = '".$product_id."') OR (sender_id = '".$receiver_id."' AND receiver_id = '".$sender_id."' AND product_id = '".$product_id."') ORDER BY c.created_at ASC  ";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    public function getCustomers($userId)
    {
        $sql = "SELECT u.userId, u.firstName, u.lastName, u.profilePic, p.productId, p.productName, c.sender_id FROM chats AS c
        INNER JOIN users AS u ON  c.sender_id = u.userId
        INNER JOIN products AS p ON c.product_id = p.productId
        WHERE c.receiver_id = '".$userId."' GROUP BY c.sender_id ";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    public function getBuyers($pId)
    {
        $sql = "SELECT u.userId, u.firstName, u.lastName, u.profilePic, p.productId, p.productName, c.sender_id,c.receiver_id,c.product_id FROM chats AS c
        INNER JOIN users AS u ON  c.sender_id = u.userId
        INNER JOIN  products AS p ON c.product_id = p.productId
        WHERE c.product_id = '".$pId."' GROUP BY c.sender_id ";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    public function getProductsCityWise($state,$city)
    {
        $sql = "SELECT p.*  FROM products AS p
         JOIN users AS u ON u.userId = p.userId
         WHERE u.state = '".$state."' AND u.city = '".$city."' ";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    public function count_num_rows($table, $where)
    {
        $query = $this->db
        ->select('*')
        ->from($table)
        ->where($where)
        ->get();
        return $query->num_rows();
    }

    // public function getProductsByCategory($where,$limit = 1, $offset = 0)
    // {
    //     $this->db->select('*');
    //     $this->db->where($where);
    //     $this->db->from('products');
    //     if($offset==0){
    //         $this->db->limit($limit, $offset);
    //     }else{
    //         $offset= ($offset*$limit)-($limit);
    //         $this->db->limit($limit, $offset);
    //     }

    //     $query= $this->db->get();
    //     return $query->result();
    // }

    public function count_num_products($cat = NULL,$subcat = NULL ,$avail_for = NULL ,$shop_for = NULL, $age = NULL, $state= NULL, $city = NULL)
    {
        $where = [];

        if(!$cat == NULL)
        {

            $where['category'] = $cat;

        }
        if(!$subcat == NULL)
        {

            $where['sub_categoryId'] = $subcat;

        }
        if(!$avail_for == NULL)
        {

            $where['avail_for'] = $avail_for;

        }
        if(!$shop_for == NULL)
        {

            $where['gender'] = $shop_for;

        }
        if(!$age == NULL)
        {
            $where['age_group'] = $age;
        }

        $this->db->where($where);
        $this->db->from('products');
        $query= $this->db->get();
        return $query->num_rows();
    }

    public function search_by($cat = NULL,$subcat = NULL ,$avail_for = NULL ,$shop_for = NULL, $age = NULL, $state= NULL, $city = NULL, $limit = 1, $offset = 0)
    {

        $where = [];

        if(!$cat == NULL)
        {

            $where['category'] = $cat;

        }
        if(!$subcat == NULL)
        {

            $where['sub_categoryId'] = $subcat;

        }
        if(!$avail_for == NULL)
        {

            $where['avail_for'] = $avail_for;

        }
        if(!$shop_for == NULL)
        {

            $where['gender'] = $shop_for;

        }
        if(!$age == NULL)
        {
            $where['age_group'] = $age;
        }

        $this->db->where($where);
        $this->db->from('products');
        if($offset==0){
            $this->db->limit($limit, $offset);
        }else{
            $offset= ($offset*$limit)-($limit);
            $this->db->limit($limit, $offset);
        }

        $query= $this->db->get();
        return $query->result();
    }

    public function count_products_by_city($cat = NULL,$subcat = NULL ,$avail_for = NULL ,$shop_for = NULL, $age = NULL, $state= NULL, $city = NULL)
    {
        $where = [];

        if(!$cat == NULL)
        {

            $where['category'] = $cat;

        }
        if(!$subcat == NULL)
        {

            $where['sub_categoryId'] = $subcat;

        }
        if(!$avail_for == NULL)
        {

            $where['avail_for'] = $avail_for;

        }
        if(!$shop_for == NULL)
        {

            $where['gender'] = $shop_for;

        }
        if(!$age == NULL)
        {
            $where['age_group'] = $age;
        }

        $sql = "SELECT p.*  FROM products AS p
         JOIN users AS u ON u.userId = p.userId
         WHERE u.state = '".$state."' AND u.city = '".$city."' ";

        $user = $this->db->query($sql)->row();

        $user_id = $user->userId;
        if(!$user_id == NULL)
        {
           $where['userId'] = $user_id;
        }

        $this->db->where($where);
        $this->db->from('products');
        $query= $this->db->get();
        return $query->num_rows();
    }


    public function getProductsByCity($cat = NULL,$subcat = NULL ,$avail_for = NULL ,$shop_for = NULL, $age = NULL, $state= NULL, $city = NULL, $limit = 1, $offset = 0)
    {
        $where = [];

        if(!$cat == NULL)
        {

            $where['category'] = $cat;

        }
        if(!$subcat == NULL)
        {

            $where['sub_categoryId'] = $subcat;

        }
        if(!$avail_for == NULL)
        {

            $where['avail_for'] = $avail_for;

        }
        if(!$shop_for == NULL)
        {

            $where['gender'] = $shop_for;

        }
        if(!$age == NULL)
        {
            $where['age_group'] = $age;
        }

        $sql = "SELECT p.*  FROM products AS p
         JOIN users AS u ON u.userId = p.userId
         WHERE u.state = '".$state."' AND u.city = '".$city."' ";

        $user = $this->db->query($sql)->row();

        $user_id = $user->userId;
        if(!$user_id == NULL)
        {
           $where['userId'] = $user_id;
        }

        $this->db->where($where);
        $this->db->from('products');
        $query= $this->db->get();
        return $query->result();
    }

    public function count_product_rows($state,$city)
    {
        $sql = "SELECT p.*  FROM products AS p
         JOIN users AS u ON u.userId = p.userId
         WHERE u.state = '".$state."' AND u.city = '".$city."' ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function get_subcat_by_cat($cat_id)
    {
        $this->db->where(array('categoryId'=>$cat_id,'status'=>1));
        $query= $this->db->get('subcategories');
        return $query->result();

    }

    public function get_product($pId)
    {
        $this->db->where('productId',$pId);
        $query = $this->db->get('products');
        return $query->row();
    }

    public function  count_products($tbl)
    {
        $query = $this->db
        ->select('*')
        ->from($tbl)
        ->get();
        return $query->num_rows();
    }

    public function getAllProducts($per_page,$page)
    {
        $this->db->limit($per_page, $page);
        $query = $this->db->get('products');
        return $query->result();
    }

    public function checkEmailExist($email)
    {
        $this->db->where('email',$email);
        $q = $this->db->get('subscribers');
        if($q->num_rows() > 0)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function subscribe($data)
    {
        $q = $this->db->insert('subscribers',$data);
        if($q == true)
        {
            return true;
        }
    }

    public function get_other_products($tbl,$seller_id)
    {
        $sql = "SELECT p.*,i.productImage FROM products AS p JOIN product_images AS i ON p.productId = i.productId WHERE p.userId = '".$seller_id."' LIMIT 4 ";
        $q = $this->db->query($sql);
        return $q->result();
    }




}//end model
