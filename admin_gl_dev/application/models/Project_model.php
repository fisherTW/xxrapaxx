<?php
/*
* File:			Project_model.php
* Version:		-
* Last changed:	2018/04/11
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Project_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	//	output
	//	1: success
	public function createProduct() {
		if(count($this->getProduct($_POST['hid_project_id'])) == 0) {
			$this->createProductDelivery();
		}

		$ary_data = array(
			'store_id'			=> $_POST['hid_project_id'], 
			'name'				=> $_POST['xt_name'], 
			'detail'			=> $_POST['txt_detail'], 
			'price_origin'		=> $_POST['txt_price_origin'], 
			'price_cost'		=> $_POST['txt_price_origin'], 
			'price_deal'		=> $_POST['txt_price_origin'], 
			'url_pic'			=> $_POST['hid_url_pic'], 
			'p_limit'			=> 0, 
			'source'			=> SOURCE_QMAKER, 
			'dt_end'			=> $_POST['txt_dt_end'], 
			'dt_create'			=> date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);
		$this->db->insert('product');

		$this->addProductSpec($this->db->insert_id(), $_POST['txt_quantity']);

		return 1;		
	}

	//	output
	//	1: success
	public function createProductDelivery() {
		$ary_data = array(
			'store_id'			=> $_POST['hid_project_id'], 
			'name'				=> $_POST['hid_project_id'].' 的運費', 
			'price_origin'		=> 0, 
			'price_cost'		=> 0, 
			'price_deal'		=> 0, 
			'p_limit'			=> 0, 
			'is_delivery'		=> 1, 
			'source'			=> SOURCE_QMAKER, 
			'dt_end'			=> '9999-12-31', 
			'dt_create'			=> date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);
		$this->db->insert('product');

		$this->addProductSpec($this->db->insert_id(), 65535);

		return 1;		
	}	

	public function addProductSpec($product_id, $quantity) {
		$ary_data = array(
			'product_id'	=> $product_id, 
			'quantity'		=> $quantity,
			'spec_id'		=> 1
		);

		$this->db->set($ary_data);
		$this->db->insert('product_spec');

		return 1;	
	}

	
	//	output
	//	1: success
	public function doEditBrand() {
		$ary_data = array(
			'brand_name'				=> $_POST['txt_brand_name'], 
			'brand_logo'				=> $_POST['hid_brand_logo'], 
			'brand_profile'				=> $_POST['txt_brand_profile']
		);
		$this->db->set($ary_data);

		$this->db->where('id', $_POST['hid_project_id']);
		$this->db->update('project');

		return 1;		
	}

	//	output
	//	1: success
	public function cuFaq() {
		$ary_data = array(
			'p_id'				=> $_POST['hid_project_id'], 
			'q'					=> $_POST['txt_q'], 
			'a'					=> $_POST['txt_a'], 
			'dt_create'			=> date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);

		if(strval($_POST['hid_faq_id']) == '0') {
			$this->db->insert('faq');
		} else {
			$this->db->where('id', $_POST['hid_faq_id']);
			$this->db->update('faq');
		}

		return 1;		
	}

	//	output
	//	1: success
	public function edit_2_1() {
		$ary_data = array(
			'detail'				=> $_POST['txt_project_detail']
		);
		$this->db->set($ary_data);

		$this->db->where('id', $_POST['hid_project_id']);
		$this->db->update('project');

		return 1;		
	}

	//	output
	//	1: success
	public function edit_a_1() {
		$ary_data = array(
			'status'				=> $_POST['sel_status'],
			'is_enable'				=> $_POST['rdo_is_enable'],
			'is_recommend'			=> $_POST['rdo_is_recommend']
		);
		$this->db->set($ary_data);

		$this->db->where('id', $_POST['hid_project_id']);
		$this->db->update('project');

		return 1;		
	}
	
	//	output
	//	1: success
	public function edit_a_1_1($id, $status) {
		$ary_data = array(
			'status'					=> $status
		);
		$this->db->set($ary_data);

		$this->db->where('id', $id);
		$this->db->update('product');
	}

	//	output
	//	1: success
	public function doDelFaq() {
		$this->db->where('id', $_POST['id']);
		$this->db->delete('faq');

		return 1;		
	}	

	public function getMyProject() {
		$this->db->select('p.*, mpc.name as mpc_name');
		$this->db->join('mapping_project_category mpc','mpc.id=p.category_id','left');
		$this->db->where('user_id', $_SESSION['sess_user_id']);
		$this->db->limit(100);
		$query = $this->db->get('project p');

		return $query->result_array();
	}

	public function getProject() {
		$this->db->select('p.*, mpc.name as mpc_name');
		$this->db->join('mapping_project_category mpc','mpc.id=p.category_id','left');
		$query = $this->db->get('project p');

		return $query->result_array();
	}	

	public function getProduct($project_id) {
		$ary_ret = array();
		$ary_where = array(
			'source'		=> SOURCE_QMAKER,
			'store_id'		=> $project_id,
			'is_delivery'	=> 0
		);
		$this->db->where($ary_where);
		$this->db->limit(100);
		$query = $this->db->get('product');
		$ary_tmp = $query->result_array();

		if(count($ary_tmp) > 0) {
			foreach ($ary_tmp as $key => $value) {
				$ary_ret[$key] = $value;
				$ary_ret[$key]['spec'] = $this->getSpec($value['id']);
			}
		}

		return $ary_ret;
	}

	public function getSpec($product_id) {
		$ary_where = array(
			'product_id'	=> $product_id
		);
		$this->db->select('spec.name as spec_name, ps.quantity');
		$this->db->join('spec', 'spec.id=ps.spec_id', 'left');
		$this->db->where($ary_where);
		$query = $this->db->get('product_spec ps');

		return $query->result_array();
	}

	public function getFaq($project_id) {
		$ary_where = array(
			'p_id'	=> $project_id
		);
		$this->db->where($ary_where);
		$this->db->limit(100);
		$query = $this->db->get('faq');

		return $query->result_array();
	}			

	public function getProductStatus($project_id) {
		$this->db->select('pdt.id as pdt_id, pdt.name as pdt_name, pdt.url_pic as pdt_url_pic, pdt.status as pdt_status, pdt.price_deal as pdt_price_deal');
		
		$this->db->where('pdt.store_id', $project_id);
		$this->db->where('pdt.is_delivery', '0');
		$this->db->where('pdt.source', SOURCE_QMAKER);

		$query = $this->db->get('product pdt');

		return $query->result_array();
	}	

	public function get($project_id) {
		$this->db->select('p.*, mpc.name as mpc_name');
		$this->db->join('mapping_project_category mpc','mpc.id=p.category_id','left');
		$this->db->where('p.id', $project_id);
		$query = $this->db->get('project p');

		return $query->result_array();
	}	
}