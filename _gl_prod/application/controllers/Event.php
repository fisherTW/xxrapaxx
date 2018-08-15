<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Fisher.php
* Version:		-
* Last changed:	2018/05/14
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Event extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function qni() {
		$data['title'] = 'Q你腦募│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('event/qni', $data);
		$this->load->view('template/footer');
	}

	public function Taiwan_QTamsui() {
		$this->load->view('event/taiwan_QTamsui');
	}

	public function Taiwan_QTaichung() {
		$this->load->view('event/taiwan_QTaichung');
	}

	public function Taiwan_QHuadong() {
		$this->load->view('event/taiwan_QHuadong');
	}

	public function Taiwan_QTainan() {
		$this->load->view('event/taiwan_QTainan');
	}
}