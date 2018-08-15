<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			User.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('Member_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'user';

		$this->load->view('template/header',$data);
		$this->load->view('user/index', $data);
		$this->load->view('template/footer');
	}

	public function update_is_admin() {
		if(!isset($_SESSION['sess_user_id'])) {
			echo 0;exit();
		}		
		echo $this->Member_model->update_is_admin();
	}
}

