<link href='<?= base_url()?>assets/css/QGoods.css' rel='stylesheet' type='text/css'/>

<script src="<?= base_url()?>assets/js/select/picker.js"></script>
<script src="<?= base_url()?>assets/js/select/prism.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.js"></script>

<input type="hidden" id="hid_page" value='<?= $page ?>'>
<input type="hidden" id="hid_filter" value='<?= $filter ?>'>
<input type="hidden" id="hid_category_id" value='<?= $category_id ?>'>
<input type="hidden" id="hid_category_id_sub" value='<?= $category_id_sub ?>'>

<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<!--QMaker 增加class .header_QMaker-->
<!--QGoods 增加class .header_QGoods-->
<!--QShare 增加class .header_QShare-->
<!--Point 增加class .header_Point-->
<header class="header_theme header_QGoods">
	<a href="<?= base_url() ?>theme/list">主題好物</a>
	<a href="<?= base_url() ?>store/list">店舖推薦</a>
	<a class="arrive" href="javascript:void(0)">好物分類</a>
</header>
<div class="div_homeTheme">
	<div class="div_StoreAllProduct div_StoreAllProductHack">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_selectBar2">
					<div class="div_select div_selectTitle">
						<?= form_dropdown('sel_category', $ary_category, $category_id, 'id="sel_category"') ?>
					</div>
					<!--還不能選曲時 加上class .div_selectDisabled-->
					<div class="div_select div_selectTitle div_selectDisabled" id='div_category_sub'>
						<select id="sel_category_sub">
						</select>
					</div>
					<div class="div_select div_selectNormal pull-right">
						<select id="sel_filter">
							<option value="1" <?= ($filter == '1') ? 'selected' : ''?>>最新上架</option>
							<option value="2" <?= ($filter == '2') ? 'selected' : ''?>>價格高至低</option>
							<option value="3" <?= ($filter == '3') ? 'selected' : ''?>>價格低至高</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="div_ProductList">
<?php if($ary_product > 0): ?>
<?php foreach($ary_product as $item): ?>
						<div class="div_ProductListEach div_storeProductListEach">
							<div class="div_ProductListEach"><a class="a_ProductListEach" href="<?= base_url() ?>product/<?= $item['id'] ?>">
									<div class="div_tag">
										<!--
										<span class="span_discount">折扣</span>
										<span class="span_free">免運</span>
										<span class="span_pre">預購品</span>
									-->
									</div>
									<div class="div_ProductImg" style="background-image:url(<?= URL_GOOGLE_IMG.$item['url_pic'] ?>)"></div>
									<p class="p_ProductStoreName"><span><?= $item['store_name'] ?></span><span class="span_arrowRight"></span></p>
									<p class="p_ProductName"><?= $item['name'] ?></p>
									<p class="p_ProductPrice">$<?= $item['price_deal'] ?></p></a>
							</div>
						</div>
<?php endforeach; ?>
<?php endif; ?>						
					</div>
				</div>
			</div>
<?php 
$count_page = floor($count_total/12); 
if(($count_total%12) != 0) {
	$count_page++;
}
?>
			<div class="text-center">
				<ul id="ul_page" class="pagination"></ul>
			</div>
		</div>
	</div>

</div>
<!--以上固定-->
<script>
$(function(){
	setSub($('#hid_category_id').val());

	$('#sel_filter, #sel_category, #sel_category_sub').picker();

	$('#sel_filter').on('sp-change', function() {
		$('#hid_filter').val($(this).val());
		$('#hid_page').val('1');
		goCriteria();
	});
	
	$('#sel_category').on('sp-change', function() {
		$('#hid_category_id').val($(this).val());
		$('#hid_category_id_sub').val('0');
		$('#hid_page').val('1');
		goCriteria();
	});

	$('#sel_category_sub').on('sp-change', function() {
		$('#hid_category_id_sub').val($(this).val());
		$('#hid_page').val('1');
		goCriteria();
	});


	// page start
	$('#ul_page').twbsPagination({
		totalPages: <?= $count_page ?>,
		startPage: <?= $page ?>,
		prev: '<span aria-hidden="true">&lsaquo;</span>',
		next: '<span aria-hidden="true">&rsaquo;</span>',
		first: '<span aria-hidden="true">&laquo;</span>',
		last: '<span aria-hidden="true">&raquo;</span>',
		initiateStartPageClick: false,	
		onPageClick: function (event, page) {
			$('#hid_page').val(page);
			goCriteria();
		}
	});
	// page end
});

function goCriteria() {
	window.location = window.location.pathname 
		+ '?page=' + $('#hid_page').val() 
		+ '&category_id='  + $('#hid_category_id').val() 
		+ '&category_id_sub='  + $('#hid_category_id_sub').val() 
		+ '&filter=' + $('#hid_filter').val();
}

function setSub(category_id) {
	if($('#hid_category_id_sub').val() != '0') {
		var sub_id = $('#hid_category_id_sub').val();
	} else {
		var sub_id = 0;
	}
	$.ajax({
		async: false,
		type: "POST",
		url: '<?= base_url() ?>' + 'store/apiGetCategory/' + category_id + '/' + sub_id,
		data: {
		},
		statusCode: {
			200: function(e) {
				var obj = JSON.parse(e);
				$('#div_category_sub').html(obj.hh);
				if(obj.count > 1) {
					$('#div_category_sub').removeClass('div_selectDisabled');
				} else {
					$('#div_category_sub').addClass('div_selectDisabled');
				}
			}
		},
		error: function() {
		}
	});	
}
</script>
<!--頁籤與分類-->
<script>
	$(window).scroll(function() {
		var windowTop = $(window).scrollTop();
		var windowH = $(window).height();
		var navTabH = $('.div_ProductList').offset().top;
		if(navTabH < windowTop){
			$('.div_selectBar2').addClass('div_selectBar2--show')
		} else if(navTabH >= windowTop){
			$('.div_selectBar2').removeClass('div_selectBar2--show')
		}
	});
</script>
