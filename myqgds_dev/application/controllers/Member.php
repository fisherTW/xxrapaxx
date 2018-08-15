<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Member.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Member extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('Member_model');

	}

	public function login() {
		$data = array();

		$this->load->view('login',$data);
	}

	public function logout() {
		$data = array();

		$this->load->view('logout',$data);
	}	

	public function doReg() {
		if($this->Member_model->checkDuplicate() !== false) {
			echo 0;
			exit();
		} else {
			echo $this->Member_model->doReg();
		}
	}

	public function doLogin() {
		list($res, $id) = $this->Member_model->doLogin();
		$_SESSION['sess_user_id'] = ($res == '1') ? $id : null;
		echo $res;
	}

	public function doLogout() {
		$this->session->sess_destroy();
		redirect(base_url().'member/logout', 'refresh');		
	}

}

