<?php
/*
 *Добавление предмета
 *ToDo
 *Будет 2 варианта: Превый(временно закоментированный) С предметом ассоциированы специальность, специализация, курс и преподаватель
 *В дальнейшем возможно будет реализовано.
 *Второй(основной) С предметом ассоциирован только преподаватель. На странице добавления предмета будет: название предмета и список преподавателей
 *
 */

/*
 =====================================================
 **Вариант 1
 =====================================================
 */

/*
if (isset($_POST['subj_semester']) && $_POST['subj_semester'] <= 4)
{
	require_once '../faculty_struct.php';
	?>
	<select multiple size="10" name="specializat_id[]" class="lists_for_subj">
		<option disabled>
			Выберите специальность
		</option>
		<option value="all">
			Для всех
		</option>
		<option disabled>
		</option>
		<?php
			selSpeciality();
		?>
	</select>
	<?php	
}
elseif ($_POST['subj_semester'] > 4)
{
	require_once '../faculty_struct.php';
	?>
	<select multiple size="10" name="specializat_id[]" class="lists_for_subj">
		<option disabled>
			Выберите специализацию
		</option>
		<option value="all">
			Для всех
		</option>
		<option disabled>
		</option>
		<?php
			selSpecialization();
		?>
	</select>
	<?php
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Добавление предмета</title>
	<script type="text/javascript" src="includes/jquery-2.0.2.min.js"></script>
	<script type="text/javascript" src="scripts/functions.js"></script>
</head>
<body>
	<form method="POST" action="subjects.php" id="add_subj">
		<table border="1">
			<tr>
				<th colspan="3">
					Добавление предмета
				</th>
			</tr>
			<th>
				Выберите семестр:	
			</th>
			<th colspan="2">
				Выберите специальность/специализацию и введите название предмета:
			</th>
			<tr>
				<td valign="top">
					<select name="subj_semester" size="4" id="semester_list">
						<!-- <option disabled>Семестр</option> -->
						<option selected></option>
						<optgroup label="Первый курс">
							<option value="1" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Первый</option>
							<option value="2" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Второй</option>
						</optgroup>
						<optgroup label="Второй курс">
							<option value="3" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Третий</option>
							<option value="4" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Четвертый</option>
						</optgroup>
						<optgroup label="Третий курс">
							<option value="5" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Пятый</option>
							<option value="6" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Шестой</option>
						</optgroup>
						<optgroup label="Четвертый курс">
							<option value="7" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Седьмой</option>
							<option value="8" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Восьмой</option>
						</optgroup>
						<optgroup label="Пятый курс">
							<option value="9" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Девятый</option>
							<option value="10" onclick="AjaxFormRequest('result_div', 'add_subj', 'view/add_subject.php', 'POST')">Десятый</option>
						</optgroup>
					<!--
						<optgroup label="Магистратура">
						<option value="1">Первый</option>
						<option value="2">Второй</option>
						</optgroup>		
					-->
					</select>
				</td>
				<td>
					<div id="result_div">
					</div>
				</td>
				<td valign="top">
					<textarea name="subject" class="add_struct" id="subj_name" placeholder="предмет"></textarea>
				</td>
			</tr>
			<th colspan="3">
				<input type="submit" class="sbmt" value="Добавить предмет" />
			</th>
		</table>	
	</form>
</body>
</html>
<?php
}
*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Добавление предмета</title>
	<script type="text/javascript" src="includes/jquery-2.0.2.min.js"></script>
	<script type="text/javascript" src="scripts/functions.js"></script>
</head>
<body>
	<form method="POST" action="subjects.php" id="add_subject_form">
		<select name="lecturers">
			<option value=""></option>
			<?php
			require 'teachers.php';
			$lecturer = selectLecturer('true');
			$size = sizeof($lecturer['id']);
			for ($i = 0; $i < $size; ++$i)
			{
				?>
				<option value="<?php echo $lecturer['id'][$i] ?>">
				<?php echo $lecturer['lecturer_name'][$i] ?>
				</option>
				<?php
			}
			?>
		</select>
		<input type="text" name="subject" placeholder="Название предмета" />
		<br />
		<input type="submit" value="Добавить" />
	</form>
</body>
</html>