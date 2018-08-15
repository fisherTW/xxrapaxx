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

	public function createInvoice($invoice_data) {

		foreach ($invoice_data as $key => $value) {

			list($usec, $x) = explode(' ', microtime());
			$str_MerchantOrderNo = date("ymdHis").substr(strval($usec * 1000000), 0, 6);

			$num_total = 0;
			$num_total_tax_free = 0;

			$num_total = $value['collection_amt'];
			$num_total_tax_free = round($num_total/(1.05));

			$post_data_array = array(
				"RespondType" => "JSON",
				"Version" => "1.4",
				"TimeStamp" => time(),
				"TransNum" => "",
				"MerchantOrderNo" => $str_MerchantOrderNo,
				"Status" => "1", //1=立即開立，0=待開立，3=延遲開立

				"Category"		=> 'B2C',

				"BuyerName"		=> $value['rec_name'], //"王大品",
				"BuyerUBN"		=> '', //"99112233",
				"BuyerEmail"	=> $value['rec_mail'], //"abc@gmail.com",
				"BuyerPhone"	=> $value['rec_mobile'], //"0955221144",

				"PrintFlag" => "Y",
				"TaxType" => "1",
				"TaxRate" => "5",
				"Amt" => $num_total_tax_free,	//"490",
				"TaxAmt" => ($num_total - $num_total_tax_free),	//"10",
				"TotalAmt" => $num_total, //"500",	//start
				"CarrierType" => "",
				"CarrierNum" => rawurlencode(""),
				"LoveCode" => "",

				"ItemName" => $value['descr'], //"商品一|商品二", //多項商品時，以「|」分開
				"ItemCount" => '1', //"1|2", //多項商品時，以「|」分開
				"ItemUnit" => '個', //"個|個", //多項商品時，以「|」分開
				"ItemPrice" => $num_total, //"300|100", //多項商品時，以「|」分開
				"ItemAmt" => $num_total, //"300|200", //多項商品時，以「|」分開

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
			$ary_details = json_decode($ary_res['Result'], true);
			
	
			$this->writeInvoiceLog($value['id'], $ary_res["Status"],$ary_details);
		}
		
	}

	public function writeInvoiceLog($id, $status, $ary_data) {
		$account = $this->load->database('account', TRUE);

		$ary_data = array(
			'invoice_status'		=> $status,
			'MerchantOrderNo'		=> $ary_data['MerchantOrderNo'],
			'InvoiceNumber'			=> $ary_data['InvoiceNumber'],
			'CreateTime'			=> $ary_data['CreateTime'],
			'is_send'				=> '1'
		);

		$account->set($ary_data);
		$account->where('id', $id);
		$account->update('mail_invoice');

	}
}