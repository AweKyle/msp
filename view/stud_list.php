<?php
require '../students.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="" id="students_form">
		<div id="select_course">
		Выборка студентов по курсу:
			<select name="s_course">
				<option disabled>Выберите курс</option>
				<option selected value=""></option>
				<option value="1">Первый</option>
				<option value="2">Второй</option>
				<option value="3">Третий</option>
				<option value="4">Четвертый</option>
				<option value="5">Пятый</option>
			</select>
		</div>
		Или поиск студента по фамилии:
		<input type="text" id="srch_stud" name="s_stud" placeholder="Студент" />
		<br />
		<input type="submit" value="ok" />
	</form>
</body>
</html>
<?php
selectStud();
?>