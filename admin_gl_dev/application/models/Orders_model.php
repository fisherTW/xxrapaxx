<?php
/*
* File:			Orders_model.php
* Version:		-
* Last changed:	2018/06/05
* Purpose:		-
* Author:		Orders
* Copyright:	(C) 2018
* Product:		admin_dev
*/
class Orders_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get($source) {
		$this->db->select('sum(osp.price_deal * osp.quantity) as total, os.order_id as order_id, os.store_id as store_id,p.name as p_name, os.rec_name as rec_name, os.status_send as status_send, o.status_payment as status_payment, o.dt_create as dt_create, p.id as p_id');
		$this->db->join('project p','p.id=os.store_id','left');
		$this->db->join('orders o','o.order_id=os.order_id','left');
		$this->db->join('order_store_product osp','osp.order_id=os.order_id','left');

		$this->db->where('os.source', $source);

 		$this->db->group_by('os.order_id, os.store_id'); 
		$query = $this->db->get('order_store os');
		
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$data[$key]['total'] = $this->getTotal($value['order_id'], $value['store_id']);
		}
		
		return $data;
	}

	public function getTotal($order_id, $store_id) {
		$this->db->select('sum(osp.price_deal * osp.quantity) as total');

		$this->db->where('osp.order_id', $order_id);
		$this->db->where('osp.store_id', $store_id);

		$query = $this->db->get('order_store_product osp');

		$data = $query->result_array();
		return $data[0]['total'];
	}

	public function getrefundById($order_id, $store_id) {
		$this->db->select('lr.*, u.name as user_name');
		$this->db->join('users u','u.id=lr.user_id','left');

		$this->db->where('lr.order_id', $order_id);
		$this->db->where('lr.store_id', $store_id);

		$query = $this->db->get('log_refund lr');

		return $query->result_array();;
	}

	public function getOrderById($order_id, $store_id) {
		$this->db->select('o.*, p.name as project_name, os.store_id as store_id, os.status_send as status_send, os.log_refund_id as log_refund_id, os.rec_name as rec_name, os.rec_phone as rec_phone, os.rec_addr as rec_addr, os.descr as descr, osp.price_deal as price_deal, osp.product_id as procuct_id, o.status_payment as status_payment, osp.quantity as quantity, pd.name as product_name, pd.url_pic as product_url_pic, pd.is_delivery as is_delivery');

		$this->db->join('project p', 'p.id = osp.store_id', 'left');
		$this->db->join('product pd', 'pd.id = osp.product_id', 'left');
		$this->db->join('order_store os', 'os.order_id = osp.order_id', 'left');
		$this->db->join('orders o', 'o.order_id = osp.order_id', 'left');
		
		$this->db->where('osp.order_id', $order_id);
		$this->db->where('osp.store_id', $store_id);
		$this->db->where('os.store_id', $store_id);

		$query = $this->db->get('order_store_product osp');

		return $query->result_array();
	}

	public function getTransByOrderId($order_id, $user_id) {
		$this->db->select('max(lt.id) as id');

		$this->db->where('lt.order_id', $order_id);
		$this->db->where('lt.user_id', $user_id);

		$query = $this->db->get('log_trans lt');

		$data = $query->result_array();
		return $this->getTransData($order_id, $user_id,$data[0]['id']);
	}

	public function getTransData($order_id, $user_id, $id) {
		$this->db->select('lt.trans_id as trans_id, lt.spg_PaymentType as paymenttype');

		$this->db->where('lt.order_id', $order_id);
		$this->db->where('lt.user_id', $user_id);
		$this->db->where('lt.id', $id);

		$query = $this->db->get('log_trans lt');

		return $query->result_array();
	}

	public function getUserById($user_id) {
		$this->db->select('u.name as user_name, ua.rec_addr as user_addr, ua.rec_phone as user_phone');
		$this->db->join('user_address ua', 'ua.user_id = u.id', 'left');
		$this->db->where('u.id', $user_id);
		$query = $this->db->get('users u');

		return $query->result_array();
	}
}