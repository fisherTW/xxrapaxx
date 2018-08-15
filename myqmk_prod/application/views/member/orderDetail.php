<link href='<?= base_url()?>assets/css/checkout.css' rel='stylesheet' type='text/css'/>
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
			<h4><span>#1234567890</span>詳情</h4>
		</header>
		<section class="m-orderDetail">
			<div class="m-order-wrap">
				<ul class="m-orderDetail-top">
					<li>
						<div class="order-box__left">
							付款狀態
						</div>
						<div class="order-box__right status--notpay">未付款</div>
						<!-- 
						未付款 status--notpay
						已付款 status--haspaid
						退款中 status--refund
						已退款 status--refunded
						 -->
					</li>
					<li>
						<div class="order-box__left">
							訂購日期
						</div>
						<div class="order-box__right">
							2017 / 6 / 27
						</div>
					</li>
				</ul>
			</div>
		</section>
		<section class="c-showall">
			<div class="c-showall-wrap">
				<h3>商品明細</h3>
				<div class="c-showall-store" id="store001">
					<div class="store-brand">
						<img src="img/assests/brandlogo.png" alt="" class="brand__logo">
						<span>bellroy</span>
						<div class="store-brand__ask">
							<a href="member-order-ask.html">
								聯絡店鋪
							</a>
						</div>
					</div>
					<div class="store-use">
						<ul class="store-use-way">
							<li class="wayname">便利商店取貨 - 全家、萊爾富、OK</li>
							<li class="wayfee">$30</li>
						</ul>
						<ul class="store-use-info">
							<li class="infoshop">全家師美店</li>
							<li class="infopeople">收件人 - 0900000000</li>
							<li class="infoaddress">11681 -台北市文山區丟汀州路四段77號</li>
						</ul>
					</div>
					<div class="store-remark">
						<div class="store-remark__title">備註</div>
						<div class="store-remark__ps">能否在晚上7:00後送達？</div>
					</div>
					<div class="store-goods">
						<div class="store-goods-box">
							<div class="store-goods__pic">
								<img src="img/assests/shop01.jpg" alt="">
							</div>
							<div class="pos-right">
								<div class="store-goods__name">
									iRing多功能手機固定環+iPhone 7 Plus雙層防摔插卡殼－限量版套組 珠光白
								</div>
								<div class="store-goods__shipment status--ship">
									已到達
									<!-- 出貨狀態有以下 
										備貨中 status--prepare
										已發貨 status--get
										已到達 status--ship
										已取貨 status--arrive
										申請退貨 status--apply
										退貨申請 status--return
										退貨完成 status--returned
									-->
								</div>
								<div class="store-goods__select">
									Arctic Blue
								</div>
								<div class="store-goods__price">
									NT$ 3,190 x 2
								</div>
							</div>
						</div>
						<div class="store-goods-plus">
							<span class="store-goods-plus__title">好物加購</span>
							<div class="store-goods-plus-box">
								<div class="store-goods-plus__pic">
									<img src="img/assests/goods02.jpg" alt="">
								</div>
								<div class="pos-right">
									<div class="store-goods-plus__name">
										iRing多功能手機固定環+iPhone 7 Plus雙層防摔插卡殼－限量版套組 珠光白
									</div>
									<div class="store-goods-plus__select">
										Arctic Blue
									</div>
									<div class="store-goods-plus__price">
										NT$ 3,190 x 2
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="store-goods">
						<div class="store-goods-box">
							<span class="store-goods__status order">訂製品</span>
							<div class="store-goods__pic">
								<img src="img/assests/shop12.jpg" alt="">
							</div>
							<div class="pos-right">
								<div class="store-goods__name">
									iRing多功能手機固定環+iPhone 7 Plus雙層防摔插卡殼－限量版套組 珠光白
								</div>
								<div class="store-goods__shipment status--return"><a href="member-order-return.html">退貨申請</a></div>
								<div class="store-goods__select">
									Arctic Blue
								</div>
								<div class="store-goods__price">
									NT$ 3,190 x 2
								</div>
							</div>
						</div>
					</div>
					<div class="store-goods">
						<div class="store-goods-box">
							<span class="store-goods__status preorder">預購品</span>
							<div class="store-goods__pic">
								<img src="img/assests/shop09.jpg" alt="">
							</div>
							<div class="pos-right">
								<div class="store-goods__name">
									iRing多功能手機固定環+iPhone 7 Plus雙層防摔插卡殼－限量版套組 珠光白
								</div>
								<div class="store-goods__shipment  status--prepare">備貨中</div>
								<div class="store-goods__select">
									Arctic Blue
								</div>
								<div class="store-goods__price">
									NT$ 3,190 x 2
								</div>
							</div>
						</div>
					</div>
					<div class="store-coupon">
						折價券折抵：NT$ 2000
					</div>
					<div class="store-discount">
						<div class="">優惠折扣</div>
						<div class="store-discount-price">$ -2,000</div>
					</div>
					<div class="store-subtotal">
						<div class="">小計</div>
						<div class="store-subtotal-price">NT$ 19,140</div>
					</div>
					<!-- 在rapaq裡購買的才有購買證明這條，一般商家不會出現↓↓ -->
					<div class="store-identify">
						購買證明
						<div class="identify-arrow">
							<span class="arrow-line1"></span>
							<span class="arrow-line2"></span>
						</div>
					</div>
					<div class="store-comment">
						<a href="member-order-comment.html">
						<div class="store-comment__btn">評價</div>
						</a>
					</div>
				</div>
				<div class="c-showall-store" id="store002">
					<div class="store-brand">
						<img src="img/assests/brandlogo.png" alt="" class="brand__logo">
						<span>bellroy2</span>
						<div class="store-brand__ask">
							<a href="member-order-ask.html"></a>
						</div>
					</div>
					<div class="store-use">
						<ul class="store-use-way">
							<li class="wayname">黑貓宅配</li>
							<li class="wayfee">$80</li>
						</ul>
						<ul class="store-use-info">
							<li class="infopeople">收件人 - 0900000000</li>
							<li class="infoaddress">11681 -台北市文山區丟汀州路四段77號</li>
						</ul>
					</div>
					<div class="store-goods">
						<div class="store-goods-box">
							<div class="store-goods__pic">
								<img src="img/assests/shop12.jpg" alt="">
							</div>
							<div class="pos-right">
								<div class="store-goods__name">
									iRing多功能手機固定環+iPhone 7 Plus雙層防摔插卡殼－限量版套組 珠光白
								</div>
								<div class="store-goods__shipment  status--returned">退貨完成</div>
								<div class="store-goods__select">
									Arctic Blue
								</div>
								<div class="store-goods__price">
									NT$ 1,190 x 2
								</div>
							</div>
						</div>
					</div>
					<div class="store-subtotal">
						<div class="">小計</div>
						<div class="store-subtotal-price">NT$ 3,380</div>
					</div>
					<div class="store-comment">
						<div class="store-comment__btn is--disable">評價</div>
						<!-- is--disable 是無法點擊的狀態 -->
					</div>
				</div>
			</div>
		</section>
		<section class="c-confirm">
			<div class="c-confirm-wrap">
				<h3>訂單資訊</h3>
				<ul class="c-confirm-list">
					<li class="c-confirm-list-recipient">
						<h5>訂購人資訊</h5>
						<span class="">訂購人姓名</span>
						<span class="">090000000</span>
						<span class="">11494 - 台北市內湖區行愛路77巷16號8樓之一</span>
					</li>
					<li class="c-confirm-list-payinfo">
						<h5>付款資訊</h5>
						<ul class="payinfo">
							<li>
								<div class="payinfo__item">購買總金額</div>
								<div class="payinfo__subtotal">$21,140</div>
							</li>
							<li>
								<div class="payinfo__item">優惠折扣</div>
								<div class="payinfo__discount">$2,000</div>
							</li>
							<li>
								<div class="payinfo__item">訂單總金額</div>
								<div class="payinfo__total">$19,140</div>
							</li>
						</ul>
					</li>
					<li class="c-confirm-list-payway">
						<h5>付款方式</h5>
						<span class="">信用卡3期0利率</span>
					</li>
					<li class="c-confirm-list-receipt">
						<h5>發票開立</h5>
						<span class="">二聯式</span>
						<span class="">訂購人姓名</span>
						<span class="">090000000</span>
						<span class="">11494 - 台北市內湖區行愛路77巷16號8樓之一</span>
					</li>
				</ul>
			</div>
		</section>
		<div class="m-dock">
			<!-- 若申貨期限7天已過，除了把「申請退貨」按鈕拿掉外，也請將double改成single↓↓ -->
			<div class="m-dock__back m-dock__back--double">
				<a href="<?= base_url() ?>member/order">返回訂單查詢</a>
			</div> 
			<div class="m-dock__back applyReturn m-dock__back--double">
				<a href="<?= base_url() ?>member/orderReject">申請退貨</a>
			</div> 
		</div>
	</div>
</div>