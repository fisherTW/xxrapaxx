<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Cart.php
* Version:		-
* Last changed:	2018/05/14
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Cart extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function add() {
		if(isset($_SESSION['sess_user_id'])) {
			$this->load->model('Cart_model');
			echo $this->Cart_model->add();
		} else {
			$this->addNoSess();
			echo '1';
		}
	}

	public function addNoSess() {
		$ary_sess = isset($_SESSION['sess_cart']) ? json_decode($_SESSION['sess_cart'], true) : array();
		$ary_sess[$this->input->post('hid_prod_id')] = array(
			'product_id' => $this->input->post('hid_prod_id'),
			'spec_id' => $this->input->post('sel_modal_spec'),
			'quantity' => $this->input->post('txt_quantity'),
			'source'	=> SOURCE_QMAKER
		);

		$ary_sess = array_values($ary_sess);

		$_SESSION['sess_cart'] = json_encode($ary_sess);

		return 1;
	}
}