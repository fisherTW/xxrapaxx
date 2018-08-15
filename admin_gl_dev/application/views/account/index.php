<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		開立發票管理
		<small>開立發票設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<br>
 		<div class="col-md-4">
			<div class="form-group">
				<label >匯入開立發票資料</label>
				<input type="file" name="data_invoice" id="import_file">
				<p class="help-block">格式請務必檢查.</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				 <button id="upload_file" class="btn btn-primary">送出</button>
			</div>
		</div>
	<br>	
	<table id='tbl_main'>
	</table>
</section><!-- /.content -->
<script type="text/javascript">
$(function() {

	$("#upload_file").click(function(){   
		var check = checkUpload();

		alert(check);
		var file_data = $('#import_file').prop('files')[0];
		var form_data = new FormData();
		form_data.append('file', file_data);
		$.ajax({
			url: '<?= base_url().'account/checkInvoiceData' ?>',
			dataType: 'text',  
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			error: function(xhr){
				alert("Failure");
				},
			complete: function(response){
				alert(response.responseText);
			}
		});

	});

	$('#tbl_main').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>account/getAccount',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100]",
		columns: [{
			field:'date' ,
			title: "年月份",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"90%",
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

function checkUpload(value, row, index) {
	$.ajax({
			url: '<?= base_url().'account/checkUpload' ?>',
			dataType: 'text',  
			cache: false,
			contentType: false,
			processData: false,
			type: 'post',
			error: function(xhr){
				alert("Failure");
				},
			complete: function(response){
				console.log(response.responseText);
				return response.responseText;
			}
		});
}

function operateFormatter(value, row, index) {
	return [
		'<a class="medit ml10" href="javascript:void(0)" title="查看">',
			'<i class="fa fa-eye"></i>',
		'</a> '
	].join('');
}

window.operateEvents = {
	'click .medit': function (e, value, row, index) {
		window.location = $('#hid_baseurl').val() + 'account/edit/' + row.date;
	}
};


</script>