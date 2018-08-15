<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Account.php
* Version:		-
* Last changed:	2018/08/09
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Account extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Account_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'account';

		$this->load->view('template/header',$data);
		$this->load->view('account/index', $data);
		$this->load->view('template/footer');
	}

	public function getAccount() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Account_model->getAccount());
	}

	public function getAccountList($date = '') {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Account_model->getAccountList($date));
	}

	public function edit($date = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'account';

		$data['date'] = $date;

		$this->load->view('template/header',$data);
		$this->load->view('account/edit', $data);
		$this->load->view('template/footer');
	}

	public function checkUpload() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$is_exist = $this->Account_model->checkDataUpload();

		if ($is_exist[0]['num'] >= '1') {
			$exist = 1;
		} else {
			$exist = 0;	
		}
		echo $exist;
	}

	public function checkInvoiceData() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		if (empty($_FILES)) {
			echo '無匯入檔案！';
			return;	
		}
		list($x, $ext) = explode('.', $_FILES['file']['name']);
		list($usec, $x) = explode(' ', microtime());
		if ($ext != 'csv') {
			echo '檔案格式錯誤！';
			return;
		} else {
			$newname = date("YmdHis").strval($usec * 1000000).'.'.$ext;
			$newpath = '/tmp/'.$newname;

			move_uploaded_file($_FILES['file']['tmp_name'], $newpath);
			mb_convert_encoding($newpath, "UTF-8", "auto");

			$file = fopen($newpath,"r");
			$str = '';
			$num = 0;
			$check_num = 0;
			while (!feof($file)) {

				$str = fgets($file);

				$data_check[$check_num] = explode(",",$str);
				$data_check[$check_num][8] = 'KG'.$data_check[$check_num][8];

				$is_exist = $this->Account_model->checkAccountData($data_check[$check_num][0]);

				if ($is_exist[0]['num'] == 0) {

					$ary_str[$num] = $data_check[$check_num];
					 $num ++;
				}
				$check_num ++;
			}
			fclose($file);

			if (isset($ary_str)) {
				$this->Account_model->insertAccount($ary_str);
			}

			if(file_exists($newpath)) {
				unlink($newpath);
			}
	 
			echo '總共: '.$check_num.' 筆，匯入: '.$num.' 筆';
		}
	}

	public function downloadMailContent($date = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$data = $this->Account_model->getDownloadList($date);

		$txt_name = 'download_mobile.txt';
		$newpath = '/tmp/'.$txt_name;


		$file = fopen($newpath,"a+");
		$txt = "Bill Gates\n";
		fwrite($file, $txt);


		if (file_exists($newpath)) {
			header('Content-type: text/plain');
header('Content-Length: '.filesize($file));
header('Content-Disposition: attachment; filename='.$txt_name);
readfile($newpath);

			unlink($newpath);
			exit;
		}
		fclose($file);
		if(file_exists($newpath)) {
			unlink($newpath);
		}

		exit();

	}
}