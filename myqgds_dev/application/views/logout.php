<!DOCTYPE html>
		<meta name="google-signin-client_id" content="1051766365726-li56q2ill20fbc87ihfauecnajth6gmg.apps.googleusercontent.com">
		<script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>	

<script type="text/javascript">
// FB init
window.fbAsyncInit = function() {
    FB.init({
      appId      : '1885105144842347',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.0'
    });
    FB.AppEvents.logPageView();
};
(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/zh_TW/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
// FB init


function fbLogout(){
	FB.getLoginStatus(handleSessionResponse);
}
 
function handleSessionResponse(response) {
	if(response.status=='connected') {
		FB.logout();
	}
	window.location.href= 'https://dev-myqgoods.rapaq.com';
}

function init() {
	gapi.load('auth2', function() { // Ready. 
		gapi.auth2.init().then(function () {
			ggSignOut();
		});
	});	
}

function ggSignOut() {
	var auth2 = gapi.auth2.getAuthInstance();
	auth2.signOut().then(function () {
		fbLogout();
	});
}
</script>