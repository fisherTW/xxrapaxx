<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#tblmain, #tbl_2_3 {
	table-layout:fixed;
}
#tblmain td, #tbl_2_3 td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>


<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/locale/zh-tw.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		計畫管理
	</h1>
</section>
<!-- Main content -->
<section class="content">
<div class='nav-tabs-custom'>
	<ul class="nav nav-tabs">
		<li><a href="#step_admin" data-toggle="tab" aria-expanded="true">Admin</a></li>
		<li class="active"><a href="#step_1" data-toggle="tab" aria-expanded="true">第一階段資料</a></li>
<?php if(
	$info[0]['status'] == PROJECT_STATUS_1_SUCCESS ||
	$info[0]['status'] == PROJECT_STATUS_2_SEND ||
	$info[0]['status'] == PROJECT_STATUS_2_FAIL ||
	$info[0]['status'] == PROJECT_STATUS_2_SUCCESS
): ?>		
		<li class=""><a href="#step_2" data-toggle="tab" aria-expanded="false">第二階段資料</a></li>
<?php endif; ?>		
	</ul>
	<div class='tab-content'>
		<div class="tab-pane" id="step_admin">
			<ul class="nav nav-tabs">
				<input type='hidden' name='hid_status' value='<?= $info[0]['status'] ?>'>
				<li class="active"><a href="#step_a_1" data-toggle="tab" aria-expanded="true">Admin</a></li>
				<li class="pull-right">
					<div class="btn btn-block btn-primary step_a_save" id='step_a_save'>Admin 資料儲存</div>
				</li>
			</ul>			
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal" id="step_a_1">
					<br>
					<form id='form_a_1'>
						<input type="hidden" name="hid_project_id" value='<?= $id ?>'>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">計畫階段</label>
							<div class="col-sm-9">
								<?= form_dropdown('sel_status', $ary_status, $info[0]['status']); ?>
							</div>		
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">上架</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="rdo_is_enable" value='1' <?= $info[0]['is_enable'] == 1 ? 'checked' : '' ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="rdo_is_enable" value='0' <?= $info[0]['is_enable'] == 0 ? 'checked' : '' ?>>否
								</label>
							</div>		
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">推薦</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="rdo_is_recommend" value='1' <?= $info[0]['is_recommend'] == 1 ? 'checked' : '' ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="rdo_is_recommend" value='0' <?= $info[0]['is_recommend'] == 0 ? 'checked' : '' ?>>否
								</label>
							</div>		
						</div>
						<div class="form-group">
<?php foreach ($pdt as $key => $value):?>
						
<?php if ($key == 0 ): ?>
						<label for="inputEmail3" class="col-sm-3 control-label">贊助方案</label>
<?php else: ?>
						<label for="inputEmail3" class="col-sm-3 control-label"></label>
<?php endif; ?>
							<div class="col-sm-1">方案名稱</div>
							<div class="col-sm-2">
								<input type="text" value="<?= $value['pdt_name'] ?>" disabled>
							</div>
							<div class="col-sm-1">方案售價</div>
							<div class="col-sm-2">
								<input type="text" value="<?= $value['pdt_price_deal'] ?>" disabled>
							</div>
							<div class="col-sm-1">狀態</div>
							<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" name="rdo_pdt_status[<?= $value['pdt_id'] ?>]" value='1' <?= $value['pdt_status'] == 1 ? 'checked' : '' ?>>上架
							</label>
							<label class="radio-inline">
								<input type="radio" name="rdo_pdt_status[<?= $value['pdt_id'] ?>]" value='0' <?= $value['pdt_status'] == 0 ? 'checked' : '' ?>>下架
							</label>
							</div>		
