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
					<input type="text" id='txt_search' placeholder="請輸入訂單編號" class="m-order-search__input">
					<input type="button" value="搜尋" id='btn_search' class="m-order-search__btn">
				</div>
<!--
				<div class="m-order-select select select-wh">
				<span>三個月以內的訂單</span>
					<ul>
						<li>三個月以內的訂單</li>
						<li>三個月以上的訂單</li>
					</ul>
				</div>
-->
<?php if(count($ary_data) > 0 ): ?>
<?php foreach ($ary_data as $key => $info): ?>
				<div class="m-order-order">
					<div class="order-box">
						<!-- 帶參數 訂單號碼-->
						<input type='hidden' id='hid_order_id' value='<?= $info['order_id'] ?>'>
						<a href="<?= base_url() ?>member/orderDetail/<?= $info['order_id'] ?>">
							<ul class="order-box-list">
								<li>
									<div class="order-box__left">訂單編號</div>
									<div class="order-box__right"><?= $info['order_id'] ?></div>
								</li>
								<li>
									<div class="order-box__left">訂購日期</div>
									<div class="order-box__right"><?= $info['dt_create'] ?></div>
								</li>
								<li>
									<div class="order-box__left">訂單狀態</div>
									<div class="order-box__right order--setup"><?= $info['status_payment_name'] ?></div>
								</li>
								<li>
									<div class="order-box-price">
										<div class="order-box__right">詳細資訊</div>
									</div>
								</li>
							</ul>
							<div class="order-box-price">
								<div class="order-box__left">訂單總額</div>
								<div class="order-box__right"><?= $info['amt'] ?></div>
							</div>
						</a>
					</div>
				</div>
<?php endforeach; ?>
<?php endif; ?>				
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
$("#btn_search").click(function() {
	window.location = '<?= base_url() ?>member/orderDetail/'+$("#hid_order_id").val();
});	
</script>