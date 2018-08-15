<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Journal.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Journal extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Journal_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$this->load->helper('form');
		$this->load->model('Project_model');

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'journal';
		$ary_ret = $this->Project_model->getMyProject($_SESSION['sess_user_id']);
		$ary_project = array();
		if(count($ary_ret) > 0 ){
			foreach ($ary_ret as $val) {
				$ary_project[$val['id']] = $val['name'];
			}
		}
		$data['ary_project'] = $ary_project;

		$this->load->view('template/header',$data);
		$this->load->view('journal/index', $data);
		$this->load->view('template/footer');
	}

	public function doCreate() {
		echo $this->Journal_model->doCreate($source=SOURCE_QMAKER);
	}

	public function getMy() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Journal_model->getMy());
	}
}