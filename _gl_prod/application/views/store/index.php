<input type="hidden" id="hid_baseurl" value="<?= base_url() ?>">
<input type="hidden" id="hid_storeId" value="<?= $id ?>">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link href='<?= base_url()?>assets/css/QGoods.css' rel='stylesheet' type='text/css'/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_home">
	<div class="container-fluid div_storeImage" style="background-image:url('<?= URL_GOOGLE_IMG.$info["pic_banner"] ?>')">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-xs-12 div_storeImageL">
					<div class="div_storeHead" style="background-image:url('<?= URL_GOOGLE_IMG.$info["pic_logo"] ?>')"></div>
					<div class="div_storeNameBox">
						<p class="p_StoreName"><?= $info['name'] ?></p>
<?php if($isMyBookmark): ?>						
						<button id='btn_like' class="btn_tracked">已追蹤</button>
<?php else: ?>							
						<button id='btn_like' class="btn_track">追蹤</button>
<?php endif; ?>						
					</div>
				</div>
				<div class="col-sm-6 col-xs-12 div_storeImageR">
					<p><?= $total_product ?><span>項商品</span></p>
					<p><?= $countBookmark ?><span>人追蹤</span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid div_storeTabBar">
		<div class="row">
			<div class="container">
				<div class="col-sm-12">
					<ul class="row nav nav-tabs" role="tablist">
						<li class="active"><a href="javascript:void(0)">店鋪首頁</a></li>
						<li><a href="<?= base_url(); ?>store/view/<?= $id ?>/B">商品總覽</a></li>
						<li><a href="<?= base_url(); ?>store/view/<?= $id ?>/C">關於我們</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="div_StoreAllProduct">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="div_title">
						<h2>新品好物</h2><a href="<?= base_url(); ?>store/view/<?= $id ?>/B"><span>更多</span><span class="span_arrowRight"></span></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 fixArrow">
					<div class="div_ProductList">
						<div class="owl-carousel" id="owl-sliderA">
<?php if($ary_product > 0): ?>
<?php foreach($ary_product as $item): ?>
							<div class="div_ProductListEach"><a class="a_ProductListEach" href="<?= base_url() ?>product/<?= $item['id'] ?>">
								<!--
								<div class="div_tag">
									<span class="span_discount">折扣</span>
									<span class="span_free">免運</span>
									<span class="span_pre">預購品</span>
								</div>-->
								<div class="div_ProductImg" style="background-image:url(<?= URL_GOOGLE_IMG.$item['url_pic'] ?>)"></div>
								<p class="p_ProductStoreName"><span><?= $info['name'] ?></span><span class="span_arrowRight"></span></p>
								<p class="p_ProductName"><?= $item['name'] ?></p>
								<p class="p_ProductPrice">$<?= $item['price_deal'] ?></p></a>
							</div>
<?php endforeach; ?>
<?php endif; ?>									
						</div>
						<div class="buttonAll">
							<div class="slidernext sliderAnext"><img src="<?= base_url()?>assets/img/arrowLeft.svg"></div>
							<div class="sliderprev sliderAprev"><img src="<?= base_url()?>assets/img/arrowRight.svg"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="div_title">
						<h2>熱門好物</h2><a href="<?= base_url(); ?>store/view/<?= $id ?>/B"><span>更多</span><span class="span_arrowRight"></span></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 fixArrow">
					<div class="div_ProductList">
						<div class="owl-carousel" id="owl-sliderB">
<?php if($ary_product > 0): ?>
<?php foreach($ary_product as $item): ?>							
							<div class="div_ProductListEach"><a class="a_ProductListEach" href="<?= base_url() ?>product/<?= $item['id'] ?>">
								<!--
								<div class="div_tag">
									<span class="span_discount">折扣</span>
									<span class="span_free">免運</span>
									<span class="span_pre">預購品</span>
								</div>-->
								<div class="div_ProductImg" style="background-image:url(<?= URL_GOOGLE_IMG.$item['url_pic'] ?>)"></div>
								<p class="p_ProductStoreName"><span><?= $info['name'] ?></span><span class="span_arrowRight"></span></p>
								<p class="p_ProductName"><?= $item['name'] ?></p>
								<p class="p_ProductPrice">$<?= $item['price_deal'] ?></p></a>
							</div>
<?php endforeach; ?>
<?php endif; ?>	
						</div>
						<div class="buttonAll">
							<div class="slidernext sliderBnext"><img src="<?= base_url()?>assets/img/arrowLeft.svg"></div>
							<div class="sliderprev sliderBprev"><img src="<?= base_url()?>assets/img/arrowRight.svg"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Footer-->

</div>

<!--以上固定-->
<!--頁籤-->
<script>
	$(window).scroll(function() {
		var windowTop = $(window).scrollTop();
		var windowH = $(window).height();
		var navTabH = $('.div_ProductList').offset().top;
		if((navTabH - 150) < windowTop){
			$('.div_storeTabBar').addClass('div_storeTabBar--show')
		} else if((navTabH - 150) >= windowTop){
			$('.div_storeTabBar').removeClass('div_storeTabBar--show')
		}
	});
</script>
<!--owl-->

<script>
$(document).ready(function() {
	$('#btn_like').bind('click',function(){
<?php if(isset($_SESSION['sess_user_id'])): ?>
		$.ajax({
			async: false,
			type: 'POST',
			url: $('#hid_baseurl').val() + 'member/favoriteDoCreate',
			data: {
				content_id: $('#hid_storeId').val(),
				source: <?= SOURCE_STORE ?>
			},
			statusCode: {
				200: function(e) {
					$('#btn_like').removeClass('btn_track');
					$('#btn_like').addClass('btn_tracked');
					$('#btn_like').html('已追蹤');
				}
			}
		});
<?php else: ?>
		alert('請先登入會員！');
<?php endif; ?>
	});

	var owlA = $("#owl-sliderA");
	owlA.owlCarousel({
		loop:true,
		responsiveClass:true,
		autoplayTimeout:5000,
		responsive:{
			0:{
				items:1,
				margin:15,
				autoplay:false
			},
			768:{
				items:3,
				margin:20,
				autoplay:false
			},
			1024:{
				items:4,
				margin:20,
				autoplay:false
			}
		}
	});
	$('.sliderAprev').click(function() {
		owlA.trigger('next.owl.carousel');
	});
	$('.sliderAnext').click(function() {
		owlA.trigger('prev.owl.carousel', [300]);
	});
	var owlB = $("#owl-sliderB");
	owlB.owlCarousel({
		loop:true,
		responsiveClass:true,
		autoplayTimeout:5000,
		responsive:{
			0:{
				items:1,
				margin:15,
				autoplay:false
			},
			768:{
				items:3,
				margin:20,
				autoplay:false
			},
			1024:{
				items:4,
				margin:20,
				autoplay:false
			}
		}
	});
	$('.sliderBprev').click(function() {
		owlB.trigger('next.owl.carousel');
	});
	$('.sliderBnext').click(function() {
		owlB.trigger('prev.owl.carousel', [300]);
	});
});
</script>