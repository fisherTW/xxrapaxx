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
		<div class="box box-info">
			<div class="box-body">
				<i class="fa fa-info-circle"></i> <span style="color: red">所有欄位都必須填寫，資料填寫送出後，若要進行修正，需要透過 RapaQ 窗口進行修改</span>
			</div>
		</div>
	</ul>
<form class="form-horizontal" id="form1">
	<br>
	<input type="hidden" name="hid_payment_id" value='<?= $info[0]['id'] ?>'>
	<input type="hidden" name="hid_user_id" value='<?= $info[0]['user_id'] ?>'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">財務聯絡人</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="contact_person" name="contact_person" required value="<?= $info[0]['contact_person']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">銀行名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="bank_name" name="bank_name" required value="<?= $info[0]['bank_name']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">銀行分行名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="branch_name" name="branch_name" required value="<?= $info[0]['branch_name']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">銀行戶名</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="account_name" name="account_name" value="<?= $info[0]['account_name']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">銀行帳號</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="account" name="account" required value="<?= $info[0]['account']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">統一編號/身分證號</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="identity_id" name="identity_id" required value="<?= $info[0]['identity_id']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">發票抬頭</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="invoice_title" name="invoice_title" required value="<?= $info[0]['invoice_title']?>">
		</div>		
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">發票地址</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="invoice_addr" name="invoice_addr" required value="<?= $info[0]['invoice_addr']?>">
		</div>		
	</div>
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
				url: $('#hid_baseurl').val() + 'payment/doEdit',
				cache: false,
				async : false,
				data: $('#form1').serialize(),
				error: function(xhr){
					alert("Failure");
				},
				complete: function(response){
					location.href = $('#hid_baseurl').val() + 'payment';
				}
			});
			return false;			
		});		
		$('#btn_cancel').bind('click', function() {
			location.href = $('#hid_baseurl').val() + 'payment';
		}); 
	});	
</script>