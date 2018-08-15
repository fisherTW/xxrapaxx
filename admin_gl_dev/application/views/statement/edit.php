<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/locale/zh-tw.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/locales/zh-TW.min.js"></script>


<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		店舖管理
<?php if ($id != '0'): ?>
		<small>店舖設定</small>
<?php else: ?>
		<small>店鋪新增</small>
<?php endif; ?>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<br>
<?php if ($id != '0'): ?>
	<input type="hidden" name="hid_store_id" value='<?= $info[0]['id'] ?>'>
	<input type="hidden" name="hid_org_profit" value='<?= $info[0]['profit'] ?>'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">店鋪名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_store_name" value="<?= $info[0]['name']?>" placeholder="限50字" maxlength="50" required>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">直營店</label>
		<div class="col-sm-9">
			<label class="radio-inline">
				<input type="radio" name="rdo_is_direct" value='1' <?= $info[0]['is_direct'] == 1 ? 'checked' : '' ?>>是
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_is_direct" value='0' <?= $info[0]['is_direct'] == 0 ? 'checked' : '' ?>>否
			</label>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">店鋪狀態</label>
		<div class="col-sm-9">
			<label class="radio-inline">
				<input type="radio" name="rdo_is_enable" value='1' <?= $info[0]['is_enable'] == 1 ? 'checked' : '' ?>>上架
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_is_enable" value='0' <?= $info[0]['is_enable'] == 0 ? 'checked' : '' ?>>下架
			</label>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">利潤</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_profit" value="<?= $info[0]['profit']?>" pattern ="(\d{1,5})(\.\d{1})?$" required>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">合約期間</label>
		<div class="col-sm-9">
			<input class="form-control daterange" type="text" name="daterange" value="<?= $date ?>" readonly />			
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">聯絡人</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_contact_name" value="<?= $info[0]['contact_name']?>" placeholder="限20字" maxlength="20" required>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">聯絡人電話</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_contact_phone" value="<?= $info[0]['contact_phone']?>" placeholder="限50字" maxlength="50" pattern="(\d*)?$" required>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">使用者</label>
		<div class="col-sm-9">
			<div class="input-group">			
				<input type="text" class="form-control" name="txt_user_name" value="<?= $info[0]['user_name']?>" disabled />
				<input type="hidden" name="hid_user_id" id="hid_user_id" value="<?= $info[0]['user_id']?>" />

				<span class="input-group-btn">
					<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-default" >Search</button>
				</span>
			</div>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">LOGO</label>
		<div class="col-sm-9">
			<img src="<?= URL_GOOGLE_IMG.$info[0]['pic_logo'] ?>">
			<input type="hidden" name="hid_pic_logo" value="<?= $info[0]['pic_logo']?>" />
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">BANNER</label>
		<div class="col-sm-9">
			<img src="<?= URL_GOOGLE_IMG.$info[0]['pic_banner'] ?>">
			<input type="hidden" name="hid_pic_banner" value="<?= $info[0]['pic_banner']?>" />
		</div>		
	</div>
<?php else : ?>
	<input type="hidden" name="hid_store_id" value='0'>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">店鋪名稱</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_store_name" value="" placeholder="限50字" maxlength="50" required>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">直營店</label>
		<div class="col-sm-9">
			<label class="radio-inline">
				<input type="radio" name="rdo_is_direct" value='1'>是
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_is_direct" value='0' checked>否
			</label>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">店鋪狀態</label>
		<div class="col-sm-9">
			<label class="radio-inline">
				<input type="radio" name="rdo_is_enable" value='1' >上架
			</label>
			<label class="radio-inline">
				<input type="radio" name="rdo_is_enable" value='0' checked>下架
			</label>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">利潤</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_profit" value="" pattern ="(\d{1,5})(\.\d{1})?$" required>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">合約期間</label>
		<div class="col-sm-9">
			<input class="form-control daterange" type="text" name="daterange" value="" readonly />			
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">聯絡人</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_contact_name" value="" placeholder="限20字" maxlength="20" required>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">聯絡人電話</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="txt_contact_phone" value="" placeholder="限50字" maxlength="50" pattern="(\d*)?$" required>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">使用者</label>
		<div class="col-sm-9">
			<div class="input-group">			
				<input type="text" class="form-control" name="txt_user_name" value="" disabled />
				<input type="hidden" name="hid_user_id" id="hid_user_id" value="" />

				<span class="input-group-btn">
					<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-default" >Search</button>
				</span>
			</div>
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">LOGO</label>
		<div class="col-sm-9">
			<img src="<?= URL_GOOGLE_IMG?>new-qgoods/200x200.jpg">
			<input type="hidden" name="hid_pic_logo" value="new-qgoods/200x200.jpg" />
		</div>		
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">BANNER</label>
		<div class="col-sm-9">
			<img src="<?= URL_GOOGLE_IMG ?>new-qgoods/banner1440x290.jpg">
			<input type="hidden" name="hid_pic_banner" value="new-qgoods/banner1440x290.jpg" />
		</div>		
	</div>
<?php endif; ?>
</form>
</section><!-- /.content -->
<section class="content-footer">
    <div class='box-footer text-right'>
        <button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
        <button type="button" class='btn btn-primary' name="btn_save" id="btn_save">Save</button>
    </div>
</section>


<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">輸入使用者名稱</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					<input type="text" class="form-control" id="search_u" name="search_u" placeholder="輸入使用者名稱">
				</div>
				<div id='div_modal_search'>
					<select id='div_search' name="txt_search" class='form-control' size='12'></select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="change_u" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function() {
	datetimepick();

	$('.modal').on('shown.bs.modal', function () {
		$("input[name='search_u']").focus();
	});

	$('#search_u').bind('keyup', function() {
	if($("input[name='search_u']").val().length == 0) return;
		$('#div_modal_search').html();
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'store/UserSearch',
			cache: false,
			async: false,
			data: {keyword : $('#search_u').val()},
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
			$('#div_modal_search').html(response.responseText);
			}
		});
		return false;			
	});

	$("#change_u").bind("click",function(){
		if($('#div_search').val() === null) return;
		$("input[name='txt_user_name']").val($('#div_search :selected').text());
		$("input[name='hid_user_id']").val($('#div_search :selected').val())
		$("#modal-default").modal('hide');
	});

	$('#btn_save').bind('click', function() {
		if(!$('#form1')[0].checkValidity() || $('#hid_user_id').val() == '') return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'store/doEdit',
			cache: false,
			async: false,
			data: $('#form1').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				window.history.back();
			}
		});
		return false;			
	});		

	$('#btn_cancel').bind('click', function() {
		window.history.back();
	}); 
});

function datetimepick() {
	$(".daterange").daterangepicker({
		opens: 'left',
		timePicker: true,
		locale: {
			format: 'YYYY-MM-DD HH:mm'
		}
	});
}
</script>