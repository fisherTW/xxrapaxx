<?php
/*
* File:			Faq_model.php
* Version:		-
* Last changed:	2018/05/17
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Faq_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get($source, $p_id) {
		$this->db->where('source', $source);
		$this->db->where('p_id', $p_id);
		$query = $this->db->get('faq');

		return $query->result_array();
	}
}