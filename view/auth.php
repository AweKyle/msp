<?php
header("Content-Type:text/html; Charset = utf-8");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="user.php">
		<input type="text" name="login" placeholder="Введите логин" />
		<input type="password" name="password" placeholder="Введите пароль" />		
		<br />
		<input type="submit" value="Вход" />
	</form>
</body>
</html>