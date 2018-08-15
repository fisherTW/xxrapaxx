<?php
/*
* File:			Journal_model.php
* Version:		-
* Last changed:	2018/05/30
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Journal_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get($source, $p_id) {
		$this->db->where('source', $source);
		$this->db->where('p_id', $p_id);
		$this->db->order_by('dt_create', 'DESC');
		$query = $this->db->get('journal');

		return $query->result_array();
	}
}