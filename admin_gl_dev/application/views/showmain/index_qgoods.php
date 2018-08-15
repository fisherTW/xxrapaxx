<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/locale/zh-tw.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		首頁管理-好物
		<small>首頁顯示</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
	<input type='hidden' id='hid_look_pdt' value=''>
	<input type='hidden' id='hid_row_pic' value=''>
	<input type='hidden' id='hid_row_youtube' value=''>
	<form class="form-horizontal vrf" id="form_data">
		<input type='hidden' id='hid_row' name='hid_row' value=''>
		<input type='hidden' id='hid_row_look' name='hid_row_look' value=''>
		<br>
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">主題好物</h3>
				<div class="box box-info">
					<div class="box-body">
						<i class="fa fa-info-circle"></i> 最多 8 個
					</div>
				</div>
				<table id='tbl_theme'>
				</table>
			</div>
		</div>
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">Banner</h3>
				<div class="box box-info">
					<div class="box-body">
						<i class="fa fa-info-circle"></i> 圖片 - 寬度: 1440 px 高度: 480 px<br>
						<i class="fa fa-info-circle"></i> 網址範例 : https://www.rapaq.com/project/view/27
					</div>
				</div>
				<div id="add_banner_block">
<?php for ($i=0; $i < count($banner_pdt); $i++) : ?>
					<div class="form-group banner<?= $i+1 ?>">

						<label for="inputEmail3" class="col-sm-1 control-label">Banner顯示-<?= $i+1 ?></label>
						<div class="col-sm-5">
							<input type="url" class="form-control" name="txt_url[]" value="<?= $banner_pdt[$i]['url']?>" placeholder="請輸入整串網址" required />
						</div>
						<div class="col-sm-2">
							<img name="banner_pic" src="<?= URL_GOOGLE_IMG.$banner_pdt[$i]['pic'] ?>" style="width: 80px;" row="<?= $i+1 ?>">
						</div>
						<div class="col-sm-4">
							<input type="hidden" class="b_pic_url" name="b_pic_url[]" value="<?= $banner_pdt[$i]['pic'] ?>" row="<?= $i+1 ?>">
							<button type="button" class="btn btn-primary btn-flat pchange" data-toggle="modal" data-target="#modal-default" row="<?= $i+1 ?>" >更換圖片</button>
							<button type="button" class="btn btn-danger btn-flat btn-remove_banner" row="<?= $i+1 ?>" >-</button>
						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-1  control-label"><p class="text-left">開始 / 結束</p></div>
						<div class="col-sm-4">
							<input class="form-control daterange" type="text" name="b_daterange[]" value="<?= $dt_show[$banner_pdt[$i]['id']] ?>" readonly />
						</div>
						<div class="col-sm-2 control-label">彈出視窗</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" name="rdo_pdt_status[<?= $i+1 ?>]" value='1' <?= $banner_pdt[$i]['is_blank'] == 1 ? 'checked' : '' ?>>是
							</label>
							<label class="radio-inline">
								<input type="radio" name="rdo_pdt_status[<?= $i+1 ?>]" value='0' <?= $banner_pdt[$i]['is_blank'] == 0 ? 'checked' : '' ?>>否
							</label>
						</div>
					</div>
<?php endfor; ?>
				</div>
				<a id="btn_add_banner" class="btn btn-warning btn-block"><b>Add</b></a>
			</div>
		</div>

		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">好物看看</h3>
				<div class="box box-info">	
					<div class="box-body">
						<i class="fa fa-info-circle"></i> 最多 6 個<br>
						<i class="fa fa-info-circle"></i> Youtube範例 : https://www.youtube.com/<font color="red">embed</font>/A4BujkXnaFw 
					</div>
				</div>
				<div id="add_look_block">
