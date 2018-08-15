<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Category.php
* Version:		-
* Last changed:	2018/07/13
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		myqgood
*/
class Category extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Category_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'category';

		$this->load->view('template/header',$data);
		$this->load->view('category/index', $data);
		$this->load->view('template/footer');
	}

	public function getCategory() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$category =  $this->Category_model->getCategory();

		foreach ($category as $key => $value) {
			if ($value['parent'] == 0) {
				$category[$key]['parent_name'] = '根目錄';
			} else {
				$category_name = $this->Category_model->getCategoryRoot($value['parent']);

				$category[$key]['parent_name'] = $category_name[0]['name'];
			}
		}
		echo json_encode($category);
	}

	public function edit($category_id = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'category';

		$data['info'] = $this->Category_model->get($category_id);
		$data['id'] = $category_id;

		$data['edit'] = 0;
		if ($category_id != 0 && $data['info'][0]['parent'] == 0) {
		 	$cgy = $this->Category_model->getCategoryData($category_id);
			$pdt = $this->Category_model->getCategoryProduct($category_id);
		 	if (!empty($cgy) || !empty($pdt)) {
		 		$data['edit'] = 1;
		 	}
		 } 

		$data['category'] = $this->Category_model->getCategoryAry();

 		foreach ($data['category'] as $key => $value) {$category['name'][$value['id']]= $value['name'];};
		$category['name'][0] = '(根目錄)';
		ksort($category['name']);

		$data['ary_category'] = $category['name'];

		$this->load->view('template/header',$data);
		$this->load->view('category/edit', $data);
		$this->load->view('template/footer');		
	}

	public function doEdit() {
		$this->Category_model->doEditCategory();
	}

	public function doDelete() {

		$category = $this->Category_model->get($_POST['id']);

		$category_root = $category[0]['parent'];

		if ($category_root != 0) {
			$pdt = $this->Category_model->getCategoryProduct($_POST['id']);

			if (!empty($pdt)) {
				$pdt_num = count($pdt);
				echo '分類下尚有 '.$pdt_num.' 筆商品';
			} else {
				$this->Category_model->doDelCategory();	
				echo '刪除成功';	
			}

		} else {
			$cgy = $this->Category_model->getCategoryData($_POST['id']);
			$pdt = $this->Category_model->getCategoryProduct($_POST['id']);

			if (!empty($cgy) || !empty($pdt)) {
				$cgy_num = count($cgy);
				$pdt_num = count($pdt);
				echo '目錄下尚有 '.$cgy_num.' 筆分類或 '.$pdt_num.' 筆商品' ;
			} else {
				$this->Category_model->doDelCategory();	
				echo '刪除成功';	
			}
		}
	}
		
}