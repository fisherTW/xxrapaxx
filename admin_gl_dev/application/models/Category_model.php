<?php
/*
* File:			Category_model.php
* Version:		-
* Last changed:	2018/07/13
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Category_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	//	output
	//	1: success
	public function doEditCategory() {
		$ary_data = array(
			'name'				=> $_POST['txt_name'], 
			'parent'			=> $_POST['txt_category']

		);
		$this->db->set($ary_data);

		if ($_POST['hid_category_id'] == '0') {
			$this->db->set($ary_data);
			$this->db->insert('mapping_goods_category');

			return 1;
		}	else {
			$this->db->where('id', $_POST['hid_category_id']);
			$this->db->update('mapping_goods_category');

			return 1;
		}
				
	}

	public function doDelCategory() {

		$this->db->where('id', $_POST['id']);
		$this->db->delete('mapping_goods_category');

		return 1;
	}

	public function getCategory() {
		$this->db->select('mgc.*');

		$this->db->limit(100);
		$this->db->order_by('mgc.parent', 'ASC');
		$query = $this->db->get('mapping_goods_category mgc');

		return $query->result_array();
	}

	public function getCategoryRoot($id) {
		$this->db->select('mgc.name');

		$this->db->where('id', $id);
		$query = $this->db->get('mapping_goods_category mgc');

		return $query->result_array();
	}

	public function get($category_id) {
		$this->db->select('mgc.*');

		$this->db->where('mgc.id', $category_id);
		$query = $this->db->get('mapping_goods_category mgc');

		return $query->result_array();
	}

	public function getCategoryProduct($category_id) {
		$this->db->select('p.id');

		$this->db->where('p.category_id', $category_id);
		$query = $this->db->get('product p');

		return $query->result_array();
	}	

	public function getCategoryData($category_id) {
		$this->db->select('mgc.id');

		$this->db->where('mgc.parent', $category_id);
		$query = $this->db->get('mapping_goods_category mgc');

		return $query->result_array();
	}

	public function getCategoryAry() {
		$this->db->select('mgc.id, mgc.name');

		$this->db->where('mgc.parent', 0);
		$query = $this->db->get('mapping_goods_category mgc');

		return $query->result_array();
	}	
	
}