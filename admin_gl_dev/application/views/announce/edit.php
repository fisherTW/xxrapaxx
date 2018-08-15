<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		公告管理
<?php if ($id != '0'): ?>
		<small>公告內容設定</small>
<?php else: ?>
		<small>公告內容新增</small>
<?php endif; ?>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<br>
<?php if ($id != '0'): ?>
	<input type="hidden" name="hid_announce_id" value='<?= $info[0]['id'] ?>'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">公告標題</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_title" required value="<?= $info[0]['title']?>">
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">狀態</label>
		<div class="col-sm-9">
			<label class="radio-inline">
				<input type="radio" name="rdo_is_enable" value='1' <?= $info[0]['is_enable'] == 1 ? 'checked' : '' ?>>上架
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_is_enable" value='0' <?= $info[0]['is_enable'] == 0 ? 'checked' : '' ?>>下架
			</label>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">期間</label>
		<div class="col-sm-9">
			<input class="form-control daterange" type="text" name="daterange" value="<?= $date ?>" readonly />			
		</div>		
	</div>
<?php else : ?>
	<input type="hidden" name="hid_announce_id" value='0'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">公告標題</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_title" required value="">
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">狀態</label>
		<div class="col-sm-9">
			<label class="radio-inline">
				<input type="radio" name="rdo_is_enable" value='1' checked>上架
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_is_enable" value='0'>下架
			</label>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">期間</label>
		<div class="col-sm-9">
			<input class="form-control daterange" type="text" name="daterange" value="<?= $date ?>" readonly />			
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
	datetimepick();
	$('#btn_save').bind('click', function() {
		if(!$('#form1')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'announce/doEdit',
			cache: false,
			async : false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				location.href = $('#hid_baseurl').val() + 'announce';
			}
		});
		return false;
	});		
	$('#btn_cancel').bind('click', function() {
		location.href = $('#hid_baseurl').val() + 'announce';
	}); 

});

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