<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		首頁管理-創創
		<small>首頁顯示</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
<?php foreach ($info as $key => $value) { $info['name'][$value['id']]= $value['name'];}?>
<form class="form-horizontal" id="form1">
	<br>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">顯示計畫-1</label>
		<div class="col-sm-5">
			<?= form_dropdown('is_show1', $info['name'], $showmain[0]['id'], 'class="form-control"'); ?>
		</div>
		<div class="col-sm-1">顯示名稱</div>
		<div class="col-sm-3">
			<label class="radio-inline">
				<input type="radio" name="rdo_is_show1" value='1' <?= $showmain[0]['is_showname'] == 1 ? 'checked' : '' ?>>是
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_is_show1" value='0' <?= $showmain[0]['is_showname'] == 0 ? 'checked' : '' ?>>否
			</label>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">顯示計畫-2</label>
		<div class="col-sm-5">
			<?= form_dropdown('is_show2', $info['name'], $showmain[1]['id'], 'class="form-control"'); ?>
		</div>
		<div class="col-sm-1">顯示名稱</div>
		<div class="col-sm-3">
			<label class="radio-inline">
				<input type="radio" name="rdo_is_show2" value='1' <?= $showmain[1]['is_showname'] == 1 ? 'checked' : '' ?>>是
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_is_show2" value='0' <?= $showmain[1]['is_showname'] == 0 ? 'checked' : '' ?>>否
			</label>		
		</div>		
	</div>
</form>
<script type="text/javascript">
$(function () {
	$('#btn_save').bind('click', function() {
		if(!$('#form1')[0].checkValidity()) return;
		if ($('select[name=is_show1]').val() == $('select[name=is_show2]').val()) {
			alert('重複選擇');
			return;
		}
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'showmain/doEditQmaker',
			cache: false,
			async : false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				location.href = $('#hid_baseurl').val() + 'showmain/index_qmaker';
			}
		});
		return false;
	});
});

</script>
</section><!-- /.content -->
<section class="content-footer">
    <div class='box-footer text-right'>
        <button type="button" class='btn btn-primary' name="btn_save" id="btn_save">Save</button>
    </div>
</section>