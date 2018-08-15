<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#tblmain {
	table-layout:fixed;
}
#tblmain td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		計畫管理
		<small>所有計劃列表</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
	<table id='tblmain'>
	</table>
<script type="text/javascript">
$(function () {
	$('#tblmain').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>plist/getProject',
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
			title: "標題",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"25%",
			class:"text-nowrap"
		},{
			field:'mpc_name' ,
			title: "分類",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'goal' ,
			title: "集資金額",
			halign:"center" ,
			align:"right" ,
			formatter: goalFormatter,
			sortable:"true" ,
			width:"20%",
			class:"text-nowrap"
		},{
			field:'dt_update' ,
			title: "最後更新時間",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"13%",
			class:"text-nowrap"
		},{
			field:'status' ,
			title: "狀態",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			formatter: statusFormatter,
			width:"12%",
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

var fm = new Intl.NumberFormat('zh-TW', {
	style: 'currency',
	currency: 'NTD'
});

function goalFormatter(v) {
	return fm.format(v);
}

function statusFormatter(v) {

	var obj = JSON.parse(<?= json_encode(JSON_PORJECT_STATUS) ?>);
	var str = obj[v];

	switch(parseInt(v)) {
		case <?= PROJECT_STATUS_1_FAIL ?>:
		case <?= PROJECT_STATUS_2_FAIL ?>:
			str = '<span style="color: red">' + str + '</span>';
			break;
		case <?= PROJECT_STATUS_1_SEND ?>:
		case <?= PROJECT_STATUS_2_SEND ?>:
		case <?= PROJECT_STATUS_1_SUCCESS ?>:
		case <?= PROJECT_STATUS_2_SUCCESS ?>:
			str = '<span style="color: green">' + str + '</span>';
			break;
	}
	return str;
}

function operateFormatter(value, row, index) {
		return [
			'<a class="medit ml10" href="javascript:void(0)" title="View">',
				'<i class="fa fa-eye"></i>',
			'</a>'
		].join('');
}

window.operateEvents = {
	'click .medit': function (e, value, row, index) {
		window.location = $('#hid_baseurl').val() + 'plist/edit/' + row.id ;
	}
};
</script>
</section><!-- /.content -->