<link href='<?= base_url() ?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url() ?>assets/css/brand.css' rel='stylesheet' type='text/css'/>

<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="wrapper">
	<div class="wrapper-inner">
		<header class="b-header"> </header>
		<section class="b-content">
			<div class="b-content-wrap section-wrap">
				<div class="b-content__logo"><img src="<?= URL_GOOGLE_IMG.$info['brand_logo'] ?>" alt=""></div>
				<div class="b-content__name"><?= $info['brand_name'] ?></div>
				<div class="b-content__intro"><?= $info['brand_profile'] ?></div>					
				<div class="b-content__back"><a href="<?= base_url() ?>project/view/<?= $info['id'] ?>"><span class="arrow-line3"></span><span class="arrow-line4"></span><span>返回計畫</span></a></div>
			</div>
		</section>
	</div>
</div>