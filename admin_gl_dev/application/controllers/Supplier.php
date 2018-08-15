<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Supplier.php
* Version:		-
* Last changed:	2018/07/20
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Supplier extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Supplier_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'supplier';

		$this->load->view('template/header',$data);
		$this->load->view('supplier/index', $data);
		$this->load->view('template/footer');
	}

	public function getSupplier() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Supplier_model->getSupplier());
	}

	public function edit($supplier_id = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'supplier';

		$data['info'] = $this->Supplier_model->get($supplier_id);
		$data['id'] = $supplier_id;

		$this->load->view('template/header',$data);
		$this->load->view('supplier/edit', $data);
		$this->load->view('template/footer');		
	}

	public function doEdit() {
		$this->Supplier_model->doEditSupplier();
	}

	public function doDelete() {
		$this->Supplier_model->doDelSupplier();
	}
}