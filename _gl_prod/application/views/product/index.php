<link href='<?= base_url() ?>assets/css/QGoods.css' rel='stylesheet' type='text/css'/>
<link href="<?= base_url() ?>assets/js/owl/owl.carousel.css" rel='stylesheet' type='text/css'/>
<script src="<?= base_url() ?>assets/js/owl/owl.carousel.js"></script>

<header class="header_theme header_QGoods"><a href="<?= base_url() ?>theme/list">主題好物</a><a href="<?= base_url() ?>store/list">店鋪推薦</a><a href="<?= base_url() ?>product/list">好物分類</a></header>
<input type='hidden' id='hid_baseurl' value='<?= base_url() ?>'>
<input type='hidden' id='hid_productId' value='<?= $info['id'] ?>'>
<input type='hidden' id='hid_storetId' value='<?= $info['store_id'] ?>'>
<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_home">
	<div class="container-fluid div_Product" style="background-image:url('<?= URL_GOOGLE_IMG.$info["url_pic"] ?>'); margin-top: 100px;"">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-7 div_phoneFull">
					<div class="owl-carousel" id="owl-product">
<?php if(strlen($info["url_pic"]) != 0): ?>
						<div class="div_item" style="background-image:url('<?= URL_GOOGLE_IMG.$info["url_pic"] ?>')"></div>
<?php endif; ?>
<?php if(strlen($info["url_pic2"]) != 0): ?>
						<div class="div_item" style="background-image:url('<?= URL_GOOGLE_IMG.$info["url_pic2"] ?>')"></div>
<?php endif; ?>
<?php if(strlen($info["url_youtube"] )!= 0): ?>
						<div class="youtube">
							<iframe src="<?= $info["url_youtube"] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
<?php endif; ?>
					</div>
				</div>
				<div class="col-xs-12 col-md-5 div_ProductBox">
					<div class="div_ProductInner">
						<div class="div_tag">
							<div class="div_productStoreName"><span><?= $info['store_name'] ?></span><span class="span_arrowRight"></span></div>
							<div class="div_share">
								<!-- FB分享鈕 -->
								<button class="div_tagEach btn_fb" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + window.location.href)">FB</button>
								<!-- LINE分享鈕 接網址處在樓下-->
								<button class="div_tagEach btn_line" id="share_line" >LINE</button>
								<!-- 微博分享鈕 -->
								<button class="div_tagEach btn_weibo" onclick="window.open('http://service.weibo.com/share/share.php?url=' + window.location.href + '&title=<?= $info['product_name'] ?>&pic=<?= URL_GOOGLE_IMG.$info['url_pic'] ?>')" target="_blank">weibo</button>
							</div>
						</div>
						<div class="div_ProductTitle"><?= $info['product_name'] ?></div>
						<div class="div_ProductPrice">
							<span class="span_ProductPriceOriginal">$<?= number_format($info['price_origin'], 0, '.' ,',') ?></span>
							<span class="span_ProductPriceSale">$<?= number_format($info['price_deal'], 0, '.' ,',') ?></span>
<?php if($discount != 0): ?>
							<span class="span_ProductPriceDiscount"><?= $discount ?>折</span>
<?php endif; ?>
						</div>
<?php if($info['dt_start'] > date('Y-m-d H:i:s')): ?>
						<div class="div_ProductTime"><span class="span_ProductTimePreOrder">預購品</span><span class="span_ProductTimeCountdown">00 天 00 時 00 分 00 秒</span></div>
						<div class="div_ProductShip">預計出貨：<?= date("Y 年 m 月 d 日", strtotime($info['dt_start'])) ?></div>
<?php endif; ?>
						<div class="div_ProductSize">顏色：<?= implode(' / ', $ary_spec_show_color) ?></div>
						<div class="div_ProductSize">尺寸：<?= implode(' / ', $ary_spec_show_size) ?></div>
						<div class="div_btnAll">
							<div class="div_btnAllCenter">
								<button id='btn_like' class="btn_like <?= $isMyBookmark_product ? 'btn_arrive' : ''?>" onclick="location.href='javascript:void(0)'" value="like"><img class="svg" src="<?= base_url() ?>assets/img/icon_tools/save.svg" alt=""></button>
								<button name='btn_add' class="btn_yellow addBag" onclick="location.href='javascript:void(0)'" value="add">加入購物袋</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid div_ProductTabBar">
		<div class="row">
			<div class="container">
				<div class="col-md-offset-2 col-md-8 col-sm-offset-0 col-sm-12">
					<ul class="row nav nav-tabs" role="tablist">
						<li class="active" role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab"></a></li>
						<li role="presentation"><a href="#spec" aria-controls="spec" role="tab" data-toggle="tab"></a></li>
						<li role="presentation"><a href="#faq" aria-controls="faq" role="tab" data-toggle="tab"></a></li>
