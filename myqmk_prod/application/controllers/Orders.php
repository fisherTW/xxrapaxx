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
			1 => '已出貨'
		);
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'orders';

		$this->load->view('template/header',$data);
		$this->load->view('orders/index', $data);
		$this->load->view('template/footer');
	}

	public function edit($order_id, $project_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'orders';

		$data['ary_data'] = $this->Orders_model->getOrderById($order_id, $project_id);
		$data['ary_payment'] = json_decode(JSON_PAYMENT_STATUS, true);
		$data['ary_send'] = $this->ary_send;

		$this->load->view('template/header',$data);
		$this->load->view('orders/edit', $data);
		$this->load->view('template/footer');		
	}

	public function doEdit() {
		echo $this->Orders_model->doEdit();
	}

	public function getMy() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Orders_model->getMy());
	}
}