<?php for ($l=0; $l < count($look_pdt); $l++) : ?>		
					<div class="form-group look<?= $l+1 ?>">
						<label for="inputEmail3" class="col-sm-1 control-label">看看顯示-<?= $l+1 ?></label>
						<div class="col-sm-2">
							<input type="text" class="form-control choose_look" name="txt_pdt_name" value="<?= $look_pdt[$l]['pdt_name'] ?>" row="<?= $l+1 ?>" disabled />
							<input type="hidden" id="choose_look<?= $l+1 ?>" name="hid_products_id[]" value="<?= $look_pdt[$l]['pdt_id'] ?>" row="<?= $l+1 ?>" />
						</div>
						<div class="col-sm-1">
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary btn-flat psearch" data-toggle="modal" data-target="#modal-look" row="<?= $l+1 ?>" >Search</button>
							</span>
						</div>						
						<div class="col-sm-1  control-label">Youtube</div>
						<div class="col-sm-3">
							<input type="text" class="form-control youtube_url" placeholder="輸入 YOUTUBE 網址" name="txt_url_youtube[]" value="<?= $look_pdt[$l]['url_youtube'] ?>" row="<?= $l+1 ?>" pattern="^https:\/\/www.youtube.com\/embed\/.+" required />
						</div>
						<div class="col-sm-1" style="width: 82px;padding-right: 0px;">
							<button type="button" class="btn btn-primary btn-flat check_url_youtube fa fa-check-circle" row="<?= $l+1 ?>"style="width: 31px;height: 34px;"  ></button>
							<button type="button" class="btn btn-danger btn-flat btn-remove fa fa-minus" row="<?= $l+1 ?>" style="width: 31px;height: 34px;"></button>
						</div>	
							<div class="col-sm-2" id='div_url_pic<?= $l+1 ?>'></div>
					</div>
