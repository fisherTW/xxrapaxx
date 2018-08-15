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
		<link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

		<link href='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'/>
		<link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'/>
		<link href='https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css' rel='stylesheet' type='text/css'/>
		<link href='https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css' rel='stylesheet' type='text/css'/>
		<link href='<?= base_url() ?>assets/css/validation.css' rel='stylesheet' type='text/css'/>

		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js'></script>
		<meta name="google-site-verification" content="6CGEEHfW3SBKUnfx2UNAXf_jmuNDhMefqiqVnBrZSik" />
	</head>
<body class="skin-black sidebar-mini sidebar-collapse">
<div class="wrapper">

<!-- Main Header -->
<header class="main-header">

	<!-- Logo -->
	<a href="#" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>募</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>募設計</b>後台</span>
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
			<li class="header">選單列表</li>
			<li <?= ($path == 'list') ?  'class="active"' : ''?>><a href="<?= base_url() ?>plist"><i class="fa fa-lg fa-list-alt"></i> <span>計畫管理</span></a></li>
			<li <?= ($path == 'journal') ?  'class="active"' : ''?>><a href="<?= base_url() ?>journal"><i class="fa fa-lg fa-book"></i> <span>計劃更新</span></a></li>
			<li <?= ($path == 'comment') ?  'class="active"' : ''?>><a href="<?= base_url() ?>comment"><i class="fa fa-lg fa-comment"></i> <span>意見管理</span></a></li>
			<li <?= ($path == 'orders') ?  'class="active"' : ''?>><a href="<?= base_url() ?>orders"><i class="fa fa-lg fa-book"></i> <span>訂單管理</span></a></li>
<!-- 			<li <?= ($path == 'brand') ?  'class="active"' : ''?>><a href="<?= base_url() ?>brand"><i class="fa fa-lg fa-id-card"></i> <span>品牌管理</span></a></li>
 -->			
 			<li <?= ($path == 'payment') ?  'class="active"' : ''?>><a href="<?= base_url() ?>payment"><i class="fa fa-lg fa-credit-card"></i> <span>帳務設定</span></a></li>
<!--						
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
				<ul class="treeview-menu">
					<li><a href="#">Link in level 2</a></li>
					<li><a href="#">Link in level 2</a></li>
				</ul>
-->				
			</li>
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">