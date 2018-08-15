<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $project_lastUpdateId = 0;
	public $project_name = '';

	public function __construct() {
		parent::__construct();
	}

	public function curl_work($url = "", $parameter = "") {
		$curl_options = array(
		CURLOPT_URL => $url,
		CURLOPT_HEADER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_USERAGENT => "Google Bot",
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_SSL_VERIFYHOST => FALSE,
		CURLOPT_POST => "1",
		CURLOPT_POSTFIELDS => $parameter
		);
		$ch = curl_init();
		curl_setopt_array($ch, $curl_options);
		$result = curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_error = curl_errno($ch);
		curl_close($ch);
		$return_info = array(
			"url" => $url,
			"sent_parameter" => $parameter,
			"http_status" => $retcode,
			"curl_error_no" => $curl_error,
			"web_info" => $result
		);
		return $return_info;
	}

	public function createInvoice($order_id, $store_id) {
		$this->load->model('Orders_model');


		list($usec, $x) = explode(' ', microtime());
		$str_MerchantOrderNo = date("ymdHis").substr(strval($usec * 1000000), 0, 6);

		$num_total = 0;
		$num_total_tax_free = 0;

		$ary_log = array();
		$ary_ItemName = array();
		$ary_ItemCount = array();
		$ary_ItemPrice = array();
		$ary_ItemAmt = array();
		$ary_ItemUnit = array();

		$ary_log['order_id'] = $order_id;
		$ary_log['store_id'] = $store_id;
		$ary_log['trans_id'] = $str_MerchantOrderNo;

		$ary_order = $this->Orders_model->getOrderMainById($order_id);
		$ary_order_store = $this->Orders_model->getOrderStoreById($order_id, $store_id);
		$ary_order_store_product = $this->Orders_model->getOrderStoreProductById($order_id, $store_id);

		for ($i=0; $i < count($ary_order_store_product); $i++) { 
			$ary_order_store_product[$i]['quantity'];
			array_push($ary_ItemName, $ary_order_store_product[$i]['pd_name']);
			array_push($ary_ItemCount, $ary_order_store_product[$i]['quantity']);
			array_push($ary_ItemPrice, $ary_order_store_product[$i]['price_deal']);
			array_push($ary_ItemAmt, ($ary_order_store_product[$i]['price_deal']*$ary_order_store_product[$i]['quantity']));
			array_push($ary_ItemUnit, '個');
		}

		$num_total = array_sum($ary_ItemAmt);
		$num_total_tax_free = round($num_total/(1.05));
		$str_Category = strlen($ary_order['invoice_c_name']) > 0 ? 'B2B' : 'B2C';

		$post_data_array = array(
			"RespondType" => "JSON",
			"Version" => "1.4",
			"TimeStamp" => time(),
			"TransNum" => "",
			"MerchantOrderNo" => $str_MerchantOrderNo,
			"Status" => "3", //1=立即開立，0=待開立，3=延遲開立
			"CreateStatusTime"	=> date('Y-m-d', strtotime(date("Y-m-d"). ' + 7 day')),

			"Category"		=> $str_Category,

			"BuyerName"		=> strlen($ary_order['invoice_c_name']) > 0 ? $ary_order['invoice_c_name'] : '-', //"王大品",
			"BuyerUBN"		=> $ary_order['invoice_c_no'], //"99112233",
			"BuyerAddress"	=> $ary_order_store['rec_addr'], //"台北市南港區南港路一段 99 號",
			"BuyerEmail"	=> $ary_order_store['rec_mail'], //"abc@gmail.com",
			"BuyerPhone"	=> $ary_order_store['rec_phone'], //"0955221144",

			"PrintFlag" => "Y",
			"TaxType" => "1",
			"TaxRate" => "5",
			"Amt" => $num_total_tax_free,	//"490",
			"TaxAmt" => ($num_total - $num_total_tax_free),	//"10",
			"TotalAmt" => $num_total, //"500",	//start
			"CarrierType" => "",
			"CarrierNum" => rawurlencode(""),
			"LoveCode" => "",

			"ItemName" => implode('|', $ary_ItemName), //"商品一|商品二", //多項商品時，以「|」分開
			"ItemCount" => implode('|', $ary_ItemCount), //"1|2", //多項商品時，以「|」分開
			"ItemUnit" => implode('|', $ary_ItemUnit), //"個|個", //多項商品時，以「|」分開
			"ItemPrice" => implode('|', $ary_ItemPrice), //"300|100", //多項商品時，以「|」分開
			"ItemAmt" => implode('|', $ary_ItemAmt), //"300|200", //多項商品時，以「|」分開

			"Comment" => "TEST，備註說明",
			"NotifyEmail" => "1", //1=通知，0=不通知
		);

		$post_data_str = http_build_query($post_data_array);
		$key = PAY2GO_HASHKEY;
		$iv = PAY2GO_HASHIV;


		$str_padded = $post_data_str;
		if (strlen($str_padded) % 16) {
			$str_padded = str_pad($str_padded,strlen($str_padded) + 16 - strlen($str_padded) % 16, "\0");
		}

		$post_data = trim(bin2hex(openssl_encrypt($str_padded,'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv))); //加密	

		$url = PAY2GO_URL;
		$MerchantID = PAY2GO_MERCHANTID; //商店代號
		$transaction_data_array = array( //送出欄位
			"MerchantID_" =>$MerchantID,
			"PostData_" => $post_data
		);
		$transaction_data_str = http_build_query($transaction_data_array);
		$result = $this->curl_work($url, $transaction_data_str); //背景送出

		$ary_res = json_decode($result['web_info'], true);

		if($ary_res['Status'] == 'SUCCESS') {
			$ary_log['res'] = '預開7日 SUCCESS';
		} else {
			$ary_log['res'] = '預開7日 FAIL';
		}

		$this->writeInvoiceLog($ary_log);
	}

	public function writeInvoiceLog($ary_data) {
		$ary_data['dt_create'] = date('Y-m-d H:i:s');

		$this->db->set($ary_data);
		$this->db->insert('log_invoice');
	}

}