<?php
header('Content-Type: text/html; Charset=utf8');
require_once 'includes/dbconn.php';
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	$regLogin = trim($_POST['regLogin']);
	$regPass = $_POST['regPass'];
	$regPass2 = $_POST['regPass2'];
//	$regEmail = trim($_POST['regEmail']);
//	$regName = trim($_POST['regName']);
//	$regSurname = trim($_POST['regSurname']);
//	$regAge = trim($_POST['regAge']);
	
	if ($regLogin == '')
		{
		die("Введите логин!!!<br />\n");
		}
	 elseif (!preg_match("/^\w{3,}$/", $regLogin))
			{
			die("В поле логин могут быть использованы только буквы, цифры и знак подчеркивания!!1<br />\n");
			}
	if ($regPass == '' || $regPass2 == '')
		{
		die("Введите пароль!<br />\n");
		}
	 elseif($regPass !== $regPass2)
			{
			die("Пароли не совпадают!!<br />\n");
			}
	 elseif (!preg_match("/^\w{3,}$/", $regPass))
			{
			die("В пароле могут быть использованы только буквы, цифры и знак подчеркивания!!1<br />\n");
			}
/*	if ($regEmail=='')
		{
		die("Поле Email не заполнено<br />\n");
		}
	elseif (!preg_match("/^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/", $regEmail))
		{
		die("email введен неверно <br />\n");
		}*/
	$mdPassword = md5($regPass);

	$c = DB::getConn();  

	if (isset($regLogin) && ($regPass == $regPass2))
	{
		$result = $c->prepare("INSERT INTO `rating_system`.`users` (`login`, `password`) 
							VALUES (:regLogin, :mdPassword)");
		$result->execute(array(':regLogin'=>$regLogin, ':mdPassword'=>$mdPassword));	
		if ($result) 
		{
			print "Регистрация завершена<br />\n Теперь вы можете <a href= 'http://localhost/rating-system/view/auth.html'>войти</a> используя свой логин и пароль";
			print("<br />" . $mdPassword);
		}
		else
		{
		/* 
		die("Такой пользователь уже существует<br />\n" .mysql_error());
		/*/
			die("Такой пользователь уже существует<br />\n");
		// */
		}
	}			
}
?>