<?php
/*
* File:			Project_model.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Project_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}


	//	output
	//	array(result, data)
	//	1: success
	public function doLaunch() {
		$ary_data = array(
			'user_id'	=>	$_SESSION['sess_user_id'],
			'user_name'	=>	$_SESSION['sess_user_name'],
			'user_phone'	=>	$_SESSION['sess_user_phone'],
			'user_mail'		=>	$_SESSION['sess_user_mail'],
			'user_profile'	=>	$_SESSION['sess_user_profile'],

			'brand_name'	=> $this->input->post('txt_brand_name'), 
			'brand_logo'	=> $this->input->post('hid_brand_logo'),
			'brand_profile'		=> $this->input->post('txt_brand_profile'),
			'name'			=> $this->input->post('txt_name'), 
			'category_id'	=> $this->input->post('sel_category'), 
			'goal'			=> $this->input->post('txt_goal'), 
			'percent'		=> $this->input->post('txt_percent'), 
			'dt_exp_start'	=> $this->input->post('txt_dt_exp_start'), 
			'dt_exp_end'	=> $this->input->post('txt_dt_exp_end'),
			'date_out'		=> $this->input->post('txt_date_out'),	
			'pic_cover'		=> $this->input->post('hid_pic_cover'),
			'video_cover'	=> $this->input->post('txt_video_cover'),
			'profile'		=> $this->input->post('txt_profile'),
			'dt_create'		=> date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);
		$this->db->insert('project');

		$ary_ret = array($this->db->insert_id(), $this->input->post('txt_name'));

		return array(1, $ary_ret);
	}

	//最新計畫 project is_showmain
	public function getProjectsNew() {
		$this->db->where('is_enable', 1);
		$this->db->where('status', PROJECT_STATUS_2_SUCCESS);
		$this->db->where('is_showmain', 1);
		$this->db->order_by('dt_create', 'DESC');
		$this->db->limit(2);
		$query = $this->db->get('project');

		return $query->result_array();
	}

	//熱門計畫 募款金額
	public function getProjects() {
		$this->db->where('is_enable', 1);
		$this->db->where('status', PROJECT_STATUS_2_SUCCESS);
		$query = $this->db->get('project');

		return $query->result_array();
	}

	//經典計畫
	public function getProjectsClassic() {
		$this->db->select('p.*, u.name as user_name');
		$this->db->join('users u', 'u.id=p.user_id', 'left');
		$this->db->where('p.is_enable', 1);		
		$this->db->where('p.status', PROJECT_STATUS_2_SUCCESS);
		$this->db->where('p.dt_exp_end <',date('Y-m-d H:i:s')); 
		$this->db->where('p.percent >=',100); 
		$this->db->order_by('p.dt_create', 'DESC');
		$this->db->limit(4);
		$query = $this->db->get('project p');

		return $query->result_array();
	}

	//計畫探索
	public function getProjectsAll() {
		$this->db->where('is_enable', 1);
		$this->db->where('status', PROJECT_STATUS_2_SUCCESS);
		$this->db->order_by('dt_create', 'DESC');
		$this->db->limit(4);
		$query = $this->db->get('project');

		return $query->result_array();
	}

	public function getCategory() {
		$ary_category = array();

		$query = $this->db->get('mapping_project_category');
		$ary_temp = $query->result_array();
		if(count($ary_temp) > 0) {
			foreach ($ary_temp as $key => $value) {
				$ary_category[$value['id']] = $value['name'];
			}		
		}

		return $ary_category;
	}

	//條件search
	public function getProjectsByCondition($category=0, $status=0, $type=0, $page=0) {
		$this->db->select('p.*, u.name as user_name');
		$this->db->join('users u', 'u.id=p.user_id', 'left');

		if($category != 0) {
			$this->db->where('p.category_id', $category);
		}
		if($status != 0) {
			switch ($status) {
				case '1':	//正在募資
					$this->db->where('p.dt_exp_start <', date('Y-m-d H:i:s'));
					$this->db->where('p.dt_exp_end >', date('Y-m-d H:i:s'));
					break;
				case '2':	//募資成功
					$this->db->where('p.percent >=',100);
					break;
				case '3':	//即將開始
					$this->db->where('p.dt_exp_start >', date('Y-m-d H:i:s'));
					break;
			}
		}
		if($type != 0) {
			switch ($type) {
				case '1':	//熱門計畫
					$this->db->where('p.dt_exp_start <=',date('Y-m-d H:i:s'));
					break;
				case '2':	//經典計畫
					$this->db->where('p.dt_exp_end <',date('Y-m-d H:i:s')); 
					$this->db->where('p.percent >=',100);
					break;
				case '3':	//最多收藏    未寫
					break;
			}
		}
		if($page != 0){
			$this->db->limit(12);
			$this->db->offset(($page -1) * 12);
		}

		$this->db->where('p.is_enable', 1);
		$this->db->where('p.status', PROJECT_STATUS_2_SUCCESS);		
		$this->db->order_by('p.dt_create', 'DESC');
		$query = $this->db->get('project p');

		return $query->result_array();
	}

	public function searchProject($word, $page=0) {
		$this->db->group_start();
		$this->db->like('user_name', $word, 'both');
		$this->db->or_like('brand_name', $word, 'both');
//		$this->db->or_like('brand_profile', $word, 'after');
		$this->db->or_like('name', $word, 'both');
//		$this->db->or_like('profile', $word, 'after');
		$this->db->group_end();
		$this->db->where('is_enable', 1);

		$this->db->where('status', PROJECT_STATUS_2_SUCCESS);
		if($page != 0){
			$this->db->limit(12);
			$this->db->offset(($page -1) * 12);
		}		
		$this->db->order_by('dt_create', 'DESC');
		$query = $this->db->get('project');

		return $query->result_array();
	}

	public function getProjectById($id) {
		$this->db->select('p.*, u.name as user_name');
		$this->db->join('users u', 'u.id=p.user_id', 'left');
		$this->db->where('p.is_enable', 1);
		$this->db->where('p.status', PROJECT_STATUS_2_SUCCESS);
		$this->db->where('p.id', $id);
		$query = $this->db->get('project p');

		return $query->row_array();
	}

	public function getProjectByUserId($user_id) {
		$this->db->select('p.*, u.name as user_name');
		$this->db->join('users u', 'u.id=p.user_id', 'left');
		$this->db->where('p.is_enable', 1);
		$this->db->where('p.status', PROJECT_STATUS_2_SUCCESS);
		$this->db->where('p.user_id', $user_id);
		$query = $this->db->get('project p');

		return $query->result_array();
	}

	public function getProjectPriceTotal($id) {
		$this->db->select('sum(price_deal*quantity) as total');
		$this->db->join('orders o', 'o.order_id=osp.order_id', 'left');
		$this->db->where('o.status_payment', PAYMENT_SUCCESS);
		$this->db->where('osp.store_id', $id);
		$this->db->where('osp.is_delivery', 0);
		$query = $this->db->get('order_store_product osp');
		$row = $query->row();

		return $row->total;
	}

}