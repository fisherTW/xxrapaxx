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
		if(count($this->getProduct($this->input->post('hid_project_id'))) == 0) {
			$this->createProductDelivery();
		}

		$ary_data = array(
			'store_id'			=> $this->input->post('hid_project_id'), 
			'name'				=> $this->input->post('txt_name'), 
			'detail'			=> $this->input->post('txt_detail'), 
			'price_origin'		=> $this->input->post('txt_price_origin'), 
			'price_cost'		=> $this->input->post('txt_price_origin'), 
			'price_deal'		=> $this->input->post('txt_price_origin'), 
			'url_pic'			=> $this->input->post('hid_url_pic'), 
			'p_limit'			=> 0, 
			'source'			=> SOURCE_QMAKER,
			'status'			=> 0, 
			'dt_create'			=> date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);

		if(strval($this->input->post('hid_product_id')) == '0') {
			$this->db->insert('product');
			$this->addProductSpec($this->db->insert_id(), $this->input->post('txt_quantity'), $this->input->post('txt_show_limit'));
		} else {
			unset($ary_data['dt_create']);
			$this->db->where('id', $this->input->post('hid_product_id'));
			$this->db->update('product');
			$this->editProductSpec($this->input->post('hid_product_id'), $this->input->post('txt_quantity'), $this->input->post('txt_show_limit'));			
		}

		return 1;		
	}


	public function editProjectSattus() {
		$this->db->set('status', PROJECT_STATUS_2_SEND);
		$this->db->where('id', $this->input->post('hid_project_id'));
		$this->db->update('project');

		return 1;		
	}

	public function doDelProduct() {
		$this->db->where('id', $this->input->post('id'));
		$this->db->delete('product');

		return 1;
	}

	//	output
	//	1: success
	public function createProductDelivery() {
		$ary_data = array(
			'store_id'			=> $this->input->post('hid_project_id'), 
			'name'				=> $this->input->post('hid_project_id').' 的運費', 
			'price_origin'		=> 0, 
			'price_cost'		=> 0, 
			'price_deal'		=> 0, 
			'p_limit'			=> 0, 
			'is_delivery'		=> 1, 
			'status'			=> 1, 
			'source'			=> SOURCE_QMAKER, 
			'dt_end'			=> '9999-12-31', 
			'dt_create'			=> date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);
		$this->db->insert('product');

		$this->addProductSpec($this->db->insert_id(), 65535, 65535);

		return 1;		
	}	

	public function addProductSpec($product_id, $quantity, $show_limit) {
		$ary_data = array(
			'product_id'	=> $product_id, 
			'quantity'		=> $quantity,
			'show_limit'	=> $show_limit,
			'spec_id'		=> 1
		);

		$this->db->set($ary_data);
		$this->db->insert('product_spec');

		return 1;	
	}

	public function editProductSpec($product_id, $quantity, $show_limit) {
		$ary_data = array(
			'quantity'		=> $quantity,
			'show_limit'	=> $show_limit,
		);

		$this->db->set($ary_data);
		$this->db->where('product_id', $product_id);
		$this->db->update('product_spec');

		return 1;
	}

	//	output
	//	1: success
	public function doEditBrand() {
		$ary_data = array(
			'brand_name'				=> $this->input->post('txt_brand_name'), 
			'brand_logo'				=> $this->input->post('hid_brand_logo'), 
			'brand_profile'				=> $this->input->post('txt_brand_profile')
		);
		$this->db->set($ary_data);

		$this->db->where('id', $this->input->post('hid_project_id'));
		$this->db->update('project');

		return 1;		
	}

	//	output
	//	1: success
	public function cuFaq() {
		$ary_data = array(
			'p_id'				=> $this->input->post('hid_project_id'), 
			'q'					=> $this->input->post('txt_q'), 
			'a'					=> $this->input->post('txt_a'), 
			'dt_create'			=> date('Y-m-d H:i:s')
		);
		$this->db->set($ary_data);

		if(strval($this->input->post('hid_faq_id')) == '0') {
			$this->db->insert('faq');
		} else {
			$this->db->where('id', $this->input->post('hid_faq_id'));
			$this->db->update('faq');
		}

		return 1;		
	}

	//	output
	//	1: success
	public function edit_2_1() {
		$ary_data = array(
			'detail' => $this->input->post('txt_project_detail')
		);
		$this->db->set($ary_data);

		$this->db->where('id', $this->input->post('hid_project_id'));
		$this->db->update('project');

		return 1;		
	}
	

	//	output
	//	1: success
	public function doDelFaq() {
		$this->db->where('id', $this->input->post('id'));
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
				$ary_ret[$key]['show_limit'] = $this->getSpec($value['id']);
			}
		}

		return $ary_ret;
	}

	public function getSpec($product_id) {
		$ary_where = array(
			'product_id'	=> $product_id
		);
		$this->db->select('spec.name as spec_name, ps.quantity, ps.show_limit');
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

	public function get($project_id) {
		$this->db->select('p.*, mpc.name as mpc_name');
		$this->db->join('mapping_project_category mpc','mpc.id=p.category_id','left');
		$this->db->where('p.id', $project_id);
		$this->db->where('p.user_id', $_SESSION['sess_user_id']);
		$this->db->limit(100);
		$query = $this->db->get('project p');

		return $query->result_array();
	}	
}