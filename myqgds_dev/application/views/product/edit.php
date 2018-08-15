<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" type="text/javascript"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>
<section class="content-header">
<?php if(strval($id) == 0): ?>
	<h1>新增商品</h1>
<?php else: ?>
	<h1>修改商品</h1>
<?php endif; ?>
</section>
<section class="content">
<form id='form1'>
<div class='nav-tabs-custom'>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#step_1" data-toggle="tab" aria-expanded="true">商品資訊</a></li>	
		<li class=""><a href="#step_2" data-toggle="tab" aria-expanded="false">商品圖片</a></li>
		<li class=""><a href="#step_3" data-toggle="tab" aria-expanded="false">詳情</a></li>
		<li class=""><a href="#step_4" data-toggle="tab" aria-expanded="false">規格</a></li>
		<li class=""><a href="#step_5" data-toggle="tab" aria-expanded="false">價格/數量</a></li>
		<li class=""><a href="#step_6" data-toggle="tab" aria-expanded="false">尺寸規格/庫存</a></li>
		<li class=""><a href="#step_7" data-toggle="tab" aria-expanded="false">店鋪商品分類</a></li>
		<li class=""><a href="#step_8" data-toggle="tab" aria-expanded="false">網路搜尋最佳化</a></li>
	</ul>
	<div class='tab-content'>
		<div class="tab-pane active form-horizontal" id="step_1">
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal">
					<br>
					<input type='hidden' name='hid_id' value='<?= $id ?>'>

					<div class="form-group">
						<label class="col-sm-1 control-label">商品名稱</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<input type="text" class="form-control" name="txt_name" value='' required/>
<?php else: ?>
							<input type="text" class="form-control" name="txt_name" value='<?= $data['name']?>' required/>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品主分類</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<?= form_dropdown('sel_category', $ary_category, '', 'class="form-control"'); ?>
<?php else: ?>
							<?= form_dropdown('sel_category', $ary_category, $data['category_id'], 'class="form-control"'); ?>
<?php endif; ?>							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品次分類</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<?= form_dropdown('sel_category_son', $ary_category_son, '', 'class="form-control"'); ?>
<?php else: ?>
							<?= form_dropdown('sel_category_son', $ary_category_son, $data['category_son_id'], 'class="form-control"'); ?>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品類型</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<?= form_dropdown('sel_is_prebuy', $ary_is_prebuy, '', 'class="form-control"'); ?>
<?php else: ?>
							<?= form_dropdown('sel_is_prebuy', $ary_is_prebuy, $data['is_prebuy'], 'class="form-control"'); ?>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品品牌</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<?= form_dropdown('sel_brand_id', $ary_brand, '', 'class="form-control"'); ?>
<?php else: ?>
							<?= form_dropdown('sel_brand_id', $ary_brand, $data['brand_id'], 'class="form-control"'); ?>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">18禁商品</label>
						<div class="col-sm-11">
							<div class='checkbox'>
<?php if(strval($id) == 0): ?>
								<input type="radio" name="rdo_is_18" value=1 > 是　
								<input type="radio" name="rdo_is_18" value=0 checked="checked"> 否　
<?php else: ?>
								<input type="radio" name="rdo_is_18" value=1 <?= $data['is_18'] == 1 ? 'checked' : '' ?>> 是　
								<input type="radio" name="rdo_is_18" value=0 <?= $data['is_18'] == 0 ? 'checked' : '' ?>> 否　
<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">折價券使用</label>
						<div class="col-sm-11">
							<div class='checkbox'>
<?php if(strval($id) == 0): ?>
								<input type="radio" name="rdo_is_coupon" value=1> 可使用折價券　
								<input type="radio" name="rdo_is_coupon" value=0 checked='checked'> 不可使用折價券　
<?php else: ?>
								<input type="radio" name="rdo_is_coupon" value=1 <?= $data['is_couponable'] == 1 ? 'checked' : '' ?>> 可使用折價券　
								<input type="radio" name="rdo_is_coupon" value=0 <?= $data['is_couponable'] == 0 ? 'checked' : '' ?>> 不可使用折價券　
