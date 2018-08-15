<script src="<?= base_url() ?>assets/js/checkout_popup.js"></script>
<link href="<?= base_url() ?>assets/css/QMaker.css" rel='stylesheet' type='text/css'/>
<link href="<?= base_url() ?>assets/css/support.css" rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/validation.css' rel='stylesheet' type='text/css'/>

<input type='hidden' id='hid_baseurl' value='<?= base_url() ?>'>
<input type='hidden' id='hid_json_delivery' value='<?= $json_delivery ?>'>
<form id='form'>
	<div class="div_mask"></div>
	<div class="div_maskForSearch"></div>
	<div class="div_checkoutTheme">
		<div class="div_checkoutHeader"><a class="arrive" href="javascript:void(0)">購物清單</a><span class="span_arrowRight arrive"></span><a href="javascript:void(0)">付款方式</a><span class="span_arrowRight"></span><a href="javascript:void(0)">確認付款</a></div>
		<div class="div_checkout">
			<div class="container">
				<div class="row">
<?php if(count($ary_cart) > 0): ?>
<?php if(!isset($_SESSION['sess_user_id'])): ?>
					<div class="col-xs-12 div_checkoutWording">您目前為訪客身份</a></div>
<?php else: ?>
					<div class="col-xs-12 div_checkoutWording"></div>
<?php endif; ?>
<?php else: ?>
					<div class="col-xs-12 div_checkoutWording">目前無購物清單</div>
<?php endif; ?>
				</div>
			</div>
<?php if(count($ary_cart) > 0): ?>
<?php foreach($ary_cart as $key => $cart): ?>
			<div class="container div_checkoutBox" name="div_store" store_id='<?= $cart[key($cart)]["store_id"] ?>'>
				<div class="row">
					<div class="col-xs-12 div_checkoutStore">
						<div class="div_checkoutStoreImg"><img src="<?= URL_GOOGLE_IMG.$cart[key($cart)]['brand_logo'] ?>"></div>
						<div class="div_checkoutStoreName"><?= $cart[key($cart)]['store_name'] ?></div>
						<div class="div_checkoutCbx">
							<input class="cbx_" type="checkbox" name='cbx_store' store_id='<?= $cart[key($cart)]["store_id"] ?>'>
						</div>
						<div class="div_checkoutFunction">
<!-- 之後補刪除
							<button class="btn_checkoutDelete" enabled>刪除</button>
-->
<!--discount 未處理	
							<span>|</span><a class="a_checkoutCoupon" href="javascript:void(0)">領取折價券</a>
-->
						</div>
					</div>
<?php foreach($cart as $prod): ?>
 					<div class="col-xs-12 div_checkoutProduct">
						<div class="div_checkoutProductImg" <?= $prod['is_delivery'] == 1 ? 'style="display:none"' : '' ?>><img src="<?= URL_GOOGLE_IMG.$prod['product_pic'] ?>" height='72' width='72'></div>
						<div class="div_checkoutProductMain">
							<div class="div_checkoutProductName" name='div_checkoutProductName' store_id='<?= $prod["store_id"] ?>' is_delivery='<?= $prod["is_delivery"]?>'><?= $prod["product_name"] ?></div>
							<div class="div_checkoutProductChoice" <?= $prod['is_delivery'] == 1 ? 'style="display:none"' : '' ?>>
								<div class="div_checkoutProductQuantity">
									<a class="a_minus" store_id='<?= $prod["store_id"] ?>' prod_id='<?= $prod["product_id"] ?>' spec_id='<?= $prod["spec_id"] ?>'></a>
									<input class="txt_quantity" type="text" value='<?= $prod["quantity"] ?>' name='txt_quantity' is_children=1	store_id='<?= $prod["store_id"] ?>' prod_id='<?= $prod["product_id"] ?>' spec_id='<?= $prod["spec_id"] ?>'/>
									<a class="a_add" store_id='<?= $prod["store_id"] ?>' prod_id='<?= $prod["product_id"] ?>' spec_id='<?= $prod["spec_id"] ?>'></a>
								</div>
