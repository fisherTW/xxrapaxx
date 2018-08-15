<?php
/*
* File:			Qgoods_model.php
* Version:		-
* Last changed:	2018/05/17
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Qgoods_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getBanner() {
		$this->db->where('dt_exp_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_exp_end >',date('Y-m-d H:i:s')); 
		$query = $this->db->get('banner');

		return $query->result_array();
	}
}