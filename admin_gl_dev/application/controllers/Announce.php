<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:			Announce.php
* Version:		-
* Last changed:	2018/08/02
* Purpose:		-
* Author:		Eugene
* Copyright:	(C) 2018
* Product:		myqmaker
*/
class Announce extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Announce_model');
	}

	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'announce';

		$this->load->view('template/header',$data);
		$this->load->view('announce/index', $data);
		$this->load->view('template/footer');
	}

	public function getAnnounce() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}
		echo json_encode($this->Announce_model->getAnnounce());
	}

	public function edit($announce_id = 0) {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = 'announce';

		$data['info'] = $this->Announce_model->get($announce_id);
		$data['id'] = $announce_id;
		
		// echo date("Y-m-d H:i" , mktime(0,0,0,date("m"),date("d"),date("Y")+3) );
		if ($announce_id == 0 || $data['info'][0]['dt_start'] == '' || $data['info'][0]['dt_end'] == '') {
			$data['date'] = date("Y-m-d H:i:").' - '.date("Y-m-d H:i" , mktime(0,0,0,date("m"),date("d"),date("Y")+3) );
		} else {
			$start = substr($data['info'][0]['dt_start'], 0, -3);
			$end   = substr($data['info'][0]['dt_end'], 0, -3);
			$data['date'] = $start.' - '.$end;
		}

		$this->load->view('template/header',$data);
		$this->load->view('announce/edit', $data);
		$this->load->view('template/footer');		
	}

	public function doEdit() {

		$start = substr($_POST['daterange'], 0, 16);
		$end   = substr($_POST['daterange'], 19, 16);

		$this->Announce_model->doEditAnnounce($start, $end);
	}

	public function doDelete() {
		$this->Announce_model->doDelAnnounce();
	}
}