<!-- 						<li role="presentation"><a href="#evaluation" aria-controls="evaluation" role="tab" data-toggle="tab"></a></li>
-->
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="col-md-offset-2 col-md-8 col-sm-offset-0 col-sm-12">
					<div class="tab-content row">
						<div class="tab-pane active" id="info" role="tabpanel">
							<?= $info['detail'] ?>
						</div>
						<div class="tab-pane" id="spec" role="tabpanel">
							<?= $info['detail_spec'] ?>
						</div>
						<div class="tab-pane" id="faq" role="tabpanel">
<?php if(isset($_SESSION['sess_user_id'])): ?>
							<div class="div_commentsTextarea div_commentsTextareaLogin">
								<div class="div_commentsHead"><img src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=160"></div>
								<textarea placeholder="請輸入..." id='txt_content'></textarea>
								<button id='btn_send'>送出</button>
							</div>
<?php endif; ?>
<?php if(count($comments) > 0): ?>
<?php foreach($comments as $item): ?>
							<div class="div_commentsEach">
								<div class="div_commentsHead"><img src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=160"></div>
								<p class="p_name"><?= $item['q_user_name'] ?><span><?= date("Y 年 m 月 d 日", strtotime($item['dt_create'])) ?></span></p>
								<p><?= $item['content'] ?></p>
<?php if($item['reply'] != ''): ?>
								<div class="div_commentsReply">
									<p class="p_name">店家<span><?= date("Y 年 m 月 d 日", strtotime($item['dt_update'])) ?></span></p>
									<p><?= $item['reply'] ?></p>
								</div>
<?php endif; ?>
							</div>
<?php endforeach; ?>
<?php else: ?>
					目前無留言資料
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- 
	<div class="container-fluid div_ProductAD">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_ProductListTitle">瀏覽過的</div>
				<div class="col-xs-12">
					<div class="div_ProductList">
						<div class="owl-carousel" id="owl-sliderB">

							<div class="div_ProductListEach"><a class="a_ProductListEach" href="javascript:void(0)">
								<div class="div_ProductImg" style="background-image:url(assets/img/product/005.gif)"></div>
								<p class="p_ProductStoreName"><span>TZULAÏ 厝內</span><span class="span_arrowRight"></span></p>
								<p class="p_ProductName">心適喫飯 蒜頭古早碗</p>
								<p class="p_ProductPrice">$320</p></a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 -->	
	<div class='modal fade' id='div_cart'>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" id='div_modal_header'>
					<div class="col-sm-2">品名</div>
					<div class='col-sm-10'><?= $info['product_name'] ?></div>
				</div>
				<div class='modal-body row'>
					<form id='form_modal' class='vrf'>
						<input type='hidden' id='hid_count_spec' value='<?= count($ary_spec) ?>'>
						<input type="hidden" name="hid_prod_id" value='<?= $info['id'] ?>'>
						<input type="hidden" name="hid_source" value='<?= SOURCE_QGOODS ?>'>
						<input type='hidden' name='hid_act'>
<?php if(count($ary_spec) > 0 ): ?>
						<div class="form-group">
							<div class="col-sm-2">規格</div>
							<div class="col-sm-10"><?= form_dropdown('sel_modal_spec', $ary_spec, '', 'class="form-control"'); ?></div>
						</div>
