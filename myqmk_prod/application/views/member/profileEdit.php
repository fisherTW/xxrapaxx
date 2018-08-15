<div class="mask"></div>
<nav class="nav">
	<div class="nav-load">
	</div>
</nav>
<div class="wrapper wrapperzero">
	<div class="wrapper-inner">
				<section class="m-notify">

	<form class="form-horizontal" id='form1'>
		<input type='hidden' id='hid_baseurl' value='<?= base_url(); ?>'>
		<input type='hidden' id='hid_id' name='hid_id' value='<?= $info['id'] ?>'>
		<div class="row"></div>
		<div class="row"></div>
		<div class="row"></div>		
		<div class="form-group">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-1">
					<label class="control-label">姓名</label>
				</div>
				<div class="col-sm-3">
					<input type='email' class='form-control' id='txt_name' name='txt_name' value='<?= $info['name'] ?>' />
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-1">
					<label class="control-label">Email</label>
				</div>
				<div class="col-sm-3">
					<input type='email' class='form-control' id='txt_mail' name='txt_mail' value='<?= $info['mail'] ?>' />
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>	
		<div class="form-group">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-1">
					<label class="control-label">生日</label>
				</div>
				<div class="col-sm-3">
					<input type='text' class='form-control' id='txt_date_birth' name='txt_date_birth' value='<?= $info['date_birth'] ?>' />
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-1">
					<label class="control-label">電話</label>
				</div>
				<div class="col-sm-3">
					<input type='text' class='form-control' id='txt_phone' name='txt_phone' value='<?= $info['phone'] ?>' />
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-1">
					<label class="control-label">性別</label>
				</div>
				<div class="col-sm-3">
					<div class="checkbox" id='div_gender'>
						<?= form_dropdown('sel_gender', $ary_gender, $info["gender"], 'class="form-control"'); ?>
					</div>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class='col-sm-4'></div>
				<div class='col-sm-1'>
					<label class="control-label">自我描述</label>
				</div>
				<div class="col-sm-3">
					<textarea type='text' class='form-control' id='txt_aboutme' name='txt_aboutme'><?= $info['aboutme'] ?></textarea>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">			
				<div class="col-sm-4"></div>
				<div class="col-sm-1">
					<label class="control-label">聯絡資訊</label>
				</div>
				<div class="col-sm-3">

				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6"></div>
				<div class="col-sm-2">
					<h1></h1>
					<button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
					<button type="button" class='btn btn-primary' name="btn_save" id="btn_save">Save</button>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</form>
</section>
</div>
</div>
<script type="text/javascript">
$(function () {
	$("#btn_cancel").bind("click",function(){
		window.location = '<?= base_url() ?>member/main';
	});

	$("#btn_save").bind("click",function(){
		$.ajax({
			async: false,
			type: "POST",
			url: $('#hid_baseurl').val() + 'member/profileEdit_doEdit',
			data: $('#form1').serialize(),
			statusCode: {
				200: function(e) {
					alert('操作成功');
				}
			},
			error: function() {
				alert('操作失敗');
			}
		});
		window.location = '<?= base_url() ?>member/main';
	});
});	
</script>