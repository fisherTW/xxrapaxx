<?php
/*
* File:			Showmain_model.php
* Version:		-
* Last changed:	2018/06/13
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_dev
*/
class Showmain_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function getProject() {
		$this->db->select('p.id,p.name,p.is_showmain,p.is_showname');
		$this->db->where('p.status', PROJECT_STATUS_2_SUCCESS);
		$this->db->where('p.is_enable', '1');
		$query = $this->db->get('project p');

		return $query->result_array();
	}

	public function getProjectShow() {
		$this->db->select('p.id,p.name,p.is_showmain,p.is_showname');
		$this->db->where('p.status', PROJECT_STATUS_2_SUCCESS);
		$this->db->where('p.is_enable', '1');
		$this->db->where('p.is_showmain', '1');
		$query = $this->db->get('project p');

		return $query->result_array();
	}

	public function getProduct($id='') {
		$this->db->select('p.id, p.name, p.price_deal, p.url_youtube');

		$ary_data = array(
			'p.status'		=> '1',
			'p.source'		=> SOURCE_QGOODS,
			'p.is_delivery'	=> '0',
			'p.dt_start <'	=> date("Y-m-d h:i:s"),
			'p.dt_end >'	=> date("Y-m-d h:i:s")
		);
		if ($id != '') {
			$this->db->where('p.id', $id);
		}
		$this->db->where($ary_data);

		$query = $this->db->get('product p');

		return $query->result_array();
	}

	public function getStore() {
		$this->db->select('s.id, s.name');

		$this->db->where('s.is_enable', '1');
		$this->db->order_by('s.name', 'ASC');

		$query = $this->db->get('store s');

		return $query->result_array();
	}

	public function getThemeShow() {
		$this->db->select('t.id, t.name, t.is_enable, t.dt_exp_start, t.dt_exp_end');

		$this->db->where('t.is_enable', '1');
		$this->db->where('t.is_del', '0');		
		$this->db->where('t.dt_exp_start <=', date("Y-m-d h:i:s"));
		$this->db->where('t.dt_exp_end >=', date("Y-m-d h:i:s"));


		$query = $this->db->get('theme t');

		return $query->result_array();
	}

	public function getStoreShow() {
		$this->db->select('s.id, s.name');

		$this->db->where('s.is_recommend', '1');


		$query = $this->db->get('store s');

		return $query->result_array();
	}
	//	output
	//	1: success
	public function doEditQmaker() {
		$this->updateProjectShow();

		$ary_data = array(
			'is_showmain'		=> '1'
		);
		if($this->input->post('rdo_is_show1') == '1'){$this->updateShowname($this->input->post('is_show1'));};
		if($this->input->post('rdo_is_show2') == '1'){$this->updateShowname($this->input->post('is_show2'));};

		$this->db->set($ary_data);

		$this->db->where('id', $this->input->post('is_show1'));
		$this->db->or_where('id',  $this->input->post('is_show2'));
		$this->db->update('project');
		return 1;	
	}

	//	output
	//	1: success
	public function doEditQgoods($model='', $id='', $start_time='', $end_time='', $pic_url='', $is_blank='', $url='') {
		switch ($model) {
			case 'banner':
				$ary_data = array(
					'url'				=>	$url,
					'dt_exp_start'		=>	$start_time,
					'dt_exp_end'		=>	$end_time,
					'pic'				=>	$pic_url,
					'is_blank'			=>	$is_blank,
					'dt_create'			=>	date("Y-m-d H:i:s")
				);

				$this->db->set($ary_data);

				$this->db->insert('banner');
				return 1;	
			break;
			case 'look':
				$ary_data = array(
					'url_youtube'		=>	$url,
					'is_showmain'		=>  '1'
				);

				$this->db->set($ary_data);

				$this->db->where('id', $id);
				$this->db->update('product');
				return 1;	
			break;
			case 'store':
				$ary_data = array(
					'is_recommend'		=>	'1'
				);

				$this->db->set($ary_data);

				$this->db->where('id', $id);
				$this->db->update('store');
				return 1;	
			break;
			
			default:
				return 0;
				break;
		}
		
	}

	public function updateShowname($id) {

		$ary_data = array(
			'is_showname'		=> '1'
		);
		$this->db->set($ary_data);

		$this->db->where('id', $id);
		$this->db->update('project');
		return 1;	
	}

	public function updateProjectShow() {

		$ary_data = array(
			'is_showmain'		=> '0',
			'is_showname'		=> '0'
		);
		$this->db->set($ary_data);
		$this->db->update('project');
		return 1;	
	}

	public function updateState($model='') {
		switch ($model) {
			case 'banner':
			$array = array('id >=' => '0');
				$this->db->where($array);
				$this->db->delete('banner');
				return 1;
			break;
			case 'store':
			$array = array('is_recommend' => '0');
				$this->db->set($array);
				$this->db->update('store');
				return 1;
			break;
			case 'look':
			$array = array('is_showmain' => '0');
				$this->db->set($array);
				$this->db->update('product');
				return 1;
			break;
			default:
				return 0;
				break;
		}
	}

	public function getPdtBannerShow() {

		$this->db->select('b.*');

		$query = $this->db->get('banner b');

		return $query->result_array();
	}

	public function getPdtLookShow() {

		$this->db->select('p.id as pdt_id, p.name as pdt_name, p.url_youtube as url_youtube');

		$this->db->where('p.is_showmain', '1');
		$this->db->where('p.source', SOURCE_QGOODS);

		$query = $this->db->get('product p');

		return $query->result_array();
	}

	public function getProductSearch() {

		$this->db->select('p.id, p.name, p.price_deal, p.url_youtube');

		$ary_data = array(
			'p.status'		=> '1',
			'p.source'		=> SOURCE_QGOODS,
			'p.is_delivery'	=> '0',
			'p.dt_start <'	=> date("Y-m-d h:i:s"),
			'p.dt_end >'	=> date("Y-m-d h:i:s")
		);

		$this->db->where($ary_data);
		$this->db->like('p.name', $_POST['keyword'], 'after');
		$query = $this->db->get('product p');


		$query_ary = $query->result_array();
		if(count($query_ary) > 0) {
			foreach ($query_ary as $key => $val) {
				$ary_pdt[$val['id']] = $val['name'];
			}
		} else {
			$ary_pdt[0] = '沒有找到相關產品';
		}
		return $ary_pdt;
	}


}