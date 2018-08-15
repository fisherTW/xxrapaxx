<?php
/*
* File:			Store_model.php
* Version:		-
* Last changed:	2018/06/20
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Store_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function search($word, $page=0) {
		$this->db->like('name', $word, 'both');
		$this->db->where('is_enable', 1);
		$this->db->where('dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_end >',date('Y-m-d H:i:s')); 
		if($page != 0){
			$this->db->limit(12);
			$this->db->offset(($page -1) * 12);
		}		
		$this->db->order_by('dt_create', 'DESC');
		$query = $this->db->get('store');

		return $query->result_array();
	}		

	public function getAll($page=1) {
		$this->db->where('is_enable', '1');
		$this->db->where('dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_end >',date('Y-m-d H:i:s')); 
		$this->db->order_by('name', 'DESC');
		$this->db->limit(12);
		$this->db->offset(($page -1) * 12);
		$query = $this->db->get('store');

		return $query->result_array();
	}

	public function getStoreById($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('store');
		
		return $query->row_array();
	}

	public function getAvailableStoreById($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->where('is_enable', '1');
		$this->db->where('dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_end >',date('Y-m-d H:i:s')); 
		$query = $this->db->get('store');
		
		return $query->row_array();
	}

	public function getStoreCount() {
		$this->db->where('is_enable', '1');
		$this->db->where('dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_end >',date('Y-m-d H:i:s')); 
		return $this->db->count_all_results('store');
	}

	public function getRecommendStore() {
		$this->db->order_by('dt_create', 'DESC');
		$this->db->where('is_recommend', '1');
		$this->db->where('is_enable', '1');
		$this->db->where('dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_end >',date('Y-m-d H:i:s')); 
		$this->db->limit(4);
		$query = $this->db->get('store');

		return $query->result_array();
	}	
}