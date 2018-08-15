<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Goods.php
* Version:		-
* Last changed:	2018/06/22
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Goods extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Goods_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'goods';

		$this->load->view('template/header',$data);
		$this->load->view('goods/index', $data);
		$this->load->view('template/footer');
	}

	public function getProduct() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data = $this->Goods_model->getProducts();

		foreach ($data as $key => $value) {
			$spec_data = $this->Goods_model->getProductSpec($value['id']);
			$spec_name = '';
			foreach ($spec_data as $value) {
				$spec_name .= $value['spec_name'].'<br>';
			}
			$data[$key]['spec'] = $spec_name;
		}

		$data = array('rows' => $data);
		$data['total'] = $this->Goods_model->countProducts();

		echo json_encode($data);
	}

	public function edit($product_id = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$this->load->helper('form');
		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'goods';

		$data['info'] = $this->Goods_model->get($product_id);
		$data['spec'] = $this->Goods_model->getProductSpec($product_id);
		$cury_ary = json_decode(JSON_CURRENCY, true);
		$data['info'][0]['currency'] = $cury_ary[$data['info'][0]['currency']];

		$this->load->view('template/header',$data);
		$this->load->view('goods/edit', $data);
		$this->load->view('template/footer');
	}
}