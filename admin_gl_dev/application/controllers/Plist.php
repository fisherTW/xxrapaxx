<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Plist.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		admin_dev
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

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'list';

		$this->load->view('template/header',$data);
		$this->load->view('plist/index', $data);
		$this->load->view('template/footer');
	}

	public function createProduct() {
		echo $this->Project_model->createProduct();
	}

	public function cuFaq() {
		echo $this->Project_model->cuFaq();
	}

	public function edit_2_1() {
		echo $this->Project_model->edit_2_1();
	}

	public function edit_a_1() {
		if(!isset($_SESSION['sess_user_id'])) {
			echo 0;exit();
		}

		$ary_rdo_pdt_status = $_POST['rdo_pdt_status'];
		
		foreach ($ary_rdo_pdt_status as $key => $value) {	

			$edit_a_1_1 = $this->Project_model->edit_a_1_1($key, $value);
			if ($edit_a_1_1 == '0') {
				echo 0;
				exit();
			}
		}
		echo $this->Project_model->edit_a_1();
	}			

	public function doDelFaq() {
		echo $this->Project_model->doDelFaq();
	}

	public function getProject() {
		if(!isset($_SESSION['sess_user_id'])) {
			echo 0;exit();
		}
		echo json_encode($this->Project_model->getProject());
	}

	public function edit($project_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$this->load->helper('form');

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'list';
		$data['info'] = $this->Project_model->get($project_id);
		$data['pdt'] = $this->Project_model->getProductStatus($project_id);
		$data['id'] = $project_id;
		$data['ary_status'] = json_decode(JSON_PORJECT_STATUS, true);

		$this->load->view('template/header',$data);
		$this->load->view('plist/edit', $data);
		$this->load->view('template/footer');		
	}

	public function getProduct($project_id) {
		echo json_encode($this->Project_model->getProduct($project_id));
	}
	public function getFaq($project_id) {
		echo json_encode($this->Project_model->getFaq($project_id));
	}	
}