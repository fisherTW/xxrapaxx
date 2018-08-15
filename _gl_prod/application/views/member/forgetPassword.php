<link href='<?= base_url()?>assets/css/validation.css' rel='stylesheet' type='text/css'/>


<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<br>
<br>
<br>
<div class="div_home">

	<form class="form-horizontal vrf" id='form_1'>
		<div class="row"></div>

		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-7">
				<input type='email' class='form-control' id='txt_mail' name='txt_mail' value='' required />
			</div>
		</div>

	</form>

	<button id='btn_submit' class='form-control'>寄送密碼重設信</button>
</div>

<script type="text/javascript">
$(function(){
	$('#btn_submit').bind('click', function(){
		if(!$("form")[0].checkValidity()) return;

		$.ajax({
			async: false,
			type: "POST",
			url: '<?= base_url() ?>member/doForgetPassword',
			data: $('#form_1').serialize(),
			statusCode: {
				200: function(e) {
					alert('若信箱無誤，我們會寄送一封密碼重設信件給您，請依信件內文指示操作');
				}
			},
			error: function() {
				alert('Failure');
			}
		});			
	});
})	
</script>
