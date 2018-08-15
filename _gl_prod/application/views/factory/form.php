<link href='<?= base_url()?>assets/css/launch.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>

<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>

<input type='hidden' id='hid_baseurl' value='<?= base_url()?>'>
<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="wrapper">
	<div class="mask-z"></div>
		<header class="l-header" style="margin-top: 100px">
			<div class="l-header__bg"></div>
			<div class="l-header__title">
				申請表單
			</div>
			<ul class="l-header__process">
				<li class="processing process-info">
					<div class="processing__circle">
						<div class="processing__circle_dot"></div>
					</div>
					<div class="processing__text">填寫表單</div>
				</li>
				<li class="processingline"></li>
				<li class="processing process-submit">
					<div class="processing__circle">
						<div class="processing__circle_dot dot-white"></div>
					</div>
					<div class="processing__text">送出申請</div>
				</li>
			</ul>
		</header>
		<section class="l-flow">
			<div class="l-flow-wrap section-wrap">
				<div class="l-fill__title">我們幫助</div>
				<div class="l-flow-pic">
					<img src="<?= base_url() ?>assets/img/flow.png" alt="">
				</div>
			</div>
		</section>
		<section class="l-fill">
			<div class="l-fill-wrap section-wrap">
				<div class="l-fill-contact">
					<div class="l-fill__title">直接與 募設計 聯絡</div>
					<div class="l-fill-contact__info">
						聯絡人：周先生 <br>
						聯絡電話：02-7708-5085 分機：601 <br>
						聯絡信箱：<a href="mailto:juliuschou@rapaq.com" style="color:#5a11bd">juliuschou@rapaq.com </a>
					</div>
				</div>
				<div class="l-fill-table">
					<div class="l-fill__title">或填寫聯絡表單</div>
					<form id='form1'>
						<ul class="l-fill-fillin">
							<li class="">
								<label class="fillin__th">公司名稱</label>
								<input name='txt_company_name' type="text" class="fillin__input" placeholder="請輸入內容" />
							</li>
							<li class="">
								<label class="fillin__th">公司網站</label>
								<input name='txt_company_web' type="text" class="fillin__input" placeholder="請輸入內容" />
							</li>
							<li class="">
								<label class="fillin__th">聯絡人姓名</label>
								<input name='txt_name' type="text" class="fillin__input" placeholder="請輸入內容" />
							</li>
							<li class="">
								<label class="fillin__th">聯絡人身份</label>
								<?= form_dropdown('sel_identity', $ary_identity, '', 'class="form-control"'); ?>
							</li>
							<li class="">
								<label class="fillin__th">聯絡電話</label>
								<input name="txt_tel" type="text" class="fillin__input" placeholder="請輸入內容" />
							</li>
							<li class="">
								<label class="fillin__th">聯絡信箱</label>
								<input name="txt_mail" type="text" class="fillin__input" placeholder="請輸入內容" />
							</li>
							<li class="">
								<label class="fillin__th">留言</label>
								<textarea name="txt_descr" class="fillin__textarea"></textarea>
								<div class="fillin__ps">文字限定在120自內，請酌量使用。</div>
							</li>
						</ul>
					</form>
					<div class="l-fill__btn btn-project">
						<a id='btn_save'>送出申請</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	$("#btn_save").bind("click",function(){
//			if(!$("form")[0].checkValidity()) return;
		$.ajax({
			async: false,
			type: "POST",
			url: $('#hid_baseurl').val() + 'factory/form_doEdit',
			data: $('#form1').serialize(),
			statusCode: {
				200: function() {
					window.location = $('#hid_baseurl').val() + 'factory/form_done';					
				}
			},
			error: function() {
				alert('操作失敗');
			}
		});
});
</script>