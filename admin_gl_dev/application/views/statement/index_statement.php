<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<script src="//cdn.bootcss.com/bootstrap-table/1.11.0/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
<script src="//cdn.bootcss.com/FileSaver.js/2014-11-29/FileSaver.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		對帳單 - 非直營
		<small>對帳單 - 開店店鋪設定</small>
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-info">
		<div class="box-body">
			<i class="fa fa-info-circle"></i> 來源：好物, 付款狀態：交易成功
		</div>
	</div>
	<br>
	<div class="row">
		<div class="form-group">
			<div for="inputEmail3" class="col-sm-1 control-label">店鋪名稱 </div>
			<div class="col-sm-2">
				<input type="text" class="form-control choose_store" name="txt_store_name" value=""  disabled />
				<input type="hidden" id="choose_store" name="hid_store_id" value="" />
			</div>
			<div class="col-sm-1">
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary btn-flat search" data-toggle="modal" data-target="#modal" >搜尋店舖</button>
				</span>
			</div>	
			<div class="col-sm-6">
			</div>
		</div>
		<br>
		<br>
		<div class="form-group">
			<div  class="col-sm-1 control-label">時間 起 / 迄<br>(訂單成立時間)</div>
			<div class="col-sm-5">
				<div class="input-group date">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input class="dateRange form-control center" type="text" name="txt_date" readonly>
				</div>
			</div>
		</div>
		<br>
		<br>
		<div class="form-group">
			<span class="input-group-btn">
				<div class="col-sm-3">
					<button type="button" class="btn btn-primary btn-flat" id="search_statement" > 搜尋 </button>
				</div>
			</span>
		</div>
	</div>


<div class="tab-content">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#step1" class="active" aria-controls="step1" role="tab" data-toggle="tab">對帳單 - 總</a></li>
		<li role="presentation"><a href="#step2" aria-controls="step2" role="tab" data-toggle="tab">對帳單 - 退款</a></li>
	</ul>
	<div role="tabpanel" class="tab-pane active" id="step1">
		<table id='tbl_main'>
		</table>
	</div>
	<div role="tabpanel" class="tab-pane" id="step2">
		<table id='tbl_main_refund'>
		</table>
	</div>
</div>
</section><!-- /.content -->

<div class="modal fade" id="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">輸入店鋪名稱</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					<input type="text" class="form-control" id="search_s" name="search_s" placeholder="輸入店舖名稱">
				</div>
				<div id='div_modal_search'>
					<select id='div_search' class='form-control' size='12'></select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="btn_change_pdt" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function() {
	boostrapetable();
	boostrapetablerefund();
	datetimepick();

	$(".dateRange").val('');

	
	$('#search_statement').bind('click', function() {

		$('#tbl_main').bootstrapTable('refresh');
		$('#tbl_main_refund').bootstrapTable('refresh');	

	});


	$('.modal').on('shown.bs.modal', function () {
		$("input[name='search_s']").focus();
	});

	$('#search_s').bind('keyup', function() {
	if($("input[name='search_s']").val().length == 0) return;
		$('#div_modal_search').html();
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'statement/StoreSearch/0',
			cache: false,
			async: false,
			data: {keyword : $('#search_s').val()},
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				$('#div_modal_search').html(response.responseText);
			}
		});
		return false;			
	});


	$("#btn_change_pdt").bind("click",function(){

		if($('#div_search').val() === null) return;
		$("input[name='txt_store_name']").val($('#div_search :selected').text());
		$("input[name='hid_store_id']").val($('#div_search :selected').val())
		$("#modal").modal('hide');
	});

});

function boostrapetable() {
	$('#tbl_main').bootstrapTable({
		idField: 'id',
		url: '<?= base_url()?>statement/getStatement/0',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"server",
		showExport:true,
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100, All]",
		exportTypes:['doc', 'excel', 'xlsx'],
		queryParams:function(p){
			return{
				store_id:$('#choose_store').val(),
				date:$('.dateRange').val(),
				limit:p.limit,
				offset:p.offset,
				order:p.order,
				sort:p.sort,
				search:p.search
			}
		},
		columns: [{
			title: "訂單編號",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"5%",
			formatter: orderFormatter,
			class:"text-nowrap"
		},{
			field:'store_name' ,
			title: "店鋪名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"5%",
			class:"text-nowrap"
		},{
			title: "商品名稱(編號)",
			halign:"center" ,
			align:"left" ,
			width:"10%",
			formatter: pdtFormatter,
			class:"text-nowrap"
		},{
			title: "供應商(編號)",
			halign:"center" ,
			align:"center" ,
			width:"5%",
			formatter: supFormatter,
			class:"text-nowrap"
		},{
			field:'log_refund_id' ,
			title: "退款",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"5%",
			formatter: refundFormatter,
			class:"text-nowrap"
		},{
			field:'price_deal' ,
			title: "原價",
			halign:"center" ,
			align:"center" ,
			width:"10%",
			class:"text-nowrap"
		},{
			field:'quantity' ,
			title: "數量",
			halign:"center" ,
			align:"center" ,
			width:"10%",
			class:"text-nowrap"
		},{
			title: "銷售原總額",
			halign:"center" ,
			align:"center" ,
			width:"10%",
			formatter: saleFormatter,
			class:"text-nowrap"
		},{
			title: "代收金額",
			halign:"center" ,
			align:"center" ,
			width:"10%",
			formatter: saleFormatter,
			class:"text-nowrap"
		},{
			field:'store_profit' ,
			title: "平台服務費%",
			halign:"center" ,
			align:"center" ,
			width:"10%",
			class:"text-nowrap"
		},{
			title: "(-)平台服務費",
			halign:"center" ,
			align:"center" ,
			width:"10%",
			formatter: countService,
			class:"text-nowrap"
		},{
			title: "應收帳款(含稅)",
			halign:"center" ,
			align:"center" ,
			width:"10%",
			formatter: countTotal,
			class:"text-nowrap"
		}]
	});	


}

