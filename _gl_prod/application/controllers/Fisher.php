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
class Fisher extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}


	public function index() {
		//echo phpinfo();
	}

	public function index2() {
		//var_dump(date("Y-m-d H:i:s"));
	}

}