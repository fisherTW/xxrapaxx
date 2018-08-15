<?php
/*
* File:			Orders_model.php
* Version:		-
* Last changed:	2018/06/05
* Purpose:		-
* Author:		Orders
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Orders_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getMy() {
		$this->db->select('sum(osp.price_deal) as total, os.order_id as order_id, p.name as project_name, o.rec_name as rec_name, os.is_send as is_send, o.status_payment as status_payment, o.dt_create as dt_create, p.id as project_id');
		$this->db->join('project p','p.id=os.store_id','left');
		$this->db->join('orders o','o.order_id=os.order_id','left');
		$this->db->join('order_store_product osp','osp.order_id=os.order_id','left');
		$this->db->where('p.user_id', $_SESSION['sess_user_id']);
         $this->db->group_by('os.order_id, os.store_id'); 
         
		$query = $this->db->get('order_store os');

		return $query->result_array();
	}

	//	output
	//	1: success
	public function doEdit() {
		$ary_data = array(
			'is_send'	=> $_POST['sel_is_send'],
			'descr'		=> $_POST['txt_descr'],
			'dt_update' => date('Y-m-d H:i:s')
		);

		$this->db->set($ary_data);
		$this->db->where('order_id', $this->input->post('hid_order_id'));
		$this->db->where('store_id', $this->input->post('hid_store_id'));
		$this->db->update('order_store');

		return 1;
	}

	public function getOrderById($order_id, $store_id) {
		$this->db->select('o.*, p.name as project_name, os.store_id as store_id, os.is_send as is_send, os.descr as admin_descr, osp.price_deal as price_deal, osp.product_id as procuct_id, pd.name as product_name');
		$this->db->join('project p', 'p.id = osp.store_id', 'left');
		$this->db->join('product pd', 'pd.id = osp.product_id', 'left');
		$this->db->join('order_store os', 'os.order_id = osp.order_id', 'left');
		$this->db->join('orders o', 'o.order_id = osp.order_id', 'left');
		$this->db->where('osp.order_id', $order_id);
		$this->db->where('os.store_id', $store_id);
		$query = $this->db->get('order_store_product osp');

		return $query->result_array();
	}
}