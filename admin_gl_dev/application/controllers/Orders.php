<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Orders.php
* Version:		-
* Last changed:	2018/06/05
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Orders extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Orders_model');

		$this->ary_send = array(
			0 => '未出貨',
			1 => '已出貨',
			2 => '退貨中',
			3 => '已退貨'
		);
	}

	public function index_qmaker() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'orders_qmaker';

		$this->load->view('template/header',$data);
		$this->load->view('orders/index_qmaker', $data);
		$this->load->view('template/footer');
	}

	public function index_qgoods() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'orders_qgoods';

		$this->load->view('template/header',$data);
		$this->load->view('orders/index_qgoods', $data);
		$this->load->view('template/footer');
	}

	public function edit_qmaker($order_id, $project_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'orders_qmaker';

		$data['ary_data'] = $this->Orders_model->getOrderById($order_id, $project_id);
		$data['user_data'] = $this->Orders_model->getUserById($data['ary_data']['0']['user_id']);
		$data['ary_payment'] = json_decode(JSON_PAYMENT_STATUS, true);
		$data['ary_send'] = $this->ary_send;
		$ary_trans = $this->Orders_model->getTransByOrderId($order_id, $data['ary_data']['0']['user_id']);

		if (count($ary_trans) >= '1') {
			$data['ary_trans'] = $ary_trans;
		}	else {
			$data['ary_trans'][0]['trans_id'] = '';
			$data['ary_trans'][0]['paymenttype'] = '';
		}

		$this->load->view('template/header',$data);
		$this->load->view('orders/edit_qmaker', $data);
		$this->load->view('template/footer');		
	}

	public function edit_qgoods($order_id, $store_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'orders_qgoods';

		$data['ary_data'] = $this->Orders_model->getOrderById($order_id, $store_id);
		$data['user_data'] = $this->Orders_model->getUserById($data['ary_data']['0']['user_id']);
		$data['ary_refund']  = $this->Orders_model->getrefundById($order_id, $store_id);
		$ary_trans = $this->Orders_model->getTransByOrderId($order_id, $data['ary_data']['0']['user_id']);

		if (count($ary_trans) >= '1') {
			$data['ary_trans'] = $ary_trans;
		}	else {
			$data['ary_trans'][0]['trans_id'] = '';
			$data['ary_trans'][0]['paymenttype'] = '';
		}

		$data['ary_payment'] = json_decode(JSON_PAYMENT_STATUS, true);
		$data['ary_send'] = $this->ary_send;

		$this->load->view('template/header',$data);
		$this->load->view('orders/edit_qgoods', $data);
		$this->load->view('template/footer');		
	}

	public function doEdit() {
		echo $this->Orders_model->doEdit();
	}

	public function get($source) {
		if(!isset($_SESSION['sess_user_id'])) {
			return 0;
		}
		echo json_encode($this->Orders_model->get($source));
	}
}