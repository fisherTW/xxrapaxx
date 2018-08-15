<?php
/*
* File:			Supplier_model.php
* Version:		-
* Last changed:	2018/07/20
* Purpose:		-
* Author:		supplier
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Supplier_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get() {
		$ary_data = array();

		$this->db->where('name !=', '');
		$this->db->order_by('old_num', 'asc');
		$query = $this->db->get('supplier');
		$ary_ret = $query->result_array();
		if(count($ary_ret) > 0) {
			foreach ($ary_ret as $value) {
				$ary_data[$value['id']] = $value['old_num'].'（'.$value['name'].'）';
			}
		} 

		return $ary_data;
	}
}