<?php if($prod['source'] == SOURCE_QGOODS): ?>
								<div class="div_checkoutProductSpec"><?= $prod['spec_name'] ?></div>
<?php endif; ?>
							</div>
						</div>
						<div class="div_checkoutCbx" <?= $prod['is_delivery'] == 1 ? 'style="display:none"' : '' ?>>
							<input class="cbx_" type="checkbox" name='cbx_product' is_children=1 store_id='<?= $prod["store_id"] ?>' prod_id='<?= $prod['product_id'] ?>' amount=0 quantity='<?= $prod["quantity"] ?>' price_deal='<?= $prod["price_deal"] ?>' is_delivery='<?= $prod["is_delivery"]?>' source='<?= $prod["source"] ?>' spec_id='<?= $prod["spec_id"] ?>'>
							<input type='hidden' name='hid_product_id' value='<?= $prod["product_id"] ?>' store_id='<?= $prod["store_id"] ?>' is_delivery='<?= $prod["is_delivery"]?>'>
						</div>
						<div class="div_checkoutSale" name='div_checkoutSale' store_id='<?= $prod["store_id"] ?>' is_delivery='<?= $prod["is_delivery"]?>'>
							<p>$ <?= number_format($prod['price_deal'], 0, '.' ,',') ?></p>
						</div>
					</div>
<?php endforeach; ?>
<!--discount 未處理	
					<div class="col-xs-12 div_checkoutStoreActive">
						<div class="row">
							<div class="col-xs-6">全店滿千免運</div>
							<div class="col-xs-6 text-right">- $60</div>
						</div>
					</div>
-->
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="col-xs-12 div_checkoutSent div_checkoutSentConfirm">
							<div class="div_checkoutSentTitle">寄送地址</div>
							<div class="div_checkoutSentElse">
								<input type='hidden' name='hid_sendName' store_id='<?= $cart[key($cart)]["store_id"] ?>'>
								<input type='hidden' name='hid_sendPhone' store_id='<?= $cart[key($cart)]["store_id"] ?>'>
								<input type='hidden' name='hid_sendZip' store_id='<?= $cart[key($cart)]["store_id"] ?>'>
								<input type='hidden' name='hid_sendAddr' store_id='<?= $cart[key($cart)]["store_id"] ?>'>
								<input type='hidden' name='hid_sendMail' store_id='<?= $cart[key($cart)]["store_id"] ?>'>
								<input type='hidden' id='hid_modal_now_store_id'>
								<input type='hidden' id='hid_modal_now_delivery'>
								<button type='button' class="btn_checkoutSentChoice btn_checkoutDefault" store_id='<?= $cart[key($cart)]["store_id"] ?>'>請填寫</button>
								<div class="div_checkoutSentPlace" name='add_addr' store_id='<?= $cart[key($cart)]["store_id"] ?>'></div>
							</div>
						</div>
						<div class="col-xs-12 div_checkoutSent">
							<div class="div_checkoutSentTitle">備註</div>
							<div class="div_checkoutSentElse">
								<input class="txt_checkoutDefault" type="text" placeholder="請留言" name='txt_descr' store_id='<?= $cart[key($cart)]["store_id"] ?>'>
							</div>
						</div>
					</div>
				</div>				
			</div>
<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
	<div class="div_checkoutFooter">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_checkoutTotal">
					<ul>
						<li class="li_checkoutTotalCbx">
							<input id="cbx_all" type="checkbox">
							<label for="choiceAll">選擇全部</label>
						</li>
						<li class="li_checkoutTotalAll">總金額<span name='total_amount' id='total_amount'></span></li>
						<input type='hidden' id='hid_total' name='hid_total'>						
					</ul>
					<div class="div_checkoutTotalBtn">
						<button type='button' onclick="location.href='<?= base_url() ?>qmaker'">逛逛</button>
						<div id='div_pay'>
							<button type='button' id='btn_pay' disabled>結帳</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>


<!-- 結帳頁面Mask-->
<div class="div_maskCheckout"></div>
<!-- 移除商品Pop-->
<div class="div_checkoutPopDelete">
	<h3>移除商品</h3>
	<p>您確定要從購物車移除此商品嗎？</p>
	<button class="btn_popCancel">取消</button>
	<button class="btn_popDelete">移除</button>
