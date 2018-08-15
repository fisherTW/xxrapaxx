<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Payments.php
* Version:		-
* Last changed:	2018/06/19
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_dev
*/
class Payment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Payment_model');

	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'payment';

		$this->load->view('template/header',$data);
		$this->load->view('payment/index', $data);
		$this->load->view('template/footer');
	}

	public function edit($payment_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'payment';

		$data['info'] = $this->Payment_model->getPaymentById($payment_id);


		$this->load->view('template/header',$data);
		$this->load->view('payment/edit', $data);
		$this->load->view('template/footer');		
	}

	public function doEdit() {
		echo $this->Payment_model->doEdit();
	}

	public function getMy() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Payment_model->getMy());
	}
}