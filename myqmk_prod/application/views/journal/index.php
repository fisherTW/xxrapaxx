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
		計畫更新
		<small>Updates</small>		
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
	<div class="row">
		<div class="col-md-2">
			<button type='button' class="btn btn-warning" data-toggle="modal" data-target="#modal_journal"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> 新增</button>
		</div>
	</div>
	<br>
	<table id='tbl_main'>
	</table>
	<!-- Modal -->
	<div class="modal fade" id="modal_journal" tabindex="-1" role="dialog" aria-labelledby="modal_journalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_journalLabel">新增計劃更新</h4>
				</div>
				<div class="modal-body row">
					<form id='form_journal' class='vrf'>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">計劃標題</label>
							<div class="col-sm-9">
								<?= form_dropdown('sel_project', $ary_project, '', 'id="sel_project" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">更新內容</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="txt_content" rows='5' required ></textarea>
							</div>
						</div>
					</form>
				</div>
				<br>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='btn_save_journal' type="button" class="btn btn-primary">Save changes</button>
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
		url: '<?= base_url()?>journal/getMy',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		filterControl: 'true',
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100]",
		columns: [{
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
			title: "更新內容",
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
		}]
	});	
});

$('#btn_save_journal').bind('click', function() {
	if(!$('#form_journal')[0].checkValidity()) return;
	$.ajax({
		type: "POST",
		url: $('#hid_baseurl').val() + 'journal/doCreate',
		cache: false,
		async : false,
		data: $('#form_journal').serialize(),
		error: function(xhr){
			alert("Failure");
		},
		complete: function(response){
			$('#tbl_main').bootstrapTable('refresh', '');
			$('#modal_journal').modal('hide');
		}
	});
	return false;
});
</script>