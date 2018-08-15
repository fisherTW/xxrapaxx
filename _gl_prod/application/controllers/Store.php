<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Store.php
* Version:		-
* Last changed:	2018/06/19
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Store extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('Store_model');
	}

	public function list($page=1) {
		$this->load->model('Favorite_model');
		$this->load->model('Product_model');

		$data['title'] = '店鋪推薦│買設計';
		$ary_data = $this->Store_model->getAll($page);
		if($ary_data > 0){
			foreach ($ary_data as $key => $val) {
				$ary_data[$key]['favorite_count'] = $this->Favorite_model->getProductTotalByStoreId($val['id'], SOURCE_STORE);
				$ary_data[$key]['product_count'] = $this->Product_model->getProductTotalByStoreId($val['id'], SOURCE_QGOODS);
				$ary_product = $this->Product_model->getProductPicByStoreId($val['id']);
				$ary_data[$key]['url_pic'] = array();
				if(count($ary_product) > 0) {
					$row = 0;
					foreach ($ary_product as $prod_key => $value) {
						$ary_data[$key]['url_pic'][$prod_key] = URL_GOOGLE_IMG.$value['url_pic'];
						$row ++;
					}
					if($row < 3) {
						for($i=$row; $i < 3 ; $i++) {
							$ary_data[$key]['url_pic'][$i] = base_url().'assets/img/no_image.png';
						}
					}
				} else {
					$ary_data[$key]['url_pic'][0] = base_url().'assets/img/no_image.png';
					$ary_data[$key]['url_pic'][1] = base_url().'assets/img/no_image.png';
					$ary_data[$key]['url_pic'][2] = base_url().'assets/img/no_image.png';
				}
			}
		}

		$data['ary_data'] = $ary_data;

		$count = $this->Store_model->getStoreCount();
		$pageCount = ceil($count/12);
		$str_ret = array();
		for ($i=1; $i<=$pageCount; $i++) {
			$str_ret[$i] = $i;
		}
		$data['StoreCount'] = $str_ret;
		$data['page'] = $page;

		$this->load->view('template/header',$data);
		$this->load->view('store/list', $data);
		$this->load->view('template/footer');
	}

	public function index($id) {
		$this->load->model('Product_model');
		$this->load->model('Member_model');

		$data['title'] = '店鋪│買設計';
		$data['info'] = $this->Store_model->getAvailableStoreById($id);

		if(count($data['info']) == 0) {
			show_404();
		}
				
		$data['total_product'] = $this->Product_model->getProductCountByStoreId($id);
		$data['id'] = $id;

		$ary_tmp = $this->Product_model->getProductByStoreId($id, 0, 0, 1);
		$data['count_total'] = $ary_tmp[0];
		$data['ary_product'] = $ary_tmp[1];
		$data['countBookmark'] = $this->Member_model->countBookmark(SOURCE_STORE, $id);

		if(isset($_SESSION['sess_user_id'])) {
			$data['isMyBookmark'] = $this->Member_model->isMyBookmark(SOURCE_STORE, $id);
		} else {
			$data['isMyBookmark'] = false;
		}	

		$this->load->view('template/header',$data);
		$this->load->view('store/index', $data);
		$this->load->view('template/footer');		
	}

	public function indexB($id) {
		$this->load->model('Product_model');
		$this->load->model('Member_model');
		$this->load->helper('form');

		$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
		$category_id_sub = isset($_GET['category_id_sub']) ? $_GET['category_id_sub'] : 0;
		$filter = isset($_GET['filter']) ? $_GET['filter'] : 1;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;

		$data['title'] = '店鋪│買設計';
		$data['info'] = $this->Store_model->getStoreById($id);
		$data['countBookmark'] = $this->Member_model->countBookmark(SOURCE_STORE, $id);

		if(isset($_SESSION['sess_user_id'])) {
			$data['isMyBookmark'] = $this->Member_model->isMyBookmark(SOURCE_STORE, $id);
		} else {
			$data['isMyBookmark'] = false;
		}	

		if($category_id_sub != 0) {
			$category_query = $category_id_sub;
		} else {
			$category_query = $category_id;
		}
		$ary_tmp = $this->Product_model->getProductByStoreId($id, $category_query, $filter, $page);
		$data['count_total'] = $ary_tmp[0];
		$data['ary_product'] = $ary_tmp[1];
		$data['total_product'] = $this->Product_model->getProductCountByStoreId($id);
		$data['id'] = $id;
		$data['page'] = $page;
		$data['filter'] = $filter;
		$data['category_id'] = $category_id;
		$data['category_id_sub'] = $category_id_sub;
		$ary_tmp = $this->Product_model->getCategory();
		$ary_tmp[0] = '大分類';
		ksort($ary_tmp);
		$data['ary_category'] = $ary_tmp;

		$this->load->view('template/header',$data);
		$this->load->view('store/index_b', $data);
		$this->load->view('template/footer');		
	}	

	public function indexC($id) {
		$this->load->model('Product_model');
		$this->load->model('Member_model');

		$data['title'] = '店鋪│買設計';
		$data['info'] = $this->Store_model->getStoreById($id);
		$data['id'] = $id;
		$data['total_product'] = $this->Product_model->getProductCountByStoreId($id);
		$data['countBookmark'] = $this->Member_model->countBookmark(SOURCE_STORE, $id);

		if(isset($_SESSION['sess_user_id'])) {
			$data['isMyBookmark'] = $this->Member_model->isMyBookmark(SOURCE_STORE, $id);
		} else {
			$data['isMyBookmark'] = false;
		}	
		
		$this->load->view('template/header',$data);
		$this->load->view('store/index_c', $data);
		$this->load->view('template/footer');		
	}

	public function apiGetCategory($parent, $sub) {
		$this->load->model('Product_model');
		$this->load->helper('form');

		if($parent != '0') {
			$ary_tmp = $this->Product_model->getCategory($parent);
		} else {
			$ary_tmp = array();
		}
		$ary_tmp[0] = '小分類';
		ksort($ary_tmp);

		$ary_ret = array(
			'hh'	=> form_dropdown('sel_category_sub', $ary_tmp, $sub, 'id="sel_category_sub"'),
			'count'	=> count($ary_tmp)
		);

		echo json_encode($ary_ret);
	}

}