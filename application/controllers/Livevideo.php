<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Session;
use OpenTok\Role;
use OpenTok\Broadcast;
use OpenTok\Archive;
use OpenTok\Layout;

use OpenTok\OutputMode;

class Livevideo extends My_Controller
{

	protected $APIKey;
	protected $APISecret;

	public function __construct()
	{
		parent::__construct();
		require 'vendor/autoload.php';
        $this->CI =& get_instance();
		$this->CI->load->config('opentok');
		$this->APIKey = $this->CI->config->item('api_key');
        $this->APISecret = $this->CI->config->item('api_secret');
        $this->load->model('Commonmodel');
        $this->load->model('Mymodel');
        $this->load->model('Authmodel');
        $this->load->model('Apimodel');
		$this->load->model('Crud_model');
	}

	public function index()
	{
		$perPage =5;
		$userId = $this->session->userdata('id');
		$data['title']="Go Live";

		$data['profile']=$userInfo= $this->Authmodel->getProfile($userId);

		$opentok = new OpenTok($this->APIKey, $this->APISecret);
		$session = $opentok->createSession();
		$session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
		$sessionOptions = array(
			'archiveMode' => ArchiveMode::MANUAL,
			'mediaMode' => MediaMode::ROUTED
		);
		$session = $opentok->createSession($sessionOptions);

		$data['sessionId']  =$session->getSessionId();
		$data['token']  =$session->generateToken();

		$token = $session->generateToken(array(
			'role'       => Role::MODERATOR,
			'expireTime' => time()+(7 * 24 * 60 * 60),
			'data'       => 'name='.$userInfo->name,
			'initialLayoutClassList' => array('focus')
		));
		$dataArray = array(
			'sessionId'=>$data['sessionId'],
			'token'=>$data['token'],
			'apiKey' =>$this->APIKey
		);

		$data['broadcast'] = $dataArray;
		$data['credentials'] = json_encode($dataArray);

		$this->session->set_userdata($dataArray);

		$data['newUsers'] = $this->Commonmodel->getFriendlist($userId);
		$frndNotification = $this->Commonmodel->getFrndNotification($userId);
		$totalRequest = count($frndNotification);
		$data['frndNotification'] = $frndNotification;
		$data['totalRequest'] = $totalRequest;

		if(!empty($this->input->get("page")))
		{
			$start = ceil($this->input->get("page") * $perPage);
			$sql= "SELECT p.*, u.name, u.profilePic,  (SELECT COUNT(*) FROM post_comments AS cp WHERE cp.postId = p.postId) AS totalComment, (SELECT COUNT(*) FROM post_likes AS lp WHERE lp.postId = p.postId) AS totalLike from posts p inner join users u on u.userId  = p.userId  where p.type = 0 AND ((p.userId = '" . $userId . "') OR (find_in_set('" . $userId . "', p.taggedFriends) <> 0)) order by unix_timestamp(p.created) DESC";

			$finalsql= $sql. " LIMIT ".$perPage." OffSET ".$start."";
			$post['posts'] = $this->mymodel->fetch($finalsql, False);
			$result = $this->load->view('user/data', $post);
			echo json_encode($result);

		}else{

		$start = 0;
		$sql= "SELECT p.*, u.name, u.profilePic,  (SELECT COUNT(*) FROM post_comments AS cp WHERE cp.postId = p.postId) AS totalComment, (SELECT COUNT(*) FROM post_likes AS lp WHERE lp.postId = p.postId) AS totalLike from posts p inner join users u on u.userId  = p.userId  where p.type = 0 AND ((p.userId = '" . $userId . "') OR (find_in_set('" . $userId . "', p.taggedFriends) <> 0)) order by unix_timestamp(p.created) DESC";

			$finalsql= $sql. " LIMIT ".$perPage." OffSET ".$start."";

			$data['posts'] = $this->mymodel->fetch($finalsql, False);
		}

		$this->load->view('user/header', $data);
        $this->load->view('user/opentok', $data);
        $this->load->view('user/footer');
	}

