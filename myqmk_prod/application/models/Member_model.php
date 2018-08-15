<?php
/*
* File:			Member_model.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
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
			'login_type'	=> ($this->input->post('login_type') == null) ? 1 : $this->input->post('login_type')
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
			'mail'		=> $this->input->post('txt_email'), 
			'password'	=> md5($this->input->post('txt_password'))
		);
		$this->db->select('id, name');
		$this->db->where($ary_data);
		$query = $this->db->get('users');
		$row = $query->row();

		if(isset($row)) {
			$result = '1';
			$id = $row->id;

			$_SESSION['sess_user_name'] = $row->name;
		} else {
			$result = '0';
			$id = 0;
		}


		return array($result, $id);
	}	

	public function checkDuplicate() {
		$this->db->from('users');
		$this->db->where('mail', $this->input->post('txt_email'));
		$query = $this->db->get();
		$ary_res = $query->result_array();

		return (count($ary_res) > 0 ? $ary_res[0]['id'] : false);
	}

	public function checkDuplicateGG() {
		$this->load->database();
		$this->db->from('users');
		$this->db->join('user_social_info usi','users.id=usi.user_id','left');
		$this->db->where('usi.token', $this->input->post('txt_token'));
		$query = $this->db->get();
		$ary_res = $query->result_array();

		return (count($ary_res) > 0 ? $ary_res[0]['user_id'] : false);
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
		$ret = 0;
		$id = 0;
		
		$tmp = $this->checkDuplicate();

		if($tmp !== false) {
			$_SESSION['sess_user_id'] = $tmp;
			$_SESSION['sess_user_name'] = $this->input->post('txt_email');
		} else {
			//reg
			$this->doReg();
			$this->doRegGG();
			$id = $this->lastUpdateUserId;
		}
		
		return array($ret, $id);
	}	

	public function getMemberById($id) {
		$this->db->select('id, mail, name, pic_head, date_birth,gender,aboutme,phone');
		$this->db->where('id', $id);
		$query = $this->db->get('users');

		return $query->row_array();
	}

	public function profileEdit_doEdit() {
		$ary_data = array(
			'name'		=> $this->input->post('txt_name'),
			'mail'		=> $this->input->post('txt_mail'),
			'date_birth'=> $this->input->post('txt_date_birth'),
			'phone'		=> $this->input->post('txt_phone'),
			'gender'	=> $this->input->post('sel_gender'),
			'aboutme'	=> $this->input->post('txt_aboutme'),
			'dt_update' => date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);
		$this->db->where('id', $this->input->post('hid_id'));
		$this->db->update('users');

		return 1;
	}
}