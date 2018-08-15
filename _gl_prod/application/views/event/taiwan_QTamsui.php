<!DOCTYPE html>
<html>

<head>
	<title>問島遊，淡水沾一下｜RapaQ 好物</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0 , minimum-scale=1, maximum-scale=1">
	<meta charset="UTF-8">
	<meta name="title" content="問島遊，淡水沾一下｜RapaQ 好物">
	<meta name="description" content="來場淡水在地漫步，RapaQ好物-『問島遊，淡水沾一下』為你打造深入在地的旅行路線，一同找尋食衣住行日常生活好物，RapaQ好物精選淡水在地品牌『五行創藝設計』、『藍儂道具屋』、『馬偕小禮堂』、『小栗手作』。">
	<meta name="keywords" content="五行創藝設計、藍濃道具屋、小粟手作、淡水小鎮、馬偕小禮堂、藍染、山城、滬尾偕醫館、淡水禮拜堂">
	<meta name="og:title" content="問島遊，淡水沾一下｜RapaQ 好物">
	<meta name="og:description" content="來場淡水在地漫步，RapaQ好物-『問島遊，淡水沾一下』為你打造深入在地的旅行路線，一同找尋食衣住行日常生活好物，RapaQ好物精選淡水在地品牌『五行創藝設計』、『藍儂道具屋』、『馬偕小禮堂』、『小栗手作』。">
	<meta name="og:type" content="website">
	<meta name="og:image" content="<?= base_url() ?>assets/event/taiwan_QTamsui/images/share_fb.jpg">
	<meta name="og:url" content="<?= base_url() ?>event/Taiwan_QTamsui">

	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/favicon-16x16.png">
	<link rel="manifest" href="<?= base_url() ?>assets/img/site.webmanifest">
	<link rel="mask-icon" href="<?= base_url() ?>assets/img/safari-pinned-tab.svg" color="#ff000f">

	<link href='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
	<link href='<?= base_url() ?>assets/event/taiwan_QTamsui/css/base.css' rel='stylesheet' type='text/css' />
	<link href='<?= base_url() ?>assets/css/layout.css' rel='stylesheet' type='text/css' />
	<link href='<?= base_url() ?>assets/css/RapaqHeader.css' rel='stylesheet' type='text/css' />
	<link href='<?= base_url() ?>assets/css/RapaqFooter.css' rel='stylesheet' type='text/css' />
	<link href="<?= base_url() ?>assets/event/taiwan_QTamsui/css/topic.css" rel="stylesheet" type='text/css' />
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
	<script src='<?= base_url() ?>assets/js/nav.js'></script>

	<link href="<?= base_url() ?>assets/event/taiwan_QTamsui/css/tamsui.css" rel="stylesheet">
