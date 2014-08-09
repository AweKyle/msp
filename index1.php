<?php
header("Content-Type:text/html; Charset = utf-8");
error_reporting('E-ALL, ~E-NOTICE');
date_default_timezone_set('Europe/Moscow');
require_once 'includes/header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Табель успеваемости</title>
</head>
<link rel="stylesheet" type="text/css" href="styles/style.css">
<script type = "text/javascript" src = "jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$("div li").hover(
	function(){
		$(this).css("color", "red");
	}, function(){
		$(this).css("color", "red");
	});
</script>
<body id="index_body">
<div id="main_div">
	<form method="GET" action="index.php" id="admin_list">
	<!--
		<li><a href="view/add_speciality.php">Добавить специальность</a></li>
		<li><a href="view/add_chair.php">Добавить кафедру</a></li>
		<li><a href="view/add_specialization.php">Добавить специализацию</a></li>
		<li><a href="view/add_stud.php">Добавить студентов</a></li>
	-->
	<div id="us-list">	
	<select name="add" size="5">
		<option value="add_speciality" onclick="this.form.submit()">
			Добавить специальность
		</option>
		<option value="add_chair" onclick="this.form.submit()">
			Добавить кафедру
		</option>
		<option value="add_specialization" onclick="this.form.submit()">
			Добавить специализацию
		</option>
		<option value="add_stud" onclick="this.form.submit()">
			Добавить студентов
		</option>
		<option value="add_subject" onclick="this.form.submit()">
			Добавить предмет
		</option>
	</select>

	<!--
		<ul class="adm_menu">
			<input type="radio" id="speciality" name="add" value="add_speciality" onclick="this.form.submit()" class="rad" />
			<label for="speciality" class="adm_label">
				<li class="adm_list">
					Добавить специальность
				</li>
			</label>

			<input type="radio" id="chair" name="add" value="add_chair" onclick="this.form.submit()" class="rad" />
			<label for="chair" class="adm_label">
				<li class="adm_list">
					Добавить кафедру
				</li>
			</label>

			<input type="radio" id="specialization" name="add" value="add_specialization" onclick="this.form.submit()" class="rad" />
			<label for="specialization" class="adm_label">
				<li class="adm_list">
					Добавить специализацию
				</li>
			</label>

			<input type="radio" id="stud" name="add" value="add_stud" onclick="this.form.submit()" class="rad" />
			<label for="stud" class="adm_label">
				<li class="adm_list">
					Добавить студентов
				</li>
			</label>

			<input type="radio" id="subject" name="add" value="add_subject" onclick="this.form.submit()" class="rad" />
			<label for="subject" class="adm_label">
				<li class="adm_list">
					Добавить предмет
				</li>
			</label>
		</ul>
	-->
	</div>	

	<!--
		<a href ="#speciality" ><li>Добавить специальность</li></a>
		<a href ="#chair" ><li>Добавить кафедру</li></a>
		<a href ="#specialization" ><li>Добавить специализацию</li></a>
		<a href ="#stud" ><li>Добавить студентов</li></a>
		<a href ="#subject" ><li>Добавить предмет</li></a>
	-->

	</form>

	<?php
	if(isset($_GET['add']))
	{
		switch ($_GET['add']) 
		{
			case 'add_speciality':
				require_once 'view/add_speciality.php';
				break;

			case 'add_chair':
				require_once 'view/add_chair.php';
				break;

			case 'add_specialization':
				require_once 'view/add_specialization.php';
				break;

			case 'add_stud':
				require_once 'view/add_stud.php';
				break;

			case 'add_subject':
				require_once 'view/add_subject.php';
				break;
		}
	}
	?>
</div>
</body>
<div >
<footer>
	<?php
	require_once 'includes/footer.php';
	?>
</footer>
</div>
</html>