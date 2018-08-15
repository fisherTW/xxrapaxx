<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		供應商管理
<?php if ($id != '0'): ?>
		<small>供應商內容設定</small>
<?php else: ?>
		<small>供應商內容新增</small>
<?php endif; ?>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<br>
<?php if ($id != '0'): ?>
	<input type="hidden" name="hid_supplier_id" value='<?= $info[0]['id'] ?>'>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">供應商編號</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_old_num"  value="<?= $info[0]['old_num']?>" placeholder="格式000-000" pattern="(\d{3}-\d{3})?$" required/>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">供應商名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_name" value="<?= $info[0]['name']?>" placeholder="限50字" maxlength="50" required />
		</div>		
	</div>
	
<?php else : ?>
	<input type="hidden" name="hid_supplier_id" value='0'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">供應商編號</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_old_num" value="" placeholder="格式000-000" pattern="(\d{3}-\d{3})?$" required/>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">供應商名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_name" value="" placeholder="限50字" maxlength="50" required />
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
			url: $('#hid_baseurl').val() + 'supplier/doEdit',
			cache: false,
			async : false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				location.href = $('#hid_baseurl').val() + 'supplier';
			}
		});
		return false;			
	});		
	$('#btn_cancel').bind('click', function() {
		location.href = $('#hid_baseurl').val() + 'supplier';
	}); 

});
</script>