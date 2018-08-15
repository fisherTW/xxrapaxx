<?php
/*
* File:			Journal_model.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Journal_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getMy() {
		$this->db->select('j.content, j.dt_create, p.name as project_name');
		$this->db->join('project p','p.id=j.p_id','left');		
		$this->db->where('j.user_id', $_SESSION['sess_user_id']);
		$this->db->limit(100);
		$query = $this->db->get('journal j');

		return $query->result_array();
	}

	//	output
	//	1: success
	public function doCreate($source) {
		$ary_data = array(
			'p_id'		=> $_POST['sel_project'],
			'user_id'	=> $_SESSION['sess_user_id'],
			'content'	=> $_POST['txt_content'],
			'source'	=> $source,
			'dt_create' => date('Y-m-d H:i:s')
		);

		$this->db->set($ary_data);
		$this->db->insert('journal');

		return 1;		
	}	
}