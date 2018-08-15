<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Statement.php
* Version:		-
* Last changed:	2018/07/26
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Statement extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Statement_model');
	}

	public function index_statement() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'statement';

		$this->load->view('template/header',$data);
		$this->load->view('statement/index_statement', $data);
		$this->load->view('template/footer');
	}

	public function index_statement_self() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'statement_self';

		$this->load->view('template/header',$data);
		$this->load->view('statement/index_statement_self', $data);
		$this->load->view('template/footer');
	}

	public function getStatement($is_direct = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data = $this->Statement_model->getStatement($is_direct);

		$data = array('rows' => $data);
		$data['total'] = $this->Statement_model->countStatement($is_direct);

		foreach ($data['rows'] as $key => $value) {
			if ($value['log_refund_id'] != 0 && $value['is_delivery'] == 0) {
				$data_refund = $this->Statement_model->getRefund($value['order_id'], $value['store_id']);
 
				//$data_refund = $this->Statement_model->getRefundOrder($data_refund[0]['order_id'], $value[0]['store_id']);
				$data[$key]['amt'] = $data_refund[0]['amt'];

 			}
 		}
 		echo json_encode($data);
	}

	public function getStatementRefund($is_direct) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data = $this->Statement_model->getStatementRefund($is_direct);

		$data = array('rows' => $data);
		$data['total'] = $this->Statement_model->countStatementRefund($is_direct);

		echo json_encode($data);
	}

	public function StoreSearch($is_direct) {

		$this->load->helper('form');
		$ary = $this->Statement_model->getStoreSearch($is_direct);
		
		echo form_dropdown('div_search', $ary, 0, "id='div_search' class='form-control' size='12'");
	}
}