<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Rapaq 金流 | 智付寶支付頁面 </title>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
</head>
<body class="hold-transition login-page">
	<form id="form_sp" name='form_sp' action="https://core.spgateway.com/MPG/mpg_gateway" method="post">
		<?= $info ?>
	</form>

<script>
$( document ).ready(function() {
	$('#form_sp').submit();
});
</script>
</body>
</html>