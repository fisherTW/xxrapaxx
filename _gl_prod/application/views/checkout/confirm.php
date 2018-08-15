<script src="<?= base_url() ?>assets/js/checkout_popup.js"></script>
<link href="<?= base_url() ?>assets/css/QMaker.css" rel='stylesheet' type='text/css'/>
<link href="<?= base_url() ?>assets/css/support.css" rel='stylesheet' type='text/css'/>

<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_checkoutTheme_C">
	<div class="div_checkoutHeader"><a href="javascript:void(0)">購物清單</a><span class="span_arrowRight"></span><a href="javascript:void(0)">付款方式</a><span class="span_arrowRight"></span><a class="arrive" href="javascript:void(0)">確認付款</a></div>
	<div class="div_checkout">
<?php if(count($info) > 0): ?>
<?php foreach($info as $store): ?>
		<div class="container div_checkoutBox div_checkoutBoxConfirm">
			<div class="row">
				<div class="col-xs-12 div_checkoutStore div_checkoutStoreConfirm">
					<div class="div_checkoutStoreImg"><img src='<?= URL_GOOGLE_IMG.$store['brand_logo'] ?>'></div>
					<div class="div_checkoutStoreName"><?= $store['name'] ?></div>
				</div>
<?php if(count($store['prod']) > 0): ?>
<?php foreach($store['prod'] as $prod): ?>
<?php if(strval($prod['is_delivery']) == '0'): ?>
				<div class="col-xs-12 div_checkoutProduct div_checkoutProductConfirm">
					<div class="div_checkoutProductImg"><img src='<?= URL_GOOGLE_IMG.$prod['prod_url_pic'] ?>' height='72' width='72'></div>
					<div class="div_checkoutProductMain">
						<div class="div_checkoutProductName"><?= $prod['prod_name'] ?></div>
<?php if($prod['spec_id'] != 1): ?>
						<div class="div_checkoutProductChoice">
							<div class="div_checkoutProductSpec div_checkoutProductSpecConfirm"><?= $prod['spec_name'] ?></div>
						</div>
<?php endif; ?>
					</div>
					<div class="div_checkoutSale div_checkoutSaleConfirm">
						<p>$<?= $prod['price_deal'] ?><span>x<?= $prod['quantity'] ?></span></p>
					</div>
				</div>

<?php else: ?>
				<div class="col-xs-12">
					<div class="col-xs-12 div_checkoutSent">
						<div class="div_checkoutSentTitleConfirm"><?= $prod['prod_name'] ?><span>$<?= $prod['price_deal'] ?></span></div>
					</div>
				</div>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
				<div class="col-xs-12">
					<div class="col-xs-12 div_checkoutSent">
						<div class="div_checkoutSentTitleConfirm">收件資訊</div>
						<div class="div_checkoutSentElseConfirm">
							<?= $store['order_store_rec_name'] ?>　<?= $store['order_store_rec_phone'] ?><br>
							<?= $store['order_store_rec_zip'] ?>　<?= $store['order_store_rec_addr'] ?><br>
							<?= $store['order_store_descr'] ?><br>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php endforeach; ?>
<?php endif; ?>


		<div class="container div_checkoutBox div_checkoutBoxConfirm">
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-12 div_checkoutSent div_checkoutSentConfirm">
<!-- 						<div class="div_checkoutTotalDisConfirm">折扣<span>- $120</span></div>
 -->
						<div class="div_checkoutTotalConfirm">總金額<span>$<?= $_SESSION['sess_order_amt'] ?></span></div>
					</div>
					<div class="col-xs-12 div_checkoutSent">
						<div class="div_checkoutSentTitleConfirm">付款方式</div>
						<div class="div_checkoutSentElseConfirm">信用卡一次付清</div>
					</div>
<?php if($data['orders_invoice_c_no'] != ''): ?>
					<div class="col-xs-12 div_checkoutSent">
						<div class="div_checkoutSentTitleConfirm">發票資訊</div>
						<div class="div_checkoutSentElseConfirm">公司統編：<?= $data['orders_invoice_c_no'] ?><br>發票抬頭：<?= $data['orders_invoice_c_name'] ?></div>
					</div>
<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="div_checkoutFooter div_checkoutFooterConfirm">
	<div class="container">
		<div class="row">
			<button type="button" id='btn_pay'>確認付款</button>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function () {
	$('#btn_pay').bind('click', function() {
		window.location = '<?= base_url()?>payment';
	});
});
</script>
