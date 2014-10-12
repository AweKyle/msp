<?php
include '/msp/templates/header.php';
include 'routes.php';
?>
<!DOCTYPE html>
<html>
<div class="content">
	<?php
		__autoload($_SERVER['REQUEST_URI']);
	?>
</div>
</html>