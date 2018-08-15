<?php
/*
* File:			Trans_model.php
* Version:		-
* Last changed:	2018/05/16
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Trans_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->load->model('Orders_model');
	}

	public function add() {
		list($usec, $x) = explode(' ', microtime());
		$trans_id = date("ymdHis").substr(strval($usec * 1000000), 0, 6);

		$ary_product = array(
			'user_id'		=> $_SESSION['sess_user_id'], 
			'order_id'		=> $_SESSION['sess_order_id'],
			'trans_id'		=> $trans_id,
			'status'		=> PAYMENT_INIT,
			'dt_create'		=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_product);
		$this->db->insert('log_trans');

		$this->Orders_model->updateStatusPayment($_SESSION['sess_order_id'], PAYMENT_INIT);
		
		return $trans_id;
	}

	public function updateStatus($ary_res) {
		$ary_result = json_decode($ary_res['Result'], true);
		$ary_product = array(
			'status'			=> ($ary_res['Status'] == 'SUCCESS' ? PAYMENT_SUCCESS : PAYMENT_FAIL),
			'spg_Message'		=> $ary_res['Message'],
			'spg_PaymentType'	=> (isset($ary_result['PaymentType']) ? $ary_result['PaymentType'] : ''),
			'spg_Card6No'		=> (isset($ary_result['Card6No']) ? $ary_result['Card6No'] : ''),
			'spg_Card4No'		=> (isset($ary_result['Card4No']) ? $ary_result['Card4No'] : '')
		);

		$this->db->set($ary_product);
		$this->db->where('trans_id', $ary_result['MerchantOrderNo']);
		$this->db->update('log_trans');

		$order_id = $this->getOrderidByTransid($ary_result['MerchantOrderNo']);

		$this->Orders_model->updateStatusPayment($order_id, ($ary_res['Status'] == 'SUCCESS' ? PAYMENT_SUCCESS : PAYMENT_FAIL));

		return 1;
	}

	public function getOrderidByTransid($trans_id) {
		$ret = 0;
		$this->db->where('trans_id', $trans_id);
		$query = $this->db->get('log_trans');

		$row = $query->row();

		if (isset($row)) {
			$ret = $row->order_id;
		}

		return $ret;
	}
}