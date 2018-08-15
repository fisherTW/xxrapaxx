<?php
/*
* File:			Spec_model.php
* Version:		-
* Last changed:	2018/07/11
* Purpose:		-
* Author:		spec
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Spec_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getSpecByStoreId($store_id) {
		$this->db->where('store_id', $store_id);
		$query = $this->db->get('spec');

		return $query->result_array();
	}

	public function doEdit($store_id) {
		$ary_data = array(
			'store_id'	=> $store_id,
			'name'		=> $this->input->post('txt_name'),
			'color'		=> $this->input->post('txt_color'),
			'size'		=> $this->input->post('txt_size'),
		);

		if(strval($this->input->post('hid_id')) == '0') {
			$this->db->set($ary_data);
			$this->db->insert('spec');
		} else {
			unset($ary_data['store_id']);
			$this->db->set($ary_data);
			$this->db->where('id', $this->input->post('hid_id'));
			$this->db->update('spec');
		}

		return 1;
	}

	public function getSpecByProductId($store_id) {
		$ary_data = array();

		$this->db->where('store_id', $store_id);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('spec');
		$ary_ret = $query->result_array();
		if(count($ary_ret) > 0) {
			foreach ($ary_ret as $key => $value) {
				$ary_data[$value['id']] = $value['name'].'（'.$value['color'].' : '.$value['size'].'）';
			}
		} 

		return $ary_data;
	}
}