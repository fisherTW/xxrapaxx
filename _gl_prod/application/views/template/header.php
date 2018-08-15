<!DOCTYPE html>
<!--
   ___               __                 __  __          _____     __
  / _ \___ _  _____ / /__  ___  ___ ___/ / / /  __ __  / __(_)__ / /  ___ ____
 / // / -_) |/ / -_) / _ \/ _ \/ -_) _  / / _ \/ // / / _// (_-</ _ \/ -_) __/
/____/\__/|___/\__/_/\___/ .__/\__/\_,_/ /_.__/\_, / /_/ /_/___/_//_/\__/_/
                        /_/                   /___/
-->
<html xmlns='http://www.w4.org/1999/xhtml'>
<html lang="zh_TW">
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-101741126-9"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-101741126-9');
		</script>
		<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/favicon-16x16.png">
		<link rel="manifest" href="<?= base_url() ?>assets/img/site.webmanifest">
		<link rel="mask-icon" href="<?= base_url() ?>assets/img/safari-pinned-tab.svg" color="#ff000f">
		<meta name="msapplication-TileColor" content="#00aba9">
		<meta name="theme-color" content="#ffffff">
				
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2">
		<title><?= $title ?></title>

		<meta name="title" content="RapaQ - 我的生活，由我設計" />
		<meta name="description" content="我們熱愛創新設計帶來的美好生活，結合原創設計與優秀製造能量，專注帶給人們全方位的質感設計生活。期許每個人在RapaQ，找好設計師、找好創意想法、買好設計商品、讀好設計觀點。" />
		<meta name="keywords" content="買設計,募設計,看設計,rapaq,買物,購物,qgoods,設計,生活,破點,point,品味,品物,好物,簡單,美學,設計,創意,創造,自造,藝術,樂活,maker,台灣,製造,客製化,訂製,手作,潮流,雅痞,文青,文創,文藝,時尚,辦公,休閒,旅行,空間,趣味">
		<link rel="image_src" href="https://storage.googleapis.com/rapaq_public/images/Rapaq_red_w1024.png" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?= isset($og_title) ? $og_title : 'RapaQ - 我的生活，由我設計' ?>" />
		<meta property="og:description" content="<?= isset($og_description) ? $og_description : '我們熱愛創新設計帶來的美好生活，結合原創設計與優秀製造能量，專注帶給人們全方位的質感設計生活。期許每個人在RapaQ，找好設計師、找好創意想法、買好設計商品、讀好設計觀點。' ?>" />
		<meta property="og:image" content="<?=  isset($og_image) ? $og_image : 'https://storage.googleapis.com/rapaq_public/images/Rapaq_red_w1024.png' ?>" />
		<meta property="og:url" content="<?= isset($og_url) ? $og_url : 'https://www.rapaq.com/' ?> " />
		<meta property="og:site_name" content="RapaQ - 我的生活，由我設計" />
		<link rel="icon" type="image/ico" href="<?= base_url()?>assets/img/favicon.ico">
		<link href='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'/>
		<link href='<?= base_url()?>assets/css/base.css' rel='stylesheet' type='text/css'/>
		<link href='<?= base_url()?>assets/css/layout.css' rel='stylesheet' type='text/css'/>
<!--
		<link href='<?= base_url()?>assets/css/vendors/swiper.min.css' rel='stylesheet' type='text/css'/>
 		<link href='<?= base_url()?>assets/css/menu.css' rel='stylesheet' type='text/css'/>
-->
		<link href='<?= base_url()?>assets/css/RapaqHeader.css' rel='stylesheet' type='text/css'/>
	    <link href='<?= base_url()?>assets/css/RapaqFooter.css' rel='stylesheet' type='text/css'/>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
 		<script src='<?= base_url()?>assets/js/nav.js'></script>
		<script>
			$(function() {
				// fisher
				$('#btn_login').bind('click', function() {
					window.location = '<?= base_url()?>member/login?back=' + window.location.href;
				});

				$('#btn_logout').bind('click', function() {
					window.location = '<?= base_url()?>member/doLogout';
				});
			});
		</script>
