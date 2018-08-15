// designview: action.js -> login.js

document.ontouchmove = function(e){ e.preventDefault(); } 
document.ontouchmove = function(e){ return true; }

var enterBoxH = $('.enterBox').height();

$(document).ready(function() {
	var resizePop;

	$('#btn_login').bind('click', function() {
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'member/doLogin',
			cache: false,
			async : false,
			data: $('#form_login').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				switch(response.responseText) {
					case '0':
						alert('登入失敗');
						break;
					case '1':
						location.href = $('#hid_baseurl').val();
						break;
				}
			}
		});
		return false;
	});	

	$(window).resize(function() {
		clearTimeout(resizePop);
		resizePop = setTimeout(course, 500); //當停止螢幕拖拉才執行
	});
	$('#btn_init').click(function() {
		resizePop = setTimeout(course, 500); //當停止螢幕拖拉才執行
	});

	//POPUP
	$( "#btn_init" ).click(function() {
		$('.enterMask').fadeToggle(500);
		$('body').toggleClass('body-freezing');
		$('.enterBox').toggleClass('enterBox_show');
	});
	$( ".close" ).click(function() {
		$('body').toggleClass('body-freezing');
		$('.enterMask').fadeToggle(500);
		$('.enterBox').toggleClass('enterBox_show');
	});
	$( ".login" ).click(function() {
		$('.loginBox').css('display','block');
		$('.registerBox').css('display','none');
	});
	$( ".register" ).click(function() {
		$('.registerBox').css('display','block');
		$('.loginBox').css('display','none');
	});
	$( ".registerRN" ).click(function() {
		$('.registerBox').css('display','block');
		$('.loginBox').css('display','none');
		$('.register').addClass('arrive').siblings().removeClass('arrive');
	});
	$( ".enterBoxHead div" ).click(function() {
		$(this).addClass('arrive').siblings().removeClass('arrive');
	});

	$( "#btn_init" ).click();

});

$(document).on(
	'fbload',
	function() {
		FB.getLoginStatus(function(res) {
			if( res.status == "connected" ) {
				FB.api('/me?fields=id,name,email', function(fbUser) {
					if(fbUser.email) {
						var fbUser_email = fbUser.email;
					} else {
						var fbUser_email = fbUser.id + '@facebook.com';
					}
					$.ajax({
						type: "POST",
						url: $('#hid_baseurl').val() + 'member/doLogin',
						cache: false,
						async : false,
						data: {
							login_type: '2',
							txt_email: fbUser_email,
							txt_showname: fbUser.name,
							txt_token: res.authResponse.accessToken
						},
						error: function(xhr){
							alert("Failure");
						},
						complete: function(response){
							location.href = $('#hid_baseurl').val();
						}
					});	
				});
			} 
		});
	}
);

function course() {
	if( $(window).height() <= enterBoxH ) {
		$('.enterBox').addClass('enterBox_fixed');
	} else {
		$('.enterBox').removeClass('enterBox_fixed');
	}
}

function onSuccess(googleUser) {
	$.ajax({
		type: "POST",
		url: $('#hid_baseurl').val() + 'member/doLogin',
		cache: false,
		async : false,
		data: {
			login_type: '3',
			txt_email: googleUser.getBasicProfile().getEmail(),
			txt_showname: googleUser.getBasicProfile().getName(),
			txt_token: googleUser.getAuthResponse().id_token
		},
		error: function(xhr){
			alert("Failure");
		},
		complete: function(response){
			location.href = $('#hid_baseurl').val();
		}
	});	
}
function onFailure(error) {
	console.log(error);
}
function renderButton() {
	gapi.signin2.render('div_glogin', {
		'scope': 'profile email',
		'width': 280,
		'height': 40,
		'longtitle': false,
		'theme': 'dark',
		'onsuccess': onSuccess,
		'onfailure': onFailure
	});
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}