<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Qa.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Qa extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Payment_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'qa';

		$data['info'] = $this->Payment_model->get('123');

		$this->load->view('template/header',$data);
		$this->load->view('payment/index', $data);
		$this->load->view('template/footer');
	}

	public function create() {
		$this->Payment_model->create();

		echo 1;
	}
}