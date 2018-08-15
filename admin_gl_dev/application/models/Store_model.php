<?php
/*
* File:			Store_model.php
* Version:		-
* Last changed:	2018/07/10
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Store_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	// public function doDelStore() {
	// 	$this->db->where('id', $_POST['id']);
	// 	$this->db->delete('store');

	// 	return 1;	
	// }

	public function doEditStore($store_id, $st_date, $ed_date) {

		$ary_data = array(
			'name'				=> $_POST['txt_store_name'], 
			'is_direct'			=> $_POST['rdo_is_direct'],
			'is_enable'			=> $_POST['rdo_is_enable'],
			'profit'			=> $_POST['txt_profit'],
			'dt_start'			=> $st_date,
			'dt_end'			=> $ed_date,
			'contact_name'		=> $_POST['txt_contact_name'],
			'contact_phone'		=> $_POST['txt_contact_phone'],
			'user_id'			=> $_POST['hid_user_id'],
			'pic_logo'			=> $_POST['hid_pic_logo'],
			'pic_banner'		=> $_POST['hid_pic_banner']
		);
		$this->db->set($ary_data);

		if ($store_id == '0') {
			$this->db->insert('store');
			$id = $this->db->insert_id();
			$this->insertProduct($id);
			$product_id = $this->getpdt_id($id);
			$this->insertProduct_spec($product_id[0]['id']);
			return 1;
		}	else {
			$this->db->where('id', $store_id);
			$this->db->update('store');
		
			if ($_POST['hid_org_profit'] != $_POST['txt_profit']) {
				$this->productProfit($store_id, $_POST['txt_profit']);
			}
			
			return 1;
		}
	}

	public function getpdt_id($store_id) {
		$this->db->select('id');

		$this->db->where('store_id', $store_id);
		$this->db->where('is_delivery', '1');

		$query = $this->db->get('product p');

		return $query->result_array();
	}

	public function insertProduct($store_id) {

		$ary_data = array(
			'store_id'			=> $store_id, 
			'name'				=> $store_id.'的運費',
			'price_origin'		=> '120',
			'price_cost'		=> '120',
			'price_deal'		=> '120',
			'currency'			=> '1',
			'status'			=> '1',
			'p_limit'			=> '0',
			'dt_end'			=> '9999-12-31 00:00:00',
			'source'			=> '1',
			'is_delivery'		=> '1',
			'is_showmain'		=> '0',
			'category_id'		=> '1'
		);

		$this->db->set($ary_data);
		$this->db->insert('product');

		return 1;	
	}

	public function productProfit($store_id, $profit) {

		$ary_data = array(
			'profit'			=> $profit
		);

		$this->db->set($ary_data);

		$this->db->where('store_id', $store_id);
		$this->db->update('product');

		return 1;
	}

	public function insertProduct_spec($product_id) {

		$ary_data = array(
			'product_id'		=> $product_id, 
			'spec_id'			=> '1',
			'quantity'			=> '65535',
			'show_limit'		=> '65535'
		);

		$this->db->set($ary_data);
		$this->db->insert('product_spec');

		return 1;	
	}

	public function getStore() {
		$this->db->select('s.*');

		$query = $this->db->get('store s');

		return $query->result_array();
	}

	public function get($store_id) {
		$this->db->select('s.*, u.id as user_id, u.name as user_name, u.mail as user_mail, u.login_type as user_login_type');
		$this->db->join('users u','u.id=s.user_id','left');

		$this->db->where('s.id', $store_id);
		$query = $this->db->get('store s');

		return $query->result_array();
	}

	public function getUserSearch() {
		$this->db->select('u.id, u.mail, u.login_type');
		$this->db->like('u.mail', $_POST['keyword'], 'after');
		$query = $this->db->get('users u');

		$query_ary = $query->result_array();

		if(count($query_ary) > 0) {
			foreach ($query_ary as $key => $val) {
				$login_type = '';
				switch ($val['login_type']) {
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
				$ary_pdt[$val['id']] = $val['mail'].' '.$login_type;
			}
		} else {
			$ary_pdt[0] = '沒有找到使用者';
		}
		return $ary_pdt;
	}
		
}