<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Plist.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Plist extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Project_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'list';

		$this->load->view('template/header',$data);
		$this->load->view('plist/index', $data);
		$this->load->view('template/footer');
	}

	public function editProjectSattus() {
		echo $this->Project_model->editProjectSattus();
	}

	public function createProduct() {
		echo $this->Project_model->createProduct();
	}

	public function doDelProduct() {
		echo $this->Project_model->doDelProduct();
	}

	public function cuFaq() {
		echo $this->Project_model->cuFaq();
	}

	public function edit_2_1() {
		echo $this->Project_model->edit_2_1();
	}	

	public function doDelFaq() {
		echo $this->Project_model->doDelFaq();
	}

	public function getMyProject() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Project_model->getMyProject());
	}

	public function edit($project_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'list';
		$data['info'] = $this->Project_model->get($project_id);
		$data['id'] = $project_id;

		$this->load->view('template/header',$data);
		$this->load->view('plist/edit', $data);
		$this->load->view('template/footer');		
	}

	public function getProduct($project_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Project_model->getProduct($project_id));
	}
	public function getFaq($project_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Project_model->getFaq($project_id));
	}	
}