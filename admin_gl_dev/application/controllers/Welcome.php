<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index() {
		if(!isset($_SESSION['sess_user_id'])) {
			redirect(base_url().'login', 'refresh');
		}

		$data['title'] = 'RapaQ Admin';
		$data['path'] = '';

		$this->load->view('template/header',$data);
		$this->load->view('welcome_message', $data);
		$this->load->view('template/footer');
	}
}