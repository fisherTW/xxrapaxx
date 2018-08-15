<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type='hidden' id='hid_baseurl' value='<?= base_url() ?>'?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		物流設定
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
	<div class="row">
		<div class="col-md-2">
			<button type='button' class="btn btn-warning" data-toggle="modal" data-target="#modal_add_delivery"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> 新增</button>
		</div>
	</div>
	<br>
	<div class="col-md-6">
		<table id='tbl_main'>
		</table>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modal_add_delivery" tabindex="-1" role="dialog" aria-labelledby="modal_deliveryLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_deliveryLabel">物流設定</h4>
				</div>
				<div class="modal-body row">
					<form id='form_delivery' class='vrf'>
						<input type="hidden" name="hid_product_id" value='0'>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">物流名稱</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_name" value=''>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">運費</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" name="txt_price" value='' pattern="[0-9]+">
							</div>
						</div>
					</form>
				</div>
				<br>
				<div class="modal-footer">
					<button id='btn_close_delivery' type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='btn_save_delivery' type="button" class="btn btn-primary">Save changes</button>
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
		url: '<?= base_url()?>product/getProductByStoreId/1',
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
			title: "物流名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"20%",
			class:"text-nowrap"
		},{									
			field:'price_deal' ,
			title: "運費",
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
		'</a> ',
		'<a class="mdelete ml10" href="javascript:void(0)" title="Delete">',
			'<i class="fa fa-trash"></i>',
		'</a>'
	].join('');
}

window.operateEvents = {
	'click .medit': function (e, value, row, index) {
		modalSet(row);
		$('#modal_add_delivery').modal('show');
	},
	'click .mdelete': function (e, value, row, index) {
		if(!confirm('確認刪除？')) return false;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'product/deliveryDoDelete',
			cache: false,
			async : false,
			data: {id: row.id},
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				alert('操作成功');
				$('#tbl_main').bootstrapTable('refresh', '');
			}
		});
		return false;
	}
};

$('#modal_add_delivery').on('hidden.bs.modal', function (e) {
	$('#form_delivery')[0].reset();
	$('input[name=hid_product_id]').val(0);
});

function modalSet(row) {
	$('input[name=txt_name]').val(row.name);
	$('input[name=txt_price]').val(row.price_deal);
	$('input[name=hid_product_id]').val(row.id);
}

$('#btn_save_delivery').bind('click', function() {
	if(!$('#form_delivery')[0].checkValidity()) return;
	$.ajax({
		type: "POST",
		url: $('#hid_baseurl').val() + 'product/doEdit/1',
		cache: false,
		async : false,
		data: $('#form_delivery').serialize(),
		error: function(xhr){
			alert("Failure");
		},
		complete: function(response){
			$('#tbl_main').bootstrapTable('refresh', '');
			$('#modal_add_delivery').modal('hide');
		}
	});
	return false;
});

$('#btn_close_delivery').bind('click', function(){
	$('#modal_add_delivery').modal('hide');
});

</script>