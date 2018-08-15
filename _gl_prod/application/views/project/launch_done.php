<link rel="stylesheet" href="<?= base_url()?>assets/css/launch.css">
<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>

<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>
<div class="wrapper">
	<div class="mask"></div>
	<div class="div_maskForSearch"></div>
	<nav class="nav">
		<div class="nav-load">
		</div>
	</nav>
	<div class="wrapper-inner">
		<header class="l-header" style="margin-top: 40px">
			<div class="l-header__bg"></div>
			<div class="l-header__title">
				發起計畫
			</div>
			<ul class="l-header__process">
				<li class="processing process-info">
					<div class="processing__circle">
						<div class="processing__circle_dot dot-white"></div>
					</div>
					<div class="processing__text">基本資料</div>
				</li>
				<li class="processingline"></li>
				<li class="processing process-outline">
					<div class="processing__circle">
						<div class="processing__circle_dot dot-white"></div>
					</div>
					<div class="processing__text">計畫大綱</div>
				</li>
				<li class="processingline"></li>
				<li class="processing process-submit">
					<div class="processing__circle">
						<div class="processing__circle_dot"></div>
					</div>
					<div class="processing__text">計畫送出</div>
				</li>
			</ul>
		</header>
		<section class="l-submit">
			<div class="l-submit-wrap section-wrap">
				<div class="l-submit__ok">
					<div class="ok-vv">
						<span class="ok-vv__left"></span>
						<span class="ok-vv__right"></span>
					</div>
				</div>
				<div class="l-submit__title">計畫已送出審核</div>
				<div class="l-submit-msg">
					我們將會以E-mail通知您審核是否通過！
					<br>
					<span>計畫編號</span> <?= $lastUpdateId ?>
					<span>計畫標題</span> <?= $project_name ?>
				</div>
			</div>
		</section>
	</div>
</div>
