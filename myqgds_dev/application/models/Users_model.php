<?php
/*
* File:			Users_model.php
* Version:		-
* Last changed:	2018/07/19
* Purpose:		-
* Author:		users
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Users_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getUsersBySearch() {
		$this->db->select('id, name, login_type');
		$this->db->like('name', $_POST['keyword'], 'after');
		$query = $this->db->get('users');

		$query_ary = $query->result_array();
		if(count($query_ary) > 0) {
			foreach ($query_ary as $key => $val) {
				switch ($val['login_type']) {
					case 1:
						$ary_ret[$val['id']] = $val['name'] . '（ Rapaq ）';
						break;
					case 2:
						$ary_ret[$val['id']] = $val['name'] . '（ Facebook ）';
						break;
					case 3:
						$ary_ret[$val['id']] = $val['name'] . '（ Google ）';
						break;
				}
			}
		} else {
			$ary_ret[0] = 'no data';
		}
		return $ary_ret;
	}

	public function getUserById($user_id) {
		$this->db->select('u.name as user_name, ua.rec_addr as user_addr, ua.rec_phone as user_phone');
		$this->db->join('user_address ua', 'ua.user_id = u.id', 'left');
		$this->db->where('u.id', $user_id);
		$query = $this->db->get('users u');

		return $query->result_array();
	}
}