<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>assets/css/bootstrap-table-filter-control.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#tbl_main {
	table-layout:fixed;
}
#tbl_main td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<script src="<?= base_url()?>assets/js/bootstrap-table-filter-control.js"></script>
<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		退款訂單管理
		<small>退款訂單資訊及設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>	
	<table id='tbl_main'>
	</table>
</section><!-- /.content -->
<script type="text/javascript">
$(function() {
	$('#tbl_main').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>refund/get/1',
		sortName:"dt_create",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		filterControl: 'true',
		pagination:"true",
		pageSize: 10,
		search: true,
		formatSearch: function(){
			return '搜尋全部欄位';
		},
		pageList:"[10, 50, 100]",
		columns: [{
			field:'order_id' ,
			title: "訂單編號",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"14%",
			class:"text-nowrap"
		},{
			field:'p_name' ,
			title: "店鋪名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"28%",
			filterControl: 'select',
			class:"text-nowrap"
		},{
			field:'total' ,
			title: "訂單金額(含運費)",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'log_refund_id' ,
			title: "退款狀態",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap",
			formatter: function(v) {
				if (v == '0' ) {
					return '<span style="color: red">未退款</span>';
				} else {
					return '<span style="color: green">已退款</span>';
				}
			}	
		},{
			field:'status_send' ,
			title: "出貨狀態",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap",
			formatter: function(v) {
				var ary = <?= JSON_SEND_STATUS ?>;
				return ary[parseInt(v)];
			}			
		},{
			field:'status_payment' ,
			title: "付款狀態",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap",
			formatter: function(v) {
				var ary = <?= JSON_PAYMENT_STATUS ?>;
				return ary[parseInt(v)];
			}
		},{
			field:'dt_create' ,
			title: "訂單成立時間",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"13%",
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
		window.location = $('#hid_baseurl').val() + 'refund/edit_qgoods/' + row.order_id + '/' + row.store_id;
	}
};

window.search = {
	'click .medit': function (e, value, row, index) {
		window.location = $('#hid_baseurl').val() + 'refund/edit_qgoods/' + row.order_id + '/' + row.store_id;
	}
};


</script>