<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">上下架時間</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<input class="form-control daterange" type="text" name="txt_start_end_date" value="" readonly />			
<?php else: ?>
							<input class="form-control daterange" type="text" name="txt_start_end_date" value="<?= $data['start_end_date'] ?>" readonly />			
<?php endif; ?>
						</div>
					</div>
<?php if($is_direct['is_direct'] == 1): ?>					
					<div class="form-group">
						<label class="col-sm-1 control-label">產品負責人</label>
						<div class="col-sm-11">
							<div class='input-group'>
<?php if(strval($id) == 0): ?>
								<input type="text" class="form-control" id="txt_pm_id" name="txt_pm_id" value="" disabled>
								<input type="hidden" name='hid_pm_id' id="hid_pm_id" value="">
<?php else: ?>
								<input type="text" class="form-control" id="txt_pm_id" name="txt_pm_id" value="<?= $data['pm_name'] ?>" disabled>
								<input type="hidden" name='hid_pm_id' id="hid_pm_id" value="<?= $data['pm_id'] ?>">
<?php endif; ?>
							<div class="input-group-btn">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user_search" > Search...</button>
							</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">供應商</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<?= form_dropdown('sel_supplier_id', $ary_supplier, '', 'class="form-control"'); ?>
<?php else: ?>
							<?= form_dropdown('sel_supplier_id', $ary_supplier, $data['supplier_id'], 'class="form-control"'); ?>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品毛利率(%)</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<input type="text" class="form-control" name="txt_profit" value='' pattern="^(0|[1-9]\d*)(\.\d{1})?$" required>
<?php else: ?>
							<input type="text" class="form-control" name="txt_profit" value='<?= $data['profit']?>' pattern="^(0|[1-9]\d*)(\.\d{1})?$" required>
<?php endif; ?>
						</div>
					</div>
<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="step_2">
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal">
					<br>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品圖片</label>
						<div class="col-sm-11">
							<span style="color:#0044BB">上傳圖片尺寸 1440 X 960（請記得按圖片裡的上傳檔案功能鍵）</span>
							<input id="file" type="file" class="file-loading">
<?php if(strval($id) == 0): ?>
							<input type='hidden' name='hid_filepath' value=''>
							<input type='hidden' name='hid_filepath_old' value=''>
<?php else: ?>
							<input type='hidden' name='hid_filepath' value='<?= $data['url_pic']?>'>
							<input type='hidden' name='hid_filepath_old' value='<?= $data['url_pic']?>'>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品圖片2</label>
						<div class="col-sm-11">
							<span style="color:#0044BB">上傳圖片尺寸 1440 X 960（請記得按圖片裡的上傳檔案功能鍵）</span>
							<input id="file2" type="file" class="file-loading">
<?php if(strval($id) == 0): ?>
							<input type='hidden' name='hid_filepath2' value=''>
							<input type='hidden' name='hid_filepath2_old' value=''>
<?php else: ?>
							<input type='hidden' name='hid_filepath2' value='<?= $data['url_pic2']?>'>
							<input type='hidden' name='hid_filepath2_old' value='<?= $data['url_pic2']?>'>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">影片連結</label>
						<div class="col-sm-7">
							<span style="color:#0044BB">Youtube範例 : https://www.youtube.com/embed/</span>_t9I9EOAiBY 
<?php if(strval($id) == 0): ?>
							<input type="text" class="form-control" name="txt_url_youtube" value=''>
<?php else: ?>
							<input type="text" class="form-control" name="txt_url_youtube" value='<?= $data['url_youtube'] ?>'>
<?php endif; ?>
							<button type='button' class='btn btn-info' id='btn_check_youtube'>Check</button>
						</div>
						<div class='col-sm-4'>
							<div id='show_youtube'></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="step_3">
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal">
					<br>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品詳情</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<textarea id="summernote" name="txt_detail" rows="5" cols="110" width='560px' class="textarea"></textarea>
