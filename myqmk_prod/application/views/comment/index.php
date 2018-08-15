<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>assets/css/bootstrap-table-filter-control.css" rel="stylesheet" type="text/css" />

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/locale/zh-tw.js"></script>
<script src="<?= base_url()?>assets/js/bootstrap-table-filter-control.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		意見管理
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>	
	<table id='tbl_main'>
	</table>
</section><!-- /.content -->
<script type="text/javascript">
var curRow = {};

$(function() {	
	$('#tbl_main').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>comment/getMy',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		filterControl: 'true',
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100]",
		onAll: function () {
			initEditable();
		},
		onLoadSuccess: function (aa, bb, cc) {
			initEditable();
		},
		onClickRow: function (row, $element) {
			curRow = row;
		},
		columns: [{
			field:'id' ,
			title: "id",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"5%",
			class:"text-nowrap"
		},{
			field:'project_name' ,
			title: "計畫名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"20%",
			filterControl: 'select',
			class:"text-nowrap"
		},{									
			field:'content' ,
			title: "意見內容",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"30%",
			class:"text-nowrap"
		},{	
			field:'dt_create' ,
			title: "日期",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			formatter: function (v) {
				return moment(v).format('YYYY-MM-DD HH:mm');
			},		
			width:"10%",
			class:"text-nowrap"
		},{											
			field:'reply' ,
			title: "回覆",
			halign:"center" ,
			align:"left" ,
			formatter: function (value, row, index) {
				return "<a href=\"#\" name=\"reply\" data-type=\"textarea\" data-pk=\""+row.Id+"\" data-title=\"回覆\">" + value + "</a>";
			},	
			width:"30%",
			class:"text-nowrap"
		}]
	});	
});

function initEditable() {
	$("#tbl_main a").editable({
		url: function (params) {
			var sName = $(this).attr("name");
			curRow[sName] = params.value;
			$.ajax({
				type: 'POST',
				url: $('#hid_baseurl').val() + 'comment/doEdit',
				data: curRow,
				dataType: 'JSON',
				success: function (data, textStatus, jqXHR) {
				},
				error: function () { alert("error");}
			});
		},
		type: 'text',
		emptytext: '未回覆'
	});	
}
</script>