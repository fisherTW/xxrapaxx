<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		User 管理
		<small>所有 User 列表</small>
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
		url: '<?= base_url()?>member/get',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		pagination:"true",
		search: 'true',
		pageSize: 10,
		pageList:"[10, 50, 100]",
		columns: [{
			field:'id' ,
			title: "編號",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"5%",
			class:"text-nowrap"
		},{
			field:'name' ,
			title: "姓名",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'mail' ,
			title: "mail",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"45%",
			class:"text-nowrap"
		},{
			field:'login_type' ,
			title: "登入方式",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"45%",
			formatter: ltFormatter,
			class:"text-nowrap"
		},{			
			field:'dt_update' ,
			title: "最後更新時間",
			halign:"center" ,
			align:"left" ,
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

	$('#tblmain').on('all.bs.table', function () {
		$('input[name=toggle-one]').bootstrapToggle();
		$('input[name=toggle-one]').unbind();
		$('input[name=toggle-one]').bind('change', function() {
			$.ajax({
				type: "POST",
				url: $('#hid_baseurl').val() + 'user/update_is_admin',
				cache: false,
				async : false,
				data: {
					id: $(this).attr('row_id'),
					val: $(this).prop('checked')
				},
				error: function(xhr){
					alert("Failure");
				},
				complete: function(response){
				}
			});
			return false;				
		});
	});

});

function ltFormatter(v) {
	switch(parseInt(v)) {
		case <?= LOGIN_TYPE_LOCAL ?>:
			str = 'RapaQ 帳號';
			break;
		case <?= LOGIN_TYPE_FB ?>:
			str = 'FB';
			break;
		case <?= LOGIN_TYPE_GOOGLE ?>:
			str = 'GOOGLE';
			break;
	}
	return str;
}

function operateFormatter(v, row, index) {
		return [
			'<input name="toggle-one" '+ (parseInt(row.is_admin) == 1 ? 'checked' : '')+' type="checkbox" data-on="管理員" data-off="普通人" row_id='+row.id+'>'
		].join('');
}

window.operateEvents = {
	'click .medit': function (e, value, row, index) {
		window.location = $('#hid_baseurl').val() + 'plist/edit/' + row.id ;
	}
};
</script>
</section><!-- /.content -->