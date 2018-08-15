<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			product.php
* Version:		-
* Last changed:	2018/07/05
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Product extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Product_model');

		$this->ary_is_prebuy = array(
			0 => '一般商品',
			1 => '預購商品'
		);

		$this->ary_currency = array(
			1 => 'NTD'
		);
	}

	public function delivery() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'delivery';

		$this->load->view('template/header',$data);
		$this->load->view('product/delivery', $data);
		$this->load->view('template/footer');
	}

	public function deliveryEdit($product_id) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'delivery';
		$data['ary_data'] = $this->Product_model->getProductById($product_id);

		$this->load->view('template/header',$data);
		$this->load->view('product/delivery_edit', $data);
		$this->load->view('template/footer');		
	}
	//-------------------------------------------------------------------------

	public function list() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'product';

		$this->load->view('template/header',$data);
		$this->load->view('product/list', $data);
		$this->load->view('template/footer');
	}

	public function edit($product_id=0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');
		$this->load->model('Store_model');
		$this->load->model('Spec_model');
		$this->load->model('Supplier_model');

		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'prodcut';

		$data['id'] = $product_id;
		$data['data'] = $this->Product_model->getProductById($product_id);
		$data['is_direct'] = $this->Store_model->getStoreById($_SESSION['sess_store_id']);
		$data['ary_category'] = $this->Product_model->getCategory();//平台商品分類
		$data['ary_category_son'] = $this->Product_model->getCategoryByParent(1); //預設第一筆
		$data['ary_is_prebuy'] = $this->ary_is_prebuy;
		$data['ary_supplier'] = $this->Supplier_model->get();
		$data['ary_brand'] = array(); //$this->Brand_Model->getAllByStore_id();
		if(is_NUll($data['data']['dt_start']) || is_NUll($data['data']['dt_end'])) {
			$data['data']['start_end_date'] = '';
		} else {
			$start = substr($data['data']['dt_start'], 0, -3);
			$end   = substr($data['data']['dt_end'], 0, -3);
			$data['data']['start_end_date'] = $start.' - '.$end;
		}
		$category_change = $this->Product_model->getCategoryById($data['data']['category_son_id']);
		$data['data']['category_id'] = $category_change['parent'];

		$data['ary_currency'] = $this->ary_currency;
		$data['ary_store_category'] = $this->Product_model->getCategory($_SESSION['sess_store_id']);//店鋪商品分類

		$ary_spec = $this->Spec_model->getSpecByProductId($_SESSION['sess_store_id']);
		$ary_spec[1] = '不分規格';
		ksort($ary_spec);
		$data['ary_spec'] = $ary_spec;
		$ary_ret_spec = $this->Product_model->getProductSpecByProductId($product_id);
		$ary_data_spec = array();
		if(count($ary_ret_spec) >0) {
			foreach ($ary_ret_spec as $key => $value) {
				$ary_data_spec[$value['id']]['id'] = $value['id'];
				$ary_data_spec[$value['id']]['spec_id'] = $value['spec_id'];
				$ary_data_spec[$value['id']]['quantity'] = $value['quantity'];
			}
		}
		$data['ary_data_spec'] = $ary_data_spec;

		$this->load->view('template/header',$data);
		$this->load->view('product/edit', $data);
		$this->load->view('template/footer');
	}

	public function addColorSizeRow() {
		$this->load->model('Spec_model');
		$ary_spec = $this->Spec_model->getSpecByProductId($_SESSION['sess_store_id']);
		$ary_spec[1] = '不分規格';
		ksort($ary_spec);
		$this->load->helper('form');

		$html =	'<div class="form-group">
					<div class="col-sm-4">
						'. form_dropdown("sel_spec[]", $ary_spec, "", "class='form-control'") .'
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="txt_quantity[]" value="" pattern="[0-9]+" required>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-5"></div>
				</div>';

		echo $html;
	}

	public function getUsersBySearch() {
		$this->load->helper('form');
		$this->load->model('Users_model');
		$ary = $this->Users_model->getUsersBySearch();

		echo form_dropdown('sel_search', $ary, 0, "id='sel_search' class='form-control' size='10'");
	}

	public function getCategorySonByCategoryId($parent) {
		$this->load->helper('form');
		$ary_category_son = $this->Product_model->getCategoryByParent($parent);

		echo form_dropdown('sel_category_son', $ary_category_son, '', 'class="form-control"');
	}

	public function doEdit($is_delivery) {
		$dt_start = substr($_POST['txt_start_end_date'], 0, 16);
		$dt_end   = substr($_POST['txt_start_end_date'], 19, 16);
		echo $this->Product_model->doEdit($is_delivery, $_SESSION['sess_store_id'], $dt_start, $dt_end);
	}

	public function getProductByStoreId($is_delivery) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$ary_data = $this->Product_model->getProductByStoreId($is_delivery, $_SESSION['sess_store_id']);
		if(count($ary_data) > 0) {
			foreach ($ary_data as $key => $val) {
				$ary_data[$key]['dt_start_end'] = $val['dt_start'].' ~ '.$val['dt_end'];
				$ary_product_spec = $this->Product_model->getProductSpecByProductId($val['id']);
				if(count($ary_product_spec) > 0) {
					$spec = '';
					foreach ($ary_product_spec as $value) {
						$spec .= $value['name'];
					}
				$ary_data[$key]['product_spec'] = $spec;
				}
			}
		}

		echo json_encode($ary_data);
	}

	public function brand() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'Store Backend・買設計';
		$data['path'] = 'brand';
		$data['data'] = $this->Product_model->getBrandByStoreId($_SESSION['sess_store_id']);

		$this->load->view('template/header',$data);
		$this->load->view('product/brand', $data);
		$this->load->view('template/footer');
	}

	public function getBrandByStoreId() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$ary_data = $this->Product_model->getBrandByStoreId($_SESSION['sess_store_id']);

		echo json_encode($ary_data);
	}

	public function brandDoEdit() {
		echo $this->Product_model->brandDoEdit($_SESSION['sess_store_id']);
	}

	public function brandDoDel($id) {
		echo $this->Product_model->brandDoDel($id);
	}
}