<link href='<?= base_url()?>assets/old/css/member.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/old/css/search.css' rel='stylesheet' type='text/css'/>

<div class="wrapper">
	<div class="wrapper-inner">
		<header class="m-header">
			<div class="m-header__bg" style="background-image:url('https://storage.googleapis.com/rapaq_public/user_pic/headpic_100001554_1519192391.png')">  
			</div>
			<div class="m-header-wrap">
				<div class="m-header__face">
					<img src="<?= base_url() ?>assets/img/icon_tools/photo.png" alt="">
				</div>
				<div class="m-header__name"><?= $info[0]['user_name'] ?></div>
				<div class="m-header__intro">
					<!-- 使用者說明 -->
				</div>
			</div>
		</header>
		<section class="m-plan">
			<div class="m-plan-wrap section-wrap">			   
				<div class="m-plan-collect" id="collect-1">
					<h2>發起的計畫</h2>
					<ul class="m-plan-list plan-collect">
<?php if(count($info) > 0): ?>
<?php foreach ($info as $project): ?>
						<li>
							<div class="list__pic">
								<a href="<?= base_url() ?>project/view/<?= $project['id'] ?>">
									<img src="<?= URL_GOOGLE_IMG.$project['pic_cover'] ?>" alt="">
								</a>
								<div class="list-tags">
								</div>
							</div>
							<div class="list-include">
								<div class="list-top">
									<div class="list__like project_like is--active is--dislike" pid="105283"></div>
									<div class="list-top__title list__title">
										<a href="<?= base_url() ?>project/view/<?= $project['id'] ?>"><?= $project['name'] ?></a>
									</div>
									<div class="list__proposal">
										提案人 <a href="#"><?= $project['user_name'] ?></a>
									</div>
								</div>
								<div class="list__intro">
									<?= $project['profile'] ?>
								</div>
<!--								
								<div class="list-status">
									<div class="list-status__get">
										已募得<span>NT$ 2120</span>
									</div>
									<div class="list-status__bar">
										<div class="bar__line"></div>
										<div class="bar__run" style="width:0%"></div>
									</div>
									<ul class="list-status__icons">
										<li class="icons-target">0%</li>
										<li class="icons-time">0天</li>
									</ul>
								</div>
-->								
							</div>
						</li>
<?php endforeach; ?>
<?php endif; ?>						
					</ul>
				</div>					
			</div>
		</section>
	</div>
	<footer class="footer">
		<div class="footer-trigger">
			<ul class="footer-trigger__icon">
				<li class="trigger-top"></li>
				<li class="trigger-middle"></li>
				<li class="trigger-bottom"></li>
			</ul>
		</div>
		<div class="footer-line"></div>
		<div class="footer-load loadbg--1"></div>
		<div class="footer-cy"></div>
	</footer>	
</div>