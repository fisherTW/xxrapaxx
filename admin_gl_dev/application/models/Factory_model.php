<?php
/*
* File:			Factory_model.php
* Version:		-
* Last changed:	2018/06/13
* Purpose:		-
* Author:		Fisher
* Copyright:	(C) 2018
* Product:		admin_rapaq
*/
class Factory_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	//	output
	//	1: success
	public function doCreate() {
		$ary_data = array(
			'name'			=> $_POST['txt_name'],
			'pic_logo'		=> $_POST['hid_logo_pic'],
			'pic_bg'		=> $_POST['hid_bg_pic'],
			'url_youtube'	=> $_POST['txt_url_youtube'],
			'profile'		=> $_POST['txt_profile'],
			'dt_create'		=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_data);
		$this->db->insert('factory');

		return 1;		
	}

	//	output
	//	1: success
	public function doEditFactory() {
		$ary_data = array(
			'name'				=> $_POST['txt_name'], 
			'pic_logo'			=> $_POST['hid_logo_pic'],
			'pic_bg'			=> $_POST['hid_bg_pic'],
			'url_youtube'		=> $_POST['txt_url_youtube'],
			'profile'			=> $_POST['txt_profile'],
		);
		$this->db->set($ary_data);

		if ($_POST['hid_factory_id'] == '0') {
			$this->db->set($ary_data);
			$this->db->insert('factory');

			return 1;
		}	else {
			$this->db->where('id', $_POST['hid_factory_id']);
			$this->db->update('factory');

			return 1;
		}
				
	}

	public function doDelFactory() {
		$this->db->set('is_del', '1');
		$this->db->where('id', $_POST['id']);
		$this->db->update('factory');

		return 1;	
	}

	public function getFactory() {
		$this->db->select('p.*');
		//$this->db->join('mapping_project_category mpc','mpc.id=p.category_id','left');
		$this->db->where('is_del', '0');
		$this->db->limit(100);
		$query = $this->db->get('factory p');

		return $query->result_array();
	}

	public function get($factory_id) {
		$this->db->select('p.*');
		$this->db->where('p.id', $factory_id);
		$query = $this->db->get('factory p');

		return $query->result_array();
	}	
}