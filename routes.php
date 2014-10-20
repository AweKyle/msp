<?php
//Определяем константы
define('DIRSEP', DIRECTORY_SEPARATOR);

/*//узнаем путь до файлов сайта
$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;
define('site_path', $site_path);*/

//загрузка классов с помощью __autoload
function __autoload($uri)
{
	$file_name = strtolower($uri) . '.php';
	$view = 'view' . DIRSEP . $file_name;
	if (file_exists($view) == false)
	{
		return false;
	}
	include $view;
}
?>