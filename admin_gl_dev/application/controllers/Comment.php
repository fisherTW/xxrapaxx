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

	public function index_qmaker() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'comment_qmaker';

		$this->load->view('template/header',$data);
		$this->load->view('comment/index_qmaker', $data);
		$this->load->view('template/footer');
	}

	public function index_qgoods() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'comment_qgoods';

		$this->load->view('template/header',$data);
		$this->load->view('comment/index_qgoods', $data);
		$this->load->view('template/footer');
	}

	public function getMy($source='') {
		echo json_encode($this->Comment_model->getMy($source));
	}
}