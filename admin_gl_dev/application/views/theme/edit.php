<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>
 -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/locale/zh-tw.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		主題好物
<?php if ($id != '0'): ?>
		<small>主題好物設定</small>
<?php else: ?>
		<small>主題好物新增</small>
<?php endif; ?>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<input type='hidden' id='hid_row' value=''>
<form class="form-horizontal" id="form1">
	<input type="hidden" name="hid_theme_show" value='<?= $themeshow ?>'>
	<br>
<?php if ($id != '0'): ?>
	<input type="hidden" name="hid_theme_id" value='<?= $info[0]['id'] ?>'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">網域別名</label>
		<div class="col-sm-9">
			<div class="input-group">
				<span class="input-group-addon" id="txt_linka-front" style="background-color: #DDDDDD">https://dev-fisher.rapaq.com/theme/view/</span>
				<input type="text" class="form-control" id="txt_link" name="txt_link" value="<?= $info[0]['link']?>" placeholder="限20字" maxlength="20" pattern="(\w*)?$" required>
			</div>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">商品標題</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_name" value="<?= $info[0]['name']?>" placeholder="限20字" maxlength="20"  required>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">狀態</label>
		<div class="col-sm-9">
			<label class="radio-inline">
<?php if ( $themeshow >= 8 && $info[0]['is_enable'] == 0):?>
				<font color="red">上架數量已滿 8 ,請先下架其他主題好物</font>
<?php else: ?>
				<input type="radio" name="rdo_pdt_status" value='1' <?= $info[0]['is_enable'] == 1 ? 'checked' : '' ?>>上架
<?php endif; ?>
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_pdt_status" value='0' <?= $info[0]['is_enable'] == 0 ? 'checked' : '' ?>>下架
			</label>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">期間</label>
		<div class="col-sm-9">
			<input class="form-control daterange" type="text" name="daterange" value="<?= $date ?>" readonly />			
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Cover Photo(大)</label>
		<div class="col-sm-9">
			<div class="box box-info">
				<div class="box-body">
					<i class="fa fa-info-circle"></i> 寬度: 1440 px 高度: 480 px
				</div>
			</div>
			<input type="file" class="file-loading" id="big_picture" value="<?= $info[0]['pic_cover']?>">
			<input type="hidden" name='hid_big_pic' value="<?= $info[0]['pic_cover']?>">
		</div>	
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">內文</label>
		<div class="col-sm-9">
			<textarea id="summernote" name="txt_detail" rows="5" cols="110" width='560px' class="textarea" required><?= $info[0]['detail'] ?></textarea>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">活動主題</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_product_title" value="<?= $info[0]['product_title']?>"  placeholder="限30字" maxlength="30" required>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">產品名稱</label>
		<div class="col-sm-9">
			<div id="add_block">
<?php $row=0; ?>						
<?php if(count($product) > 0): ?>
<?php foreach ($product as $key => $value): ?>
<?php $row++;$item['row']=$row; ?>
				<div class="input-group margin">			
					<input type="text" class="form-control" name="txt_pdt_name[]" value="<?= $value['name'] ?>" row="<?= $row ?>" disabled/>
					<input type="hidden" name="hid_products_id[]" value="<?= $value['id'] ?>" row="<?= $row ?>"/>

					<span class="input-group-btn">
						<button type="button" class="btn btn-info btn-flat psearch" data-toggle="modal" data-target="#modal-default" row="<?= $row ?>" >Search</button>
						<button type="button" class="btn btn-danger btn-flat btn-remove" row="<?= $row ?>" >-</button>
					</span>
				</div>
<?php endforeach; ?>
<?php else : ?>
		<?php $row++;$item['row']=$row; ?>
				<div class="input-group margin">			
					<input type="text" class="form-control" name="txt_pdt_name[]" value="" row="<?= $row ?>" disabled/>
					<input type="hidden" name="hid_products_id[]" value="" row="<?= $row ?>" />

					<span class="input-group-btn">
						<button type="button" class="btn btn-info btn-flat psearch" data-toggle="modal" data-target="#modal-default" row="<?= $row ?>" >Search</button>
						<button type="button" class="btn btn-danger btn-flat btn-remove" row="<?= $row ?>" >-</button>
					</span>
				</div>
<?php endif; ?>
			</div>
			<a id="btn_add" class="btn btn-success btn-block"><b>Add</b></a>
		</div>

	</div>
<?php else : ?>
	<input type="hidden" name="hid_theme_id" value='0'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">網域別名</label>
		<div class="col-sm-9">
			<div class="input-group">
				<span class="input-group-addon" id="txt_linka-front" style="background-color: #DDDDDD">https://dev-fisher.rapaq.com/theme/view/</span>
				<input type="text" class="form-control" id="txt_link" name="txt_link" value="" placeholder="限20字" maxlength="20" pattern="(\w*)?$" required>
			</div>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">商品標題</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_name" value="" placeholder="限20字" maxlength="20"  required>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">狀態</label>
		<div class="col-sm-9">
			<label class="radio-inline">
<?php if ( $themeshow >= 8 ):?>
				<font color="red">上架數量已滿 8 ,請先下架其他主題好物</font>
<?php else: ?>
				<input type="radio" name="rdo_pdt_status" id="rdo_is_enable" value='1' >上架
