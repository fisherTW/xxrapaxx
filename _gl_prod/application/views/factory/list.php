<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url() ?>assets/css/search.css' rel='stylesheet' type='text/css'/>

<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>
<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_homeTheme">
	<div class="div_partnerPage">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="div_title">
						<h2>攜眾人之力，將創意落實</h2>
						<p>募設計 與產業／品牌互利共生，從產品研發設計、品牌轉型、行銷通路至開發新市場，讓雙方一同成長。</p><a href="<?= base_url() ?>factory/form"><span>申請成為夥伴</span></a>
					</div>
				</div>
			</div>
			<div class="row">
<?php if(count($ary_factory) > 0): ?>
<?php foreach($ary_factory as $item): ?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="div_partnerEach"><a class="a_partnerStore" href="<?= base_url() ?>factory/view/<?= $item['id'] ?>">
						<div class="div_storeImg"><img src="<?= URL_GOOGLE_IMG.$item['pic_logo'] ?>" alt=""></div>
						<p><?= $item['name'] ?></p><span><?= $item['profile'] ?></span></a>
<!--							
						<div class="div_partnerProduct row">
							<div class="col-xs-4"><a href="<?= base_url() ?>factory/view/<?= $item['id'] ?>" style="background-image:url(<?= URL_GOOGLE_IMG.$item['pic_1'] ?>"></a></div>
							<div class="col-xs-4"><a href="<?= base_url() ?>factory/view/<?= $item['id'] ?>" style="background-image:url(<?= URL_GOOGLE_IMG.$item['pic_2'] ?>"></a></div>
							<div class="col-xs-4"><a href="<?= base_url() ?>factory/view/<?= $item['id'] ?>" style="background-image:url(<?= URL_GOOGLE_IMG.$item['pic_3'] ?>"></a></div>
						</div>
-->							
					</div>
				</div>
<?php endforeach; ?>
<?php endif; ?>
			</div>
			<div class="row">
				<div class="col-xs-12 div_navigation">
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">
							<?php foreach($FactorysCount as $count): ?>
							<?php if($page == $count): ?>
							<li class="page-item disabled" ><a class="page-link" href="<?= base_url() ?>factory/list/<?= $count ?>"><?= $count ?></a></li>
							<?php else: ?>
							<li class="page-item"><a class="page-link" href="<?= base_url() ?>factory/list/<?= $count ?>"><?= $count ?></a></li>
							<?php endif; ?>
							<?php endforeach; ?>
							</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>