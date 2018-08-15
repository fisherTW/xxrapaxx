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
			<h2>收藏的商品</h2>
		</header>
		<section class="m-like">
			<div class="m-like-wrap">
				<div class="m-like-goods s-result-goods">
					<!-- 無任何結果顯示 start -->
<!-- 						
					<div class="no-result">
						<div class="no-result__pic">
							<img src="img/icons/no-goods2.svg" alt="">
						</div>
						<div class="no-result__text">尚無收藏商品</div>
					</div> 
-->
					<!-- 無任何結果顯示 end -->
					<ul class="s-result-goods-list">
						<li>
							<div class="goods-list__pic">
								<a href=""><img src="img/assests/goods01.jpg" alt=""></a>
							</div>
							<div class="goods-list-info">
								<div class="info__brand"><a href="">品牌名稱</a></div>
								<div class="info__name"><a href="">超實用強力磁鐵條+磁鐵方塊</a></div>
								<div class="info__store"><a href="">店舖名稱</a></div>
								<div class="info__price">
									<span class="price-offical">
										NT$ 190
									</span>
									<span class="price-sale">
										NT$ 154
									</span>
								</div>  
							   <div class="info__like is--active"></div>
							</div>
						</li>
						<li>
							<div class="goods-list__pic">
								<a href=""><img src="img/assests/goods02.jpg" alt=""></a>
							</div>
							<div class="goods-list-info">
								<div class="info__brand"><a href="">品牌名稱</a></div>
								<div class="info__name"><a href="">極簡金屬置物盤 恣意裝飾空間極簡金屬置物盤 恣意裝飾空間極簡金屬置物盤 恣意裝飾空間極簡金屬置物</a></div>
								<div class="info__store"><a href="">店舖名稱</a></div>
								<div class="info__price">
									<span class="price-sale">
										NT$ 990
									</span>
								</div>  
								<div class="info__like is--active"></div>
							</div>
						</li>
						<li>
							<div class="goods-list__pic">
								<a href=""><img src="img/assests/goods03.jpg" alt=""></a>
							</div>
							<div class="goods-list-info">
								<div class="info__brand"><a href="">品牌名稱</a></div>
								<div class="info__name"><a href="">編織紋收納籃 仿真質感編織設</a></div>
								<div class="info__store"><a href="">店舖名稱</a></div>
								<div class="info__price">
									<span class="price-sale">
										NT$ 15,000
									</span>
								</div> 
								<div class="info__like is--active"></div> 
							</div>
						</li>
					</ul>
					<!-- 12個以上就開啟按鈕載入更多 -->
					<div class="btn-more-load" id="goods-more">
						<span class="more-text">更多收藏</span>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>