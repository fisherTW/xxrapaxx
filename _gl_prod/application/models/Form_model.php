<?php
/*
* File:			Form_model.php
* Version:		-
* Last changed:	2018/04/27
* Purpose:		-
* Author:		Doris
* Copyright:	(C) 2018
* Product:		RapaQ
*/
class Form_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function formFactory_doEdit() {
		$ary_data = array(
			'company_name'	=> $this->input->post('txt_company_name'), 
			'company_web'	=> $this->input->post('txt_company_web'),
			'name'			=> $this->input->post('txt_name'),
			'identity'		=> $this->input->post('sel_identity'),
			'tel'			=> $this->input->post('txt_tel'),
			'mail'			=> $this->input->post('txt_mail'),
			'descr'			=> $this->input->post('txt_descr'),
			'dt_create'		=> date('Y-m-d H:i:s')
		);

		$this->db->set($ary_data);
		$this->db->insert('form_factory');
		
		return 1;
	}

}