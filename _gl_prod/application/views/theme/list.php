	<link href="<?= base_url()?>assets/css/QGoods.css " rel="stylesheet " type="text/css ">
	
		<div class="div_mask"></div>
		<div class="div_maskForSearch"></div>
		<header class="header_theme header_QGoods">
			<a class="arrive" href="javascript:void(0)">主題好物</a>
			<a href="<?= base_url() ?>store/list">店舖推薦</a>
			<a href="<?= base_url() ?>product/list">好物分類</a>
		</header>
		<div class="div_homeTheme ">
			<div class="div_themePage ">
			<div class="container ">
				<div class="row ">

<?php if(count($ary_theme) > 0): ?>
<?php foreach($ary_theme as $item): ?>
					<div class="col-md-4 col-sm-6 col-xs-12 "><a class="a_themeEach " href="<?= base_url().'theme/view/'.$item['link'] ?>">
						<div class="div_themeImg " style="background-image:url(<?= URL_GOOGLE_IMG.$item['pic_cover'] ?>) "></div>
						<p class="p_title "><?= $item['name'] ?></p>
						<!-- <p class="p_wording ">神奇黏土到底何方神聖？</p> -->
						<p class="p_more "><span>read more</span><span class="span_arrowRight "></span></p></a>
					</div>
<?php endforeach; ?>
<?php endif; ?>	
				</div>
			</div>
			</div>
	
		</div>
		<!--以上固定-->
		<script>
			$(function () {
				$('.footer-trigger').click(function () {
					$(".footer ").toggleClass("active--1 ");
				});
				//select effect
				$('.select-vb').click(function () {
					$(this).find('ul').slideToggle(10);
					$(this).find('span').toggleClass('is--select');
				});
				$('.select-wh').click(function () {
					$(this).find('ul').slideToggle(10);
					$(this).find('span').toggleClass('is--select');
				});
				$('.select ul li').click(function () {
					var str = " ";
					$(this).each(function () {
						str += $(this).text() + " ";
					});
					$(this).parent().siblings().text(str);
					$('.select-wh ul li').parent().siblings().text(str).css('color', '#666666');
				});
				/*
				Load more content with jQuery - May 21, 2013
				(c) 2013 @ElmahdiMahmoud
				*/
				$(".s-plan-list> li").hide(); $(".s-plan-list > li").slice(0, 12).show(); $("#s-loadmore").on('click', function (e) {
					e.preventDefault();
					$(".s-plan-list > li:hidden").slice(0, 3).slideDown(); if ($(".s-plan-list > li:hidden").length == 0) {
						$("#s-loadmore").fadeOut(500);
					} $('html,body').animate({ scrollTop: $(this).offset().top - 20 }, 1500);
				});
			});
		</script>
