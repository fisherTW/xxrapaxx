<?php
/*
* File:			Goods_model.php
* Version:		-
* Last changed:	2018/07/12
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Goods_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getProducts() {

//https://dev-admin.rapaq.com/goods/getProduct?search=&sort=id&order=desc&offset=0&limit=10
		$cri_limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$cri_offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$cri_order = isset($_GET['order']) ? $_GET['order'] : 'asc';
		$cri_sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';

		$cri_search = isset($_GET['search']) ? $_GET['search'] : '';

		$this->db->select('p.id, p.name, p.url_pic, p.price_deal, p.status, p.dt_start, p.dt_end, s.name as store_name');
		$this->db->join('store s','s.id=p.store_id','left');


		$ary_where = array(
			'p.source'		=> SOURCE_QGOODS,
			'p.is_delivery'	=> '0'
		);

		
		if ($cri_search != '') {

			$this->db->group_start();
			$this->db->like('p.name', $cri_search, 'both');
			$this->db->or_like('p.id', $cri_search, 'both');
			$this->db->or_like('s.name', $cri_search, 'both');
			$this->db->group_end();

		}

		$this->db->where($ary_where);

		$this->db->limit($cri_limit);
		$this->db->offset($cri_offset);
		$this->db->order_by($cri_sort, $cri_order);

		$query = $this->db->get('product p');

		return $query->result_array();
	}

	public function countProducts() {

		$cri_search = isset($_GET['search']) ? $_GET['search'] : '';
		$this->db->join('store s','s.id=p.store_id','left');
		$ary_where = array(
			'p.source'		=> SOURCE_QGOODS,
			'p.is_delivery'	=> '0'
		);

		
		if ($cri_search != '') {
			$this->db->group_start();
			$this->db->like('p.name', $cri_search, 'both');
			$this->db->or_like('p.id', $cri_search, 'both');
			$this->db->or_like('s.name', $cri_search, 'both');
			$this->db->group_end();
		}

		$this->db->where($ary_where);
		
		return $this->db->count_all_results('product p');
	}

	public function getProductSpec($id) {
		$this->db->select('spec.name as spec_name, pdt_s.*');
		$this->db->join('product_spec pdt_s','pdt_s.product_id=p.id','left');
		$this->db->join('spec spec','spec.id=pdt_s.spec_id','left');

		$this->db->where('p.id', $id);
		$query = $this->db->get('product p');

		return $query->result_array();
	}

	public function get($product_id) {
		$this->db->select('p.*');
		$this->db->where('p.id', $product_id);
		$query = $this->db->get('product p');

		return $query->result_array();
	}	
}