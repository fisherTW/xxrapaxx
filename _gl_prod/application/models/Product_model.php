<?php
/*
* File:			Product_model.php
* Version:		-
* Last changed:	2018/05/15
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Product_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function search($word, $page=0) {
		$this->db->like('name', $word, 'both');
		$this->db->where('status', 1);
		$this->db->where('source', SOURCE_QGOODS);
		$this->db->where('status', 1);
		$this->db->where('dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_end >',date('Y-m-d H:i:s')); 
		if($page != 0){
			$this->db->limit(12);
			$this->db->offset(($page -1) * 12);
		}		
		$this->db->order_by('dt_create', 'DESC');
		$query = $this->db->get('product');

		return $query->result_array();
	}	

	public function getProductByProjectId($project_id, $source) {
		$this->db->select('p.*, ps.quantity, ps.show_limit, pr.dt_exp_end, pr.dt_exp_start');
		$this->db->join('(SELECT product_id, quantity, show_limit FROM product_spec GROUP BY product_id) ps', 'ps.product_id = p.id', 'left');
		$this->db->join('project pr', 'pr.id = p.store_id', 'left');
		$this->db->where('p.store_id', $project_id);
		$this->db->where('p.source', $source);
		$this->db->where('p.status', 1);
		$this->db->where('p.is_delivery', 0);
		$query = $this->db->get('product p');
		$ary_res = $query->result_array();

		for ($i=0; $i < count($ary_res); $i++) { 
			$ary_res[$i]['spec'] = $this->getSpecByProductId($ary_res[$i]['id']);
		}
		return $ary_res;
	}

	// return: JSON
	public function getSpecByProductId($product_id) {
		$ary_ret = array();

		$this->db->select('sp.id as id, sp.name as name');
		$this->db->join('spec sp', 'sp.id=ps.spec_id', 'left');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('product_spec ps');
		$ary_res = $query->result_array();

		for($i=0; $i < count($ary_res); $i++) {
			$ary_ret[$ary_res[$i]['id']] = $ary_res[$i]['name'];
		}

		return json_encode($ary_ret);
	}

	public function getDeliveryProductByStoreId($store_id, $source) {
		$this->db->select('id, name, price_deal');
		$this->db->where('store_id', $store_id);
		$this->db->where('is_delivery', 1);
		$this->db->where('status', 1);
		$this->db->where('source', $source);		
		$query = $this->db->get('product');

		return $query->result_array();
	}

	public function getCategory($parent = 0) {
		$ary_ret = array();

		$this->db->select('id, name');
		$this->db->where('parent', $parent);
		$query = $this->db->get('mapping_goods_category');

		$ary_tmp = $query->result_array();

		if(count($ary_tmp) > 0) {
			foreach ($ary_tmp as $val) {
				$ary_ret[$val['id']] = $val['name'];
			}
		}

		return $ary_ret;		
	}

	public function getProductQuantityTotal($product_id) {
		$this->db->select('sum(quantity) as quantity_total');
		$this->db->join('orders o', 'o.order_id=osp.order_id', 'left');
		$this->db->where('o.status_payment', PAYMENT_SUCCESS);
		$this->db->where('osp.product_id', $product_id);
		$query = $this->db->get('order_store_product osp');
		$row = $query->row();

		return $row->quantity_total;
	}

	// $minus_quantity: 要扣的量，正值
	// output: bool
	public function setQuantity($product_id, $spec_id, $minus_quantity) {
		$this->db->select('quantity');
		$this->db->where('product_id', $product_id);
		$this->db->where('spec_id', $spec_id);
		$query = $this->db->get('product_spec');
		$quantity_before = $query->row()->quantity;

		if($quantity_before < $minus_quantity) { 
			return false;
		}

		$ary_set = array(
			'quantity'			=> (intval($quantity_before) - intval($minus_quantity))
		);

		$this->db->set($ary_set);
		$this->db->where('product_id', $product_id);
		$this->db->where('spec_id', $spec_id);
		$this->db->update('product_spec');

		return true;
	}

	public function getProductTotalByStoreId($id, $source) {
		$this->db->where('store_id', $id);
		$this->db->where('source', $source);
		$this->db->where('status', 1);

		return $this->db->count_all_results('product');
	}

	public function getProductById($id) {
		$this->db->select('p.* , p.name as product_name, s.id as store_id, s.name as store_name, s.pic_logo as store_pic_logo');
		$this->db->join('store s', 's.id=p.store_id', 'left');
		$this->db->where('p.id', $id);
		$query = $this->db->get('product p');

		return $query->row_array();
	}

	public function getAvailableProductById($id) {
		$this->db->select('p.* , p.name as product_name, p.is_18 as product_is_18, s.id as store_id, s.name as store_name, s.pic_logo as store_pic_logo');
		$this->db->join('store s', 's.id=p.store_id', 'left');
		$this->db->where('p.id', $id);
		$this->db->where('p.source', SOURCE_QGOODS);
		$this->db->where('p.dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('p.dt_end >',date('Y-m-d H:i:s')); 
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);
		$query = $this->db->get('product p');

		return $query->row_array();
	}	

	public function getAll($page=1, $source) {
		$this->db->where('is_delivery', 0);
		$this->db->where('source', $source);
  		$this->db->where('status', 1);
		$this->db->order_by('dt_update', 'DESC');
		$this->db->limit(12);
		$this->db->offset(($page -1) * 12);
		$query = $this->db->get('product');

		return $query->result_array();
	}

	public function getProductCount() {
		$this->db->where('p.source', SOURCE_QGOODS);
		$this->db->where('p.dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('p.dt_end >',date('Y-m-d H:i:s')); 
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);

		return $this->db->count_all_results('product p');
	}

	public function getProductCountByStoreId($store_id) {
		$this->db->where('p.store_id', $store_id);
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);

		return $this->db->count_all_results('product p');
	}	

	public function getSeesee() {
		$this->db->select('p.id, p.name, p.detail, p.url_youtube, p.price_deal, s.name as s_name');
		$this->db->join('store s', 's.id=p.store_id', 'left');
		$this->db->order_by('p.dt_create', 'DESC');
		$this->db->where('p.is_showmain', 1);
		$this->db->where('p.source', SOURCE_QGOODS);
		$this->db->where('p.status', 1);
		$this->db->where('p.dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('p.dt_end >',date('Y-m-d H:i:s')); 
		$query = $this->db->get('product p');

		return $query->result_array();
	}

	public function getNew() {
		$this->db->select('p.id, p.name, p.detail, p.url_youtube, p.url_pic, p.price_deal, s.name as s_name, s.id as s_id');
		$this->db->join('store s', 's.id=p.store_id', 'left');
		$this->db->order_by('p.dt_create', 'DESC');
		$this->db->where('p.source', SOURCE_QGOODS);
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);
		$this->db->where('p.dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('p.dt_end >',date('Y-m-d H:i:s')); 
		$this->db->limit(8);
		$query = $this->db->get('product p');

		return $query->result_array();
	}	


	public function getHot($ary_hot) {
		$this->db->select('p.id, p.name, p.detail, p.url_youtube, p.url_pic, p.price_deal, s.name as s_name, s.id as s_id');
		$this->db->join('store s', 's.id=p.store_id', 'left');
		$this->db->where('p.source', SOURCE_QGOODS);
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);
		$this->db->where('p.dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('p.dt_end >',date('Y-m-d H:i:s')); 
//		$this->db->order_by('p.dt_create', 'DESC');
// fake start
		//$this->db->where_in('p.id', array(815,1584,383,2266,1548,2600,2824,1572,963,1585));
// fake end
		$this->db->where_in('p.id', $ary_hot);
		$this->db->limit(10);
		$query = $this->db->get('product p');

		return $query->result_array();
	}	

	public function getProductspecById($product_id) {
		$this->db->select('ps.spec_id, ps.quantity, s.name, s.color, s.size');
		$this->db->join('spec s', 's.id=ps.spec_id', 'left');
		$this->db->where('ps.product_id', $product_id);
		$query = $this->db->get('product_spec ps');

		return $query->result_array();
	}

	public function getProductByStoreId($store_id, $category_id, $filter, $page) {
		$this->db->select('p.*');
		$this->db->where('p.store_id', $store_id);
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);		

		if($category_id != 0) {
			$this->db->where('p.category_id', $category_id);
		}
		switch ($filter) {
			case '1':	// 最新上架
			default:
				$this->db->order_by('dt_update', 'DESC');
				break;
			case '2':	// 價格高至低
				$this->db->order_by('price_deal', 'DESC');
				break;
			case '3':	// 價格低至高
				$this->db->order_by('price_deal', 'ASC');
				break;
		}
		$count = $this->db->count_all_results('product p');

		$this->db->select('p.*');
		$this->db->where('p.store_id', $store_id);
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);		
		if($category_id != 0) {
			$this->db->where('p.category_id', $category_id);
		}
		switch ($filter) {
			case '1':	// 最新上架
			default:
				$this->db->order_by('dt_update', 'DESC');
				break;
			case '2':	// 價格高至低
				$this->db->order_by('price_deal', 'DESC');
				break;
			case '3':	// 價格低至高
				$this->db->order_by('price_deal', 'ASC');
				break;
		}
		$this->db->limit(12);
		$this->db->offset(($page -1) * 12);
		$query = $this->db->get('product p');

		return array($count, $query->result_array());
	}

	public function getProduct($category_id, $filter, $page) {
		if($category_id != 0) {
			$ary_tmp = $this->Product_model->getCategory($category_id);
			$ary_sub_cat = array_keys($ary_tmp);
			array_push($ary_sub_cat, $category_id);
		}

		$this->db->select('p.*, s.name as store_name');
		$this->db->join('store s', 'p.store_id=s.id');
		$this->db->where('p.source', SOURCE_QGOODS);
		$this->db->where('p.dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('p.dt_end >',date('Y-m-d H:i:s')); 
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);
		if($category_id != 0) {
			//$this->db->where('p.category_id', $category_id);
			$this->db->where_in('p.category_id', $ary_sub_cat);
		}
		switch ($filter) {
			case '1':	// 最新上架
			default:
				$this->db->order_by('dt_update', 'DESC');
				break;
			case '2':	// 價格高至低
				$this->db->order_by('price_deal', 'DESC');
				break;
			case '3':	// 價格低至高
				$this->db->order_by('price_deal', 'ASC');
				break;
		}
		$count = $this->db->count_all_results('product p');

		$this->db->select('p.*, s.name as store_name');
		$this->db->join('store s', 'p.store_id=s.id');
		$this->db->where('p.source', SOURCE_QGOODS);
		$this->db->where('p.dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('p.dt_end >',date('Y-m-d H:i:s')); 
		$this->db->where('p.is_delivery', 0);
		$this->db->where('p.status', 1);		
		if($category_id != 0) {
			//$this->db->where('p.category_id', $category_id);
			$this->db->where_in('p.category_id', $ary_sub_cat);
		}
		switch ($filter) {
			case '1':	// 最新上架
			default:
				$this->db->order_by('dt_update', 'DESC');
				break;
			case '2':	// 價格高至低
				$this->db->order_by('price_deal', 'DESC');
				break;
			case '3':	// 價格低至高
				$this->db->order_by('price_deal', 'ASC');
				break;
		}
		$this->db->limit(12);
		$this->db->offset(($page -1) * 12);
		$query = $this->db->get('product p');

		return array($count, $query->result_array());
	}	

	public function getProductPicByStoreId($store_id) {
		$this->db->select('url_pic');
		$this->db->where('url_pic !=', NULL);
		$this->db->where('store_id', $store_id);
		$this->db->where('is_delivery', 0);
		$this->db->where('status', 1);
		$this->db->where('source', SOURCE_QGOODS);
		$this->db->where('dt_start <',date('Y-m-d H:i:s')); 
		$this->db->where('dt_end >',date('Y-m-d H:i:s')); 
		$this->db->limit(3);
		$this->db->order_by('dt_update', 'DESC');

		$query = $this->db->get('product');

		return $query->result_array();
	}
}