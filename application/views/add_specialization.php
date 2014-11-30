<!DOCTYPE html>
<html>
<head>
	<title>Добавление специализации</title>
	<b>Добавление специализации</b>
</head>
<body>
	<form method="POST" action="faculty_struct.php" id="form_addspecializat">
		<br />
		Выберите кафедру:
		<br />
		<select name="department_id" id="department_list">
			<option disabled>Выберите кафедру</option>
			<option selected></option>
			<?php
				require 'faculty_struct.php';
				$department = new Department();
				$department->selDepartment();
			?>
		</select>
		<br />
		Введите название специализации:
		<br />
		<input type="text" id="specializat_name" class="add_struct" name="specialization" placeholder="Специализация" />
		<br />
		<input type="submit" class="sbmt" value="Принять" />
	</form>
</body>
</html>