<?php else: ?>
							<textarea id="summernote" name="txt_detail" rows="5" cols="110" width='560px' class="textarea"><?= $data['detail'] ?></textarea>
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="step_4">
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal">
					<br>
					<div class="form-group">
						<label class="col-sm-1 control-label">商品規格</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<textarea id="summernote2" name="txt_detail_spec" rows="5" cols="110" width='560px' class="textarea"></textarea>
<?php else: ?>
							<textarea id="summernote2" name="txt_detail_spec" rows="5" cols="110" width='560px' class="textarea"><?= $data['detail_spec'] ?></textarea>
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="step_5">
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal">
					<br>
					<div class="form-group">
						<label class="col-sm-1 control-label">幣別</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<?= form_dropdown('sel_currency', $ary_currency, '', 'class="form-control"'); ?>
<?php else: ?>
							<?= form_dropdown('sel_currency', $ary_currency, $data['currency'], 'class="form-control"'); ?>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">原價</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<input type="text" class="form-control" name="txt_price_origin" value='' pattern="[0-9]+" required>
<?php else: ?>
							<input type="text" class="form-control" name="txt_price_origin" value='<?= $data['price_origin']?>' pattern="[0-9]+" required>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">售價</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<input type="text" class="form-control" name="txt_price_deal" value='' pattern="[0-9]+" required>
<?php else: ?>
							<input type="text" class="form-control" name="txt_price_deal" value='<?= $data['price_deal']?>' pattern="[0-9]+" required>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">成本價</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<input type="text" class="form-control" name="txt_price_cost" value='' pattern="[0-9]+" required>
<?php else: ?>
							<input type="text" class="form-control" name="txt_price_cost" value='<?= $data['price_cost']?>' pattern="[0-9]+" required>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">最多購買量（人）</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<input type="text" class="form-control" name="txt_p_limit" value='' pattern="[0-9]+" required />
<?php else: ?>
							<input type="text" class="form-control" name="txt_p_limit" value='<?= $data['p_limit']?>' pattern="[0-9]+" required />
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="step_6">
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal">
					<br>
					<div class="form-group">
						<div class="col-sm-4">尺寸規格</div>
						<div class="col-sm-2">庫存量</div>
						<div class="col-sm-6"></div>
					</div>
					<div id='colorsize_list'>
<?php if(strval($id) == 0): ?>
						<div class="form-group">
							<div class="col-sm-4">
								<?= form_dropdown('sel_spec[]', $ary_spec, '', 'class="form-control"'); ?>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="txt_quantity[]" value='' pattern="[0-9]+" required>
							</div>
							<div class="col-sm-1">
							</div>
							<div class="col-sm-5"></div>
						</div>
<?php else: ?>
<?php if(count($ary_data_spec) >0): ?>
<?php foreach ($ary_data_spec as $value): ?>
						<div class="form-group">
							<div class="col-sm-4">
								<?= form_dropdown("sel_spec[]", $ary_spec, $value["spec_id"], "class='form-control'"); ?>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="txt_quantity[]" value='<?=  $value['quantity'] ?>' pattern="[0-9]+" required>
							</div>
							<div class="col-sm-1"></div>
							<div class="col-sm-5"></div>
						</div>
<?php endforeach; ?>
<?php endif; ?>	
<?php endif; ?>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
						</div>
						<div class="col-sm-2" style="text-align: right;">
							<button type='button' class="btn-add btn-success btn" id='btn_add_colorsize'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-5"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="step_7">
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal">
					<br>
<?php if(count($ary_store_category >0)): ?>					
<?php foreach ($ary_store_category as $key => $one): ?>
					<div class="form-group">
						<div class="col-sm-12">
							<label class="control-label"><?= $key ?></label>
							<div>
								<div class='checkbox'>
<?php foreach ($one as $val): ?>
<?php if(strval($id) == 0): ?>
									<input type="radio" name="rdo_store_category_id" value='<?=  $val['id'] ?>' > <?= $val['name'] ?>　
<?php else: ?>
									<input type="radio" name="rdo_store_category_id" value='<?=  $val['id'] ?>' <?= ($data['store_category_id'] & $val['id']) == $val['id'] ? 'checked="checked"' : '' ?>> <?= $val['name'] ?>　
