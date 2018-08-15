<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		帳務設定
		<small>設定 RapaQ 對應帳戶資訊</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<ul class="nav nav-tabs">
		<li class=""><span style="color: red">所有欄位都必須填寫，資料填寫送出後，若要進行修正，需要透過 RapaQ 窗口進行修改</span></li>
	</ul>
<form class="form-horizontal" id="form1">
	<br>
	<input type="hidden" name="_token" value="cgrZtzNBuDPMDaTWmSFsOlw8AOkuXuyrrOPEcUS3">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">財務聯絡人</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="contact_person" name="contact_person" required <?= isset($info[0]['id']) ? 'value='.$info[0]['contact_person'].' disabled' : '' ?>>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">銀行名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="bank_name" name="bank_name" required <?= isset($info[0]['id']) ? 'value='.$info[0]['bank_name'].' disabled' : '' ?>>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">銀行分行名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="branch_name" name="branch_name" required <?= isset($info[0]['id']) ? 'value='.$info[0]['branch_name'].' disabled' : '' ?>>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">銀行戶名</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="account_name" name="account_name" required <?= isset($info[0]['id']) ? 'value='.$info[0]['account_name'].' disabled' : '' ?>>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">銀行帳號</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="account" name="account" required <?= isset($info[0]['id']) ? 'value='.$info[0]['account'].' disabled' : '' ?>>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">統一編號/身分證號</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="identity_id" name="identity_id" required <?= isset($info[0]['id']) ? 'value='.$info[0]['identity_id'].' disabled' : '' ?>>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">發票抬頭</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="invoice_title" name="invoice_title" required <?= isset($info[0]['id']) ? 'value='.$info[0]['invoice_title'].' disabled' : '' ?>>
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">發票地址</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="invoice_addr" name="invoice_addr" required <?= isset($info[0]['id']) ? 'value='.$info[0]['invoice_addr'].' disabled' : '' ?>>
		</div>		
	</div>
</form>
	
</section><!-- /.content -->
<section class="content-footer">
	<div class='box-footer text-right'>
<?php if(!isset($info[0]['id'])): ?>
		<button id="btn_save" class="btn btn-primary">Save</button>
<?php endif; ?>
	</div>
</section>




<script type="text/javascript">
	$(function() {
		$('#btn_save').bind('click', function() {
			$.ajax({
				type: "POST",
				url: $('#hid_baseurl').val() + 'payment/create',
				cache: false,
				async : false,
				data: $('#form1').serialize(),
				error: function(xhr){
					alert("Failure");
				},
				complete: function(response){
					alert('操作成功');
					location.reload();
				}
			});
			return false;		
		});
	});	
</script>