<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Brand.php
* Version:		-
* Last changed:	2018/05/14
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Brand extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Project_model');		
	}

	public function index($id) {
		$data['title'] = '品牌簡介│募設計';
		$data['info'] = $this->Project_model->getProjectById($id);

		$this->load->view('template/header',$data);
		$this->load->view('brand/index', $data);
		$this->load->view('template/footer');
	}
}