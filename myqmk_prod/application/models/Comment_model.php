<?php
/*
* File:			Comment_model.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Comment_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('qmaker_bank_setting');

		return $query->result_array();
	}

	public function getMy() {
		$this->db->select('c.*, p.name as project_name');
		$this->db->join('project p','p.id=c.p_id','left');
		$this->db->where('p.user_id', $_SESSION['sess_user_id']);
		$this->db->limit(100);
		$query = $this->db->get('comments c');

		return $query->result_array();
	}

	//	output
	//	1: success
	public function doEdit() {
		$ary_data = array(
			'reply'				=> $this->input->post('reply')
		);
		$this->db->set($ary_data);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('comments');

		return 1;		
	}	
}