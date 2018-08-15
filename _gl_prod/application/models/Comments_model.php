<?php
/*
* File:			Comments_model.php
* Version:		-
* Last changed:	2018/05/30
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Comments_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get($source, $p_id) {
		$this->db->select('comments.*, users.name as q_user_name');
		$this->db->join('users', 'users.id=comments.user_id', 'left');
		$this->db->where('source', $source);
		$this->db->where('p_id', $p_id);
		$this->db->order_by('dt_create', 'DESC');
		$query = $this->db->get('comments');

		return $query->result_array();
	}

	public function doCreate($content, $p_id, $source) {
		$ary_data = array(
			'p_id'		=> $p_id,
			'user_id'	=> $_SESSION['sess_user_id'],
			'content'	=> $content,
			'source'	=> $source,
			'dt_create'	=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_data);
		$this->db->insert('comments');
		
		return 1;
	}

}