<?php endif; ?>
<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
<?php endforeach; ?>
<?php else: ?>
					請至商品分類設定
<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="step_8">
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal">
					<br>
					<div class="form-group">
						<label class="col-sm-1 control-label">標題</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<input type="text" class="form-control" name="txt_og_title" value='' required>
<?php else: ?>
							<input type="text" class="form-control" name="txt_og_title" value='<?= $data['og_title']?>' required>
<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">簡介</label>
						<div class="col-sm-11">
<?php if(strval($id) == 0): ?>
							<textarea type="text" rows="3" class="form-control" name="txt_og_descr" required></textarea>
<?php else: ?>
							<textarea type="text" rows="3" class="form-control" name="txt_og_descr" required><?= $data['og_descr'] ?></textarea>
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- tab-content -->
</div><!-- nav-tabs-custom -->
</form>	
</section><!-- /.content -->
<section class="content-footer">
    <div class='box-footer text-right'>
        <button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
        <button type="button" class='btn btn-primary' name="btn_save" id="btn_save">Save</button>
    </div>
</section>
<!-- user search -->
<div class="modal fade" id='user_search'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Search: 請輸入使用者名稱查詢</span></h4>
			</div>
			<div class='modal-body'>
				<input type="text" class="form-control" name="txt_search"></input>
				<div id='div_modal_search'>
					<select id='sel_search' class='form-control' size='12'></select>
				</div>
			</div>
			<div class='modal-footer'>
				<button id="btn_search_cancel" class="btn btn-default">Cancel</button>
				<button id="btn_search_apply" class="btn btn-primary">Apply</button>
			</div>
		</div>
	</div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>

<script src="<?= base_url() ?>assets/summernote/summernote.min.js"></script>
<script src="<?= base_url() ?>assets/summernote/summernote-zh-TW.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/summernote/summernote.css">
<script type="text/javascript">
$(function() {
	datetimepick();

	function datetimepick() {
		$(".daterange").daterangepicker({
			opens: 'left',
			timePicker: true,
			locale: {
				format: 'YYYY-MM-DD HH:mm'
			}
		});
	}

	$("select[name='sel_category']").bind("change",function(){
		$.ajax({
			async: false,
			type: "POST",
			url: $('#hid_baseurl').val() + 'product/getCategorySonByCategoryId/' + $("select[name='sel_category']").val(),
			statusCode: {
				200: function(e) {
					$('select[name=sel_category_son]').html(e);
				}
			},
			error: function() {
			}
		});
	});


	// search
	$('.modal').on('shown.bs.modal', function () {
		$('#sel_search').html('');
		$("input[name='txt_search']").focus();
	});

	$("input[name='txt_search']").bind("keyup",function(){
		if($("input[name='txt_search']").val().length == 0) return;
		$('#div_modal_search').html();

		$.ajax({
			async: false,
			type: "POST",
			url: $('#hid_baseurl').val() + 'product/getUsersBySearch',
			data: { keyword: $("input[name='txt_search']").val() },
			statusCode: {
				200: function(e) {
					$('#div_modal_search').html(e);
				}
			},
			error: function() {
			}
		});
	});

	$("#btn_search_apply").bind("click",function() {
		if($('#sel_search').val() === null) return;
		$('input[name=txt_pm_id]').val($('#sel_search :selected').text());
		$('input[name=hid_pm_id]').val($('#sel_search').val())
		$(".modal").modal('hide');
	});

	$("#btn_search_cancel").bind("click",function() {
		$(".modal").modal('hide');
	});

	//fileupdata start
	$('#file').click(function() {
		if($('#file').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}
	});

	$('#file').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: false,
		maxFileSize: 51200,
		minImageWidth: 1440,
		minImageHeight: 960,
		maxImageWidth: 1440,
		maxImageHeight: 960,
		language: "zh-TW",
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
<?php if((strval($id) != '0') && (strlen($data['url_pic'])) > 0): ?>
		initialCaption: "<?= $data['url_pic'] ?>",
		initialPreview: ['<img src="<?= URL_GOOGLE_IMG . $data['url_pic']; ?>" class="kv-preview-data krajee-init-preview file-preview-image">'],		
<?php endif; ?>
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qgoods' };
			return info;
		}
	});

	$('#file').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_filepath]').val(response.new_path);
		$('input[name=hid_filepath_old]').val(response.new_path);
		$('#file').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_path);
	});
	//fileupdata end

	$('#file2').click(function() {
		if($('#file2').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}
	});

	$('#file2').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: false,
		maxFileSize: 51200,
		minImageWidth: 1440,
		minImageHeight: 960,
		maxImageWidth: 1440,
		maxImageHeight: 960,
		language: "zh-TW",
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
<?php if((strval($id) != '0') && (strlen($data['url_pic2'])) > 0): ?>
		initialCaption: "<?= $data['url_pic2'] ?>",
		initialPreview: ['<img src="<?= URL_GOOGLE_IMG . $data['url_pic2']; ?>" class="kv-preview-data krajee-init-preview file-preview-image" style="width: 640px;" >'],		