	public function broadcast()
	{
		$userId = $this->session->userdata('id');
		$data['title']="Go Live";
		$data['profile']=$userInfo= $this->Authmodel->getProfile($userId);

		$opentok = new OpenTok($this->APIKey, $this->APISecret);
		$session = $opentok->createSession();
		$session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
		$sessionOptions = array(
			'archiveMode' => ArchiveMode::ALWAYS,
			'mediaMode' => MediaMode::ROUTED
		);
		$session = $opentok->createSession($sessionOptions);

		$data['sessionId'] =$session->getSessionId();
		$data['token']  =$session->generateToken();

		$token = $session->generateToken(array(
			'role'       => Role::MODERATOR,
			'expireTime' => time()+(7 * 24 * 60 * 60),
			'data'       => 'name='.$userInfo->name,
			'initialLayoutClassList' => array('focus')
		));

		$dataArray = array(
			'sessionId'=>$data['sessionId'],
			'token'=>$data['token'],
			'apiKey' =>$this->APIKey,
		);

		$data['broadcast'] = $dataArray;
		$data['credentials'] = json_encode($dataArray);

		$this->session->set_userdata($dataArray);

		$this->load->view('user/header', $data);
        $this->load->view('user/opentok', $data);
        $this->load->view('user/footer');
	}

	public function startbroadcast()
	{
		$userId = $this->session->userdata('id');
		$data['title']="Go Live";
		$data['profile']=$userInfo= $this->Authmodel->getProfile($userId);
		$opentok = new OpenTok($this->APIKey, $this->APISecret);
		$options = array(
			'layout' => Layout::getBestFit(),
			'maxDuration' => 5400,
			'resolution' => '1280x720'
		);

		$sessionId = $this->session->userdata('sessionId');
		$token = $this->session->userdata('token');

		$broadcast = $opentok->startBroadcast($sessionId, $options);
		$mydata = array(
				'broadcastId' => $broadcast->id,
				'broadcastSessionId' => $sessionId,
				'tokenId' => $token,
				'broadcastNumber'=>"Toastitup".$this->generate_otp(),
				'status' => 1,
				'userId' => $userId,
				'startBroadcast' => date("Y-m-d H:i:s"),
				'created' => date("Y-m-d H:i:s")
			);

		$liv=$this->Commonmodel->add_details("broadcast_live", $mydata);

		$broadcastInfo = $this->Commonmodel->fetch_row("broadcast_live", "liveId=$liv");

		$frnList= $this->mymodel->friendlist($userId);

		foreach ($frnList as $key => $fr)
		{
			$sendNotification = array(
				'senderId'=>$userId,
				'receiverId'=>$fr->userId,
				'message'=>$userInfo->name." is live now.",
				'url'=>base_url('livevideo/viewer/'.$broadcastInfo->broadcastNumber),
				'created'=>date("Y-m-d H:i:s"),
			);

			$this->Commonmodel->add_details("notifications", $sendNotification);
		}

		$dataArray = array(
			'broadcastId'=>$broadcastInfo->broadcastId,
			'broadcast_number'=>$broadcastInfo->broadcastNumber,
		);

		$this->session->set_userdata($dataArray);

		$broadcastId = $broadcast->id;
		$broadcastStatus = $broadcast->status;

		$streamData = json_encode($dataArray);

		echo $streamData;

	}

	public function getViewerLink()
	{
		$broadcast_number = $this->session->userdata('broadcast_number');
		echo base_url('livevideo/viewer/'.$broadcast_number);
	}

