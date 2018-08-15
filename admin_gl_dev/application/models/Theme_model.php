<?php
/*
* File:			Theme_model.php
* Version:		-
* Last changed:	2018/06/22
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Theme_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function doDelTheme() {
		$this->db->set('is_del', '1');
		$this->db->where('id', $_POST['id']);
		$this->db->update('theme');

		return 1;	
	}

	public function doLowerShelf() {
		$this->db->set('is_enable', '0');
		$this->db->where('id', $_POST['id']);
		$this->db->update('theme');

		return 1;	
	}

	public function getTheme() {
		$this->db->select('t.*');

		$this->db->where('t.is_del', '0');
		$query = $this->db->get('theme t');

		return $query->result_array();
	}

	public function get($theme_id) {
		$this->db->select('t.*');
		$this->db->where('t.id', $theme_id);
		$query = $this->db->get('theme t');

		return $query->result_array();
	}

	public function getProducts($theme_id) {
		$this->db->select('p.id, p.name');
		$this->db->join('product p','p.id=mtp.product_id','left');
		$this->db->where('mtp.theme_id', $theme_id);
		$query = $this->db->get('mapping_theme_product mtp');

		return $query->result_array();
	}

	public function getProductSearch() {
		$this->db->select('p.id, p.name');
		
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

	public function doEditTheme($start, $end) {

		$ary_data = array(
			'link'				=> $_POST['txt_link'], 
			'product_title'		=> $_POST['txt_product_title'],
			'pic_cover'			=> $_POST['hid_big_pic'],
			'pic_cover2'		=> $_POST['hid_small_pic'],
			'detail'			=> $_POST['txt_detail'],
			'name'				=> $_POST['txt_name'],
			'is_enable'			=> $_POST['rdo_pdt_status'],
			'dt_exp_start'		=> $start,
			'dt_exp_end'		=> $end
		);
		$this->db->set($ary_data);

		if ($_POST['hid_theme_id'] == '0') {
			$this->db->insert('theme');
			$id = $this->db->insert_id();
			return $id;
		}	else {
			$this->db->where('id', $_POST['hid_theme_id']);
			$this->db->update('theme');

			return 1;
		}
	}

	public function doClearThemepdt() {
		$this->db->where('theme_id', $_POST['hid_theme_id']);

		$this->db->delete('mapping_theme_product');

		return 1;	
	}
	
	public function doAddThemepdt($pdt_id, $theme_id) {

		$ary_data = array(
			'theme_id'			=> $theme_id,
			'product_id'		=> $pdt_id
		);

		$this->db->set($ary_data);

		$this->db->insert('mapping_theme_product');

		return 1;	
	}

	public function getThemeShowNum() {

		$this->db->where('t.is_enable', '1');
		
		return $this->db->count_all_results('theme t');
	}

	public function getThemeDateIn() {

		$this->db->select('t.dt_exp_start, t.dt_exp_end');
		$this->db->where('t.is_enable', '1');
		$query = $this->db->get('theme t');

		return $query->result_array();
	}
}