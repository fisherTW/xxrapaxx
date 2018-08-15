<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		商品列表
		<small>商品資訊</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<br>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">商品名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= $info[0]['name']?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">規格/庫存</label>
		<div class="col-sm-9">
			<?php foreach ($spec as $key => $value) {
				$spec_text = '<div class="col-sm-6">'.$value['spec_name'].'</div><div class="col-sm-3" style="text-align: right;">'.$value['quantity'].'</div><div class="col-sm-3"></div><br>';
				echo $spec_text;
			} ?>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">原價</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= $info[0]['price_origin']?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">成本</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= $info[0]['price_cost']?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">售價</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= $info[0]['price_deal']?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">幣別</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= $info[0]['currency']?>" disabled >
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">狀態</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= ($info[0]['status'] == '1')? '上架' : '下架' ?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">限購數量</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= ($info[0]['p_limit'] == '0')? '不限' : $info[0]['p_limit']?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">開賣日</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= $info[0]['dt_start']?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">閉賣日</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= $info[0]['dt_end']?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">顯示首頁-好物看看</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?= ($info[0]['is_showmain'] == '1')? '是' : '否' ?>" disabled >
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label"></label>
		<div class="col-sm-9">
			<div class="box box-default box-solid collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title">內容</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body" style="display: none;">
					<?= $info[0]['detail']?>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label"></label>
		<div class="col-sm-9">
			<div class="box box-default box-solid collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title">規格內容</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body" style="display: none;">
					<?= $info[0]['detail_spec']?>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label"></label>
		<div class="col-sm-9">
			<div class="box box-default box-solid collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title">圖片</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body" style="display: none;">
					<img src="<?= ($info[0]['url_pic'] != '')? URL_GOOGLE_IMG.$info[0]['url_pic'] : URL_GOOGLE_IMG.'new-qgoods/200x200.jpg' ?>" style="max-width:300px;max-height:300px">
					<img src="<?= ($info[0]['url_pic2'] != '')? URL_GOOGLE_IMG.$info[0]['url_pic2'] : URL_GOOGLE_IMG.'new-qgoods/200x200.jpg' ?>" style="max-width:300px;max-height:300px">
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">YOUTUBE</label>
		<div class="col-sm-9">
<?php if($info[0]['url_youtube'] != ''): ?>
			<iframe src="<?= $info[0]['url_youtube'] ?>"></iframe>
<?php else:?>
			<input type="text" class="form-control" value="無置入YOUTUBE" disabled>
<?php endif; ?>
		</div>
	</div>
</form>
</section><!-- /.content -->
<section class="content-footer">
	<div class='box-footer text-right'>
		<button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
	</div>
</section>

<script type="text/javascript">
$(function() {
	
	$('#btn_cancel').bind('click', function() {
		window.history.back();
	}); 
});
</script>