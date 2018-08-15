<?php
/*
* File:			Payments_model.php
* Version:		-
* Last changed:	2018/06/19
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_dev
*/
class Payment_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getMy() {
		$this->db->select('qbs.id as id,u.name as user_name,qbs.contact_person as contact_person,qbs.identity_id as identity_id');
		$this->db->join('users u','u.id=qbs.user_id','left');

		$query = $this->db->get('qmaker_bank_setting qbs');

		return $query->result_array();
	}

	public function doEdit() {
		$ary_data = array(
			'user_id'			=> $_POST['hid_user_id'],
			'contact_person'	=> $_POST['contact_person'],
			'bank_name'			=> $_POST['bank_name'],
			'branch_name'		=> $_POST['branch_name'],
			'account_name'		=> $_POST['account_name'],
			'account'			=> $_POST['account'],
			'identity_id'		=> $_POST['identity_id'],
			'invoice_title'		=> $_POST['invoice_title'],
			'invoice_addr'		=> $_POST['invoice_addr'],
			'dt_update'			=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_data);
		$this->db->where('id', $_POST['hid_payment_id']);
		$this->db->update('qmaker_bank_setting');

		return 1;
	}

	public function getPaymentById($payment_id) {
		$this->db->select('qbs.*');
		$this->db->where('qbs.id', $payment_id);

		$query = $this->db->get('qmaker_bank_setting qbs');

		return $query->result_array();
	}
}