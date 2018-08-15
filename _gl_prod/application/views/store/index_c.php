<input type="hidden" id="hid_baseurl" value="<?= base_url() ?>">
<input type="hidden" id="hid_storeId" value="<?= $id ?>">

<link href='<?= base_url()?>assets/css/QGoods.css' rel='stylesheet' type='text/css'/>

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
						<li><a href="<?= base_url(); ?>store/view/<?= $id ?>">店鋪首頁</a></li>
						<li><a href="<?= base_url(); ?>store/view/<?= $id ?>/B">商品總覽</a></li>
						<li class="active"><a href="<?= base_url(); ?>store/view/<?= $id ?>/C">關於我們</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="div_StoreAllProduct">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="div_aboutus">
						<h2>店鋪故事</h2>
						<?= $info['profile'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<!--以上固定-->
<!--頁籤-->
<script>
$(function(){
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
});

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