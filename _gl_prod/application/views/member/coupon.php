<link href='<?= base_url()?>assets/css/member-add.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/wallet.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/member.css' rel='stylesheet' type='text/css'/>
<script src='<?= base_url()?>assets/js/member.js'></script>

<div class="mask"></div>
<nav class="nav">
	<div class="nav-load">
	</div>
</nav>
<div class="wrapper wrapperzero">
	<div class="wrapper-inner">
		<header class="m-header">
			<h2>折價券</h2>
		</header>
		<section class="m-notify">
			<div class="m-notify-wrap">
				<div class="m-notify-activities wallet">
					<div class="wallet__wrap wallet__wrap--coupons">
						<div class="wallet__status">
							<div class="amount">
								<span class="wallet__amount f--red f--45 f--lheight1">30</span>張
								<div class="wallet__unit mt5">目前擁有的折價券</div>
							</div>
							<div class="function function--coupons clearfix">
								<div class="insert">
									<div class="insert__input">
										<input type="text" placeholder="請輸入折價券代碼" />
									</div>
									<div class="insert__button">
										<button type="button">兌換</button>
									</div>
								</div>
							</div>
						</div>
						<!-- 無折價券
						<div class="no-content">
							<img src="img/icons/no-coupons.svg" alt="">
							<p>尚無折價券</p>
						</div>
						-->
						<ul class="grid grid--2grid clearfix" data-id="js-moreList" data-list="coupons">
							<li>
								<div class="coupons">
									<div class="coupons__info">
										<div class="title">折價券活動來源</div>
										<div class="description">
											<div class="description__rules">使用限制</div>
											<div class="description__exp">使用期限</div>
										</div>
									</div>
									<div class="coupons__discount">
										NT$<span class="price">0000</span>
									</div>
								</div>
							</li>
							<li>
								<div class="coupons">
									<div class="coupons__info">
										<div class="title">會員專屬 $888</div>
										<div class="description">
											<div class="description__rules">單品滿10000使用</div>
											<div class="description__exp">2017年6月6日前有效</div>
										</div>
									</div>
									<div class="coupons__discount">
										NT$<span class="price">1111</span>
									</div>
								</div>
							</li>
							<li>
								<div class="coupons">
									<div class="coupons__info">
										<div class="title">會員專屬 $888</div>
										<div class="description">
											<div class="description__rules">單品滿10000使用</div>
											<div class="description__exp">2017年6月6日前有效</div>
										</div>
									</div>
									<div class="coupons__discount">
										NT$<span class="price">2222</span>
									</div>
								</div>
							</li>
						</ul>
						<!-- 12個以上就開啟按鈕載入更多 -->
						<div class="btn-more-load" data-id="js-loadMore">
							<span class="more-text">更多折價券</span>
						</div>
					</div>
					<div class="wallet__wrap wallet__wrap--notice" data-id="couponsNotice">
						<div class="wallet__notice">
							<ol>
								<!--此處數字須為全形才能對齊-->
								<li data-sequence="１.">折價券為會員於RapaQ好物購物時使用，請您先加入會員或是登入會員帳號及密碼後方可使用。</li>
								<li data-sequence="２.">折價券不可與其他優惠方案一起使用。</li>
								<li data-sequence="３.">單一商品最多可使用一張折價金，若同一個商品購買兩個仍只可使用一張折價券。</li>
								<li data-sequence="４.">每張折價券包含券號及使用效期，請於使用效期前使用，逾期恕無法折抵使用。</li>
								<li data-sequence="５.">每張折價券有不同適用範圍及商品使用金額門檻，折價券並非適用範圍內所有商品皆可使用。</li>
								<li data-sequence="６.">折價券使用後，若取消訂單或辦理退貨時，折價券恕不歸還。</li>
								<li data-sequence="７.">折價券限會員本人使用，無法轉讓、兌換現金及找零，或折換贈品。</li>
								<li data-sequence="８.">訂單發票以「實際付款金額」開立，使用折價券折抵部分將不另開發票。</li>
								<li data-sequence="９.">折價金為贈品，屬於無償取得，不適用商品禮券記載之規範。</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		//判定是否出現load more按鈕
		function caculateLiLength() {
			var listLi = $('[data-id="js-moreList"]').each(function() {
				var liLength = $(this).children("li").length;

				if (liLength <= 12) {
					$(this).closest('.wallet').find('[data-id="js-loadMore"]').hide();
				} else {
					$(this).closest('.wallet').find('[data-id="js-loadMore"]').show();
				}
			});
		}
		caculateLiLength();

		//載入更多折價券
		$('[data-id="js-moreList"] > li').hide();
		$('[data-id="js-moreList"]').each(function() {
			$(this).find('li').slice(0, 12).show();
		});
		$('body').on('click', '[data-id="js-loadMore"]', function(e) {
			e.preventDefault();
			var $targetList = $(this).closest('.wallet').find('[data-id="js-moreList"] > li:hidden');
			$targetList.slice(0, 6).slideDown();
			if ($targetList.length <= 6) {
				$(this).fadeOut(500);
			}
			$('html,body').animate({
				scrollTop: $(this).offset().top - 20
			}, 1000);
		});
	})
</script>