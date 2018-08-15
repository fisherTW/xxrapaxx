<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Orders.php
* Version:		-
* Last changed:	2018/06/28
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Orders extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Orders_model');

	}

	public function list() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'orders';

		$this->load->view('template/header',$data);
		$this->load->view('orders/list', $data);
		$this->load->view('template/footer');
	}

	public function edit($order_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');
		$this->load->model('Users_model');

		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'orders';

		$data['ary_data'] = $this->Orders_model->getOrderById($order_id, $_SESSION['sess_store_id']);
		$data['user_data'] = $this->Users_model->getUserById($data['ary_data']['0']['user_id']);
		$data['ary_payment'] = json_decode(JSON_PAYMENT_STATUS, true);
		$data['ary_send'] = json_decode(JSON_SEND_STATUS, true);


		$this->load->view('template/header',$data);
		$this->load->view('orders/edit', $data);
		$this->load->view('template/footer');
	}

	public function doEdit() {
		echo $this->Orders_model->doEdit();
		if($_POST['sel_status_send'] == SEND_STATUS_SEND) {
			$this->createInvoice($_POST['hid_order_id'], $_POST['hid_store_id']);
		}
	}

	public function getMy() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		echo json_encode($this->Orders_model->getMy());
	}
}