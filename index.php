<?php
session_start();

include 'templates/header.php';
/**
 * Включени админ-панели. Зависит от ипа пользователя
 */
/*if ($_SESSION['user'] === 'admin') {
	include 'templates/admin_menu.php';
}*/

//Временноая херня
include 'templates/admin_menu.php';
//Временная херня


include 'templates/top_menu.php';
include 'routes.php';
include 'scripts/func.php';
include 'includes/dbconn.php';
?>
<div class="content">
<p><form method="get" action="">
	<input type="submit" name="page" value="add_speciality" />
</form></p>
	<?php
	if (!empty($_GET['page']))
		__autoload($_GET['page']);
	?>
</div>
<?php
include 'templates/footer.php';
?>
</html>