<?php endfor; ?>
				</div>
				<a id="btn_add_look" class="btn btn-warning btn-block"><b>Add</b></a>
			</div>
		</div>

		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">店舖推薦</h3>
				<div class="box box-info">
					<div class="box-body">
						<i class="fa fa-info-circle"></i> 固定 4 個
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-1 control-label">店舖推薦-1</label>
					<div class="col-sm-3">
						<?= form_dropdown('is_show_store1', $ary_store, $store_show[0]['id'], 'class="form-control"'); ?>
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-1 control-label">店舖推薦-2</label>
					<div class="col-sm-3">
						<?= form_dropdown('is_show_store2', $ary_store, $store_show[1]['id'], 'class="form-control"'); ?>
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-1 control-label">店舖推薦-3</label>
					<div class="col-sm-3">
						<?= form_dropdown('is_show_store3', $ary_store, $store_show[2]['id'], 'class="form-control"'); ?>
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-1 control-label">店舖推薦-4</label>
					<div class="col-sm-3">
						<?= form_dropdown('is_show_store4', $ary_store, $store_show[3]['id'], 'class="form-control"'); ?>
					</div>
				</div>
			</div>
		</div>
	</form>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">更換圖片</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="file" class="file-loading" id="txt_big_picture" value="">
					<input type="hidden" name='hid_big_picurl' id="hid_big_picurl" value="">
					<input type="hidden" name='hid_big_pic' id="hid_big_pic" value="">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="button" id="btn_change_pic" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-look">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">輸入產品名稱</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					<input type="text" class="form-control" id="search_p" name="search_p" placeholder="輸入產品名稱">
				</div>
				<div id='div_modal_search'>
					<select id='div_search' name="txt_search" class='form-control' size='12'></select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="btn_change_pdt" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function () {
datetimepick();
removeBanner();
removeLook();
checkYoutube();
searchProduct();
changePicture();

	$('#tbl_theme').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>showmain/getThemeShow',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		pagination:"true",
		pageSize: 8,
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
			title: "主題",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"45%",
			class:"text-nowrap"
		},{
			field:'is_enable' ,
			title: "狀態",
			halign:"center" ,
			align:"center" ,
			sortable:"true" ,
			formatter: statusFormatter,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'dt_exp_start' ,
			title: "開始時間",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"15%",
			class:"text-nowrap"
		},{
			field:'dt_exp_end' ,
			title: "結束時間",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"15%",
			class:"text-nowrap"
		},{
			field:'' ,
			title: "操作",
			halign:"center" ,
			align:"center",
			events: operateEvents,
			formatter: operateFormatter,
			width:"10%",
			class:"text-nowrap"
		}]
	});

	function statusFormatter(v) {

		var str = '';
		if ( v == 1 ) {str = '<div><span style="color: green">上架</span></div>';} 
		if ( v == 0 ) {str = '<div><span style="color: red">下架</span></div>';}

		return str;
	}
	var nowtime = new Date();
	var year = nowtime.getFullYear();
	var month = padleft0(nowtime.getMonth() + 1);
	var day = padleft0(nowtime.getDate());
	var hour = padleft0(nowtime.getHours());
	var minute = padleft0(nowtime.getMinutes());
	var second = padleft0(nowtime.getSeconds());
	var millisecond = nowtime.getMilliseconds(); millisecond = millisecond.toString().length == 1 ? "00" + millisecond : millisecond.toString().length == 2 ? "0" + millisecond : millisecond;
	var now_dt = year + "-" + month + "-" + day + " " + hour + ":" + minute;
	

	$("#hid_row_look").val(<?= $l ?>);
	add_look_show();
	$('#btn_add_look').bind("click", function() {
		$("#hid_row_look").val((Number($("#hid_row_look").val())+1));
		var l = $("#hid_row_look").val();

		$html =	 '';
		$html += '<div class="form-group  look'+l+'">';
		$html += '<label for="inputEmail3" class="col-sm-1 control-label">看看顯示-'+l+'</label>';
		$html += '<div class="col-sm-2">';
		$html += '<input type="text" class="form-control choose_look" name="txt_pdt_name" value="" row="'+l+'" disabled />';
		$html += '<input type="hidden" id="choose_look'+l+'" name="hid_products_id[]" value="" row="'+l+'" />';
		$html += '</div>';
		$html += '<div class="col-sm-1">';
		$html += '<span class="input-group-btn">';
		$html += '<button type="button" class="btn btn-primary btn-flat psearch" data-toggle="modal" data-target="#modal-look" row="'+l+'" >Search</button>';
		$html += '</span>';
		$html += '</div>';
		$html += '<div class="col-sm-1  control-label">Youtube</div>';
		$html += '<div class="col-sm-3">';
		$html += '<input type="text" class="form-control youtube_url" placeholder="輸入 YOUTUBE 網址" name="txt_url_youtube[]" value="" row="'+l+'" pattern="^https:\/\/www.youtube.com\/embed\/.+" required>';
		$html += '</div>';
		$html += '<div class="col-sm-1" style="width: 82px;padding-right: 0px;">';
		$html += '<button type="button" class="btn btn-primary btn-flat check_url_youtube fa fa-check-circle" row="'+l+'" style="width: 31px;height: 34px;margin-right: 4px;"  ></button>';
		$html += '<button type="button" class="btn btn-danger btn-flat btn-remove fa fa-minus" row="'+l+'" style="width: 31px;height: 34px;" ></button>';
		$html += '</div>';
		$html += '<div class="col-sm-2" id="div_url_pic'+l+'"></div>';
		$html += '</div>';
		
		$('#add_look_block').append($html);
		
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'showmain/NewLookQgoods',
			cache: false,
			async : false,
			error: function(xhr){
				alert("Failure")
			},
			complete: function(response){
				$("option[add=new"+l+"]").after(response.responseText);
			}
		});

		add_look_show();
		checkYoutube();
		removeLook();
		searchProduct();

	});	

	$('#btn_change_pdt').bind("click", function() {
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'showmain/LookYoutubeUrl',
			cache: false,
			async : false,
			data: {'l':$("#div_search").val()},
			error: function(xhr){
				alert("Failure")
			},
			complete: function(response){
				console.log(response.responseText);
				$("input[name='txt_url_youtube[]'][row="+$('#hid_look_pdt').val()+"]").val(response.responseText);
			}
		});
	});


	$("#hid_row").val(<?= $i ?>);
	$('#btn_add_banner').bind("click", function() {

		$("#hid_row").val((Number($("#hid_row").val())+1));

		var i = $("#hid_row").val();
		
		$html =  '';
		$html += '<div class="form-group banner'+i+'">';
		$html += '<label for="inputEmail3" class="col-sm-1 control-label">Banner顯示-'+i+'</label>';
		$html += '<div class="col-sm-5">';
		$html += '<input type="url" class="form-control" name="txt_url[]" value="" placeholder="請輸入整串網址"  >';
		$html += '</div>';
		$html += '<div class="col-sm-2">';
		$html += '<img name="banner_pic" src="" style="width: 80px;" row="'+i+'">';
		$html += '</div>';
		$html += '<div class="col-sm-4">';
		$html += '<input type="hidden" class="b_pic_url" name="b_pic_url[]" value="" row="'+i+'">';
		$html += '<button type="button" class="btn btn-primary btn-flat pchange" data-toggle="modal" data-target="#modal-default" row="'+i+'" style="margin-right: 4px;">更換圖片</button>';
		$html += '<button type="button" class="btn btn-danger btn-flat btn-remove_banner" row="'+i+'" >-</button>';
		$html += '</div>';
		$html += '<div class="col-sm-1"></div>';
		$html += '<div class="col-sm-1  control-label"><p class="text-left">開始 / 結束</p></div>';
		$html += '<div class="col-sm-4">';
		$html += '<input class="form-control daterange" type="text" name="b_daterange[]" value="'+now_dt+' - '+now_dt+'" readonly />';
		$html += '</div>';
		$html += '<div class="col-sm-2 control-label">彈出視窗</div>';
		$html += '<div class="col-sm-2">';
		$html += '<label class="radio-inline">';
		$html += '<input type="radio" name="rdo_pdt_status['+i+']" value="1">是';
		$html += '</label>';
		$html += '<label class="radio-inline">';
		$html += '<input type="radio" name="rdo_pdt_status['+i+']" value="0" checked>否';
		$html += '</label>';
		$html += '</div>';
		$html += '</div>';
		
		$('#add_banner_block').append($html);
		datetimepick();
		removeBanner();
		changePicture();
	});	


	$("#btn_change_pic").bind("click",function(){
		$("input[class='b_pic_url'][row="+$('#hid_row_pic').val()+"]").val($('#hid_big_pic').val());
        $("img[name='banner_pic'][row="+$('#hid_row_pic').val()+"]").attr('src', "<?= URL_GOOGLE_IMG ?>"+$('#hid_big_pic').val() );

		$("#modal-default").modal('hide');
	});


	$("#btn_change_pdt").bind("click",function(){

		if($('#div_search').val() === null) return;
		$("input[name='txt_pdt_name'][row="+$('#hid_look_pdt').val()+"]").val($('#div_search :selected').text());
		$("input[name='hid_products_id[]'][row="+$('#hid_look_pdt').val()+"]").val($('#div_search :selected').val())
		$("#modal-look").modal('hide');
	});

	$('.modal').on('shown.bs.modal', function () {
		$("input[name='search_p']").focus();
	});

	$('#search_p').bind('keyup', function() {
	if($("input[name='search_p']").val().length == 0) return;
		$('#div_modal_search').html();
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'showmain/ProductSearch',
			cache: false,
			async: false,
			data: {keyword : $('#search_p').val()},
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				$('#div_modal_search').html(response.responseText);
			}
		});
		return false;			
	});

	$('#txt_big_picture').click(function() {
		if($('#txt_big_picture').parents('.input-group-btn').prev().children('.file-caption-name').text() !='') {
			alert('請先刪除目前圖片再進行瀏覽');
			return false;
		}		
	});	
	initFileinput();
	$('#txt_big_picture').on('fileuploaded', function(event, data, previewId, index) {
		var response = data.response;
		$('input[name=hid_big_pic]').val(response.new_path);
		$('#txt_big_picture').parents('.input-group-btn').prev().children('.file-caption-name').text(response.new_name);
	});

	

	$('#btn_save').bind('click', function() {
		if(!$('#form_data')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'showmain/doEditQgoods',
			cache: false,
			async : false,
			data: $('#form_data').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				location.href = $('#hid_baseurl').val();
			}
		});
		return false;
	});

	$('#btn_cancel').bind('click', function() {
		location.href = $('#hid_baseurl').val();
	});

});

