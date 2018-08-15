<?php
/*
* File:			Account_model.php
* Version:		-
* Last changed:	2018/08/09
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Account_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function insertAccount($ary_data) {
		
		$account = $this->load->database('account', TRUE);

		foreach ($ary_data as $key => $value) {

			if ($value[5] == 'purchasebear@gmail.com') {
				$is_mail = '0';
			} else {
				$is_mail = '1';
			}

				$ary_data = array(
				'delivery_num'		=> $value[0], 
				'process_date'		=> $value[1],
				'collection_amt'	=> $value[2],
				'fare'				=> $value[3],
				'rec_name'			=> $value[4],
				'rec_mail'			=> $value[5],
				'rec_mobile'		=> $value[6],
				'auction_num'		=> $value[7],
				'descr'				=> $value[8],
				'service_type'		=> $value[9],
				'pick_store'		=> $value[10],
				'deduction_method'	=> $value[11],
				'is_mail_send'		=> $is_mail,
				'dt_create'			=> date("Y-m-s H:i:s"),
				'date'				=> date("Y").date("m"),
				'is_send'			=> '0'
				);


				$account->set($ary_data);
				$account->insert('mail_invoice');
			 
		}	
		return 1;	
	}

	public function checkAccountData($delivery_num) {
		$account = $this->load->database('account', TRUE);
		$account->select('count(ml.id) as num');

		$account->where('ml.delivery_num', $delivery_num);
		$account->group_by('ml.date');
		$query = $account->get('mail_invoice ml');

		return $query->result_array();
	}

	public function checkDataUpload() {
		$account = $this->load->database('account', TRUE);
		$account->select('count(ml.id) as num');

		$account->where('ml.date', date("Y").date("m"));
		$query = $account->get('mail_invoice ml');

		return $query->result_array();
	}

	public function getAccount() {
		$account = $this->load->database('account', TRUE);
		$account->select('ml.*');

		$account->group_by('ml.date');
		$query = $account->get('mail_invoice ml');

		return $query->result_array();
	}

	public function getAccountList($date='' ) {
		$account = $this->load->database('account', TRUE);
		$account->select('ml.*');

		$account->where('ml.date', $date);
		$query = $account->get('mail_invoice ml');

		return $query->result_array();
	}

	public function getDownloadList($date='' ) {
		$account = $this->load->database('account', TRUE);
		$account->select('ml.*');

		$account->where('ml.date', $date);
		$account->where('ml.is_mail_send', '0');

		$query = $account->get('mail_invoice ml');

		return $query->result_array();
	}

}