<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			spec.php
* Version:		-
* Last changed:	2018/07/11
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Spec extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Spec_model');
	}

	public function list() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'spec';

		$this->load->view('template/header',$data);
		$this->load->view('spec/list', $data);
		$this->load->view('template/footer');
	}

	public function doEdit() {
		echo $this->Spec_model->doEdit($_SESSION['sess_store_id']);
	}

	public function getSpecByStoreId() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$ary_data = $this->Spec_model->getSpecByStoreId($_SESSION['sess_store_id']);
		echo json_encode($ary_data);
	}

}