</head>
<body class="hide-overlay fade">

	<!-- share's mask & windows -->
	<div class="mask-z" style="display: none;"></div>
	<div class="sharestyle">
		<div class="sharestyle-center">
			<div class="share__title">分享</div>
			<div id="scrolling-icons">
				<ul class="share-icons">
					<li class="share-icons__fb">
						<a href="https://www.facebook.com/sharer/sharer.php?u=https://www.rapaq.com/event/Taiwan_QTamsui" target="_blank">
							<img src="https://storage.googleapis.com/rapaq_public/common/share_btn/share-fb.svg" alt="">
						</a>
					</li>
					<li class="share-icons__li">
						<a href="https://lineit.line.me/share/ui?url=https://www.rapaq.com/event/Taiwan_QTamsui" target="_blank">
							<img src="https://storage.googleapis.com/rapaq_public/common/share_btn/share-line.svg" alt="">
						</a>
					</li>
					<li class="share-icons__wb">
						<a href="http://service.weibo.com/share/share.php?url=https://www.rapaq.com/event/Taiwan_QTamsui&title=問島遊，淡水沾一下｜RapaQ 好物&pic=<?= base_url() ?>assets/event/taiwan_QTamsui/images/share_fb.jpg"
							target="_blank">
							<img src="https://storage.googleapis.com/rapaq_public/common/share_btn/share-weibo.svg" alt="">
						</a>
					</li>
				</ul>
				<div class="share__triangle triangle-shadow"></div>
				<div class="share__triangle"></div>
				<div class="share-href">
					<input type="button" class="share-href__copy">
					<input type="text" class="share-href__input" value="https://www.rapaq.com/event/Taiwan_QTamsui" readonly="">
				</div>
				<div id="copy_msg" style="font-size: 9px;margin-top: 5px;color: #f00;display: none">※已複製連結</div>
				<div class="share__cancel">
					<span>取消</span>
				</div>
			</div>
		</div>
	</div>
	<script>

		$(function () {
			$('.info__like').click(function () {
				notlogin('https://qgoods.rapaq.com/login');
			});
			$(".share-href__copy").click(function () {
				$('.share-href__input').select();
				document.execCommand('copy');
				$('#copy_msg').show();
			});


			$("iframe").each(
				function (index, elem) {
					elem.setAttribute("width", "100%");
				}
			);


		});

	</script>
	<!-- share's mask & windows -->

	<!-- nav bar start -->
	<nav class="navMain">
		<a class="logo" href="https://www.rapaq.com/qgoods" target="_blank">
			<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/logo.png">
		</a>
	</nav>
	<nav class="navBottom">
		<div class="navBottomInner">
			<!-- <a class="navbtnA" href="javascript:void(0)" data-id="A">尋味足印</a> -->
			<a class="navbtnB" href="javascript:void(0)" data-id="B">問精神</a>
			<a class="navbtnC" href="javascript:void(0)" data-id="C">問日常</a>
			<a class="navbtnD" href="javascript:void(0)" data-id="D">問味蕾</a>
			<a class="navbtnE" href="javascript:void(0)" data-id="E">問眼界</a>
		</div>
	</nav>
	<!-- nav bar end -->

	<!--更多活動-->
	<div class="hamber">
		<div class="name">更多活動</div>
		<div class="shape">
			<span class="-top"></span>
			<span class="-middle"></span>
			<span class="-bottom"></span>
		</div>
	</div>
	<div class="navOverlay">
		<div class="navContent">
			<div class="title">熱門強打</div>
			<ul>
				<li>
					<a href="<?= base_url() ?>event/Taiwan_QTainan" target="_blank">台南●沾一下</a>
				</li>
				<li>
					<a href="<?= base_url() ?>event/Taiwan_QTaichung" target="_blank">台中●沾一下</a>
				</li>
				<li>
					<a href="<?= base_url() ?>event/Taiwan_QHuadong" target="_blank">花東●沾一下</a>
				</li>
				<li>
					<a href="<?= base_url() ?>event/Taiwan_QTamsui" target="_blank">淡水●沾一下</a>
				</li>
				<li>
					<a href="<?= base_url() ?>theme/view/yilan" target="_blank">宜同去旅行</a>
				</li>
				<li>
					<a href="<?= base_url() ?>theme/view/Dadaocheng" target="_blank">相逢永樂町</a>
				</li>
			</ul>
		</div>
	</div>
	<!--Kv-->
	<section class="kv">
		<div class="kvPic"> </div>
		<div class="kvMain">
			<div class="kv_Logo">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/kvLogo.png">
			</div>
			<p class="kv_dot">淡水
				<span>
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/dot.png">
				</span>沾一下</p>
			<span class="dash"></span>
			<p class="kv_titleS">問島遊哪裡趣？</p>
		</div>
		<div class="down">
			<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/scrolldown.png">
		</div>
	</section>
	<!--問島路-->
	<section class="themeAll theme_Last">
		<div class="navbtnATop" data-id="A"></div>
		<div class="theme_nameS">問島路</div>
		<!-- <div class="theme_description">跟著阿米濕的私房島遊路線一起玩花東！</div> -->
		<div class="theme_place">day1 路線</div>
		<div class="theme_travel">
			<a class="jumpC">藍儂道具屋</a>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<p class="p_brown">滬尾偕醫館</p>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<p class="p_brown">馬偕小禮堂</p>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<p class="p_brown">淡水禮拜堂</p>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<a class="jumpB">五行創藝設計</a>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<p class="p_brown">馬偕紀念醫院附設喜樂咖啡工作坊</p>
		</div>
		<div class="theme_place">day2 路線</div>
		<div class="theme_travel">
			<p class="p_brown">幸福農莊</p>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<p class="p_brown">芝柏藝術村</p>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<p class="p_brown">李天祿布袋戲文物館</p>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<p class="p_brown">三芝二號倉庫</p>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<a class="jumpD">小粟手作
			</a>
			<p class="p_img">
				<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/footprint.png">
			</p>
			<p class="p_brown">三芝淺水灣</p>
		</div>
	</section>

	<!--問精神			-->
	<section class="themeAll theme_Odd">
		<div class="navbtnBTop jumpB-get" data-id="B"></div>
		<div class="theme_name">問精神</div>
		<div class="theme_titleS">工藝設計</div>
		<div class="theme_description">建構一種生活態度，一種關於設計與生活的風格。</div>
		<div class="theme_Slider theme_Slider_Odd">
			<div class="owl-carousel owl-carouselL oneByOne slide-left">
				<a class="item" href="https://www.rapaq.com/product/1613" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_01/1.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1615" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_01/2.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1614" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_01/3.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/810" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_01/4.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/611" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_01/5.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/532" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_01/6.jpg">
				</a>
			</div>
			<div class="owl-carousel owl-carouselS oneByOne">
				<div class="item">
					<a href="https://www.rapaq.com/product/1613" target="_blank">
						<span>讓世界在身邊
							<br/>變遷系列 - 融冰</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1615" target="_blank">
						<span>讓世界在身邊
							<br/>變遷系列 - 冰山</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1614" target="_blank">
						<span>讓世界在身邊
							<br/>變遷系列 - 溫室效應</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/810" target="_blank">
						<span>喝水收納一把罩
							<br/>手工陶瓷杯 渴望</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/611" target="_blank">
						<span>陶藝職人手作
							<br/>花器合一 蛹護</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/532" target="_blank">
						<span>擺盤收納一棵搞定
							<br/>造型餐具 三葉樹
							<br/>Three Stella</span>
					</a>
				</div>
			</div>
			<div class="store">
				<div class="dash"></div>
				<a href="https://www.rapaq.com/store/view/208" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_01/logo.jpg">
					<span>五行創藝設計</span>
				</a>
				<div class="buttonAll">
					<div class="prev prev"></div>
					<div class="next next"></div>
				</div>
			</div>
		</div>
	</section>
	<!--問日常		 -->
	<section class="themeAll theme_Even">
		<div class="navbtnCTop jumpC-get" data-id="C"></div>
		<div class="theme_name">問日常</div>
		<div class="theme_titleS">生活手製</div>
		<div class="theme_description">以台灣的顏色當作背景，將藍染融入生活。</div>
		<div class="theme_Slider theme_Slider_Odd">
			<div class="owl-carousel owl-carouselL oneByOne">
				<a class="item" href="https://www.rapaq.com/product/1825" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_02/1.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1973" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_02/2.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1807" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_02/3.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1668" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_02/4.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1826" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_02/5.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1666" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_02/6.jpg">
				</a>
			</div>
			<div class="owl-carousel owl-carouselS oneByOne">
				<div class="item">
					<a href="https://www.rapaq.com/product/1825" target="_blank">
						<span>藍染素色圍巾
							<br/>『水戶』、『納戶』、
							<br/>『紺藍』</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1973" target="_blank">
						<span>藍濃道具屋墨水 - 台灣在地色系</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1807" target="_blank">
						<span>藍染三色階墨水－納戶、水色、紺藍</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1668" target="_blank">
						<span>有花紋的筆記本</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1826" target="_blank">
						<span>藍染花紋圍巾『雲』、『斑斕』、『晨』</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1666" target="_blank">
						<span>藍潮層積雲
							<br/>藍染漁夫帽</span>
					</a>
				</div>
			</div>
			<div class="store">
				<div class="dash"></div>
				<a href="https://www.rapaq.com/store/view/235" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_02/logo.jpg">
					<span>藍濃道具屋</span>
				</a>
				<div class="buttonAll">
					<div class="prev prev"></div>
					<div class="next next"></div>
				</div>
			</div>
		</div>

	</section>
	<!--問味蕾-->
	<section class="themeAll theme_Odd">
		<div class="navbtnDTop jumpD-get" data-id="D"></div>
		<div class="theme_name">問味蕾</div>
		<div class="theme_titleS">舌尖旅行</div>
		<div class="theme_description">想更親近當地土地的故事，就從味蕾的開始。</div>
		<div class="theme_Slider theme_Slider_Odd">
			<div class="jumpD-get"></div>
			<div class="owl-carousel owl-carouselL oneByOne">
				<a class="item" href="https://www.rapaq.com/product/1962" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_03/1.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1958" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_03/2.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1960" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_03/3.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1961" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_03/4.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1967" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_03/5.jpg">
				</a>
				<a class="item" href="https://www.rapaq.com/product/1963" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_03/6.jpg">
				</a>
			</div>
			<div class="owl-carousel owl-carouselS oneByOne">
				<div class="item">
					<a href="https://www.rapaq.com/product/1962" target="_blank">
						<span>自然野放 三芝純生
							<br/>包種茶（茶包）</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1958" target="_blank">
						<span>自然野放 三芝純生
							<br/>櫻花茶（散裝）</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1960" target="_blank">
						<span>自然野放 三芝純生
							<br/>東方美人茶（散裝）</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1961" target="_blank">
						<span>自然野放 三芝純生
							<br/>蜜香紅茶（茶包）</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1967" target="_blank">
						<span>自然野放 三芝純生
							<br/>包種茶（散裝）</span>
					</a>
				</div>
				<div class="item">
					<a href="https://www.rapaq.com/product/1963" target="_blank">
						<span>自然野放 三芝純生
							<br/>白毫烏龍（散裝）</span>
					</a>
				</div>
			</div>
			<div class="store">
				<div class="dash"></div>
				<a href="https://www.rapaq.com/store/view/237" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_03/logo.jpg">
					<span>
						小粟手作
					</span>
				</a>
				<div class="buttonAll">
					<div class="prev prev"></div>
					<div class="next next"></div>
				</div>
			</div>
		</div>
	</section>

	<!--問眼界-->

	<section class="themeAll theme_Even">
		<div class="navbtnETop" data-id="E"></div>
		<div class="theme_name">問眼界</div>
		<div class="theme_titleS">設群 Qshare</div>
		<div class="theme_description">寫下淡水的那些，歲月鏤刻的小鎮印象。</div>
		<div class="theme_Slider_Only theme_Slider_Odd">
			<div class="owl-carouselL oneByOne">
				<a class="item" href="https://qshare.rapaq.com/blog/show/298" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_04/pic_01.jpg">
				</a>
			</div>
			<div class="owl-carouselS oneByOne">
				<div class="item">
					<a href="https://qshare.rapaq.com/blog/show/298" target="_blank">
						<span>
							淡水印象
							<br/>歲月鏤刻的小鎮
						</span>
					</a>
				</div>
			</div>
			<div class="store">
				<div class="dash"></div>
				<a href="https://qshare.rapaq.com/" target="_blank">
					<img src="<?= base_url() ?>assets/event/taiwan_QTamsui/images/brand_04/logo.png">
					<span>設群 Qshare</span>
				</a>

			</div>
		</div>
	</section>

	<!--Share-->
	<section class="themeShare theme_Odd">
		<div class="t-relation__btn sharebtn ">
			分享主題
		</div>
	</section>
	<footer>
		<p>© 2018 RapaQ All Rights Reserved 版權所有</p>
	</footer>
	<!-- js-->
	<script src="<?= base_url() ?>assets/event/taiwan_QTamsui/js/jquery.js"></script>
	<script src="<?= base_url() ?>assets/event/taiwan_QTamsui/js/jquery.fadethis.js"></script>

	<script src="<?= base_url() ?>assets/event/taiwan_QTamsui/js/all.js"></script>
	<script src="<?= base_url() ?>assets/event/taiwan_QTamsui/js/share.js"></script>

	<script src="<?= base_url() ?>assets/event/taiwan_QTamsui/js/effects-core.min.js"></script>
	<script src="<?= base_url() ?>assets/event/taiwan_QTamsui/js/action.js"></script>
	<!--owl-->
	<link href="<?= base_url() ?>assets/event/taiwan_QTamsui/js/owl/owl.carousel.css" rel="stylesheet">
	<script src="<?= base_url() ?>assets/event/taiwan_QTamsui/js/owl/owl.carousel.js"></script>
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

	</script>
</body>

</html>