<?php endif; ?>
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qgoods' };
			return info;
		}
	});

	$('#file2').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_filepath2]').val(response.new_path);
		$('input[name=hid_filepath2_old]').val(response.new_path);
		$('#file2').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_path);
	});

	$('#btn_check_youtube').bind('click', function() {
		$('#show_youtube').html('<iframe src="' + $('input[name=txt_url_youtube]').val() + '"></iframe>');
	});


	$('#summernote').summernote({
		height: 500,
		lang: 'zh-TW',
		codemirror: { theme: 'paper'},
		placeholder: '請輸入文字...',	
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline','clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['Insert', ['picture','link','hr','video','table']],
			['Misc', ['fullscreen','codeview','undo','redo']]
		],
		focus: true,
		callbacks: {
			onImageUpload: function(image,editor, welEditable) {
				sendFile(image[0],editor, welEditable);
			},			
			onChange: function(contents, $editable) {
				modified = true;
			},
			//貼上自動去除html
			onPaste: function (ne) { 
				var bufferText = ((ne.originalEvent || ne).clipboardData || window.clipboardData).getData( 'Text/plain'); 
				ne.preventDefault ? ne.preventDefault() : (ne.returnValue = false); 
				setTimeout(function () {
					document.execCommand("insertText", false, bufferText); 
				}, 10); 
			}
		}
	});

	$('#summernote2').summernote({
		height: 500,
		lang: 'zh-TW',
		codemirror: { theme: 'paper'},
		placeholder: '請輸入文字...',	
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline','clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['Insert', ['picture','link','hr','video','table']],
			['Misc', ['fullscreen','codeview','undo','redo']]
		],
		focus: true,
		callbacks: {
			onImageUpload: function(image,editor, welEditable) {
				sendFile(image[0],editor, welEditable);
			},			
			onChange: function(contents, $editable) {
				modified = true;
			},
			//貼上自動去除html
			onPaste: function (ne) { 
				var bufferText = ((ne.originalEvent || ne).clipboardData || window.clipboardData).getData( 'Text/plain'); 
				ne.preventDefault ? ne.preventDefault() : (ne.returnValue = false); 
				setTimeout(function () {
					document.execCommand("insertText", false, bufferText); 
				}, 10); 
			}
		}
	});

	$("#btn_add_colorsize").click(function() {
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'product/addColorSizeRow',
			cache: false,
			async : false,
			complete: function(response){
				$("#colorsize_list").append(response.responseText);
			}
		});
	});

	$("#btn_cancel").bind("click",function(){
		window.location = '<?= base_url() ?>product';
	});	
	
	$("#btn_save").bind("click",function(){
		if(!$('#form1')[0].checkValidity()) return;

		$.ajax({
			cache: false,
			async : false,
			type: "POST",
			url: $('#hid_baseurl').val() + 'product/doEdit/0',
			data: $('#form1').serialize(),
			statusCode: {
				200: function() {
					window.location = '<?= base_url() ?>product';
				}
			},
			error: function() {
				alert('操作失敗');
			}
		});
	});
});
</script>