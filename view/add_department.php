<!DOCTYPE html>
<html>
<head>
	<title>Добавление кафедры</title>
	<b>Добавление кафедры</b>
</head>
<body>
	<form method="POST" action="faculty_struct.php" id="form_adddepartment">
		Выберите специальность:
		<br />
		<select name="speciality_id" class="speciality_list">
			<option disabled>Выберите специальность</option>
			<option selected></option>
			<?php
				require 'faculty_struct.php';
				$speciality = new Speciality();
				$speciality->selSpeciality();
			/*
				$speciality_list = $speciality->selSpeciality();
				$size = sizeof($speciality_list['id']);
				for($i = 0; $i < $size; ++$i)
				{
					?>
					<option value="<?php echo $speciality_list['id'][$i] ?>">
						<?php echo $speciality_list['speciality_name'][$i] ?>
					</option> 
					<?php
				}
			*/
			?>
		</select>
		<br />
		Введите название кафедры:
		<br />
		<input type="text" name="department" id="department_name" class="add_struct" placeholder="Кафедра" />
		<br />
		<input type="submit" class="sbmt" value="Добавить" />
	</form>
</body>
</html>