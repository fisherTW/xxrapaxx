<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Qmaker.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Qmaker extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
	}

	public function index() {
		$this->load->model('Project_model');
		$this->load->model('Factory_model');

		$data['title'] = '募設計';
		$data['ary_projectNew'] = $this->Project_model->getProjectsNew();

		$ary_ret = $this->Project_model->getProjects();
		if(count($ary_ret >0)) {
			foreach ($ary_ret as $key => $val) {
				if(($val['id'] >= 24) && ($val['id'] <= 62)) {
					$ary_ret[$key]['total'] = $val['total'];
				} else {
					$total = $this->Project_model->getProjectPriceTotal($val['id']);
					$ary_ret[$key]['total'] = (is_null($total) ? 0 : $total);
				}

			}
		}
		$ary_tmp = array_column($ary_ret, 'total', 'id');
		arsort($ary_tmp);
		$a = 0;
		foreach ($ary_tmp as $key => $val) {
			$a++;
			if($a > 6) {
				break;
			}
			$ary_result = $this->Project_model->getProjectById($key);
			$ary_project[$a]['total'] = $val;
			$ary_project[$a]['id'] = $ary_result['id'];
			$ary_project[$a]['goal'] = $ary_result['goal'];
			$ary_project[$a]['dt_exp_end'] = $ary_result['dt_exp_end'];
			$ary_project[$a]['pic_cover'] = $ary_result['pic_cover'];
			$ary_project[$a]['name'] = $ary_result['name'];
			$ary_project[$a]['user_id'] = $ary_result['user_id'];
			$ary_project[$a]['user_name'] = $ary_result['user_name'];
			$ary_project[$a]['profile'] = $ary_result['profile'];
		}
		$data['ary_project'] = $ary_project;

		$data['ary_factory'] = $this->Factory_model->getFactorys();

		$this->load->view('template/header',$data);
		$this->load->view('qmaker/index', $data);
		$this->load->view('template/footer');
	}

}