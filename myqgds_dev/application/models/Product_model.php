<?php
/*
* File:			Product_model.php
* Version:		-
* Last changed:	2018/07/05
* Purpose:		-
* Author:		product
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Product_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getProductByStoreId($is_delivery, $store_id) {		 
		$this->db->select('p.*, c.name as category_name');
		$this->db->join('mapping_goods_category c', 'c.id=p.category_id', 'left');
		$this->db->where('p.store_id', $store_id);
		$this->db->where('p.is_delivery', $is_delivery);
		$this->db->where('p.source', SOURCE_QGOODS);
		$query = $this->db->get('product p');

		return $query->result_array();
	}

	public function getProductById($product_id) {
		$this->db->select('u.name as pm_name, p.*, p.category_id as category_son_id');
		$this->db->join('users u', 'u.id=p.pm_id', 'left');
		$this->db->where('p.id', $product_id);
		$query = $this->db->get('product p');

		return $query->row_array();		
	}

	public function doEdit($is_delivery, $store_id, $dt_start, $dt_end) {
		if($is_delivery == 1) {
			$ary_data = array(
				'store_id'		=> $store_id,
				'name'			=> $this->input->post('txt_name'),
				'price_origin'	=> $this->input->post('txt_price'),
				'price_cost'	=> $this->input->post('txt_price'),
				'price_deal'	=> $this->input->post('txt_price'),
				'dt_end'		=> '9999-12-31 00:00:00',
				'source'		=> SOURCE_QGOODS,
				'is_delivery'	=> 1,
				'category_id'	=> 0,
				'dt_create'		=> date('Y-m-d H:i:s'),
				'dt_update'		=> date('Y-m-d H:i:s')
			);
		} else {
			$ary_data = array(
				'store_id'			=> $store_id,
				'name'				=> $this->input->post('txt_name'),
				'category_id'		=> $this->input->post('sel_category_son'),
				'is_prebuy'			=> $this->input->post('sel_is_prebuy'),
				'brand_id'			=> $this->input->post('sel_brand_id'),
				'is_18'				=> $this->input->post('rdo_is_18'),
				'is_couponable'		=> $this->input->post('rdo_is_couponable'),
				'dt_start'			=> $dt_start,
				'dt_end'			=> $dt_end,
				'pm_id'				=> $this->input->post('hid_pm_id'),
				'supplier_id'		=> $this->input->post('sel_supplier_id'),
				'url_pic'			=> $this->input->post('hid_filepath'),
				'url_pic2'			=> $this->input->post('hid_filepath2'),
				'url_youtube'		=> $this->input->post('txt_url_youtube'),
				'profit'			=> $this->input->post('txt_profit'),
				'currency'			=> $this->input->post('sel_currency'),
				'price_origin'		=> $this->input->post('txt_price_origin'),
				'price_cost'		=> $this->input->post('txt_price_cost'),
				'price_deal'		=> $this->input->post('txt_price_deal'),
				'p_limit'			=> $this->input->post('txt_p_limit'),
				'store_category_id'	=> $this->input->post('rdo_store_category_id'),
				'source'			=> SOURCE_QGOODS,
				'og_title'			=> $this->input->post('txt_og_title'),
				'og_descr'			=> $this->input->post('txt_og_descr'),
				'dt_create'			=> date('Y-m-d H:i:s'),
				'dt_update'			=> date('Y-m-d H:i:s')
			);
		}

		if(strval($this->input->post('hid_id')) == '0') {
			$this->db->set($ary_data);
			$this->db->insert('product');
			$id = $this->db->insert_id();			
		} else {
			unset($ary_data['dt_create']);
			$this->db->set($ary_data);
			$this->db->where('id', $this->input->post('hid_id'));
			$this->db->update('product');
			$id = $this->input->post('hid_id');
		}

		if($is_delivery == 0) {
			$this->productSpecdoEdit($id);
		}
		return 1;
	}

	public function productSpecdoEdit($id) {
		$ary_sel_spec		= $this->input->post('sel_spec');
		$ary_txt_quantity	= $this->input->post('txt_quantity');

		for($i=0; $i < count($ary_txt_quantity); $i++) {
			$ary_data = array(
				'product_id'=> $id,
				'spec_id'	=> $ary_sel_spec[$i],
				'quantity'	=> $ary_txt_quantity[$i],
			);

			$this->db->where('product_id', $id);
			$this->db->where('spec_id', $ary_sel_spec[$i]);
			$query = $this->db->get('product_spec');
			$ary_cou = $query->result_array();
			if(count($ary_cou) >0) {
				$this->db->set($ary_data);
				$this->db->where('product_id', $id);
				$this->db->update('product_spec');
			} else {
				$this->db->set($ary_data);
				$this->db->insert('product_spec');				
			}
		}
	}

	public function getProductSpecByProductId($product_id) {
		$this->db->select('ps.id, ps.spec_id, ps.quantity, s.name');
		$this->db->join('spec s', 's.id=ps.spec_id', 'left');
		$this->db->where('ps.product_id', $product_id);
		$query = $this->db->get('product_spec ps');

		return $query->result_array();
	}

	public function getCategory($store_id=0) {
		$ary_ret = array();
		if($store_id == 0) {
			$this->db->where('store_id', NULL);
		} else {
			$this->db->where('store_id', $store_id);
		}
		$this->db->where('parent', 0);
		$this->db->order_by('id', 'asc'); 
		$query = $this->db->get('mapping_goods_category');
		$ary_cou = $query->result_array();

		if(count($ary_cou) > 0) {
			if($store_id == 0) {
				foreach ($ary_cou as $key => $val) {
					$ary_ret[$val['id']] = $val['name'];
				}
			} else {
				foreach ($ary_cou as $key => $val) {
					$this->db->where('parent', $val['id']);
					$this->db->order_by('id', 'asc'); 
					$query = $this->db->get('mapping_goods_category');
					$ary_data = $query->result_array();

					if(count($ary_data) >0) {
						foreach ($ary_data as $k => $v) {
							$ary_ret[$val['name']][$v['id']]['id'] = $v['id'];
							$ary_ret[$val['name']][$v['id']]['name'] = $v['name'];
						}
					}					
				}				
			}
		}
//var_dump($ary_ret);
		return $ary_ret;
	}

	public function getCategoryByParent($parent) {
		$ary_ret = array();

		$this->db->where('parent', $parent);
		$query = $this->db->get('mapping_goods_category');
		$ary_cou = $query->result_array();
		if(count($ary_cou) > 0) {
			foreach ($ary_cou as $key => $val) {
				$ary_ret[$val['id']] = $val['name'];
			}
		}

		return $ary_ret;
	}

	public function getCategoryById($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('mapping_goods_category');

		return $query->row_array();		
	}


	public function getBrandByStoreId($store_id) {
		$this->db->where('store_id', $store_id);
		$query = $this->db->get('product_brand');

		return $query->result_array();
	}

	public function brandDoEdit($store_id) {
		$ary_data = array(
			'store_id'	=> $store_id,
			'name'		=> $this->input->post('txt_name')
		);

		if(strval($this->input->post('hid_id')) == '0') {
			$this->db->set($ary_data);
			$this->db->insert('product_brand');
		} else {
			unset($ary_data['store_id']);
			$this->db->set($ary_data);
			$this->db->where('id', $this->input->post('hid_id'));
			$this->db->update('product_brand');
		}

		return 1;
	}

	public function brandDoDel($id) {
		$this->db->where('id', $id);
		$this->db->delete('product_brand');

		return 1;
	}
}