<?php endforeach; ?>
						</div>
					</form>
				</div>
			</div>			
		</div><!-- tab-pane active -->		
		<div class="tab-pane active" id="step_1">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#step_1_1" data-toggle="tab" aria-expanded="true">計畫內容</a></li>
			</ul>			
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal" id="step_1_1">
					<br>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">真實姓名</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['user_name'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">聯絡電話</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['user_phone'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">聯絡信箱</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['user_mail'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">個人簡介</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['user_profile'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">計畫名稱</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['name'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">計畫類別</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['mpc_name'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">計畫簡介</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['profile'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">使用品牌</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['brand_name'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">目標金額</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required	value='<?= $info[0]['goal'] ?>' disabled>
						</div>		
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">募資起迄時間</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required value='<?= $info[0]['dt_exp_start'].' ~ '.$info[0]['dt_exp_end'] ?>' disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">實現時間</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" required value='<?= date("Y 年 m 月", strtotime($info[0]['date_out'])) ?>' disabled>							
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">項目主圖</label>
						<div class="col-sm-9">
							<img src="<?= URL_GOOGLE_IMG.$info[0]['pic_cover'] ?>" style="width: 600px">
						</div>		
					</div>
				</div>
			</div>			
		</div><!-- tab-pane active -->
<?php if(
	$info[0]['status'] == PROJECT_STATUS_1_SUCCESS ||
	$info[0]['status'] == PROJECT_STATUS_2_SEND ||
	$info[0]['status'] == PROJECT_STATUS_2_FAIL ||
	$info[0]['status'] == PROJECT_STATUS_2_SUCCESS
): ?>
		<div class="tab-pane" id="step_2">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#step_2_1" data-toggle="tab" aria-expanded="true">詳細介紹</a></li>
				<li class=""><a href="#step_2_2" data-toggle="tab" aria-expanded="false">贊助方案</a></li>
				<li class=""><a href="#step_2_3" data-toggle="tab" aria-expanded="false">常見問題</a></li>
				<li class="pull-right">
					<!-- <div class="btn btn-block btn-primary step_2_save" id='step_2_save'>第二階段資料儲存</div> -->
				</li>
			</ul>
			<div class='tab-content'>
				<div class="tab-pane active form-horizontal" id="step_2_1">
					<br>
					<form id='form_2_1' class='vrf'>
						<input type="hidden" name="hid_project_id" value='<?= $id ?>'>					
						<div class='form-group'>
							<label for="inputEmail3" class="col-sm-2 control-label">Info.（計畫詳情）</label>
							<div class="col-sm-10">
 								<textarea id="summernote" name="txt_project_detail" rows="5" cols="110" width='560px' class="textarea" required disabled="disabled"><?= $info[0]['detail'] ?></textarea>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane" id="step_2_2">
					<br>
					<!-- <div class="row">
						<div class="col-md-2">
							<button type='button' class="btn btn-warning" data-toggle="modal" data-target="#modal_add_product"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> 新增</button>
						</div>
						<div class="col-md-10">
							<div class="box box-info">
								<div class='box-body'>
									<i class='fa fa-info-circle'></i> 本頁籤做了修改後，不須按右上儲存
								</div>
							</div>	 /.box 

						</div>
					</div>
					<br> -->
					<table id='tblmain'>
					</table>
					<!-- Modal -->
					<div class="modal fade" id="modal_add_product" tabindex="-1" role="dialog" aria-labelledby="modal_add_productLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="modal_add_productLabel">查看贊助方案</h4>
								</div>
								<div class="modal-body row">
									<form id='form_add_product' class='vrf'>
										<input type="hidden" name="hid_project_id" value='<?= $id ?>'>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">方案名稱</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="txt_name" required maxlength="100">
											</div>		
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">方案描述</label>
											<div class="col-sm-9">
												<textarea class="form-control" name="txt_detail" required rows='3'></textarea>
											</div>		
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">方案價格</label>
											<div class="col-sm-9">
												<input type="number" class="form-control" name="txt_price_origin" required >
											</div>		
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">方案圖片</label>
											<div class="col-sm-9" id='div_url_pic'>
												<input type="file" id="file_picture" multiple class="file-loading">
												<input type="hidden" name='hid_url_pic' value=''>
											</div>
											<div class='col-sm-9' id='div_url_pic_hide' style='display: none'>
												<img id='img_url_pic' class='img-responsive'>
											</div>		
										</div>
										<div class="clearfix"></div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">庫存量</label>
											<div class="col-sm-9">
												<input type="number" class="form-control" name="txt_quantity" required max="30000">
											</div>		
										</div>
										<!-- 截止 -->
									</form>
								</div>
								<br>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button id='btn_save_new_product' type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>
					</div>						
				</div>
				<div class="tab-pane" id="step_2_3">
 					<br>
<!--					<div class="row">
						<div class="col-md-2">
							<button type='button' class="btn btn-warning" data-toggle="modal" data-target="#modal_2_3"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> 新增</button>
						</div>
						<div class="col-md-10">
							<div class="box box-info">
								<div class='box-body'>
									<i class='fa fa-info-circle'></i> 本頁籤做了修改後，不須按右上儲存
								</div>
							</div>  /.box

						</div>
					</div>
					<br> -->
					<table id='tbl_2_3'>
					</table>
					<!-- Modal -->
					<div class="modal fade" id="modal_2_3" tabindex="-1" role="dialog" aria-labelledby="modal_2_3Label">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="modal_2_3Label">查看常見問題</h4>
								</div>
								<div class="modal-body row">
									<form id='form_2_3' class='vrf'>
										<input type="hidden" name="hid_project_id" value='<?= $id ?>'>
										<input type="hidden" name="hid_faq_id" value='0'>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">問題內容</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="txt_q" required maxlength="100">
											</div>		
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">答覆內容</label>
											<div class="col-sm-9">
												<textarea class="form-control" name="txt_a" rows='5' required ></textarea>
											</div>		
										</div>
									</form>
								</div>
								<br>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>						
				</div>
			</div>
		</div>
<?php endif; ?>		
	</div><!-- tab-content -->
</div><!-- nav-tabs-custom -->
	
</section><!-- /.content -->
<?php if(!isset($info[0]['id'])): ?>
<button id="btn_save" class="btn btn-primary">Save</button>
<?php endif; ?>

<script src="<?= base_url() ?>assets/summernote/summernote.min.js"></script>
<script src="<?= base_url() ?>assets/summernote/summernote-zh-TW.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/summernote/summernote.css">
<script type="text/javascript">
$(function() {
	$('#step_a_save').bind('click', function() {
		if(!$('#form_a_1')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'plist/edit_a_1',
			cache: false,
			async : false,
			data: $('#form_a_1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				alert('操作成功');
			}
		});
		return false;		
	});

	$('#step_a_save').bind('click', function() {
		if(!$('#form_a_1_1')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'plist/edit_a_1_1',
			cache: false,
			async : false,
			data: $('#form_a_1_1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				alert('操作成功');
			}
		});
		return false;		
	});	
	// $('#step_2_save').bind('click', function() {
	// 	if(!$('#form_2_1')[0].checkValidity()) return;
	// 	$.ajax({
	// 		type: "POST",
	// 		url: $('#hid_baseurl').val() + 'plist/edit_2_1',
	// 		cache: false,
	// 		async : false,
	// 		data: $('#form_2_1').serialize(),
	// 		error: function(xhr){
	// 			alert("Failure");
	// 		},
	// 		complete: function(response){
	// 			alert('操作成功');
	// 		}
	// 	});
	// 	return false;		
	// });
	$(".dtp").datetimepicker({
		format: 'YYYY-MM-DD HH:mm',
		locale: 'zh-tw',
		defaultDate: moment()
	});
	$('#file_picture').click(function() {
		if($('#file_picture').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});	
	initFileinput();
	$('#file_picture').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_url_pic]').val(response.new_path);
		$('#file_picture').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_name);
	});	

	$('#modal_add_product').on('hidden.bs.modal', function (e) {
		modalUnLock('modal_add_product');
		$('#form_add_product')[0].reset();
		$('#form_add_product textarea').text('');
		$('#file_picture').fileinput('destroy');
		initFileinput();
	});
	$('#modal_2_3').on('hidden.bs.modal', function (e) {
		$('#form_2_3')[0].reset();
		$('#form_2_3 textarea').text('');
		$('input[name=hid_faq_id]').val('0');
	});

	$('#tblmain').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>plist/getProduct/<?= $id ?>',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100]",
		columns: [{
			field:'id' ,
			title: "id",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"5%",
			class:"text-nowrap"
		},{
			field:'name' ,
			title: "方案名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"20%",
			class:"text-nowrap"
		},{
			field:'detail' ,
			title: "方案描述",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"32%",
			class:"text-nowrap"
		},{
			field:'price_cost' ,
			title: "方案價格",
			halign:"center" ,
			align:"right" ,
			formatter: goalFormatter,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'spec' ,
			title: "庫存量",
			halign:"center" ,
			align:"right" ,
			formatter: function(obj) {
				var ret = '';
				for (var i = 0; i < obj.length; i++) {
					ret += (ret.length > 0 ? "<br>" : '') + '[' + obj[i].spec_name + '] ' + obj[i].quantity;
				}
				return ret;
			},			
			width:"14%",
			class:"text-nowrap"
		},{
			field:'dt_end' ,
			title: "截止日期",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"14%",
			formatter: dtFormatter,
			class:"text-nowrap"
		},{											
			field:'' ,
			title: "操作",
			halign:"center" ,
			align:"center",
			events: operateEvents,
			formatter: operateFormatter,
			width:"5%",
			class:"text-nowrap"
		}]
	});
	$('#tbl_2_3').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>plist/getFaq/<?= $id ?>',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100]",
		columns: [{
			field:'id' ,
			title: "id",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"5%",
			class:"text-nowrap"
		},{
			field:'q' ,
			title: "問題內容",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"30%",
			class:"text-nowrap"
		},{
			field:'a' ,
			title: "答覆內容",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"60%",
			class:"text-nowrap"
		},{										
			field:'' ,
			title: "操作",
			halign:"center" ,
			align:"center",
			events: operateEvents_2_3,
			formatter: operateFormatter_2_3,
			width:"5%",
			class:"text-nowrap"
		}]
	});	
	$('#btn_save_new_product').bind('click', function() {
		if(!$('#form_add_product')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'plist/createProduct',
			cache: false,
			async : false,
			data: $('#form_add_product').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				$('#tblmain').bootstrapTable('refresh', '');
				$('#modal_add_product').modal('hide');
			}
		});
		return false;		
	});	
	$('#btn_save_2_3').bind('click', function() {
		if(!$('#form_2_3')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'plist/cuFaq',
			cache: false,
			async : false,
			data: $('#form_2_3').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				$('#tbl_2_3').bootstrapTable('refresh', '');
				$('#modal_2_3').modal('hide');
			}
		});
		return false;		
	});		
	$('#btn_save').bind('click', function() {
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'payment/create',
			cache: false,
			async : false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				alert('操作成功');
				location.reload();
			}
		});
		return false;		
	});
	$('#btn_check').bind('click', function() {
		$('#div_video').html($('#txt_video').val());
		return false;		
	});	

	$('#summernote').summernote({
		height: 600,
		lang: 'zh-TW',
		codemirror: { theme: 'paper'},
		placeholder: '請輸入文字...',	
		toolbar: [],
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
	if(($('input[name=hid_status]').val()  == '<?= PROJECT_STATUS_2_SEND ?>') || ($('input[name=hid_status]').val() == '<?= PROJECT_STATUS_2_SUCCESS ?>')) {						
		$('#summernote').summernote('disable');
	}
});	

