<?php
error_reporting('E_ALL');
header("Content-Type:text/html; Charset=utf-8");
require '../faculty_struct.php';
$speciality = new Speciality();
$departments = new Department();

?>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="../faculty_struct.php">
		<select name="speciality_id">
			<option disabled>
				Выберите cпециальность
			</option>
			<option selected></option>
			<?php
				$speciality->selSpeciality();
			?>			
		</select>
		<select name="department_id">
			<option disabled>
				Выберите кафедру
			</option>
			<option selected></option>
			<?php
				$departments->selDepartment();
			?>
		</select>
		<input type="text" name="department_name" />
		<input type="submit" name="department_edt" value="Edt" />
	</form>
</body>
</html>