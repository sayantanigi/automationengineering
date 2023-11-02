<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends My_Model {

	public function login($username, $password)
	{
		$where = "email = '".$username."' OR username = '".$username."'";
		if ($this->count('admin', $where) != 1) {
			$msg = "Invalid Username.";
		} else {
			$user = $this->get_by('admin', true, $where);
			if (md5($password)!= @$user->password) {
				$msg = "Invalid Password";
			} elseif (@$user->status == 0) {
				$msg = "Your account has been deactivated. Please contact master admin for details.";
			}	else {
				$msg = "Login";
				$this->session->set_userdata('admin', '1');
				$this->session->set_userdata('userId', @$user->userId);
			}
		}
		return $msg;
	}


	public function eshopLogin($username, $password)
	{
		$where = "email = '".$username."' OR eshopId = '".$username."'";
		if ($this->count('eshop', $where) != 1) {
			$msg = "Invalid Username.";
		} else {
			$user = $this->get_by('eshop', true, $where);
			if (password_verify($password, @$user->password) == 0) {
				$msg = "Invalid Password";
			} elseif (@$user->status == 0) {
				$msg = "Your account has been deactivated. Please contact master admin for details.";
			}	else {
				$msg = "Login";
				$this->session->set_userdata('peokartEshop', '1');
				$this->session->set_userdata('eshopId', @$user->eshopId);
				$this->session->set_userdata('eId', @$user->eId);
			}
		}
		return $msg;
	}


	public function userLogin($email, $password)
	{
		$where = "email = '".$email."'";
		if ($this->count('users', $where) != 1) {

			$msg = "Invalid Email.";

		} else {

			$sql = "SELECT u.*, r.referBy FROM users AS u JOIN referal AS r ON r.referTo = u.userId WHERE $where";
			$user = $this->get_by('users', true, $where);

			if (password_verify($password, @$user->password) == 0) {

				$msg = "Invalid Password";

			} elseif (@$user->status == 0) {

				$msg = "Your account has been deactivated. Please contact master admin for details.";

			} else {

				$msg = $user;
			}
		}
		return $msg;
	}


	public function verifyOTP($data)
	{
		$user = $this->get('users', true, 'userId', $data['userId']);
		if (@$user->otp == $data['otp']) {
			return false;
		} else {
			return true;
		}
	}


	public function addNewUser($data)
	{
		$where1 = array(
			'email' => $data['email'],
			'userType' => 1,
		);
		$where2 = array(
			'mobile' => $data['mobile'],
			'userType' => 1,
		);
		if ($this->count('users', $where1)>0) {
			$msg = '["This Email is alerady registered with us.", "error", "#DD6B55"]';
		} elseif ($this->count('users', $where2)>0) {
			$msg = '["This Mobile no. is alerady registered with us.", "error", "#DD6B55"]';
		} elseif (!$this->save('users', $data)) {
			$msg = 'error';
		} else {
			$msg = '["New User added successfully!", "success", "#A5DC86"]';
		}
		return $msg;
	}

	public function addNewDeliveryUser($data)
	{
		$where1 = array(
			'email' => $data['email']
		);
		$where2 = array(
			'phone' => $data['phone']
		);
		if ($this->count('delivery_person', $where1)>0) {
			$msg = '["This Email is alerady registered with us.", "error", "#DD6B55"]';
		} elseif ($this->count('delivery_person', $where2)>0) {
			$msg = '["This Mobile no. is alerady registered with us.", "error", "#DD6B55"]';
		} elseif (!$this->save('delivery_person', $data)) {
			$msg = 'error';
		} else {
			$msg = '["New Delivery User added successfully!", "success", "#A5DC86"]';
		}
		return $msg;
	}


}
