<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Comments.php
* Version:		-
* Last changed:	2018/05/30
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Comments extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
	}

	public function doCreate() {
		$this->load->model('Comments_model');
		echo $this->Comments_model->doCreate($_POST['content'], $_POST['p_id'], $_POST['source']);
	}

}