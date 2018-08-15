<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url() ?>assets/css/search.css' rel='stylesheet' type='text/css'/>
<script src="<?= base_url() ?>assets/js/sticky/jquery.sticky.js"></script>


<script src="<?= base_url()?>assets/js/select/picker.js"></script>
<script src="<?= base_url()?>assets/js/select/prism.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.js"></script>

<input type="hidden" id="hid_page" value='<?= $page ?>'>
<input type="hidden" id="hid_type" value='<?= $type ?>'>
<input type="hidden" id="hid_word" value='<?= $word ?>'>

<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_home">
	<!--搜尋結果-->	
	<div class="div_searchResultNav" id="sticker">
		<div class="div_searchResultNavInner container">
			<a <?= ($type == 1 ? 'class="check"' : "") ?> href="<?= base_url() ?>search/list?type=1&word=<?= $word ?>">計畫 (<?= $count_project ?>)</a>
			<a <?= ($type == 2 ? 'class="check"' : "") ?> href="<?= base_url() ?>search/list?type=2&word=<?= $word ?>">商品 (<?= $count_product ?>)</a>
			<a <?= ($type == 3 ? 'class="check"' : "") ?> href="<?= base_url() ?>search/list?type=3&word=<?= $word ?>">店舖 (<?= $count_store ?>)</a>
			<span>共 <?= $totalCount ?> 筆</span>
		</div>
	</div>
	<div class="div_PlanExplore">
		<div class="container">
<?php if($type == 1): ?>			
			<div class="row">
				<?php if(count($ary_search) >0): ?>
				<?php foreach ($ary_search as $item): ?>
				<?php
					if($item['goal'] >0) {
						$item['percent_now'] = floor($item['total']/$item['goal']*100);
						$item['percent_now'] = $item['percent_now'] > 100 ? 100 : $item['percent_now'];
						$dt_now		= new DateTime();
						$dt_exp_end = new DateTime($item['dt_exp_end']);
						$interval	= date_diff($dt_exp_end, $dt_now);
						$item['datediff']	= ($dt_now > $dt_exp_end) ? '0' : $interval->format('%a');
					}
				?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="div_hotPlanEach"><a href="<?= base_url() ?>project/view/<?= $item['id'] ?>"><img src="<?= URL_GOOGLE_IMG.$item['pic_cover'] ?>" alt=""></a>
						<div class="div_hotPlanInner"><a class="a_hotPlanTitle" href="<?= base_url() ?>project/view/<?= $item['id'] ?>"><?= $item['name'] ?></a>
							<div class="div_hotPlaner">提案人<a href="javascript:void(0)"><?= $item['user_name'] ?></a></div>
							<div class="div_hotPlanContent"><?= $item['profile'] ?></div>
							<div class="progress">
								<div class="progress-bar" style="width:75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="div_timeIsMoney">倒數<span><?= $item['datediff'] ?></span>天
								<div class="pull-right">已募得<span><?= $item['total'] ?></span></div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<?php else: ?>					
	 			<div class="nothing-default">
					<img src="<?= base_url() ?>assets/img/error_shop_duck.png" alt="">
					<p>找不到相關的計畫。</p>
				</div>
				<?php endif; ?>
			</div>
<?php elseif($type == 2): ?>
			<div class="row">
				<?php if(count($ary_search) >0): ?>
				<?php foreach ($ary_search as $item): ?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="div_hotPlanEach">
						<div class="div_hotImg" style="background-image:url('<?= URL_GOOGLE_IMG.$item['url_pic'] ?>')">
							<a href="<?= base_url() ?>product/<?= $item['id'] ?>">
							</a>
						</div>
						<div class="div_hotPlanInner">
							<a class="a_hotPlanTitle" href="<?= base_url() ?>product/<?= $item['id'] ?>"><?= $item['name'] ?></a>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<?php else: ?>
				<div class="row">
					<div class="nothing-default">
						<img src="<?= base_url() ?>assets/img/error_shop_dragon.png" alt="">
						<p>找不到相關的商品。</p>
					</div>
				</div>
				<?php endif; ?>
			</div>	
<?php elseif($type == 3): ?>	
			<div class="row">
				<?php if(count($ary_search) >0): ?>
				<?php foreach ($ary_search as $item): ?>
  				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="div_hotPlanEach">
						<a class="a_wmax" href="<?= base_url() ?>store/view/<?= $item['id'] ?>">
							<div class="div_shopTitle" style="background-image:url('<?= URL_GOOGLE_IMG.$item['pic_banner'] ?>')">
							</div>
							<div class="div_shopimg">
								<div style="background-image:url('<?= URL_GOOGLE_IMG.$item['pic_logo'] ?>')"></div>
							</div>
							<div class="div_hotPlanInner div_shopPlanInner">
								<span class="span_hotPlanTitle"><?= $item['name'] ?></span>
							</div>
						</a>
					</div>
				</div>
				<?php endforeach; ?>
				<?php else: ?>
				<div class="nothing-default">
					<img src="<?= base_url() ?>assets/img/error_shop_bear.png" alt="">
					<p>找不到相關的店鋪。</p>
				</div>
				<?php endif; ?>
			</div>	
<?php endif; ?>
			<div class="row">
				<div class="col-xs-12 div_navigation">
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">
							<div class="text-center">
								<ul id="ul_page" class="pagination"></ul>
							</div>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	// page start
	$('#ul_page').twbsPagination({
		totalPages: <?= count($pageCount) ?>,
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
})

function goCriteria() {
	window.location = window.location.pathname
		+ '?type=' + $('#hid_type').val()
		+ '&word='  + $('#hid_word').val()
		+ '&page=' + $('#hid_page').val();
}

</script>