<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.js"></script>

<link href='<?= base_url()?>assets/css/QGoods.css' rel='stylesheet' type='text/css'/>

<input type="hidden" id="hid_page" value='<?= $page ?>'>
<input type="hidden" id="hid_filter" value='<?= $filter ?>'>
<input type="hidden" id="hid_category_id" value='<?= $category_id ?>'>
<input type="hidden" id="hid_category_id_sub" value='<?= $category_id_sub ?>'>
<input type="hidden" id="hid_baseurl" value="<?= base_url() ?>">
<input type="hidden" id="hid_storeId" value="<?= $id ?>">

<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_home">
	<div class="container-fluid div_storeImage" style="background-image:url('<?= URL_GOOGLE_IMG.$info["pic_banner"] ?>')">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-xs-12 div_storeImageL">
					<div class="div_storeHead" style="background-image:url('<?= URL_GOOGLE_IMG.$info["pic_logo"] ?>')"></div>
					<div class="div_storeNameBox">
						<p class="p_StoreName"><?= $info['name'] ?></p>
<?php if($isMyBookmark): ?>						
						<button id='btn_like' class="btn_tracked">已追蹤</button>
<?php else: ?>							
						<button id='btn_like' class="btn_track">追蹤</button>
<?php endif; ?>		
					</div>
				</div>
				<div class="col-sm-6 col-xs-12 div_storeImageR">
					<p><?= $total_product ?><span>項商品</span></p>
					<p><?= $countBookmark ?><span>人追蹤</span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid div_storeTabBar">
		<div class="row">
			<div class="container">
				<div class="col-sm-12">
					<ul class="row nav nav-tabs" role="tablist">
						<li><a href="<?= base_url(); ?>store/view/<?= $id ?>">店鋪首頁</a></li>
						<li class="active"><a href="javascript:void(0)">商品總覽</a></li>
						<li><a href="<?= base_url(); ?>store/view/<?= $id ?>/C">關於我們</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="div_StoreAllProduct div_StoreAllProductHack">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_selectBar">
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
									<p class="p_ProductStoreName"><span><?= $info['name'] ?></span><span class="span_arrowRight"></span></p>
									<p class="p_ProductName"><?= $item['name'] ?></p>
									<p class="p_ProductPrice">$<?= $item['price_deal'] ?></p></a>
							</div>
						</div>
<?php endforeach; ?>
<?php endif; ?>
					</div>
				</div>
			</div>
<?php $count_page = floor($count_total/12) + 1; ?>
			<div class="text-center">
				<ul id="ul_page" class="pagination"></ul>
			</div>
		</div>
	</div>
	<!--Footer-->
</div>

<!--以上固定-->
<script src="<?= base_url()?>assets/js/select/picker.js"></script>
<script src="<?= base_url()?>assets/js/select/prism.js"></script>
<script>
$(function(){
	$('#btn_like').bind('click',function(){
<?php if(isset($_SESSION['sess_user_id'])): ?>
		$.ajax({
			async: false,
			type: 'POST',
			url: $('#hid_baseurl').val() + 'member/favoriteDoCreate',
			data: {
				content_id: $('#hid_storeId').val(),
				source: <?= SOURCE_STORE ?>
			},
			statusCode: {
				200: function(e) {
					$('#btn_like').removeClass('btn_track');
					$('#btn_like').addClass('btn_tracked');
					$('#btn_like').html('已追蹤');
				}
			}
		});
<?php else: ?>
		alert('請先登入會員！');
<?php endif; ?>
	});
	
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
	if((navTabH - 150) < windowTop){
		$('.div_storeTabBar').addClass('div_storeTabBar--show')
	} else if((navTabH - 150) >= windowTop){
		$('.div_storeTabBar').removeClass('div_storeTabBar--show')
	}
	if((navTabH - 150) < windowTop){
		$('.div_selectBar').addClass('div_selectBar--show')
	} else if((navTabH - 150) >= windowTop){
		$('.div_selectBar').removeClass('div_selectBar--show')
	}
});
</script>