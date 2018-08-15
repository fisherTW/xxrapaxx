<?php
/*
* File:			Brand_model.php
* Version:		-
* Last changed:	2018/07/20
* Purpose:		-
* Author:		brand
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Brand_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getBrandByStoreId($store_id) {
		$this->db->where('store_id', $store_id);
		$query = $this->db->get('brand');

		return $query->result_array();
	}

	public function doEdit($store_id) {
		$ary_data = array(
			'store_id'	=> $store_id,
			'name'		=> $this->input->post('txt_name')
		);

		if(strval($this->input->post('hid_id')) == '0') {
			$this->db->set($ary_data);
			$this->db->insert('brand');
		} else {
			unset($ary_data['store_id']);
			$this->db->set($ary_data);
			$this->db->where('id', $this->input->post('hid_id'));
			$this->db->update('brand');
		}

		return 1;
	}

	public function doDel($id) {
		$this->db->where('id', $id);
		$this->db->delete('brand');

		return 1;
	}
}