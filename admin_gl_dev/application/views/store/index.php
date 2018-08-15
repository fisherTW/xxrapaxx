<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		店鋪管理
		<small>店鋪管理設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
	<div class="row">
		<div class="col-md-2">
			<button type='button' class="btn btn-warning" onclick="self.location.href='<?= base_url() ?>store/edit/0'"><span class="glyphicon" aria-hidden="true"></span> 新增</button>
		</div>
	</div>
	<br>	
	<table id='tbl_main'>
	</table>
</section><!-- /.content -->
<script type="text/javascript">
$(function() {
	$('#tbl_main').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>store/getStore',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		pagination:"true",
		pageSize: 10,
		search: true,
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
			title: "店鋪名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"39%",
			class:"text-nowrap"
		},{
			field:'dt_start' ,
			title: "開始時間",
			halign:"center" ,
			align:"center" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'dt_end' ,
			title: "結束時間",
			halign:"center" ,
			align:"center" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'is_enable' ,
			title: "狀態",
			halign:"center" ,
			align:"center" ,
			formatter: statusFormatter,
			sortable:"true" ,
			width:"10%",
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

function statusFormatter(v) {

	var str = '';
	if ( v == 1 ) {str = '<div><span style="color: green">上架</span></div>';} 
	if ( v == 0 ) {str = '<div><span style="color: red">下架</span></div>';}

	return str;
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
		window.location = $('#hid_baseurl').val() + 'store/edit/' + row.id;
	}
};
</script>