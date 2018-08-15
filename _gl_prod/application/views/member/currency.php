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
			<h2>Q幣</h2>
		</header>
		<section class="m-notify">
			<div class="m-notify-wrap">
				<div class="m-notify-personal wallet">
					<div class="wallet__wrap">
						<div class="wallet__status">
							<div class="amount">
								<span class="wallet__amount f--red f--45 f--lheight1">999999</span>
								<div class="wallet__unit mt5">目前擁有的Q幣</div>
							</div>
							<div class="function function--bill clearfix">
								<div class="bills">
									<span class="wallet__amount f--red f--20">100</span>
									<div class="wallet__unit">已累積</div>
								</div>
								<div class="bills">
									<span class="wallet__amount f--gray f--20">10</span>
									<div class="wallet__unit">已使用</div>
								</div>
							</div>
						</div>
						<!--
                        <div class="no-content">
                            <img src="/assets/img/no-bill.svg" alt="">
                            <p>尚無Q幣</p>
                        </div>								
						-->
						<ul class="m-notify-personal-list" data-id="js-moreList">
							<li class="list-row">
								<div class="list-row__amount">
									<span>+5</span>
								</div>
								<div class="list-row-content">
									<div class="list-row-content__title">
										得到Q幣的原因
									</div>
									<div class="list-row-content__from">
										來源
									</div>
									<div class="list-row-content__time">時間</div>
								</div>
							</li>
							<li class="list-row">
								<div class="list-row__amount">
									<span>+99999</span>
								</div>
								<div class="list-row-content">
									<div class="list-row-content__title">
										分享了一項好物至設群
									</div>
									<div class="list-row-content__from">
										Product Name 商品名稱，商品資訊，商品吧啦吧啦？？字很長，不折行變成點點點
									</div>
									<div class="list-row-content__time">2017 年 6 月 27 日</div>
								</div>
							</li>
						</ul>
						<!-- 12個以上就開啟按鈕載入更多 -->
						<div class="btn-more-load" data-id="js-loadMore">
							<span class="more-text">更多紀錄</span>
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