function changePicture() {
	$(".pchange").unbind();
	$('.pchange').bind("click", function() {
		$("#hid_row_pic").val($(this).attr('row'));
		key = $("#hid_row_pic").val();
		$("#hid_big_pic").val('');
		$("#hid_big_picurl").val('');
<?php for ($i=0; $i < count($banner_pdt); $i++) : ?>
		if(key == <?= $i+1 ?>) {
			$("#hid_big_pic").val("<?= $banner_pdt[$i]['pic']; ?>");
			$("#hid_big_picurl").val("<?= URL_GOOGLE_IMG.$banner_pdt[$i]['pic']; ?>");
		} 
<?php endfor; ?>

		$('#txt_big_picture').fileinput('destroy');
		$('#hid_big_pic').val('');
		initFileinput();
	});
}
function searchProduct() {
	$(".psearch").unbind();
	$('.psearch').bind('click', function() {
		$("#hid_look_pdt").val($(this).attr('row'));
		$("#hid_row_youtube").val($(this).attr('row'));
	});
}

function checkYoutube() {
	$(".check_url_youtube").unbind();
	$('.check_url_youtube').bind('click', function() {
		$("#hid_row_youtube").val($(this).attr('row'));
		$('#div_url_pic'+$("#hid_row_youtube").val()+'').html('<iframe src="'+$("input[name='txt_url_youtube[]'][row="+$('#hid_row_youtube').val()+"]").val()+'"></iframe>');
	});
}

