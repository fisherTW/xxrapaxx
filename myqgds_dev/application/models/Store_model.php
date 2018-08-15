<?php
/*
* File:			Store_model.php
* Version:		-
* Last changed:	2018/06/05
* Purpose:		-
* Author:		store
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Store_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getStoreById($id) {
		$this->db->select('id, profile, pic_logo, pic_banner, is_enable, is_direct');
		$this->db->where('id', $id);
		$query = $this->db->get('store');
		
		return $query->row_array();		
	}

	public function doEdit() {
		$ary_data = array(
			'is_enable'	=> $this->input->post('sel_is_enable'),
			'pic_logo'	=> $this->input->post('hid_pic_logo'),
			'pic_banner'=> $this->input->post('hid_pic_banner'),
			'profile'	=> $this->input->post('txt_profile'),
			'dt_update'	=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_data);
		$this->db->where('id', $this->input->post('hid_store_id'));
		$this->db->update('store');

		return 1;
	}
}