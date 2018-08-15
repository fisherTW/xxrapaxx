<?php
/*
* File:			Member_model.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Member_model extends CI_Model {

	public $lastUpdateUserId = 0;

	public function __construct() {
		$this->load->database();
	}


	//	output
	//	1: success
	public function doReg() {
		$ary_data = array(
			'mail'		=> $this->input->post('txt_email'), 
			'password'	=> md5($this->input->post('txt_password')),
			'name'		=> $this->input->post('txt_showname'),
			'login_type'=> ($this->input->post('login_type') == null) ? 1 : $this->input->post('login_type')
		);
		$this->db->set($ary_data);
		$this->db->insert('users');

		$this->lastUpdateUserId = $this->db->insert_id();
		
		return 1;
	}

	//	output
	//	1: success
	public function doRegGG() {
		$ary_data = array(
			'user_id'	=> $this->lastUpdateUserId, 
			'token'		=> $this->input->post('txt_token')
		);
		$this->db->set($ary_data);
		$this->db->insert('user_social_info');
		
		return 1;
	}	

	//	output
	//	array(result, id)
	//	1: success
	public function doLogin() {
		if($this->input->post('login_type') != null) {
			switch (strval($this->input->post('login_type'))) {
				case LOGIN_TYPE_GOOGLE:
					$this->doLoginFB();
					exit();
					break;
				case LOGIN_TYPE_FB:
					$this->doLoginFB();
					exit();
					break;
				default:
					break;
			}
		}

		$ary_data = array(
			'u.mail'		=> $this->input->post('txt_email'), 
			'u.password'	=> md5($this->input->post('txt_password'))
		);
		$this->db->select('u.id, u.name, s.id as store_id, s.name as store_name');
		$this->db->join('store s', 's.user_id=u.id', 'left');
		$this->db->where($ary_data);
		$query = $this->db->get('users u');
		$row = $query->row();

		if(isset($row->store_id)) {
			$result = '1';
			$id = $row->id;

			$_SESSION['sess_user_name'] = $row->name;
			$_SESSION['sess_store_id'] = $row->store_id;
			$_SESSION['sess_store_name'] = $row->store_name;
		} else {
			$result = '0';
			$id = 0;
		}


		return array($result, $id);
	}	

	public function checkDuplicate() {
		$this->db->select('u.id, u.name , s.id as store_id, s.name as store_name');
		$this->db->join('store s', 's.user_id=u.id', 'left');
		$this->db->where('u.mail', $this->input->post('txt_email'));
		$this->db->from('users u');

		$query = $this->db->get();
		$ary_res = $query->result_array();
		return (count($ary_res) > 0 ? $ary_res : false);
	}

	public function checkDuplicateGG() {
		$this->load->database();
		$this->db->from('users');
		$this->db->join('user_social_info usi','users.id=usi.user_id','left');
		$this->db->where('usi.token', $this->input->post('txt_token'));
		$query = $this->db->get();
		$ary_res = $query->result_array();

		return (count($ary_res) > 0 ? $ary_res : false);
	}

	//	output
	//	array(result, id)
	//	1: success
	public function doLoginGG() {
		$ret = 0;
		$id = 0;
		
		$tmp = $this->checkDuplicateGG();

		if($tmp !== false) {
			$_SESSION['sess_user_id'] = $tmp;
			$_SESSION['sess_user_name'] = 'fake';
		} else {
			//reg
			$this->doReg();
			$this->doRegGG();
			$id = $this->lastUpdateUserId;
		}
		
		return array($ret, $id);
	}

	//	output
	//	array(result, id)
	//	1: success
	public function doLoginFB() {
		$ret = '0';
		$id = 0;
		
		$tmp = $this->checkDuplicate();

		if($tmp !== false) {
			if($tmp[0]['store_id'] != NULL) {
				$_SESSION['sess_user_id'] = $tmp[0]['id'];
				$_SESSION['sess_user_name'] = $this->input->post('txt_email');
				$_SESSION['sess_store_id'] = $tmp[0]['store_id'];
				$_SESSION['sess_store_name'] = $tmp[0]['store_name'];
				$ret='1';
				$id = $tmp[0]['id'];
			}
		} else {
			//reg
			$this->doReg();
			$this->doRegGG();
			$id = $this->lastUpdateUserId;
		}
echo $ret;
		return array($ret, $id);
	}	

}