function removeBanner() {
	$(".btn-remove_banner").unbind();
	$('.btn-remove_banner').bind("click", function(){
			$("#hid_row_pic").val($(this).attr('row'));
			$("#hid_row").val((Number($("#hid_row").val())-1));
			$('.banner'+$("#hid_row_pic").val()+'').remove();

			return false;
		});
}

function removeLook() {
	$(".btn-remove").unbind();
	$('.btn-remove').bind("click", function(){
		$("#hid_look_pdt").val($(this).attr('row'));
		$("#hid_row_look").val((Number($("#hid_row_look").val())-1));
		$('.look'+$("#hid_look_pdt").val()+'').remove();

		if ($("#hid_row_look").val() != 6) {
			$("#btn_add_look").show();
		}
		return false;
	});
}
function datetimepick() {
		$(".daterange").daterangepicker({
		opens: 'left',
		timePicker: true,
		locale: {
			format: 'YYYY-MM-DD HH:mm'
		}
	});
}

function initFileinput() {
	$('#txt_big_picture').fileinput({
		maxFileCount : 1,
		showUpload: false,
		showRemove: true,
		maxFileSize: 51200,
		minImageWidth: 1400,
		minImageHeight: 480,
		maxImageWidth: 14400,
		maxImageHeight: 480,
		language: "zh-TW",
		initialCaption: $('#hid_big_pic').val(),
		initialPreview: ['<img src="'+$("#hid_big_picurl").val()+'" height="170 class="kv-preview-data krajee-init-preview file-preview-image">'],
		uploadUrl: $('#hid_baseurl').val() + "upload/quick",
		allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
		uploadExtraData: function (previewId, index) {
			var info = {'type': 'qmaker' };
			return info;
		}
	});
}
function padleft0(obj) {
	return obj.toString().replace(/^[0-9]{1}$/, "0" + obj);
}

function add_look_show() {
	if ($("#hid_row_look").val() == 6) {
		$("#btn_add_look").hide();
	}
}

function operateFormatter(value, row, index) {
	return [
		'<a class="medit ml10" href="javascript:void(0)" title="Edit">',
			'<i class="fa fa-edit"></i>',
		'</a> '
	].join('');
}

window.operateEvents = {
	'click .medit': function (e, value, row, index) {
		window.location = $('#hid_baseurl').val() + 'theme/edit/' + row.id;
	}
};
</script>
</section><!-- /.content -->
<section class="content-footer">
    <div class='box-footer text-right'>
    	<button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
        <button type="button" class='btn btn-primary' name="btn_save" id="btn_save">Save</button>
    </div>
</section>