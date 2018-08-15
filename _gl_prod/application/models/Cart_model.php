<?php
/*
* File:			Cart_model.php
* Version:		-
* Last changed:	2018/05/16
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Cart_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function add() {
		$this->db->where('user_id', $_SESSION['sess_user_id']);
        $this->db->where('product_id', $this->input->post('hid_prod_id'));
        if($this->input->post('hid_source') == SOURCE_QGOODS) {
        	$this->db->where('spec_id', $this->input->post('sel_modal_spec'));
        }
        $this->db->delete('tmp_cart');

		$ary_product = array(
			'user_id'		=> $_SESSION['sess_user_id'], 
			'product_id'	=> $this->input->post('hid_prod_id'),
			'spec_id'		=> $this->input->post('sel_modal_spec'),
			'quantity'		=> $this->input->post('txt_quantity'),
			'source'		=> $this->input->post('hid_source'),
			'dt_create'		=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_product);
		$this->db->insert('tmp_cart');
		
		return 1;
	}


	public function getCartInfo($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('tmp_cart');

		return $query->result_array();
	}


	public function getCheckoutListByCart($ary_product) {
		$ary_ret = array();
		if(count($ary_product) >0) {		
			foreach($ary_product as $key => $val) {
				if($val['source'] == SOURCE_QMAKER) {
					$this->db->select('p.name, p.url_pic, spec.name as spec_name, p.price_deal, p.is_delivery, j.id as j_id, j.brand_name, j.brand_logo as brand_logo');
				} else {
					//補store的select
					$this->db->select('p.name, p.url_pic, spec.name as spec_name, p.price_deal, p.is_delivery, s.id as j_id, s.name as brand_name, s.pic_logo as brand_logo');
				}
				$this->db->join('product_spec ps', 'ps.product_id = p.id', 'left');
				$this->db->join('spec', 'spec.id = ps.spec_id', 'left');
				if($val['source'] == SOURCE_QMAKER) {
					$this->db->join('project j', 'j.id = p.store_id', 'left');
				} else {
					$this->db->join('store s', 's.id = p.store_id', 'left');
				}
				$this->db->where('p.id', $val['product_id']);
				$this->db->where('spec.id', $val['spec_id']);
				$query = $this->db->get('product p');
				$ary_q = $query->result_array();

				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['store_id']		= $ary_q[0]['j_id'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['store_name']	= $ary_q[0]['brand_name'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['brand_logo']	= $ary_q[0]['brand_logo'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['product_id']	= $val['product_id'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['product_name']	= $ary_q[0]['name'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['product_pic']	= $ary_q[0]['url_pic'];			
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['spec_id']		= $val['spec_id'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['spec_name']	= $ary_q[0]['spec_name'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['price_deal']	= $ary_q[0]['price_deal'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['quantity']		= $val['quantity'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['source']		= $val['source'];
				$ary_ret[$ary_q[0]['j_id']][$val['product_id'].'_'.$val['spec_id']]['is_delivery']	= $ary_q[0]['is_delivery'];	
			}
		}

//var_dump($ary_ret);
		return $ary_ret;
	}

}