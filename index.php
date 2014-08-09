<?php
header("Content-Type:text/html; Charset = utf-8");
error_reporting('E-ALL, E-NOTICE');
date_default_timezone_set('Europe/Moscow');

if(isset($_GET['add']))
{
	switch ($_GET['add']) 
	{
		case 'add_speciality':
			require 'view/add_speciality.php';
			break;

		case 'add_department':
			require 'view/add_department.php';
			break;

		case 'add_specialization':
			require 'view/add_specialization.php';
			break;

		case 'add_stud':
			require 'view/add_stud.php';
			break;

		case 'add_subject':
			require 'view/add_subject.php';
			break;

		case 'add_teacher':
			require 'view/add_teacher.php';
			break;
	}
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Табель успеваемости</title>

	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<script type = "text/javascript" src = "jquery-2.0.2.min.js"></script>
	<script type="text/javascript" src = "scripts/functions.js"></script>
</head>
<div id="container">
	<div id="header">
		<?php
		  require_once 'includes/header.php';
		?>		
	</div>
	<div id="body">
		<body id="index_body">
		<div id="l_div">
		<?php
		if ($user['user_grades'] === "1")
		{
		?>
			<form method="GET" action="index.php" id="admin_list">
				<div id="us-list">	
					<select id="usrl" name="add" size="10">
						<option value="add_speciality" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Добавить специальность
						</option>
						<option value="add_department" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Добавить кафедру
						</option>
						<option value="add_specialization" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Добавить специализацию
						</option>
						<option disabled></option>
						<option value="add_speciality" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Изменить/удалить специальность
						</option>
						<option value="add_department" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Изменить/удалить кафедру
						</option>
						<option value="add_specialization" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Изменить/удалить специализацию
						</option>
						<option disabled></option>
						<option value="add_stud" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Добавить студентов
						</option>
						<option value="add_subject" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Добавить предмет
						</option>
						<option value="add_teacher" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Добавить преподавателей
						</option>
						<option disabled></option>
						<option value="add_stud" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Редактирование/удаление студентов
						</option>
						<option value="add_subject" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Изменить/удалить предмет
						</option>
						<option value="add_teacher" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Редактирование/удаление преподавателей
						</option>
						<option disabled></option>
						<option value="add_result" onclick="AjaxFormRequest('result_div_id', 'admin_list', 'index.php', 'GET')">
							Добавить результаты аттестации/экзамена
						</option>
					</select>
				</div>	
			</form>
		<?php	
		}
		?>
			<form method="POST" action="students.php" id="search_form">
				Вывести список студентов по номеру курса:
				<select name="s_course">
					<option disabled>Выберите курс</option>
					<option selected value=""></option>
					<option value="1">Первый</option>
					<option value="2">Второй</option>
					<option value="3">Третий</option>
					<option value="4">Четвертый</option>
					<option value="5">Пятый</option>
				</select>
				<br />
				Или найти студента по фамилии:
				<input type="text" id="srch_stud" name="s_stud" placeholder="Студент" />
				<br />
				<input type="button" name="stud" value="ok" onclick="AjaxFormRequest('result_div_id', 'search_form', 'students.php', 'POST')" />
			</form>
		</div>
		<div id="r_div">
			<div id="result_div_id">
			</div>
		</div>
		</body>
	</div>
	<div >
	<div id="footer">
		<?php
		  require 'includes/footer.php';
		?>
	</div>
</div>
</html>
<?php
}
?>