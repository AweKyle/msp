<?php
if (isset($_GET['Ok']))
echo $_GET['Ok'];
elseif (isset($_GET['notOk'])) 
echo $_GET['notOk'];
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>

	<link rel="stylesheet" type="text/css" href="/msp/styles/style.css">
	<link rel="stylesheet" type="text/css" href="/msp/scripts/fancybox/source/jquery.fancybox.css">

	<script type = "text/javascript" src = "jquery-2.0.2.min.js"></script>
	<script type="text/javascript" src = "scripts/functions.js"></script>

	<script src = "/msp/scripts/jquery-2.0.2.min.js" type="text/javascript"></script>
	<script type="text/javascript" src = "/msp/scripts/functions.js"></script>
	<script type="text/javascript" src = "/msp/scripts/fancybox/source/jquery.fancybox.js"></script>
	<script type="text/javascript" src = "/msp/scripts/fancybox/source/jquery.fancybox.pack.js"></script>
</head>
</head>
<body>
<script type="text/javascript">
	$(function () {
		$("a.fancybox").css('text-decoration', 'none');
		$('a.fancybox').fancybox();
	})
</script>

<a class="fancybox" href="#block">Click</a>

<div style="display: none" id="block">
	<form method="get" action="">
		<span>Привет?</span><br/>
		<input type="submit" name="Ok" value="Да"/>
		<input type="submit" name="notOk" value="Нет" />
	</form>
</div>


</body>
</html>