</div>

<!-- 寄送資訊Pop-->
<div class="div_checkoutPopBox">
	<!-- 寄送方式選擇-->
	<div class="div_" style="display:block;">		
 		<div class="div_checkoutPopTitle">寄送資訊</div>
		<div class="div_checkoutPopHasBtn">			
			<form id='model_form'>
				<ul class="ul_checkoutPopChoice">
					<div id='hid_model_form_now_store_id'></div>
				</ul>
				<!-- 2538在qmaker.css 是style='display: none;' 寫qgoods時判斷用-->
				<ul class="ul_checkoutPopFade vrf">
<?php if(isset($_SESSION['sess_user_id'])): ?>
					<li>選擇常用地址
						<select class="form-control" id="sel_addr">
<?php foreach($ary_addr as $val): ?>
<?php if($val['id'] == '-1'): ?>
							<option value='<?= $val["id"] ?>' name='<?= $val["rec_name"] ?>'><?= $val['name'] ?></option>
<?php else: ?>
							<option value='<?= $val["id"] ?>' name='<?= $val["rec_name"] ?>' rec_phone='<?= $val["rec_phone"] ?>' zip='<?= $val["zip"] ?>' rec_addr='<?= $val["rec_addr"] ?>'><?= $val['name'] ?></option>
<?php endif; ?>
<?php endforeach; ?>
						</select>
					</li>
<?php endif; ?>
					<li>
						<input type="text" name='txt_sendName' placeholder="收件人姓名／公司名稱" required>
					</li>
					<li>
						<input type="text" name='txt_sendPhone' placeholder="聯絡電話" required>
					</li>
					<li>
						<input type="text" name='txt_sendZip' placeholder="郵遞區號" required>
					</li>
					<li>
						<input type="text" name='txt_sendAddr' placeholder="地址" required>
					</li>
					<li>
						<input type="email" name='txt_sendMail' placeholder="E-mail" required>
					</li>
				</ul>
			</form>
		</div>
		<button class="btn_sentTotal" id='btn_sendData'>確定</button>
	</div>
</div>

<script type="text/javascript">
$(function () {
	$('#cbx_all').trigger('click');

	var obj = JSON.parse($('#hid_json_delivery').val());

	//寄送選擇POPUP
	$( '.btn_checkoutSentChoice' ).click(function() {
		$('.div_maskCheckout').addClass('div_maskCheckout--show');
		$('.div_checkoutPopBox').addClass('div_checkoutPopBox--show');
		$('#hid_modal_now_store_id').val($(this).attr('store_id'));

		var html = '';
		var store_id = $(this).attr('store_id');
		var ary_deliver = obj[$(this).attr('store_id')];
		var deliver_row = 1;
		$.each(ary_deliver, function( key, value ) {
			html += '<li>';
 			html += '<div class="div_checkoutCbx">';

 			if($('input[name="hid_sendName"][store_id=' + store_id + ']').val().length > 0) {
 				if($('input[name="hid_product_id"][store_id=' + store_id + '][is_delivery=1]').val() == ary_deliver[key]['id']) {
					html += '<input type="radio" name="txt_delivery" value="' + ary_deliver[key]['id'] + '" prod_name="' + ary_deliver[key]['name'] + '" price_deal="' + ary_deliver[key]['price_deal'] + '" checked="checked">';
 				} else {
					html += '<input type="radio" name="txt_delivery" value="' + ary_deliver[key]['id'] + '" prod_name="' + ary_deliver[key]['name'] + '" price_deal="' + ary_deliver[key]['price_deal'] + '">';
 				}
 			} else {
				if(deliver_row == 1) {
					html += '<input type="radio" name="txt_delivery" value="' + ary_deliver[key]['id'] + '" prod_name="' + ary_deliver[key]['name'] + '" price_deal="' + ary_deliver[key]['price_deal'] + '" checked="checked">';
				} else {
					html += '<input type="radio" name="txt_delivery" value="' + ary_deliver[key]['id'] + '" prod_name="' + ary_deliver[key]['name'] + '" price_deal="' + ary_deliver[key]['price_deal'] + '">';
				} 				
 			}
			html += '</div>';
			html += '<label for="delivery">' + ary_deliver[key]['name'] + '<span>$ ' + ary_deliver[key]['price_deal'] + '</span></label>';
			html += '</li>';
			deliver_row ++ ;
		});

		$('#hid_model_form_now_store_id').html(html);
	});

});

