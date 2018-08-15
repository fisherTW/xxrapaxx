<?php
/*
* File:			Orders_model.php
* Version:		-
* Last changed:	2018/06/05
* Purpose:		-
* Author:		Orders
* Copyright:	(C) 2018
* Product:		myqgoods
*/
class Orders_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getMy() {
		$this->db->select('sum(osp.price_deal) as total, os.order_id as order_id, s.name as store_name, o.rec_name as rec_name, os.status_send as status_send, o.status_payment as status_payment, o.dt_create as dt_create, s.id as store_id');
		$this->db->join('store s','s.id=os.store_id','left');
		$this->db->join('orders o','o.order_id=os.order_id','left');
		$this->db->join('order_store_product osp','osp.order_id=os.order_id','left');
		$this->db->where('os.source', SOURCE_QGOODS);
		$this->db->where('s.id', $_SESSION['sess_store_id']);
		$this->db->group_by('os.order_id'); 

		$query = $this->db->get('order_store os');

		return $query->result_array();
	}

	//	output
	//	1: success
	public function doEdit() {
		$ary_data = array(
			'status_send'	=> $_POST['sel_status_send'],
			'dt_send'		=> date('Y-m-d H:i:s'),
			'dt_update'		=> date('Y-m-d H:i:s')
		);

		if($_POST['sel_status_send'] != SEND_STATUS_SEND) {
			unset($ary_data['dt_send']);
		}
		$this->db->set($ary_data);
		$this->db->where('order_id', $this->input->post('hid_order_id'));
		$this->db->where('store_id', $this->input->post('hid_store_id'));
		$this->db->update('order_store');

		return 1;
	}

	public function getOrderById($order_id, $store_id) {
		$this->db->select('o.*, p.name as project_name, os.store_id as store_id, os.status_send as status_send, os.descr as admin_descr, osp.price_deal as price_deal, osp.product_id as procuct_id, osp.quantity as quantity, pd.name as product_name, pd.url_pic as product_url_pic, pd.is_delivery as is_delivery, lt.trans_id as trans_id, lt.spg_PaymentType as paymenttype');
		$this->db->join('project p', 'p.id = osp.store_id', 'left');
		$this->db->join('product pd', 'pd.id = osp.product_id', 'left');
		$this->db->join('order_store os', 'os.order_id = osp.order_id', 'left');
		$this->db->join('orders o', 'o.order_id = osp.order_id', 'left');
		$this->db->join('log_trans lt', 'lt.order_id = o.order_id', 'left');
		$this->db->where('osp.order_id', $order_id);
		$this->db->where('os.store_id', $store_id);
		$this->db->where('osp.source', SOURCE_QGOODS);
		$query = $this->db->get('order_store_product osp');

		return $query->result_array();
	}

	public function getOrderMainById($order_id) {
		$this->db->where('o.order_id', $order_id);
		$query = $this->db->get('orders o');

		return $query->row_array();
	}

	public function getOrderStoreById($order_id, $store_id) {
		$this->db->where('os.order_id', $order_id);
		$this->db->where('os.store_id', $store_id);
		$query = $this->db->get('order_store os');

		return $query->row_array();
	}

	public function getOrderStoreProductById($order_id, $store_id) {
		$this->db->select('osp.*, pd.name as pd_name');
		$this->db->where('osp.order_id', $order_id);
		$this->db->where('osp.store_id', $store_id);
		$this->db->join('product pd', 'pd.id = osp.product_id', 'left');
		$query = $this->db->get('order_store_product osp');

		return $query->result_array();
	}

	
	
}