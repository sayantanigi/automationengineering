<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $key = 'id';

	public function get($table, $single = False, $col = NULL, $id = NULL, $limit = NULL, $order_by = NULL)
	{
		if (!$col == NULL && !$id == NULL) {
			$this->db->where($col, $id);
		}

		$this->db->from($table);
		
		if ($single == FALSE) {
			$method = 'result';
		} else {
			$method = 'row';
		}

		if (!$limit == NULL) {
			$this->db->limit($limit);
		}

		if (!$order_by == NULL) {
			$this->db->order_by($order_by,'desc');
		}

		$query = $this->db->get();

		$result = $query->$method();

		return $result;
	}


	public function get_by($table, $single = False, $where = NULL, $order_by = NULL, $limit = NULL)
	{
		if (!$where == NULL) {
			$this->db->where($where);
		}

		$this->db->from($table);
		
		if ($single == FALSE) {
			$method = 'result';
		} else {
			$method = 'row';
		}

		if (!$limit == NULL) {
			$this->db->limit($limit);
		}

		if (!$order_by == NULL) {
			$this->db->order_by($order_by);
		}

		$query = $this->db->get();

		$result = $query->$method();

		return $result;
	}


	public function select($select, $table, $single = False, $where = NULL, $limit = NULL, $order_by = NULL)
	{
		$this->db->select($select);

		if (!$where == NULL) {
			$this->db->where($where);
		}

		$this->db->from($table);
		
		if ($single == FALSE) {
			$method = 'result';
		} else {
			$method = 'row';
		}

		if (!$limit == NULL) {
			$this->db->limit($limit);
		}

		if (!$order_by == NULL) {
			$this->db->order_by($order_by);
		}

		$query = $this->db->get();

		$result = $query->$method();

		return $result;
	}


	public function save($table, $data)
	{
		if($this->db->insert($table, $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function update($data, $table, $where)
	{
		$this->db->where($where);
		
		if($this->db->update($table, $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function delete($table, $where)
	{
		if($this->db->delete($table, $where)) {
			return true;
		} else {
			return false;
		}
	}


	public function count($table, $where = NULL)
	{
		if ($where != NULL) {
			$this->db->where($where);
		}
		
		$this->db->from($table);
		return $this->db->count_all_results();
	}


	public function fetch($sql, $single = FALSE)
	{
		$query = $this->db->query($sql);

		if ($single == FALSE) {
			$result = $query->result();
		} else {
			$result = $query->row();
		}
		return $result;
	}


	public function change_status($table, $where, $status)
	{
		if($this->update($status, $table, $where) == true) {
			return true;
		} else {
			return false;
		}
	}

	public function fetch_user($userId)
	{
		if (is_numeric($userId)) {
			$sql="SELECT firstName, lastName FROM users WHERE userId='".$userId."'";

			$query = $this->db->query($sql);
			$result = $query->row();
		} else {
			
			$sql="SELECT eshopName FROM eshop WHERE eshopId='".$userId."'";
			$query = $this->db->query($sql);
			$result = $query->row();
		}
		return $result;

	}
	public function getCurrencySymbol($currency_code='INR')
	{
  
    $query=$this->db->select('symbol')->where('currency_code', $currency_code)->get('currency');
    $res=$query->row();
    if (!empty($res->symbol))
      return (string) $res->symbol;
    else
      return 'Rs ';
  }

  public function allProducts()
  {
  	$this->db->select('products.*,product_images.*');
  	$this->db->from('products');
  	$this->db->join('product_images','products.productId = product_images.productId');
  	$q = $this->db->get();
  	return $q->result();
  }

  public function userProductsList($userId)
  {
  	$this->db->select('products.*,product_images.*');
  	$this->db->from('products');
  	$this->db->join('product_images','products.productId = product_images.productId');
  	$this->db->where('userId',$userId);
  	$q = $this->db->get();
  	return $q->result();
  }
  
	public function getAll_where($table,$key, $value){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($key, $value);
		$query= $this->db->get();
		return $query->row();
	}
	public function getprodImage($table,$key, $value){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($key, $value);
		$this->db->limit(1);
		$query= $this->db->get();
		return $query->row();
	}
	public function getAll($table,$key){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($key, 1);	
		$this->db->order_by('productId','desc');
		$query= $this->db->get();
		return $query->result();
	}

	public function getCategorybyslug($slug){
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('slug', $slug);
		$query= $this->db->get();
		return $query->row();
	}
	public function getSubCategorybyslug($slug){
		$this->db->select('*');
		$this->db->from('subcategories');
		$this->db->where('slug', $slug);
		$query= $this->db->get();
		return $query->row();
	}
	public function getchildSubCategorybyslug($slug){
		$this->db->select('*');
		$this->db->from('childsubcategoies');
		$this->db->where('slug', $slug);
		$query= $this->db->get();
		return $query->row();
	}
	public function getproductbyslug($slug){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('slug', $slug);
		$query= $this->db->get();
		return $query->row();
	}
	public function getProductByDesc($per_page, $page)
	{
		$sql = 'SELECT p.*, i.productImage FROM products AS p JOIN product_images AS i ON p.productId = i.productId  WHERE status = 1 GROUP BY p.productId ORDER by p.productId DESC LIMIT '.$page.','.$per_page.' ';
		$query = $this->db->query($sql)->result();
		return $query;
	}

	public function getProductBycategoryDesc($categoryid, $per_page, $page)
	{
		$sql = 'SELECT p.*, i.productImage FROM products AS p JOIN product_images AS i ON p.productId = i.productId WHERE p.status = 1 AND p.category="'.$categoryid.'" GROUP BY p.productId ORDER by p.productId DESC LIMIT '.$page.','.$per_page.' ';
		$query = $this->db->query($sql)->result();
		return $query;
	}

	public function getProductBysubcategoryDesc($subcategoryid, $per_page, $page)
	{
		$sql = 'SELECT p.*, i.productImage FROM products AS p JOIN product_images AS i ON p.productId = i.productId WHERE p.status = 1 AND p.sub_categoryId="'.$subcategoryid.'" GROUP BY p.productId ORDER by p.productId DESC LIMIT '.$page.','.$per_page.' ';
		$query = $this->db->query($sql)->result();
		return $query;
	}

	public function getProductBychildsubcategoryDesc($csubcategoryid, $per_page, $page)
	{
		$sql = 'SELECT p.*, i.productImage FROM products AS p JOIN product_images AS i ON p.productId = i.productId WHERE p.status = 1 AND p.child_subcategoryId="'.$csubcategoryid.'" GROUP BY p.productId ORDER by p.productId DESC LIMIT '.$page.','.$per_page.' ';
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
    public function productDetail($pid)
    {
    	$sql = 'SELECT p.*, i.productImage FROM products AS p JOIN product_images AS i ON p.productId = i.productId HAVING productId = "'.$pid.'"';
		$query = $this->db->query($sql)->result();
		return $query;
    }

	public function get_bycustomerviewed($productid,$category)
    {
    	$sql = 'SELECT p.*, i.productImage FROM products AS p JOIN product_images AS i ON p.productId = i.productId WHERE p.productId != "'.$productid.'" AND p.category="'.$category.'" GROUP BY p.productId  LIMIT 4';
		$query = $this->db->query($sql)->result();
		//echo $this->db->last_query();
		return $query;
    }
    public function fetch_row($userId, $email)
    {
    	$this->db->select('*');
    	$this->db->where('userId', $userId);
    	$this->db->where('email', $email);
    	$query=$this->db->get('users');
    	return $query->row();
    } 
    public function fetch_id($id){
    	$this->db->select('*');
    	$this->db->where('userId', $id);
    	$query=$this->db->get('users');
    	return $query->row();
    }
    public function dataUpdate($table, $data, $where){
			$this->db->set($data);
			$this->db->where($where);
			$this->db->update($table);
			return true;
		}

		public function getAllCategory()
		{
			$this->db->select('categoryId');
			$this->db->select('categoryName');
			$this->db->where(array('status'=>'1'));
			$q = $this->db->get('category')->result();
			return $q;
		}

		public function getAllSubCategory()
		{
			$this->db->select('subcategoryId');
			$this->db->select('subcategoryName');
			$this->db->where(array('status'=>'1'));
			$q = $this->db->get('subcategories')->result();
			return $q;
		}

		public function getChildSubCategory()
		{
			$this->db->select('id');
			$this->db->select('name');
			$this->db->where(array('status'=>'1'));
			$q = $this->db->get('childsubcategoies')->result();
			return $q;
		}

		public function getAgegroups(){
			$this->db->select('*');
			$this->db->from('age_group');
			$query= $this->db->get();
			return $query->result();

	}

		public function get_by_search($tbl,$where,$per_page,$page)
		{
			$this->db->limit($per_page, $page);
			$this->db->join('product_images', 'products.productId = product_images.productId');
			$this->db->where($where);
			$q = $this->db->get($tbl);
			return $q->result();
		}

		

		public function get_by_color_search($color,$per_page, $page)
		{
			$sql = 'SELECT pc.product_id, p.*, i.productImage 
			FROM products as p INNER JOIN product_colors as pc ON pc.product_id = p.productId 
			INNER JOIN product_images as  i ON pc.product_id = i.productId
			WHERE pc.value = "'.$color.'" LIMIT '.$page.','.$per_page.'    ';
			$query = $this->db->query($sql)->result();
			return $query;
		}

		public function get_by_size_search($size,$per_page, $page)
		{
			$sql = 'SELECT p.*, ps.product_id, i.productImage
			FROM products as p INNER JOIN product_sizes as ps ON p.productId = ps.product_id
			INNER JOIN product_images as i ON ps.product_id = i.productId
			WHERE ps.value = "'.$size.'" LIMIT '.$page.','.$per_page.'  ';
			$query = $this->db->query($sql)->result();
			return $query;
		}

		public function getAllColors()
		{
			$q = $this->db->get('colors')->result();
			return $q;
		}

		public function getAllSizes()
		{
			$q = $this->db->get('sizes')->result();
			return $q;
		}

		public function get_product_count($where)
		{
			$this->db->where($where);
			$q = $this->db->count_all('products');
			return $q;
		}

		public function get_by_price_range($min_price,$max_price,$per_page, $page)
		{
			$sql = 'SELECT p.*,i.productImage FROM products as p  INNER JOIN  product_images as i ON p.productId = i.productId WHERE price IN("'.$min_price.'","'.$max_price.'")  AND  STATUS = "1" LIMIT '.$page.','.$per_page.' ';
			$query = $this->db->query($sql)->result();
			return $query;
		}

		public function countEnquiry($user_id)
		{
			$this->db->where('receiver_id',$user_id);
			$this->db->group_by('product_id','sender_id');
			$q = $this->db->get('chats');
			return $q->num_rows();
		}

		public function checkCategoryExist($catId)
		{
			$this->db->where('product_category',$catId);
			$q = $this->db->get('banner');
			if($q->num_rows() > 0)
			{
				return "exist";
			}
			else{
				return "notExist";
			}
		}


}//end model