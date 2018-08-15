<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<!--QMaker 增加class .header_QMaker-->
<!--QGoods 增加class .header_QGoods-->
<!--QShare 增加class .header_QShare-->
<!--Point 增加class .header_Point-->
<header class="header_theme header_QGoods">
	<a class="arrive" href="<?= base_url() ?>theme/list">主題好物</a>
	<a href="<?= base_url() ?>store/list">店舖推薦</a>	
	<a href="<?= base_url() ?>product/list">好物分類</a>
</header>
<!-- header end -->

<!-- QTheme start -->
<link rel="stylesheet" href="<?= base_url() ?>assets/css/QTheme.css">
<contain>
	<div class="Bitmap">
		<input type='hidden' id='hid_pic_cover' value='<?= URL_GOOGLE_IMG.$info['pic_cover'] ?>'>
		<input type='hidden' id='hid_name' value='<?= $info['name'] ?>'>
		<img class="" src="<?= URL_GOOGLE_IMG.$info['pic_cover'] ?>" alt="">
	</div>

	<div class="area1">
		<!-- summernote start -->
		<div class="summernote">

			<h2><?= $info['name'] ?></h2>
			<div class="Group_All">
				<?= $info['detail'] ?>
			</div>
		</div>

		<!-- summernote end -->

		<section>
			<h3><?= $info['product_title'] ?></h3>
			<div class="card_all">
<?php if (count($ary_product) > 0): ?>
<?php foreach ($ary_product as $item): ?>
				<div class="card_val">
					<div class="card_val_small">
						<a href="<?= base_url().'product/'.$item['product_id'] ?>">
							<div class="card_titleimg" style="background-image:url(<?= URL_GOOGLE_IMG.$item['url_pic'] ?>)">
								<!-- url內商品圖 -->
							</div>
						</a>

						<div class="card_text position-relative">
							<a href="<?= base_url().'product/'.$item['product_id'] ?>">
								<p class="card_text_name">
									<?= $item['product_name'] ?>
								</p>
							</a>
							<a href="<?= base_url().'store/view/'.$item['store_id'] ?>">
								<p class="card_material">
									<?= $item['store_name'] ?>
								</p>
							</a>
							<div class="d-flex justify-content-between">
								<p class="card_price price_font position-absolute">
									NT$ <?= $item['price_deal'] ?>
								</p>
								<a href="<?= base_url().'product/'.$item['product_id'] ?>">
									<img class="card_cart_img position-absolute" src="<?= base_url() ?>assets/img/shop_f@3x.png" alt="shoppingcart">
								</a>
							</div>
						</div>
					</div>
				</div>
<?php endforeach; ?>
<?php endif; ?>
			</div>
			<div class="w_clear"></div>
		</section>

		<div class="small_icon">
			<img id="share_line" src="<?= base_url() ?>assets/img/line@3x.png" alt="line">
			<img onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+window.location.href)" src="<?= base_url() ?>assets/img/fb@3x.png" alt="facebook">
			<img id="share_wb" class="div_tagEach btn_weibo" src="<?= base_url() ?>assets/img/weibo@3x.png" alt="weibo">
		</div>
	</div>
</contain>
<script>
	$(document).ready(function () {
		// $("iframe").wrapAll($('<div/>', {
		//	 class: 'youtube'
		// }));
		$("iframe[class=note-video-clip]").each(function(){
			$(this).wrapAll("<div class='youtube'></div>");
		});

	});
	//iframe debug
</script>

<!-- QTheme end -->
<div id="fb-root"></div>
<script>
	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	//桌機
	window.onload = function () {
		document.getElementById("share_line").onclick = function () {
			window.open('https://lineit.line.me/share/ui?url=' + encodeURIComponent(window.location.href), "_blank", "toolbar=yes,location=yes,directories=no,status=no, menubar=yes,scrollbars=yes,resizable=no, copyhistory=yes,width=600,height=400")
		};
		document.getElementById("share_wb").onclick = function () {
			window.open('http://service.weibo.com/share/share.php?url=' + encodeURIComponent(window.location.href) + '&title=' + $('#hid_name').val() + '&pic=' + $('#hid_pic_cover').val(), "_blank", "toolbar=yes,location=yes,directories=no,status=no, menubar=yes,scrollbars=yes,resizable=no, copyhistory=yes,width=600,height=400")
		};
		//http://service.weibo.com/share/share.php?url=https://qgoods.rapaq.com
	}
</script>