<?php endif; ?>
						<div class="form-group">
							<div class="col-sm-2">數量</div>
							<div class="col-sm-10"><?= form_dropdown('txt_quantity', $ary_quantity, '', 'class="form-control"'); ?></div>
						</div>
					</form>
				</div>
				<div class='modal-footer' id='div_modal_footer'>
					<button name="btn_addCartConfirm" act='1' class="btn btn-danger" disabled>加入購物袋</button>
					<button name="btn_addCartConfirm" act='2' class="btn btn-primary" disabled>立即購買</button>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="modal-adult">
	<div class="modal-backdrop">
		<div class="modal-dialog  modal-dialog-centered" >
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">您是否已經年滿18歲？</h4>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<font>依台灣網站內容分級規定，本網頁僅供成年人瀏覽。18歲以下人士請勿瀏覽及購買本網頁產品。</font>
					</div>
				</div>
				<div class="modal-footer">
					<p class="pull-center">
						<button type="button" id="is_not_18" class="btn btn-default" data-dismiss="modal">　　否　　</button>
						<button type="button" id="is_18" class="btn btn-primary">　　是　　</button>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<script type="text/javascript">
$(document).ready(function() {

	//桌機
	window.onload = function(){
		document.getElementById("share_line").onclick = function(){
			window.open('https://lineit.line.me/share/ui?url='+encodeURIComponent(window.location.href),"_blank","toolbar=yes,location=yes,directories=no,status=no, menubar=yes,scrollbars=yes,resizable=no, copyhistory=yes,width=600,height=400")
		}
	}

<?php 	if ($info["product_is_18"] == 1 ): ?> 
		$('#modal-adult').modal({
			backdrop: false,
			show: true
		});
		$('.modal-dialog').css("margin-top", Math.max(30, $(window).height() / 3));
<?php endif; ?>

		$("#is_18").bind('click',function(e){
			$('#modal-adult').modal('hide');
		});
		$("#is_not_18").bind('click',function(e){
			location.href = '<?= base_url() ?>product/list';
		});

	$("iframe[class=note-video-clip]").each(function(){
		$(this).wrapAll("<div class='youtube'></div>");
	});

	$('#btn_like').bind('click',function(){
<?php if(isset($_SESSION['sess_user_id'])): ?>
		$.ajax({
			async: false,
			type: 'POST',
			url: $('#hid_baseurl').val() + 'member/favoriteDoCreate',
			data: {
				content_id: $('#hid_productId').val(),
				source: <?= SOURCE_PRODUCT ?>
			},
			statusCode: {
				200: function(e) {
				}
			}
		});
		$(this).toggleClass('btn_arrive');
		alert('收藏成功！');
<?php else: ?>
		alert('請先登入會員！');
<?php endif; ?>
	});


	$('#btn_track').bind('click',function(){
<?php if(isset($_SESSION['sess_user_id'])): ?>
		$.ajax({
			async: false,
			type: 'POST',
			url: $('#hid_baseurl').val() + 'member/favoriteDoCreate',
			data: {
				content_id: $('#hid_storetId').val(),
				source: <?= SOURCE_STORE ?>
			},
			statusCode: {
				200: function(e) {
				}
			}
		});
		$(this).toggleClass('btn_tracked');
		alert('追蹤成功！');
<?php else: ?>
		alert('請先登入會員！');
<?php endif; ?>
	});

	$('#btn_send').bind('click',function(){
		$.ajax({
			async: false,
			type: 'POST',
			url: $('#hid_baseurl').val() + 'comments/doCreate',
			data: {
				content: $('#txt_content').val(),
				p_id: $('#hid_productId').val(),
				source: <?= SOURCE_QGOODS ?>
			},
			statusCode: {
				200: function(e) {
					if(e==1) {
						window.location = window.location.href;
					} else {
						alert('送出失敗！');
					}
				}
			}
		});
	});

	$('select[name=sel_modal_spec]').change(function(){
		if($('#hid_count_spec').val() > 0) {
			if($('select[name=sel_modal_spec]').val() != '0') {
				$('button[name=btn_addCartConfirm][act=1]').removeAttr('disabled');
				$('button[name=btn_addCartConfirm][act=2]').removeAttr('disabled');
			} else {
				$('button[name=btn_addCartConfirm][act=1]').attr('disabled','disabled');
				$('button[name=btn_addCartConfirm][act=2]').attr('disabled','disabled');				
			}
		}
	});

	$('button[name=btn_add]').bind('click',function() {
<?php if(!isset($_SESSION['sess_user_id'])): ?>
			alert('請先登入會員！');
			window.location = $('#hid_baseurl').val() + 'product/' + $('#hid_productId').val();
<?php else: ?>
		$('#div_cart').modal('show');
		
		// auto select
		if($('select[name=sel_modal_spec] option').length == 2) {
			$('select[name=sel_modal_spec]')[0].selectedIndex=1;
			$('select[name=sel_modal_spec]').change();
		}
<?php endif; ?>
	});

	$('button[name=btn_addCartConfirm]').bind('click',function(){
		if(!$('#form_modal')[0].checkValidity()) return;
		$('input[name=hid_act]').val($(this).attr('act'));

		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'cart/add',
			cache: false,
			async : false,
			data: $('#form_modal').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				switch(response.responseText) {
					case '1':
						$('#div_cart').modal('hide');
						if($('input[name=hid_act]').val().toString() == '1') {
							alert('已加入購物袋');
						} else {
							window.location = '<?= base_url()?>checkout/list';
						}
						break;
				}
			}
		});
		return false;
	});

	var owlA = $("#owl-product");
	owlA.owlCarousel({
		items:1,
		loop:true,
		autoplayTimeout:5000
	});
	var owlB = $("#owl-sliderA");
	owlB.owlCarousel({
		loop:true,
		responsiveClass:true,
		autoplayTimeout:5000,
		responsive:{
			0:{
				items:1,
				margin:15,
				nav:true,
				autoplay:true
			},
			768:{
				items:3,
				margin:20,
				nav:true,
				autoplay:true
			},
			1024:{
				items:4,
				margin:20,
				nav:true,
				autoplay:false
			}
		}
	});
	var owlC = $("#owl-sliderB");
	owlC.owlCarousel({
		loop:true,
		responsiveClass:true,
		autoplayTimeout:5000,
		responsive:{
			0:{
				items:1,
				margin:15,
				nav:true,
				autoplay:true
			},
			768:{
				items:3,
				margin:20,
				nav:true,
				autoplay:true
			},
			1024:{
				items:4,
				margin:20,
				nav:true,
				autoplay:false
			}
		}
	});

	//頁籤內容
	$('.nav-tabs li').bind('click',function(){
		theOffset = $('.tab-content').offset();
		$('body,html').animate({
			scrollTop: theOffset.top - 98
		});
	});
	//info編輯器fix
	$( "#info iframe" ).parent( 'p' ).addClass('youtube');
	$( "#info img" ).parent( 'p' ).css('text-align','center');
	//btn_addShoppingBagMask
	$( '.addBag' ).click(function() {
		$('.div_addShoppingBagBox').addClass('div_addShoppingBagBox--show');
		$('.div_addShoppingBagMask').addClass('div_addShoppingBagMask--show');
	});
	$( '.div_addShoppingBagMask' ).click(function() {
		$(this).removeClass('div_addShoppingBagMask--show');
		$('.div_addShoppingBagBox').removeClass('div_addShoppingBagBox--show');
	});

});

