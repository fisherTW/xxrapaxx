<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Rapaq.php
* Version:		-
* Last changed:	2018/08/13
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Rapaq extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
	}

	public function faq() {
		$data['title'] = '常見問題│RAPAQ';

		$this->load->view('template/header', $data);
		$this->load->view('rapaq/faq', $data);
		$this->load->view('template/footer');
	}

}