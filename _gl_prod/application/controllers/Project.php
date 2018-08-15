<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Project.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Project extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('Project_model');

		$this->status = array(
			0 => '全部計畫',
			1 => '正在募資',
			2 => '募資成功',
			3 => '即將開始'
		);

		$this->type = array(
			0 => '最新計畫',
			1 => '熱門計畫',
			2 => '推薦計畫',
			3 => '最多收藏'
		);
	}

	public function launch() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'member/login?back=../project/launch', 'refresh');
		}		
		$data['title'] = '發起計畫│募設計';

		$this->load->view('template/header',$data);
		$this->load->view('project/launch');
		$this->load->view('template/footer');
	}

	public function launcher($user_id) {
		$data['title'] = '發起人│募設計';
		$data['info'] = $this->Project_model->getProjectByUserId($user_id);

		$this->load->view('template/header',$data);
		$this->load->view('project/launcher');
		$this->load->view('template/footer');		
	}

	public function writeSession() {
		$_SESSION['sess_user_name'] = $this->input->post('txt_user_name');
		$_SESSION['sess_user_phone'] = $this->input->post('txt_user_phone');
		$_SESSION['sess_user_mail'] = $this->input->post('txt_user_mail');
		$_SESSION['sess_user_profile'] = $this->input->post('txt_user_profile');

		echo 1;		
	}

	public function delSession() {
		unset($_SESSION['sess_user_name']);
		unset($_SESSION['sess_user_phone']);
		unset($_SESSION['sess_user_mail']);
		unset($_SESSION['sess_user_profile']);
		unset($_SESSION['tmp_project_0']);
		unset($_SESSION['tmp_project_1']);
	}	

	public function launchOutline() {
		if(!isset($_SESSION['sess_user_name'])) {
			redirect(base_url().'project/launch/', 'refresh');
		}

		$this->load->helper('form');

		$data['title'] = '發起計畫│募設計';
		$data['ary_category'] = $this->Project_model->getCategory();

		$this->load->view('template/header',$data);
		$this->load->view('project/launch_outline', $data);
		$this->load->view('template/footer');
	}

	public function launchDone() {
		if(!isset($_SESSION['tmp_project_0'])) {
			redirect(base_url().'project/launch/', 'refresh');
		}
		$data['title'] = '發起計畫│募設計';
		$data['lastUpdateId'] = $_SESSION['tmp_project_0'];
		$data['project_name'] = $_SESSION['tmp_project_1'];

		unset($_SESSION['tmp_project_0']);
		unset($_SESSION['tmp_project_1']);

		$this->load->view('template/header',$data);
		$this->load->view('project/launch_done', $data);
		$this->load->view('template/footer');		
	}

	public function doLaunch() {
		list($ret, $ary_data) = $this->Project_model->doLaunch();

		$_SESSION['tmp_project_0'] = $ary_data[0];
		$_SESSION['tmp_project_1'] = $ary_data[1];

		echo $ret;
	}

	public function index($id) {
		$this->load->model('Product_model');
		$this->load->model('Faq_model');
		$this->load->model('Comments_model');
		$this->load->model('Journal_model');

		$data['title'] = '計畫內容│募設計';
		$data['info'] = $this->Project_model->getProjectById($id);
		if(is_null($data['info'])) {
			redirect(base_url().'qmaker', 'refresh');
		}

		$data['og_title'] = $data['info']['name'];
		$data['og_description'] = $this->strip_tag_css_fisher($data['info']['detail']);
		$data['og_image'] = URL_GOOGLE_IMG.$data['info']['pic_cover'];
		$data['og_url'] = base_url().'project/view/'.$id;

		if(($id >= 24) && ($id <= 62)) {
			// fake data
		} else {
			$data['info']['total'] = $this->Project_model->getProjectPriceTotal($id);
		}

		$data['info']['faq'] = $this->Faq_model->get(SOURCE_QMAKER, $id);
		$data['info']['comments'] = $this->Comments_model->get(SOURCE_QMAKER, $id);
		$data['info']['updates'] = $this->Journal_model->get(SOURCE_QMAKER, $id);
		$ary_product = $this->Product_model->getProductByProjectId($id, SOURCE_QMAKER);
		if(count($ary_product) > 0) {
			foreach ($ary_product as $key => $val) {
				$quantity_total = $this->Product_model->getProductQuantityTotal($val['id']);
				$ary_product[$key]['quantity_total'] = (is_null($quantity_total) ? 0 : $quantity_total);
				if(($val['dt_exp_start'] < date('Y-m-d H:i:s')) && ($val['dt_exp_end'] > date('Y-m-d H:i:s'))) {
					$ary_product[$key]['is_show'] = '1';
				} else {
					$ary_product[$key]['is_show'] = '0';
				}
			}
		}
		$data['ary_product'] = $ary_product;

		if(isset($_SESSION['sess_user_id'])) {
			$this->load->model('Member_model');
			$data['isMyBookmark'] = $this->Member_model->isMyBookmark(SOURCE_PROJECT, $id);
		} else {
			$data['isMyBookmark'] = false;
		}		

		$this->load->view('template/header', $data);
		$this->load->view('project/index', $data);
		$this->load->view('template/footer');
		$this->load->view('project/scroll');
	}

	public function list() {
		$this->load->helper('form');

		$page		= isset($_GET['page']) ? $_GET['page']: 1;
		$category	= isset($_GET['category']) ? $_GET['category']: 0;
		$status		= isset($_GET['status']) ? $_GET['status']: 0;
		$type		= isset($_GET['type']) ? $_GET['type']: 0;

		$data['category']	= $category;
		$data['status']		= $status;
		$data['type']		= $type;
		$data['page']		= $page;

		$ary_project = $this->Project_model->getProjectsByCondition($category, $status, $type, $page);
		if(count($ary_project >0)) {
			foreach ($ary_project as $key => $val) {
				if(($val['id'] >= 24) && ($val['id']<= 62)) {
					// fake data
				} else {
					$total = $this->Project_model->getProjectPriceTotal($val['id']);
					$ary_project[$key]['total'] = (is_null($total) ? 0 : $total);
				}
			}
		}
		$data['ary_project'] = $ary_project;

		$ary_data = $this->Project_model->getProjectsByCondition($category, $status, $type);
		$countPage = ceil(count($ary_data)/12);
		$str_ret = array();
		for ($i=1; $i<=$countPage; $i++) {
			$str_ret[$i] = $i;
		}
		$data['ProjectCount'] = $str_ret;

		$ary_category = $this->Project_model->getCategory();
		$ary_category[0] = '計畫探索';
		ksort($ary_category);

		$data['ary_category']	= $ary_category;
		$data['ary_status']		= $this->status;
		$data['ary_type']		= $this->type;

		$data['title'] = '計畫探索│募設計';

		$this->load->view('template/header', $data);
		$this->load->view('project/list', $data);
		$this->load->view('template/footer');
	}
}