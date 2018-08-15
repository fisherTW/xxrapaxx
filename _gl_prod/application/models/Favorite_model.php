<?php
/*
* File:			Favorite_model.php
* Version:		-
* Last changed:	2018/05/17
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Favorite_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function doCreate($source, $content_id) {
		$ary_data = array(
			'user_id'		=> $_SESSION['sess_user_id'], 
			'content_id'	=> $content_id,
			'source'		=> $source,
			'dt_create'		=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_data);
		$this->db->insert('favorite');
		
		return 1;
	}

	public function doDel($source, $content_id) {
		$this->db->where('user_id', $_SESSION['sess_user_id']);
		$this->db->where('source', $source);
		$this->db->where('content_id', $content_id);
		$this->db->delete('favorite');
		
		return 0;
	}

	public function checkFavoriteId($source, $content_id) {
		$this->db->where('user_id', $_SESSION['sess_user_id']);
		$this->db->where('source', $source);
		$this->db->where('content_id', $content_id);
		$query = $this->db->get('favorite');

		return $query->num_rows();
	}

	public function getProductTotalByStoreId($id, $source) {
		$this->db->where('content_id', $id);
		$this->db->where('source', $source);

		return $this->db->count_all_results('favorite');
	}
}