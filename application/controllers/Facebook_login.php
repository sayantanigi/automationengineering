<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook_login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('facebook');
        $this->load->model('facebook_model');
    }

    public function index(){
      $userData = array();

       // Authenticate user with facebook
       if($this->facebook->is_authenticated()){
           // Get user info from facebook
           $fbUser = $this->facebook->request('get', '/me?fields=id ,firstname,lastname,email,gender');

           // Preparing data for database insertion
           $userData['oauth_provider'] = 'facebook';
           $userData['oauth_uid']    = !empty($fbUser['id'])?$fbUser['id']:'';;
           $userData['first_name']    = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
           $userData['last_name']    = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
           $userData['email']        = !empty($fbUser['email'])?$fbUser['email']:'';
           $userData['gender']        = !empty($fbUser['gender'])?$fbUser['gender']:'';


           // Insert or update user data to the database
           $userID = $this->facebook_model->checkUser($userData);

           // Check user data insert or update status
           if(!empty($userID)){
               $data['userData'] = $userData;

               // Store the user profile info into session
               $this->session->set_userdata('userData', $userData);
           }else{
              $data['userData'] = array();
           }

           // Facebook logout URL
           $data['logoutURL'] = $this->facebook->logout_url();
       }else{
           // Facebook authentication url
           $data['authURL'] =  $this->facebook->login_url();
       }
        //print_r($data['authURL']); exit;
        $this->load->view('facebook_login',$data);
    }

    public function logout() {
        $this->facebook->destroy_session();
        $this->session->unset_userdata('userData');
        redirect(base_url('facebook_login'));
    }
}
?>
