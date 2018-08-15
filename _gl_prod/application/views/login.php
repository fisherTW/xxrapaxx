<!DOCTYPE html>
<html>
	<head>
		<title>RapaQ</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0 , minimum-scale=1, maximum-scale=1">
		<meta charset="UTF-8">
		<meta name="title" content="RapaQ">
		<meta name="description" content="RapaQ">
		<meta name="keywords" content="RapaQ">
		<meta name="og:title" content="RapaQ">
		<meta name="og:description" content="RapaQ">
		<meta name="og:type" content="website">
		<meta name="og:image" content="https://qgoods.rapaq.com/event/Qmember_gift/img/shareFB.jpg">
		<meta name="google-signin-client_id" content="1051766365726-li56q2ill20fbc87ihfauecnajth6gmg.apps.googleusercontent.com">

		<link rel="icon" type="image/ico" href="<?= base_url()?>assets/img/favicon.ico">
		<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">		
		<link rel="stylesheet" href="<?= base_url()?>assets/css/validation.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="<?= base_url()?>assets/js/form.js"></script>
		<script src="<?= base_url()?>assets/js/login.js"></script>
		<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>	
	</head>
	<body style="height:1000px;">

<div id="fb-root"></div>
<script>
// FB START----------------------
function triggerFbload() {
	$(document).trigger('fbload')
}

function finished_rendering() {
	console.log("finished rendering plugins");
	var spinner = document.getElementById("spinner");
	spinner.removeAttribute("style");
	$('#span_fb_loading').remove();
}

window.fbAsyncInit = function() {
	FB.Event.subscribe('xfbml.render', finished_rendering);	
	FB.AppEvents.logPageView();
};

(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v3.0&appId=1885105144842347&autoLogAppEvents=1';

fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
// FB END----------------------
</script>
		<input type='hidden' id='hid_baseurl' value='<?= base_url()?>'>
		<!--登入測試用按鈕--><a id='btn_init' class="test180131" href="javascript:void(0)">點我開登入口</a>
		<!--POPUP-->
		<section class="enterMask"></section>
		<section class="enterBox">
			<div class="enterBoxHead">
				<img src="<?= base_url()?>assets/img/logo-red.png" style='height:40px;margin-top:10px;'>
			</div>
			<!--登入箱	-->
			<div class="loginBox">
				<div class="title"><span>快速登入</span></div>
				<div class="shareBox">
				<div id="spinner"
					style="
						background: #4267b2;
						border-radius: 5px;
						color: white;
						height: 40px;
						text-align: center;
						width: 280px;">
					<span id='span_fb_loading'><i class='fa fa-snowflake fa-spin fa-2x' style='margin-top: 4px'></i></span>
					<div scope="public_profile,email" class="fb-login-button" onlogin='triggerFbload' data-width="280px" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false"></div>
				</div>
					<div id="div_glogin" style="margin-top: 5px;"></div>
				</div>
				<div class="title"><span>RapaQ 帳號登入</span></div>
				<form id="form_login" class="">
					<input type="email" name="txt_email" placeholder="E-mail" required>
					<input type="password" name="txt_password" placeholder="密碼" required>
					<button type="" id='btn_login'>登入</button>
				</form>
				<div class="memory">
					<label>
						<input type="checkbox" checked><span>記得我，下次自動登入</span>
					</label><a href="<?= base_url() ?>member/forgetPassword">忘記密碼?</a>
				</div>
				<div id='div_reg' class="registerRN">還沒有帳號？立即註冊！</div>
				<div class="ps">登入或註冊即同意<a href="https://oauth.rapaq.com/privacy.html" target="_blank">隱私政策</a>和<a href="https://oauth.rapaq.com/terms.html" target="_blank">使用條款</a></div>
			</div>
			<!--註冊箱-->
			<div class="registerBox" style="display:none;">
				<div class="title"><span>RapaQ 帳號註冊</span></div>
				<form id="form_reg" class="">
					<input type="email" name="txt_email" placeholder="E-mail" required>
					<input type="password" name="txt_password" placeholder="密碼" onkeyup='onkuPass();' required>
					<input type="password" name="txt_checkpassword" placeholder="再輸入一次密碼" required>
					<button type="" id='btn_reg'>註冊</button>
				</form>
				<div id='div_login' class="registerRN">已經有帳號了？登入</div>
				<div class="ps psLine">登入或註冊即同意<a href="https://oauth.rapaq.com/privacy.html" target="_blank">隱私政策</a>和<a href="https://oauth.rapaq.com/terms.html" target="_blank">使用條款</a></div>
			</div>
		</section>
	</body>
</html>