$('#sel_addr').change(function(){
	var sel_addr = $("#sel_addr").find("option:selected");
	$('input[name=txt_sendName]').val(sel_addr.attr('name'));
	$('input[name=txt_sendPhone]').val(sel_addr.attr('rec_phone'));
	$('input[name=txt_sendZip]').val(sel_addr.attr('zip'));
	$('input[name=txt_sendAddr]').val(sel_addr.attr('rec_addr'));
});

$('#btn_sendData').bind('click', function(){
	if(!$('#model_form')[0].checkValidity()) return;

	$('input[name=hid_sendName][store_id='+$("#hid_modal_now_store_id").val()+']').val($('input[name=txt_sendName]').val());
	$('input[name=hid_sendPhone][store_id='+$("#hid_modal_now_store_id").val()+']').val($('input[name=txt_sendPhone]').val());
	$('input[name=hid_sendZip][store_id='+$("#hid_modal_now_store_id").val()+']').val($('input[name=txt_sendZip]').val());
	$('input[name=hid_sendAddr][store_id='+$("#hid_modal_now_store_id").val()+']').val($('input[name=txt_sendAddr]').val());
	$('input[name=hid_sendMail][store_id='+$("#hid_modal_now_store_id").val()+']').val($('input[name=txt_sendMail]').val());
	$('input[name="hid_product_id"][store_id=' + $("#hid_modal_now_store_id").val() + '][is_delivery=1]').val($('input[name=txt_delivery]:checked').val());

	$('div[name=add_addr][store_id='+$('#hid_modal_now_store_id').val()+']').html($('input[name=txt_sendAddr]').val());
	//update delivery
	var obj_chk_delivery = $('input[name=cbx_product][store_id='+$("#hid_modal_now_store_id").val()+'][is_delivery=1]');
	$(obj_chk_delivery).attr('prod_id', $('input[name=txt_delivery]:checked').val());
	$(obj_chk_delivery).attr('price_deal', $('input[name=txt_delivery]:checked').attr('price_deal'));
	$(obj_chk_delivery).attr('amount', $('input[name=txt_delivery]:checked').attr('price_deal'));
	$('div[name=div_checkoutProductName][store_id='+$("#hid_modal_now_store_id").val()+'][is_delivery=1]').html($('input[name=txt_delivery]:checked').attr('prod_name'));
	$('div[name=div_checkoutSale][store_id='+$("#hid_modal_now_store_id").val()+'][is_delivery=1]').html('<p>$ '+$('input[name=txt_delivery]:checked').attr('price_deal')+'</p>');
	$('#hid_modal_now_delivery').val($('input[name=txt_delivery]:checked').val());

	total_amount();

	$('.div_checkoutPopBox').removeClass('div_checkoutPopBox--show');
	$('.div_checkoutPopCoupon').removeClass('div_checkoutPopCoupon--show');
	$('.div_maskCheckout').removeClass('div_maskCheckout--show');

//	$('.div_closePop').trigger('click');
});

//勾選(取消勾選)全部
$('#cbx_all').change(function(){
	var obj_chk = $('input[type=checkbox]');
	if($(this).is(':checked')){
		obj_chk.prop('checked', true);
		checkAmount(0, $(this).attr("prod_id"), 1, $(this).attr("spec_id"));		
	} else { 
		obj_chk.prop('checked', false);
		checkAmount(0, $(this).attr("prod_id"), 0, $(this).attr("spec_id"));
	}
});

