<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Search.php
* Version:		-
* Last changed:	2018/05/10
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Search extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function list() {
		$word = isset($_GET['word']) ? $_GET['word']: '';
		$page = isset($_GET['page']) ? $_GET['page']: 1;
		$type = isset($_GET['type']) ? $_GET['type']: 1;

		$this->load->model('Project_model');
		$this->load->model('Product_model');
		$this->load->model('Store_model');
		
		$data['title'] = '搜尋│RapaQ';

		$data['count_project']	= count($this->Project_model->searchProject($word));
		$data['count_product']	= count($this->Product_model->search($word));
		$data['count_store']	= count($this->Store_model->search($word));

		switch ($type) {
			case 1:
			default:
				$data['ary_search'] = $this->Project_model->searchProject($word, $page);
				$count_nowType = $data['count_project'];
				break;
			case 2:
				$data['ary_search'] = $this->Product_model->search($word, $page);
				$count_nowType = $data['count_product'];
				break;
			case 3:
				$data['ary_search'] = $this->Store_model->search($word, $page);
				$count_nowType = $data['count_store'];
				break;
		}

		$countPage = ceil($count_nowType/12);
		$str_ret = array();
		for ($i=1; $i<=$countPage; $i++) {
			$str_ret[$i] = $i;
		}
		$data['pageCount'] = $str_ret;

		$data['page'] = $page;
		$data['type'] = $type;
		$data['word'] = $word;

		$data['totalCount'] = $data['count_project'] + $data['count_product'] + $data['count_store'];
		$this->load->view('template/header',$data);
		$this->load->view('search/list', $data);
		$this->load->view('template/footer');
	}
}