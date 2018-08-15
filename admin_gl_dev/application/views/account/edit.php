<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		發票寄送管理
		<small>發票寄送設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
<form class="form-horizontal" id="form1">
	<br>
	<div class="col-md-11">
	</div>
	<div class="col-md-1">
		<div class="form-group">
			 <button id="download_mail" class="btn btn-primary">下載簡訊</button>
		</div>
	</div>
	<br>
	<table id='tbl_detail'>
	</table>
</form>
</section><!-- /.content -->
<section class="content-footer">
	<div class='box-footer text-right'>
		<button type="button" class='btn btn-default' name="btn_cancel" id="btn_cancel">Cancel</button>
	</div>
</section>
<script type="text/javascript">
$(function() {

	$("#download_mail").click(function(){   

		$.ajax({
			url: '<?= base_url().'account/downloadMailContent/'.$date ?>',
			dataType: 'text',  
			cache: false,
			contentType: false,
			processData: false,
			type: 'post',
			error: function(xhr){
				alert("Failure");
				},
			complete: function(response){
				//alert(response.responseText);
			}
		});

	});

	$(function() {
	$('#tbl_detail').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>account/getAccountList/<?= $date ?>',
		sortName:"id",
		sortOrder:"asc",
		selectItemName:"toolbar1",
		sidePagination:"client",
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100, All]",
		columns: [{
			field:'id' ,
			title: "id",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"5%",
			class:"text-nowrap"
		},{
			field:'auction_num' ,
			title: "拍賣編號",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"15%",
			class:"text-nowrap"
		},{
			field:'InvoiceNumber' ,
			title: "發票號碼",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"20%",
			class:"text-nowrap"
		},{
			field:'rec_name' ,
			title: "姓名",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"15%",
			class:"text-nowrap"
		},{
			field:'rec_mail' ,
			title: "mail",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"20%",
			class:"text-nowrap"
		},{
			field:'rec_mobile' ,
			title: "手機",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"15%",
			class:"text-nowrap"
		},{
			field:'is_mail_send' ,
			title: "mail發送",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
			formatter: statusFormatter,
			class:"text-nowrap"
		},{
			field:'invoice_status' ,
			title: "發票開立狀況",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10%",
			formatter: insstatusFormatter,
			class:"text-nowrap"
		}]
	});	
});		

	$('#btn_cancel').bind('click', function() {
		window.history.back();
	}); 

});

function statusFormatter(v) {

	var str = '';
	if ( v == 1 ) {str = '<div><span style="color: green">是</span></div>';} 
	if ( v == 0 ) {str = '<div><span style="color: red">否</span></div>';}

	return str;
}

function insstatusFormatter(v) {

	var str = '';
	if ( v == 'SUCCESS' ) {
		str = '<div><span style="color: green">'+v+'</span></div>';
	} else {
		str = '<div><span style="color: red">'+v+'</span></div>';
	}

	return str;
}
</script>