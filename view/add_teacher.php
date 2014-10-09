<form method="POST" action="" id="adding_type_form">
		<label onclick="AjaxFormRequest('result_div_id', 'adding_type_form', 'view/add_teacher.php', 'POST')">
			<input type="radio" name="adding_type" value="manual" />
			Добавить вручную
		</label>
		<label onclick="AjaxFormRequest('result_div_id', 'adding_type_form', 'view/add_teacher.php', 'POST')">
			<input type="radio" name="adding_type" value="upload" />
			Загрузить
		</label>
		<br />
	</form>
	<?php
	if ($_POST['adding_type'] == "upload")
	{
		require '../teachers.php';
	}
	elseif ($_POST['adding_type'] == "manual")
	{
	?>
		<form method="POST" action="teachers.php" id="add_teacher_f">
			<input type="text" name="t_surname" id="t_surname" placeholder="Фамилия" />
			<input type="text" name="t_name" id="t_name" placeholder="Имя" />
			<input type="text" name="t_patr" id="t_patr" placeholder="Отчество" />
			<input type="submit" value="Добавить" />	
		</form>
	<?php
	}
	else
	{
		return true;
	}
	?>
</html>