<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>

<link href="<?= base_url()?>assets/js/vendors/sweetalert2-master/css/sweetalert2.css" rel='stylesheet' type='text/css'/>
<link href="<?= base_url()?>assets/js/vendors/sweetalert2-master/css/helper.css" rel='stylesheet' type='text/css'/>
<link href="<?= base_url()?>assets/js/owl/owl.carousel.css" rel='stylesheet' type='text/css'/>
<script src="<?= base_url()?>assets/js/owl/owl.carousel.js"></script>

<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>
<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_homeTheme">
	<!--最新計畫-->
	<div class="div_planNew">
		<div class="container">
			<div class="row">
<?php if(count($ary_projectNew) > 0): ?>
<?php foreach($ary_projectNew as $item): ?>
				<div class="col-sm-6 col-xs-12"><a class="div_planNewEach" href="<?= base_url() ?>project/view/<?= $item['id'] ?>"><img src="<?= URL_GOOGLE_IMG.$item['pic_cover'] ?>" alt="">
<?php if($item['is_showname'] == 1): ?>
					<span class="span_title"><?= $item['name'] ?></span>
<?php endif; ?>					
					<span class="span_more">更多計畫內容</span></a>
				</div>
<?php endforeach; ?>
<?php endif; ?>
			</div>
		</div>
	</div>
	<!--熱門計畫-->
	<div class="div_hotPlan">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="div_title">
						<h2>熱門計畫</h2><a href="<?= base_url() ?>project/list?type=1"><span>更多</span><span class="span_arrowRight"></span></a>
					</div>
				</div>
			</div>
			<div class="row">
<?php if(count($ary_project) > 0): ?>
<?php foreach($ary_project as $item): ?>
<?php
	$item['percent_now'] = floor($item['total']/$item['goal']*100);
	$item['percent_now'] = $item['percent_now'] > 100 ? 100 : $item['percent_now'];
	$dt_now		= new DateTime();
	$dt_exp_end = new DateTime($item['dt_exp_end']);
	$interval	= date_diff($dt_exp_end, $dt_now);
	$item['datediff']	= ($dt_now > $dt_exp_end) ? '0' : $interval->format('%a');
?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="div_hotPlanEach"><a href="<?= base_url() ?>project/view/<?= $item['id'] ?>"><img src="<?= URL_GOOGLE_IMG.$item['pic_cover'] ?>" alt="" style="height: 180px;width: 360px;"></a>
						<div class="div_hotPlanInner"><a class="a_hotPlanTitle" href="<?= base_url() ?>project/view/<?= $item['id'] ?>"><?= $item['name'] ?></a>
							<div class="div_hotPlaner">提案人<a href="<?= base_url() ?>project/launcher/<?= $item['user_id'] ?>"><?= $item['user_name'] ?></a></div>
							<div class="div_hotPlanContent"><?= $item['profile'] ?></div>
							<div class="progress">
								<div class="progress-bar" style="width:<?= $item['percent_now'] ?>%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="div_timeIsMoney">倒數<span><?= $item['datediff'] ?></span>天
								<div class="pull-right">已募得<span>$ <?= $item['total'] ?></span></div>
							</div>
						</div>
					</div>
				</div>
<?php endforeach; ?>
<?php endif; ?>
			</div>
		</div>
	</div>
	<!--募設計夥伴-->
	<div class="div_partner">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="div_title">
						<h2>募設計夥伴</h2><a href="<?= base_url() ?>factory/list"><span>更多</span><span class="span_arrowRight"></span></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="owl-carousel">
<?php if(count($ary_factory) > 0): ?>
<?php foreach($ary_factory as $item): ?>
						<div class="div_partnerEach"><a class="a_partnerStore" href="<?= base_url() ?>factory/view/<?= $item['id'] ?>">
								<div class="div_storeImg"><img src="<?= URL_GOOGLE_IMG.$item['pic_logo'] ?>" alt=""></div>
								<p><?= $item['name'] ?></p><span><?= $item['profile'] ?></span></a>
<!--
							<div class="div_partnerProduct row">
								<div class="col-xs-4"><a href="javascript:void(0)" style="background-image:url(<?= base_url() ?>assets/img/plan/002.png"></a></div>
								<div class="col-xs-4"><a href="javascript:void(0)" style="background-image:url(<?= base_url() ?>assets/img/plan/002.png"></a></div>
								<div class="col-xs-4"><a href="javascript:void(0)" style="background-image:url(<?= base_url() ?>assets/img/plan/002.png"></a></div>
							</div>
-->							
						</div>
<?php endforeach; ?>
<?php endif; ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- 
	申請成為夥伴
	<div class="div_applyPartner">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="div_applyPartnerBg">
						<div class="div_applyPartnerWording">
							<p>攜眾人之力<br>將創意落實</p><a href="<?= base_url() ?>factory/form">申請成為夥伴</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
-->
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.owl-carousel').owlCarousel({
			loop:true,
			responsiveClass:true,
			autoplayTimeout:5000,
			responsive:{
				0:{
					items:1,
					margin:0,
					nav:true,
					autoplay:true
				},
				768:{
					items:2,
					margin:30,
					nav:true,
					autoplay:true
				},
				1024:{
					items:3,
					margin:30,
					nav:true,
					autoplay:false
				}
			}
		});
	});
</script>