<?php
header("Content-type:text/html; Charset = utf-8");
session_start();
if(!isset($_SESSION['user']))
{
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<div id="authorization">
	<form method="POST" action="user.php" id="auth_form">
		<table>
	        <th colspan="2">
			    Вы не вошли в систему. Пожалуйста авторизуйтесь: 
			</th>
			<tr>
				<td>
					<input type="text" name="login" class="auth" id="auth_login" placeholder="Введите логин" />
				</td>
				<td>
					<input type="password" name="password" class="auth" id="auth_pass" placeholder="Введите пароль" />		
				</td>
			</tr>
			<tr>
				<th colspan="2" align="left">
					<input type="submit" class="sbmt" id="auth_sbmt" value="Вход" />
					/или 
					<a href='view/register.php'>
						зарегистрируйтесь
					</a>
				</th>
			</tr>
		</table>
	</form>
	</div>
<?php
	exit();
}
else
{
	$user = $_SESSION['user'];
	require_once 'dbconn.php';
	require_once 'user.php';
?>
<div id="user_name">
	Вы зашли как: <b><?php echo $user?></b>
</div>
<div id="div_out">
	<form method="POST" action="user.php">
		<input type="hidden" name="logout" value="exit" />
		<label onclick="this.form.submit();">[ Выход ]</label>
	</form>
</div>
<?php
}
$user_info = new User();
$user = unserialize($user_info->checkUser());
?>
