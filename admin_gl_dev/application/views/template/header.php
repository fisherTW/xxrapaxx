<!DOCTYPE html>
<!--
   ___               __                 __  __          _____     __
  / _ \___ _  _____ / /__  ___  ___ ___/ / / /  __ __  / __(_)__ / /  ___ ____
 / // / -_) |/ / -_) / _ \/ _ \/ -_) _  / / _ \/ // / / _// (_-</ _ \/ -_) __/
/____/\__/|___/\__/_/\___/ .__/\__/\_,_/ /_.__/\_, / /_/ /_/___/_//_/\__/_/
                        /_/                   /___/
-->
<html xmlns='http://www.w4.org/1999/xhtml'>
<html lang="zh_TW">
	<head>
		<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/favicon-16x16.png">
		<link rel="manifest" href="<?= base_url() ?>assets/img/site.webmanifest">
		<link rel="mask-icon" href="<?= base_url() ?>assets/img/safari-pinned-tab.svg" color="#ff000f">
		<meta name="msapplication-TileColor" content="#00aba9">
		<meta name="theme-color" content="#ffffff">

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2">
		<title><?= $title ?></title>
		<link href='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'/>
		<link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'/>
		<link href='https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css' rel='stylesheet' type='text/css'/>
		<link href='https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css' rel='stylesheet' type='text/css'/>
		<link href='<?= base_url() ?>assets/css/validation.css' rel='stylesheet' type='text/css'/>
		<style type="text/css">
		@media (min-width: 768px) {		
			.sidebar-mini.sidebar-collapse .main-sidebar .user-panel > .image {
				display: none !important;
				-webkit-transform: translateZ(0);
			}	
		}	
		</style>

		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js'></script>
		<meta name="google-site-verification" content="6CGEEHfW3SBKUnfx2UNAXf_jmuNDhMefqiqVnBrZSik" />
	</head>
<body class="skin-red sidebar-mini">
<div class="wrapper">

<!-- Main Header -->
<header class="main-header">

	<!-- Logo -->
	<a href="<?= base_url() ?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>Ad</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>RAPAQ </b>Admin</span>
	</a>

	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account Menu -->
				<li class="dropdown user user-menu">
					<!-- Menu Toggle Button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!-- The user image in the navbar-->
						<img src="<?= base_url() ?>assets/img/icon_tools/photo.png" class="user-image" alt="User Image">
						<!-- hidden-xs hides the username on small devices so only the image appears. -->
						<span class="hidden-xs"><?= $_SESSION['sess_user_name'] ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- The user image in the menu -->
						<li class="user-header">
							<img src="<?= base_url() ?>assets/img/icon_tools/photo.png" class="img-circle" alt="User Image">
							<p>
								<?= $_SESSION['sess_user_name'] ?>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-right">
								<a href="<?= base_url() ?>member/doLogout" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?= base_url() ?>assets/img/icon_tools/photo.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?= $_SESSION['sess_user_name'] ?></p>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">創創區</li>
 			<li <?= ($path == 'list') ?  'class="active"' : ''?>><a href="<?= base_url() ?>plist"><i class="fa fa-lg fa-list-alt"></i> <span> 計畫管理</span></a></li>
 			<li <?= ($path == 'showmain_qmaker') ?  'class="active"' : ''?>><a href="<?= base_url() ?>showmain/index_qmaker"><i class="fa fa-lg  fa-file-image-o"></i> <span> 首頁管理</span></a></li>
<!-- <li><i class="fa fa lightbulb"></i><a href="#"> 贊助方案管理</a></li> -->
 			<li <?= ($path == 'comment_qmaker') ?  'class="active"' : ''?>><a href="<?= base_url() ?>comment/index_qmaker"><i class="fa fa-lg fa-comment"></i><span> 意見管理</span></a></li>
			<li <?= ($path == 'factory') ?  'class="active"' : ''?>><a href="<?= base_url() ?>factory"><i class="fa fa-lg fa-industry"></i><span> 工廠管理</span></a></li>
			<li <?= ($path == 'orders_qmaker') ?  'class="active"' : ''?>><a href="<?= base_url() ?>orders/index_qmaker"><i class="fa fa-lg fa-book"></i> <span> 訂單管理</span></a></li>
			<li <?= ($path == 'payment') ?  'class="active"' : ''?>><a href="<?= base_url() ?>payment"><i class="fa fa-lg fa-credit-card"></i> <span> 帳務設定</span></a></li>
			<li class="header">好物區</li>
			<li <?= ($path == 'store') ?  'class="active"' : ''?>><a href="<?= base_url() ?>store"><i class="fa fa-lg fa-university"></i><span> 店鋪管理</span></a></li>
			<li <?= ($path == 'showmain_qgoods') ?  'class="active"' : ''?>><a href="<?= base_url() ?>showmain/index_qgoods"><i class="fa fa-lg fa-file-image-o"></i><span> 首頁管理</span></a></li>
			<li <?= ($path == 'comment_qgoods') ?  'class="active"' : ''?>><a href="<?= base_url() ?>comment/index_qgoods"><i class="fa fa-lg fa-comment"></i><span> 意見管理</span></a></li>
			<li <?= ($path == 'announce') ?  'class="active"' : ''?>><a href="<?= base_url() ?>announce"><i class="fa fa-lg fa-newspaper-o"></i><span> 公告管理</span></a></li>
			<li <?= ($path == 'category') ?  'class="active"' : ''?>><a href="<?= base_url() ?>category"><i class="fa fa-lg  fa-sort-amount-asc"></i><span> 商品分類</span></a></li>
			<li <?= ($path == 'goods') ?  'class="active"' : ''?>><a href="<?= base_url() ?>goods"><i class="fa fa-lg  fa-cubes"></i><span> 商品列表</span></a></li>
			<li <?= ($path == 'theme') ?  'class="active"' : ''?>><a href="<?= base_url() ?>theme"><i class="fa fa-lg fa-cube"></i><span> 主題好物</span></a></li>
			<li <?= ($path == 'supplier') ?  'class="active"' : ''?>><a href="<?= base_url() ?>supplier"><i class="fa fa-lg fa-building"></i><span> 供應商</span></a></li>
			<li <?= ($path == 'orders_qgoods') ?  'class="active"' : ''?>><a href="<?= base_url() ?>orders/index_qgoods"><i class="fa fa-lg fa-book"></i><span> 訂單管理</span></a></li>
			<li <?= ($path == 'orders_qgoods_refund') ?  'class="active"' : ''?>><a href="<?= base_url() ?>refund/index_qgoods"><i class="fa fa-lg  fa-money"></i><span> 退款管理</span></a></li>
			<li <?= ($path == 'statement_self') ?  'class="active"' : ''?>><a href="<?= base_url() ?>statement/index_statement_self"><i class="fa fa-lg fa-file-text-o"></i><span> 對帳單 - 直營</span></a></li>
			<li <?= ($path == 'statement') ?  'class="active"' : ''?>><a href="<?= base_url() ?>statement/index_statement"><i class="fa fa-lg fa-file-text-o"></i><span> 對帳單 - 非直營</span></a></li>
			<li class="header">全站共用區</li>
			<li <?= ($path == 'user') ?  'class="active"' : ''?>><a href="<?= base_url() ?>user"><i class="fa fa-lg fa-user"></i><span> User 管理</span></a></li>
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">