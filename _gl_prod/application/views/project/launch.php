<input type='hidden' id='hid_baseurl' value='<?= base_url()?>'>
<link rel="stylesheet" href="<?= base_url()?>assets/css/launch.css">
<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/validation.css' rel='stylesheet' type='text/css'/>
<style>
	.mainbar-aside-menu > div:nth-child(2) a,
	.toggle-menu > div:nth-child(2) a{
		color:#d01120;
	}
</style>

<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>
<div class="div_maskForSearch"></div>
<div class="wrapper">
	<div class="wrapper-inner">
		<header class="l-header" style="margin-top: 40px">
			<div class="l-header__bg"></div> 
			<div class="l-header__title">
				發起計畫
			</div>
			<ul class="l-header__process">
				<li class="processing process-info">
					<div class="processing__circle">
						<div class="processing__circle_dot"></div>
					</div>
					<div class="processing__text">基本資料</div>
				</li>
				<li class="processingline"></li>
				<li class="processing process-outline">
					<div class="processing__circle">
						<div class="processing__circle_dot dot-white"></div>
					</div>
					<div class="processing__text">計畫大綱</div>
				</li>
				<li class="processingline"></li>
				<li class="processing process-submit">
					<div class="processing__circle">
						<div class="processing__circle_dot dot-white"></div>
					</div>
					<div class="processing__text">計畫送出</div>
				</li>
			</ul>
		</header>
		<section class="l-fill">
			<div class="l-fill-wrap section-wrap">
				<form id='form_1' class='vrf'>
					<ul class="l-fill-fillin">
						<li class="">
							<label class="fillin__th">真實姓名</label>
							<input type="text" name='txt_user_name' class="fillin__input"/ required>
							<div class="fillin__ps">真實姓名僅提供審核使用，不會顯示在計畫頁上面。</div>
						</li>
						<li class="">
							<label class="fillin__th">聯絡電話</label>
							<input type="text" name='txt_user_phone' class="fillin__input" required pattern='[+]?[0-9]{10,}'>
							<div class="fillin__ps">請填寫電話號碼全碼，如 0221231234、0912123456、+1415000000。</div>
						</li>
						<li class="">
							<label class="fillin__th">聯絡信箱</label>
							<input type="email" name='txt_user_mail' style='width: 100%;margin-top: 10px;' class="fillin__input" required>
							<div class="fillin__ps">我們會以此E-mail聯繫你！</div>
						</li>
						<li class="">
							<label class="fillin__th">個人簡介</label>
							<textarea name='txt_user_profile' class="fillin__textarea" required maxlength="120"></textarea>
							<div class="fillin__ps">文字限定在120字內，請酌量使用。</div>
						</li>
						<li class="">
							<div class="fillin__checkbox">
								<div class="fillin__agree">
									<input type="checkbox" name="cbG01" id="checkagree" class="check-agree" required />
									<label for="checkagree" class="label-agree">同意提案契約書</label>
								</div>
							</div>
							<div class="fillin__ps">請確認你已經閱讀並且同意 <span><a href="https://qmaker.rapaq.com/other/licence.pdf">提案人合作條款。</a></span></div>
						</li>
					</ul>
				</form>
				<div class="l-fill__btn btn-project"><a id='btn_next'>下一步</a></div>
			</div>

		</section>
	</div>
</div>
<script>
	$(function(){
		$('#btn_next').bind('click', function() {
			if(!$('#form_1')[0].checkValidity()) return;

			$.ajax({
				type: "POST",
				url: $('#hid_baseurl').val() + 'project/writeSession',
				cache: false,
				async : false,
				data: $('#form_1').serialize(),
				error: function(xhr){
					alert("Failure");
				},
				complete: function(response){
					switch(response.responseText) {
						case '1':
							window.location = $('#hid_baseurl').val() + 'project/launchOutline';
							break;
					}
				}
			});
			return false;
		});

		$('.footer-trigger').click(function(){
			$(".footer").toggleClass("active--1");
		});

		$('#checkincronizar').on('change',function(){
			if ($('#checkincronizar').prop('checked')) {
				swal({
				  title: "同步",
				  text: "您的E-mail已及個人簡介，將同步至RapaQ設群，並將原本的取代",
				  showCancelButton: true,
				  cancelButtonText: "取消",
				  cancelButtonClass: 'sa-rapaq-cancel',
				  confirmButtonText: "確定",
				  confirmButtonClass: 'sa-rapaq-confirm confirm--mc',
				  customClass: 'sa-rapaq double-btn'
				})
			}
		});
	});

	function onclkNext() {

	}
</script>
