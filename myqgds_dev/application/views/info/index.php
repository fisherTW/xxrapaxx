<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>
<section class="content-header">
	<h1>基本資料</h1>
</section>
<section class="content" style="height: 1050px;">
	<form id='form1'>
		<input type="hidden" id="hid_store_id" name='hid_store_id' value='<?= $_SESSION['sess_store_id'] ?>'>
		<div class="form-group">
			<div class='col-sm-12'>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">店鋪營業狀況</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="收合視窗">
							<i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">						
						<?= form_dropdown('sel_is_enable', $ary_enable, $data['is_enable'], 'class="form-control"'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class='col-sm-6'>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">店鋪LOGO　</h3><span style="color:#0044BB">上傳圖片尺寸 200 x 200　（請記得按圖片裡的上傳檔案功能鍵）</span>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="收合視窗">
							<i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<tbody>
								<input type="file" id="pic_logo" multiple class="file-loading">
								<input type="hidden"  id="hid_pic_logo" name='hid_pic_logo' value="<?= $data['pic_logo'] ?>">
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class='col-sm-6'>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">店鋪Banner　</h3><span style="color:#0044BB">上傳圖片尺寸 1440 x 290　（請記得按圖片裡的上傳檔案功能鍵）</span>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="收合視窗">
							<i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<tbody>
								<input type="file" id="pic_banner" multiple class="file-loading">
								<input type="hidden" id="hid_pic_banner" name='hid_pic_banner' value="<?= $data['pic_banner'] ?>">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class='col-sm-12'>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">關於店鋪內容</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="收合視窗">
							<i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<tbody>
								<textarea id="summernote" name="txt_profile" rows="5" cols="110" width='560px' class="textarea" required><?= $data['profile'] ?></textarea>							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
<section class="content-footer">
	<div class='box-footer text-right'>
		<button type="button" class='btn btn-primary' name="btn_save" id="btn_save">Save</button>
	</div>
</section>

<script src="<?= base_url()?>assets/js/fileinput.min.js"></script>
<script src="<?= base_url()?>assets/js/fileinput_locale_zh-TW.js"></script>
<link href="<?= base_url()?>assets/css/fileinput.min.css" rel="stylesheet" type="text/css">

<script src="<?= base_url() ?>assets/summernote/summernote.min.js"></script>
<script src="<?= base_url() ?>assets/summernote/summernote-zh-TW.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/summernote/summernote.css">
<script type="text/javascript">
$(function() {

	$('#pic_logo').click(function() {
		if($('#pic_logo').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});

	$('#pic_logo').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: false,
		maxFileSize: 51200,
		minImageWidth: 200,
		minImageHeight: 200,
		maxImageWidth: 200,
		maxImageHeight: 200,
		language: "zh-TW",
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
<?php if($data['pic_logo'] != ''): ?>
		initialCaption: "<?= $data['pic_logo'] ?>",
		initialPreview: ['<img src="<?= URL_GOOGLE_IMG . $data['pic_logo']; ?>" class="kv-preview-data krajee-init-preview file-preview-image">'],
<?php endif; ?>
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qgoods' };
			return info;
		}
	});

	$('#pic_logo').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_pic_logo]').val(response.new_path);
		$('#pic_logo').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_path);
	});


	$('#pic_banner').click(function() {
		if($('#pic_banner').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});

	$('#pic_banner').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: false,
		maxFileSize: 51200,
		minImageWidth: 1440,
		minImageHeight: 290,
		maxImageWidth: 1440,
		maxImageHeight: 290,
		language: "zh-TW",
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
<?php if($data['pic_banner'] != ''): ?>
		initialCaption: "<?= $data['pic_banner'] ?>",
		initialPreview: ['<img src="<?= URL_GOOGLE_IMG . $data['pic_banner']; ?>" class="kv-preview-data krajee-init-preview file-preview-image" style="width: 640px;" >'],		
<?php endif; ?>		
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qgoods' };
			return info;
		}
	});

	$('#pic_banner').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_pic_banner]').val(response.new_path);
		$('#pic_banner').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_path);
	});

	$('#summernote').summernote({
		height: 300,
		lang: 'zh-TW',
		codemirror: { theme: 'paper'},
		placeholder: '請輸入文字...',	
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline','clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['Insert', ['picture','link','hr','video','table']],
			['Misc', ['fullscreen','codeview','undo','redo']]
		],
		focus: true,
		callbacks: {
			onImageUpload: function(image,editor, welEditable) {
				sendFile(image[0],editor, welEditable);
			},
			onChange: function(contents, $editable) {
				modified = true;
			},
			//貼上自動去除html
			onPaste: function (ne) { 
				var bufferText = ((ne.originalEvent || ne).clipboardData || window.clipboardData).getData( 'Text/plain'); 
				ne.preventDefault ? ne.preventDefault() : (ne.returnValue = false); 
				setTimeout(function () {
					document.execCommand("insertText", false, bufferText); 
				}, 10); 
			}
		}
	});

	function sendFile(file, editor, welEditable) {
		data = new FormData();
		data.append("file_data", file);

		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'upload/quick',
			cache: false,
			async : false,
			data: data,
			processData: false,
			contentType: false,
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				var obj = JSON.parse(response.responseText);
				$('#summernote').summernote('insertImage',  '<?= URL_GOOGLE_IMG ?>' + obj.new_path);
			}
		});
	}

	$('#btn_save').bind('click', function() {
		if(!$('#form1')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'info/doEdit',
			cache: false,
			async : false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				alert('儲存成功！');
			}
		});
		return false;
	});
});
</script>