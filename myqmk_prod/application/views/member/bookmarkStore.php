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
			<h2>收藏的店舖</h2>
		</header>
		<section class="m-like">
			<div class="m-like-wrap">
				<div class="m-like-store s-result-goods">
					<!-- 無任何結果顯示 start -->
<!-- 						
					<div class=" no-result">
						<div class="no-result__pic">
							<img src="img/icons/no-store2.svg" alt="">
						</div>
						<div class="no-result__pic">
							<img src="img/icons/no-store2.svg" alt="">
						</div>
						<div class="no-result__text">尚無收藏店舖</div>
					</div> 
-->
					<!-- 無任何結果顯示 end -->
					<div class="m-like-store-list">
						<div class="like-store">
							<div class="like-store-brand">
								<div class="like-store-brand__pic">
									<img src="img/assests/brandlogo.png" alt="">
								</div>
								<div class="like-store-brand__name">
									TOOLS to LIVEBY / 禮拜文房具
								</div>
								<div class="like-store-brand__num">10項最新商品</div>
								<div class="like-store-brand__like">已收藏</div>
							</div>
							<div class="like-store-goods">
								<div id="scrolling-01">
									<ul class="scrolling">
										<li>
											<a href="">
												<div class="like-store-goods__pic">
												<img src="img/assests/goods01.jpg" alt="">
												</div>
												<div class="like-store-goods__name">超實用強力磁鐵條+磁鐵方塊</div>
											</a>
										</li>
										<li>
											<a href="">
												<div class="like-store-goods__pic">
												<img src="img/assests/goods02.jpg" alt="">
												</div>
												<div class="like-store-goods__name">超實用強力磁鐵條+磁鐵方塊</div>
											</a>
										</li>
										<li>
											<a href="">
												<div class="like-store-goods__pic">
												<img src="img/assests/goods03.jpg" alt="">
												</div>
												<div class="like-store-goods__name">超實用強力磁鐵條+磁鐵方塊</div>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- 12個以上就開啟按鈕載入更多 -->
					<div class="btn-more-load" id="store-more">
						<span class="more-text">更多收藏</span>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>