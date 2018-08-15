<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Qgoods.php
* Version:		-
* Last changed:	2018/06/19
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Qgoods extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
	}

	public function index() {
		$this->load->model('Theme_model');
		$this->load->model('Product_model');
		$this->load->model('Qgoods_model');
		$this->load->model('Store_model');

		$ary_hot = $this->redisSort(20);

		$data['title'] = '買設計';
		$data['ary_theme'] = $this->Theme_model->getIndex();
		$ary_tmp = $this->Product_model->getSeesee();
		for($i=0; $i < count($ary_tmp); $i++) {
			$ary_tmp[$i]['detail'] = $this->strip_tag_css_fisher($ary_tmp[$i]['detail']);
		}
		$data['ary_seesee'] = $ary_tmp;
		$data['ary_banner'] = $this->Qgoods_model->getBanner();
		$data['ary_new'] = $this->Product_model->getNew();
		$data['ary_hot'] = $this->Product_model->getHot($ary_hot);
		$data['ary_rm_store'] = $this->Store_model->getRecommendStore();

		$this->load->view('template/header',$data);
		$this->load->view('qgoods/index', $data);
		$this->load->view('template/footer');
	}

}