<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Comment.php
* Version:		-
* Last changed:	2018/05/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Comment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Comment_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Users Backend・募設計';
		$data['path'] = 'comment';

		$this->load->view('template/header',$data);
		$this->load->view('comment/index', $data);
		$this->load->view('template/footer');
	}

	public function doEdit() {
		echo $this->Comment_model->doEdit();
	}

	public function getMy() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Comment_model->getMy());
	}
}