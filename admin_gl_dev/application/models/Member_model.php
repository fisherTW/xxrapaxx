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
	//	array(result, id)
	//	1: success
	public function doLogin() {
		if($_POST['login_type'] != null) {
			switch (strval($_POST['login_type'])) {
				case LOGIN_TYPE_GOOGLE:
					return $this->doLoginFB();
					exit();
					break;
				case LOGIN_TYPE_FB:
					return $this->doLoginFB();
					exit();
					break;
				default:
					break;
			}
		}

		$ary_data = array(
			'mail'		=> $_POST['txt_email'], 
			'password'	=> md5($_POST['txt_password'])
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
		$ary_where = array(
			'mail'		=> $_POST['txt_email'],
			'is_admin'	=> 1
		);
		$this->db->from('users');
		$this->db->where($ary_where);
		$query = $this->db->get();
		$ary_res = $query->result_array();

		return (count($ary_res) > 0 ? $ary_res[0]['id'] : false);
	}

	public function checkDuplicateGG() {
		$this->load->database();
		$this->db->from('users');
		$this->db->join('user_social_info usi','users.id=usi.user_id','left');
		$this->db->where('usi.token', $_POST['txt_token']);
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
			$_SESSION['sess_user_name'] = $_POST['txt_email'];

			$ret = 1;
			$id = $tmp;
		}
		
		return array($ret, $id);
	}	

	public function getMemberById($id) {
		$this->db->select('id, mail, name, pic_head, date_birth,gender,aboutme,phone');
		$this->db->where('id', $id);
		$query = $this->db->get('users');

		return $query->row_array();
	}

	public function get() {
		$this->db->select('id, name, mail, login_type, dt_update, is_admin');
		$query = $this->db->get('users');

		return $query->result_array();
	}

	public function update_is_admin() {
		$this->db->set('is_admin', $_POST['val'], false);
		$this->db->where('id', $_POST['id']);
		$this->db->update('users');

		echo $this->db->last_query();

		return 1;	
	}

	public function profileEdit_doEdit() {
		$ary_data = array(
			'name'		=> $_POST['txt_name'],
			'mail'		=> $_POST['txt_mail'],
			'date_birth'=> $_POST['txt_date_birth'],
			'phone'		=> $_POST['txt_phone'],
			'gender'	=> $_POST['sel_gender'],
			'aboutme'	=> $_POST['txt_aboutme'],
			'dt_update' => date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);
		$this->db->where('id', $_POST['hid_id']);
		$this->db->update('users');

		return 1;
	}
}