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
			<h4><span><?= $data['order_id'] ?></span>詳情</h4>
		</header>
		<section class="m-orderDetail">
			<div class="m-order-wrap">
				<ul class="m-orderDetail-top">
					<li>
						<div class="order-box__left">訂購日期</div>
						<div class="order-box__right"><?= $data['dt_create'] ?></div>
					</li>
					<li>
						<div class="order-box__left">訂單狀態</div>
						<div class="order-box__right status--notpay"><?= $data['status_payment_name'] ?></div>
					</li>
				</ul>
			</div>
		</section>
		<section class="c-showall">
			<div class="c-showall-wrap">
				<h3>商品明細</h3>
<?php if(count($ary_data) > 0 ): ?>
<?php foreach ($ary_data as $key => $store): ?>
				<div class="c-showall-store" id="<?= $store["store_id"] ?>">
					<div class="store-brand">
						<img src="<?= URL_GOOGLE_IMG.$store['brand_logo'] ?>" alt="" class="brand__logo">
						<span><?= $store['name'] ?></span>
<!--貨運狀態 status_send
 								<div class="store-goods__shipment status--ship"></div>

qgoods use
-->

<?php if( ($data['status_payment'] == PAYMENT_SUCCESS) 
	&& ($store['order_store_ary']['status_send'] == SEND_STATUS_GET) 
	&& ($store['order_store_ary']['log_refund_id'] == 0) 
	&& (strlen($store['order_store_ary']['dt_send']) > 0) ): ?>
<?php if(  strtotime(date("Y-m-d H:i:s", strtotime($store['order_store_ary']['dt_send'])). ' + 10 day') > time()   ): ?>
						<div class="store-brand__ask">
							<a order_id='<?= $data['order_id'] ?>' store_id='<?= $store["store_id"] ?>' name='a_refund'>退貨</a>
						</div>
<?php endif; ?>						
<?php endif; ?>						
					</div>
<?php if(count($store['prod']) > 0): ?>
<?php foreach($store['prod'] as $prod): ?>
					<div class="store-goods">
						<div class="store-goods-box">
<?php if($prod['is_delivery'] == 0): ?>
							<div class="store-goods__pic">
								<img src="<?= URL_GOOGLE_IMG.$prod['prod_url_pic'] ?>" alt="">
							</div>
							<div class="pos-right">
								<div class="store-goods__name"><?= $prod['prod_name'] ?></div>
 								<div class="store-goods__select"><?= $prod['spec_name'] ?></div>
								<div class="store-goods__price">$ <?= $prod['price_deal'] ?> x <?= $prod['quantity'] ?></div>
							</div>
<?php else: ?>
							<div class="pos-right">
								<div class="store-goods__name"><?= $prod['prod_name'] ?></div>
								<div class="store-goods__price">$ <?= $prod['price_deal'] ?></div>
							</div>
<?php endif; ?>
						</div>
					</div>
<?php endforeach; ?>
<?php endif; ?>
					<div class="store-subtotal">
						<div class="">小計</div>
						<div class="store-subtotal-price">$ <?= number_format($store['order_store_amt'], 0, '.' ,',') ?></div>
					</div>				
<!-- 
					<div class="store-comment">
						<a href="member-order-comment.html">
						<div class="store-comment__btn">評價</div>
						</a>
					</div>
-->
				</div>
<?php endforeach; ?>
<?php endif; ?>
			</div>
		</section>
		<section class="c-confirm">
			<div class="c-confirm-wrap">
				<h3>訂單資訊</h3>
				<ul class="c-confirm-list">
					<li class="c-confirm-list-recipient">
						<h5>訂購人資訊</h5>
<?php if(count($ary_data) > 0 ): ?>
<?php foreach ($ary_data as $key => $store): ?>
						<span class=""><?= $store['name'] ?></span>
						<span class=""><?= $store['order_store_rec_name'] ?></span>
						<span class=""><?= $store['order_store_rec_phone'] ?></span>
						<span class=""><?= $store['order_store_rec_zip'] ?> - <?= $store['order_store_rec_addr'] ?></span>
						<br>
<?php endforeach; ?>
<?php endif; ?>
					</li>
					<li class="c-confirm-list-payinfo">
						<h5>付款資訊</h5>
						<ul class="payinfo">
<!-- 
							<li>
								<div class="payinfo__item">購買總金額</div>
								<div class="payinfo__subtotal">$21,140</div>
							</li>
							<li>
								<div class="payinfo__item">優惠折扣</div>
								<div class="payinfo__discount">$2,000</div>
							</li> 
-->
							<li>
								<div class="payinfo__item">訂單總金額</div>
								<div class="payinfo__total">$ <?= number_format($data['amt'], 0, '.' ,',') ?></div>
							</li>
						</ul>
					</li>
					<li class="c-confirm-list-payway">
						<h5>付款方式</h5>
						<span class="">信用卡一次付清</span>
					</li>
<?php if($data['orders_invoice_c_no'] != ''): ?>
					<li class="c-confirm-list-receipt">
						<h5>發票開立</h5>
						<span class="">公司統編 - <?= $data['orders_invoice_c_no'] ?></span>
						<span class="">發票抬頭 - <?= $data['orders_invoice_c_name'] ?></span>
					</li>
<?php endif; ?>
				</ul>
			</div>
		</section>
		<div class="m-dock">
			<!-- 若申貨期限7天已過，除了把「申請退貨」按鈕拿掉外，也請將double改成single↓↓ -->
			<div class="m-dock__back m-dock__back--double">
				<a href="<?= base_url() ?>member/order">返回訂單查詢</a>
			</div>
<!-- 
			<div class="m-dock__back applyReturn m-dock__back--double">
				<a href="<?= base_url() ?>member/orderReject">申請退貨</a>
			</div>
 -->
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('a[name=a_refund]').bind('click', function() {
		if(confirm('確定退貨？')) {
			$.ajax({
				async: false,
				type: "POST",
				url: '<?= base_url()?>member/doRefund',
				data: { 
					store_id : $(this).attr('store_id'),
					order_id : $(this).attr('order_id')
				},
				statusCode: {
					200: function() {
						alert('已通知店舖進行退貨程序');
						location.reload();
					}
				},
				error: function() {
					alert('Failure!');
				}
			});

		}
	});
});	
</script>