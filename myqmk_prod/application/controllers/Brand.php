<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Brand.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Brand extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Project_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'brand';

		$this->load->view('template/header',$data);
		$this->load->view('brand/index', $data);
		$this->load->view('template/footer');
	}

	public function edit($project_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'brand';

		$data['info'] = $this->Project_model->get($project_id);
		$data['id'] = $project_id;

		$this->load->view('template/header',$data);
		$this->load->view('brand/edit', $data);
		$this->load->view('template/footer');		
	}

	public function doEdit() {
		echo $this->Project_model->doEditBrand();
	}
}