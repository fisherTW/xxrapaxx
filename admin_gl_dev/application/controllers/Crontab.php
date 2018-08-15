<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Crontab.php
* Version:		-
* Last changed:	2018/08/14
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Crontab extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crontab_model');
	}

	public function invoicetopay2go() {

		$ary_data = $this->Crontab_model->getInvoice();

		$this->createInvoice($ary_data);

		return 1;
	}
}