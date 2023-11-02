<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commonmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();

	}
	public function add_details($tbl, $data)
	{
		$this->db->insert($tbl, $data);
		$lastid = $this->db->insert_id();

		return $lastid;
	}

	/*
     * Insert file data into the database
     * @param array the data for inserting into the table
     */
    public function insertBatch($tbl, $data = array()){
        $insert = $this->db->insert_batch($tbl, $data);
        return $insert?true:false;
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

	public function fetch_row($tbl, $where)
	{

		$this->db->select('*');
		$this->db->where($where);
		$query=$this->db->get($tbl);
		return $query->row();

	}

	public function fetch_all_rows($tbl, $where)
	{
		$this->db->select('*');
		$this->db->where($where);
		$query=$this->db->get($tbl);
		return $query->result();

	}

	public function delete_single_con($tbl, $where)
	{
		$this->db->where($where);
		$delete = $this->db->delete($tbl);
		return $delete;

	}

	public function edit_single_row($tbl,$data, $where)
	{
		$this->db->where($where);
		$this->db->update($tbl,$data);
		return true;

	}
	public function fetch_all_rows_limit($tbl, $where, $limit,  $offset)
	{
		$this->db->select('*');
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$query=$this->db->get($tbl);
		return $query->result();

	}
	public function count_all($tbl, $where)
	{
		$this->db->select('*');
		$this->db->where($where);
		return $this->db->count_all_results($tbl);
	}


	public function getAll_where($table,$key, $value)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($key, $value);
		$query= $this->db->get();
		return $query->result();
	}

	public function getFriends($userId)
	{
		$this->db->select('*');
		$this->db->from('friend_list');
		$this->db->where('senderId', $userId);
		$this->db->or_where('receiverId', $userId);
		$query= $this->db->get();
		return $query->result();
	}

	public function getFriendlist($userId)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('userId!=', $userId);
		$query= $this->db->get();
		return $query->result();

	}

	function make_query($userId, $keyword)
	{
		$query = "
		SELECT * from users WHERE userId IN( SELECT senderId FROM friend_list WHERE receiverId='".$userId."' AND friendstatus=1 UNION SELECT receiverId FROM friend_list WHERE senderId='".$userId."' AND friendstatus=1)
		";

		if(isset($keyword))
		{
			$query  .= " AND (CONCAT_WS(users.email, users.username, users.name, users.displayName, users.aboutMe) LIKE '%$keyword%')";
		}
		return $query;
	}

 function count_all_by_keyword($userId, $keyword)
 {
	  $query = $this->make_query($userId, $keyword);
	  $data = $this->db->query($query);
	  return $data->num_rows();
 }

 function fetch_data($limit, $start, $userId, $keyword, $sorting)
 {
  $query = $this->make_query($userId, $keyword);

  if(isset($sorting))
  {
  	if($sorting=='nameAsc')
  	{
  		$query  .= " ORDER BY name ASC";
  	}elseif ($sorting=='nameDesc') {
  		$query  .= "  ORDER BY name DESC";
  	}elseif ($sorting=='newest') {
  		$query  .= "  ORDER BY userId DESC";
  	}elseif ($sorting=='oldest') {
  		$query  .= "  ORDER BY userId ASC";
  	}

  }

  $query .= ' LIMIT '.$start.', ' . $limit;

  $data = $this->db->query($query);

  $output = '';
  if($data->num_rows() > 0)
  {
   foreach($data->result() as $friend)
   {
	   	if (@$friend->coverPic && file_exists('./uploads/users/'.@$friend->coverPic))
	   	{
	   		$coverPic = base_url().'uploads/users/'.@$friend->coverPic;

	   	} else {
	   		$coverPic = base_url('uploads/no-photo.png');
	   	}

	   	if (@$friend->profilePic && file_exists('./uploads/users/'.@$friend->profilePic))
	   	{
	   		$profilePic = base_url().'uploads/users/'. @$friend->profilePic;
	   	} else {
	   		$profilePic = base_url('uploads/noimg.png');
	   	}
	   	$countryInfo = $this->mymodel->get('countries', true, 'id', @$friend->country);

	   	@$myfriends=$this->mymodel->friendlist($friend->userId);
	   	@$myphotos=$this->mymodel->count('users_photos', "userId='".$friend->userId."'");
	   	@$myvideos=$this->mymodel->count('users_videos', "userId='".$friend->userId."'");
	   	@$myposts=$this->mymodel->count('posts', "userId='".$friend->userId."'");

	   	$output .= '<div class="col-lg-3 col-md-6 col-sm-6"><div class="friend-box frindscover">
	   	<figure><img src="'.$coverPic.'" alt="" ><span>Followers: 1</span></figure>
	   	<div class="frnd-meta">
	   	<img src="'.$profilePic.'" style="width: 80px; height: 80px;" alt="">
	   	<div class="frnd-name">
	   	<a href="'.base_url('profile/details/'.@$friend->link).'" title="">'.@$friend->name.'</a>
	   	<span>  '. @$countryInfo->name .'</span>
	   	</div>
	   	<ul class="frnd-info">
	   	<li><span>Friends:</span> '.count(@$myfriends).'</li>
	   	<li><span>Photos:</span> '.@$myphotos .'</li>
	   	<li><span>Videos:</span> '.@$myvideos .'</li>
	   	<li><span>Post:</span> '.@$myposts.'</li>
	   	<li><span>Since:</span> '. date('F d, Y', strtotime(@$friend->created)).'</li>
	   	</ul>
	   	<a class="send-mesg" href="javascript:void(0);" title="Send Message">Message</a>
	   	<div class="more-opotnz">
	   	<i class="fa fa-ellipsis-h"></i>
	   	<ul>
	   	<li><a href="javascript:void(0);" title="Block">Block</a></li>
	   	</ul>
	   	</div>
	   	</div>
	   	</div>
	   	</div>
	   	';
	 } }else
	  {
	   $output = '<h3>No user found</h3>';
	  }
  return $output;
 }

	public function checkFriend($userId, $loginUserId)
	{
		$this->db->select('*');
		$this->db->from('friend_list');
		$this->db->where("(senderId = '$userId' AND receiverId = '$loginUserId')
    	 OR(senderId = '$loginUserId' AND receiverId = '$userId')");
		$query= $this->db->get();
		return $query->result();
	}

	public function getFrndNotification($userId)
	{
		$this->db->select('frnd_notification.*,users.name,users.profilePic');
		$this->db->from('frnd_notification');
		$this->db->join('users', 'users.userId=frnd_notification.senderId');
		$this->db->where('frnd_notification.receiverId', $userId);
		$this->db->where('frnd_notification.seen', 0);
		$query= $this->db->get();
		return $query->result();
	}

	public function getChatNotification($userId)
	{
		$this->db->select('chat.*,users.name,users.profilePic');
		$this->db->from('chat');
		$this->db->join('users', 'users.userId=chat.senderId');
		$this->db->where('chat.receiverId', $userId);
		$this->db->where('chat.seen', 0);
		$this->db->group_by('chat.senderId');
		$this->db->order_by('chat.chatId', 'DESC');
		$query= $this->db->get();
		return $query->result();
	}

	public function acceptFriend($userId, $senderId)
	{
		$data=array(
			'friendStatus'=>1,
		);
		$this->db->where("(receiverId = '$userId' AND senderId = '$senderId')");
		$this->db->update('friend_list', $data);
		$notificationData=array(
			'seen'=>1,
		);
		$this->db->where("(receiverId = '$userId' AND senderId = '$senderId')");
		$this->db->update('frnd_notification', $notificationData);

	}

	public function deleteRequest($userId, $senderId)
	{
		$this->db->where("(receiverId = '$userId' AND senderId = '$senderId')");
		$this->db->delete('friend_list');
		$this->db->where("(receiverId = '$userId' AND senderId = '$senderId')");
		$this->db->delete('frnd_notification');
	}

	public function fetchPostCmnt($postId,$imageId)
	{
		$this->db->select('users.name,users.profilePic,post_comments.userId as uId,post_comments.postId,post_comments.imgId,post_comments.comment, post_comments.date_created');
		$this->db->from('post_comments');
		$this->db->join('users', 'users.userId=post_comments.userId');
		$this->db->where('post_comments.postId', $postId);
		$this->db->where('post_comments.imgId', $imageId);
		$this->db->limit(4,0);
		$query= $this->db->get();
		return $query->result();
	}

	public function fetchmoreComment($postId,$imageId, $limitcmnt)
	{
		$this->db->select('users.name,users.profilePic,post_comments.userId as uId,post_comments.postId,post_comments.imgId,post_comments.comment, post_comments.date_created');
		$this->db->from('post_comments');
		$this->db->join('users', 'users.userId=post_comments.userId');
		$this->db->where('post_comments.postId', $postId);
		$this->db->where('post_comments.imgId', $imageId);
		$this->db->limit(4,$limitcmnt);
		$query= $this->db->get();
		return $query->result();
	}

	public function totalComment($postId,$imageId)
	{
		$this->db->select('users.name,users.profilePic,post_comments.userId as uId,post_comments.postId,post_comments.imgId,post_comments.comment, post_comments.date_created');
		$this->db->from('post_comments');
		$this->db->join('users', 'users.userId=post_comments.userId');
		$this->db->where('post_comments.postId', $postId);
		$this->db->where('post_comments.imgId', $imageId);
		return $this->db->count_all_results();
	}

	public function fetchusrImg($userId)
	{
		$this->db->select('profilePic');
		$this->db->from('users');
		$this->db->where('userId', $userId);
		$query= $this->db->get();
		return $query->result();
	}

	public function getLiveVideoDetail($liveIds, $user_id){

		return $this->db->query("select * from `live_videos` where `liveId` IN('$liveIds') and `receiverId` = '".@$user_id."' and `status` = '1' and `notification` = '0'")->row();
	}


	public function fetchPhotoCmnt($imageId)
	{
		$this->db->select('users.name, users.profilePic, user_photos_comments.userId as uId, user_photos_comments.photoId,user_photos_comments.comment, user_photos_comments.dateCreated');
		$this->db->from('user_photos_comments');
		$this->db->join('users', 'users.userId=user_photos_comments.userId');
		$this->db->where('user_photos_comments.photoId', $imageId);
		$this->db->limit(4, 0);
		$query= $this->db->get();
		return $query->result();
	}

	public function fetchVideoCmnt($vId)
	{
		$this->db->select('users.name, users.profilePic, user_videos_comments.userId as uId, user_videos_comments.videoId, user_videos_comments.comment, user_videos_comments.dateCreated');
		$this->db->from('user_videos_comments');
		$this->db->join('users', 'users.userId=user_videos_comments.userId');
		$this->db->where('user_videos_comments.videoId', $vId);
		$this->db->limit(4, 0);
		$query= $this->db->get();
		return $query->result();
	}

	function getChat($fromId,$toId) {
		$query = $this->db->query('SELECT `chat`.*, `users`.`username`, CONCAT(users.firstname, " ", users.lastname) as full_name, `users`.`profilePic`, `to_user`.`username` as `to_username`, CONCAT(to_user.firstname, " ", to_user.lastname) as to_fullname FROM `chat` JOIN `users` ON `users`.`userId`=`chat`.`userfrom_id` JOIN `users` `to_user` ON `to_user`.`userId`=`chat`.`userto_id` where userfrom_id IN ("'.$fromId.'","'.$toId.'") and userto_id IN ("'.$fromId.'","'.$toId.'")');
		return $query->result();
	}

}
