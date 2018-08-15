<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $project_lastUpdateId = 0;
	public $project_name = '';

	public function __construct() {
		parent::__construct();
	}
}