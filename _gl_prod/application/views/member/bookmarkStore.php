<link href='<?= base_url()?>assets/css/search.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/member-add.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/member.css' rel='stylesheet' type='text/css'/>
<script src='<?= base_url()?>assets/js/member.js'></script>
<script src='<?= base_url()?>assets/js/itemslide.js'></script>
<script src='<?= base_url()?>assets/js/member-like.js'></script>

<div class="mask"></div>
<nav class="nav">
	<div class="nav-load">
	</div>
</nav>
<div class="wrapper wrapperzero"> 
	<div class="wrapper-inner">
		<header class="m-header">
			<h2>收藏的計畫/店鋪/商品</h2>
		</header>
		<section class="m-like">
			<div class="m-like-wrap">
				<div class="m-like-store s-result-goods">
<?php if(count($info) == 0 && count($info_store) == 0 && count($info_product) == 0): ?>
					<div class=" no-result">
						<div class="no-result__pic">
							<img src="img/icons/no-store2.svg" alt="">
						</div>
						<div class="no-result__pic">
							<img src="img/icons/no-store2.svg" alt="">
						</div>
						<div class="no-result__text">尚無計畫/店鋪/商品</div>
					</div> 
<?php else: ?>					
					<div class="m-like-store-list">
<?php if(count($info) > 0): ?>
						<h2><center>-- 計畫 --</center></h2>
<?php foreach($info as $v): ?>
						<div class="like-store">
							<div class="like-store-brand">
								<div class="like-store-brand__pic">
									<img src="<?= URL_GOOGLE_IMG.$v['pic_cover'] ?>" alt="">
								</div>
								<div class="like-store-brand__name">
									<?= $v['name'] ?>
								</div>
								<div class="like-store-brand__num"><?= count($v['product']) ?>項最新商品</div>
								<div class="like-store-brand__like">已收藏</div>
							</div>
							<div class="like-store-goods">
								<div id="scrolling-01">
									<ul class="scrolling">
<?php foreach($v['product'] as $k_prod => $prod): ?>										
										<li>
											<a href="<?= base_url() ?>project/view/<?= $v['id'] ?>">
												<div class="like-store-goods__pic">
												<img src="<?= URL_GOOGLE_IMG.$prod['url_pic'] ?>" alt="">
												</div>
												<div class="like-store-goods__name"><?= $prod['name'] ?></div>
											</a>
										</li>
<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>	
<?php endforeach; ?>
<?php endif; ?>
<?php if(count($info_store) > 0): ?>
						<h2><center>-- 店鋪 --</center></h2>
<?php foreach($info_store as $s): ?>
						<div class="like-store">
							<div class="like-store-brand">
								<a href="<?= base_url() ?>store/view/<?= $s['id'] ?>">
									<div class="like-store-brand__pic">
										<img src="<?= URL_GOOGLE_IMG.$s['pic_logo'] ?>" alt="">
									</div>
									<div class="like-store-brand__name">
										<?= $s['name'] ?>
									</div>
								</a>
								<div class="like-store-brand__like">已收藏</div>
							</div>
						</div>	
<?php endforeach; ?>
<?php endif; ?>
<?php if(count($info_product) > 0): ?>
<?php foreach($info_product as $p): ?>
						<h2><center>-- 產品 --</center></h2>
						<div class="like-store">
							<div class="like-store-brand">
								<a href="<?= base_url() ?>product/<?= $p['id'] ?>">
									<div class="like-store-brand__pic">
										<img src="<?= URL_GOOGLE_IMG.$p['url_pic'] ?>" alt="">
									</div>
									<div class="like-store-brand__name">
										<?= $p['name'] ?>
									</div>
								</a>
								<div class="like-store-brand__like">已收藏</div>
							</div>
						</div>	
<?php endforeach; ?>
<?php endif; ?>
					</div>					
<?php endif; ?>
					<!-- 12個以上就開啟按鈕載入更多 -->
<!--					
					<div class="btn-more-load" id="store-more">
						<span class="more-text">更多收藏</span>
					</div>
-->					
				</div>
			</div>
		</section>
	</div>
</div>