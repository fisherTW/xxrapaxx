<link href='<?= base_url()?>assets/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/QMaker.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url() ?>assets/css/search.css' rel='stylesheet' type='text/css'/>
<script src="<?= base_url() ?>assets/js/select/picker.js"></script>
<script src="<?= base_url() ?>assets/js/select/prism.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>

<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>
<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_homeTheme">
	<div class="div_PlanExplore">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 div_selectBar">
					<div class="div_select div_selectTitle"> 
						<?= form_dropdown('sel_name', $ary_category, $category, 'id="exploreA"'); ?>
					</div>
					<div class="div_select div_selectNormal pull-right">
						<?= form_dropdown('sel_name', $ary_status, $status, 'id="exploreB"'); ?>
					</div>
					<div class="div_select div_selectNormal div_selectNone pull-right">
						<?= form_dropdown('sel_name', $ary_type, $type, 'id="exploreC"'); ?>
					</div>
				</div>
			</div>
			<div class="row">
<?php if(count($ary_project) > 0): ?>
<?php foreach($ary_project as $info): ?>
<?php
	if($info['goal'] >0) {
		$info['percent_now'] = floor($info['total']/$info['goal']*100);
		$info['percent_now'] = $info['percent_now'] > 100 ? 100 : $info['percent_now'];
		$dt_now		= new DateTime();
		$dt_exp_end = new DateTime($info['dt_exp_end']);
		$interval	= date_diff($dt_exp_end, $dt_now);
		$info['datediff']	= ($dt_now > $dt_exp_end) ? '0' : $interval->format('%a');
	}
?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="div_hotPlanEach"><a href="<?= base_url() ?>project/view/<?= $info['id'] ?>"><img src="<?= URL_GOOGLE_IMG.$info['pic_cover'] ?>" alt=""></a>
						<div class="div_hotPlanInner"><a class="a_hotPlanTitle" href="<?= base_url() ?>project/view/<?= $info['id'] ?>"><?= $info['name'] ?></a>
							<div class="div_hotPlaner">提案人<a href="<?= base_url() ?>project/launcher/<?= $info['user_id'] ?>"><?= $info['user_name'] ?></a></div>
							<div class="div_hotPlanContent"><?= $info['profile'] ?></div>
							<div class="progress">
								<div class="progress-bar" style="width:<?= $info['percent_now'] ?>%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="div_timeIsMoney">倒數<span><?= $info['datediff'] ?></span>天
								<div class="pull-right">已募得<span><?= number_format($info['total'], 0, '.' ,',') ?></span></div>
							</div>
						</div>
					</div>
				</div>
<?php endforeach; ?>
<?php else: ?>
	 			<div class="nothing-default">
					<img src="<?= base_url() ?>assets/img/nogoods.svg" alt="">
					<p>尚無計畫</p>
				</div>
<?php endif; ?>
			</div>
			<div class="row">
				<div class="col-xs-12 div_navigation">
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">
							<?php foreach($ProjectCount as $count): ?>
							<?php if($page==$count): ?>
							<li class="page-item disabled"><a class="page-link" href="<?= base_url() ?>project/list?type=<?= $type ?>&status=<?= $status ?>&category=<?= $category ?>&page=<?= $count ?>"><?= $count ?></a></li>
							<?php else: ?>
							<li class="page-item"><a class="page-link" href="<?= base_url() ?>project/list?type=<?= $type ?>&status=<?= $status ?>&category=<?= $category ?>&page=<?= $count ?>"><?= $count ?></a></li>
							<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('#exploreA, #exploreB, #exploreC').picker();

	$('#exploreA, #exploreB, #exploreC').on('sp-change', function(){
		window.location = '<?= base_url() ?>project/list?category='+$('#exploreA').val()+'&status='+$('#exploreB').val()+'&type='+$('#exploreC').val();
	});
});
</script>