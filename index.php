<?php
session_start();
include 'templates/header.php';
include 'templates/top_menu.php';
include 'routes.php';
?>
<div class="content">
<p><form method="get" action="">
	<input type="submit" name="page" value="auth" />
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