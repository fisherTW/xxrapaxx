<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $project_lastUpdateId = 0;
	public $project_name = '';

	public function __construct() {
		parent::__construct();
	}

	public function strip_tag_css_fisher($text){
		$text = strip_tags($text,"<style>");
		mb_regex_encoding('UTF-8');
		$text = mb_eregi_replace("(<style)+[\s\S]*(<\/style>)+",'',$text);
		$text = mb_eregi_replace("\"",'\'',$text);
		$text = mb_eregi_replace("[\s]+",'',$text);
		$text = strip_tags($text);

		return $text;
	}

	public function redisGet($name_var) {
		require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
		$this->redis = new \CI_Predis\Redis(['serverName' => 'localhost']);

		return $this->redis->get($name_var);
	}	

	// output: val AFTER add
	public function redisAdd($name_var) {
		require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
		$this->redis = new \CI_Predis\Redis(['serverName' => 'localhost']);

		$this->redis->incr($name_var);
		return $this->redis->get($name_var);
	}	

	public function redisZadd($name_var) {
		require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
		$this->redis = new \CI_Predis\Redis(['serverName' => 'localhost']);

		$this->redis->zincrby('qgoods_hit_pd', 1, $name_var);
	}

	public function redisSort($limit) {
		require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
		$this->redis = new \CI_Predis\Redis(['serverName' => 'localhost']);

		$ary_option = array(
			'by'	=>	'score',
			'limit'	=>	array(0, $limit),
			'sort'	=> 'desc'
		);

		//sort qgoods_hit by score limit 0 2 desc

		return $this->redis->sort('qgoods_hit_pd', $ary_option);
	}

	public function sendMail($order_id) {
		$this->load->library('email');
		$this->load->model('Orders_model');

		$data['info'] = $this->Orders_model->getOrder($order_id);
		$data['info']['amt'] = $this->Orders_model->getOrderAmt($order_id);

		$this->email
			->from('service@rapaq.com', 'RapaQ')
			->to($data['info']['rec_mail'])
			->subject('RapaQ 訂單成立')
			->message($this->load->view('mail/order_notify', $data, true))
			->set_mailtype('html');
		$this->email->send();
	}	

	public function sendMailFgtPwd($mail, $token) {
		$this->load->library('mailgun');
		
		$msg = '請點下面連結完成密碼重設：<br><a href="'.base_url().'member/forgetPasswordCallback?token='.$token.'&mail='.$mail.'">連結</a>';
		$this->mailgun
			->to($mail)
			->from('service@rapaq.com')
			->subject('RapaQ 忘記密碼')
			->message($msg)
			->send();
	}	
}