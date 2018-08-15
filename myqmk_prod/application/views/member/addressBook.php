<link href='<?= base_url()?>assets/css/member-add.css' rel='stylesheet' type='text/css'/>
<link href='<?= base_url()?>assets/css/member.css' rel='stylesheet' type='text/css'/>
<script src='<?= base_url()?>assets/js/member.js'></script>

<div class="mask"></div>
<nav class="nav">
	<div class="nav-load">
	</div>
</nav>
<div class="wrapper wrapperzero">
	<div class="wrapper-inner">
		<header class="m-header">
			<h2>常用收件地址</h2>
		</header>
		<section class="m-address">
			<div class="m-address-wrap">
				<h3>常用門市</h3>
				<ul class="m-address-list">
					<li>
						<div class="infoshop">全家師美店</div>
						<div class="infopeople">收件人 - 0900000000</div>
						<div class="infoaddress">11681 -台北市文山區丟汀州路四段77號</div>
						<div class="infonum">門市店號-F004202</div>
						<div class="info-right">
							<div class="infodelete">刪除</div>
						</div>
					</li>
					<li>
						<div class="infoshop">全家師美店</div>
						<div class="infopeople">收件人 - 0900000000</div>
						<div class="infoaddress">11681 -台北市文山區丟汀州路四段77號</div>
						<div class="infonum">門市店號-F004202</div>
						<div class="info-right">
							<div class="infodelete">刪除</div>
						</div>
					</li>
					<li>
						<div class="infoshop">全家師美店</div>
						<div class="infopeople">收件人 - 0900000000</div>
						<div class="infoaddress">11681 -台北市文山區丟汀州路四段77號</div>
						<div class="infonum">門市店號-F004202</div>
						<div class="info-right">
							<div class="infodelete">刪除</div>
						</div>
					</li>
					<li>
						<div class="infoshop">全家師美店</div>
						<div class="infopeople">收件人 - 0900000000</div>
						<div class="infoaddress">11681 -台北市文山區丟汀州路四段77號</div>
						<div class="infonum">門市店號-F004202</div>
						<div class="info-right">
							<div class="infodelete">刪除</div>
						</div>
					</li>
					<li>
						<div class="infoshop">全家師美店</div>
						<div class="infopeople">收件人 - 0900000000</div>
						<div class="infoaddress">11681 -台北市文山區丟汀州路四段77號</div>
						<div class="infonum">門市店號-F004202</div>
						<div class="info-right">
							<div class="infodelete">刪除</div>
						</div>
					</li>
				</ul>
			</div>
		</section>
		<section class="m-address pt0 pb0">
			<div class="m-address-wrap">
				<h3>收件地址</h3>
				<ul class="m-address-list">
					<li>
						<div class="infotitle">自宅</div>
						<div class="infopeople">收件人 - 0900000000</div>
						<div class="infoaddress">11681 -台北市文山區丟汀州路四段77號</div>
						<div class="info-right">
							<!-- 帶參數 -->
							<div class="infoedit"><a href="<?= base_url() ?>member/addressBookEdit">編輯</a></div>
							<div class="infodelete">刪除</div>
						</div>
					</li>
					<li class="m-address-list__addnew">
						<a href="<?= base_url() ?>member/addressBookEdit">
							<div class="addnew__btn">
								新增收件地址
							</div>
						</a>
					</li>
				</ul>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('.infodelete').click(function(){
			$(this).parents('li').remove();
		});
	})
</script>

