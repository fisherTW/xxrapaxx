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
class Member extends CI_Controller {

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
		$data['info'] = $this->Member_model->getMemberById('2');

		$data['title'] = '會員個人頁│Q’Goods・好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/main');
		$this->load->view('template/footer');
	}

	public function order() {
		$data['title'] = '訂單查詢│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/order');
		$this->load->view('template/footer');
	}

	public function orderDetail() {
		$data['title'] = '訂單查詢│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/orderDetail');
		$this->load->view('template/footer');
	}

	public function orderReject() {
		$data['title'] = '申請退貨│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/orderReject');
		$this->load->view('template/footer');
	}

	public function orderBank() {
		$data['title'] = '退款帳號│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/orderBank');
		$this->load->view('template/footer');
	}

	public function bookmarkProduct() {
		$data['title'] = '收藏商品│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/bookmarkProduct');
		$this->load->view('template/footer');
	}

	public function bookmarkStore() {
		$data['title'] = '收藏店鋪│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/bookmarkStore');
		$this->load->view('template/footer');
	}

	public function currency() {
		$data['title'] = 'Q幣│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/currency');
		$this->load->view('template/footer');
	}

	public function coupon() {
		$data['title'] = '折價券│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/coupon');
		$this->load->view('template/footer');
	}

	public function addressBook() {
		$data['title'] = '常用收件│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/addressBook');
		$this->load->view('template/footer');
	}

	public function addressBookEdit() {
		$data['title'] = '常用收件│RapaQ 好物';

		$this->load->view('template/header',$data);
		$this->load->view('member/addressBookEdit');
		$this->load->view('template/footer');
	}

	public function profileEdit() {
		$this->load->helper('form');
		$data['info'] = $this->Member_model->getMemberById('2');

		$data['title'] = '個人資料編輯│RapaQ';
		$data['ary_gender'] =  $this->ary_gender;

		$this->load->view('template/header',$data);
		$this->load->view('member/profileEdit');
		$this->load->view('template/footer');
	}

	public function profileEdit_doEdit() {
		echo $this->Member_model->profileEdit_doEdit();		
	}
}

