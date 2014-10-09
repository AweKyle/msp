<?php
header("Content-Type:text/html; Charset=utf-8");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Добавление специальности, кафедры и специализации</title>
</head>
<body>
<form method="POST" action="../faculty_struct.php">
	Специальность:
	<br />
	<input type="text" name="speciality" />
	<select name="speciality_id">
		<option disabled>
			Выберите специальность
		</option>
		<option></option>
		<?php
			//selSpeciality();
		?>
	</select>
	<br />
	Кафедра:
	<br />
	<input type="text" name="department" />
	<select name="department_id">
		<option disabled>
			Выберите кафедру
		</option>
		<option></option>
		<?php
			//seldepartment();
		?>
	</select>
	<br />
	Специализация:
	<br />
	<input type="text" name="specialization" />
	<br />
	<input type="submit" value="Принять" />
</form>
</body>
</html>