<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		供應商管理
		<small>供應商內容設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
	<div class="row">
		<div class="col-md-2">
			<button type='button' class="btn btn-warning" onclick="self.location.href='<?= base_url() ?>supplier/edit/0'"><span class="glyphicon" aria-hidden="true"></span> 新增</button>
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
		url: '<?= base_url()?>supplier/getSupplier',
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
			field:'old_num' ,
			title: "編號",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'name' ,
			title: "供應商名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"75%",
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
		window.location = $('#hid_baseurl').val() + 'supplier/edit/' + row.id;
	},
	'click .mdelete': function (e, value, row, index) {
		if(!confirm('確認刪除？')) return false;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'supplier/doDelete',
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