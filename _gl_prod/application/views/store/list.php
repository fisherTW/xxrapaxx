<link href='<?= base_url()?>assets/css/QGoods.css' rel='stylesheet' type='text/css'/>

<header class="header_theme header_QGoods"><a href="<?= base_url() ?>theme/list">主題好物</a>
	<a class="arrive" href="<?= base_url() ?>store/list">店舖推薦</a><a href="<?= base_url() ?>product/list">好物分類</a></header>
<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_home">
	<div class="div_storePage"  style="margin-top: 100px;">
		<div class="container">
			<div class="row">
<?php if($ary_data > 0): ?>
<?php foreach($ary_data as $val): ?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="div_partnerEach"><a class="a_partnerStore" href="<?= base_url() ?>store/view/<?= $val['id'] ?>">
						<div class="div_storeImg" style="background-image:url(<?= URL_GOOGLE_IMG.$val['pic_logo'] ?>"></div>
						<p><?= $val['name'] ?></p><span><?= $val['product_count'] ?> 項商品 ・ <?= $val['favorite_count'] ?> 人收藏</span></a>
						<div class="div_partnerProduct row">
<?php if(count($val['url_pic']) >0): ?>
<?php foreach ($val['url_pic'] as $value): ?>
							<div class="col-xs-4"><a href="javascript:void(0)" style="background-image:url('<?= $value ?>'"></a></div>
<?php endforeach; ?>
<?php endif; ?>
						</div>
					</div>
				</div>
<?php endforeach; ?>				
<?php endif; ?>
			</div>
			<div class="row">
				<div class="col-xs-12 div_navigation">
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">
<?php foreach($StoreCount as $count): ?>
<?php if($page == $count): ?>
							<li class="page-item disabled" ><a class="page-link" href="<?= base_url() ?>store/list/<?= $count ?>"><?= $count ?></a></li>
<?php else: ?>
							<li class="page-item"><a class="page-link" href="<?= base_url() ?>store/list/<?= $count ?>"><?= $count ?></a></li>
<?php endif; ?>
<?php endforeach; ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>