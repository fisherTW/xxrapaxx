<link href='<?= base_url()?>assets/css/member-add.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/member.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/validation.css' rel='stylesheet' type='text/css'/>

<script src='<?= base_url()?>assets/js/member.js'></script>

<input type='hidden' id='hid_baseurl' value='<?= base_url(); ?>'>

<div class="wrapper wrapperzero">
	<section class="m-address m-addressEdit pt0 pb0" style='margin-top: 60px'>
		<div class="m-address-wrap">
			<div class="m-address__title">
				<?= (strval($info['id']) != '0') ? '編輯' : '新增' ?>常用收件地址
			</div>
			<form id='form_1' class="vrf">
				<input type='hidden' id='hid_id' name='hid_id' value='<?= isset($info['id']) ? $info['id'] : 0 ?>'>
				<ul class="m-address-edit">
					<li>
						<input type="text" name='txt_rec_name' class="input__name" placeholder="收件人姓名" data-check="Name" value='<?= isset($info['rec_name']) ? $info['rec_name'] : '' ?>' required>
					</li>
					<li>
						<input type="text" name='txt_rec_phone' class="input__tel" placeholder="收件聯絡電話" data-check="Tel" value='<?= isset($info['rec_phone']) ? $info['rec_phone'] : '' ?>' pattern='[+]?[0-9]{10,}' required>
						<div class="input__ps">
						</div>
					</li>
					<li>
						<input type="text" name='txt_zip' class="input__code" placeholder="郵遞區號" data-check="Code" value='<?= isset($info['zip']) ? $info['zip'] : '' ?>' pattern='[0-9]{3,5}' required>
					</li>
					<li>
						<input type="text" name='txt_rec_addr' class="input__address" placeholder="收件地址"  data-check="Address" value='<?= isset($info['rec_addr']) ? $info['rec_addr'] : '' ?>' required>
						<div class="input__ps">請勿填寫郵政信箱。</div>
					</li>
					<li>
						<input type="text" name='txt_name' class="input__address" placeholder="此收件地址是...(如：公司、家裡。)" data-check="Location" value='<?= isset($info['name']) ? $info['name'] : '' ?>' required>
					</li>
				</ul>
			</form>
		</div>
	</section>
	<ul class="m-btns" style="z-index:700">
		<li class="m-btns__submit" id='btn_save'>
			確定
		</li>
		<li class="m-btns__cancel" id='btn_cancel'>
			取消
		</li>
	</ul>
</div>
<script type="text/javascript">
$(function () {	
	$("#btn_cancel").bind("click",function() {
		window.location = '<?= base_url() ?>member/addressBook';
	});	
	$("#btn_save").bind("click",function() {
		if(!$('#form_1')[0].checkValidity()) return;
		$.ajax({
			async: false,
			type: "POST",
			url: $('#hid_baseurl').val() + 'member/addressBookDoEdit',
			data: $('#form_1').serialize(),
			statusCode: {
				200: function(e) {
					window.location = '<?= base_url() ?>member/addressBook';
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