<link href='<?= base_url()?>assets/css/validation.css' rel='stylesheet' type='text/css'/>


<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<br>
<br>
<br>
<div class="div_home">

	<form class="form-horizontal vrf" id='form_1'>
		<input type='hidden' name='hid_mail' value='<?= $mail ?>'>
		<div class="row"></div>

		<div class="form-group">
			<label for="" class="col-sm-3 control-label">新密碼</label>
			<div class="col-sm-7">
				<input type='password' class='form-control' id='txt_pass' name='txt_pass' value='' required />
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">再打一次新密碼</label>
			<div class="col-sm-7">
				<input type='password' class='form-control' id='txt_pass2' name='txt_pass2' value='' required />
			</div>
		</div>

	</form>

	<button id='btn_submit' class='form-control'>重設密碼</button>
</div>

<script type="text/javascript">
$(function(){
	$('#btn_submit').bind('click', function(){
		if(!$("form")[0].checkValidity()) return;

		$.ajax({
			async: false,
			type: "POST",
			url: '<?= base_url() ?>member/resetPassword',
			data: $('#form_1').serialize(),
			statusCode: {
				200: function(e) {
					alert('重設密碼成功');
					window.location = "<?= base_url() ?>";
				}
			},
			error: function() {
				alert('Failure');
			}
		});			
	});
})	
</script>
