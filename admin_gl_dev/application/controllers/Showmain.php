<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Showmain.php
* Version:		-
* Last changed:	2018/06/19
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_dev
*/
class Showmain extends CI_Controller { 
	public function __construct(){
		parent::__construct();
		$this->load->model('Showmain_model');
	}

	public function index_qmaker() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'showmain_qmaker';
		$data['info'] = $this->Showmain_model->getProject();
		$data['showmain'] = $this->Showmain_model->getProjectShow();

		$this->load->view('template/header',$data);
		$this->load->view('showmain/index_qmaker', $data);
		$this->load->view('template/footer');
	}

	public function index_qgoods() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');



		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'showmain_qgoods';

		$data['product'] = $this->Showmain_model->getProduct();

 		foreach ($data['product'] as $key => $value) {$product['name'][$value['id']]= $value['name'];};
		$product['name'][0] = '請選擇';
		ksort($product['name']);

		$data['ary_product'] = $product['name'];

		$data['banner_pdt'] = $this->Showmain_model->getPdtBannerShow();

		foreach ($data['banner_pdt'] as $key => $value) {
			$start = substr($value['dt_exp_start'], 0, -3);
			$end   = substr($value['dt_exp_end'], 0, -3);
			$data['dt_show'][$value['id']] = $start.' - '.$end;
		}

		$data['look_pdt'] = $this->Showmain_model->getPdtLookShow();


		$data['store'] = $this->Showmain_model->getStore();

 		foreach ($data['store'] as $key => $value) {$store['name'][$value['id']]= $value['name'];};
		//ksort($theme['name']);
		$data['ary_store'] = $store['name'];
		$data['store_show'] = $this->Showmain_model->getStoreShow();


		$this->load->view('template/header',$data);
		$this->load->view('showmain/index_qgoods', $data);
		$this->load->view('template/footer');
	}

	public function getThemeShow() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		echo json_encode($this->Showmain_model->getThemeShow());
	}

	public function doEditQmaker() {
		$this->Showmain_model->doEditQmaker();
	}

	public function doEditQgoods() {
		//$this->Showmain_model->updateState('theme');
		$this->Showmain_model->updateState('banner');
		$this->Showmain_model->updateState('store');
		$this->Showmain_model->updateState('look');

		// banner
		$banner_url = array();
		$banner_pic_url = array();
		$banner_date = array();
		$banner_blank = array();
		foreach ($_POST['txt_url'] as $key => $value) {
			array_push($banner_url, $value);
		}
		foreach ($_POST['b_pic_url'] as $key => $value) {
			array_push($banner_pic_url, $value);
		}
		foreach ($_POST['b_daterange'] as $key => $value) {
			array_push($banner_date, $value);
		}
		foreach ($_POST['rdo_pdt_status'] as $key => $value) {
			array_push($banner_blank, $value);
		}

		$banner_num = count($banner_url);
		for ($i=0; $i < $banner_num; $i++) { 
			$url = $banner_url[$i];
			$start_time	=	substr($banner_date[$i], 0, 16);
			$end_time	=	substr($banner_date[$i], 19, 16);
			$pic_url	=	$banner_pic_url[$i];
			$is_blank	=	$banner_blank[$i];
			if ($pic_url != '') {
				$this->Showmain_model->doEditQgoods('banner', '', $start_time, $end_time, $pic_url, $is_blank, $url);
			}
			
		}

		// look
		$look_pdt = array();
		$look_url = array();
		foreach ($_POST['hid_products_id'] as $key => $value) {
			array_push($look_pdt, $value);
		}
		foreach ($_POST['txt_url_youtube'] as $key => $value) {
			array_push($look_url, $value);
		}

		$look_num = count($look_pdt);
		for ($i=0; $i < $look_num; $i++) { 
			$id = $look_pdt[$i];
			$youtube_url = $look_url[$i];
			$this->Showmain_model->doEditQgoods('look', $id, '', '', '', '', $youtube_url);
		}

		for ($i=1; $i <= 4; $i++) { 
			$id = $_POST['is_show_store'.$i];
			if ($id != 0 && $youtube_url != '') {
				$this->Showmain_model->doEditQgoods('store', $id);
			}

		}
	}

	public function NewLookQgoods() {

		$data['product'] = $this->Showmain_model->getProduct();

		$pdt_opt = '';
		foreach ($data['product'] as $key => $value) {

			$pdt_opt .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
			
		};
		echo $pdt_opt;
	}

	public function NewThemeQgoods() {

		$data['theme'] = $this->Showmain_model->getTheme();
		$t_opt = '';
		foreach ($data['theme'] as $key => $value) {
			$t_opt .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';	
		};

		echo $t_opt;
	}

	public function LookYoutubeUrl() {
		$pdt_id = $_POST['l'];
		if ($pdt_id == 0) {
			$data[0]['url_youtube'] = '';	
		} else{
			$data = $this->Showmain_model->getProduct($pdt_id);
		}

		echo $data[0]['url_youtube'];
	}	

	public function ThemeDateTime() {
		$theme_id = $_POST['t'];
		if ($theme_id == 0) {
			$date_data = '';	
		} else{
			$data = $this->Showmain_model->getTheme($theme_id);
			$date_data = substr($data[0]['dt_exp_start'], 0, -3).' - '.substr($data[0]['dt_exp_end'], 0, -3);
		}

		echo $date_data;
	}

	public function ProductSearch() {

		$this->load->helper('form');
		$ary = $this->Showmain_model->getProductSearch();
		
		echo form_dropdown('div_search', $ary, 0, "id='div_search' class='form-control' size='12'");
	}


	public function index_qgoods_old() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		$this->load->helper('form');



		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'showmain_qgoods';

		$data['product'] = $this->Showmain_model->getProduct();

 		foreach ($data['product'] as $key => $value) {$product['name'][$value['id']]= $value['name'];};
		$product['name'][0] = '請選擇';
		ksort($product['name']);

		$data['ary_product'] = $product['name'];

		$data['banner_pdt'] = $this->Showmain_model->getPdtBannerShow();

		foreach ($data['banner_pdt'] as $key => $value) {
			$start = substr($value['dt_exp_start'], 0, -3);
			$end   = substr($value['dt_exp_end'], 0, -3);
			$data['dt_show'][$value['id']] = $start.' - '.$end;
		}

		$data['look_pdt'] = $this->Showmain_model->getPdtLookShow();


		$data['store'] = $this->Showmain_model->getStore();

 		foreach ($data['store'] as $key => $value) {$store['name'][$value['id']]= $value['name'];};
		//ksort($theme['name']);
		$data['ary_store'] = $store['name'];
		$data['store_show'] = $this->Showmain_model->getStoreShow();


		$this->load->view('template/header',$data);
		$this->load->view('showmain/index_qgoods_old', $data);
		$this->load->view('template/footer');
	}
}

