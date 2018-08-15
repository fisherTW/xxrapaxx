<link href="<?= base_url() ?>assets/css/QMaker.css" rel='stylesheet' type='text/css'/>
<link href="<?= base_url() ?>assets/css/support.css" rel='stylesheet' type='text/css'/>


<input type='hidden' id='hid_baseurl' value='<?= base_url() ?>'>
<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_checkoutTheme_B">
	<div class="div_checkoutHeader"><a href="javascript:void(0)">購物清單</a><span class="span_arrowRight"></span><a class="arrive" href="javascript:void(0)">付款方式</a><span class="span_arrowRight arrive"></span><a href="javascript:void(0)">確認付款</a></div>
	<div class="div_checkout">
	<div class="container">
		<div class="row">
			<div class="checkoutBTitle">付款方式</div>
		</div>
	</div>
	<div class="container div_checkoutBox">
		<div class="row">
		<ul class="ul_checkoutPopChoice ul_checkoutChoice">
			<li>
			<div class="div_checkoutCbx">
				<input type="radio" name="rdo_payment" value="" checked="checked">
			</div>
			<label for="creditcard">信用卡一次付清</label>
			</li>		
		</ul>
		</div>
	</div>
	<div class="container">
		<div class="row">
		<div class="checkoutBTitle">發票資訊</div>
		</div>
	</div>
	<div class="container div_checkoutBox">
		<div class="row">
		<ul class="ul_checkoutPopChoice ul_checkoutChoice">
			<!-- 選取後 .ul_invoiceFadeInvoice2 fadeIn-->
			<li>
			<div class="div_checkoutCbx">
				<input type="radio" name="rdo_invoice" value="" checked="checked">
			</div>
			<label for="invoice2">不開公司統編</label>
			</li>
			<!-- 選取後 .ul_invoiceFadeInvoice3 fadeIn-->
			<li>
			<div class="div_checkoutCbx">
				<input type="radio" name="rdo_invoice" value="2">
			</div>
			<label for="invoice3">要開公司統編</label>
			</li>
		</ul>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<form id='form1'>
			<ul class="ul_invoiceFade ul_invoiceFadeInvoice3">
				<li>
					<input type="text" name='txt_invoice_c_no' placeholder="統一編號">
				</li>				
				<li>
					<input type="text" name='txt_invoice_c_name' placeholder="發票抬頭">
				</li>
			</ul>
			</form>
		</div>
	</div>
</div>
<div class="div_checkoutFooter">
	<div class="container">
	<div class="row">
		<div class="col-xs-12 div_checkoutTotal_B">
			<div class="div_checkoutTotalTitle">總金額(含運費)</div>
			<div class="div_checkoutTotalMoney">$<?= number_format($total, 0, '.' ,',') ?></div>
			<button class="btn_checkoutNext" type='button' id='btn_next'>下一步</button>
		</div>
	</div>
	</div>
</div>
<script type="text/javascript">
$('input[name=rdo_invoice]').bind('click', function() {
	if($('input[name=rdo_invoice]:checked').val() == '2' ) {
		$(".ul_invoiceFadeInvoice3").show();
	} else {
		$(".ul_invoiceFadeInvoice3").hide();
	}
});

$("#btn_next").bind("click",function() {
	$.ajax({
		async: false,
		type: "POST",
		url: $('#hid_baseurl').val() + 'checkout/orderUpdateInvoice',
		data: $('#form1').serialize(),
		statusCode: {
			200: function() {
				window.location = '<?= base_url()?>checkout/confirm';
			}
		},
		error: function() {
			alert('操作失敗');
		}
	});
});
</script>