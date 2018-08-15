<?php
/*
* File:			Supplier_model.php
* Version:		-
* Last changed:	2018/07/20
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Supplier_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	// //	output
	// //	1: success
	// public function doCreate() {
	// 	$ary_data = array(
	// 		'name'			=> $this->input->post('txt_name'),
	// 		'pic_logo'		=> $this->input->post('hid_logo_pic'),
	// 		'pic_bg'		=> $this->input->post('hid_bg_pic'),
	// 		'url_youtube'	=> $this->input->post('txt_url_youtube'),
	// 		'profile'		=> $this->input->post('txt_profile'),
	// 		'dt_create'		=> date('Y-m-d H:i:s')
	// 	);

	// 	$this->db->set($ary_data);
	// 	$this->db->insert('factory');

	// 	return 1;		
	// }

	//	output
	//	1: success
	public function doEditSupplier() {
		
		$ary_data = array(
			'old_num'		=> $_POST['txt_old_num'], 
			'name'			=> $_POST['txt_name']
		);
		$this->db->set($ary_data);

		if ($_POST['hid_supplier_id'] == '0') {
			$this->db->set($ary_data);
			$this->db->insert('supplier');

			return 1;
		}	else {
			$this->db->where('id', $_POST['hid_supplier_id']);
			$this->db->update('supplier');

			return 1;
		}
				
	}

	public function doDelSupplier() {
		
		$this->db->where('id', $_POST['id']);
		$this->db->delete('supplier');

		return 1;	
	}

	public function getSupplier() {
		$this->db->select('s.*');

		$query = $this->db->get('supplier s');

		return $query->result_array();
	}

	public function get($supplier_id) {
		$this->db->select('s.*');
		$this->db->where('s.id', $supplier_id);
		$query = $this->db->get('supplier s');

		return $query->result_array();
	}	
}