//勾選(取消勾選)店鋪，同步勾選(取消勾選)商品
$('input[name="cbx_store"]').change(function(){
	var obj_chk = $('input[type=checkbox][store_id='+$(this).attr("store_id")+']');
	if($(this).is(':checked')){
		obj_chk.prop('checked', true);
		checkAmount($(this).attr("store_id"), $(this).attr("prod_id"), 1, 0);
		$('div[name=div_fee][store_id='+$(this).attr("store_id")+']').css('display', '')
	} else { 
		obj_chk.prop('checked', false);
		checkAmount($(this).attr("store_id"), $(this).attr("prod_id"), 0, 0);
		$('div[name=div_fee][store_id='+$(this).attr("store_id")+']').css('display', 'none')
	}
	total_amount();
});

//重算所有產品的amount
function checkAmount($store_id, $prod_id, $is_check, $spec_id) {
	if($store_id == 0) {
		if($is_check == 0) {
			$('input[type=checkbox][is_children=1]').each(function() {
				$(this).attr('amount',	0);
				$('input[name="cbx_product"][is_children=1][store_id='+ $store_id +'][prod_id='+ $prod_id +'][spec_id='+ $spec_id +']').val(0);
			});
		} else {
			$('input[type=checkbox][is_children=1]').each(function() {
				$(this).attr('amount', $(this).attr('price_deal') * $(this).attr('quantity'));
			});
		}
	} else {
		if($is_check == 0) {
			$('input[type=checkbox][is_children=1][store_id='+$store_id+']').each(function() {
				$(this).attr('amount',	0);
				$('input[name="cbx_product"][is_children=1][store_id='+ $store_id +'][prod_id='+ $prod_id +'][spec_id='+ $spec_id +']').val(0);
			});
		} else {
			$('input[type=checkbox][is_children=1][store_id='+$store_id+']').each(function() {
				$(this).attr('amount', $(this).attr('price_deal') * $(this).attr('quantity'));
			});
		}
	}
	total_amount();
}

//修改數量
$('input[name="txt_quantity"]').bind('keyup', function onKeyupQuantity() {
	var obj_chk = $('input[type=checkbox][is_children=1][store_id='+$(this).attr("store_id")+'][prod_id='+$(this).attr("prod_id")+'][spec_id='+$(this).attr("spec_id")+']');

	$quantity = $('input[name="txt_quantity"][store_id='+$(this).attr("store_id")+'][prod_id='+$(this).attr("prod_id")+'][spec_id='+$(this).attr("spec_id")+']').val();
	obj_chk.attr('quantity', $quantity);
	if(obj_chk.is(':checked')){
		obj_chk.attr('amount', obj_chk.attr('price_deal') * parseFloat($quantity));
		total_amount();
	}
});


$('.a_add').click(function(){
	var obj_chk = $('input[name="txt_quantity"][store_id='+$(this).attr("store_id")+'][prod_id='+$(this).attr("prod_id")+'][spec_id='+$(this).attr("spec_id")+']');
	var num = parseFloat(obj_chk.val());
	num++;
	obj_chk.val(num);

	$('input[name="txt_quantity"]').trigger('keyup');
});

$('.a_minus').click(function(){
	var obj_chk = $('input[name="txt_quantity"][store_id='+$(this).attr("store_id")+'][prod_id='+$(this).attr("prod_id")+'][spec_id='+$(this).attr("spec_id")+']');
	var num = parseFloat(obj_chk.val());
	if(num >0){
		if(num==1) { 
			num--;
			obj_chk.val(1);
		} else {
			num--;
			obj_chk.val(num);
		}
	}

	$('input[name="txt_quantity"]').trigger('keyup');
});


