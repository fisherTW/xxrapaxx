<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

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
	<br>	
	<table id='tbl_main'>
	</table>
</section><!-- /.content -->
<script type="text/javascript">
$(function() {
	$('#tbl_main').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>orders/getMy',
		sortName:"dt_create",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		pagination:"true",
		pageSize: 10,
		search: true,
		pageList:"[10, 50, 100]",
		columns: [{
			field:'order_id' ,
			title: "訂單編號",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"14%",
			class:"text-nowrap"
		},{
			field:'project_name' ,
			title: "計劃名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"28%",
			class:"text-nowrap"
		},{
			field:'rec_name' ,
			title: "收件人",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
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
			field:'is_send' ,
			title: "出貨狀態",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap",
			formatter: function(v) {
				return (v == 0 ? '未出貨' : '已出貨');
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
		window.location = $('#hid_baseurl').val() + 'orders/edit/' + row.order_id + '/' + row.project_id;
	}
};

</script>