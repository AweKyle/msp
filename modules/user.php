<?php
session_start();
require_once '/var/www/msp/scripts/func.php';
class User
{
	//private $login = null;
	//private $pass = null;

	public function registration($login, $pass)
	{
		if ($login === '' OR $_POST['reg_pass'] === '')
		{
			alert("Все поля должны быть заполнены");
		}
		elseif ($pass != md5(md5($_POST['reg_pass2']))) 
		{
			alert("Пароли не совпадают");
		}
		elseif (!preg_match("/^\w{5,}$/", $_POST['reg_pass']))
		{
			alert("В пароле могут быть использованы только буквы, цифры и знак подчеркивания! Длина пароля должна быть не менее 5 символов");
		}
		else
		{
			$c = DB::getConn();
			try
			{
				$result = $c->prepare("INSERT INTO `rating_system`.`users` (`login`, `password`) 
									   VALUES (:regLogin, :mdPassword)");
				$result->execute(array(':regLogin'=>$login, ':mdPassword'=>$pass));
			}
			catch(PDOException $exc)
			{
				print $exc->getMessage();
			}

			if ($result)
			{
				$c = null;
				alert("success");
			}
			else
			{
				alert("err");
			}
		}
	}

	public function authorization($login, $pass)
	{
		if ($login === '' OR $_POST['password'] === '')
		{
			alert("Вы не ввели логин/пароль");
		}
		else
		{
			$c = DB::getConn();
			try
			{
				$result = $c->prepare("SELECT * FROM `rating_system`.`users` 
				       				   WHERE `login` = :login AND `password` = :pass");
				$result->execute(array(':login'=>$login, ':pass'=>$pass));
			}
			catch(PDOException $exc)
			{
				print $exc->getMessage();
			}

			if ($result->rowCount() == 1)
			{
				$c = null;
   				$_SESSION['user'] = $login;
				alert("Добро пожаловать, " . $login);
			}
			else
			{
				alert("Логин/пароль введены неправильно");
			}
		}
	}

	static public function checkUser()
	{
		if (isset($_SESSION['user']))
		{
			$c = DB::getConn();
			$user = $_SESSION['user'];
			$user_inf = array();
			try
			{
				$result = $c->prepare("SELECT `user_id`, `login`, `grades` 
									   FROM `rating_system`.`users` 
									   WHERE `login` = :user");
				$result->execute(array(':user'=>$user));
			}
			catch(PDOException $exc)
			{
				print $exc->getMessage();
			}
			
			if ($result)
			{
				$c = null;
				while($userInf = $result->fetch(PDO::FETCH_ASSOC))
				{
					$user_inf['user_id'] = $userInf['user_id'];
					$user_inf['user_grades'] = $userInf['grades'];
					$user_inf['user_name'] = $userInf['login'];
					return serialize($user_inf);
					//$_POST['user_inf'] = $user_id . "::" . $user_grades;
				}
			}
		}
	}

	static public function logOut()
	{
		//session_start();
		unset($_SESSION['user']);
		
		if (isset($_SERVER['HTTP_REFERER']))
		{
			alert("Bye");
			//header("location:" . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			alert("Bye");
			//header("location:" . $_SERVER['HTTP_REFERER']);
		}
	}
}

require_once '/var/www/msp/includes/dbconn.php';
if (isset($_POST['reg_login']) AND isset($_POST['reg_pass']))
{
	$reg = new User();
	$reg->registration($_POST['reg_login'], md5(md5($_POST['reg_pass'])));
}

if (isset($_POST['login']) AND isset($_POST['password']))
{
	$auth = new User();
	$auth->authorization($_POST['login'], md5(md5($_POST['password'])));
}

//$obj_user = User::checkUser();

if (isset($_POST['logout']))
{
	User::logOut();
}
?>