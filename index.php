<?php
session_start();
include 'templates/header.php';
include 'templates/top_menu.php';
include 'routes.php';
?>
<div class="content">
	<?php
		__autoload($_SERVER['REQUEST_URI']);
	?>
</div>
<?php
include 'templates/footer.php';
?>
</html>