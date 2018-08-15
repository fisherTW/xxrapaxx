<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		訂單管理
		<small>訂單資訊及設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<input type='hidden' name='hid_order_id' value="<?= $ary_data[0]['order_id'] ?>">
	<input type='hidden' name='hid_store_id' value="<?= $ary_data[0]['store_id'] ?>">
	<br>

<div class="row">
	<!--LEFT content-->
	<div class="col-md-6">
		<!--訂單資料-->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">訂單資料</h3>
			</div>
			<div class="box-body">
				<div class="col-xs-12">
					<label>訂單號碼</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['order_id'] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>訂購時間</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['dt_create'] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>付款狀態</label>
					<input type="text" class="form-control" value="<?= $ary_payment[$ary_data[0]['status_payment']] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>寄送狀態<span style="color:#0044BB">（選擇 已出貨 即會觸發發票開立）</span></label>
					<?= form_dropdown('sel_status_send', $ary_send, $ary_data[0]['status_send'], 'class="form-control"'); ?>
				</div>
			</div>
			<div class="box-header with-border">
				<h3 class="box-title">金流資料</h3>
			</div>			
			<div class="box-body">
				<div class="col-xs-12">
					<label>交易號碼</label>
					<input type="text" class="form-control" value="<?= ($ary_data[0]['trans_id'] != '')? $ary_data[0]['trans_id']: 'no data' ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>管道</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['paymenttype'] ?>" disabled>
				</div>
			</div>
			
		</div>
		<!--訂單資料END-->
		<!--收件/配送資料-->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">收件人資料</h3>
			</div>
			<div class="box-body">
				<div class="col-xs-12">
					<label>收件人</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['rec_name'] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>電話</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['rec_phone'] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>地址</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['rec_addr'] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>訂單備註</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['descr'] ?>" disabled>
				</div>
			</div>
			<!-- <div class="box-header with-border">
				<h1 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;"><i class="fa fa-quora margin-r5"></i> 配送資訊</h1>
			</div>
			<div class="box-body">
				<div class="col-xs-12">
					<label>備註</label>
					<input type="text" class="form-control" value="" disabled>
				</div>
				<div class="col-xs-12">
					<label>物流方式</label>
					<input type="text" class="form-control" value="" disabled>
				</div>
				<div class="col-xs-12">
					<label>配送紀錄</label>
					<input type="text" class="form-control" value="" disabled>
				</div>
			</div> -->
		</div>
		<!--收件/配送資訊END-->
		<!--顧客資訊-->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">顧客資料</h3>
			</div>
			<div class="box-body">
				<div class="col-xs-12">
					<label>顧客名稱</label>
					<input type="text" class="form-control" value="<?= $user_data[0]['user_name'] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>電話</label>
					<input type="text" class="form-control" value="<?= $user_data[0]['user_phone'] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>地址</label>
					<input type="text" class="form-control" value="<?= $user_data[0]['user_addr'] ?>" disabled>
				</div>
			</div>
		</div>
		<!--顧客資訊END-->
	</div>
	<!--LEFT-->
	<!--RIGHT content-->
	<div class="col-md-6">
		<!--產品詳細-->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">產品詳情</h3>
			</div>
			<div class="box-body">
<?php $total = 0 ?>
<?php if(count($ary_data) > 0): ?>
<?php foreach ($ary_data as $val): ?>
				<div class="media">
					<div class="media-left">
<?php if($val['is_delivery'] == 0 ): ?>
						<a href="" class="ad-click-event">
<?php if($val['product_url_pic'] == ''): ?>
							<img src="<?= base_url() ?>assets/img/no_image.png" alt="Appzia" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
<?php else: ?>
							<img src="<?= URL_GOOGLE_IMG . $val['product_url_pic'] ?>" alt="Appzia" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
<?php endif; ?>
						</a>
<?php else: ?>
						<div style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);"></div>
<?php endif; ?>
					</div>
					<div class="media-body">
						<div class="clearfix">
							<h4 style="margin-top: 0"> <?= $val['product_name'] ?></h4>
							<p style="margin-bottom: 0">
								<i class="fa fa-money margin-r5"></i> 售價：<?= $val['price_deal'] ?>
							</p>
							<p style="margin-bottom: 0">
								<i class="fa fa-shopping-cart margin-r5"></i> 數量：<?= $val['quantity'] ?>
							</p>
						</div>
					</div>
				</div> 
<?php $total += $val['price_deal'] * $val['quantity']; ?>
<?php endforeach;?>
<?php endif; ?>
				<table class="table table-condensed">
					<tbody>
						<tr>
							<th>小計</th>
							<th width="100px">NT$ <?= $total ?></th>
						</tr>
						<!-- <tr>
							<th>物流費用</th>
							<th width="100px">NT$ X</th>
						</tr>
						<tr>
							<th>折價券</th>
							<th width="100px">- NT$ X</th>
						</tr> -->
						<tr>
							<th>合計</th>
                      		<th width="100px">NT$ <?= $total ?></th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!--產品詳細END-->
		<!--退款資訊-->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">退款資訊</h3>
			</div>
			<div class="box-body">
<?php if($ary_send[$ary_data[0]['status_send']] == '4'): ?>
				<div class="box box-warning collapsed-box">
					<div class="box-header with-border">
						<h3 class="box-title">Collapsable</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
						</div>
					</div>
					<div class="box-body" style="display: none;">
						The body of the box
					</div>
				</div>
<?php else: ?>
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title"> 無退款資訊</h3>
					</div>
				</div>
<?php endif; ?>
			</div>
		</div>
		<!--退款資訊END-->
		<!--發票資訊-->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">發票資訊</h3>
			</div>
			<div class="box-body">
				<div class="col-xs-12">
					<label>發票抬頭</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['invoice_c_name'] ?>" disabled>
				</div>
				<div class="col-xs-12">
					<label>統一編號</label>
					<input type="text" class="form-control" value="<?= $ary_data[0]['invoice_c_no'] ?>" disabled>
				</div>
			</div>
		</div>
		<!--發票資訊END-->
	</div>
	<!--RIGHT-->
</div>	
</form>
</section>
<section class="content-footer">
    <div class='box-footer text-right'>
        <button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
    </div>
</section>
<script type="text/javascript">
$(function() {

	$("select[name='sel_status_send']").bind("change",function(){
		$.ajax({
			cache: false,
			async : false,
			type: "POST",
			data: $('#form1').serialize(),
			url: $('#hid_baseurl').val() + 'orders/doEdit',
			statusCode: {
				200: function(e) {
					alert('寄送狀態已更新！')	;
				}
			}
		});
	});

	$('#btn_cancel').bind('click', function() {
		window.history.back();
	});

});
</script>