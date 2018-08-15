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
			<h2>訂單查詢</h2>
		</header>
		<section class="m-order">
			<div class="m-order-wrap">
				<div class="m-order-search">
					<input type="text" placeholder="請輸入訂單編號" class="m-order-search__input">
					<input type="button" value="搜尋" class="m-order-search__btn">
				</div>
				<div class="m-order-select select select-wh">
					<span>三個月以內的訂單</span>
					<ul>
						<li>三個月以內的訂單</li>
						<li>三個月以上的訂單</li>
					</ul>
				</div>
				<div class="m-order-order">
					<div class="order-box">
						<!-- 帶參數 訂單號碼-->
						<a href="<?= base_url() ?>member/orderDetail">
							<ul class="order-box-list">
								<li>
									<div class="order-box__left">訂單編號</div>
									<div class="order-box__right">1234567890</div>
								</li>
								<li>
									<div class="order-box__left">訂購日期</div>
									<div class="order-box__right">2017 / 6 / 27</div>
								</li>
								<li>
									<div class="order-box__left">訂單狀態</div>
									<div class="order-box__right order--setup">訂單成立</div>
									<!-- 訂單狀態有以下幾種：
										訂單成立 order--setup
										訂單處理中 order--processing
										訂單成功 order--success
										訂單失敗 order--failure
										退貨/退款 order--return
										訂單異動 order--change
									 -->
								</li>
								<li>
									<div class="order-box-price">
										<div class="order-box__right">詳細資訊</div>
									</div>
								</li>
							</ul>
							<div class="order-box-price">
								<div class="order-box__left">訂單總額</div>
								<div class="order-box__right">NT$ 19,140</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>