$(window).scroll(function() {
	var windowTop = $(window).scrollTop();
	var windowH = $(window).height();
	var footH = $('.footer_new').offset().top;
	var btnHidden = windowTop + windowH;
	var navTabH = $('.tab-content').offset().top;
	var storeH = $('.div_ProductStore').offset().top;
	//加入購物袋 加入最愛 按鈕
	if(storeH - 60 > windowTop){
		$('.div_btnAll').removeClass('div_btnAllFixed')
	} else if((storeH - 60) < windowTop && (footH + 90) > btnHidden){
		$('.div_btnAll').addClass('div_btnAllFixed')
	} else if((footH + 60) < btnHidden){
		$('.div_btnAll').delay( 20000 ).removeClass('div_btnAllFixed')
	}
	//頁籤
	if((navTabH - 99) > windowTop){
		$('.div_ProductTabBar').removeClass('div_ProductTabBar--show')
	} else if((navTabH - 99) < windowTop){
		$('.div_ProductTabBar').addClass('div_ProductTabBar--show')
	}
});
//svg
jQuery('img.svg').each(function(){
	var $img = jQuery(this);
	var imgID = $img.attr('id');
	var imgClass = $img.attr('class');
	var imgURL = $img.attr('src');
	jQuery.get(imgURL, function(data) {
		var $svg = jQuery(data).find('svg');
		if(typeof imgID !== 'undefined') {
			$svg = $svg.attr('id', imgID);
		}
		if(typeof imgClass !== 'undefined') {
			$svg = $svg.attr('class', imgClass+' replaced-svg');
		}
		$svg = $svg.removeAttr('xmlns:a');
		if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
			$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
		}
		$img.replaceWith($svg);
	}, 'xml');
});

</script>