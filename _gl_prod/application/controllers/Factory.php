<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Factory.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Factory extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('Factory_model');

		$this->ary_identity = array(
			0 => '請選擇',
			1 => '產品擁有者',
			2 => '設計師',
			3 => '工廠'
		);
	}

	public function index($id) {
		$data['title'] = '募設計';
		$data['info'] = $this->Factory_model->getFactoryById($id);

		if(isset($_SESSION['sess_user_id'])) {
			$this->load->model('Member_model');
			$data['isMyBookmark'] = $this->Member_model->isMyBookmark(SOURCE_FACTORY, $id);
		} else {
			$data['isMyBookmark'] = false;
		}

		$this->load->view('template/header',$data);
		$this->load->view('factory/index', $data);
		$this->load->view('template/footer');
	}

	public function list($page=1) {
		$data['title'] = '募設計夥伴│募設計';

		$data['ary_factory'] = $this->Factory_model->getFactorysAll($page);
		
		$count = $this->Factory_model->getFactorysCount();
		$pageCount = ceil($count/12);
		$str_ret = array();
		for ($i=1; $i<=$pageCount; $i++) {
			$str_ret[$i] = $i;
		}
		$data['FactorysCount'] = $str_ret;
		$data['page'] = $page;

		$this->load->view('template/header', $data);
		$this->load->view('factory/list', $data);
		$this->load->view('template/footer');
	}

	public function form() {
		$this->load->helper('form');

		$data['title'] = '申請表單|募設計';
		$data['ary_identity'] = $this->ary_identity;

		$this->load->view('template/header', $data);
		$this->load->view('factory/form', $data);
		$this->load->view('template/footer');
	}

	public function form_doEdit() {
		$this->load->model('Form_model');
		echo $this->Form_model->formFactory_doEdit();
	}

	public function form_done() {
		$data['title'] = '申請表單|募設計';

		$this->load->view('template/header', $data);
		$this->load->view('factory/form_done');
		$this->load->view('template/footer');
	}
}