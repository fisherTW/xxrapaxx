<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type='hidden' id='hid_baseurl' value='<?= base_url() ?>'?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		產品設定
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
	<div class="row">
		<div class="col-md-2">
			<button type='button' class="btn btn-warning" id='btn_create' data-toggle="modal" data-target="#modal_add_delivery"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> 新增</button>
		</div>
	</div>
	<br>
	<table id='tbl_main'>
	</table>
</section><!-- /.content -->
<script type="text/javascript">
$(function() {
	$("#btn_create").bind("click",function(){
		window.location = '<?= base_url()?>product/0';
	});	

	$('#tbl_main').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url() ?>product/getProductByStoreId/0',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		filterControl: 'true',
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100]",
		columns: [{
			field:'id',
			title: "商品編號",
			halign:"center",
			align:"left",
			sortable:"true",
			width:"10%",
			class:"text-nowrap"
		},{
			field:'url_pic',
			title: "商品圖片",
			halign:"center",
			align:"left",
			sortable:"true",
			formatter: picFormatter,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'name',
			title: "商品名稱",
			halign:"center",
			align:"left",
			sortable:"true",
			width:"10%",
			class:"text-nowrap"
		},{
			field:'price_origin',
			title: "原價",
			halign:"center",
			align:"right",
			sortable:"true",
			width:"10%",
			class:"text-nowrap"
		},{
			field:'price_origin',
			title: "原價",
			halign:"center",
			align:"right",
			sortable:"true",
			width:"10%",
			class:"text-nowrap"
		},{
			field:'price_deal',
			title: "售價",
			halign:"center",
			align:"right",
			sortable:"true",
			width:"10%",
			class:"text-nowrap"
		},{
			field:'product_spec',
			title: "規格",
			halign:"center",
			align:"left",
			sortable:"true",
			width:"10%",
			class:"text-nowrap"
		},{
			field:'category_name',
			title: "分類",
			halign:"center",
			align:"left",
			sortable:"true",
			width:"10%",
			class:"text-nowrap"
		},{
			field:'dt_start_end',
			title: "上下架時間",
			halign:"center",
			align:"left",
			sortable:"true",
			width:"10%",
			class:"text-nowrap"
		},{
			field:'',
			title: "操作",
			halign:"center",
			align:"center",
			events: operateEvents,
			formatter: operateFormatter,
			width:"20%",
			class:"text-nowrap"			
		}]
	});	
});

function picFormatter(v) {
	var str = '';
	str = '<img src="https://storage.googleapis.com/rapaq-image/'+v+'" style="width: 80px;">';

	return str;
}

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
		window.location = $('#hid_baseurl').val() + 'product/' + row.id ;
	},
	'click .mdelete': function (e, value, row, index) {
		if(!confirm('確認刪除？')) return false;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'product/doDel',
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

</script>