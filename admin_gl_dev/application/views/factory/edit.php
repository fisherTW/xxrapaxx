<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		工廠管理
<?php if ($id != '0'): ?>
		<small>工廠內容設定</small>
<?php else: ?>
		<small>工廠內容新增</small>
<?php endif; ?>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<br>
<?php if ($id != '0'): ?>
	<input type="hidden" name="hid_factory_id" value='<?= $info[0]['id'] ?>'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">工廠名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_name" required value="<?= $info[0]['name']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">工廠 LOGO</label>
		<div class="col-sm-9">
			<div class="box box-info">
				<div class="box-body">
					<i class="fa fa-info-circle"></i> 寬度: 180 px 高度: 180 px
				</div>
			</div>
			<input type="file" class="file-loading" id="logo_picture" value="<?= $info[0]['pic_logo']?>">
			<input type="hidden" name='hid_logo_pic' value="<?= $info[0]['pic_logo']?>">
		</div>	
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">工廠 Background</label>
		<div class="col-sm-9">
			<div class="box box-info">
				<div class="box-body">
					<i class="fa fa-info-circle"></i> 寬度: 1440 px 高度: 505 px
				</div>
			</div>
			<input type="file" class="file-loading" id="bg_picture" value="<?= $info[0]['pic_bg']?>">
			<input type="hidden" name='hid_bg_pic' value="<?= $info[0]['pic_bg']?>">
		</div>	
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">YOUTUBE</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" placeholder="輸入 YOUTUBE 網址(非必填)" name="txt_url_youtube" value="<?= $info[0]['url_youtube']?>">
			<font color="red">範例 : https://www.youtube.com/embed/A4BujkXnaFw</font>
		</div>
		<div class="col-sm-2">
			<input type="button" class="form-control" id="check_url_youtube" value="預覽">
		</div>	
		<div class="col-sm-3" id='div_url_pic'></div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">工廠介紹</label>
		<div class="col-sm-9">
			<textarea class="form-control" name="txt_profile" required rows='5'><?= $info[0]['profile']?></textarea>
		</div>		
	</div>
<?php else : ?>
	<input type="hidden" name="hid_factory_id" value='0'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">工廠名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_name" required value="">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">工廠 LOGO</label>
		<div class="col-sm-9">
			<div class="box box-info">
				<div class="box-body">
					<i class="fa fa-info-circle"></i> 寬度: 180 px 高度: 180 px
				</div>
			</div>
			<input type="file" class="file-loading" id="logo_picture" value="">
			<input type="hidden" name='hid_logo_pic' value="">
		</div>	
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">工廠 Background</label>
		<div class="col-sm-9">
			<div class="box box-info">
				<div class="box-body">
					<i class="fa fa-info-circle"></i> 寬度: 1440 px 高度: 505 px
				</div>
			</div>
			<input type="file" class="file-loading" id="bg_picture" value="">
			<input type="hidden" name='hid_bg_pic' value="">
		</div>	
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">YOUTUBE</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" placeholder="輸入 YOUTUBE 網址(非必填)" name="txt_url_youtube" value="">
			<font color="red">範例 : https://www.youtube.com/embed/A4BujkXnaFw</font>
		</div>
		<div class="col-sm-2">
			<input type="button" class="form-control" id="check_url_youtube" value="Check">
		</div>	
		<div class="col-sm-3" id='div_url_pic'></div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">工廠介紹</label>
		<div class="col-sm-9">
			<textarea class="form-control" name="txt_profile" required rows='5'></textarea>
		</div>		
	</div>
<?php endif; ?>
</form>
</section><!-- /.content -->
<section class="content-footer">
    <div class='box-footer text-right'>
        <button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
        <button type="button" class='btn btn-primary' name="btn_save" id="btn_save">Save</button>
    </div>
</section>
<script type="text/javascript">
$(function() {
	$('#check_url_youtube').click(function() {
		$('#div_url_pic').html('<iframe src="'+$('input[name=txt_url_youtube]').val()+'"></iframe>');
	});	

	$('#logo_picture').click(function() {
		if($('#logo_picture').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});	
	$('#bg_picture').click(function() {
		if($('#bg_picture').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});

	initFileinput();
	$('#logo_picture').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_logo_pic]').val(response.new_path);
		$('#logo_picture').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_name);
	});
	$('#bg_picture').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_bg_pic]').val(response.new_path);
		$('#bg_picture').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_name);
	});		

	$('#btn_save').bind('click', function() {
		if(!$('#form1')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'factory/doEdit',
			cache: false,
			async : false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				location.href = $('#hid_baseurl').val() + 'factory';
			}
		});
		return false;			
	});		
	$('#btn_cancel').bind('click', function() {
		location.href = $('#hid_baseurl').val() + 'factory';
	}); 

});

function initFileinput() {
	$('#logo_picture').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: true,
		maxFileSize: 51200,
		minImageWidth: 180,
		minImageHeight: 180,
		maxImageWidth: 180,
		maxImageHeight: 180,
		language: "zh-TW",
<?php if($id != '0'): ?>
		initialCaption: "<?= $info[0]['pic_logo']?>",
		initialPreview: ['<img src="<?= URL_GOOGLE_IMG.$info[0]['pic_logo'] ?>" class="kv-preview-data krajee-init-preview file-preview-image">'],
<?php endif; ?>
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qmaker' };
			return info;
		}
	});

	$('#bg_picture').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: true,
		maxFileSize: 51200,
		minImageWidth: 1440,
		minImageHeight: 505,
		maxImageWidth: 1440,
		maxImageHeight: 505,
		language: "zh-TW",
<?php if($id != '0'): ?>
		initialCaption: "<?= $info[0]['pic_bg']?>",
		initialPreview: ['<img src="<?= URL_GOOGLE_IMG.$info[0]['pic_bg'] ?>" height="170" class="kv-preview-data krajee-init-preview file-preview-image">'],
<?php endif; ?>
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qmaker' };
			return info;
		}
	});	
}
</script>