	public function generate_otp($length = 8)
	{
		$characters = '123456789ABCD';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function endbroadcast($broadcastId = false)
	{
		$opentok = new OpenTok($this->APIKey, $this->APISecret);

		$broadcastId = $this->session->userdata('broadcastId');
		$opentok->stopBroadcast($broadcastId);
		$dataArray = array(
			'broadcastId'=>$broadcastId
		);

		$streamData = json_encode($dataArray);

		echo $streamData;

		$where = array(
			'broadcastId' => $broadcastId
		);

		$updateData = array(
			'status'=>0,
			'endBroadcast' => date("Y-m-d H:i:s")
		);

		$this->Commonmodel->edit_single_row('broadcast_live', $updateData, $where);

		// unset session value.
        $this->session->unset_userdata('sessionId');
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('apiKey');
        $this->session->unset_userdata('sessionType');
        $this->session->unset_userdata('eventId');
        $this->session->unset_userdata('sessId');
        redirect(base_url('user'),'refresh');
	}

	public function viewer($broadcastNumber = false)
	{
		$perPage =5;
		$userId = $this->session->userdata('id');
		$data['title']="Go Live";
		$data['profile']=$userInfo= $this->Authmodel->getProfile($userId);

		$broadcastInfo = $this->Commonmodel->fetch_row("broadcast_live", "broadcastNumber='$broadcastNumber'");

		$dataArray = array(
			'sessionId'=>@$broadcastInfo->broadcastSessionId,
			'token'=>@$broadcastInfo->tokenId,
			'apiKey' =>$this->APIKey,
		);

		$data['credentials'] = json_encode($dataArray);
		$data['newUsers'] = $this->Commonmodel->getFriendlist($userId);
		$frndNotification = $this->Commonmodel->getFrndNotification($userId);
		$totalRequest = count($frndNotification);
		$data['frndNotification'] = $frndNotification;
		$data['totalRequest'] = $totalRequest;

		if(!empty($this->input->get("page")))
		{
			$start = ceil($this->input->get("page") * $perPage);
			$sql= "SELECT p.*, u.name, u.profilePic,  (SELECT COUNT(*) FROM post_comments AS cp WHERE cp.postId = p.postId) AS totalComment, (SELECT COUNT(*) FROM post_likes AS lp WHERE lp.postId = p.postId) AS totalLike from posts p inner join users u on u.userId  = p.userId  where p.type = 0 AND ((p.userId = '" . $userId . "') OR (find_in_set('" . $userId . "', p.taggedFriends) <> 0)) order by unix_timestamp(p.created) DESC";

			$finalsql= $sql. " LIMIT ".$perPage." OffSET ".$start."";
			$post['posts'] = $this->mymodel->fetch($finalsql, False);
			$result = $this->load->view('user/data', $post);
			echo json_encode($result);

		}else{

		$start = 0;
		$sql= "SELECT p.*, u.name, u.profilePic,  (SELECT COUNT(*) FROM post_comments AS cp WHERE cp.postId = p.postId) AS totalComment, (SELECT COUNT(*) FROM post_likes AS lp WHERE lp.postId = p.postId) AS totalLike from posts p inner join users u on u.userId  = p.userId  where p.type = 0 AND ((p.userId = '" . $userId . "') OR (find_in_set('" . $userId . "', p.taggedFriends) <> 0)) order by unix_timestamp(p.created) DESC";

			$finalsql= $sql. " LIMIT ".$perPage." OffSET ".$start."";

			$data['posts'] = $this->mymodel->fetch($finalsql, False);
		}

		$this->load->view('user/header', $data);
        $this->load->view('user/opentok_guest', $data);
        $this->load->view('user/footer');

	}
	public function liveSession()
	{
		$userId = $this->session->userdata('id');
		$details=$this->Commonmodel->fetch_row('users', "userId='".$userId."'");
		$opentok = new OpenTok($this->APIKey, $this->APISecret);

		$sessionType = $this->session->userdata('sessionType');
		$eventId = $this->session->userdata('eventId');
		$sess_id =85282;

		$numRowsSession = $this->db->query("select * from `broadcast_live` where `sess_id` = '".$sess_id."'")->num_rows();

		if ($numRowsSession>0)
		{
			$rowStream =$this->Commonmodel->fetch_single_join("select * from `broadcast_live` where `sess_id` = '".$sess_id."' ORDER BY live_id DESC");

			$dataArray = array(
				'sessionId'=>$rowStream->broadcast_session_id,
				'token'=>$rowStream->token_id,
				'apiKey' =>$this->APIKey,
			);

			$streamData = json_encode($dataArray);
			echo $streamData;

		}else{

			$session = $opentok->createSession();
			$session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
			$session = $opentok->createSession(array( 'location' => '12.34.56.78' ));
			$sessionOptions = array(
				'archiveMode' => ArchiveMode::MANUAL,
				'mediaMode' => MediaMode::ROUTED

			);
			$session = $opentok->createSession($sessionOptions);
			$sessionId = $session->getSessionId();

			$token = $opentok->generateToken($sessionId);
			$token = $session->generateToken();
			$token = $session->generateToken(array(

				'role'       => Role::MODERATOR,
				'expireTime' => time()+(7 * 24 * 60 * 60),
				'data'       => 'name=Johnny',
				'initialLayoutClassList' => array('focus')
			));

			$mydata = array(
				'broadcastId' => '',
				'broadcastSessionId' => $sessionId,
				'tokenId' => $token,
				'broadcastNumber'=>"Toastitup".$this->generate_otp(),
				'status' => 1,
				'userId' => $userId,
				'startBroadcast' => date("Y-m-d H:i:s"),
				'created' => date("Y-m-d H:i:s")
			);

			$this->Commonmodel->add_details("broadcast_live", $mydata);

			$dataArray = array(
				'sessionId'=>$sessionId,
				'token'=>$token,
				'apiKey' =>$this->APIKey,
			);

			echo"<pre>";
			print_r($dataArray);exit();

			$streamData = json_encode($dataArray);
			echo $streamData;
		}
	}


	public function liveVideoSession($receiverId = false)
	{
		if ($receiverId == false) {
            show_404();
        }


		$senderId = $_SESSION['automation']['userId'];
		$details=$this->Commonmodel->fetch_row('users', "userId='".$senderId."'");

		// Initializing
		$opentok = new OpenTok($this->APIKey, $this->APISecret);

		$getSenderSession =$this->Commonmodel->fetch_single_join("SELECT * FROM `live_videos` WHERE `senderId` = '".$senderId."' AND `receiverId` = '".$receiverId."'  ORDER BY `liveId` DESC limit 1");


		if(!empty($getSenderSession)) {

			// For Sender
			$session = $opentok->createSession();
			$session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
			$session = $opentok->createSession(array( 'location' => '12.34.56.78' ));
			$sessionOptions = array(
				'archiveMode' => ArchiveMode::MANUAL,
				'mediaMode' => MediaMode::ROUTED

			);
			$session = $opentok->createSession($sessionOptions);
			$sessionId = $session->getSessionId();

			$token = $opentok->generateToken($sessionId);
			$token = $session->generateToken();
			$token = $session->generateToken(array(

				'role'       => Role::MODERATOR,
				'expireTime' => time()+(7 * 24 * 60 * 60),
				'data'       => 'name=Johnny',
				'initialLayoutClassList' => array('focus')
			));

			$mydata = array(
				'sessionId' => $sessionId,
				'tokenId' => $token,
				'broadcastNumber'=>"Automation Engineering Services".$this->generate_otp(),
				'status' => 1,
				'senderId' => $senderId,
				'receiverId' => $receiverId,
				'startSession' => date("Y-m-d H:i:s"),
				'created' => date("Y-m-d H:i:s")
			);

			$this->Commonmodel->add_details("live_videos", $mydata);

			$dataArray = array(
				'sessionId'=>$sessionId,
				'token'=>$token,
				'apiKey' =>$this->APIKey,
			);

			$streamData = json_encode($dataArray);
			echo $streamData;

		} else {

			// For Receiver
			$getReceiverSession =$this->Commonmodel->fetch_single_join("SELECT * FROM `live_videos` WHERE (`senderId` = '".$senderId."' AND `receiverId` = '".$receiverId."') OR (`receiverId` = '".$senderId."' AND `senderId` = '".$receiverId."') ORDER BY `liveId` DESC limit 1");

			if(!empty($getReceiverSession)) {
				$sessionId = @$getReceiverSession->sessionId;
				$token = @$getReceiverSession->tokenId;

				$dataArray = array(
					'sessionId'=>$sessionId,
					'token'=>$token,
					'apiKey' =>$this->APIKey,
				);

				$streamData = json_encode($dataArray);
				echo $streamData;
			} else {
				// If empty then create fresh sesion
				$session = $opentok->createSession();
				$session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
				$session = $opentok->createSession(array( 'location' => '12.34.56.78' ));
				$sessionOptions = array(
					'archiveMode' => ArchiveMode::MANUAL,
					'mediaMode' => MediaMode::ROUTED

				);
				$session = $opentok->createSession($sessionOptions);
				$sessionId = $session->getSessionId();

				$token = $opentok->generateToken($sessionId);
				$token = $session->generateToken();
				$token = $session->generateToken(array(

					'role'       => Role::MODERATOR,
					'expireTime' => time()+(7 * 24 * 60 * 60),
					'data'       => 'name=Johnny',
					'initialLayoutClassList' => array('focus')
				));

				$mydata = array(
					'sessionId' => $sessionId,
					'tokenId' => $token,
					'broadcastNumber'=>"Automation Engineering Services".$this->generate_otp(),
					'status' => 1,
					'senderId' => $senderId,
					'receiverId' => $receiverId,
					'startSession' => date("Y-m-d H:i:s"),
					'created' => date("Y-m-d H:i:s")
				);

				$this->Commonmodel->add_details("live_videos", $mydata);

				$dataArray = array(
					'sessionId'=>$sessionId,
					'token'=>$token,
					'apiKey' =>$this->APIKey,
				);

				$streamData = json_encode($dataArray);
				echo $streamData;
			}

		}
	}

	public function archiveStart()
	{
		$api_key =$this->CI->config->item('api_key');
		$api_secret =$this->CI->config->item('api_secret');
		$opentok = new OpenTok($this->APIKey, $this->APISecret);
		$sessionId = $_POST['sessionId'];
		$archiveOptions = array(
	    'name' => 'Important Presentation',
	    'hasAudio' => true,
	    'hasVideo' => true,
	    'outputMode' => OutputMode::COMPOSED,
	    'resolution' => '1280x720'
		);

		$archive = $opentok->startArchive($sessionId, $archiveOptions);
		$archiveId = $archive->id;
		$dataArray = array(
			'archiveId'=>@$archive
		);

		$streamData = json_encode($dataArray);
		echo $streamData;
	}
	public function archiveList()
	{
		$api_key =$this->CI->config->item('api_key');
		$api_secret =$this->CI->config->item('api_secret');

		$opentok = new OpenTok($this->APIKey, $this->APISecret);

		$archiveID = $_POST['archiveID'];
		$archive = $opentok->getArchive($archiveID);
		$dataArray = array(
			'status'=>@$archive->status,
			'url'=>@$archive->url,
		);

		$streamData = json_encode($dataArray);

		echo $streamData;
	}
	public function archiveStop()
	{
		$api_key =$this->CI->config->item('api_key');
		$api_secret =$this->CI->config->item('api_secret');
		$opentok = new OpenTok($this->APIKey, $this->APISecret);
		$archiveID = $_POST['archiveID'];
		$opentok->stopArchive($archiveID);
		$dataArray = array(
			'archiveId'=>@$archive

		);
		$streamData = json_encode($dataArray);
		echo $streamData;

	}
	public function video($fid = false)
	{
		if ($fid == false) {
            show_404();
        }

				$get_friendsvideo=$this->Crud_model->GetData('friends_video','',"publisher_id='".$fid."' and status='0'",'','(video_id)desc','','1');

		 		$userId = $_SESSION['automation']['userId'];
		 		if(empty(@$get_friendsvideo->subscription_id)){
		 		 $insert_call=array(
		         	'publisher_id'=>$userId,
		         	'subscription_id'=>$fid,
		         	'created_date'=>date('Y-m-d H:i:s'),
		         );
		         $this->Crud_model->SaveData('friends_video',$insert_call);

		     }

		         if(!empty($get_friendsvideo->subscription_id))
		         {
		        	$update_call=array(
		         	'status'=>'1',
		         );
		         $this->Crud_model->SaveData('friends_video',$update_call,"subscription_id='".$get_friendsvideo->subscription_id."'");

		         }	
		$data['title']="Video Call";

		$data['profile']=$this->Crud_model->get_single('users', "userId='" . $userId . "'");
		$data['subscriber']=$this->Crud_model->get_single('users', "userId='" . $fid . "'");

		$data['friendId'] = $fid;

		$this->load->view('header-chat', $data);
        $this->load->view('user_dashboard/opentok_group', $data);
        $this->load->view('footer-chat');

	}

	public function testInput($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function send_message()
	{
		$user_id = $this->session->userdata('id');

		$msg = $this->testInput($this->input->post('msg'));
		$friendId = $this->input->post('fid');

		if($msg) {
			$userData = array(
				'message' => $this->testInput($this->input->post('msg')),
				'senderId' => $user_id,
				'receiverId' => $friendId,
				'chatDate' => date("Y-m-d H:i:s"),
				'chatRoom' => 1
			);

			$this->Apimodel->add_details('chat', $userData);
		}
	}

	public function fetch_chat()
	{
		$userId = $this->session->userdata('id');
		$friendId = $this->input->post('fid');

		$data['chats'] = $this->Mymodel->getFrndChat($userId, $friendId);

		$this->load->view('user/chat', $data);
	}

	public function fetch_chat_core()
	{
		$data['fid'] = $this->input->post('fid');

		$this->load->view('user/chat-html', $data);
	}

}
