<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type='hidden' id='hid_baseurl' value='<?= base_url() ?>'?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		規格設定
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
	<div class="row">
		<div class="col-md-2">
			<button type='button' class="btn btn-warning" data-toggle="modal" data-target="#modal_add"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> 新增</button>
		</div>
	</div>
	<br>
	<div class="col-md-6">
		<table id='tbl_main'>
		</table>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_Label">新增規格設定</h4>
				</div>
				<div class="modal-body row">
					<form id='form1' class='vrf'>
						<input type="hidden" name="hid_id" value='0'>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">名稱</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_name" value=''>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">顏色</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_color" value=''>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">規格 </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_size" value=''>
							</div>
						</div>
					</form>
				</div>
				<br>
				<div class="modal-footer">
					<button id='btn_close' type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='btn_save' type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</section><!-- /.content -->
<script type="text/javascript">
$(function() {	
	$('#tbl_main').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>spec/getSpecByStoreId',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		filterControl: 'true',
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100]",
		columns: [{
			field:'name' ,
			title: "名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"20%",
			class:"text-nowrap"
		},{
			field:'color' ,
			title: "顏色",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"30%",
			class:"text-nowrap"
		},{	
			field:'size' ,
			title: "規格",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"30%",
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
});

function operateFormatter(value, row, index) {
	return [
		'<a class="medit ml10" href="javascript:void(0)" title="Edit">',
			'<i class="fa fa-edit"></i>',
		'</a> '
	].join('');
}

window.operateEvents = {
	'click .medit': function (e, value, row, index) {
		modalSet(row);
		$('#modal_add').modal('show');
	},
};

$('#modal_add').on('hidden.bs.modal', function (e) {
	$('#form')[0].reset();
	$('input[name=hid_id]').val(0);
	$('input[name=txt_name]').val('');
	$('input[name=txt_color]').val('');
	$('input[name=txt_size]').val('');
});

function modalSet(row) {
	$('input[name=txt_name]').val(row.name);
	$('input[name=txt_color]').val(row.color);
	$('input[name=txt_size]').val(row.size);
	$('input[name=hid_id]').val(row.id);
}

$('#btn_save').bind('click', function() {
	if(!$('#form1')[0].checkValidity()) return;
	$.ajax({
		type: "POST",
		url: $('#hid_baseurl').val() + 'spec/doEdit',
		cache: false,
		async : false,
		data: $('#form1').serialize(),
		error: function(xhr){
			alert("Failure");
		},
		complete: function(response){
			$('#tbl_main').bootstrapTable('refresh', '');
			$('#modal_add').modal('hide');
		}
	});
	return false;
});

$('#btn_close').bind('click', function(){
	$('#modal_add').modal('hide');
});

</script>