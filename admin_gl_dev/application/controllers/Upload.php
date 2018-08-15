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
		$folder_gg	= ($folder_gg == '') ? 'new-qmaker' : $name_gg;

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

    public function upload() {
        $ret = new \stdClass();
        $ret->error = 'error!';
        $products = $request->get("products_id");
        $targetPath = public_path('uploads').'/';
        $base64_string = "";
        if (!empty($_FILES)) {
            foreach ($_FILES as $key => $val) {
                $ary_file = $val;
            }
            //cut picture
            $post['src'] = 'data:' . $val['type'] . ';base64,' . base64_encode(file_get_contents($val['tmp_name']));
//            $base64_string = 'data:image/' . $val['type'] . ';base64,' . base64_encode(file_get_contents($val['tmp_name']));
            if(isset($post['src']) && $post['src']!=""){
                $url = env('APIURLF')."v2/qgoods/Image/cutsquare";
                $res = curl_post_content($url,array(),$post);
                $res = json_decode($res,true);
                if($res['status']) {
                    $base64_string = $res['data'];
                    if (!file_exists($targetPath)) {
                        mkdir($targetPath, 0775, true);
                    }
               }
            }
            //change file name
            list($o_name, $o_ext) = explode('.', $ary_file['name']);
            $micro_date = microtime();
            $date_array = explode(" ",$micro_date);
            $date = date("Ymd_His_",$date_array[1]);
            $str_time = $date.intval($date_array[0] * 100);
            $targetFile     = $targetPath.$products.'_'.$str_time.'.'.$o_ext;
            
            //save file to uploads
            $ifp = fopen( $targetFile, 'wb' );
            $data = explode( ',', $base64_string );
            fwrite( $ifp, base64_decode( $data[1] ) );
            fclose( $ifp );

            $ret->new_name  = $products.'_'.$str_time.'.'.$o_ext;
            $ret->key_o     = $key;
            $ret->key       = str_replace('input_', '', $key);
            //uploadToGoogleCDN
            $googleImgUrl = $this->uploadToGoogleCDN($targetPath , $ret->new_name);
			if($googleImgUrl == 0) {
				$ret->error = '上傳失敗！請移除圖片重新上傳。';
			}
            $localIamgePlace = $targetPath.$ret->new_name;
            unlink($localIamgePlace); //刪除uploads的檔案
            unset($ret->error);
        }
        echo json_encode($ret);
    }



}