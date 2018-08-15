<?php
/*
* File:			Orders_statement_model.php
* Version:		-
* Last changed:	2018/07/26
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Statement_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getStoreSearch($is_direct) {

		$this->db->select('s.id, s.name');

		$ary_data = array(
			's.is_direct'		=> $is_direct
	
		);

		$this->db->where($ary_data);
		$this->db->like('s.name', $_POST['keyword'], 'after');
		$query = $this->db->get('store s');


		$query_ary = $query->result_array();
		if(count($query_ary) > 0) {
			foreach ($query_ary as $key => $val) {
				$ary_store[$val['id']] = $val['name'];
			}
		} else {
			$ary_store[0] = '沒有找到相關店鋪';
		}
		return $ary_store;
	}

	public function getStatement($is_direct) {

		$cri_limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$cri_offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$cri_order = isset($_GET['order']) ? $_GET['order'] : 'asc';
		$cri_sort = isset($_GET['sort']) ? 'os.'.$_GET['sort'] : 'os.id';

		$cri_search = isset($_GET['search']) ? $_GET['search'] : '';

		$store_id = isset($_GET['store_id']) ? $_GET['store_id'] : '';
		$date = isset($_GET['date']) ? $_GET['date'] : '';


		if (!empty($date)) {
			$date_start = substr($date, 0, 10);
			$date_end = substr($date, 13, 10);
		}
		$this->db->select('os.order_id as order_id, os.store_id as store_id,os.log_refund_id as log_refund_id, pd.id as product_id, pd.name as product_name, sup.id as supplier_id, sup.name as supplier_name, osp.price_deal as price_deal, osp.quantity as quantity, osp.is_delivery as is_delivery, s.profit as store_profit, s.name as store_name');

		$this->db->join('store s', 's.id = os.store_id', 'left');
		$this->db->join('order_store_product osp', 'osp.order_id = os.order_id AND osp.store_id = os.store_id', 'left');
		$this->db->join('orders o', 'o.order_id = os.order_id', 'left');

		$this->db->join('product pd', 'pd.id = osp.product_id', 'left');
		$this->db->join('supplier sup', 'sup.id = pd.supplier_id', 'left');

		if (!empty($store_id)) {
			$this->db->where('os.store_id', $store_id);
		}
		if (!empty($date)) {
			$this->db->where('o.dt_create >', $date_start);
			$this->db->where('o.dt_create <', $date_end);
		}

		$this->db->where('os.source', SOURCE_QGOODS);
		$this->db->where('o.status_payment', PAYMENT_SUCCESS);
		$this->db->where('s.is_direct', $is_direct);

		// if ($cri_search != '') {

		// 	$this->db->group_start();
		// 	$this->db->like('p.name', $cri_search, 'after');
		// 	$this->db->or_like('p.id', $cri_search, 'after');
		// 	$this->db->or_like('s.name', $cri_search, 'after');
		// 	$this->db->group_end();

		// }

		$this->db->limit($cri_limit);
		$this->db->offset($cri_offset);
		$this->db->order_by($cri_sort, $cri_order);

		$query = $this->db->get('order_store os');


//print_r($this->db->last_query());
		return $query->result_array();
	}

	public function getStatementRefund($is_direct) {

		$cri_limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$cri_offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$cri_order = isset($_GET['order']) ? $_GET['order'] : 'asc';
		$cri_sort = isset($_GET['sort']) ? 'os.'.$_GET['sort'] : 'os.id';

		$cri_search = isset($_GET['search']) ? $_GET['search'] : '';

		$store_id = isset($_GET['store_id']) ? $_GET['store_id'] : '';
		$date = isset($_GET['date']) ? $_GET['date'] : '';


		if (!empty($date)) {
			$date_start = substr($date, 0, 10);
			$date_end = substr($date, 13, 10);
		}
		$this->db->select('lr.id as id, lr.order_id as order_id, lr.store_id as store_id, lr.amt as amt, pd.name as product_name, osp.is_delivery as is_delivery, s.name as store_name, u.name as user_name');

		$this->db->join('store s', 's.id = lr.store_id', 'left');
		$this->db->join('users u', 'u.id = lr.user_id', 'left');
		$this->db->join('order_store_product osp', 'osp.order_id = lr.order_id AND osp.store_id = lr.store_id', 'left');
		$this->db->join('order_store os', 'os.order_id = lr.order_id AND os.store_id = lr.store_id', 'left');

		$this->db->join('orders o', 'o.order_id = lr.order_id', 'left');
		$this->db->join('product pd', 'pd.id = osp.product_id', 'left');

		if (!empty($store_id)) {
			$this->db->where('lr.store_id', $store_id);
		}
		if (!empty($date)) {
			$this->db->where('o.dt_create >', $date_start);
			$this->db->where('o.dt_create <', $date_end);
		}

		$this->db->where('os.source', SOURCE_QGOODS);
		$this->db->where('osp.is_delivery', '0');
		$this->db->where('s.is_direct', $is_direct);

		$this->db->where('o.status_payment', PAYMENT_SUCCESS);


		// if ($cri_search != '') {

		// 	$this->db->group_start();
		// 	$this->db->like('p.name', $cri_search, 'after');
		// 	$this->db->or_like('p.id', $cri_search, 'after');
		// 	$this->db->or_like('s.name', $cri_search, 'after');
		// 	$this->db->group_end();

		// }

		$this->db->limit($cri_limit);
		$this->db->offset($cri_offset);
		$this->db->order_by($cri_sort, $cri_order);

		$query = $this->db->get('log_refund lr');


//print_r($this->db->last_query());
		return $query->result_array();
	}

	public function countStatement($is_direct) {

		$store_id = isset($_GET['store_id']) ? $_GET['store_id'] : '';
		$date = isset($_GET['date']) ? $_GET['date'] : '';

		if (!empty($date)) {
			$date_start = substr($date, 0, 10);
			$date_end = substr($date, 13, 10);
		}

		$cri_search = isset($_GET['search']) ? $_GET['search'] : '';
		
		$this->db->join('order_store_product osp', 'osp.order_id = os.order_id AND osp.store_id = os.store_id', 'left');
		$this->db->join('orders o', 'o.order_id = os.order_id', 'left');
		$this->db->join('store s', 's.id = os.store_id', 'left');

		$ary_where = array(
			'os.source'			=> SOURCE_QGOODS,
			'o.status_payment'	=> PAYMENT_SUCCESS,
			's.is_direct'		=> $is_direct
		);

		
		// if ($cri_search != '') {
		// 	$this->db->group_start();
		// 	$this->db->like('p.name', $cri_search, 'after');
		// 	$this->db->or_like('p.id', $cri_search, 'after');
		// 	$this->db->or_like('s.name', $cri_search, 'after');
		// 	$this->db->group_end();
		// }

		$this->db->where($ary_where);

		if (!empty($store_id)) {
			$this->db->where('os.store_id', $store_id);
		}
		if (!empty($date)) {
			$this->db->where('o.dt_create >', $date_start);
			$this->db->where('o.dt_create <', $date_end);
		}

		return $this->db->count_all_results('order_store os');
	}

	public function countStatementRefund($is_direct) {

		$store_id = isset($_GET['store_id']) ? $_GET['store_id'] : '';
		$date = isset($_GET['date']) ? $_GET['date'] : '';

		if (!empty($date)) {
			$date_start = substr($date, 0, 10);
			$date_end = substr($date, 13, 10);
		}

		$cri_search = isset($_GET['search']) ? $_GET['search'] : '';
		
		$this->db->join('order_store_product osp', 'osp.order_id = lr.order_id AND osp.store_id = lr.store_id', 'left');
		$this->db->join('order_store os', 'os.order_id = lr.order_id AND os.store_id = lr.store_id', 'left');
		$this->db->join('orders o', 'o.order_id = lr.order_id', 'left');
		$this->db->join('store s', 's.id = os.store_id', 'left');

		$ary_where = array(	

			'os.source'			=> SOURCE_QGOODS,
			'o.status_payment'	=> PAYMENT_SUCCESS,
			'osp.is_delivery'	=> '0',
			's.is_direct'		=> $is_direct
		);

		
		// if ($cri_search != '') {
		// 	$this->db->group_start();
		// 	$this->db->like('p.name', $cri_search, 'after');
		// 	$this->db->or_like('p.id', $cri_search, 'after');
		// 	$this->db->or_like('s.name', $cri_search, 'after');
		// 	$this->db->group_end();
		// }

		$this->db->where($ary_where);

		if (!empty($store_id)) {
			$this->db->where('os.store_id', $store_id);
		}
		if (!empty($date)) {
			$this->db->where('o.dt_create >', $date_start);
			$this->db->where('o.dt_create <', $date_end);
		}

		return $this->db->count_all_results('log_refund lr');
	}


	public function get($store_id) {
		$this->db->select('s.*, u.id as user_id, u.name as user_name, u.login_type as user_login_type');
		$this->db->join('users u','u.id=s.user_id','left');

		$this->db->where('s.id', $store_id);
		$query = $this->db->get('store s');

		return $query->result_array();
	}

	public function getRefund($order_id, $store_id) {
		$this->db->select('lr.*');
		$this->db->join('order_store_product osp', 'osp.order_id = lr.order_id', 'left');


		$this->db->where('lr.order_id', $order_id);
		$this->db->where('lr.store_id', $store_id);
		$this->db->where('osp.is_delivery', '0');


		$query = $this->db->get('log_refund lr');

		return $query->result_array();
	}
	
	public function getRefundOrder($order_id, $store_id) {
		$this->db->select('osp.*');


		$this->db->where('osp.order_id', $order_id);
		$this->db->where('osp.store_id', $store_id);
		$this->db->where('osp.is_delivery', '0');

		$query = $this->db->get('order_store_product osp');

		return $query->result_array();
	}

	public function getRefundAmt($order_id, $store_id) {
		$this->db->select('lr.amt');


		$this->db->where('lr.order_id', $order_id);
		$this->db->where('lr.store_id', $store_id);

		$query = $this->db->get('log_refund lr');

		return $query->result_array();
	}
}