<?php
/*
* File:			Crontab_model.php
* Version:		-
* Last changed:	2018/08/14
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Crontab_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getInvoice() {

		$account = $this->load->database('account', TRUE);
		$account->select('*');

		$account->where('is_send', '0');
		$query = $account->get('mail_invoice');

		return $query->result_array();
	}
}