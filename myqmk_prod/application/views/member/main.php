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
			<div class="m-header__face">
				<img src="<?= $info['pic_head'] ?>" alt="">
			</div>
			<div class="m-header__name"><?= $info['name'] ?></div>
			<div class="m-header-money">
				<a href="<?= base_url() ?>member/currency">
					<div class="m-header-money-q">
						<div class="money__num">100</div>
						<div class="money__unit">Q幣</div>
					</div>
				</a>
				<a href="<?= base_url() ?>member/coupon">
					<div class="m-header-money-c">
						<div class="money__num">10</div>
						<div class="money__unit">張折價券</div>
					</div>
				</a>
			</div>
		</header>
		<section class="m-content">
			<div class="m-content-wrap">
				<ul class="m-content-items">
					<li class="m-content-items__01">
						<a href="<?= base_url() ?>member/order">
							<div class="items-height">
								<div class="items__icon"></div>
								<span>訂單查詢</span>
							</div>
						</a>
					</li>
					<li class="m-content-items__03">
						<a href="<?= base_url() ?>member/bookmarkProduct">
							<div class="items-height">
								<div class="items__icon"></div>
								<span>收藏產品</span>
							</div>
						</a>
					</li>
					<li class="m-content-items__03">
						<a href="<?= base_url() ?>member/bookmarkStore">
							<div class="items-height">
								<div class="items__icon"></div>
								<span>收藏店鋪</span>
							</div>
						</a>
					</li>
					<li class="m-content-items__04">
						<a href="<?= base_url() ?>member/currency">
							<div class="items-height">
								<div class="items__icon"></div>
								<span>Q幣</span>
							</div>
						</a>
					</li>
					<li class="m-content-items__04">
						<a href="<?= base_url() ?>member/coupon">
							<div class="items-height">
								<div class="items__icon"></div>
								<span>折價券</span>
							</div>
						</a>
					</li>
					<li class="m-content-items__05">
						<a href="<?= base_url() ?>member/addressBook">
							<div class="items-height">
								<div class="items__icon"></div>
								<span>常用收件</span>
							</div>
						</a>
					</li>
					<li class="m-content-items__05">
						<a href="<?= base_url() ?>member/profileEdit">
							<div class="items-height">
								<div class="items__icon"></div>
								<span>個人資料</span>
							</div>
						</a>
					</li>				
				</ul>
			</div>
		</section>
	</div>
</div>