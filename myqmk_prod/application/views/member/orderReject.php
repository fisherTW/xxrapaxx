<link href='<?= base_url()?>assets/css/member.css' rel='stylesheet' type='text/css'/>
<script src='<?= base_url()?>assets/js/member.js'></script>

<div class="wrapper">
	<section class="m-return">
		<div class="m-return-wrap">
			<div class="m-return__title">
				申請退貨
			</div>
			<div class="m-return-bygoods">
				<div class="m-return-seegoods">
					<div class="store-goods">
						<div class="store-goods-box">
							<div class="pos-top">
								<div class="seegoods-check">
									<input type="checkbox" name="seegoodscheck" id="check01" class="seegoods__check" />
									<label for="check01" class="seegoods__label"></label>
								</div>		
								<div class="store-goods__name">
									iRing多功能手機固定環+iPhone 7 Plus雙層防摔插卡殼－限量版套組 珠光白 Plus雙層防摔插卡殼－限量版套組 珠光白 
								</div>
							</div>
							
							<div class="store-goods__pic">
								<img src="img/assests/shop01.jpg" alt="">
							</div>
							<div class="pos-right">
								<div class="store-goods__select">
									Arctic Blue
								</div>
								<div class="store-goods__price">
									NT$ 3,190 x 2
								</div>
							</div>
						</div>
						<div class="store-goods-plus">
							<span class="store-goods-plus__title">好物加購</span>
							<div class="store-goods-plus-box">
								<div class="store-goods-plus__name">
									iRing多功能手機固定環+iPhone 7 Plus雙層防摔插卡殼－限量版套組 珠光白 Plus雙層防摔插卡殼－限量版套組 珠光白 
								</div>
								<div class="store-goods-plus__pic">
									<img src="img/assests/goods02.jpg" alt="">
								</div>
								<div class="pos-right">
									<div class="store-goods-plus__select">
										Arctic Blue
									</div>
									<div class="store-goods-plus__price">
										NT$ 3,190 x 2
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="m-return-textarea">
					<textarea id="textarea-reason-1" name="textarea-reason" maxlength="100" placeholder="請輸入退貨原因"></textarea>
					<div class="textarea-words">
						<span id="words-1">0</span>/100
					</div>
				</div>
			</div>
			<div class="m-return-bygoods">
				<div class="m-return-seegoods">
					<div class="store-goods">
						<div class="store-goods-box">
							<div class="pos-top">
								<div class="seegoods-check">
									<input type="checkbox" name="seegoodscheck" id="check02" class="seegoods__check" />
									<label for="check02" class="seegoods__label"></label>
								</div>		
								<div class="store-goods__name">
									iRing多功能手機固定環
								</div>
							</div>
							
							<div class="store-goods__pic">
								<img src="img/assests/shop09.jpg" alt="">
							</div>
							<div class="pos-right">
								<div class="store-goods__select">
									Arctic Blue
								</div>
								<div class="store-goods__price">
									NT$ 3,190 x 2
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="m-return-textarea">
					<textarea id="textarea-reason-2" name="textarea-reason" maxlength="100" placeholder="請輸入退貨原因"></textarea>
					<div class="textarea-words">
						<span id="words-2">0</span>/100
					</div>
				</div>
			</div>
			<!-- ↓↓這塊是以已退貨過為例 -->
			<div class="m-return-bygoods">
				<div class="m-return-seegoods">
					<div class="store-goods">
						<div class="store-goods-box">
							<div class="pos-top">
								<div class="seegoods-check">
									<input type="checkbox" name="seegoodscheck" id="check03" class="seegoods__check check--disable" />
									<!-- 已退貨過的不能點選，要加上check--disable的class -->
									<label for="check03" class="seegoods__label"></label>
								</div>		
								<div class="store-goods__name">
									iRing多功能手機固定環+iPhone 7 Plus雙層防摔插卡殼－限量版套組 珠光白
								</div>
							</div>
							
							<div class="store-goods__pic">
								<img src="img/assests/shop15.jpg" alt="">
							</div>
							<div class="pos-right">
								<div class="store-goods__select">
									Arctic Blue
								</div>
								<div class="store-goods__price">
									NT$ 3,190 x 2
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- ↓↓如已退貨過的，就沒有textarea那塊而變成原因區塊 -->
				<div class="m-return-reason">
					<div class="m-return-reason__title">退貨原因</div>
					<div class="m-return-reason__text">
						包裝有拆封的痕跡，並非全新品
					</div>
				</div>
			</div>
		</div>

	</section>
	<div class="m-dock">
		<ul class="m-dock-btns">
			<li class="m-dock-btns__submit is--disable">
				退貨(<span id="num-check">0</span>/<span id="num-total"></span>)
			</li>
			<li class="m-dock-btns__cancel">
				<a href="<?= base_url() ?>member/order">取消</a>
			</li>
		</ul>
	</div>
</div>

<script type="text/javascript">
	$('.m-dock').removeClass('is--scrollBottom');
	 // 退貨數字
	function numCheck(){
		var checkedLength = $('input[name="seegoodscheck"]').filter(':checked').not('.check--disable').length;
		$('#num-check').text(checkedLength);
	}
	var checkLength = $('input[name="seegoodscheck"]').not('.check--disable').length;
	$('#num-total').text(checkLength);
	$('input[name="seegoodscheck"]').on('change', function(){
		numCheck();
		if($(this).prop('checked') == false) {
			var thisSibling = $(this).parents('.m-return-seegoods').siblings('.m-return-textarea');
			thisSibling.find('textarea').val('');
			thisSibling.children('.textarea-words').find('span').text('0');
		}
		if($('input[name="seegoodscheck"]').filter(':checked').not('.check--disable').length == 0) {
			$(".m-dock-btns__submit").addClass('is--disable');
		}
	});
	 //-- 退貨原因填寫
	$('#textarea-reason-1').on("keyup", KeyIn1).on("keydown", KeyIn1).on("change", KeyIn1);
	function KeyIn1(evt) {
		var maxLength = 100;
		var minLength = 0;
		var nowContent = $(this).val();
		var nowLehgth = nowContent.length;
		$("#words-1").text(minLength + nowLehgth);
		var thisChecked = $('#textarea-reason-1').parent('.m-return-textarea').siblings('.m-return-seegoods').find('input[name="seegoodscheck"]');
		if( nowLehgth > 0){
			$(".m-dock-btns__submit").removeClass('is--disable');
			thisChecked.prop('checked',true);
		} else {
			$(".m-dock-btns__submit").addClass('is--disable');
		}
		numCheck();
	}
	$('#textarea-reason-2').on("keyup", KeyIn2).on("keydown", KeyIn2).on("change", KeyIn2);
	function KeyIn2(evt) {
		var maxLength = 100;
		var minLength = 0;
		var nowContent = $(this).val();
		var nowLehgth = nowContent.length;
		$("#words-2").text(minLength + nowLehgth);
		var thisChecked = $('#textarea-reason-2').parent().siblings('.m-return-seegoods').find('input[name="seegoodscheck"]');
		if( nowLehgth > 0){
			$(".m-dock-btns__submit").removeClass('is--disable');
			thisChecked.prop('checked',true);
		} else {
			$(".m-dock-btns__submit").addClass('is--disable');
		}
		numCheck();
	}

	 //退貨按鈕呈黃色就可以發動連結
		$('.m-dock-btns__submit').click(function(){
		if($(this).hasClass('is--disable')){
		}else{
			window.location.href= "<?= base_url() ?>member/orderBank";
		}
	});
</script>