//勾選(取消勾選)單項商品
$('input[name="cbx_product"][is_children=1]').bind('click', function(){
	if($(this).is(':checked')){
		//只要有商品，就要運費
		var obj_cbx_delivery = $('input[name=cbx_product][is_delivery=1][store_id='+$(this).attr("store_id")+']');
		obj_cbx_delivery.prop('checked', true);
		obj_cbx_delivery.attr('amount', parseFloat(obj_cbx_delivery.attr('price_deal')) * parseFloat(obj_cbx_delivery.attr('quantity')));
		$('div[name=div_fee][store_id='+$(this).attr("store_id")+']').css('display', '')

		checkAmountByProduct($(this).attr("store_id"), $(this).attr("price_deal"), $('input[name="txt_quantity"][store_id='+$(this).attr("store_id")+'][prod_id='+$(this).attr("prod_id")+'][spec_id='+$(this).attr("spec_id")+']').val(), $(this).attr("prod_id"), $(this).attr("spec_id"));
	} else {
		//若店下完全無商品，就不要運費
		if($('input[name=cbx_product][store_id='+$(this).attr("store_id")+'][is_delivery=0]:checked').length == 0) {
			var obj_cbx_delivery = $('input[name=cbx_product][is_delivery=1][store_id='+$(this).attr("store_id")+']');
			obj_cbx_delivery.prop('checked', false);
			obj_cbx_delivery.attr('amount', 0);
			// uncheck store
			$('input[name=cbx_store][store_id='+$(this).attr("store_id")+']').prop('checked', false);
			$('div[name=div_fee][store_id='+$(this).attr("store_id")+']').css('display', 'none')
		}

		checkAmountByProduct($(this).attr("store_id"), $(this).attr("price_deal"), '0', $(this).attr("prod_id"), $(this).attr("spec_id"));
	}
});

//重算單項產品的amount
function checkAmountByProduct($store_id, $price_deal, $quantity, $prod_id, $spec_id) {
	$('input[type=checkbox][store_id='+$store_id+'][is_children=1][prod_id='+ $prod_id +'][spec_id='+ $spec_id +']').attr('amount', parseFloat($price_deal) * parseFloat($quantity));
	total_amount();
}

//計算總金額
function total_amount() {
	$total = 0;
	var obj_chk = $('input[type=checkbox][is_children=1]');
	var is_checked = isCheckRequired();
	obj_chk.each(function() { 
		if(obj_chk.is(':checked')){
			$total += parseFloat($(this).attr('amount'));
		}
	});

	$('#total_amount').text($total);
	$('#total_amount').val($total);
	$('#hid_total').val($total);
	if(
		($total > 0) && (is_checked)
		
	) {
		$('#btn_pay').removeAttr('disabled');
	} else {
		$('#btn_pay').attr('disabled','disabled');
	}
}


// check if all required data is filled
function isCheckRequired() {
	var ret = true;
	$.each($('input[name="hid_sendName"]'), function() {
		var store_id = $(this).attr('store_id');
		var valx = $(this).val();
		if($('input[type=checkbox][name=cbx_store][store_id=' + store_id + ']').is(':checked')) {
			if(valx.length == 0) {
				ret = false;
				return false;
			}
		}
	});

	return ret;
}

$("#btn_pay").bind("click",function(){

	var ary_prod_id = [];
	$('input[name=cbx_product][is_children=1]').each(function() {
		if($(this).is(':checked')){
			ary_prod_id.push({
				prod_id : $(this).attr('prod_id'), 
				quantity : $(this).attr('quantity'),
				store_id : $(this).attr('store_id'),
				source : $(this).attr('source'),
				spec_id : $(this).attr('spec_id'),
				is_delivery : $(this).attr('is_delivery'),
				hid_sendName : $('input[name="hid_sendName"][store_id='+$(this).attr('store_id')+']').val(),
				hid_sendPhone : $('input[name="hid_sendPhone"][store_id='+$(this).attr('store_id')+']').val(),
				hid_sendZip : $('input[name="hid_sendZip"][store_id='+$(this).attr('store_id')+']').val(),
				hid_sendAddr : $('input[name="hid_sendAddr"][store_id='+$(this).attr('store_id')+']').val(),
				hid_sendMail : $('input[name="hid_sendMail"][store_id='+$(this).attr('store_id')+']').val(),
				txt_descr : $('input[name="txt_descr"][store_id='+$(this).attr('store_id')+']').val()
			});
		}
	});

	$.ajax({
		async: false,
		type: "POST",
		url: $('#hid_baseurl').val() + 'checkout/list_doEdit',
		data: { ary_prod_id : ary_prod_id },
		statusCode: {
			200: function() {
				window.location = '<?= base_url()?>checkout/payMethod';
			}
		},
		error: function() {
			alert('操作失敗');
		}
	});
});

</script>