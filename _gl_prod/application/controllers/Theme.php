<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Themegood.php
* Version:		-
* Last changed:	2018/06/15
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Theme extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$this->load->model('Theme_model');
	}

	public function index($link) {
		$data['title'] = '主題好物│買設計';
		$ary_info = $this->Theme_model->getThemeByLink($link);
		$data['og_title'] = $ary_info['name'];
		$data['og_description'] = $ary_info['product_title'];
		$data['og_image'] = URL_GOOGLE_IMG.$ary_info['pic_cover'];
		$data['og_url'] = base_url().'theme/view/'.$ary_info['link'];

		
		$data['info'] = $ary_info;

		if(count($data['info']) == 0) {
			show_404();
		}

		$data['ary_product'] = $this->Theme_model->getMTPById($ary_info['id']);

		$this->load->view('template/header',$data);
		$this->load->view('theme/index', $data);
		$this->load->view('template/footer');
	}

	public function list() {
		$data['title'] = '主題好物│買設計';
		$data['ary_theme'] = $this->Theme_model->get();

		$this->load->view('template/header',$data);
		$this->load->view('theme/list', $data);
		$this->load->view('template/footer');
	}
}