<?php endif; ?>
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_pdt_status" value='0' checked >下架
			</label>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">期間</label>
		<div class="col-sm-9">
			<input class="form-control daterange" type="text" name="daterange" value="<?= $date ?>" readonly />			
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Cover Photo(大)</label>
		<div class="col-sm-9">
			<div class="box box-info">
				<div class="box-body">
					<i class="fa fa-info-circle"></i> 寬度: 1440 px 高度: 480 px
				</div>
			</div>
			<input type="file" class="file-loading" id="big_picture" value="">
			<input type="hidden" name='hid_big_pic' value="">
		</div>	
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">內文</label>
		<div class="col-sm-9">
			<textarea id="summernote" name="txt_detail" rows="5" cols="110" width='560px' class="textarea" required></textarea>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">活動主題</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_product_title" value="" placeholder="限30字" maxlength="30" required>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">產品名稱</label>
		<div class="col-sm-9">
			<div id="add_block">
<?php $row=0; ?>						
<?php if(count($product) > 0): ?>
<?php foreach ($product as $key => $value): ?>
<?php $row++;$item['row']=$row; ?>
				<div class="input-group margin">
					<input type="text" class="form-control" name="txt_pdt_name[]" value="<?= $value['name'] ?>" row="<?= $row ?>" disabled/>
					<input type="hidden" name="hid_products_id[]" value="<?= $value['id'] ?>" row="<?= $row ?>"/>

					<span class="input-group-btn">
						<button type="button" class="btn btn-info btn-flat psearch" data-toggle="modal" data-target="#modal-default" row="<?= $row ?>" >Search</button>
						<button type="button" class="btn btn-danger btn-flat btn-remove" row="<?= $row ?>" >-</button>
					</span>
				</div>
<?php endforeach; ?>
<?php else : ?>
		<?php $row++;$item['row']=$row; ?>
				<div class="input-group margin">			
					<input type="text" class="form-control" name="txt_pdt_name[]" value="" row="<?= $row ?>" disabled/>
					<input type="hidden" name="hid_products_id[]" value="" row="<?= $row ?>" />

					<span class="input-group-btn">
						<button type="button" class="btn btn-info btn-flat psearch" data-toggle="modal" data-target="#modal-default" row="<?= $row ?>" >Search</button>
						<button type="button" class="btn btn-danger btn-flat btn-remove" row="<?= $row ?>" >-</button>
					</span>
				</div>
<?php endif; ?>
			</div>
			<a id="btn_add" class="btn btn-success btn-block"><b>Add</b></a>
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
<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">輸入產品名稱</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					<input type="text" class="form-control" id="search_p" name="search_p" placeholder="輸入產品名稱">
				</div>
				<div id='div_modal_search'>
					<select id='div_search' name="txt_search" class='form-control' size='12'></select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="change_pdt" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/summernote/summernote.min.js"></script>
<script src="<?= base_url() ?>assets/summernote/summernote-zh-TW.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/summernote/summernote.css">
<script type="text/javascript">
$(function() {
	datetimepick();
	var row =<?= $row;?>;

	$(document).on('click', '.btn-remove', function() {
		$(this).parents('.input-group:first').remove();
		return false;
	});

	$(document).on('click', '.psearch', function() {
		$("#hid_row").val($(this).attr('row'));
	});

	$('#btn_add').click(function() {
		row = row + 1;
		
		$("#hid_row").val(row);
		
		var html = '';
		html += '<div class="input-group margin">';
		html += '<input type="text" class="form-control" name="txt_pdt_name[]" value="" row="'+row+'" disabled/>';
		html += '<input type="hidden" name="hid_products_id[]" value="" row="'+row+'" />';
		html += '<span class="input-group-btn">';
		html += '<button type="button" class="btn btn-info btn-flat psearch" data-toggle="modal" data-target="#modal-default" row="'+row+'" >Search</button>';
		html += '<button type="button" class="btn btn-danger btn-flat btn-remove" row="'+row+'" >-</button>';
		html += '</span>';
		html += '</div>';
		$('#add_block').append(html);
	});	

	$('.modal').on('shown.bs.modal', function () {
		$("input[name='search_p']").focus();
	});

	$("#change_pdt").bind("click",function(){
		if($('#div_search').val() === null) return;
		$("input[name='txt_pdt_name[]'][row="+$('#hid_row').val()+"]").val($('#div_search :selected').text());
		$("input[name='hid_products_id[]'][row="+$('#hid_row').val()+"]").val($('#div_search :selected').val())
		$("#modal-default").modal('hide');
	});

	$('#search_p').bind('keyup', function() {
	if($("input[name='search_p']").val().length == 0) return;
		$('#div_modal_search').html();
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'theme/ProductSearch',
			cache: false,
			async: false,
			data: {keyword : $('#search_p').val()},
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				$('#div_modal_search').html(response.responseText);
			}
		});
		return false;			
	});

	$('#big_picture').click(function() {
		if($('#big_picture').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});	

	initFileinput();
	$('#big_picture').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_big_pic]').val(response.new_path);
		$('#big_picture').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_name);
	});	

	$('#btn_save').bind('click', function() {
		if(!$('#form1')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'theme/doEdit',
			cache: false,
			async: false,
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
	$('#big_picture').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: true,
		maxFileSize: 51200,
		minImageWidth: 1440,
		minImageHeight: 480,
		maxImageWidth: 1440,
		maxImageHeight: 480,
		language: "zh-TW",
<?php if($id != '0'): ?>
		initialCaption: "<?= $info[0]['pic_cover']?>",
		initialPreview: ['<img src="<?= URL_GOOGLE_IMG.$info[0]['pic_cover'] ?>" height="170 class="kv-preview-data krajee-init-preview file-preview-image">'],
<?php endif; ?>
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qmaker' };
			return info;
		}
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
}

function datetimepick() {
	$(".daterange").daterangepicker({
		opens: 'left',
		timePicker: true,
		locale: {
			format: 'YYYY-MM-DD HH:mm'
		}
	});
}
</script>