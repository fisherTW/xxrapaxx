<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Refund.php
* Version:		-
* Last changed:	2018/07/23
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Refund extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Refund_model');

		$this->ary_send = array(
			0 => '未出貨',
			1 => '已出貨',
			2 => '退貨中',
			3 => '已退貨'
		);
	}

	public function index_qgoods() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'orders_qgoods_refund';

		$this->load->view('template/header',$data);
		$this->load->view('refund/index_qgoods', $data);
		$this->load->view('template/footer');
	}

	public function edit_qgoods($order_id, $store_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'orders_qgoods_refund';

		$data['ary_data'] = $this->Refund_model->getOrderById($order_id, $store_id);
		$data['user_data'] = $this->Refund_model->getUserById($data['ary_data']['0']['user_id']);

		$data['ary_refund']  = $this->Refund_model->getrefundById($order_id, $store_id);

		$ary_trans = $this->Refund_model->getTransByOrderId($order_id, $data['ary_data']['0']['user_id']);

		if (count($ary_trans) >= '1') {
			$data['ary_trans'] = $ary_trans;
		}	else {
			$data['ary_trans'][0]['trans_id'] = '';
			$data['ary_trans'][0]['paymenttype'] = '';
		}

		$data['ary_payment'] = json_decode(JSON_PAYMENT_STATUS, true);
		$data['ary_send'] = $this->ary_send;

		$this->load->view('template/header',$data);
		$this->load->view('refund/edit_qgoods', $data);
		$this->load->view('template/footer');		
	}

	public function doRefund() {
		$log_refund = $this->Refund_model->insertLogRefund();

		$order_store = $this->Refund_model->updateRefund();

		if ($log_refund = 1 && $order_store = 1) {
			echo 1;
		}
	}

	public function get($source) {
		if(!isset($_SESSION['sess_user_id'])) {
			return 0;
		}
		echo json_encode($this->Refund_model->get($source));
	}
}