<!-- Hotjar Tracking Code for www.rapaq.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:959831,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>				
	</head>
	<body>
	<header class="header_top">
		<!--logo-->
		<div class="div_headerLeft">
			<div class="div_navIcon">
				<a class="logoBlack" href="javascript:void(0);">
					<img src="<?= base_url() ?>assets/img/logo-red.png"><span></span>
				</a>
				<a class="logoS" href="javascript:void(0);">
					<img src="<?= base_url() ?>assets/img/apple-touch-icon.png">
				</a>
			</div>
		</div>
		<div class="div_headerRight">
			<a href="<?= base_url() ?>checkout/list"><img src="<?= base_url() ?>assets/img/icon_tools/cart.png"></a>
<!--
			<a href="javascript:void(0)"><img src="<?= base_url() ?>assets/img/icon_tools/remind.png"></a>
-->
			<a class="a_search" href="javascript:void(0)"><img src="<?= base_url() ?>assets/img/icon_tools/search.png"></a>
<?php if(isset($_SESSION['sess_user_id'])): ?><!-- 已登入 -->
			<button class="login"><img src="<?= base_url() ?>assets/img/icon_tools/photo.png"></button>
			<nav class="nav_member">
				<a class="a_navMemberHead" href="<?= base_url() ?>member/main">
					<img src="<?= base_url() ?>assets/img/icon_tools/photo.png">
					<p><?= $_SESSION['sess_user_name'] ?><span>會員中心</span></p>
				</a>
				<hr>
				<a href="<?= base_url() ?>member/profileEdit">個人資料</a>
				<a href="<?= base_url() ?>member/order">訂單查詢</a>
				<a href="<?= base_url() ?>member/addressBook">常用收件</a>
<!-- 
				<a href="<?= base_url() ?>member/">Q幣</a>
				<a href="<?= base_url() ?>member/">折價券</a>
-->
				<a href="<?= base_url() ?>member/bookmarkStore">收藏</a>
				<hr>
				<button id='btn_logout'>登出</button>
			</nav>	
<?php else: ?><!-- 未登入 -->
			<button id='btn_login' class="logout"><span>註冊／登入</span><img src="<?= base_url() ?>assets/img/icon_tools/member.png""></button>			
<?php endif; ?>
		</div>
	</header>
	<!--menu-->
	<nav class="nav_headerCenter">
		<div class="div_navClose">
			<div class="div_navCloseIcon"><span class="span_left"></span><span class="span_right"></span></div>
		</div>
		<!--當前主題加class arrive-->
		<a class="a_QMaker" href="<?= base_url() ?>qmaker">募設計</a>
		<a class="a_QGoods" href="<?= base_url() ?>qgoods">買設計</a>
		<a class="a_QShare" href="https://qshare.rapaq.com/">看設計</a>
		<a class="a_Point" href="http://point.rapaq.com/">破點</a>
	</nav>
	<!--searchBar-->
	<div class="div_searchBar">
		<input type="search" name="txt_search" id="txt_search" placeholder="你想找什麼？">
		<button id="btn_search"><img src="<?= base_url() ?>assets/img/arrow_right.png"></button>
	</div>
	<!--QMaker 增加class .header_QMaker-->
	<!--QGoods 增加class .header_QGoods-->
	<!--QShare 增加class .header_QShare-->
	<!--Point 增加class .header_Point-->
<script type="text/javascript">
document.querySelector('#txt_search').addEventListener('keypress', function (e) {
	var key = e.which || e.keyCode;
	if (key === 13) { 
		$("#btn_search").trigger('click');
	}
});
$("#btn_search").click(function() {
	window.location = '<?= base_url() ?>search/list?word='+$("#txt_search").val();
});
</script>