<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			info.php
* Version:		-
* Last changed:	2018/07/03
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Info extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Store_model');

		$this->ary_enable = array(
			0 => '下架',
			1 => '上架'
		);		
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$this->load->helper('form');

		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'info';
		$data['data'] = $this->Store_model->getStoreById($_SESSION['sess_store_id']);
		$data['ary_enable'] = $this->ary_enable;

		$this->load->view('template/header',$data);
		$this->load->view('info/index', $data);
		$this->load->view('template/footer');
	}

	public function doEdit() {
		echo $this->Store_model->doEdit();
	}

}