function boostrapetablerefund() {
	$('#tbl_main_refund').bootstrapTable({
		toggle:"table",
		idField: 'id',
		url: '<?= base_url()?>statement/getStatementRefund/0',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"server",
		showExport:true,
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100, All]",
		exportTypes:['doc', 'excel', 'xlsx'],
		queryParams:function(p){
			return{
				store_id:$('#choose_store').val(),
				date:$('.dateRange').val(),
				limit:p.limit,
				offset:p.offset,
				order:p.order,
				sort:p.sort,
				search:p.search
			}
		},
		columns: [{
			title: "訂單編號",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"5%",
			formatter: orderFormatter,
			class:"text-nowrap"
		},{
			field:'store_name' ,
			title: "店鋪名稱",
			halign:"center" ,
			align:"left" ,
			width:"15%",
			class:"text-nowrap"
		},{
			title: "商品名稱(編號)",
			halign:"center" ,
			align:"left" ,
			width:"15%",
			formatter: pdtFormatter,
			class:"text-nowrap"
		},{
			field:'amt' ,
			title: "退款金額",
			halign:"center" ,
			align:"left" ,
			width:"5%",
			class:"text-nowrap"
		},{
			field:'user_name' ,
			title: "退款人",
			halign:"center" ,
			align:"left" ,
			width:"5%",
			class:"text-nowrap"
		}]
	});	
}

function countTotal(v, row) {
	var price_deal = row.price_deal;
	var quantity = row.quantity;
	
	var total = price_deal * quantity;
	var profit = row.store_profit * 0.01;

	var charge = total * profit;
	var counttotal = total - Math.round(charge * 10) / 10 ;
	return counttotal;
}

function countService(v, row) {
	var price_deal = row.price_deal;
	var quantity = row.quantity;
	
	var total = price_deal * quantity;
	var profit = row.store_profit * 0.01;

	var charge = total * profit;
	return Math.round(charge * 10) / 10 ;
}

function orderFormatter(v, row) {

	if(row.order_id == null) {
		return '';
	} else {
		var data = '\u200C'+row.order_id;
		
		return data;
	}
}

function pdtFormatter(v, row) {
	if(row.product_id == null) {
		return '';
	} else {
		var product_id = row.product_id;
		var product_name = row.product_name;
		
		var data = product_name+'('+product_id+')';
		return data;
	}
}

function supFormatter(v, row) {

	if(row.supplier_id == null) {
		return '';
	} else {
		var supplier_id = row.supplier_id;
		var supplier_name = row.supplier_name;
	
		var data = supplier_name+'('+supplier_id+')';
		return data;
	}
	
}

function saleFormatter(v, row) {

	var price_deal = row.price_deal;
	var quantity = row.quantity;
	
	var total = price_deal * quantity;
	return total;
}

function refundFormatter(v, row) {

	var is_delivery = row.is_delivery;
	var str = '';
	if ( v == 0 || is_delivery != 0) {str = '';} 
	if ( v != 0 && is_delivery == 0) {str = '<div><span style="color: red">已退款</span></div>';}

	return str;
}

function datetimepick() {
	// $(".daterange").daterangepicker({
	// 	opens: 'left',
	// 	timePicker: false,
	// 	singleDatePicker: true,
	// 	locale: {format: 'YYYY-MM-DD'}
	// });

	$("input.dateRange").daterangepicker({
		"alwaysShowCalendars": true,
		opens: "left",
		startDate: moment().startOf("month"),
		endDate: moment().endOf("month"),
		ranges: {
			"今天": [moment(), moment()],
			"過去 7 天": [moment().subtract(6, "days"), moment()],
			"本月": [moment().startOf("month"), moment().endOf("month")],
			"上個月": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
		},
		locale: {
			format: "YYYY-MM-DD",
			separator: " ~ ",
			applyLabel: "確定",
			cancelLabel: "清除",
			fromLabel: "開始日期",
			toLabel: "結束日期",
			customRangeLabel: "自訂日期區間",
			daysOfWeek: ["日", "一", "二", "三", "四", "五", "六"],
			monthNames: ["1月", "2月", "3月", "4月", "5月", "6月","7月", "8月", "9月", "10月", "11月", "12月"],
			firstDay: 1
		}
	});
	$("input.dateRange").on("cancel.daterangepicker", function(ev, picker) {
		$(this).val("");
	});



}

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