<link href='<?= base_url()?>assets/css/checkout.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/member.css' rel='stylesheet' type='text/css'/>
<script src='<?= base_url()?>assets/js/member.js'></script>

<div class="wrapper">
	<section class="m-return">
		<div class="m-return-wrap">
			<div class="m-return__title">
				退款帳號
			</div>
			<div class="m-return-bank">
				<ul class="m-return-bank-fillin">
					<li>
						<div class='form-control'>
							<select id='sel_search'>請選擇銀行名
								<ul>
									<option>011 上海銀行</option>
									<option>812 台新銀行</option>
									<option>004 台灣銀行</option>
									<option>008 華南銀行</option>
									<option>808 玉山銀行</option>
									<option>822 中國信託</option>
								</ul>
							</select>
						</div>
					</li> 
					<li>
						<input type="text" class="fillin__branch" placeholder="請輸入分行名稱" data-check="branch">
					</li>
					<li>
						<input type="text" class="fillin__user" placeholder="請輸入銀行戶名" data-check="user">
					</li>
					<li>
						<input type="text" class="fillin__account" placeholder="請入銀行帳號" data-check="account">
					</li>
				</ul>
			</div>
		</div>
	</section>
	<div class="m-dock">
		<ul class="m-dock-btns">
			<li class="m-dock-btns__submit is--disable">
				送出
			</li>
			<li class="m-dock-btns__cancel">
				<a href="<?= base_url() ?>member/orderDetail">取消</a>
			</li>
		</ul>
	</div>
</div>

<script type="text/javascript">
	 //-- 所有資料填入
	function checkinput(){
		var inputlength = $("input[data-check]:visible").length;
		var st = 0;
		$.each($("input[data-check]"),function(i,v){
			if($(v).val()!=""){
				st = st+1;
			}
		});
		if(inputlength == st){
			$('.m-dock-btns__submit').removeClass('is--disable');
		}else{
			$('.m-dock-btns__submit').addClass('is--disable');
		}
	}
	$(document).ready(function() {
		setInterval("checkinput()",100);
	});
	//確認按鈕呈黃色就可以發動連結
	$('.m-dock-btns__submit').click(function(){
		if($(this).hasClass('is--disable')){
		}else{
			window.location.href= '<?= base_url() ?>member/orderDetail';
		}
	});
</script>