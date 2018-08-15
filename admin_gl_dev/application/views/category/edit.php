<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		商品分類管理
<?php if ($id != '0'): ?>
		<small>商品分類設定</small>
<?php else: ?>
		<small>商品分類新增</small>
<?php endif; ?>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<br>
<?php if ($id != '0'): ?>
	<input type="hidden" name="hid_category_id" value='<?= $info[0]['id'] ?>'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">上一層</label>
		<div class="col-sm-9">
<?php if ($edit == '1'): ?>
			<?= form_dropdown('txt_category' , $ary_category, $info[0]['parent'], 'class="form-control" disabled'  ); ?>
<?php else : ?>
			<?= form_dropdown('txt_category' , $ary_category, $info[0]['parent'], 'class="form-control"'  ); ?>
<?php endif; ?>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">分類名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_name" required value="<?= $info[0]['name']?>">
		</div>		
	</div>
	
<?php else : ?>
	<input type="hidden" name="hid_category_id" value='0'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">上一層</label>
		<div class="col-sm-9">
			<?= form_dropdown('txt_category' , $ary_category, '0', 'class="form-control"'); ?>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">分類名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_name" required value="">
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
	
	$('#btn_save').bind('click', function() {
		if(!$('#form1')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'category/doEdit',
			cache: false,
			async : false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				location.href = $('#hid_baseurl').val() + 'category';
			}
		});
		return false;			
	});		
	$('#btn_cancel').bind('click', function() {
		location.href = $('#hid_baseurl').val() + 'category';
	}); 

});
</script>