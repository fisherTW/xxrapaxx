<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/js/fileinput.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-TW.min.js'></script>

<input type="hidden" id="hid_baseurl" value='<?= base_url() ?>'>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		商品列表
		<small>商品列表設定</small>
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
		url: '<?= base_url()?>goods/getProduct',
		sortName:"id",
		sortOrder:"desc",
		selectItemName:"toolbar1",
		sidePagination:"server",
		pagination:"true",
		pageSize: 10,
		pageList:"[10, 50, 100, All]",
		search: true,
		formatSearch: function(){
			return '搜尋 商品編號、商品名稱、品牌';
		},
		columns: [{
			field:'id' ,
			title: "商品編號",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"5%",
			searchable:true,
			class:"text-nowrap"
		},{
			field:'url_pic' ,
			title: "商品圖片",
			halign:"center" ,
			align:"center" ,
			formatter: picFormatter,
			width:"10%",
			searchable:false,
			class:"text-nowrap"
		},{
			field:'name' ,
			title: "商品名稱",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"20%",
			searchable:true,
			class:"text-nowrap"
		},{
			field:'store_name' ,
			title: "品牌",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"7%",
			searchable:true,
			class:"text-nowrap"
		},{
			field:'price_deal' ,
			title: "商品價格",
			halign:"center" ,
			align:"right" ,
			sortable:"true" ,
			width:"13%",
			searchable:false,
			class:"text-nowrap"
		},{
			field:'spec' ,
			title: "商品規格",
			halign:"center" ,
			align:"left" ,
			width:"14%",
			searchable:false,
			class:"text-nowrap"
		},{
			field:'status' ,
			title: "狀態",
			halign:"center" ,
			align:"center" ,
			sortable:"true" ,
			formatter: statusFormatter,
			width:"6%",
			class:"text-nowrap"
		},{
			field:'dt_start' ,
			title: "上架時間",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10",
			searchable:false,
			class:"text-nowrap"
		},{
			field:'dt_end' ,
			title: "下架時間",
			halign:"center" ,
			align:"left" ,
			sortable:"true" ,
			width:"10",
			searchable:false,
			class:"text-nowrap"
		},{
			field:'' ,
			title: "操作",
			halign:"center" ,
			align:"center",
			events: operateEvents,
			formatter: operateFormatter,
			width:"5%",
			searchable:false,
			class:"text-nowrap"
		}]
	});	

	searchlength();
});

function searchlength(){
	$('input').before("<div style='width: 300px;'>");
	$('input').after("</div>");
}

function picFormatter(v) {

	var str = '';
	if (v != '' && v != null) {
		str = '<img src="<?= URL_GOOGLE_IMG ?>'+v+'" style="width: 80px;">';
	} else {
		str = '<img src="<?= URL_GOOGLE_IMG.'new-qgoods/200x200.jpg' ?>" style="height: 53px;">';
	}

	return str;
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
			'<i class="fa fa-eye"></i>',
		'</a> '
	].join('');
}

window.operateEvents = {
	'click .medit': function (e, value, row, index) {
		window.location = $('#hid_baseurl').val() + 'goods/edit/' + row.id;
	}
};
</script>