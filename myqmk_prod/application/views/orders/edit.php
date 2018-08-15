<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		訂單管理
		<small>訂單資訊及設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<input type='hidden' name='hid_order_id' value="<?= $ary_data[0]['order_id'] ?>">
	<input type='hidden' name='hid_store_id' value="<?= $ary_data[0]['store_id'] ?>">
	<br>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">訂單單號</label>
			<div class="checkbox">
				<div class="col-sm-10"><?= $ary_data[0]['order_id'] ?></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">訂購時間</label>
			<div class="checkbox">
				<div class="col-sm-10"><?= $ary_data[0]['dt_create'] ?></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">計畫名稱</label>
			<div class="checkbox">
				<div class="col-sm-10"><?= $ary_data[0]['project_name'] ?></div>
			</div>
		</div>
	</div>
<?php $total = 0 ?>
<?php if(count($ary_data) > 0): ?>
<?php foreach ($ary_data as $val): ?>
	<div class="form-group">
		<div class="row">
<?php if($total == 0): ?>			
			<label class="col-sm-2 control-label">贊助商品名稱</label>
<?php else: ?>
			<label class="col-sm-2 control-label">　</label>
<?php endif; ?>
			<div class="checkbox">
				<div class="col-sm-1">$ <?= $val['price_deal'] ?></div>
				<div class="col-sm-9"><?= $val['product_name'] ?></div>
			</div>
		</div>
<?php $total += $val['price_deal'] ?>
	</div>
<?php endforeach;?>
<?php endif; ?>	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">收件人</label>
			<div class="checkbox">
				<div class="col-sm-10"><?= $ary_data[0]['rec_name'] ?></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">收件電話</label>
			<div class="checkbox">
				<div class="col-sm-10"><?= $ary_data[0]['rec_phone'] ?></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">收件地址</label>
			<div class="checkbox">
				<div class="col-sm-10"><?= $ary_data[0]['rec_addr'] ?></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">訂單備註</label>
			<div class="checkbox">
				<div class="col-sm-10"><?= $ary_data[0]['descr'] ?></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">付款金額（含運費）</label>
			<div class="checkbox">
				<div class="col-sm-10">$ <?= $total ?></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">付款狀態</label>
			<div class="checkbox">
				<div class="col-sm-10"><?= $ary_payment[$ary_data[0]['status_payment']] ?></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">寄送狀態</label>
			<div class="checkbox">
				<div class="col-sm-2">
					<?= form_dropdown('sel_is_send', $ary_send, $ary_data[0]['is_send'], 'class="form-control"'); ?>
				</div>
				<div class="col-sm-8"></div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">管理者備註</label>
			<div class="checkbox">
				<div class="col-sm-2">
					<textarea name='txt_descr' class="form-control" rows="5" placeholder="限50字"><?= $ary_data[0]['admin_descr'] ?></textarea>
				</div>
				<div class="col-sm-8"></div>
			</div>
		</div>
	</div>
</form>
</section>
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
			url: $('#hid_baseurl').val() + 'orders/doEdit',
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
</script>