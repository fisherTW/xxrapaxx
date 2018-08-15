<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Store.php
* Version:		-
* Last changed:	2018/07/10
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Store extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Store_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'store';

		$this->load->view('template/header',$data);
		$this->load->view('store/index', $data);
		$this->load->view('template/footer');
	}

	public function getStore() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Store_model->getStore());
	}

	public function edit($store_id = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$this->load->helper('form');
		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'store';

		$data['info'] = $this->Store_model->get($store_id);
		$data['id'] = $store_id;

		if ($store_id != 0) {
			$login_type = '';
						switch ($data['info'][0]['user_login_type']) {
							case '1':
								$login_type = '(local)';
								break;
							case '2':
								$login_type = '(facebook)';
								break;
							case '3':
								$login_type = '(google)';
								break;
							default:
								$login_type = '(無)';
								break;
						}

				$data['info'][0]['user_mail'] = $data['info'][0]['user_mail'].' '.$login_type;
		}
	
		$date = date("Y-m-d H:i");
		if ($store_id == 0 || $data['info'][0]['dt_start'] == '' || $data['info'][0]['dt_end'] == '') {
			$data['date'] = '';

		} else {
			$start = substr($data['info'][0]['dt_start'], 0, -3);
			$end   = substr($data['info'][0]['dt_end'], 0, -3);
			$data['date'] = $start.' - '.$end;
		}

		$this->load->view('template/header',$data);
		$this->load->view('store/edit', $data);
		$this->load->view('template/footer');		
	}

	public function UserSearch() {

		$this->load->helper('form');
		$ary = $this->Store_model->getUserSearch();
		
		echo form_dropdown('div_search', $ary, 0, "id='div_search' class='form-control' size='12'");
	}

	public function doEdit() {
		if ($_POST['hid_store_id'] == 0) {
			$store_id = $_POST['hid_store_id'];
			$start = substr($_POST['daterange'], 0, 16);
			$end   = substr($_POST['daterange'], 19, 16);
		}	else {
			$store_id = $_POST['hid_store_id'];
			$start = substr($_POST['daterange'], 0, 16);
			$end   = substr($_POST['daterange'], 19, 16);
		}

		$this->Store_model->doEditStore($store_id, $start, $end);

	}
}