function sendFile(file, editor, welEditable) {
	data = new FormData();
	data.append("file_data", file);

	$.ajax({
		type: "POST",
		url: $('#hid_baseurl').val() + 'upload/quick',
		cache: false,
		async : false,
		data: data,
		processData: false,
		contentType: false,
		error: function(xhr){
			alert("Failure");
		},
		complete: function(response){
			var obj = JSON.parse(response.responseText);
			$('#summernote').summernote('insertImage',  '<?= URL_GOOGLE_IMG ?>' + obj.new_path);
		}
	});	
}

function initFileinput() {
	$('#file_picture').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: false,
		maxFileSize: 20480,
		minImageWidth: 700,
		minImageHeight: 350,
		maxImageWidth: 700,
		maxImageHeight: 350,
		language: "zh-TW",
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qmaker' };
			return info;
		}
	});	
}


function modalLock(modal_id) {
	$('#' + modal_id + ' input').attr('disabled', 'disabled');
	$('#' + modal_id + ' textarea').attr('disabled', 'disabled');
	$('#div_url_pic_hide').show();
	$('#div_url_pic').hide();
	$('#btn_save_new_product').hide();
}

function modalUnLock(modal_id) {
	$('#' + modal_id + ' input').removeAttr('disabled');
	$('#' + modal_id + ' textarea').removeAttr('disabled');
	$('input[name=txt_quantity]').attr('type', 'number');

	$('#div_url_pic').show();
	$('#div_url_pic_hide').hide();
	$('#btn_save_new_product').show();
}

