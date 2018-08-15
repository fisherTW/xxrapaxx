<?php
/*
* File:			Payment_model.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Payment_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	//	output
	//	1: success
	public function create() {
		$this->db->delete('qmaker_bank_setting', array('user_id' => $_SESSION['sess_user_id']));

		$ary_data = array(
			'user_id'			=> $_SESSION['sess_user_id'],
			'contact_person'	=> $this->input->post('contact_person'), 
			'bank_name'			=> $this->input->post('bank_name'), 
			'branch_name'		=> $this->input->post('branch_name'), 
			'account_name'		=> $this->input->post('account_name'), 
			'account'			=> $this->input->post('account'), 
			'identity_id'		=> $this->input->post('identity_id'), 
			'invoice_title'		=> $this->input->post('invoice_title'), 
			'invoice_addr'		=> $this->input->post('invoice_addr'),
			'dt_create'			=> date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);
		$this->db->insert('qmaker_bank_setting');

		return 1;
	}

	public function get($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('qmaker_bank_setting');

		return $query->result_array();
	}
}