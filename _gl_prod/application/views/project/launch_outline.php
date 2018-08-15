<input type='hidden' id='hid_baseurl' value='<?= base_url()?>'>
<style>
	.mainbar-aside-menu > div:nth-child(2) a,
	.toggle-menu > div:nth-child(2) a{
		color:#5a11bd;
	}
</style>



<script src="<?= base_url()?>assets/js/fileinput.min.js"></script>
<script src="<?= base_url()?>assets/js/fileinput_locale_zh-TW.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/locale/zh-tw.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<link href="<?= base_url()?>assets/css/fileinput.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?= base_url()?>assets/css/launch.css">
<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/validation.css' rel='stylesheet' type='text/css'/>

<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>
<div class="wrapper">
	<div class="mask"></div>
	<div class="div_maskForSearch"></div>
	<nav class="nav">
		<div class="nav-load">
		</div>
	</nav>
	<div class="wrapper-inner">
		<header class="l-header" style="margin-top: 40px">
			<div class="l-header__bg"></div>
			<div class="l-header__title">
				發起計畫
			</div>
			<ul class="l-header__process">
				<li class="processing process-info">
					<div class="processing__circle">
						<div class="processing__circle_dot dot-white"></div>
					</div>
					<div class="processing__text">基本資料</div>
				</li>
				<li class="processingline"></li>
				<li class="processing process-outline">
					<div class="processing__circle">
						<div class="processing__circle_dot"></div>
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
				<form id='form_1'  class="form-horizontal vrf">
					<ul class="l-fill-fillin">
<!-- 							
						<li class="">
							<label class="fillin__th">品牌名稱</label>
							<input type="text" name='txt_brand_name' class="fillin__input" placeholder="請輸入品牌名稱">
						</li>
						<li class="">
							<label class="fillin__th">品牌LOGO</label>
							<br>
							<div class="form-group picture">
								<div class="col-sm-12">
									<input type="file" id="file_picture" multiple class="file-loading">
									<input type="hidden" name='hid_brand_logo' id="hid_brand_logo" value="">
								</div>
							</div>
							<div class="fillin__ps">圖片尺寸為 280寬X280高px，72dpi，勿超過50K，請於上傳前處理圖片。</div>
						</li>
						<li class="">
							<label class="fillin__th">品牌簡介</label>
							<textarea name='txt_brand_profile' class="fillin__textarea" maxlength="120"></textarea>
							<div class="fillin__ps">文字限定在120字內，請酌量使用。</div>
						</li>
