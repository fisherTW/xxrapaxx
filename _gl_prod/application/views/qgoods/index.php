<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/QGoods.css">
<style type="text/css">
	/* fisher add */
	#home-slider {
	  padding: 0;
	}
</style>

<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<!--QMaker 增加class .header_QMaker-->
<!--QGoods 增加class .header_QGoods-->
<!--QShare 增加class .header_QShare-->
<!--Point 增加class .header_Point-->
	<header class="header_theme header_QGoods">
		<a href="<?= base_url() ?>theme/list">主題好物</a>
		<a href="<?= base_url() ?>store/list">店舖推薦</a>
		<a href="<?= base_url() ?>product/list">好物分類</a>
	</header>
<div class="div_homeTheme">
	<div class="container-fluid div_indexBanner">
		<section id="home-slider">
<?php if(count($ary_banner) > 0): ?>
<?php foreach($ary_banner as $item): ?>	
			<a class="item-banner" href="<?= $item['url'] ?>">
				<div class="div_indexBannerImg" style="background-image:url(<?= URL_GOOGLE_IMG.$item['pic'] ?>)"></div></a>
<?php endforeach; ?>
<?php endif; ?>					
		</section>
	</div>
	<div class="container-fluid div_indexHot">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_indexHotTitle">熱門好物</div>
				<div class="col-xs-12 div_indexHotBox">
<?php if(count($ary_hot) > 0): ?>
<?php 
	$ary_class=array('a_indexHotListL','a_indexHotListL','a_indexHotListL','a_indexHotListS','a_indexHotListS','a_indexHotListS','a_indexHotListS','a_indexHotListL','a_indexHotListL','a_indexHotListL');
	$tmp_count = 0;
?>
<?php foreach($ary_hot as $item): ?>						
					<a class="<?= $ary_class[$tmp_count] ?>" href="<?= base_url().'product/'.$item['id'] ?>">
						<div class="div_indexHotList" style="background-image:url(<?= URL_GOOGLE_IMG.$item['url_pic'] ?>)"></div></a>
<?php $tmp_count++; ?>
<?php endforeach; ?>
<?php endif; ?>						
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid div_indexTheme">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_indexThemeTitle">主題好物</div>
				<div class="col-xs-12 div_indexThemeBox">
					<div class="owl-carousel" id="owl-indexTheme">
<?php if(count($ary_theme) > 0): ?>
<?php foreach($ary_theme as $item): ?>							
						<a class="a_indexThemeBox" href="<?= base_url().'theme/view/'.$item['link'] ?>">
							<div class="div_indexThemeL" style="background-image:url(<?= URL_GOOGLE_IMG.$item['pic_cover'] ?>)"></div>
							<div class="div_indexThemeR">
								<div class="div_words">
									<p class="p_title"><?= $item['name'] ?></p>
									<p class="p_more">Read more<img src="<?= base_url() ?>assets/img/readmore.svg"></p>
								</div>
							</div>
						</a>
<?php endforeach; ?>
<?php endif; ?>	
					</div>
					<div class="buttonAll">
						<div class="indexThemeNext"><img src="<?= base_url() ?>assets/img/arrowRightRedS.svg"></div>
						<div class="indexThemePrev"><img src="<?= base_url() ?>assets/img/arrowLeftRedS.svg"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid div_indexSee">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_indexSeeTitle">好物看看</div>
				<div class="col-xs-12 div_indexSeeBox">
					<div class="owl-carousel" id="owl-indexSee">
<?php if(count($ary_seesee) > 0): ?>
<?php foreach($ary_seesee as $item): ?>		
						<div class="div_indexSeeEach">
							<div class="youtube">
								<iframe src="<?= $item['url_youtube'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
							</div>
							<div class="words">
								<a href="<?= base_url().'product/'.$item['id'] ?>"><p class="p_a"><?= $item['name'] ?></p></a>
								<p class="p_b"><?= $item['detail'] ?></p>
								<p class="p_c"><?= $item['s_name'] ?></p>
								<p class="p_d">NT$ <?= $item['price_deal'] ?></p>
							</div>
						</div>
