<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Product.php
* Version:		-
* Last changed:	2018/06/21
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Product extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('Product_model');

		$this->quantity = array(
			1 => '1',
			2 => '2',
			3 => '3',
			4 => '4',
			5 => '5',
			6 => '6',
			7 => '7',
			8 => '8',
			9 => '9',
			10 => '10'
		);		
	}

	public function index($id=-1) {
		if($id == -1) {
			show_404();
		}		
		$this->load->helper('form');

		$this->load->model('Comments_model');
		$this->load->model('Favorite_model');
		$this->load->model('Product_model');

		$data['info'] = $this->Product_model->getAvailableProductById($id);
		$data['title'] = $data['info']['product_name'];

		$data['og_title'] = $data['info']['name'];
		$data['og_description'] = $this->strip_tag_css_fisher($data['info']['detail']);
		$data['og_image'] = URL_GOOGLE_IMG.$data['info']['url_pic'];
		$data['og_url'] = base_url().'product/'.$id;

		if(count($data['info']) == 0) {
			show_404();
		}

		$this->redisZadd($id);

		$ary_ret = $this->Product_model->getProductspecById($id);
		$ary_spec_show_color = array();
		$ary_spec_show_size = array();
		$ary_spec = array();
		if(count($ary_ret) > 0) {
			$ary_spec[0] = '請選擇規格';			
			foreach ($ary_ret as $key => $val) {
				$ary_spec[$val['spec_id']] = $val['name'];
				$ary_spec_show_color[$val['color']] = $val['color'];
				$ary_spec_show_size[$val['size']] = $val['size'];
			}
		}
		$data['ary_spec']				= $ary_spec;
		$data['ary_spec_show_color']	= $ary_spec_show_color;
		$data['ary_spec_show_size']		= $ary_spec_show_size;

		if(isset($_SESSION['sess_user_id'])) {
			$this->load->model('Member_model');
			$data['isMyBookmark_product'] = $this->Member_model->isMyBookmark(SOURCE_PRODUCT, $id);
			$data['isMyBookmark_store'] = $this->Member_model->isMyBookmark(SOURCE_STORE, $data['info']['store_id']);
		} else {
			$data['isMyBookmark_product'] = false;
			$data['isMyBookmark_store'] = false;
		}

		$data['ary_quantity'] = $this->quantity;

		$data['discount'] = 0;
		$data['comments'] = $this->Comments_model->get(SOURCE_QGOODS, $id);
		$data['store_favorite_count'] = $this->Favorite_model->getProductTotalByStoreId($id, SOURCE_STORE);
		$data['store_product_count'] = $this->Product_model->getProductTotalByStoreId($id, SOURCE_QGOODS);

		$this->load->view('template/header',$data);
		$this->load->view('product/index', $data);
		$this->load->view('template/footer');
	}

	public function list() {
		$this->load->helper('form');

		$data['title'] = '好物分類│買設計';

		$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
		$category_id_sub = isset($_GET['category_id_sub']) ? $_GET['category_id_sub'] : 0;
		$filter = isset($_GET['filter']) ? $_GET['filter'] : 1;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;

		if($category_id_sub != 0) {
			$category_query = $category_id_sub;
		} else {
			$category_query = $category_id;
		}
		$ary_tmp = $this->Product_model->getProduct($category_query, $filter, $page);
		$data['count_total'] = $ary_tmp[0];
		$data['ary_product'] = $ary_tmp[1];
		$data['total_product'] = $this->Product_model->getProductCount();

		$data['page'] = $page;
		$data['filter'] = $filter;
		$data['category_id'] = $category_id;
		$data['category_id_sub'] = $category_id_sub;
		$ary_tmp = $this->Product_model->getCategory();
		$ary_tmp[0] = '大分類';
		ksort($ary_tmp);
		$data['ary_category'] = $ary_tmp;


		$this->load->view('template/header',$data);
		$this->load->view('product/list', $data);
		$this->load->view('template/footer');
	}


}