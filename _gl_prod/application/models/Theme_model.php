<?php
/*
* File:			Theme_model.php
* Version:		-
* Last changed:	2018/06/19
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Theme_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}


	public function get() {
		$this->db->order_by('dt_create', 'DESC');
		$this->db->where('is_enable', 1);
		$this->db->where('is_del', 0);
		$query = $this->db->get('theme');

		return $query->result_array();
	}

	public function getIndex() {
		$this->db->select('id, name, pic_cover, pic_cover2, link');
		$this->db->order_by('dt_update', 'DESC');
		$this->db->where('is_enable', 1);
		$this->db->where('is_del', 0);
		$this->db->where('dt_exp_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_exp_end >',date('Y-m-d H:i:s')); 
		$query = $this->db->get('theme');

		return $query->result_array();
	}

	public function getThemeByLink($link) {
		$this->db->select('*');
		$this->db->where('link', $link);
		$query = $this->db->get('theme');

		return $query->row_array();
	}

	public function getMTPById($id) {
		$this->db->select('s.id as store_id, s.name as store_name, p.id as product_id, p.name as product_name, p.price_deal as price_deal, p.url_pic as url_pic');
		$this->db->join('product p', 'p.id=mtp.product_id', 'left');
		$this->db->join('store s', 's.id=p.store_id', 'left');
		$this->db->where('mtp.theme_id', $id);
		$query = $this->db->get('mapping_theme_product mtp');

		return $query->result_array();		
	}
}