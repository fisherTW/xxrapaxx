<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Payment.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Payment extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
	}

	public function index() {
		if(!isset($_SESSION['sess_order_id'])) {
			redirect(base_url().'qmaker', 'refresh');
		}

		$this->load->model('Orders_model');
		$this->load->model('Trans_model');
		$this->load->model('Product_model');

		$Amt = $_SESSION['sess_order_amt'];
		$ary_order = $this->Orders_model->getOrder($_SESSION['sess_order_id']);
		$ary_build = array();
		$MerchantOrderNo = $this->Trans_model->add();

		// quantity
		$ary_order_store_product = $this->Orders_model->getOrderStoreProduct($_SESSION['sess_order_id']);
		for($i=0; $i < count($ary_order_store_product); $i++) {
			$this->Product_model->setQuantity(
				$ary_order_store_product[$i]['product_id'], 
				$ary_order_store_product[$i]['spec_id'], 
				$ary_order_store_product[$i]['quantity']);
		}

		$Email = $ary_order['rec_mail'];
		$data['Amt'] = $Amt;	//訂單金額
		$ary_build['Amt'] = $Amt;	//訂單金額
		$data['MerchantID'] = SPGATEWAY_MERCHANTID;
		$ary_build['MerchantID'] = SPGATEWAY_MERCHANTID;
		$data['MerchantOrderNo'] = $MerchantOrderNo;	//商店訂單編號(20)
		$ary_build['MerchantOrderNo'] = $MerchantOrderNo;	//商店訂單編號(20)
		$data['TimeStamp'] = time();
		$ary_build['TimeStamp'] = time();
		$data['Version'] = '1.2';
		$ary_build['Version'] = '1.2';
		$data['RespondType'] = 'JSON';
		$data['Amt'] = $Amt;	//訂單金額
		$data['ItemDesc'] = 'rapaq商品';	//商品資訊(50)
		$data['Email'] = $Email;
		$data['LoginType'] = 0;
		$data['CREDIT'] = 1;
		$data['InstFlag'] = '0';	//應要求拿掉
		$data['VACC'] = 0;	//應要求拿掉
		$data['CVS'] = 0;	//應要求拿掉
		$data['ReturnURL'] = base_url().'payment/postPaymentView';	// 前
		$data['NotifyURL'] = base_url().'payment/postPayment';		// 後
		$data['CheckValue'] = $this->bulidStr($ary_build);
		$data['info'] = '';

		foreach ($data as $key => $value) {
			$data['info'] .= "<input type='hidden' name='".$key."' value='".$value."'>";
		}

		$this->load->view('payment/spgateway',$data);
	}


	public function bulidStr($ary){
		$ret = 'HashKey='.SPGATEWAY_HASHKEY.'&'.http_build_query($ary).'&HashIV='.SPGATEWAY_HASHIV;
		$ret = strtoupper(hash('sha256', $ret));
		return $ret;
	}

	public function postPaymentView() {
		$ary_result = json_decode($_POST['JSONData'], true);
		$data['title'] = '結帳結果|RAPAQ';
		$data['ary_result'] = $ary_result;

		$this->load->view('template/header',$data);
		$this->load->view('payment/postPayment',$data);
		$this->load->view('template/footer',$data);

	}

	public function postPayment() {
		$this->load->model('Trans_model');

		$ary_result = json_decode($_POST['JSONData'], true);
		$this->Trans_model->updateStatus($ary_result);
		
	}
}