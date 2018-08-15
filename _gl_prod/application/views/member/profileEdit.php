<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/locale/zh-tw.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
<link href='<?= base_url()?>assets/css/validation.css' rel='stylesheet' type='text/css'/>

<div class="mask"></div>
<nav class="nav">
	<div class="nav-load">
	</div>
</nav>
<div class="wrapper wrapperzero">
	<div class="wrapper-inner">
				<section class="m-notify">

	<form class="form-horizontal vrf" id='form_1'>
		<input type='hidden' id='hid_baseurl' value='<?= base_url(); ?>'>
		<input type='hidden' id='hid_id' name='hid_id' value='<?= isset($info['id']) ? $info['id'] : 0 ?>'>
		<div class="row"></div>

		<div class="form-group">
			<label for="" class="col-sm-3 control-label">姓名</label>
			<div class="col-sm-7">
				<input type='text' class='form-control' id='txt_name' name='txt_name' value='<?= $info['name'] ?>' readonly/>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-7">
				<input type='text' class='form-control' id='txt_mail' name='txt_mail' value='<?= $info['mail'] ?>' readonly/>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">生日</label>
			<div class="col-sm-7">
				<div class="input-group dtp" id="">
					<input type="text" name="txt_date_birth" class="form-control" required="" pattern="[0-9]{4}[-][0-9]{2}[-][0-9]{2}" value="<?= $info['date_birth'] ?>">
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">電話</label>
			<div class="col-sm-7">
				<input type='text' class='form-control' id='txt_phone' name='txt_phone' value='<?= $info['phone'] ?>' pattern="[+]?[0-9]{10,}" placeholder='請填寫電話號碼全碼，如 0221231234、0912123456、+1415000000'/>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">性別</label>
			<div class="col-sm-7">
				<?= form_dropdown('sel_gender', $ary_gender, $info["gender"], 'class="form-control"'); ?>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">自我描述</label>
			<div class="col-sm-7">
				<textarea type='text' rows='5' class='form-control' id='txt_aboutme' name='txt_aboutme'><?= $info['aboutme'] ?></textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-10">
				<div class="pull-right">
					<button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
					<button type="button" class='btn btn-primary' name="btn_save" id="btn_save">Save</button>
				</div>
			</div>
		</div>
	</form>
</section>
</div>
</div>
<script type="text/javascript">
$(function () {
	$(".dtp").datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'zh-tw',
		defaultDate: moment()
	});	
	$("#btn_cancel").bind("click",function() {
		window.location = '<?= base_url() ?>member/main';
	});

	$("#btn_save").bind("click",function() {
		if(!$('#form_1')[0].checkValidity()) return;
		$.ajax({
			async: false,
			type: "POST",
			url: $('#hid_baseurl').val() + 'member/profileEdit_doEdit',
			data: $('#form_1').serialize(),
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