<?php
/*
* File:			Announce_model.php
* Version:		-
* Last changed:	2018/08/02
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Announce_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	//	output
	//	1: success
	public function doEditAnnounce($start, $end) {
		$ary_data = array(
			'title'				=> $_POST['txt_title'], 
			'is_enable'			=> $_POST['rdo_is_enable'],
			'dt_start'			=> $start,
			'dt_end'			=> $end
		);
		$this->db->set($ary_data);

		if ($_POST['hid_announce_id'] == '0') {
			$this->db->set($ary_data);
			$this->db->set('dt_create', date('Y-m-d H:i:s'));
			$this->db->insert('announce');

			return 1;
		}	else {
			$this->db->where('id', $_POST['hid_announce_id']);
			$this->db->update('announce');

			return 1;
		}
	}

	public function doDelAnnounce() {
		$this->db->where('id', $_POST['id']);
		$this->db->delete('announce');

		return 1;
	}

	public function getAnnounce() {
		$this->db->select('a.*');

		$query = $this->db->get('announce a');

		return $query->result_array();
	}

	public function get($announce_id) {
		$this->db->select('a.*');
		$this->db->where('a.id', $announce_id);
		$query = $this->db->get('announce a');

		return $query->result_array();
	}
}