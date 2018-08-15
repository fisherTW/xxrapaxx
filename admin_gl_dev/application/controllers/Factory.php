<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Ｆactory.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Factory extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Factory_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'factory';

		$this->load->view('template/header',$data);
		$this->load->view('factory/index', $data);
		$this->load->view('template/footer');
	}

	public function getFactory() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Factory_model->getFactory());
	}

	public function edit($factory_id = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'factory';

		$data['info'] = $this->Factory_model->get($factory_id);
		$data['id'] = $factory_id;

		$this->load->view('template/header',$data);
		$this->load->view('factory/edit', $data);
		$this->load->view('template/footer');		
	}

	public function doEdit() {
		$this->Factory_model->doEditFactory();
	}

	public function doDelete() {
		$this->Factory_model->doDelFactory();
	}
}