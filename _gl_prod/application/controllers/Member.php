<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Member.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Member extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('Member_model');

		$this->ary_gender = array(
			1 => '男',
			2 => '女'
		);
	}

	public function login() {
		$data = array();

		$this->load->view('login',$data);
	}

	public function logout() {
		$data = array();

		$this->load->view('logout',$data);
	}	

	public function doReg() {
		if($this->Member_model->checkDuplicate() !== false) {
			echo 0;
			exit();
		} else {
			echo $this->Member_model->doReg();
		}
	}

	public function doLogin() {
		list($res, $id) = $this->Member_model->doLogin();

		$_SESSION['sess_user_id'] = ($res == '1') ? $id : null;
		
		echo $res;
	}

	public function doLogout() {
		$this->session->sess_destroy();
		redirect(base_url().'member/logout', 'refresh');		
	}

	public function main() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'member/login?back='.base_url(), 'refresh');
		}		
		$data['info'] = $this->Member_model->getMemberById($_SESSION['sess_user_id']);

		$data['title'] = '會員中心│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/main');
		$this->load->view('template/footer');
	}

	public function order() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'member/login?back='.base_url(), 'refresh');
		}

		$this->load->model('Orders_model');

		$ary_data = $this->Orders_model->getOrderByUserid($_SESSION['sess_user_id']);
		if(count($ary_data) >0 ) {
			foreach ($ary_data as $key => $val) {
				$ary_data[$key]['amt'] = $this->Orders_model->getOrderAmt($val['order_id']);
				$ary_payment_status = json_decode(JSON_PAYMENT_STATUS, true);
				$ary_data[$key]['status_payment_name'] = $ary_payment_status[$val['status_payment']];
			}
		} else {
			$ary_data = array();
		}

		$data['ary_data'] = $ary_data;

		$data['title'] = '訂單查詢│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/order');
		$this->load->view('template/footer');
	}

	public function orderDetail($order_id = 0) {

		$this->load->model('Orders_model');

		$ary_info = array();
		$ary_tmp = $this->Orders_model->getOrderStoreProduct($order_id);
		if(count($ary_tmp) > 0) {
			$status_payment = $ary_tmp[0]['status_payment'];
			$data['data']['dt_create'] = $ary_tmp[0]['dt_create'];
			$data['data']['orders_invoice_c_no'] = $ary_tmp[0]['orders_invoice_c_no'];
			$data['data']['orders_invoice_c_name'] = $ary_tmp[0]['orders_invoice_c_name'];		
			$data['data']['rec_name'] = $ary_tmp[0]['rec_name'];
			$data['data']['rec_phone'] = $ary_tmp[0]['rec_phone'];
			$data['data']['rec_zip'] = $ary_tmp[0]['rec_zip'];
			$data['data']['rec_addr'] = $ary_tmp[0]['rec_addr'];

			foreach ($ary_tmp as $key => $value) {
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
				$ary_info[$value['store_id']]['prod'][] = $value;
				$ary_info[$value['store_id']]['store_id'] = $value['store_id'];				
				$ary_info[$value['store_id']]['order_store_amt'] = $this->Orders_model->getOrderStoreAmt($value['order_id'], $value['store_id']);

				$ary_order_store =  $this->Orders_model->getOrderStoreInfoByOrderId($value['order_id']);
				$ary_info[$value['store_id']]['order_store_rec_name'] = $ary_order_store['rec_name'];
				$ary_info[$value['store_id']]['order_store_rec_phone'] =  $ary_order_store['rec_phone'];
				$ary_info[$value['store_id']]['order_store_rec_mail'] =  $ary_order_store['rec_mail'];
				$ary_info[$value['store_id']]['order_store_rec_zip'] =  $ary_order_store['rec_zip'];
				$ary_info[$value['store_id']]['order_store_rec_addr'] =  $ary_order_store['rec_addr'];
				$ary_info[$value['store_id']]['order_store_descr'] =  $ary_order_store['descr'];
				$ary_info[$value['store_id']]['order_store_ary'] = $this->Orders_model->getOrderStore($value['order_id'], $value['store_id']);
			}

			switch ($status_payment) {
				case '0':
					$status_payment_name = '訂單成立';
					break;
				case '1':
					$status_payment_name = '交易成立';
					break;
				case '2':
					$status_payment_name = '交易成功';
					break;
				case '3':
					$status_payment_name = '交易失敗';
					break;
				case '4':
					$status_payment_name = '交易逾期';
					break;
			}
			$data['data']['status_payment'] = $status_payment;
			$data['data']['status_payment_name'] = $status_payment_name;
			$data['data']['amt'] = $this->Orders_model->getOrderAmt($order_id);	
		} else {
			$data['data']['dt_create'] = '';
			$data['data']['orders_invoice_c_no'] = '';
			$data['data']['orders_invoice_c_name'] = '';
			$data['data']['order_store_rec_name'] = '';
			$data['data']['order_store_rec_phone'] = '';
			$data['data']['order_store_rec_zip'] = '';
			$data['data']['order_store_rec_addr'] = '';

			$data['data']['status_payment_name'] = '';
			$data['data']['amt'] = 0;
		}
//var_dump($ary_info);

		$data['data']['order_id']= $order_id;
		$data['ary_data'] = $ary_info;

		$data['title'] = '訂單查詢│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/orderDetail', $data);
		$this->load->view('template/footer');
	}

	public function orderReject() {
		$data['title'] = '申請退貨│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/orderReject');
		$this->load->view('template/footer');
	}

	public function orderBank() {
		$data['title'] = '退款帳號│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/orderBank');
		$this->load->view('template/footer');
	}

	public function bookmarkProduct() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'member/login?back='.base_url(), 'refresh');
		}		
		$data['title'] = '收藏商品│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/bookmarkProduct');
		$this->load->view('template/footer');
	}

	public function bookmarkStore() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'member/login?back='.base_url(), 'refresh');
		}		
		$data['title'] = '收藏計畫/店鋪│RapaQ';
		$data['info'] = $this->Member_model->getMyBookmark(SOURCE_PROJECT);
		$data['info_store'] = $this->Member_model->getMyBookmark(SOURCE_STORE);
		$data['info_product'] = $this->Member_model->getMyBookmark(SOURCE_PRODUCT);
		if(count($data['info']) > 0) {
			$this->load->model('Product_model');
			foreach ($data['info'] as $key => $value) {
				$data['info'][$key]['product'] = $this->Product_model->getProductByProjectId($value['id'], SOURCE_QMAKER);
			}
		}
		$this->load->view('template/header',$data);
		$this->load->view('member/bookmarkStore');
		$this->load->view('template/footer');
	}

	public function currency() {
		$data['title'] = 'Q幣│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/currency');
		$this->load->view('template/footer');
	}

	public function coupon() {
		$data['title'] = '折價券│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/coupon');
		$this->load->view('template/footer');
	}

	public function addressBook() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'member/login?back='.base_url(), 'refresh');
		}		
		$data['title'] = '常用收件│RapaQ';
		$data['info'] = $this->Member_model->getMyAddressBook();

		$this->load->view('template/header',$data);
		$this->load->view('member/addressBook');
		$this->load->view('template/footer');
	}

	public function addressBookEdit($id = 0) {
		$data['title'] = '常用收件│RapaQ';
		$id = $this->isMyaddressBook($id) ? $id : 0;
		$data['info'] = $this->Member_model->getAddressBookById($id);

		$this->load->view('template/header',$data);
		$this->load->view('member/addressBookEdit');
		$this->load->view('template/footer');
	}

	public function addressBookDoEdit() {
		echo $this->Member_model->addressBookCU();		
	}

	public function addressBookDoDel() {
		echo $this->Member_model->addressBookD();		
	}

	public function isMyaddressBook($id) {
		return $this->Member_model->isMyaddressBook($id);
	}


	public function profileEdit() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'member/login?back='.base_url(), 'refresh');
		}
		$this->load->helper('form');
		$data['info'] = $this->Member_model->getMemberById($_SESSION['sess_user_id']);

		$data['title'] = '個人資料編輯│RapaQ';
		$data['ary_gender'] =  $this->ary_gender;

		$this->load->view('template/header',$data);
		$this->load->view('member/profileEdit');
		$this->load->view('template/footer');
	}

	public function profileEdit_doEdit() {
		echo $this->Member_model->profileEdit_doEdit();		
	}

	public function favoriteDoCreate() {
		$this->load->model('Favorite_model');
		$repeat = $this->Favorite_model->checkFavoriteId($_POST['source'], $_POST['content_id']);
		if($repeat == 0) {
			echo $this->Favorite_model->doCreate($_POST['source'], $_POST['content_id']);
		} else {
			echo $this->Favorite_model->doDel($_POST['source'], $_POST['content_id']);
		}
	}

	public function forgetPassword() {
		$data['title'] = '忘記密碼│RapaQ';

		$this->load->view('template/header',$data);
		$this->load->view('member/forgetPassword');
		$this->load->view('template/footer');		
	}

	public function doForgetPassword() {
		$tmp = $this->Member_model->checkDuplicateLocal();
		if($tmp != false) {
			$token = base64_encode('fisher'.$this->input->post('txt_mail').'haha');
			$this->sendMailFgtPwd($this->input->post('txt_mail'), $token);
		}
	}

	public function forgetPasswordCallback() {
		if(!isset($_GET['token']) || !isset($_GET['mail']) ) {
			return false;
		}
		if($this->input->get('token') != base64_encode('fisher'.$this->input->get('mail').'haha')) {
			return false;
		}

		$data['title'] = '重設密碼│RapaQ';
		$data['mail'] = $this->input->get('mail');

		$this->load->view('template/header',$data);
		$this->load->view('member/forgetPasswordCallback');
		$this->load->view('template/footer');		
	}

	public function resetPassword() {
		echo $this->Member_model->resetPassword();
	}

	public function doRefund() {
		$this->load->model('Orders_model');
		echo $this->Orders_model->doRefund();
	}
}