function modalSet(modal_id, row) {
	switch(modal_id) {
		case 'modal_add_product':
			$('input[name=txt_name]').val(row.name);
			$('textarea[name=txt_detail]').text(row.detail);
			$('input[name=txt_price_origin]').val(row.price_origin);
			$('#img_url_pic').attr('src', <?= "'".URL_GOOGLE_IMG."'" ?> + row.url_pic);
			var ret = '';
			var obj = row.spec;
			for (var i = 0; i < obj.length; i++) {
				ret += (ret.length > 0 ? "; " : '') + '(' + obj[i].spec_name + ') ' + obj[i].quantity;
			}
			$('input[name=txt_quantity]').attr('type', 'text');
			$('input[name=txt_quantity]').val(ret);
			$('input[name=txt_dt_end]').val(moment(row.dt_end).format('YYYY-MM-DD HH:mm'));		
			break;
		case 'modal_2_3':
			$('input[name=txt_q]').val(row.q);
			$('textarea[name=txt_a]').text(row.a);
			$('input[name=hid_faq_id]').val(row.id);
			break;
	}

}

var fm = new Intl.NumberFormat('zh-TW', {
	style: 'currency',
	currency: 'NTD'
});

function goalFormatter(v) {
	return fm.format(v);
}

function dtFormatter(v) {
	return moment(v).format('YYYY-MM-DD HH:mm');
}

function operateFormatter(value, row, index) {
	return [
		'<a class="mview ml10" href="javascript:void(0)" title="View">',
			'<i class="fa fa-eye"></i>',
		'</a>'
	].join('');
}

function operateFormatter_2_3(value, row, index) {
	return [
		'<a class="mview ml10" href="javascript:void(0)" title="View">',
			'<i class="fa fa-eye"></i>',
		'</a> '
	].join('');
}

window.operateEvents = {
	'click .mview': function (e, value, row, index) {
		modalSet('modal_add_product', row);
		modalLock('modal_add_product');
		$('#modal_add_product').modal('show');
	}
};
window.operateEvents_2_3 = {
	'click .mview': function (e, value, row, index) {
		modalSet('modal_2_3', row);
		modalLock('modal_2_3');
		$('#modal_2_3').modal('show');
	},
	'click .mdelete': function (e, value, row, index) {
		if(!confirm('確認刪除？')) return false;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'plist/doDelFaq',
			cache: false,
			async : false,
			data: {id: row.id},
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				alert('操作成功');
				$('#tbl_2_3').bootstrapTable('refresh', '');
			}
		});
		return false;
	}	
};
</script>