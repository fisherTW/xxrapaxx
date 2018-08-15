<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Checkout.php
* Version:		-
* Last changed:	2018/04/27
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Checkout extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');

	}

	public function list() {
		if(!isset($_SESSION['sess_user_id'])) {
			echo '<script type="text/javascript">alert("請先登入!");</script>';
			redirect(base_url().'qmaker', 'refresh');
		}

		$this->load->helper('form');
		$this->load->model('Cart_model');
		$this->load->model('Member_model');
		$this->load->model('Product_model');
	
		$data['title'] = '結帳頁|RAPAQ';
		$data['ary_delivery'] = array();
		if(isset($_SESSION['sess_user_id'])) {
			$ary_data = $this->Cart_model->getCartInfo($_SESSION['sess_user_id']);
			$data['ary_cart'] = $this->Cart_model->getCheckoutListByCart($ary_data);

			$ary_ret = $this->Member_model->getMyAddressBook();
			if(count($ary_ret) == 0) {
				$ary_ret[-1]["id"] = '0';
				$ary_ret[-1]["name"] = '無常用地址';
				$ary_ret[-1]["user_id"] = $_SESSION['sess_user_id'];				
				$ary_ret[-1]["rec_addr"] = '';
				$ary_ret[-1]["rec_name"] = '';
				$ary_ret[-1]["rec_phone"] = '';
				$ary_ret[-1]["zip"] = '';
				$ary_ret[-1]["dt_update"] = '';
			} else {
				$ary_ret[-1]["id"] = '0';
				$ary_ret[-1]["name"] = '未選擇';
				$ary_ret[-1]["user_id"] = $_SESSION['sess_user_id'];
				$ary_ret[-1]["rec_addr"] = '';
				$ary_ret[-1]["rec_name"] = '';
				$ary_ret[-1]["rec_phone"] = '';
				$ary_ret[-1]["zip"] = '';
				$ary_ret[-1]["dt_update"] = '';
			}
		} else { //記session值
			if(isset($_SESSION['sess_cart'])) {
				$cart_ret = $this->Cart_model->getCheckoutListByCart(json_decode($_SESSION['sess_cart'], true));
			} else {
				$data['ary_cart'] = array();
			}
			$ary_ret[-1]["id"] = '0';
			$ary_ret[-1]["name"] = '無常用地址';
			$ary_ret[-1]["user_id"] = $_SESSION['sess_user_id'];
			$ary_ret[-1]["rec_addr"] = '';
			$ary_ret[-1]["rec_name"] = '';
			$ary_ret[-1]["rec_phone"] = '';
			$ary_ret[-1]["zip"] = '';
			$ary_ret[-1]["dt_update"] = '';				
		}
		ksort($ary_ret);

		if(count($data['ary_cart']) > 0) {
			foreach ($data['ary_cart'] as $store_id => $ary_product) {
				$ary_delivery = $this->Product_model->getDeliveryProductByStoreId($store_id, $ary_product[key($ary_product)]['source']);
				$data['ary_cart'][$store_id][$ary_delivery[0]['id']] = array(
					"store_id" => $store_id,
					"store_name" => "",
					"brand_logo" => "",
					"product_id" => $ary_delivery[0]['id'],
					"product_name" => $ary_delivery[0]['name'],
					"product_pic" => "new-qmaker/20180522135740631214.jpg",
					"spec_id" => 1,
					"spec_name" => "",
					"price_deal" => $ary_delivery[0]['price_deal'],
					"quantity" => 1,
					"source" => $ary_product[key($ary_product)]['source'],
					"is_delivery" => 1
				);
				if(count($ary_delivery) > 0 ) {
					foreach ($ary_delivery as $val) {
						$data['ary_delivery'][$store_id][$val['id']] = array(
							"id"		=> $val['id'],
							"name"		=> $val['name'],
							"price_deal"=> $val['price_deal']
						);
					}
				}
			}
		}
		$data['json_delivery'] = json_encode($data['ary_delivery']);
		$data['ary_addr'] = $ary_ret;

		$this->load->view('template/header',$data);
		$this->load->view('checkout/list', $data);
/*		if(count($data['ary_cart']) == 0) {
			$this->load->view('template/footer');
		}*/
	}

	public function list_doEdit() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'qmaker', 'refresh');
		}

		$this->load->model('Orders_model');
		list($order_id, $ret_data) = $this->Orders_model->orders_doEdit($_SESSION['sess_user_id']);

		if($ret_data) {
			$_SESSION['sess_order_id'] = $order_id;
			$this->sendMail($order_id);
			echo 1;
		} else {
			echo 0;
		}
	}

	public function payMethod() {
		if(!isset($_SESSION['sess_order_id'])) {
			redirect(base_url().'qmaker', 'refresh');
		}

		$this->load->model('Orders_model');

		$data['title'] = '結帳頁 II|RAPAQ';

		$total = $this->Orders_model->getOrderAmt($_SESSION['sess_order_id']);
		$_SESSION['sess_order_amt'] =$total;
		$data['total'] = $total;

		$this->load->view('template/header', $data);
		$this->load->view('checkout/payMethod', $data);
	}

	public function orderUpdateInvoice() {
		$this->load->model('Orders_model');
		echo $this->Orders_model->orderUpdateInvoice($_SESSION['sess_order_id']);		
	}

	public function confirm() {
/*		$_SESSION['sess_order_id'] = '20180525000000007701';
		$_SESSION['sess_order_amt'] = '5566';

*/		if(!isset($_SESSION['sess_order_id'])) {
			redirect(base_url().'qmaker', 'refresh');
		}

		$ary_info = array();

		$this->load->model('Orders_model');
		$ary_tmp = $this->Orders_model->getOrderStoreProduct($_SESSION['sess_order_id']);
		if(count($ary_tmp) > 0) {
			foreach ($ary_tmp as $key => $value) {
				$ary_info[$value['store_id']]['prod'][] = $value;
				if($value['source'] == SOURCE_QGOODS) {
					$this->load->model('Store_model');
					$ary_data = $this->Store_model->getStoreById($value['store_id']);
					$name = $ary_data['name'];
					$logo = $ary_data['pic_logo'];
				} else {
					$this->load->model('Project_model');
					$ary_data = $this->Project_model->getProjectById($value['store_id']);
					$name = $ary_data['name'];
					$logo = $ary_data['pic_cover'];
				}
				$ary_info[$value['store_id']]['name'] = $name;
				$ary_info[$value['store_id']]['brand_logo'] = $logo;
				$orders_invoice_c_no = $value['orders_invoice_c_no'];
				$orders_invoice_c_name = $value['orders_invoice_c_name'];

				$ary_order_store =  $this->Orders_model->getOrderStoreInfoByOrderId($value['order_id']);
				$ary_info[$value['store_id']]['order_store_rec_name'] = $ary_order_store['rec_name'];
				$ary_info[$value['store_id']]['order_store_rec_phone'] =  $ary_order_store['rec_phone'];
				$ary_info[$value['store_id']]['order_store_rec_mail'] =  $ary_order_store['rec_mail'];
				$ary_info[$value['store_id']]['order_store_rec_zip'] =  $ary_order_store['rec_zip'];
				$ary_info[$value['store_id']]['order_store_rec_addr'] =  $ary_order_store['rec_addr'];
				$ary_info[$value['store_id']]['order_store_descr'] =  $ary_order_store['descr'];
			}
		}

		$data['info'] = $ary_info;
		$data['data']['orders_invoice_c_no'] = $orders_invoice_c_no;
		$data['data']['orders_invoice_c_name'] = $orders_invoice_c_name;
		
		$data['title'] = '結帳頁 III|RAPAQ';

		$this->load->view('template/header', $data);
		$this->load->view('checkout/confirm', $data);
	}

	public function success() {
		if(!isset($_SESSION['sess_order_id'])) {
			redirect(base_url().'qmaker', 'refresh');
		}

		$data['title'] = '付款成功|募設計';

		$this->load->view('template/header', $data);
		$this->load->view('checkout/success');
		$this->load->view('template/footer');
	}
}