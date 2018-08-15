<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		品牌管理
		<small>個人品牌設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<input type="hidden" name="hid_project_id" value='<?= $info[0]['id'] ?>'>
	<br>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">品牌名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_brand_name" required value="<?= $info[0]['brand_name']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">品牌 LOGO</label>
		<div class="col-sm-9" id='div_url_pic'>
			<input type="file" id="file_picture" multiple class="file-loading">
			<input type="hidden" name='hid_brand_logo' value='<?= $info[0]['brand_logo']?>'>
		</div>	
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">品牌介紹</label>
		<div class="col-sm-9">
			<textarea class="form-control" name="txt_brand_profile" required rows='5'><?= $info[0]['brand_profile']?></textarea>
		</div>		
	</div>

</form>
<div class="row">
	<div class="col-sm-3">
		<div class="btn-group">
			<button id='btn_save' type="button" class="btn btn-primary">Save</button>
		</div>
		<div class="btn-group">
			<button id='btn_cancel' type="button" class="btn btn-default">Cancel</button>
		</div>
	</div>
</div>
</section><!-- /.content -->

<script type="text/javascript">
$(function() {
	$('#file_picture').click(function() {
		if($('#file_picture').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});	
	initFileinput();
	$('#file_picture').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_brand_logo]').val(response.new_path);
		$('#file_picture').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_name);
	});	

	$('#btn_save').bind('click', function() {
		if(!$('#form1')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'brand/doEdit',
			cache: false,
			async : false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				window.history.back();
			}
		});
		return false;			
	});		
	$('#btn_cancel').bind('click', function() {
		window.history.back();
	}); 
});

function initFileinput() {
	$('#file_picture').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: false,
		maxFileSize: 51200,
		minImageWidth: 280,
		minImageHeight: 280,
		maxImageWidth: 280,
		maxImageHeight: 280,
		language: "zh-TW",
		initialPreview: ['<img src="<?= URL_GOOGLE_IMG.$info[0]['brand_logo'] ?>" class="kv-preview-data krajee-init-preview file-preview-image">'],
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qmaker' };
			return info;
		}
	});	
}
</script>