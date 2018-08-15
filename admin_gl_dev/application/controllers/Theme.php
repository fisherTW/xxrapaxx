<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Theme.php
* Version:		-
* Last changed:	2018/06/22
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Theme extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Theme_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'theme';

		$this->load->view('template/header',$data);
		$this->load->view('theme/index', $data);
		$this->load->view('template/footer');
	}

	public function getTheme() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Theme_model->getTheme());
	}

	public function edit($theme_id = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$this->load->helper('form');
		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'theme';

		$data['info'] = $this->Theme_model->get($theme_id);
		$data['id'] = $theme_id;
		$data['product'] = $this->Theme_model->getProducts($theme_id);

		 $themeshownum = $this->Theme_model->getThemeShowNum();

		 $themeindate = $this->Theme_model->getThemeDateIn();
		 $countthemenum = 0;
		 foreach ($themeindate as $key => $value) {
		 	if ($value['dt_exp_start'] <= date("Y-m-d h:i:s") && $value['dt_exp_end'] >= date("Y-m-d h:i:s")) {
		 		$countthemenum ++;
		 	}
		 }
		 $data['themeshow'] = $countthemenum;

		if ($theme_id == 0 || $data['info'][0]['dt_exp_start'] == '' || $data['info'][0]['dt_exp_end'] == '') {
			$data['date'] = '';

		} else {
			$start = substr($data['info'][0]['dt_exp_start'], 0, -3);
			$end   = substr($data['info'][0]['dt_exp_end'], 0, -3);
			$data['date'] = $start.' - '.$end;
		}

		$this->load->view('template/header',$data);
		$this->load->view('theme/edit', $data);
		$this->load->view('template/footer');		
	}

	public function ProductSearch() {

		$this->load->helper('form');
		$ary = $this->Theme_model->getProductSearch();
		
		echo form_dropdown('div_search', $ary, 0, "id='div_search' class='form-control' size='12'");
	}

	public function doEdit() {

		$start = substr($_POST['daterange'], 0, 16);
		$end   = substr($_POST['daterange'], 19, 16);

		$id = $this->Theme_model->doEditTheme($start, $end);

		// 清除連結商品
		$this->Theme_model->doClearThemepdt();

		if ($_POST['hid_theme_id'] == 0) {
			$theme_id = $id;
		}	else {
			$theme_id = $_POST['hid_theme_id'];
		}
		$products_id = $_POST['hid_products_id'];

		foreach ($products_id as $key => $value) {
			if ($value > 0) {
				$this->Theme_model->doAddThemepdt($value, $theme_id);
			}
		}
	}

	public function doDelete() {
		$this->Theme_model->doDelTheme();
	}

	public function doLowerShelf() {
		$this->Theme_model->doLowerShelf();
	}
}