<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url() ?>assets/css/search.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/factory.css' rel='stylesheet' type='text/css'/>
<script src='<?= base_url()?>assets/js/factory.js'></script>
<style>
	.div_share{
		text-align: center;
	}
	.div_share button {
    display: inline-block;
    vertical-align: bottom;
	}
	.div_tagEach{
		margin:10px 2px 0 2px;
		font-size: 12px;
		line-height: 23px;
		border-radius:4px;
		padding: 0 6px;
		letter-spacing: 0;
	}
	.btn_fb{
		color: #2a589c;
		background: #fff;
		border: 1px solid #2a589c;
	}
	.btn_fb:hover{
		color:#fff;
		background: #2a589c;
	}
	.btn_line{
		color: #00b92b;
		background: #fff;
		border: 1px solid #00b92b;
	}
	.btn_line:hover{
		color:#fff;
		background: #00b92b;
	}
	.btn_weibo{
		color: #f30030;
		background: #fff;
		border: 1px solid #f30030;
	}
	.btn_weibo:hover{
		color:#fff;
		background: #f30030;
	}
	.btn-border a{
		display: inline-block!important;
	}
	.btn-border{
		width: auto!important;
		padding-right: 0!important;
	}
	.f-coopBtn {
    margin-left: -49px;
	}
	.btn_like{
		border: 1px solid #bbb;
		background: #fff;
		margin-left: 2px;
		border-radius: 4px;
		text-align: center;
		width: 25px;
		height: 25px;
		/* @include animation(zoom, .2s, linear, forwards); */
	}
	.btn_like.btn_arrive .svg path, .btn_like.btn_arrive:hover .svg path{
		fill:#ff3244!important;
		opacity: 1!important;
	}
	.btn_like	.svg{
		margin-top: 5px;
		width: 15px;
		height: 15px;
	}
	.btn_like:hover .svg path{
		fill:#bbb;
	}
</style>


<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>
<input type='hidden' id='hid_baseurl' value='<?= base_url() ?>'>
<input type='hidden' id='hid_factorytId' value='<?= $info['id'] ?>'>
<div class="wrapper">
	<div class="mask"></div>
	<div class="div_maskForSearch"></div>
	<div class="mask-z"></div>
	<div class="wrapper-index ">
		<header class="f-header">
			<div class="f-header-wrap">
				<div class="f-header__bgimg" style="background-image:url(<?= URL_GOOGLE_IMG.$info['pic_bg'] ?>)">
				</div>
				<div class="f-header-focus">
					<div class="f-header-focus__pic">
						<img src="<?= URL_GOOGLE_IMG.$info['pic_logo'] ?>" alt="">
					</div>
					<div class="f-header-focus__name"><?= $info['name'] ?></div>
					<div class="div_share">
             			 <!-- FB分享鈕 -->
						<button class="div_tagEach btn_fb" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + window.location.href)">FB</button>
						<!-- LINE分享鈕 -->
						<button class="div_tagEach btn_line" id="share_line" onclick="window.open('http://line.naver.jp/R/')">LINE</button>
						<!-- 微博分享鈕 -->
						<button class="div_tagEach btn_weibo" onclick="window.open('http://service.weibo.com/share/share.php?url=' + window.location.href)" target="_blank">weibo</button>
						<button id='btn_like' class="btn_like <?= $isMyBookmark ? 'btn_arrive' : ''?>" onclick="location.href='javascript:void(0)'" value="like">
							<img class="svg" src="<?= base_url() ?>assets/img/icon_tools/save.svg" alt="">
						</button>
        			</div>
<!--
					<div class="f-header-focus-icons">
						<div class="icons__like list__like is--disabled">
						</div>
						<div  class="icons__share list__share"></div>
					</div>
					<div class="f-header-focus-share">
						<div class="icons__share list__share"></div>
						<div class="share__title">分享</div>
						<div id="scrolling-icons">
							<ul class="share-icons">
								<li class="share-icons__fb">
									<img src="<?= base_url() ?>assets/img/share-fb.svg" alt="">
								</li>
								<li class="share-icons__li">
									<img src="<?= base_url() ?>assets/img/share-line.svg" alt="">
								</li>
								<li class="share-icons__wb">
									<img src="<?= base_url() ?>assets/img/share-weibo.svg" alt="">
								</li>
								<li class="share-icons__wc">
									<img src="<?= base_url() ?>assets/img/share-wechat.svg" alt="">
								</li>
							</ul>
							<div class="share__triangle triangle-shadow"></div>
							<div class="share__triangle"></div>
							<div class="share-href">
								<div class="share-href__copy"></div>
								<input type="text" class="share-href__input" value="https://youtu.be/PT2_F-1esPk" />
							</div>
							<div class="share__cancel">
								<span>取消</span>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</header>
		<div class="f-coopBtn btn-border"><a href="<?= base_url() ?>factory/form">廠商合作</a></div>
		<section class="f-about">
			<div class="f-about-wrap section-wrap">
				<div class="f-about__title f-title">關於</div>
				<div class="f-about__pic">
<?php if($info['url_youtube'] != ''): ?>
					<div class="video-container">
						<iframe width="604" height="333" src="<?= $info['url_youtube'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
<?php endif; ?>
				</div>
				<div class="f-about__text"><?= $info['profile'] ?></div>
			</div>
		</section>
<!--
		<section class="f-goods">
			<div class="f-goods-wrap section-wrap">
				<div class="f-goods__title f-title">好物推薦</div>
				<div class="f-goods-recommend">
	 				<div class="nothing-default">
						<img src="<?= base_url() ?>assets/img/nogoods.svg" alt="">
						<p>尚無好物</p>
					</div>

					foreach
					<ul class="f-goods-recommend-list">
						<li>
							<div class="info-pic">
							   <a href="">
									<div class="info-pic__pic" style="background-image: url('<?= base_url() ?>assets/img/factoryabout.jpg')">
									</div>
								</a>
						   </div>
						   <div class="info-all">
								<div class="info-text">
									<div class="info__brand"><a href="">品牌名稱</a></div>
									<div class="info__name"><a href="">嘉雲雙層抗風直骨傘 27吋 (黑)</a></div>
									<div class="info__store"><a href="">工場</a></div>
								</div>
								<div class="info__price">
									<span class="price-offical">
										NT$990
									</span>
									<span class="price-sale">
										NT$690
									</span>
								</div>
								<div class="info__cart"></div>
							</div>
						</li>
					</ul>

				</div>
				<div class="f-goods-btn btn-border">
					<span>更多好物</span>
				</div>
			</div>
		</section>
-->
	</div>
</div>
<script type='text/javascript'>
$(document).ready(function() {
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

	$( '.btn_like' ).click(function() {
		$(this).toggleClass('btn_arrive');
	});

	$('#btn_like').bind('click',function(){
<?php if(isset($_SESSION['sess_user_id'])): ?>
		$.ajax({
			async: false,
			type: 'POST',
			url: $('#hid_baseurl').val() + 'member/favoriteDoCreate',
			data: {
				content_id: $('#hid_factorytId').val(),
				source: <?= SOURCE_FACTORY ?>
			},
			statusCode: {
				200: function(e) {
				}
			}
		});
<?php else: ?>
		alert('請先登入會員！');
<?php endif; ?>
	});
});
</script>