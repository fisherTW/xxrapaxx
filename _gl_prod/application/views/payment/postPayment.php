<link href='<?= base_url()?>assets/css/support.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>

<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_checkoutTheme_D">
<?php if($ary_result['Status'] == 'SUCCESS'): ?>
	<div class="div_checkoutRange"><img src="<?= base_url(); ?>assets/img/checkout/success.svg">
		<h3>感謝您的購買！</h3>
		<p>訂單明細請至個人頁面查詢</p>
		<button name='btn_order'>訂單查詢</button>
		<button name='btn_home' class="btn_back">返回首頁</button>
	</div>
<?php else: ?>
	<div class="div_checkoutRange"><img src="<?= base_url(); ?>assets/img/checkout/fall.svg">
		<h3>付款失敗！</h3>
		<p><?= $ary_result['Message'] ?></p>
		<button name='btn_home' class="btn_back">返回首頁</button>
	</div>
<?php endif; ?>	
	<!-- 訪客購買成功-->
<!--	
	<div class="div_checkoutRange">
		<h4>感謝您的購買！</h4>
		<h5>已將您的 E-mail 註冊為 RapaQ 會員！ </h5>
		<p class="text-left">完成註冊，您可以：<br>1. 查詢訂單明細<br>2. 收到計畫的最新訊息</p>
		<button class="btn_register">下一步，完成註冊</button>
		<button class="btn_back">返回首頁</button>
	</div>
	<div class="div_checkoutRange">
		<h4>付款失敗！</h4>
		<p>系統回傳的失敗訊息</p>
		<hr>
		<h5>已將您的 E-mail 註冊為 RapaQ 會員！ </h5>
		<p class="text-left">完成註冊，您可以：<br>1. 查詢訂單明細<br>2. 收到計畫的最新訊息</p>
		<button class="btn_register">下一步，完成註冊</button>
		<button class="btn_back">返回首頁</button>
	</div>
-->
<script type="text/javascript">
$(function () {
	$('button[name=btn_home]').bind('click', function() {
		window.location = '<?= base_url()?>';
	});
	$('button[name=btn_order]').bind('click', function() {
		window.location = '<?= base_url()?>member/order';
	});
});		
</script>