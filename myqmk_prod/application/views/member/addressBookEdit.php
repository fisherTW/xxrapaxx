<link href='<?= base_url()?>assets/css/member-add.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/member.css' rel='stylesheet' type='text/css'/>
<script src='<?= base_url()?>assets/js/member.js'></script>

<div class="wrapper wrapperzero">
	<section class="m-address m-addressEdit pt0 pb0">
		<div class="m-address-wrap">
			<div class="m-address__title">
				新增常用收件地址
				<!--↑↑ or 編輯常用收件地址 -->
			</div>
			<ul class="m-address-edit">
				<li>
					<input type="text" class="input__name" placeholder="收件人姓名" data-check="Name">
				</li>
				<li>
					<input type="tel" class="input__tel" placeholder="收件聯絡電話" data-check="Tel">
					<!-- 如果格式錯誤, 
						  則在class多寫一個 is--wrong -->
					<div class="input__ps">
						<!-- <span class="ps__wrong">   
							您輸入的電話號碼格式錯誤
						</span> -->
					</div>
				</li>
				<li>
					<input type="text" class="input__code" placeholder="郵遞區號" data-check="Code">
				</li>
				<li>
					<input type="text" class="input__address" placeholder="收件地址"  data-check="Address">
					<div class="input__ps">請勿填寫郵政信箱。</div>
					<!-- 若是"編輯頁"的地址，這段ps可以不用備註 -->
				</li>
				<li>
					<input type="text" class="input__address" placeholder="此收件地址是...(如：公司、家裡。)" data-check="Location">
				</li>
			</ul>
		</div>
	</section>
	<ul class="m-btns">
		<li class="m-btns__submit is--disable">
			確定
		</li>
		<li class="m-btns__cancel">
			<a href="<?= base_url() ?>member/addressBook">取消</a>
		</li>
	</ul>
</div>
<script type="text/javascript">
	function checkinput(){
		var inputlength = $("input[data-check]").length;
		var st = 0;
		$.each($("input[data-check]"),function(i,v){
			if($(v).val()!=""){
				st = st+1;
			}
		});
		if(inputlength == st){
			$(".m-btns__submit").removeClass('is--disable');
		}else{
			$(".m-btns__submit").addClass('is--disable');
		}
	}
	$( document ).ready(function() {
		setInterval(checkinput,100);
	});
	//確認按鈕呈黃色就可以發動連結
	$('.m-btns__submit').click(function(){
		if($(this).hasClass('is--disable')){
		}else{
			window.location.href= '<?= base_url() ?>member/addressBook';
		}
	});
</script>