<?php endforeach; ?>
<?php endif; ?>	
					</div>
					<div class="buttonAll">
						<div class="indexSeeNext"><img src="<?= base_url() ?>assets/img/arrowRightRedS.svg"></div>
						<div class="indexSeePrev"><img src="<?= base_url() ?>assets/img/arrowLeftRedS.svg"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid div_indexNew">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_indexNewTitle">新品好物</div>
				<div class="col-xs-12 div_indexNewBox">
<?php if(count($ary_new) > 0): ?>
<?php foreach($ary_new as $item): ?>	
					<div class="div_indexNewListBox"><a class="a_indexNewList" href="<?= base_url().'product/'.$item['id'] ?>">
							<!-- 
							<button class="btn_bag"><img src="<?= base_url() ?>assets/img/bag.svg"></button> 
							-->
							<div class="div_indexNewList" style="background-image:url(<?= URL_GOOGLE_IMG.$item['url_pic'] ?>)"></div>
							<div class="div_words">
								<p class="p_a"><?= $item['name'] ?></p>
								<p class="p_b"><?= $item['s_name'] ?></p>
								<p class="p_c">NT$ <?= $item['price_deal'] ?></p>
							</div></a></div>
<?php endforeach; ?>
<?php endif; ?>	
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid div_indexStore">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_indexStoreTitle">店舖推薦</div>
				<div class="col-xs-12 div_indexStoreBox">
<?php if(count($ary_rm_store) > 0): ?>
<?php foreach($ary_rm_store as $item): ?>					
					<div class="div_indexStoreListBox"><a class="a_indexStoreList" href="<?= base_url().'store/view/'.$item['id'] ?>">
							<div class="div_indexStoreList" style="background-image:url(<?= URL_GOOGLE_IMG.$item['pic_banner'] ?>)"></div>
							<div class="div_sotreImgBox">
								<div class="div_sotreImg" style="background-image:url(<?= URL_GOOGLE_IMG.$item['pic_logo'] ?>)"></div>
							</div>
							<div class="div_wordsBox">
								<p><?= $item['name'] ?></p>
							</div></a></div>
<?php endforeach; ?>
<?php endif; ?>	
				</div>
				<div class="col-xs-12 div_indexStoreMore"><a href="<?= base_url() ?>store/list"><span>更多店鋪</span><span><img src="<?= base_url() ?>assets/img/arrowRightRedS.svg"></span></a></div>
			</div>
		</div>
	</div>

<!--以上固定-->

<script>
	$(document).ready(function() {
		$('#home-slider').slick({
			centerMode: true,
			centerPadding: '40px',
			arrows: true,
			dots: true,
			autoplay: false,
			autoplaySpeed: 4000,
			slidesToShow: 1,
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						centerPadding: '22px'
					}
				},
				{
					breakpoint: 769,
					settings: {
						centerPadding: '30px'
					}
				},
				{
					breakpoint: 415,
					settings: {
						centerPadding: '7px'
					}
				}
			]
		});
		var indexTheme = $("#owl-indexTheme");
		indexTheme.owlCarousel({
			loop:true,
			items:1,
			responsiveClass:true,
			autoplayTimeout:5000,
			autoplay:false
		});
		$('.indexThemePrev').click(function() {
			indexTheme.trigger('prev.owl.carousel');
		});
		$('.indexThemeNext').click(function() {
			indexTheme.trigger('next.owl.carousel', [300]);
		});
		var indexSee = $("#owl-indexSee");
		indexSee.owlCarousel({
			loop:true,
			responsiveClass:true,
			autoplayTimeout:5000,
			autoplay:false,
			responsive:{
				0:{
					items:1,
					margin:0,
					autoplay:false
				},
				769:{
					items:2,
					margin:20,
					autoplay:false
				}
			}
		});
		$('.indexSeePrev').click(function() {
			indexSee.trigger('prev.owl.carousel');
		});
		$('.indexSeeNext').click(function() {
			indexSee.trigger('next.owl.carousel', [300]);
		});
	});
</script>