<?php
/*
* File:			Factory_model.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Factory_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getFactorys() {
		$this->db->where('is_del', 0);
		$this->db->order_by('dt_create', 'DESC');
		$this->db->limit(3);
		$query = $this->db->get('factory');

		return $query->result_array();
	}

	public function getFactoryById($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('factory');
		
		return $query->row_array();
	}

	public function getFactorysAll($page=1) {
		$this->db->where('is_del', 0);
		$this->db->order_by('dt_create', 'DESC');
		$this->db->limit(12);
		$this->db->offset(($page -1) * 12);
		$query = $this->db->get('factory');
		
		return $query->result_array();
	}

	public function getFactorysCount() {
		$this->db->where('is_del', 0);

		return $this->db->count_all_results('factory');
	}
}