-->
						<li class="">
							<label class="fillin__th">計畫名稱</label>
							<input type="text" name='txt_name' class="fillin__input" placeholder="請輸入計畫名稱" required>
						</li>
						<li class="">
							<label class="fillin__th">計畫類別</label>
							<div class="select select-wh fillin__select">
								<?= form_dropdown('sel_category', $ary_category); ?>
							</div>
						</li>
						<li class="">
							<label class="fillin__th">計畫目標</label>
							<input name='txt_goal' type="number" class="fillin__input" placeholder="請輸入計畫目標金額" required min='0' max='10000000' style='width: 100%;margin-top: 10px;'>
							<label for="" class="fill__unit">NTD　　</label>
							<div class="fillin__ps">請根據你計畫的需求，估算你所需要募集的金額。</div>
						</li>
						<li style='display:none;'>
							<label class="fillin__th">計畫上限</label>
							<input name='txt_percent' type="number" placeholder="請輸入預計的計畫上限" required min='100' max='1000' style='width: 100%;margin-top: 10px;' value="100">
							<label for="" class="fill__unit">%　　</label>
						</li>
						<li class="">
							<label class="fillin__th">預計計畫開始日期</label>
							<div class="form-group">
								<div class='col-sm-12'>
									<div class='input-group dtp' id=''>
										<input type='text' name='txt_dt_exp_start' class="form-control" required/>
										<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="fillin__ps">告訴我們你希望什麼時候開始你的計畫，Q'Maker將會為你安排審核順序。Q'Maker至少需要約十個工作天審核你的提案。</div>
						</li>
						<li class="">
							<label class="fillin__th">預計計畫結束日期</label>
							<div class="form-group">
								<div class='col-sm-12'>
									<div class='input-group dtp' id=''>
										<input type='text' name='txt_dt_exp_end' class="form-control" required/>
										<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="">
							<label class="fillin__th">實現時間（產品完成日）</label>
							<div class="form-group">
								<div class='col-sm-12'>
									<div class='input-group dtp' id=''>
										<input type='text' name='txt_date_out' class="form-control" required/>
										<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="">
							<label class="fillin__th">計畫封面照片</label>
							<br>
							<div class="form-group picture">
								<div class="col-sm-12">
									<input type="file" id="file_cover" multiple class="file-loading">
									<input type="hidden" name='hid_pic_cover' id="hid_pic_cover" value="">
								</div>
							</div>
							<div class="fillin__ps">照片尺寸為 1440寬X960高px，72dpi，勿超過2MB，請於上傳前處理圖片。</div>
						</li>
						<li class="">
							<label class="fillin__th">計畫封面影片</label>
							<input name='txt_video_cover' type="text" class="fillin__input" placeholder="請輸入影片網址" style='width: 100%;margin-top: 10px;'>
							<div class="fillin__ps">EX: https://www.youtube.com/embed/kWz2vHwDuSE</div>
						</li>
						<li class="">
							<label class="fillin__th">計畫簡介</label>
							<textarea name='txt_profile' class="fillin__textarea" required maxlength="120"></textarea>
							<div class="fillin__ps">文字限定在120字內，請酌量使用。</div>
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
		$(".dtp").datetimepicker({
			format: 'YYYY-MM-DD HH:mm',
			locale: 'zh-tw',
			defaultDate: moment()
		});

		$('#btn_next').bind('click',  function (){
			if(!$('#form_1')[0].checkValidity()) return;
			$.ajax({
				type: "POST",
				url: $('#hid_baseurl').val() + 'project/doLaunch',
				cache: false,
				async : false,
				data: $('#form_1').serialize(),
				error: function(xhr){
					alert("Failure");
				},
				complete: function(response){
					switch(response.responseText) {
						case '1':
							alert('新增成功');
							window.location = $('#hid_baseurl').val() + 'project/launchDone';
							break;
					}
				}
			});
			return false;				
		});

		$('.footer-trigger').click(function(){			  
			$(".footer").toggleClass("active--1");
		});

		//select
		$('.select-wh').click(function(){
			$(this).find('ul').slideToggle(10);
			$(this).find('span').toggleClass('is--select');
		});
		$('.select ul li').click(function(){
			var str = "";
			$(this).each(function() {
			  str += $( this ).text() + " ";
			});
			$(this).parent().siblings().text( str );
			$('.select-wh ul li').parent().siblings().text( str ).css('color','#666666');
		});
	});
	$('#file_picture').click(function() {
		if($('#file_picture').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});

	$('#file_picture').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: false,
		maxFileSize: 51200,
		minImageWidth: 280,
		minImageHeight: 280,
		maxImageWidth: 280,
		maxImageHeight: 280,
		language: "zh-TW",
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qmaker' };
			return info;
		}
	});

	$('#file_picture').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_brand_logo]').val(response.new_path);
		$('#file_picture').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_name);
	});	


	$('#file_cover').click(function() {
		if($('#file_cover').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});

	$('#file_cover').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: false,
		maxFileSize: 2048000,
		minImageWidth: 1440,
		minImageHeight: 960,
		maxImageWidth: 1440,
		maxImageHeight: 960,
		language: "zh-TW",
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qmaker' };
			return info;
		}
	});

	$('#file_cover').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_pic_cover]').val(response.new_path);
		$('#file_picture').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_name);		
	});
</script>