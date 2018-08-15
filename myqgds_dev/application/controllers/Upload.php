<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* File:         Upload.php
* Version:      -
* Last changed: 2018/04/11
* Purpose:      -
* Author:       Fisher
* Copyright:    (C) 2018
* Product:      RapaQ
*/

require_once 'vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;


class Upload extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
	}

	public function quick() {
		$ary_res = json_decode($this->toLocal(), true);
		$ary_res['new_path'] = $this->toGoogle($ary_res['new_path']);

		echo json_encode($ary_res);
	}

	public function toLocal() {
/*      
var_dump($_FILES);exit();
array(1) {
  ["file_data"]=>
  array(5) {
    ["name"]=>
    string(10) "280280.png"
    ["type"]=>
    string(9) "image/png"
    ["tmp_name"]=>
    string(14) "/tmp/php9yoOKX"
    ["error"]=>
    int(0)
    ["size"]=>
    int(48009)
  }
}
*/
		if(!isset($_FILES['file_data'])) {
			$ary_ret = array(
				'result'	=> 0
			);

			return json_encode($ary_ret);
		}

		list($x, $ext) = explode('.', $_FILES['file_data']['name']);
		list($usec, $x) = explode(' ', microtime());

		$newname = date("YmdHis").strval($usec * 1000000).'.'.$ext;
		$newpath = '/tmp/'.$newname;
		move_uploaded_file($_FILES['file_data']['tmp_name'], $newpath);

		$ary_ret = array(
			'new_name'	=> $newname,
			'new_path'	=> $newpath,
			'result'	=> 1
		);

		return json_encode($ary_ret);
	}

	// upload to google AND DELETE local file
	public function toGoogle($path_local, $folder_gg = '', $name_gg = '') {
		// constant
		$storage = new StorageClient([
			'projectId'		=> 'rapaq-service',
			'keyFilePath'	=> APPPATH.'config/rapaq_service.json'
		]);
		$bucket = $storage->bucket('rapaq-image');

		list($x, $ext) = explode('.', $path_local);
		list($usec, $x) = explode(' ', microtime());

		$newname = date("YmdHis").strval($usec * 1000000).'.'.$ext;

		$name_gg	= ($name_gg == '') ? $newname : $name_gg;
		$folder_gg	= ($folder_gg == '') ? 'new-qgoods' : $name_gg;

		$ary_options = [
			'resumable'		=> true,
			'name'			=> $folder_gg.'/'.$name_gg
		];

		$bucket->upload(fopen($path_local, 'r'),$ary_options);
		// make public
		$object = $bucket->object($folder_gg.'/'.$name_gg);
		$object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);		
		unlink($path_local);

		return $folder_gg.'/'.$name_gg;
	}

}