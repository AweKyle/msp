<?php
header('Content-Type: text/html; Charset=utf8');
print "pre_IF";
if ($_POST['login'] != '')
{
	//print "after_IF";
	$passHash = md5($_POST['password']);
	$login = $_POST['login'];

	print("<br />" . $login . "<br />");
	print($passHash . "<br />");  

	require_once 'includes/dbconn.php';

	$result = $c->query("SELECT * FROM `rating_system`.`users` WHERE `login`= '$login' AND `password`= '$passHash'");
	print $result->rowCount();
	if ($result->rowCount() == 1)
	{
		//$id = $result->fetch(PDO::FETCH_ASSOC);
		session_start();
   		$_SESSION['user'] = $login;
		//header ("location: index.php");
		print "welcome" . $login;
	}
	else
	{
		print " Введен неправильный Логин/Пароль попробуйте <a href = 'http://localhost/rating-system/view/auth.html'>еще раз</a> или <a href = 'http://localhost/rating-system/view/reg.html'>Зарегистрируйтесь!</a> <br />\n";
	}
}
?>
