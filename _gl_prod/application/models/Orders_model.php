<?php
/*
* File:			Orders_model.php
* Version:		-
* Last changed:	2018/05/25
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Orders_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getOrder($order_id) {
		$this->db->where('order_id', $order_id);
		$query = $this->db->get('orders');

		return $query->row_array();
	}

	public function orders_doEdit($user_id) {
		$order_user = str_pad($user_id,10,'0',STR_PAD_LEFT);
		$where_order_id = date('Ymd').$order_user;
		$this->db->like('order_id', $where_order_id, 'after');
		$this->db->from('orders');
		$count_order = $this->db->count_all_results();

		if($count_order > 0) {
			$count_order ++;
			$order_user = str_pad($count_order,2,'0',STR_PAD_LEFT);
			$order_id = $where_order_id.$order_user;
		} else {
			$order_id = $where_order_id.'01';
		}

		//insert order_store_product
		$ary_prod_id = $_POST['ary_prod_id'];
		for($i=0; $i < count($ary_prod_id); $i++) {
			$ary_order_product[$i]['order_id']		= $order_id;
			$ary_order_product[$i]['product_id']	= $ary_prod_id[$i]['prod_id'];
			$ary_order_product[$i]['quantity']		= $ary_prod_id[$i]['quantity'];
			$ary_order_product[$i]['store_id']		= $ary_prod_id[$i]['store_id'];
			$ary_order_product[$i]['source']		= $ary_prod_id[$i]['source'];
			$ary_order_product[$i]['spec_id']		= $ary_prod_id[$i]['spec_id'];
			$ary_order_product[$i]['is_delivery']	= $ary_prod_id[$i]['is_delivery'];

			$this->db->select('price_origin, price_cost, price_deal');
			$this->db->where('id', $ary_prod_id[$i]['prod_id']);
			$query = $this->db->get('product');
			$ary_product = $query->row_array();

			$ary_order_product[$i]['price_origin']	= $ary_product['price_origin'];
			$ary_order_product[$i]['price_deal']	= $ary_product['price_deal'];
			$ary_order_product[$i]['price_cost']	= $ary_product['price_cost'];

//			$ary_order_product[$i]['coupon_id']	=> '',

			//insert order_store
				//qmaker project
			$this->db->select('profit');
			$this->db->where('id', $ary_prod_id[$i]['store_id']);
			$query = $this->db->get('project');
			$store_profit = $query->row_array();

			$ary_order_store[$ary_prod_id[$i]['store_id']] = array(
				'order_id'	=> $order_id,
				'store_id'	=> $ary_prod_id[$i]['store_id'],
				'profit'	=> $store_profit['profit'],
				'source'	=> $ary_prod_id[$i]['source'],
				'rec_name'	=> $ary_prod_id[$i]['hid_sendName'],
				'rec_phone'	=> $ary_prod_id[$i]['hid_sendPhone'],
				'rec_zip'	=> $ary_prod_id[$i]['hid_sendZip'],
				'rec_addr'	=> $ary_prod_id[$i]['hid_sendAddr'],
				'rec_mail'	=> $ary_prod_id[$i]['hid_sendMail'],
				'descr'		=> $ary_prod_id[$i]['txt_descr']
			);
			$mail = $ary_prod_id[$i]['hid_sendMail'];
			//delete tmp_cart
			$this->db->delete('tmp_cart', array('user_id' => $user_id, 'product_id' => $ary_prod_id[$i]['prod_id']));
		}

		//insert orders
		$ary_orders = array(
			'order_id'			=> $order_id,
			'user_id'			=> $user_id,
			'status_payment'	=> 0,	//訂單成立
			'rec_mail'			=> $mail,
/*			'rec_name'			=> $this->input->post('hid_sendName'),
			'rec_phone'			=> $this->input->post('hid_sendPhone'),
			'rec_zip'			=> $this->input->post('hid_sendZip'),
			'rec_addr'			=> $this->input->post('hid_sendAddr'),		
			'descr'				=> $this->input->post('txt_descr'),
*/			'dt_create'			=> date('Y-m-d H:i:s'),
			'dt_update'			=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_orders);
		$this->db->insert('orders');
		$this->db->insert_batch('order_store',$ary_order_store);

		$ret_data = $this->db->insert_batch('order_store_product',$ary_order_product);

		return array($order_id, $ret_data);
	}

	function getOrderAmt($order_id) {
		$this->db->select('sum(price_deal*quantity) as total');
		$this->db->where('order_id', $order_id);
		$query = $this->db->get('order_store_product');

		return $query->row()->total;
	}

	function getOrderStoreAmt($order_id, $store_id) {
		$this->db->select('sum(price_deal*quantity) as total');
		$this->db->where('order_id', $order_id);
		$this->db->where('store_id', $store_id);
		$query = $this->db->get('order_store_product');

		return $query->row()->total;
	}

	function getOrderStore($order_id, $store_id) {
		$this->db->where('order_id', $order_id);
		$this->db->where('store_id', $store_id);
		$query = $this->db->get('order_store');

		return $query->row_array();
	}	

	function getOrderStoreProduct($order_id) {
		$this->db->select('osp.*, prod.name as prod_name, prod.is_delivery, prod.url_pic as prod_url_pic, spec.name as spec_name, orders.descr as orders_descr, orders.invoice_c_no as orders_invoice_c_no, orders.invoice_c_name as orders_invoice_c_name, orders.dt_create as dt_create, orders.status_payment as status_payment, orders.rec_name as rec_name, orders.rec_phone as rec_phone, orders.rec_zip as rec_zip, orders.rec_addr as rec_addr');
		$this->db->where('osp.order_id', $order_id);
		$this->db->join('product prod', 'prod.id=osp.product_id', 'left');
		$this->db->join('spec', 'spec.id=osp.spec_id', 'left');
		$this->db->join('orders', 'orders.order_id=osp.order_id', 'left');
		// !!!!! hard code !!!!!
//		$this->db->join('project j', 'j.id=osp.store_id', 'left');
		// !!!!! hard code !!!!!
		$query = $this->db->get('order_store_product osp');

		return $query->result_array();
	}

	function getOrderStoreProductNoDelivery($order_id) {
		$this->db->select('osp.*, prod.name as prod_name, prod.is_delivery, prod.url_pic as prod_url_pic, spec.name as spec_name, orders.descr as orders_descr, orders.invoice_c_no as orders_invoice_c_no, orders.invoice_c_name as orders_invoice_c_name, orders.dt_create as dt_create, orders.status_payment as status_payment, orders.rec_name as rec_name, orders.rec_phone as rec_phone, orders.rec_zip as rec_zip, orders.rec_addr as rec_addr');
		$this->db->where('osp.order_id', $order_id);
		$this->db->where('osp.is_delivery', 0);
		$this->db->join('product prod', 'prod.id=osp.product_id', 'left');
		$this->db->join('spec', 'spec.id=osp.spec_id', 'left');
		$this->db->join('orders', 'orders.order_id=osp.order_id', 'left');
		// !!!!! hard code !!!!!
//		$this->db->join('project j', 'j.id=osp.store_id', 'left');
		// !!!!! hard code !!!!!
		$query = $this->db->get('order_store_product osp');

		return $query->result_array();
	}

	function getOrderStoreInfoByOrderId($order_id) {
		$this->db->distinct('rec_name, rec_phone, rec_mail, rec_zip, rec_addr, descr');
		$this->db->where('order_id', $order_id);
		$query = $this->db->get('order_store');

		return $query->row_array();
	}

	function orderUpdateInvoice($order_id) {
		$ary_data = array(
			'invoice_c_no'	=> $this->input->post('txt_invoice_c_no'), 
			'invoice_c_name'=> $this->input->post('txt_invoice_c_name')
		);

		$this->db->set($ary_data);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders');

		return 1;
	}

	function getOrderByUserid($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->order_by('dt_update', 'DESC');
		$query = $this->db->get('orders');

		return $query->result_array();		
	}

	public function updateStatusPayment($order_id, $status_payment) {
		$ary_data = array(
			'status_payment'=> $status_payment
		);

		$this->db->set($ary_data);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders');

		return 1;
	}

	public function doRefund() {
		$ary_data = array(
			'status_send'=> SEND_STATUS_RETURNING
		);

		$this->db->set($ary_data);
		$this->db->where('order_id', $this->input->post('order_id'));
		$this->db->where('store_id', $this->input->post('store_id'));
		$this->db->update('order_store');

		return 1;
	}
	
}